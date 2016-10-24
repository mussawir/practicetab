<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\Patient;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image as InterventionImage;

class PatientController extends Controller
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
        $table1 = Patient::select('*')->orderBy('first_name', 'asc')->get();
        $meta = $this->meta('Patient', 'new_patient',null,isset($table1)?count($table1):0);
        return view('practitioner.patient.index')->with('table1', $table1)->with('meta', $meta);
    }

    private function meta($title, $main_menu = null, $sub_menu = null, $rcount){
        return array('page_title'=> $title, $main_menu =>'active', $sub_menu => 'active', 'item_counter'=>$rcount);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meta = $this->meta('Patient', 'new_patient',null,0);
        return view('practitioner.patient.new')->with('meta', $meta);
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
        $filename = '';
        if($request->hasFile('photo')) {
            $file = $request->file('photo');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '-' .$file->getClientOriginalName();
            $file->move(public_path().'/practitioner/peter222220/', $filename);
        }

       // $input['category'] =  $request->file('category');
        $input['photo'] = $filename;
        $input['user_id'] = Auth::user()->user_id;
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
        $meta = $this->meta(null,'edit_patient',null,0);
        return view('practitioner.patient.edit')->with('meta', $meta)->with('table1', $table1);
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
        $table1 = Patient::find($request->id);

        $filename = '';
        if($request->hasFile('photo')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file = $request->file('photo');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();

            if (isset($table1->photo) && (!empty($table1->photo))) {
                if(file_exists(public_path() . '/practitioner/peter222220/' . $table1->photo)){
                    unlink(public_path() . '/practitioner/peter222220/' . $table1->photo);
                }
                $file->move(public_path().'/practitioner/peter222220/', $filename);
            }
        } else {
            $filename = $request->saved_logo;
        }

        $table1->photo = $filename;
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
