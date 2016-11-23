<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminContacts;
use App\Models\AdminGroup;
use App\Models\AdminInGroup;
use App\Models\Contact;
use App\Models\ContactGroup;
use App\Models\ContactInGroup;
use App\Models\EmailAdminContacts;
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
        $this->user_id = Auth::user()->user_id;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact_list = DB::table("admin_contacts AS c")
            ->join("admin_contacts_groups AS cg", "cg.cnt_id", "=", "c.cnt_id")
            ->join("admin_groups AS g", "g.ag_id", "=", "cg.ag_id")
            ->select('c.*',
                DB::raw('GROUP_CONCAT(g.name SEPARATOR \', \') as groups'))
            ->where('c.user_id', '=', $this->user_id)
            ->groupBy('c.cnt_id')
            ->get();
        $meta = array('page_title'=>'Contact List', 'cm_main_menu'=>'active', 'cnt_sub_menu_list'=>'active');
        return view('admin.contact.index')->with('meta', $meta)->with('contact_list', $contact_list);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cg_list = AdminGroup::where('user_id', '=', $this->user_id)->get();
        $meta = array('page_title'=>'Create New Contact', 'cm_main_menu'=>'active', 'cnt_sub_menu_new'=> 'active');

        return view('admin.contact.new')->with('meta', $meta)->with('cg_list', $cg_list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        $input['user_id'] = $this->user_id;
        $contact = AdminContacts::create($input);

        if(isset($request->cg_id) && (count($request->cg_id)>0)){
            foreach ($request->cg_id  as $cg_id){
            AdminInGroup::create([
                'ag_id' =>  $cg_id,
                'cnt_id' => $contact['cnt_id']
            ]);
            EmailAdminContacts::create([
                'ag_id' =>  $cg_id,
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'first_name' => $input['first_name'],
                'user_id' => $this->user_id,
                'primary_phone' => $input['primary_phone']
            ]);
            }
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
        $contact = AdminContacts::find($id);
        $cg_list = AdminGroup::where('user_id', '=', $this->user_id)->get();
        $contact_groups = AdminInGroup::select('ag_id')->where('cnt_id', '=', $id)->get();
        $meta = array('page_title'=>'Edit Contact', 'cm_main_menu'=>'active');

        return view('admin.contact.edit')->with('meta', $meta)
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

        $contact = AdminContacts::find($request->cnt_id);

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
        $contact->primary_phone = $request->phone;
        $contact->cell = $request->cell;
        $contact->address = $request->address;
        $contact->note = $request->note;
        $contact->save();

        if(isset($request->cg_id) && (count($request->cg_id)>0)){
            AdminInGroup::where('cnt_id', '=', $request->cnt_id)->delete();
            foreach ($request->cg_id  as $cg_id)
                AdminInGroup::create([
                    'ag_id' =>  $cg_id,
                    'cnt_id' => $request->cnt_id
                ]);
        }

        Session::put('success','Contact update successfully!');

        return Redirect::to('/admin/contact');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = AdminContacts::find($id);
        if(isset($contact)){
            if (isset($contact->photo) && (!empty($contact->photo))) {
                unlink(public_path() . '/dashboard/img/contact-img/' . $contact->photo);
            }

            $contact->delete();
            AdminInGroup::where('cnt_id', '=', $id)->delete();

            Session::put('success','Contact deleted successfully!');
            //return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }
}
