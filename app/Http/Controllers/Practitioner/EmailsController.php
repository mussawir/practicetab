<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\ContactGroup;
use App\Models\EmailGroup;
use App\Models\EmailInGroup;
use App\Models\EmailTemplate;
use App\Models\Patient;
use App\Models\Practitioner;
use App\Models\PractitionerCampaign;
use App\Models\PractitionerEmail;
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
        $this->practitioner_info = Session::get('practitioner_session');
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

        $templates = EmailTemplate::select('*')->where('user_id','=',$prac['pra_id'])->whereIn('user_type', [1,2])
            ->orderBy('name', 'asc')->get();
        $contact_groups = EmailGroup::where('user_id',$this->practitioner_info->pra_id)->where('user_type', '2')->get();

        return view('practitioner.emails.new')
            ->with('meta', array('page_title'=>'Compose New Email'))
            ->with('templates', $templates)
            ->with('contact_groups', $contact_groups)
            ->with('template_menu','active')
            ->with('compose_email','active');
    }
    public function create_campaign(){
        $templates = EmailTemplate::select('*')->where('user_id','=',$this->practitioner_info->pra_id)->whereIn('user_type', [1,2])->orderBy('name', 'asc')->get();
        $contact_groups = EmailGroup::where('user_id',$this->practitioner_info->pra_id)->where('user_type', '2')->get();

        return view('practitioner.emails.campaign')
            ->with('meta', array('page_title'=>'Create New Campaign'))
            ->with('templates', $templates)
            ->with('contact_groups',$contact_groups)
            ->with('template_menu','active')
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

        $email = EmailInGroup::select('email')->where('cg_id', $inputs['cg_id'])->get();
        $group = EmailInGroup::select('group_name')->where('cg_id', $inputs['cg_id'])->get()->first();

        $subject = $inputs['subject'];

        if(isset($email)){
        foreach($email as $key => $value) {
            $placeholders = array('PR.FirstName', 'PR.MiddleName', 'PR.LastName', 'PR.Email', 'PR.Phone',
                'PA.FirstName', 'PA.MiddleName', 'PA.LastName', 'PA.Email', 'PA.Phone');

            $prac = Session::get('practitioner_session');
            $pr = Practitioner::select('first_name', 'middle_name', 'last_name', 'email', 'primary_phone')
                ->where('pra_id', '=', $prac['pra_id'])->first();
            $pa = EmailInGroup::select('first_name', 'middle_name', 'last_name', 'email', 'primary_phone')
                ->where('cg_id',$inputs['cg_id'])->where('email', '=', $value->email)->first();
            $replace_with = array($pr->first_name, $pr->middle_name, $pr->last_name, $pr->email, $pr->primary_phone,
                $pa->first_name, $pa->middle_name, $pa->last_name, $pa->email, $pa->primary_phone);
            $mail_body = preg_replace('/\{[^}]*\)|[{}]/', '', $inputs['mail_body']);
            $mail_body = str_replace($placeholders, $replace_with, $mail_body);
            $data = [
                'messagebody'=>  $mail_body,
            ];
            Mail::send(['html' => 'practitioner.emails.emailbody'], $data, function ($message) use ($value , $subject) {
                $message->from('postmaster@practicetabs.com', 'Practice Tabs');
                $message->to($value->email);
                $message->subject($subject);
                });
            }
        }
        PractitionerEmail::create([
            'pra_id'	=>	$this->practitioner_info->pra_id,
            'sent_to' => $group->group_name,
            'subject' => $inputs['subject'],
            'message'	=>	$inputs['mail_body']
        ]);
        Session::put('success',"Email Successfully Sent to $group->group_name ");
        return Redirect::back();
       }
    public function sentList()
    {
        $list = PractitionerEmail::where('pra_id','=',$this->practitioner_info->pra_id)->get();
        return view('practitioner.emails.simplelist')->with('list',$list)->with('sent_mails','active')
            ->with('template_menu','active');
    }
    public function sentDetails($id)
    {
        $data = PractitionerEmail::find($id);
        $name = PractitionerEmail::select('sent_to')->where('pe_id',$id)->get()->first();
        $contacts = EmailInGroup::where('group_name',$name->sent_to)->get();
        return view('practitioner.emails.sentdetails')
            ->with('data', $data)->with('contacts',$contacts)
            ->with('template_menu','active');
    }
    public function store_campaign(Request $request)
    {
        $group_name = EmailGroup::where('cg_id',$request->cg_id)->get()->first();
        $campaign = new PractitionerCampaign();
        $campaign->campaign_name = $request->campaign_name;
        $campaign->start_date = $request->start_date;
        $campaign->end_date = $request->stop_date;
        $campaign->sent_to = $request->cg_id;
        $campaign->group_name = $group_name['name'];
        $campaign->message = $request->mail_body;
        $campaign->status = '0';
        $campaign->user_id = $this->practitioner_info->pra_id;
        $campaign->save();
        Session::put('success',"Email Campaign will get started on $request->start_date ");
        return Redirect::back();
//
    }
    public function campaignList(){
        $list = PractitionerCampaign::where('user_id',$this->practitioner_info->pra_id)->get();
        return view('practitioner.emails.campaignlist')
            ->with('list', $list)
            ->with('template_menu','active')
            ->with('campaign_lists','active')->with('campaignlists','active');
    }
    public function campaignDetails($id)
    {
        $data = PractitionerCampaign::find($id);
        $contacts = EmailInGroup::where('cg_id',$data->sent_to)->get();
        return view('practitioner.emails.campaigndetails')
            ->with('contacts',$contacts)
            ->with('data', $data)
            ->with('email_marketing','active');
    }
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
