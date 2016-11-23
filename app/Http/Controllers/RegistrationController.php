<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use App\Models\Practitioner;
use App\Models\User;
use App\Models\PracticeProfile;
use App\Models\Hours;
use Illuminate\Support\Str;
use File;

class RegistrationController extends Controller
{
    public function showPricingPage()
    {
        return view('registration.pricing');
    }

    public function showAccountPage()
    {
        $selected_plan_type = Session::has('plan_type') ? Session::get('plan_type') : Input::get('pricing_plan_type');
        Session::put('plan_type', $selected_plan_type);
        $plan_type = $this->getPlanType($selected_plan_type);

        return view('registration.account')->with('plan_type', $plan_type);
    }

    public function savePractitioner(Requests\PraRegFormRequest $request)
    {
        if(!Session::has('plan_type')) {
            return Redirect::Back();
        }

        $plan_type = Session::get('plan_type');
        $password = Str::quickRandom(8);
        $user = User::create([
            'role'  => 3,
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password'  => bcrypt($password)
        ]);
    $directory = uniqid(strtolower($request->get('first_name')),false);
        $practitioner = Practitioner::create([
            'user_id'  => $user->user_id,
            'plan_type' => $plan_type,
            'directory' => $directory
        ]);
//create directory
        $path = public_path().'/practitioners/'.$directory.'/images';
        File::makeDirectory($path,0777, true, true);
        //File::makeDirectory(public_path().'/practitioners/'.$directory, 0777, true);

        $practice_profile = PracticeProfile::create([
            'pra_id'  => $practitioner->pra_id,
        ]);

        $hours = Hours::create([
            'pra_id'  => $practitioner->pra_id,
        ]);

        $this->sendEmail(array(
            'name' => ucwords($request->get('first_name')) .' '. ucwords($request->get('last_name')),
            'email' => $request->get('email'),
            'password'  => $password,
            'plan_type' => $this->getPlanType($plan_type),
            'package_payment'   => '$0'
        ));

        Session::forget('plan_type'); // remove by key

        Session::put('success', 'Thank you for registration. We have sent you an email with login details.');
        return Redirect::to('/users/practitioner/login');
    }

    public function newPractitioner(Request $request)
    {
        $inputs = $request->all();
        var_dump($inputs);return;
    }

    private function sendEmail($data)
    {
        \Mail::send('registration.practitioner-email-template', $data, function ($message) use ($data) {

            $message->from('noreply@practicetabs.com', 'practicetabs.com');
            $message->to(trim($data['email']));
            $message->subject('Practitioner Registration');
        });
    }

    private function getPlanType($val)
    {
        if($val==1){
            return 'Free';
        } else if($val==2){
            return 'Premium';
        } else if($val==3){
            return 'Lite';
        } else {
            return NULL;
        }
    }

    public function showPaymentPage()
    {
        if(!Session::has('plan_type')) {
            return Redirect::to('/pricing');
        }

        $plan_type = $this->getPlanType(Session::get('plan_type'));
        return view('registration.payment')->with('plan_type', $plan_type);
    }

    public function showAccountPaymentPage(Requests\PraRegFormRequest $request)
    {
        if(!Session::has('plan_type')) {
            return Redirect::to('/pricing');
        }

        Session::put('reg_info', $request->all());

        return Redirect::to('/registration/account/payment');
    }

    public function saveAccountPayment(Requests\PaymentFormRequest $request)
    {
        if(!Session::has('plan_type')) {
            return Redirect::Back();
        }

        $plan_type = Session::get('plan_type');
        $password = Str::quickRandom(8);
        $reg_info = Session::get('reg_info');
        $user = User::create([
            'role'  => 3,
            'first_name' => $reg_info['first_name'],
            'last_name' => $reg_info['last_name'],
            'email' => $reg_info['email'],
            'password'  => bcrypt($password)
        ]);

        $directory = uniqid(strtolower($reg_info['first_name']),false);
        $practitioner = Practitioner::create([
            'user_id'  => $user->user_id,
            'plan_type' => $plan_type,
            'directory' => $directory,
            'cc_type'   => $request['cc_type'],
            'cc_number' => $request['cc_number'],
            'cc_cvv'    => $request['cc_cvv'],
            'cc_month'  => $request['cc_month'],
            'cc_year'   => $request['cc_year']
        ]);

        //create directory
        $path = public_path().'/practitioners/'.$directory.'/images';
        File::makeDirectory($path,0777, true, true);

        $practice_profile = PracticeProfile::create([
            'pra_id'  => $practitioner->pra_id,
        ]);

        $hours = Hours::create([
            'pra_id'  => $practitioner->pra_id,
        ]);

        $package_payment = 0;
        if($plan_type == 2) {
            $package_payment = 89.95;
        } else if($plan_type == 3){
            $package_payment = 19.95;
        }

        $this->sendEmail(array(
            'name' => ucwords($reg_info['first_name']) .' '. ucwords($reg_info['last_name']),
            'email' => $reg_info['email'],
            'password'  => $password,
            'plan_type' => $this->getPlanType($plan_type),
            'package_payment'   => '$'.$package_payment
        ));

        Session::forget('plan_type'); // remove by key
        Session::forget('reg_info'); // remove by key

        Session::put('success', 'Thank you for registration. We have sent you an email with login details.');
        return Redirect::to('/users/practitioner/login');
    }
}
