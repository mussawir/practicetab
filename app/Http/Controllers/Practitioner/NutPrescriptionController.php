<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\Nutrition;
use App\Models\NutritionPresDetails;
use App\Models\NutritionPresMaster;
use App\Models\Patient;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class NutPrescriptionController extends Controller
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
        $table1 = NutritionPresMaster::select('*')->orderBy('first_name', 'asc')->get();
        $meta = array('page_title'=>'Supplements prescription for patient');
        return view('practitioner.exercise-prescription.index')->with('table1', $table1)->with('meta', $meta);
    }

    private function meta($title, $main_menu = null, $sub_menu = null, $rcount){
        return array('page_title'=> $title, $main_menu =>'active', $sub_menu => 'active', 'item_counter'=>$rcount);
    }
   
    public function showNutrition()
    {
        if(Session::has('nut_pre_master')){
            $table1 = Patient::find(Session::get('nut_pre_master')['master_data']->pa_id);
            $table2 = Nutrition::select('nut_id', 'name', 'usability', 'main_image')
                ->orderBy('name', 'asc')->get();

            $cart_ids = Session::get('nut_cart_array');
            $nut_list = Nutrition::select('nut_id', 'name', 'usability', 'main_image')
                ->whereIn('nut_id', $cart_ids)->orderBy('name', 'asc')->get();

            $meta = array('page_title'=>'Nutrition prescription for patient');
            return view('practitioner.nutrition-prescription.nutrition')->with('meta', $meta)
                ->with('table1', $table1)->with('table2', $table2)
                ->with('nut_list', $nut_list);
        } else {
            return Redirect::Back();
        }
    }

    public function doPrescribeNutrition($id){
        if(!Session::has('nut_pre_master')){
            return Redirect::Back();
        }

        $is_exist = in_array($id, Session::get('nut_cart_array')==null ? array() : Session::get('nut_cart_array'));
        if($is_exist){
            Session::put('error', 'This nutrition is already added');
            return Redirect::Back();
        }

        $table1 = Nutrition::select('nut_id', 'name', 'usability', 'main_image')->where('nut_id', $id)->first();
        $table2 = Patient::find(Session::get('nut_pre_master')['master_data']->pa_id);
        $meta = array('page_title'=>'Nutrition prescription for patient');
        return view('practitioner.nutrition-prescription.add-Nutrition')->with('meta', $meta)
            ->with('table1', $table1)->with('table2', $table2);

    }

    public function addMaster($patient_id)
    {
        if(Session::get('nut_cart_array') != null) {
            return Redirect::to('/practitioner/nutrition-prescription/nutrition');
        }

        $inputs = array();
        $inputs['pa_id'] = $patient_id;
        $inputs['pra_id'] = Session::get('practitioner_session')->pra_id;
        $master = NutritionPresMaster::create($inputs);

        Session::put('nut_pre_master',array('master_data'=> $master));

        return Redirect::to('/practitioner/nutrition-prescription/nutrition');
    }

    public function store(Request $request)
    {
        $inputs = $request->all();
        $inputs['master_id'] = Session::get('nut_pre_master')['master_data']->id;
        $details = NutritionPresDetails::create($inputs);

        if($details){
            if(!Session::has('nut_cart_array')){
                Session::put('nut_cart_array', array());
            }
            Session::push('nut_cart_array', $inputs['nut_id']);
            Session::put('success','Nutrition added successfully!');
            return Redirect::to('/practitioner/nutrition-prescription/nutrition');
        }

        return Redirect::Back();
    }

    public function delete($id)
    {
        if(!Session::has('nut_cart_array')) {
            return Redirect::Back();
        }

        $master_id = Session::get('nut_pre_master')['master_data']->id;
        $details = NutritionPresDetails::where('master_id', '=', $master_id)->where('nut_id', '=', $id)->first();
        if(isset($details)){
            $details->delete();

            $cart = Session::get('nut_cart_array');
            foreach ($cart as $index => $val) {
                if ($val == $id) {
                    unset($cart[$index]);
                }
            }

            Session::put('nut_cart_array', $cart);

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
            $this->saveExePrescribedInfo();

            $pdf = \PDF::loadView('practitioner.exercise-prescription.exercise-pdf', array('data'=>$data));
            return $pdf->stream();//download('Quotation_'.$pdf_data[0]->job_code.'.pdf');
            //return view('practitioner.exercise-prescription.exercise-pdf', compact('data'));

        } else {
            Session::put('error', 'Record not found');
            return Redirect::Back();
        }
    }

    public function storePrescribedInfo()
    {
        if(!Session::has('nut_cart_array')) {
            Session::put('error','Please first select one or more nutrition');
            return Redirect::Back();
        }

        $this->savePrescribedInfo();

        return Redirect::to('/practitioner/patient');
    }

    private function savePrescribedInfo()
    {
        $master_id = Session::get('nut_pre_master')['master_data']->id;
        $master = NutritionPresMaster::where('id', '=', $master_id)->first();
        $master->prescribed_at = date('Y/m/d H:i:s');
        $master->save();

        Session::forget('nut_pre_master'); // remove by key
        Session::forget('nut_cart_array'); // remove by key
    }
}