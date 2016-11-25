<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\Patient;
use App\Models\Supplement;
use App\Models\SupplementPresDetails;
use App\Models\SupplementPresMaster;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SupPrescriptionController extends Controller
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
        $table1 = SupplementPresMaster::select('*')->orderBy('first_name', 'asc')->get();
        $meta = array('page_title'=>'Supplements prescription for patient');
        return view('practitioner.exercise-prescription.index')->with('table1', $table1)->with('meta', $meta);
    }

    private function meta($title, $main_menu = null, $sub_menu = null, $rcount){
        return array('page_title'=> $title, $main_menu =>'active', $sub_menu => 'active', 'item_counter'=>$rcount);
    }
   
    public function showSupplements()
    {
        if(Session::has('sup_pre_master')){
            $table1 = Patient::find(Session::get('sup_pre_master')['master_data']->pa_id);
            $table2 = Supplement::select('sup_id', 'name', 'used_for', 'main_image')
                ->orderBy('name', 'asc')->get();

            $cart_ids = Session::get('sup_cart_array');
            $sup_list = Supplement::select('sup_id', 'name', 'used_for', 'main_image')
                ->whereIn('sup_id', $cart_ids)->orderBy('name', 'asc')->get();

            $meta = array('page_title'=>'Supplements prescription for patient');
            return view('practitioner.supplement-prescription.supplements')->with('meta', $meta)
                ->with('table1', $table1)->with('table2', $table2)
                ->with('sup_list', $sup_list);
        } else {
            return Redirect::Back();
        }
    }

    public function doPrescribeSupplements($id){
        if(!Session::has('sup_pre_master')){
            return Redirect::Back();
        }

        $is_exist = in_array($id, Session::get('sup_cart_array')==null ? array() : Session::get('sup_cart_array'));
        if($is_exist){
            Session::put('error', 'This supplement is already added');
            return Redirect::Back();
        }

        $table1 = Supplement::select('sup_id', 'name', 'used_for', 'main_image')->where('sup_id', $id)->first();
        $table2 = Patient::find(Session::get('sup_pre_master')['master_data']->pa_id);
        $meta = array('page_title'=>'Supplements prescription for patient');
        return view('practitioner.supplement-prescription.add-supplement')->with('meta', $meta)
            ->with('table1', $table1)->with('table2', $table2);

    }

    public function addMaster($patient_id)
    {
        if(Session::get('sup_cart_array') != null) {
            return Redirect::to('/practitioner/supplement-prescription/supplements');
        }

        $inputs = array();
        $inputs['pa_id'] = $patient_id;
        $inputs['pra_id'] = Session::get('practitioner_session')->pra_id;
        $master = SupplementPresMaster::create($inputs);

        Session::put('sup_pre_master',array('master_data'=> $master));

        return Redirect::to('/practitioner/supplement-prescription/supplements');
    }
    public function storeNote(Request $request)
    {
        $request->master_id = Session::get('sup_pre_master')['master_data']->id;

        //$inputs['stop_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $inputs['stop_date'])));
        $is_exist = in_array($request->sup_id, Session::get('sup_cart_array')==null ? array() : Session::get('sup_cart_array'));
        if($is_exist){
            return 'This supplement is already added';
            //return Redirect::to('/practitioner/supplement-prescription/supplements');
        }
        $SupplementPresDetails = new SupplementPresDetails();
        $SupplementPresDetails->master_id = $request->master_id;
        $SupplementPresDetails->notes = $request->notes;
        $SupplementPresDetails->sup_id = $request->sup_id;
        $SupplementPresDetails->save();

        if($SupplementPresDetails){
            if(!Session::has('sup_cart_array')){
                Session::put('sup_cart_array', array());
            }
            Session::push('sup_cart_array', $request->sup_id);
            Session::put('success','Supplement added successfully!');
            return Redirect::to('/practitioner/supplement-prescription/supplements');
        }

        return Redirect::Back();
    }
    public function store(Request $request)
    {
        $inputs = $request->all();
        $inputs['master_id'] = Session::get('sup_pre_master')['master_data']->id;
        $inputs['start_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $inputs['start_date'])));
        $inputs['stop_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $inputs['stop_date'])));
        $details = SupplementPresDetails::create($inputs);

        if($details){
            if(!Session::has('sup_cart_array')){
                Session::put('sup_cart_array', array());
            }
            Session::push('sup_cart_array', $inputs['sup_id']);
            Session::put('success','Supplement added successfully!');
            return Redirect::to('/practitioner/supplement-prescription/supplements');
        }

        return Redirect::Back();
    }

    public function delete($id)
    {
        if(!Session::has('sup_cart_array')) {
            return Redirect::Back();
        }

        $master_id = Session::get('sup_pre_master')['master_data']->id;
        $details = SupplementPresDetails::where('master_id', '=', $master_id)->where('sup_id', '=', $id)->first();
        $cart = Session::get('sup_cart_array');
        foreach ($cart as $index => $val) {
            if ($val == $id) {
                unset($cart[$index]);
            }
        }
        Session::put('sup_cart_array', $cart);
        if(isset($details)){
            $details->delete();

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
        if(!Session::has('sup_cart_array')) {
            Session::put('error','Please first select one or more supplements');
            return Redirect::Back();
        }

        $this->savePrescribedInfo();

        return Redirect::to('/practitioner/patient');
    }

    private function savePrescribedInfo()
    {
        $master_id = Session::get('sup_pre_master')['master_data']->id;
        $master = SupplementPresMaster::where('id', '=', $master_id)->first();
        $master->prescribed_at = date('Y/m/d H:i:s');
        $master->save();

        Session::forget('sup_pre_master'); // remove by key
        Session::forget('sup_cart_array'); // remove by key
    }
}
