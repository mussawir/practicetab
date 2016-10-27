<?php
namespace App\Http\Controllers\Practitioner;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaRegFormRequest;
use App\Http\Requests\ChangePassFormRequest;
use App\Models\ContactGroup;
use App\Models\Patient;
use App\Models\Practitioner;
use App\Models\Supplement;
use App\Models\SupplementRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

/**
 * IndexController
 *
 * Controller to house all the functionality directly
 * related to the ModuleOne.
 */
class IndexController extends Controller
{
	var $practitioner_info = null;
	public function __construct()
	{
		$this->practitioner_info = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
		Session::put('practitioner_session',$this->practitioner_info);
		Session::set('dashboard', 'active');
		Session::pull('management');
		Session::pull('marketing');


	}

	public function index()
	{
		/// module:patient
		// view folder name: index
		// file: index

		$sup_requests = DB::table("supplement_requests AS sr")
		->join("patients AS p", "p.pa_id", "=", "sr.pa_id")
		->join("users AS u", "u.user_id", "=", "p.user_id")
		->select('u.first_name', 'u.last_name', 'sr.title',
			'u.cell', 'u.gender', 'u.address')
		->where('sr.pra_id', '=', $this->practitioner_info->pra_id)
		->get();

		return view('practitioner.index.index')->with('hide_sidebar', 'no-sidebar')
			->with('supplement_requests', $sup_requests);
	}

	public function createPatient()
	{
		return view('practitioner.index.new-patient');
	}

	public function savePatient(PaRegFormRequest $request)
	{
		$password = Str::quickRandom(8);
		$user = User::create([
			'role'  => 4,
			'first_name' => $request->get('first_name'),
			'last_name' => $request->get('last_name'),
			'email' => $request->get('email'),
			'password'  => bcrypt($password),
			'phone' => $request->get('phone'),
			'cell' => $request->get('cell'),
			'gender' => $request->get('gender'),
			'address' => $request->get('address')
		]);

		$patient = Patient::create([
			'user_id'  => $user->user_id,
			'pra_id' => Auth::user()->user_id
		]);

		$this->sendEmail(array(
			'created_by' => ucwords(Auth::user()->first_name) .' '. ucwords(Auth::user()->last_name),
			'name' => ucwords($request->get('first_name')) .' '. ucwords($request->get('last_name')),
			'email' => $request->get('email'),
			'password'  => $password
		));

		Session::put('success', 'Patient created successfully!');
		return Redirect::to('practitioner/index/patient-list');
	}

	public function patientList()
	{
		$patients = DB::table("users AS u")
			->join("patients AS p", "p.user_id", "=", "u.user_id")
			->select('u.user_id', 'pa_id', 'u.first_name', 'u.last_name', 'u.email', 'u.phone',
				'u.cell', 'u.gender', 'u.address')
			->where('p.pra_id', '=', Auth::user()->user_id)
			->get();

		return view('practitioner.index.patient-list')->with('patients', $patients);
	}

	private function sendEmail($data)
	{
		\Mail::send('practitioner.index.patient-email-template', $data, function ($message) use ($data) {

			$message->from('noreply@practicetabs.com', 'practicetabs.com');
			$message->to(trim($data['email']));
			$message->subject('Patient Registration');
		});
	}

	public function newSuggestions()
	{
		$contact_groups = ContactGroup::select('name', 'cg_id')
			->where('pra_id', '=', $this->practitioner_info->pra_id)
			->get();

		$supplements = Supplement::select('sup_id', 'name', 'used_for', 'main_image')->get();

		return view('practitioner.index.new-suggestions')->with('hide_sidebar', 'no-sidebar')
			->with('contact_groups', $contact_groups)->with('supplements', $supplements);
	}

	public function saveSuggestions(Request $request)
	{
		return Redirect::Back();
	}

	public function changePassword()
	{
		return view('practitioner.index.change-password');
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
