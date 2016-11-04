<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\ContactGroup;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class EmailsController extends Controller
{
    public function __construct()
    {
        Session::set('marketing', 'active');
        Session::pull('management');
        Session::pull('dashboard');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = EmailTemplate::select('*')->orderBy('name', 'asc')->get();
        $list  = array();
        return view('practitioner.emails.index')->with('templates', $templates)
            ->with('meta', array('page_title'=>'Email List',isset($list)?count($list):0))
            ->with('template_menu','active')
            ->with('sent_mails','active');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prac = Session::get('practitioner_session');

        $templates = EmailTemplate::select('*')->orderBy('name', 'asc')->get();
        $contact_groups = ContactGroup::select('cg_id', 'name')->where('pra_id','=',$prac['pra_id'])
            ->orderBy('name', 'asc')->get();

        return view('practitioner.emails.new')
            ->with('meta', array('page_title'=>'Compose New Email'))
            ->with('templates', $templates)
            ->with('contact_groups', $contact_groups)
            ->with('template_menu','active')
            ->with('compose_email','active');
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
        $prac = Session::get('practitioner_session');
        $input['pra_id'] = $prac['pra_id'];
        EmailTemplate::create($input);

        Session::put('success','New Email Template is created successfully!');
        return Redirect::to('/practitioner/email-templates');
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
        $data = EmailTemplate::find($id);
        return view('practitioner.email-template.edit')
            ->with('data', $data)
            ->with('meta', array('page_title'=>'Edit Email Template'))
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
        return Redirect::to('/practitioner/email-templates/');
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
