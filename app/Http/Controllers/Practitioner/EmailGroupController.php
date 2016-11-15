<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\Contact;
use App\Models\Temp;
use App\Models\EmailInGroup;
use App\Models\EmailGroup;
use App\Models\Practitioner;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Http\Requests;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;

class EmailGroupController extends Controller
{
    var $practitioner_info = null;
    public function __construct()
    {
        $this->practitioner_info = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cg_list = EmailGroup::where('pra_id', '=', $this->practitioner_info->pra_id)->get();
        $meta = array('page_title'=>' EmailGroup List');
        return view('practitioner.email-group.index')->with('list', $cg_list)
            ->with('template_menu', 'active')
            ->with('eg_sub_menu_list', 'active');
//        $cg_list = EmailGroup::where('pra_id', '=', $this->practitioner_info->pra_id)->get();
//        $meta = array('page_title'=>' EmailGroup List');
//
//        return view('practitioner.email-group.index')->with('meta', $meta)
//            ->with('template_menu', 'active')
//            ->with('eg_sub_menu_list', 'active')
//            ->with('cg_list', $cg_list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meta = array('page_title'=>'New Email Group');
        return view('practitioner.email-group.new')->with('meta', $meta)
            ->with('template_menu', 'active')
            ->with('eg_sub_menu_new', 'active');
    }
    public function toContact(Request $request){
        Session::put('group_name', $request->name);
        Session::put('group_desc', $request->description);
        return Redirect::to('/practitioner/email-group/contact');
    }

    public function contact(Request $request){
        $patients = Patient::select('*')->orderBy('first_name', 'asc')->get();
        $pat_ids = Session::has('selected_patients_list') ? Session::get('selected_patients_list') : array();
        $selected_pat = array();
        if(!empty($pat_ids)) {
            $selected_pat = Patient::select('user_id','first_name', 'middle_name', 'last_name', 'email', 'primary_phone')
                ->whereIn('user_id', $pat_ids)->get();
        }
        return view('practitioner.email-group.addcontact')
            ->with('selected_pat', $selected_pat)->with('pat_ids', $pat_ids)
            ->with('patients', $patients);
    }
    public function addPatients(Request $request)
    {
        Session::put('selected_patients_list', $request['sup_id']);
        return Redirect::Back();
    }
    public function removePatients()
    {
        $pat = Session::get('selected_patients_list');
        foreach ($pat as $index => $val) {
            if ($val == Input::get('user_id')) {
                unset($pat[$index]);
            }
        }
        Session::put('selected_patients_list', $pat);
        echo 'success';
    }

    public function patients(Request $request){
        $contact = Contact::where('pra_id', '=', $this->practitioner_info->pra_id)->get();
        $con_ids = Session::has('selected_contact_list') ? Session::get('selected_contact_list') : array();
        $selected_con = array();
        if(!empty($con_ids)) {
            $selected_con = Contact::select('cnt_id','first_name', 'middle_name', 'last_name', 'email', 'phone')
                ->whereIn('cnt_id', $con_ids)->get();
        }
        return view('practitioner.email-group.addpatient')
            ->with('selected_con', $selected_con)->with('con_ids', $con_ids)
            ->with('contact', $contact);
//       $contact = Contact::where('pra_id', '=', $this->practitioner_info->pra_id)->get(ssss);
//       return view('practitioner.email-group.addpatient')->with('data',$data)->with('contact',$contact);
    }
    public function addContacts(Request $request)
    {
        Session::put('selected_contact_list', $request['sup_id']);
        return Redirect::Back();
    }
    public function removeContacts()
    {
        $con = Session::get('selected_contact_list');
        foreach ($con as $index => $val) {
            if ($val == Input::get('user_id')) {
                unset($con[$index]);
            }
        }
        Session::put('selected_contact_list', $con);
        echo 'success';
    }
    public function confirmed(Request $request)
    {
        $patients_id = Session::get('selected_patients_list');
        $contacts_id = Session::get('selected_contact_list');

        $patients = Patient::select('user_id','first_name', 'middle_name', 'last_name', 'email', 'primary_phone')
            ->whereIn('user_id', $patients_id)->get();

        $contacts = Contact::select('cnt_id','first_name', 'middle_name', 'last_name', 'email', 'phone')
            ->whereIn('cnt_id', $contacts_id)->get();

        return view('practitioner.email-group.confirm')
            ->with('patients', $patients)
            ->with('contacts', $contacts)->with('sug_menu', 'active');

    }
    public function store(Request $request)
    {
        $eg = new EmailGroup;
        $eg->name = Session::get('group_name');
        $eg->pra_id = $this->practitioner_info->pra_id;
        $eg->description = Session::get('group_desc');
        $eg->save();

        if(isset($request->sup_id) && (count($request->sup_id)>0)){
            foreach ($request->sup_id  as $sup_ids){
                $patients = Patient::select('email','first_name','middle_name','last_name','primary_phone')->where('user_id',$sup_ids)->get()->first();
            EmailInGroup::create([
                'email' =>  $patients->email,
                'cg_id' => $eg['cg_id'],
                'first_name' => $patients->first_name,
                'middle_name' => $patients->middle_name,
                'last_name' => $patients->last_name,
                'primary_phone' => $patients->primary_phone,
                'type' => '1',
                'group_name' => $eg['name'],
                'pra_id' => $this->practitioner_info->pra_id
            ]);
            }
        }
        if(isset($request->pa_id) && (count($request->pa_id)>0)){
            foreach ($request->pa_id  as $pa_id){
                $contact = Contact::select('email','first_name','middle_name','last_name','phone')->where('cnt_id',$pa_id)->get()->first();
                EmailInGroup::create([
                    'email' =>  $contact->email,
                    'cg_id' => $eg['cg_id'],
                    'first_name' => $patients->first_name,
                    'middle_name' => $contact->middle_name,
                    'last_name' => $contact->last_name,
                    'primary_phone' => $contact->phone,
                    'type' => '2',
                    'group_name' => $eg['name'],
                    'pra_id' => $this->practitioner_info->pra_id
                ]);
            }
        }
        Session::forget('selected_patients_list');
        Session::forget('selected_contact_list');
        Session::forget('group_name');
        Session::forget('group_desc');

        Session::put('success','Email group created successfully!');
        return Redirect::to('/practitioner/email-group');
        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    }
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meta = array('page_title'=>'Edit Group');
        $list = EmailGroup::where('cg_id', $id)->get()->first();
        $patients = EmailInGroup::select('first_name', 'last_name', 'email', 'primary_phone')
            ->where('cg_id', $id)->where('type', '1')->get();
        $contacts = EmailInGroup::select('first_name', 'last_name', 'email', 'primary_phone')
            ->where('cg_id', $id)->where('type', '2')->get();

        return view('practitioner.email-group.edit')->with('meta', $meta)->with('list',$list)
             ->with('template_menu', 'active')->with('patients', $patients)->with('contacts',$contacts);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         $cg = EmailGroup::find($request->cg_id);
         $cg->name = $request->name;
         $cg->description = $request->description;
         $cg->save();

         Session::put('success','Email group updated successfully!');

         return Redirect::to('/practitioner/email-group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $cg = EmailGroup::find($id);
         if(isset($cg)){
             $cg->delete();

             Session::put('success','Contact group deleted successfully!');
             //return response()->json(['status' => 'success']);
         }
         return response()->json(['status' => 'error']);
    }
}
