<?php
namespace App\Http\Controllers\Practitioner;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaRegFormRequest;
use App\Http\Requests\ChangePassFormRequest;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
	public function index()
	{
		/// module:patient
		// view folder name: index
		// file: index
		return view('practitioner.index.index')->with('hide_sidebar', 'no-sidebar');
	}

	public function viewMarketing()
	{
		return view('practitioner.index.marketing');
	}

	public function viewManagement()
	{
		return view('practitioner.index.management');
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
