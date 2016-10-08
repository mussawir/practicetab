<?php
namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassFormRequest;
use App\Models\Practitioner;
use App\Models\Supplement;
use Illuminate\Support\Facades\DB;

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
		// module:patient
		// view folder name: index
		// file: index
		return view('patient.index.index');
	}

	public function createSupplementRequest()
	{
		$practitioners = DB::table('practitioners as p')
			->join("users AS u", "u.user_id", "=", "p.user_id")
			->select('p.pra_id', 'u.first_name', 'u.last_name')
			->get();
		$supplements = Supplement::select('sup_id', 'name', 'used_for')->get();
		return view('patient.index.supplement-request')
			->with('practitioners', $practitioners)
			->with('supplements', $supplements);
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
