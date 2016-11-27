<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassFormRequest;
use App\Models\Practitioner;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

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
        $meta = array('page_title' => 'Dashboard', 'db_main_menu' => 'active', 'item_counter' => (0));
        return view('admin.index.index')->with('meta', $meta);
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

    public function blockUnblockPra(Request $request)
    {
        $input = $request->all();
        //$praBlockModel = Practitioner::where('pra_id','=',$request->pra_id)->get();
        $praBlockModel = Practitioner::find($request->pra_id);
        if (isset($praBlockModel)) {
            if ($request->blockOrUnblock == 1) {
                Session::put('success', 'Practitioner Blocked');
                $praBlockModel->inactive = 1;
                $praBlockModel->save();
            } else {
                Session::put('success', 'Practitioner Unblocked');
                $praBlockModel->inactive = 0;
                $praBlockModel->save();
            }
        } else {
            Session::put('error', 'Some Error occured');
        }
        return Redirect::Back();
    }

    public function showActivePractitioners()
    {
        $meta = array('page_title' => 'Practitioners List', 'item_counter' => (0));
        $list = Practitioner::orderBy('first_name', 'asc')->get();

        return view('admin.index.activePraList')->with('meta', $meta)->with('list', $list)
            ->with('active_pra_menu', 'active')->with('active_pra_list', 'active');
    }

    public function viewPractitioners($id)
    {
        $list = Practitioner::where('pra_id', '=', $id)->orderBy('first_name', 'asc')->get();
        $firstNAme = '';
        foreach ($list as $record) {
            $firstNAme = $record->first_name;
        }
        $meta = array('page_title' => 'Practitioners ' . $firstNAme, 'item_counter' => (0));
        return view('admin.index.viewPra')->with('meta', $meta)->with('list', $list)
            ->with('active_pra_menu', 'active')->with('active_pra_list', 'active');

    }

    public function newUser()
    {
        $meta = array('page_title'=>'New User', 'item_counter'=>(0));
        return view('admin.index.new-user')->with('meta', $meta)
            ->with('user_menu', 'active')->with('new_user', 'active');
    }
	public function showUserList()
	{
		$meta = array('page_title'=>'User List', 'item_counter'=>(0));
		$list = User::whereIn('role', [2])
			->where('user_id', '!=', Auth::user()->user_id)
			->orderBy('first_name', 'asc')->get();

		return view('admin.index.userList')->with('meta', $meta)->with('list', $list)
			->with('user_menu', 'active')->with('user_list', 'active');
	}

    public function saveUser(Request $request)
    {
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->primary_phone;
        $user->email = $request->email;
        $user->cell = $request->cell;
        $user->address = $request->address;
        $user->role = '2';
        $user->save();
        Session::put('success','New User has been created');
        return redirect::back();
    }
    public function editUser($id){
        $user = User::find($id);
        $meta = array('page_title'=>'Edit User', 'item_counter'=>(0));
        return view('admin.index.edit-user')->with('meta', $meta)->with('user',$user)
            ->with('user_menu', 'active');
    }
    public function updateUser(Request $request){
        $user = User::find($request->user_id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->primary_phone;
        $user->email = $request->email;
        $user->cell = $request->cell;
        $user->address = $request->address;
//        $user->role = '2';
        $user->save();
        Session::put('success','User has been updated');
        return redirect::to('/admin/index/users');
    }

    public function destoryUser($id)
    {
        $User = User::find($id);
        if (isset($User)) {
            $User->delete();
            Session::put('success', 'User deleted successfully!');
        }
        return response()->json(['status' => 'error']);
    }
}