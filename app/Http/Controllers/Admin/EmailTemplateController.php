<?php

namespace App\Http\Controllers\Admin;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class EmailTemplateController extends Controller
{
    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = EmailTemplate::select('*')->where('user_id', Auth::user()->user_id)->where('user_type', '1')
            ->orderBy('created_at', 'desc')->get();

        return view('admin.email-template.index')->with('list', $list)
            ->with('meta', array('page_title'=>'Email Template List','item_counter'=>isset($list)?count($list):0))
            ->with('template_menu','active')
            ->with('templates_list','active');
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.email-template.new')
            ->with('meta', array('page_title'=>'New Email Template','item_counter'=>0))
            ->with('template_menu','active')
            ->with('new_template','active');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
                $validator = \Validator::make($request->toArray(), [
                    'category' => 'required|max:100'
                ]);
                if ($validator->fails()) {
                    return Redirect::back()->withErrors($validator)->withInput();
                }
        */
        $input = $request->all();
        $input['user_id'] = Auth::user()->user_id;
        $input['user_type'] = '1'; // 1 defined admin, 2 defined practitoner
        EmailTemplate::create($input);

        Session::put('success','New Email Template is created successfully!');
        return Redirect::to('/admin/email-templates');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = EmailTemplate::find($id);
        return view('admin.email-template.view')
            ->with('data', $data)
            ->with('meta', array('page_title'=>'View Email Template','item_counter'=>0))
            ->with('template_menu','active');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = EmailTemplate::find($id);
        return view('admin.email-template.edit')
            ->with('data', $data)
            ->with('meta', array('page_title'=>'Edit Email Template','item_counter'=>0))
            ->with('template_menu','active');
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
        /*
                $validator = \Validator::make($request->toArray(), [
                    'name' => 'required|max:100'
                ]);

                if ($validator->fails()) {
                    return Redirect::back()->withErrors($validator)->withInput();
                }
        */

        $table1 = EmailTemplate::find($request->et_id);
        $table1->name = $request->name;
        $table1->template = $request->template;
        $table1->save();

        Session::put('success','Email template updated successfully!');
        return Redirect::to('/admin/email-templates/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table1 = EmailTemplate::find($id);
        if(isset($table1)){
            $table1->delete();
            
            Session::put('success','Email template is deleted successfully!');
            //return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }
}
