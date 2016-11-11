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

        return view('practitioner.email-group.index')->with('meta', $meta)
            ->with('template_menu', 'active')
            ->with('eg_sub_menu_list', 'active')
            ->with('cg_list', $cg_list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meta = array('page_title'=>'New Email Group');
        $patients = Patient::select('*')->orderBy('first_name', 'asc')->get();
        $contacts = Contact::where('pra_id', '=', $this->practitioner_info->pra_id)->get();
        return view('practitioner.email-group.new')->with('meta', $meta)
            ->with('template_menu', 'active')
            ->with('eg_sub_menu_new', 'active')
            ->with('patients', $patients)->with('contacts',$contacts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contact(Request $request){
        $data = [
            'name' => $request->name,
            'desc' => $request->description,
        ];
        $patients = Patient::select('*')->orderBy('first_name', 'asc')->get();
        return view('practitioner.email-group.addcontact')->with('data',$data)->with('patients',$patients);
    }
    public function patients(Request $request){
        dd(Session::get('selected_list'));
        $data = [
            'name' => $request->name,
            'desc' => $request->description,
        ];
        if(isset($request->email) && (count($request->email)>0)){
            foreach ($request->email  as $key => $value)
                Temp::create([
                    'email' =>  $value,
                    'type' => '1',
                ]);
        }
       $contact = Contact::where('pra_id', '=', $this->practitioner_info->pra_id)->get();
       return view('practitioner.email-group.addpatient')->with('data',$data)->with('contact',$contact);
    }
    public function findinfo(Request $request){
        $id = $request->id;
        $templates = Patient::where('user_id',$id)->first();
        if(!Session::has('selected_list')){
            Session::put('selected_list', array());
        }
        Session::push('selected_list', $id);
        $data = array('data'=>$templates);
        return response()->json($data);
    }
    public function confirmed(Request $request){
        $data = [
            'name' => $request->name,
            'desc' => $request->description,
        ];
        if(isset($request->email) && (count($request->email)>0)){
            foreach ($request->email  as $email)
                Temp::create([
                    'email' =>  $email,
                    'type' => '2'
                ]);
        }
        $patients = Temp::where('type', '1')->get();
        $contacts = Temp::where('type', '2')->get();
        return view('practitioner.email-group.confirm')->with('data',$data)->with('patients',$patients)->with('contacts',$contacts);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $input['pra_id'] = $this->practitioner_info->pra_id;
        $contact = EmailGroup::create($input);

        if(isset($request->email) && (count($request->email)>0)){
            foreach ($request->email  as $email)
            EmailInGroup::create([
                'email' =>  $email,
                'cg_id' => $contact['cg_id']
            ]);
        }
        Temp::truncate();
        Session::put('success','Email group created successfully!');
        return Redirect::to('/practitioner/email-group/new');
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
         $cg = EmailGroup::find($id);

         $meta = array('page_title'=>'Edit Group', 'cm_main_menu'=>'active');
         return view('practitioner.email-group.edit')->with('meta', $meta)->with('cg', $cg);

         $meta = array('page_title'=>'Edit Group');

         return view('practitioner.email-group.edit')->with('meta', $meta)
             ->with('template_menu', 'active')->with('cg', $cg);

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
