<?php
namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
use App\Models\message_header;
use App\Models\message_history;
=======
use App\Models\ExerciseRequest;
use App\Models\ExerciseRequestDetail;
use App\Models\Exercises;
>>>>>>> 240b3a4a6faddd8fe2fc494c914f0a94baf6dd13
use App\Models\Nutrition;
use App\Models\NutritionRequest;
use App\Models\NutritionRequestDetail;
use App\Models\Patient;
use App\Models\SupplementRequest;
use App\Models\SupplementRequestDetail;
use App\Models\SupSuggestionsMaster;
use App\Models\SuggestionsSearch;
use Dompdf\Exception;
use Illuminate\Http\Request;
use App\Http\Requests\ChangePassFormRequest;
use App\Models\Practitioner;
use App\Models\Supplement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\scheduler;
/**
 * IndexController
 *
 * Controller to house all the functionality directly
 * related to the ModuleOne.
 */
class IndexController extends Controller
{
	var $patient_info = null;
	public function __construct()
	{
		$this->patient_info = Patient::where('user_id', '=', Auth::user()->user_id)->first();
	}

	public function index()
	{
		// module:patient
		// view folder name: index
		// file: index

		/* Supplement Suggestions from practitioner */
		$sup_sug_master = SuggestionsSearch::where('sug_type', '=', 1)
			->where("pa_ids", "LIKE", "%{$this->patient_info->pa_id}%")->get();

		/* Nutrition Suggestions from practitioner */
		$nut_sug_master = SuggestionsSearch::where('sug_type', '=', 2)
			->where("pa_ids", "LIKE", "%{$this->patient_info->pa_id}%")->get();

		return view('patient.index.index')->with('sup_sug_master', $sup_sug_master)
			->with('nut_sug_master', $nut_sug_master);
	}

	public function supplementSuggestionDetails($id)
	{
		$sup_sug_master = SuggestionsSearch::where('id', $id)->first();
		$supplements = Supplement::select('sup_id', 'name', 'used_for', 'main_image','long_description')
			->whereIn('sup_id', json_decode($sup_sug_master->sup_ids))->get();

		return view('patient.index.sup-sug-details')->with('sup_sug_master', $sup_sug_master)
			->with('supplements', $supplements);
	}

	public function nutritionSuggestionDetails($id)
	{
		$nut_sug_master = SuggestionsSearch::where('id', $id)->first();
		$nutrition = Nutrition::select('nut_id', 'name', 'usability', 'main_image')
			->whereIn('nut_id', json_decode($nut_sug_master->nut_ids))->get();

		return view('patient.index.nut-sug-details')->with('nut_sug_master', $nut_sug_master)
			->with('nutrition', $nutrition);
	}

	public function createSupplementRequest()
	{
		$practitioners = DB::table('practitioners as p')
			->join("users AS u", "u.user_id", "=", "p.user_id")
			->select('p.pra_id', 'u.first_name', 'u.last_name')
			->where('u.role', '=', 3)
			->get();
		$supplements = Supplement::select('sup_id', 'name', 'used_for', 'main_image')->get();

		return view('patient.index.supplement-request')
			->with('practitioners', $practitioners)
			->with('supplements', $supplements);
	}

	public function saveSupplementRequest(Request $request)
	{
		if(isset($request->sup_id)){
			if($request->method('post')){
				$sup_request = SupplementRequest::create([
					'pa_id'		=>	$this->patient_info->pa_id,
					'pra_id'	=>	$request->pra_id,
					'title'		=>	$request->title,
					'message'	=>	$request->message,
					'status' => '0'
				]);

				if(isset($request->sup_id) && (count($request->sup_id)>0)){
					foreach ($request->sup_id as $id) {
						SupplementRequestDetail::create([
							'sr_id' 	=>	$sup_request['sr_id'],
							'sup_id'	=>	$id
						]);
					}
				}

				Session::put('success', 'Request send successfully!');
			}

			return Redirect::Back();
		}else{
			Session::put('error','Please select one supplement');
			return redirect::back();
		}

	}
	public function supplementRequestList(){
		$request = SupplementRequest::where('pa_id',$this->patient_info->pa_id)->get();
		return view('patient.index.supplement-requests-list')->with('request', $request);
	}
	public function createNutritionRequest()
	{
		$practitioners = DB::table('practitioners as p')
			->join("users AS u", "u.user_id", "=", "p.user_id")
			->select('p.pra_id', 'u.first_name', 'u.last_name')
			->where('u.role', '=', 3)
			->get();
		$nutrition = Nutrition::select('nut_id', 'name', 'usability', 'main_image')->get();

		return view('patient.index.nutrition-request')
			->with('practitioners', $practitioners)
			->with('nutrition', $nutrition);
	}

	public function saveNutritionRequest(Request $request)
	{
		if(isset($request->nut_id)){
			if($request->method('post')){
				$sup_request = NutritionRequest::create([
					'pa_id'		=>	$this->patient_info->pa_id,
					'pra_id'	=>	$request->pra_id,
					'title'		=>	$request->title,
					'message'	=>	$request->message,
					'status' => '0'
				]);

				if(isset($request->nut_id) && (count($request->nut_id)>0)){
					foreach ($request->nut_id as $id) {
						NutritionRequestDetail::create([
							'nr_id' 	=>	$sup_request['nr_id'],
							'nut_id'	=>	$id
						]);
					}
				}

				Session::put('success', 'Request sent successfully!');
			}

			return Redirect::Back();
		}else{
			Session::put('error', 'Please select atleast one nutrition');
			return Redirect::Back();
		}

	}
	public function nutritionRequestList(){
		$request = NutritionRequest::where('pa_id',$this->patient_info->pa_id)->get();
		return view('patient.index.nutrition-requests-list')->with('request', $request);
	}
	public function createExerciseRequest()
	{
		$practitioners = DB::table('practitioners as p')
			->join("users AS u", "u.user_id", "=", "p.user_id")
			->select('p.pra_id', 'u.first_name', 'u.last_name')
			->where('u.role', '=', 3)
			->get();
		$exercise = Exercises::select('exe_id', 'heading', 'description', 'image1')->get();

		return view('patient.index.exercise-request')
			->with('practitioners', $practitioners)
			->with('exercise', $exercise);
	}

	public function saveExerciseRequest(Request $request)
	{
		if(isset($request->exe_id)){
			if($request->method('post')){
				$sup_request = ExerciseRequest::create([
					'pa_id'		=>	$this->patient_info->pa_id,
					'pra_id'	=>	$request->pra_id,
					'title'		=>	$request->title,
					'message'	=>	$request->message,
					'status' => '0'
				]);

				if(isset($request->exe_id) && (count($request->exe_id)>0)){
					foreach ($request->exe_id as $id) {
						ExerciseRequestDetail::create([
							'er_id' 	=>	$sup_request['er_id'],
							'exe_id'	=>	$id
						]);
					}
				}

				Session::put('success', 'Request sent successfully!');
			}

			return Redirect::Back();
		}else{
			Session::put('error', 'Please select atleast one exercise');
			return Redirect::Back();
		}

	}
	public function exerciseRequestList(){
		$request = ExerciseRequest::where('pa_id',$this->patient_info->pa_id)->get();
		return view('patient.index.exercise-requests-list')->with('request', $request);
	}
	public function suggestionDetails()
	{
		$supplements = Supplement::select('sup_id', 'name', 'main_image')->get();
		return view('patient.index.suggestion-details')->with('supplements', $supplements);
	}

	public function changePassword()
	{
		return view('patient.index.change-password');
	}
	public function requestSchedule(Request $request)
    {
        $scheduler = new scheduler();
        $patient = Patient::where('user_id', '=', Auth::user()->user_id)->first();;
        $scheduler->patient_id = $patient->first_name . ' ' . $patient->middle_name.' '.$patient->last_name;
        $scheduler->reason = $request->pDesc;
        $scheduler->pDate = $request->pDate;
        $scheduler->pTime = $request->pTime;
        $scheduler->pDuration = $request->pDuration;
        $scheduler->pstatus = $request->ptype;
        $scheduler->app_desc = $request->pDesc;
        $scheduler->practitioner_id = $request->practitioner_id;
        $scheduler->save();
    }
    public function Fetchschedule(Request $request)
    {
        $patient = Patient::where('user_id', '=', Auth::user()->user_id)->first();;
        $scheduler = DB::table('scheduler')
            ->where('practitioner_id', '=', $request->practitionerId)
            ->where('pDate', '<=', $request->reqDate)
            ->where('patient_id','=',$patient->first_name . ' ' . $patient->middle_name.' '.$patient->last_name)
            //->where ('pStatus','<>','13')
            ->get();

        foreach ($scheduler as $schedule)
        {
            echo $schedule->id .' ) '.$schedule->patient_id;
            echo ';';
            echo $schedule->pDate;
            echo ';';
            echo $schedule->pTime;
            echo ';';
            echo $schedule->pDuration;
            echo ';';
            echo $schedule->pColor;
            echo '|';
        }
    }
	public function saveNewPassword(ChangePassFormRequest $request)
	{
		$user = User::find(Auth::user()->user_id);
		$user->password = bcrypt($request['new_password']);
		$user->save();

		Session::put('success', 'Your password has been changed successfully!');
		return Redirect::Back();
	}
    public function appointmentHistory()
    {
        $schedulerTable = scheduler::select('*')->orderBy('pDate', 'asc')->get();
        //$user = User::find(Auth::user()->user_id);
        return view('patient.index.appointmentHistory')->with('schedulerTable', $schedulerTable)
            ->with('meta', array('page_title'=>'Appointment History',isset($schedulerTable)?count($schedulerTable):0));

    }
    public function getAppointment()
    {
        return view('patient.index.getAppointment');
    }
    public function getNotification(Request $request)
    {

        $patient = Patient::where('user_id', '=', Auth::user()->user_id)->first();;
        $scheduler = DB::table('scheduler')
            ->where('pDate', '>=',  date('m/d/Y'))
            ->where('patient_id','=',$patient->first_name . ' ' . $patient->middle_name.' '.$patient->last_name)
            ->where('notify_cancel','=',0)
            ->where ('pStatus','<>','13')
            ->get();
        $notificationDivClose = '</div>';
        foreach ($scheduler as $schedule)
        {
            //Main Div
            echo '<div class="alert alert-success fade in m-b-15" id="notify_'.$schedule->id.'">';
            //Child Divs
            echo '<strong>'.$schedule->pDate.'</strong>';
            echo '. Your Upcomming Appointment. Duration Will be <strong>'.$schedule->pDuration. ' </strong> minutes . Please be there on Time. Thankyou';
            echo '<a href="#">';
            echo '<span id="cancel_'.$schedule->id.'" onclick="hide('.$schedule->id.');" class="close" data-dismiss="alert">×</span>';
            echo '</a>';
            echo $notificationDivClose;
        }
    }
    public function hideNotification(Request $request)
    {
        $myId =  $request->scheduleId;
        $update = scheduler::find($myId);
        $update->notify_cancel = 1;
        $update->save();
    }
    public function MessageHistory()
    {
        $patient = Patient::where('user_id', '=', Auth::user()->user_id)->first();;
        $msg_from = $patient->pa_id;
        $messageHistory = DB::table("message_header AS MH")
            ->join("practitioners AS pra", "pra.pra_id", "=", "MH.practitioner_id")
            ->select('MH.*','pra.first_name','pra.last_name')
            ->where('MH.patient_id','=',$msg_from)
            ->where('MH.patient_login_id','=',Auth::user()->user_id)
            ->get();
        return view('patient.index.pa-message-history')->with('messageHistory',$messageHistory);
    }
    public function DynamicMessages(Request $request)
    {
        $id = $request->pra_id;
        $chatRestrict = isset($request->chatRestrict) ? $request->chatRestrict : '';
        $patient = Patient::where('user_id', '=', Auth::user()->user_id)->first();
        $msg_from = $patient->pa_id;
        $msg_id = message_header::select('*')->where('practitioner_id','=',$id)->where('patient_id','=',$msg_from)->first();
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

            $pra_det = Practitioner::where('pra_id', '=', $msg_id->practitioner_id)->first();;
            if(isset($pra_det->photo) && (!empty($pra_det->photo)))
            {$directory = $pra_det->directory;
                if($directory!="") $directory = $directory .'/';
                $picPath = asset('public/practitioners/'.$directory.$pra_det->photo);
                //$picPath = public_path().'\\practitioners\\peter222220\\'.$directory.$patient->photo;
            }
            $liClass = strpos($msgs->sent_by, 'pa') !== false ? 'right' : 'left';
            if($liClass=='left') {
                $appender .= '<li class="' . $liClass . '">';
                $formatteddate = date("m/d/Y", strtotime($msgs->created_at));
                $appender .= '<span class="date-time">' .$formatteddate .' '. date("H:i", strtotime($msgs->created_at)) . '</span>';
                $appender .= '<a href="#" class="name">'.$pra_det->first_name . ' '. $pra_det->last_name .'</a>';
                $appender .= '<a href="javascript:;" class="image"><img alt="" src="'.$picPath.'"></a>';
                $appender .= '<div class="message">';
                $appender .= $msgs->message;
                $appender .= '</div>';
                $appender .= '</li>';
            }
            if($liClass=='right')
            {
                $directory= '';
                $pra_det = Practitioner::where('pra_id', '=', $msg_id->practitioner_id)->first();;
                if(isset($patient->photo) && (!empty($patient->photo)))
                {$directory = $pra_det->directory;
                    if($directory!="") $directory = $directory .'/';
                    $picPath = asset('public/practitioners/'.$directory.$patient->photo);
                    //$picPath = public_path().'\\practitioners\\peter222220\\'.$directory.$patient->photo;
                    }
                                    else {$picPath = asset('public/img/no-user.jpg');}
                $appender.='<li class="right">';
                $formatteddate = date("m/d/Y", strtotime($msgs->created_at));
                $appender .= '<span class="date-time">' .$formatteddate .' '. date("H:i", strtotime($msgs->created_at)) . '</span>';
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
    public function getMessageSerial($msg_id)
    {
        $returnn=1;
        //$msg_header = message_history::where('msg_id', '=',$msg_id)->first();;
        $msg_header = DB::table('message_history')->where('msg_id', '=',$msg_id)->max('serial');
        $returnn = $msg_header;
        return $returnn+1;
    }
    public function viewMessage()
    {
        $patient = Patient::where('user_id', '=', Auth::user()->user_id)->first();;
        $msg_from = $patient->pa_id;
        $messageHistory = DB::table("message_header AS MH")
            ->join("practitioners AS pra", "pra.pra_id", "=", "MH.practitioner_id")
            ->select('MH.*','pra.first_name','pra.last_name')
            ->where('MH.patient_id','=',$msg_from)
            ->where('MH.patient_login_id','=',Auth::user()->user_id)
            ->get();
        $practitioners = Practitioner::select('pra_id', 'first_name', 'last_name')->where('first_name','<>','""')->get();
        //$messageHistory = message_header::select('*')->where('patient_id','=',$msg_from)
          //  ->where('patient_login_id','=',Auth::user()->user_id)
            //->get();
        return view('patient.index.pa-message')->with('practitioners', $practitioners)->with('messageHistory',$messageHistory);
    }
    public function sendMessage(Request $request)
    {
        try {
            $patient = Patient::where('user_id', '=', Auth::user()->user_id)->first();;
            $patient_id = $patient->pa_id;
            $patient_login_id = $patient->user_id;
            $practitioner = Practitioner::where('pra_id', '=', $request->pra_id)->first();;
            $practitioner_id = $practitioner->pra_id;
            $practitioner_login_id = $practitioner->user_id;
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
            $this->saveMessage($msg_id, $request->message,'pa_'.$patient_id,$this->getMessageSerial($msg_id));
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
}
