<?php
namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Nutrition;
use App\Models\Patient;
use App\Models\SupplementRequest;
use App\Models\SupplementRequestDetail;
use App\Models\SupSuggestionsMaster;
use App\Models\SuggestionsSearch;
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
		$supplements = Supplement::select('sup_id', 'name', 'used_for', 'main_image')
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
		if($request->method('post')){
			$sup_request = SupplementRequest::create([
				'pa_id'		=>	$this->patient_info->pa_id,
				'pra_id'	=>	$request->pra_id,
				'title'		=>	$request->title,
				'message'	=>	$request->message
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
}
