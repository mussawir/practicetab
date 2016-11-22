<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\ExercisePresMaster;
use App\Models\ExercisePresDetails;
use App\Models\Exercises;
use App\Models\Patient;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image as InterventionImage;

class ExercisePrescriptionController extends Controller
{
    public function __construct()
    {
        Session::pull('marketing');
        Session::set('management', 'active');
        Session::pull('dashboard');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table1 = ExercisePresMaster::select('*')->orderBy('first_name', 'asc')->get();
        $meta = $this->meta('Patient', 'new_patient',null,isset($table1)?count($table1):0);
        return view('practitioner.exercise-prescription.index')->with('table1', $table1)->with('meta', $meta);
    }

    private function meta($title, $main_menu = null, $sub_menu = null, $rcount){
        return array('page_title'=> $title, $main_menu =>'active', $sub_menu => 'active', 'item_counter'=>$rcount);
    }
   
    public function exercises()
    {
        if(Session::has('exe_pre_master')){
            $table1 = Patient::find(Session::get('exe_pre_master')['master_data']->pa_id);
            Session::put('patient',$table1);
            $table2 = Exercises::select('*')->orderBy('heading', 'asc')->get();

            $cart_ids = Session::get('cart_array');
            $exe_list = Exercises::select('*')->whereIn('exe_id', $cart_ids)->orderBy('heading', 'asc')->get();

            $meta = array('page_title'=>'Exercise for patient', 'man_main_menu'=>'active',null,'item_counter'=>(0));
            return view('practitioner.exercise-prescription.exercises')->with('meta', $meta)->with('table1', $table1)
                ->with('table2', $table2)->with('exe_list', $exe_list);
        } else {
            return Redirect::Back();
        }
    }

    public function addExercise($id){
        if(!Session::has('exe_pre_master')){
            return Redirect::Back();
        }

        $is_exist = in_array($id, Session::get('cart_array')==null ? array() : Session::get('cart_array'));
        if($is_exist){
            Session::put('error', 'This exercise is already added');
            return Redirect::Back();
        }

        $table1 = Exercises::find($id);
        $meta = array('page_title'=>'Exercise for patient', null,null,'item_counter'=>(0));
        return view('practitioner.exercise-prescription.add-exercise')->with('meta', $meta)->with('table1', $table1)
            ->with('table2', Session::get('patient'));

    }

    public function addMaster($patient_id)
    {
        if(Session::get('cart_array') != null) {
            return Redirect::to('/practitioner/exercise-prescription/exercises');
        }

        $inputs = array();
        $patient = Patient::where('pa_id', '=' ,$patient_id)->first();
        $inputs['pa_id'] = $patient_id;
        $inputs['pra_id'] = Session::get('practitioner_session')->pra_id;
        $inputs['first_name'] = $patient->first_name;
        $inputs['middle_name'] = $patient->middle_name;
        $inputs['last_name'] = $patient->last_name;
        $master = ExercisePresMaster::create($inputs);

        Session::put('exe_pre_master',array('master_data'=> $master));

        return Redirect::to('/practitioner/exercise-prescription/exercises');
    }

    public function storeExercise(Request $request)
    {
        $inputs = $request->all();
        $inputs['master_id'] = Session::get('exe_pre_master')['master_data']->id;
        $exe_details = ExercisePresDetails::create($inputs);

        if($exe_details){
            if(!Session::has('cart_array')){
                Session::put('cart_array', array());
            }
            Session::push('cart_array', $inputs['exe_id']);
            Session::put('success','Exercise added successfully!');
            return Redirect::to('/practitioner/exercise-prescription/exercises');
        }

        return Redirect::Back();
    }

    public function deleteExercise($id)
    {
        if(!Session::has('cart_array')) {
            return Redirect::Back();
        }

        $master_id = Session::get('exe_pre_master')['master_data']->id;
        $details = ExercisePresDetails::where('master_id', '=', $master_id)->where('exe_id', '=', $id)->first();
        if(isset($details)){
            $details->delete();

            $cart = Session::get('cart_array');
            foreach ($cart as $index => $val) {
                if ($val == $id) {
                    unset($cart[$index]);
                }
            }

            Session::put('cart_array', $cart);

            //Session::put('success','Exercise removed successfully!');
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }

    public function printPrescribedExercises()
    {
        if(!Session::has('cart_array')) {
            return Redirect::Back();
        }

        $master_id = Session::get('exe_pre_master')['master_data']->id;
        $data = DB::table("exercise_pres_masters AS m")
            ->join("exercise_pres_details AS d", "d.master_id", "=", "m.id")
            ->join("exercises AS e", "e.exe_id", "=", "d.exe_id")
            ->select('m.pra_id', 'm.first_name', 'm.middle_name', 'm.last_name',
                'm.prescribed_at', 'd.*', 'e.heading', 'e.description', 'e.image1', 'e.image2')
            ->where('m.id', '=', $master_id)
            ->get();

        if (isset($data) && (!empty($data)))
        {
            //$this->saveExePrescribedInfo();

            $pra_info = Session::get('practitioner_session');

            $pdf = \PDF::loadView('practitioner.exercise-prescription.exercise-pdf', array('data'=>$data, 'pra_info'=>$pra_info));
            return $pdf->stream();//download('Quotation_'.$pdf_data[0]->job_code.'.pdf');
            //return view('practitioner.exercise-prescription.exercise-pdf', compact('data', 'pra_info'));

        } else {
            Session::put('error', 'Record not found');
            return Redirect::Back();
        }
    }

    public function storeExePrescribedInfo()
    {
        if(!Session::has('cart_array')) {
            return Redirect::Back();
        }

        //$this->saveExePrescribedInfo();

        return Redirect::to('/practitioner/exercise-prescription');
    }

    private function saveExePrescribedInfo()
    {
        $master_id = Session::get('exe_pre_master')['master_data']->id;
        $master = ExercisePresMaster::where('id', '=', $master_id)->first();
        $master->prescribed_at = date('Y/m/d H:i:s');
        $master->save();

        Session::forget('exe_pre_master'); // remove by key
        Session::forget('cart_array'); // remove by key
    }
}
