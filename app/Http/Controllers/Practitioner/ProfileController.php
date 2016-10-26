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
            ->with('directory', $prac['directory']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('practitioner.profile.new')
            ->with('meta', array('page_title'=>'Patient'))
            ->with('new_patient','active');;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
                $validator = \Validator::make($request->toArray(), [
                    'category' => 'required|max:100'
                ]);
                if ($validator->fails()) {
                    return Redirect::back()->withErrors($validator)->withInput();
                }
        */
        $input = $request->all();
        $prac = Session::get('practitioner_session');
        $filename = '';
        if($request->hasFile('photo')) {
            $file = $request->file('photo');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '-' .$file->getClientOriginalName();
            $file->move(public_path().'/practitioners/'.$prac['directory_name'].'/', $filename);
        }

        // $input['category'] =  $request->file('category');
        $input['photo'] = $filename;
        $input['pra_id'] = $prac['pra_id'];
        Patient::create($input);
        Session::put('success','Patient is created successfully!');
        return Redirect::to('/practitioner/patient/index');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $table1 = Patient::find($id);
        $prac = Session::get('practitioner_session');
        return view('practitioner.profile.edit')
            ->with('table1', $table1)
            ->with('meta', array('page_title'=>'Edit Patient Record'))
            ->with('patients_list','active')
            ->with('directory', $prac['directory']);
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
        $table1 = Patient::find($request->pa_id);
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
                /*
                if(file_exists(public_path() . '/practitioners/peter222220/' . $table1->photo)){
                    unlink(public_path() . '/practitioners/peter222220/' . $table1->photo);
                }
                $file->move(public_path().'/practitioners/peter222220/', $filename);
*/
            }
        } else {
            $filename = $request->photo;
        }

        $table1->photo = $filename;
        $table1->first_name = $request->first_name;
        $table1->middle_name = $request->middle_name;
        $table1->last_name = $request->last_name;
        $table1->email = $request->email;
        $table1->date_of_birth = $request->date_of_birth;
        $table1->age = $request->age ;
        $table1->primary_phone = $request->primary_phone ;
        $table1->secondary_phone = $request->secondary_phone ;
        $table1->mailing_street_address = $request->mailing_street_address ;
        $table1->mailing_city = $request->mailing_city ;
        $table1->mailing_zip = $request->mailing_zip ;
        $table1->billing_street_address = $request->billing_street_address ;
        $table1->billing_city = $request->billing_city ;
        $table1->billing_zip = $request->billing_zip ;
        $table1->mailing_state = $request->mailing_state ;
        $table1->billing_state = $request->billing_state ;
        $table1->notes = $request->notes ;
        $table1->cc_type = $request->cc_type ;
        $table1->cc_number = $request->cc_number ;
        $table1->cc_month = $request->cc_month ;
        $table1->cc_year = $request->cc_year ;
        $table1->cc_cvv = $request->cc_cvv ;
        $table1->save();

        Session::put('success','Patient record is updated successfully!');

        return Redirect::to('/practitioner/patient/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table1 = Patient::find(id);
        if(isset($table1)){
            if (isset($table1->photo) && (!empty($table1->photo))) {
                if(file_exists(public_path() . '/practitioner/peter222220/' . $table1->photo)){
                    unlink(public_path() . '/practitioner/peter222220/' . $table1->photo);
                }
            }
            $table1->delete();
            Session::put('success','Patient is deleted successfully!');
            //return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }
}
