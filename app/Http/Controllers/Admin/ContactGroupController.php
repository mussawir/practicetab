<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminGroup;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ContactGroupController extends Controller
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
        $cg_list = AdminGroup::where('user_id', $this->user_id)->get();
        $meta = array('page_title'=>'Group List', 'cm_main_menu'=>'active', 'cg_sub_menu_list'=>'active');
        return view('admin.contact-group.index')->with('meta', $meta)->with('cg_list', $cg_list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meta = array('page_title'=>'Create New Group', 'cm_main_menu'=>'active', 'cg_sub_menu_new'=> 'active');
        return view('admin.contact-group.new')->with('meta', $meta);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin_groups = new AdminGroup;
        $admin_groups->user_id = $this->user_id;
        $admin_groups->name = $request->name;
        $admin_groups->description = $request->description;
        $admin_groups->save();
        Session::put('success','Contact group saved successfully!');
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
        $cg = AdminGroup::find($id);
        $meta = array('page_title'=>'Edit Group', 'cm_main_menu'=>'active');

        return view('admin.contact-group.edit')->with('meta', $meta)->with('cg', $cg);
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
        $cg = AdminGroup::find($request->ag_id);
        $cg->name = $request->name;
        $cg->description = $request->description;
        $cg->save();

        Session::put('success','Contact group updated successfully!');

        return Redirect::to('/admin/contact-group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cg = AdminGroup::find($id);
        if(isset($cg)){
            $cg->delete();

            Session::put('success','Contact group deleted successfully!');
            //return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }
}
