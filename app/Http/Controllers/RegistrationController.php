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
            'plan_type' => $this->getPlanType($plan_type)
        ));

        Session::forget('plan_type'); // remove by key

        Session::put('success', 'Thank you for registration. We have sent you an email with login credentials.');
        return Redirect::Back();
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

    public function showAccountPaymentPage()
    {
        return view('registration.payment');
    }

    public function saveAccountPayment(Request $request)
    {
var_dump($request);
    }
}
