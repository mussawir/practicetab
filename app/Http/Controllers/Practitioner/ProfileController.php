<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\Practitioner;
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
            ->with('hours','active')
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

}
