<?php
namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassFormRequest;

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
		return view('patient.index.supplement-request');
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
