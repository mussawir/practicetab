<?php namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassFormRequest;
use App\Models\User;
use App\Modules\Admin\Models\TestModel;
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
	function __construct( TestModel $testModel )
	{
		$this->testModel = $testModel;
	}

	public function index()
	{
		// ModuleOne is the module name and dummy is the blade file
		// you can specify ModuleOne::someFolder.file if your file exists
		// inside a folder. Also the blade will use the same syntax i.e.
		// ModuleName::viewName
		return view('Admin::index');
	}

	public function modelTest()
	{
		// Added just to demonstrate that models work
		return $this->testModel->getAny();
	}

	public function changePassword()
	{
		return view('Admin::change-password');
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
