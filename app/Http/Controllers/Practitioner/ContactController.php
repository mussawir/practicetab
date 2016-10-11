<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\Contact;
use App\Models\ContactGroup;
use App\Models\ContactInGroup;
use App\Models\Practitioner;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
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
        $contact_list = DB::table("contacts AS c")
            ->join("contacts_in_groups AS cg", "cg.cnt_id", "=", "c.cnt_id")
            ->join("contact_groups AS g", "g.cg_id", "=", "cg.cg_id")
            ->select('c.*',
                DB::raw('GROUP_CONCAT(g.name SEPARATOR \', \') as groups'))
            ->where('c.pra_id', '=', $this->practitioner_info->pra_id)
            ->groupBy('c.cnt_id')
            ->get();

        $meta = array('page_title'=>'Contact List', 'cm_main_menu'=>'active', 'cnt_sub_menu_list'=>'active');

        return view('practitioner.contact.index')->with('meta', $meta)->with('contact_list', $contact_list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cg_list = ContactGroup::where('pra_id', '=', $this->practitioner_info->pra_id)->get();
        $meta = array('page_title'=>'Create New Contact', 'cm_main_menu'=>'active', 'cnt_sub_menu_new'=> 'active');

        return view('practitioner.contact.new')->with('meta', $meta)->with('cg_list', $cg_list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->toArray(), [
            'first_name' => 'required|max:20',
            'email' => 'required|email|max:50',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        $filename = '';
        if($request->hasFile('photo')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file = $request->file('photo');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();

            $file->move(public_path().'/dashboard/img/contact-img/', $filename);
        }

        $input['photo'] = $filename;
        $input['pra_id'] = $this->practitioner_info->pra_id;
        $contact = Contact::create($input);

        if(isset($request->cg_id) && (count($request->cg_id)>0)){
            foreach ($request->cg_id  as $cg_id)
            ContactInGroup::create([
                'cg_id' =>  $cg_id,
                'cnt_id' => $contact['cnt_id']
            ]);
        }

        Session::put('success','Contact saved successfully!');

        return Redirect::Back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        $contact = Contact::find($id);
        $cg_list = ContactGroup::where('pra_id', '=', $this->practitioner_info->pra_id)->get();
        $contact_groups = ContactInGroup::select('cg_id')->where('cnt_id', '=', $id)->get();
        $meta = array('page_title'=>'Edit Contact', 'cm_main_menu'=>'active');

        return view('practitioner.contact.edit')->with('meta', $meta)
            ->with('contact', $contact)
            ->with('cg_list', $cg_list)
            ->with('contact_groups', $contact_groups);
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
        $validator = \Validator::make($request->toArray(), [
            'first_name' => 'required|max:20',
            'email' => 'required|email|max:50',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $contact = Contact::find($request->cnt_id);

        $filename = '';
        if($request->hasFile('photo')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file = $request->file('photo');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();

            if (isset($contact->photo) && (!empty($contact->photo))) {
                unlink(public_path() . '/dashboard/img/contact-img/' . $contact->photo);
            }

            $file->move(public_path().'/dashboard/img/contact-img/', $filename);
        } else {
            $filename = $request->saved_photo;
        }

        $contact->photo = $filename;
        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->cell = $request->cell;
        $contact->address = $request->address;
        $contact->note = $request->note;
        $contact->save();

        if(isset($request->cg_id) && (count($request->cg_id)>0)){
            ContactInGroup::where('cnt_id', '=', $request->cnt_id)->delete();

            foreach ($request->cg_id  as $cg_id)
                ContactInGroup::create([
                    'cg_id' =>  $cg_id,
                    'cnt_id' => $request->cnt_id
                ]);
        }

        Session::put('success','Contact update successfully!');

        return Redirect::to('/practitioner/contact');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        if(isset($contact)){
            if (isset($contact->photo) && (!empty($contact->photo))) {
                unlink(public_path() . '/dashboard/img/contact-img/' . $contact->photo);
            }

            $contact->delete();
            ContactInGroup::where('cnt_id', '=', $id)->delete();

            Session::put('success','Contact deleted successfully!');
            //return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }
}
