<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',
            ['except' => array('showAdminLogin', 'showPatientLogin', 'showPractitionerLogin', 'showMemberLogin')]);
    }

    public function showAdminLogin()
    {
        return view('user.admin-login');
    }

    public function showPatientLogin()
    {
        return view('user.patient-login');
    }

    public function showPractitionerLogin()
    {
        return view('user.practitioner-login');
    }

    public function showMemberLogin()
    {
        return view('user.member-login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table("users AS u")
            ->join("user_role AS ur", "ur.user_id", "=", "u.user_id")
            ->join("roles AS r", "r.role_id", "=", "ur.role_id")
            ->select('u.user_id', 'u.code', 'u.full_name', 'u.phone', 'u.cell', 'u.email', 'r.role_id', 'r.name as roleName')
            ->where('u.user_id', '!=', Auth::user()->user_id)
            ->get();

        return view('user.index')->with('user_list', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\UserFormRequest $request)
    {
        $user = User::create([
            'role'  =>  $request->get('role'),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'phone' => $request->get('phone'),
            'cell' => $request->get('cell'),
            'gender' => $request->get('gender'),
            'address' => $request->get('address')
        ]);

        Session::put('success', 'User created successfully!');

        return Redirect::Back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = DB::table("users AS u")
            ->join("user_role AS ur", "ur.user_id", "=", "u.user_id")
            ->join("roles AS r", "r.role_id", "=", "ur.role_id")
            ->select('u.user_id', 'u.full_name', 'u.phone', 'u.cell', 'u.email', 'r.role_id')
            ->where('u.user_id', '=', $id)->get();

        return view('user.edit')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array(
            'role'  =>  $request->get('role'),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'cell' => $request->get('cell'),
            'gender' => $request->get('gender'),
            'address' => $request->get('address')
        );

        User::where("user_id", $id)->update($data);

        $user = User::find($id);

        return Redirect::to('/user/edit')->with('user', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return response()->json(['status' => 'success']);
    }
}
