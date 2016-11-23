<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassFormRequest;
use Illuminate\Support\Facades\Auth;
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
	public function index()
	{
		// module:admin
		// view folder name: index
		// file: index
		return view('member.index.index')
			->with('page_title', 'Dashboard')->with('db_main_menu', 'active');
	}

	public function changePassword()
	{
		return view('admin.index.change-password');
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