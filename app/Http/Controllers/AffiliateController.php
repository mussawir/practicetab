<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AffiliateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('affiliate.new');
    }

    public function saveAffiliate(Request $request)
    {
        $validator = \Validator::make($request->toArray(), [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'phone' => 'required|max:30',
            'email' => 'required|email|max:50',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $inputs = $request->all();

        $password = Str::quickRandom(8);
        $user = User::create([
            'role'  => 5,
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password'  => bcrypt($password)
        ]);

        $inputs['user_id'] = $user->user_id;
        $member = Affiliate::create($inputs);

        $inputs['password'] = $password;
        \Mail::send('affiliate.member-email-template', ['data'=>$inputs], function ($message) use ($inputs) {

            $message->from('noreply@practicetabs.com', 'practicetabs.com');
            $message->to(trim($inputs['email']));
            $message->subject('Practice Tabs Affiliation');
        });

        \Mail::send('affiliate.admin-email-template', ['data'=>$inputs], function ($message) use ($inputs) {

            $message->from('noreply@practicetabs.com', 'practicetabs.com');
            $message->to('mindbender39@gmail.com');
            $message->subject('Practice Tabs Affiliation');
        });

        Session::put('success', 'Thank you for affiliation. We have sent you an email with login details.');
        return Redirect::Back();
    }
}