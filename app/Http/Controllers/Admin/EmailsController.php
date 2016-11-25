<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminCampaign;
use App\Models\AdminContacts;
use App\Models\AdminEmail;
use App\Models\AdminGroup;
use App\Models\AdminInGroup;
use App\Models\EmailAdminContacts;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class EmailsController extends Controller
{
    public function __construct()
    {
        $this->user_id = Auth::user()->user_id;
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
        return view('admin.emails.index')->with('templates', $templates)
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

        $templates = EmailTemplate::select('*')->where('user_id','=',Auth::user()->user_id)->where('user_type', '1')->orderBy('name', 'asc')->get();
        $contact_groups = AdminGroup::where('user_id',$this->user_id)->get();

        return view('admin.emails.new')
            ->with('meta', array('page_title'=>'Compose New Email'))
            ->with('templates', $templates)
            ->with('contact_groups', $contact_groups)
            ->with('email_marketing','active')
            ->with('compose_email','active');
    }
    public function create_campaign()
    {
        $templates = EmailTemplate::select('*')->where('user_id','=',Auth::user()->user_id)->where('user_type', '1')->orderBy('name', 'asc')->get();
        $contact_groups = AdminGroup::where('user_id',$this->user_id)->get();

        return view('admin.emails.campaign')
            ->with('meta', array('page_title'=>'Create New Campaign'))
            ->with('templates', $templates)
            ->with('contact_groups',$contact_groups)
            ->with('email_marketing','active')
            ->with('campaign','active');
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
        $inputs = $request->all();
        $grp_id = AdminInGroup::select('cnt_id')->where('ag_id',$inputs['ag_id'])->get();
        $group = AdminGroup::where('ag_id', $inputs['ag_id'])->get()->first();
        $subject = $inputs['subject'];
        if(isset($grp_id)){
            foreach ($grp_id as $key => $value){
                $placeholders = array('AD.FirstName', 'AD.MiddleName', 'AD.LastName', 'AD.Email', 'AD.Phone',
                    'CN.FirstName', 'CN.MiddleName', 'CN.LastName', 'CN.Email', 'CN.Phone');
                $contacts = AdminContacts::select('first_name', 'middle_name', 'last_name', 'email', 'primary_phone')
                    ->where('cnt_id', '=', $value->cnt_id)->first();
                $replace_with = array(Auth::user()->first_name, Auth::user()->middle_name, Auth::user()->last_name, Auth::user()->email, Auth::user()->phone,
                    $contacts->first_name, $contacts->middle_name, $contacts->last_name, $contacts->email, $contacts->primary_phone);
                $mail_body = preg_replace('/\{[^}]*\)|[{}]/', '', $inputs['mail_body']);
                $mail_body = str_replace($placeholders, $replace_with, $mail_body);
                $data = [
                    'messagebody'=>  $mail_body,
                ];
                Mail::send(['html' => 'admin.emails.emailbody'], $data, function ($message) use ($contacts , $subject) {
                    $message->from('valeedmahmood@gmail.com', 'Practice Tabs');
                    $message->to($contacts->email);
                    $message->subject($subject);
                });
            }
        }
        AdminEmail::create([
            'user_id'	=>	Auth::user()->user_id,
            'sent_to' => $group->ag_id,
            'group_name' => $group->name,
            'subject' => $inputs['subject'],
            'message'	=>	$inputs['mail_body']
        ]);
        Session::put('success',"Email Successfully Sent!");
        return Redirect::back();
       }

    public function sentList()
    {
        $list = AdminEmail::where('user_id','=',$this->user_id)->get();
        return view('admin.emails.simplelist')->with('list',$list)->with('email_marketing','active')
            ->with('sent_mails','active');
    }

    public function sentDetails($id)
    {
        $data = AdminEmail::find($id);
        $name = AdminEmail::where('ae_id',$id)->get()->first();
        $contacts = EmailAdminContacts::where('ag_id',$name->sent_to)->get();
        return view('admin.emails.sentdetails')
            ->with('contacts',$contacts)
            ->with('data', $data)
            ->with('email_marketing','active');
    }

    public function store_campaign(Request $request)
    {
        $group_name = AdminGroup::where('ag_id',$request->ag_id)->get()->first();
        $campaign = new AdminCampaign;
        $campaign->campaign_name = $request->campaign_name;
        $campaign->start_date = $request->start_date;
        $campaign->end_date = $request->stop_date;
        $campaign->sent_to = $request->ag_id;
        $campaign->group_name = $group_name['name'];
        $campaign->message = $request->mail_body;
        $campaign->status = '0';
        $campaign->user_id = $this->user_id;
        $campaign->save();
        Session::put('success',"Email Campaign will get started on $request->start_date ");
        return Redirect::back();
//
    }
    public function campaignList(){
        $list = AdminCampaign::where('user_id',$this->user_id)->get();
        return view('admin.emails.campaignlist')
            ->with('list', $list)
            ->with('email_marketing','active')
            ->with('campaign_lists','active');
    }
    public function campaignDetails($id)
    {
        $data = AdminCampaign::find($id);
        $contacts = EmailAdminContacts::where('ag_id',$data->sent_to)->get();
        return view('admin.emails.campaigndetails')
            ->with('contacts',$contacts)
            ->with('data', $data)
            ->with('email_marketing','active');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


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
