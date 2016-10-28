<?php
namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\SupplementRequest;
use App\Models\SupplementRequestDetail;
use App\Models\SupSuggestionsMaster;
use Illuminate\Http\Request;
use App\Http\Requests\ChangePassFormRequest;
use App\Models\Practitioner;
use App\Models\Supplement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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
		$sup_sug_master = SupSuggestionsMaster::all();

		return view('patient.index.index')->with('sup_sug_master', $sup_sug_master);
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

	public function saveNewPassword(ChangePassFormRequest $request)
	{
		$user = User::find(Auth::user()->user_id);
		$user->password = bcrypt($request['new_password']);
		$user->save();

		Session::put('success', 'Your password has been changed successfully!');
		return Redirect::Back();
	}
}
