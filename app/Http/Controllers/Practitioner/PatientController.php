<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\Patient;
use App\Models\PatientFile;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image as InterventionImage;
use File;
class PatientController extends Controller
{
    protected $baseUrl;

    public function __construct(UrlGenerator $url)
    {
        $this->baseUrl = $url;
        Session::set('management', 'active');//set header button
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prac = Session::get('practitioner_session');
        $table1 = Patient::select('*')->orderBy('first_name', 'asc')->get();
        return view('practitioner.patient.index')->with('table1', $table1)
            ->with('meta', array('page_title'=>'Patients List',isset($table1)?count($table1):0))
            ->with('patients_list','active')
            ->with('directory', $prac['directory']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('practitioner.patient.new')
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
            $file->move(public_path().'/practitioners/'.$prac['directory'].'/', $filename);
        }
        //create directory
        $directory = uniqid(strtolower($request->get('first_name')),false);
        $path = public_path().'/practitioners/'.$prac['directory'].'/'.$directory;
        File::makeDirectory($path,0777, true, true);
       // $input['category'] =  $request->file('category');
        $input['photo'] = $filename;
        $input['pra_id'] = $prac['pra_id'];
        $input['directory'] = $directory;
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
        return view('practitioner.patient.edit')
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
        $table1 = Patient::find($id);
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


    /**
     * Show the form for files the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function files($id)
    {
        $prac = Session::get('practitioner_session');
        $table1 = Patient::find($id);
        $table2 = PatientFile::select('*')->where('pa_id', $id)->where('pra_id', $prac['pra_id'])->get();
        return view('practitioner.patient.files')
            ->with('table1', $table1)
            ->with('table2', $table2)
            ->with('meta', array('page_title'=>'Patient Files'))
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
    public function uploadFiles(Request $request)
    {
        $prac = Session::get('practitioner_session');
        $table1 = Patient::find($request->pa_id);

        // getting all of the post data
        $files = $request->file('files');
        $input = $request->all();
        // Making counting of uploaded files
        $file_count = count($files);
        // start count how many uploaded
        $uploadcount = 0;
        foreach($files as $file) {
            $filename = $file->getClientOriginalName();
            //$upload_success = $file->move($destinationPath, $filename);
            $file->move(public_path().'/practitioners/'.$prac['directory'].'/'.$table1->directory .'/', $filename);
            $input['pa_id'] = $request->pa_id;
            $input['pra_id'] = $prac['pra_id'];
            $input['file_name'] = $filename;
            PatientFile::create($input);
        }

        Session::put('success','Files uploaded successfully!');
        return Redirect::to('/practitioner/patient/files/'.$request->pa_id);
    }


    public function destroyFile($id)
    {
        $prac = Session::get('practitioner_session');
        $table1 = PatientFile::find($id);
        $table2 = Patient::select('directory')->where('pa_id', '=', $table1->pa_id)->first();
        if(isset($table1)){
            if (isset($table1->file_name) && (!empty($table1->file_name))) {
                if(file_exists(public_path() . '/practitioners/'.$prac['directory'].'/'.$table2->directory .'/' . $table1->file_name)){
                    unlink(public_path() . '/practitioners/'.$prac['directory'].'/'.$table2->directory .'/' . $table1->file_name);
                }
            }
            $table1->delete();
            //Session::put('success','Patient is deleted successfully!');
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }
}
/*
 * <<<<<<< HEAD
    
public function destroyFile($pa_id, $pf_id)
{
    $prac = Session::get('practitioner_session');
    $table1 = PatientFile::select('*')->where('pa_id', $pa_id)->where('pf_id', $pf_id)->get();
    $table2 = Patient::find($pa_id);
    if(isset($table1)){
        if(file_exists(public_path() .'/practitioners/'.$prac['directory'].'/' .$table2->directory .'/'. $table1->file_name)){
            unlink(public_path() .'/practitioners/'.$prac['directory'].'/' .$table2->directory .'/'. $table1->file_name);
        }
        $table1->delete();
        Session::put('success','File is deleted successfully!');
        return Redirect::to('/practitioner/patient/files/'.$pa_id);
    }
    return response()->json(['status' => 'error']);
}

}
=======
 */