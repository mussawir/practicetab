<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\Contact;
use App\Models\EmailInGroup;
use App\Models\EmailGroup;
use App\Models\Practitioner;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Http\Requests;
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
        // $cg_list = ContactGroup::where('pra_id', '=', $this->practitioner_info->pra_id)->get();
        // $meta = array('page_title'=>'Group List', 'cm_main_menu'=>'active', 'cg_sub_menu_list'=>'active');

        // return view('practitioner.contact-group.index')->with('meta', $meta)->with('cg_list', $cg_list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meta = array('page_title'=>'New Email Group', 'cm_main_menu'=>'active', 'cg_sub_menu_new'=> 'active');
        $patients = Patient::select('*')->orderBy('first_name', 'asc')->get();
        $contacts = Contact::where('pra_id', '=', $this->practitioner_info->pra_id)->get();
        return view('practitioner.email-group.new')->with('meta', $meta)
            ->with('patients', $patients)->with('contacts',$contacts);
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
            'name' => 'required|max:20'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

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

        Session::put('success','Email Group Created Successfully!');

        return Redirect::Back();

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
        // $cg = ContactGroup::find($id);
        // $meta = array('page_title'=>'Edit Group', 'cm_main_menu'=>'active');

        // return view('practitioner.contact-group.edit')->with('meta', $meta)->with('cg', $cg);
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
        // $validator = \Validator::make($request->toArray(), [
        //     'name' => 'required|max:50'
        // ]);

        // if ($validator->fails()) {
        //     return Redirect::back()->withErrors($validator)->withInput();
        // }

        // $cg = ContactGroup::find($request->cg_id);
        // $cg->name = $request->name;
        // $cg->description = $request->description;
        // $cg->save();

        // Session::put('success','Contact group updated successfully!');

        // return Redirect::to('/practitioner/contact-group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $cg = ContactGroup::find($id);
        // if(isset($cg)){
        //     $cg->delete();

        //     Session::put('success','Contact group deleted successfully!');
        //     //return response()->json(['status' => 'success']);
        // }
        // return response()->json(['status' => 'error']);
    }
}
