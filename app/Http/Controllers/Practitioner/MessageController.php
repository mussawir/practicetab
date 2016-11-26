<?php

namespace App\Http\Controllers\Practitioner;
use App\Models;
use App\Models\message_header;
use App\Models\message_history;
use App\Models\Patient;
use App\Models\Practitioner;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Dompdf\Exception;

class MessageController extends Controller
{
    var $practitioner_info = null;
    public function __construct()
    {
        $this->practitioner_info = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
        Session::set('marketing', 'active');
        Session::pull('management');
        Session::pull('dashboard');
    }
    public function index()
    {
        $practitioner = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();;
        $msg_from = $practitioner->pra_id;
        $patient = Patient::select('pa_id', 'first_name', 'last_name')->where('first_name','<>','""')->get();
        $messageHistory = message_header::select('*')->where('practitioner_id','=',$msg_from)
            ->where('practitioner_login_id','=',Auth::user()->user_id)
            ->get();
        $messageHistory = DB::table("message_header AS MH")
            ->join("patients AS pra", "pra.pa_id", "=", "MH.patient_id")
            ->select('MH.*','pra.first_name','pra.last_name')
            ->where('MH.practitioner_id','=',$msg_from)
            ->where('MH.practitioner_login_id','=',Auth::user()->user_id)
            ->get();
        return view('practitioner.message.pa-message')->with('patient', $patient)->with('messageHistory',$messageHistory)
            ->with('meta', array('page_title'=>'Message'))
            ->with('message','active')
            ->with('send_message','active')
            ;
    }
    public function ifExist($practitioner_id,$practitioner_login_id,$patient_id,$patient_login_id)
    {
        if (message_header::where([
            ['patient_id', '=', $patient_id],
            ['patient_login_id', '=', $patient_login_id],
            ['practitioner_id', '=', $practitioner_id],
            ['practitioner_login_id', '=', $practitioner_login_id]
            ,])->exists()) {
            $msg_id = message_header::where('patient_id', '=', $patient_id)
                ->where('patient_login_id', '=', $patient_login_id)
                ->where('practitioner_id', '=', $practitioner_id)
                ->where('practitioner_login_id', '=', $practitioner_login_id)
                ->first();;

            return  $msg_id->id;
        }
        else
        {
            return '';
        }
    }
    public function DynamicMessages(Request $request)
    {
        $id = $request->pa_id;
        $chatRestrict = isset($request->chatRestrict) ? $request->chatRestrict : '';
        $practitioner = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
        $msg_from = $practitioner->pra_id;
        $msg_id = message_header::select('*')->where('patient_id','=',$id)->where('practitioner_id','=',$msg_from)->first();
        if(!isset($msg_id)) return '';
        if($chatRestrict=="today") {
            $date = date("Y-m-d");
            $msg_history = message_history::select('*')->where('msg_id', '=', $msg_id->id)
                ->where('created_at','LIKE','%'.$date.'%')
                ->get();
        }
        else {
            $msg_history = message_history::select('*')->where('msg_id', '=', $msg_id->id)->get();
        }
        if(!isset($msg_history)) return '';
        $appender = '';
        $liClass= '';
        foreach ($msg_history as $msgs)
        {
            $picPath = asset('public/img/no-user.jpg');
            $pa_det = Patient::where('pa_id', '=', $msg_id->patient_id)->first();;
            if(isset($pa_det->photo) && (!empty($pa_det->photo)))
            {
                $directory = $practitioner->directory;
                if($directory!="") $directory = $directory .'/';
                $picPath = asset('public/practitioners/'.$directory.$pa_det->photo);
            }
            $pa_det = Patient::where('pa_id', '=', $msg_id->patient_id)->first();;
            $liClass = strpos($msgs->sent_by, 'pra') !== false ? 'right' : 'left';
            if($liClass=='left') {
                $appender .= '<li class="' . $liClass . '">';
                $formatteddate = date("m/d/Y", strtotime($msgs->created_at));
                $appender .= '<span class="date-time">' .$formatteddate .' '. date("H:i", strtotime($msgs->created_at)) . '</span>';
                $appender .= '<a href="#" class="name">'.$pa_det->first_name . ' '. $pa_det->last_name .'</a>';
                $appender .= '<a href="javascript:;" class="image"><img alt="" src="'.$picPath.'"></a>';
                $appender .= '<div class="message">';
                $appender .= $msgs->message;
                $appender .= '</div>';
                $appender .= '</li>';
            }
            if($liClass=='right')
            {
                $directory= '';
                if(isset($practitioner->photo) && (!empty($practitioner->photo)))
                {$directory = $practitioner->directory;
                    if($directory!="") $directory = $directory .'/';
                    $picPath = asset('public/practitioners/'.$directory.$practitioner->photo);
                    //$picPath = public_path().'\\practitioners\\peter222220\\'.$directory.$patient->photo;
                }
                else {$picPath = asset('public/img/no-user.jpg');}
                $appender.='<li class="right">';
                $formatteddate = date("m/d/Y", strtotime($msgs->created_at));
                $appender .= '<span class="date-time">' .$formatteddate .' '.  date("H:i", strtotime($msgs->created_at)) . '</span>';
                $appender.='<a href="#" class="name"><span class="label label-primary">Me</span> Me</a>';
                $appender.='<a href="javascript:;" class="image"><img alt="" src="'.$picPath.'"></a>';
                $appender.='<div class="message">';
                $appender .= $msgs->message;
                $appender.='</div>';
                $appender.='</li>';
            }
        }
        echo $appender;
    }
    public function sendMessage(Request $request)
    {
        try {
            $practitioner = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();;
            $practitioner_id = $practitioner->pra_id;
            $practitioner_login_id = $practitioner->user_id;
            $patient = Patient::where('pa_id', '=', $request->pa_id)->first();;
            $patient_id = $patient->pa_id;
            $patient_login_id = $patient->user_id;
            $msg_date = $request->msg_date;
            $msg_header = new message_header();
            $msg_header->practitioner_id = $practitioner_id;
            $msg_header->practitioner_login_id = $practitioner_login_id;
            $msg_header->patient_id = $patient_id;
            $msg_header->patient_login_id = $patient_login_id;
            $msg_header->msg_date = $msg_date;
            $headerExist = $this->ifExist($practitioner_id,$practitioner_login_id,$patient_id,$patient_login_id);
            $msg_id = '';
            if($headerExist=="")
            {$msg_header->save();
            $msg_id = $msg_header->id;
            }
            else
            {
                $msg_id = $headerExist;
            }
        }
        catch(Exception $ex)
        {
            return 'Some error occured';
        }
        try {
            $this->saveMessage($msg_id, $request->message,'pra_'.$practitioner_id,$this->getMessageSerial($msg_id));
        }
        catch (Exception $exx)
        {
            return 'Some error occured';
        }
        return 'Message Sent Successfully';
    }
    public function saveMessage($msg_id,$message,$sent_by='',$serial=1)
    {
        $message_history = new message_history();
        $message_history->msg_id = $msg_id;
        $message_history->message = $message;
        $message_history->sent_by = $sent_by;
        $message_history->serial = $serial;
        $message_history->save();
    }
    public function getMessageSerial($msg_id)
    {
        $returnn=0;
        //$msg_header = message_history::where('msg_id', '=',$msg_id)->first();;
        $msg_header = DB::table('message_history')->where('msg_id', '=',$msg_id)->max('serial');

        $returnn = $msg_header;
        return $returnn+1;
    }
    public function MessageHistory()
    {
        $practitioner = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();;
        $msg_from = $practitioner->pra_id;
        $messageHistory = DB::table("message_header AS MH")
            ->join("patients AS pra", "pra.pa_id", "=", "MH.patient_id")
            ->select('MH.*','pra.first_name','pra.last_name')
            ->where('MH.practitioner_id','=',$msg_from)
            ->where('MH.practitioner_login_id','=',Auth::user()->user_id)
            ->get();
        return view('practitioner.message.pa-message-history')->with('messageHistory',$messageHistory)
            ->with('meta', array('page_title'=>'Message'))
            ->with('message','active')
            ->with('message_history','active')
            ;
    }
}
