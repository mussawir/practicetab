<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\Practitioner;
use App\Models\PracticeProfile;
use App\Models\Hours;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image as InterventionImage;

class ProfileController extends Controller
{
    protected $baseUrl;

    public function __construct(UrlGenerator $url)
    {
        $this->baseUrl = $url;
        Session::pull('management');
        Session::pull('dashboard');
        Session::pull('marketing');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prac = Session::get('practitioner_session');
        $table1 = Practitioner::find($prac['pra_id']);
        return view('practitioner.profile.index')
            ->with('table1', $table1)
            ->with('meta', array('page_title'=>'Manage Profile'))
            ->with('profile','active')
            ->with('directory', $prac['directory']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /*
                $validator = \Validator::make($request->toArray(), [
                    'name' => 'required|max:100'
                ]);

                if ($validator->fails()) {
                    return Redirect::back()->withErrors($validator)->withInput();
                }
        */
        $prac = Session::get('practitioner_session');
        $table1 = Practitioner::find($prac['pra_id']);
        $filename = '';
        if($request->hasFile('photo')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file = $request->file('photo');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();

            if (isset($table1->photo) && (!empty($table1->photo))) {

                if(file_exists(public_path() . '/practitioners/'.$prac['directory'].'/' . $table1->photo)){
                    unlink(public_path() . '/practitioners/'.$prac['directory'].'/' . $table1->photo);
                }
                $file->move(public_path().'/practitioners/'.$prac['directory'].'/', $filename);
            }
        } else {
            $filename = $request->photo;
        }

        $table1->photo = $filename;
        $table1->suffix = $request->suffix;
        $table1->first_name = $request->first_name;
        $table1->middle_name = $request->middle_name;
        $table1->last_name = $request->last_name;
        $table1->primary_phone = $request->primary_phone ;
        $table1->secondary_phone = $request->secondary_phone ;
        $table1->mailing_street_address = $request->mailing_street_address ;
        $table1->mailing_city = $request->mailing_city ;
        $table1->mailing_zip = $request->mailing_zip ;
        $table1->mailing_state = $request->mailing_state ;
        $table1->billing_street_address = $request->billing_street_address ;
        $table1->billing_city = $request->billing_city ;
        $table1->billing_zip = $request->billing_zip ;
        $table1->billing_state = $request->billing_state ;
        $table1->cc_type = $request->cc_type ;
        $table1->cc_number = $request->cc_number ;
        $table1->cc_month = $request->cc_month ;
        $table1->cc_year = $request->cc_year ;
        $table1->cc_cvv = $request->cc_cvv ;
        $table1->save();

        Session::put('success','Profile updated successfully!');

        return Redirect::to('/practitioner/profile');
    }

    public function clinic()
    {
        $prac = Session::get('practitioner_session');
        $table1 = Practitioner::find($prac['pra_id']);
        return view('practitioner.profile.clinic')
            ->with('table1', $table1)
            ->with('meta', array('page_title'=>'Manage Clinic Info'))
            ->with('clinic','active')
            ->with('directory', $prac['directory']);
    }

    public function clinicUpdate(Request $request)
    {
        $prac = Session::get('practitioner_session');
        $table1 = Practitioner::find($prac['pra_id']);
        $filename = '';
        if($request->hasFile('clinic_logo')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file = $request->file('clinic_logo');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();

            if (isset($table1->clinic_logo) && (!empty($table1->clinic_logo))) {

                if(file_exists(public_path() . '/practitioners/'.$prac['directory'].'/' . $table1->clinic_logo)){
                    unlink(public_path() . '/practitioners/'.$prac['directory'].'/' . $table1->clinic_logo);
                }
                $file->move(public_path().'/practitioners/'.$prac['directory'].'/', $filename);
            }
        } else {
            $filename = $request->clinic_logo;
        }

        $table1->clinic_logo = $filename;
        $table1->clinic_doc_head = $request->clinic_doc_head;
        $table1->clinic_doc_footer = $request->clinic_doc_footer;
        $table1->clinic_street_address = $request->clinic_street_address ;
        $table1->clinic_city = $request->clinic_city ;
        $table1->clinic_zip = $request->clinic_zip ;
        $table1->clinic_state = $request->clinic_state ;
        $table1->clinic_phone = $request->clinic_phone ;
        $table1->clinic_fax = $request->clinic_fax ;
        $table1->clinic_email = $request->clinic_email;

        $table1->save();

        Session::put('success','Profile updated successfully!');

        return Redirect::to('/practitioner/profile/clinic');
    }

    public function practice()
    {
        $prac = Session::get('practitioner_session');
        $table1 = PracticeProfile::find($prac['pra_id']);
        return view('practitioner.profile.practice')
            ->with('table1', $table1)
            ->with('meta', array('page_title'=>'Manage Clinic Info'))
            ->with('practice','active');

    }

    public function practiceUpdate(Request $request)
    {
        $prac = Session::get('practitioner_session');
        $table1 = PracticeProfile::find($prac['pra_id']);

        $woc = ($request->ai_woc != null ?1:0);
        $pi = ($request->ai_pi != null ?1:0);
        $ppo = ($request->ai_ppo != null ?1:0);
        $hmo = ($request->ai_hmo != null ?1:0);
        $medicaid = ($request->ai_medicaid != null ?1:0);
        $medicare = ($request->ai_medicare != null ?1:0);

        $table1->about = $request->about;
        $table1->practice_years = $request->practice_years;
        $table1->website_url = $request->website_url;
        $table1->degree = $request->degree ;
        $table1->accepts_new_patients = $request->accepts_new_patients ;

        $table1->ai_woc = $woc ;
        $table1->ai_pi = $pi ;
        $table1->ai_ppo = $ppo ;
        $table1->ai_hmo = $hmo ;
        $table1->ai_medicaid = $medicaid;
        $table1->ai_medicare = $medicare;
        $table1->languages_spoken = $request->languages_spoken;
        $table1->specialties = $request->specialties;
        $table1->save();
        Session::put('success','Profile is updated successfully!');

        return Redirect::to('/practitioner/profile/practice');
    }

    public function hours()
    {
        $prac = Session::get('practitioner_session');
        $table1 = Hours::find($prac['pra_id']);
        return view('practitioner.profile.hours')
            ->with('table1', $table1)
            ->with('meta', array('page_title'=>'Manage Clinic Info'))
            ->with('hours','active');
    }

    public function hoursUpdate(Request $request)
    {
        $prac = Session::get('practitioner_session');
        $table1 = Hours::find($prac['pra_id']);

        $table1->monday_open = $request->monday_open;
        $table1->tuesday_open = $request->tuesday_open;
        $table1->wednesday_open = $request->wednesday_open;
        $table1->thursday_open = $request->thursday_open;
        $table1->friday_open = $request->friday_open;
        $table1->saturday_open = $request->saturday_open;
        $table1->sunday_open = $request->sunday_open;
        $table1->monday_close = $request->monday_close;
        $table1->tuesday_close = $request->tuesday_close;
        $table1->wednesday_close = $request->wednesday_close;
        $table1->thursday_close = $request->thursday_close;
        $table1->friday_close = $request->friday_close;
        $table1->saturday_close = $request->saturday_close;
        $table1->sunday_close = $request->sunday_close;

        $table1->save();

        Session::put('success','Operting Hours are updated successfully!');

        return Redirect::to('/practitioner/profile/hours');
    }


}
