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
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image as InterventionImage;

class ExercisePrescriptionController extends Controller
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
        $table1 = ExercisePresMaster::select('*')->orderBy('first_name', 'asc')->get();
        $meta = $this->meta('Patient', 'new_patient',null,isset($table1)?count($table1):0);
        return view('practitioner.exercise-prescription.index')->with('table1', $table1)->with('meta', $meta);
    }

    private function meta($title, $main_menu = null, $sub_menu = null, $rcount){
        return array('page_title'=> $title, $main_menu =>'active', $sub_menu => 'active', 'item_counter'=>$rcount);
    }
   
    public function exercises($id){
        $table1 = Patient::find($id);
        Session::put('patient',$table1);
        $table2 = Exercises::select('*')->orderBy('heading', 'asc')->get();

        $meta = array('page_title'=>'Exercise for patient', 'man_main_menu'=>'active',null,'item_counter'=>(0));
        return view('practitioner.exercise-prescription.exercises')->with('meta', $meta)->with('table1', $table1)
            ->with('table2', $table2);

    }
    public function addExercise($id){
        $table1 = Exercises::find($id);
        $meta = array('page_title'=>'Exercise for patient', null,null,'item_counter'=>(0));
        return view('practitioner.exercise-prescription.add-exercise')->with('meta', $meta)->with('table1', $table1)
            ->with('table2', Session::get('patient'));

    }

    public function addMaster($id){
        $table1 = Exercises::find($id);
        $meta = array('page_title'=>'Exercise for patient', null,null,'item_counter'=>(0));
        return view('practitioner.exercise-prescription.add-exercise')->with('meta', $meta)->with('table1', $table1)
            ->with('table2', Session::get('patient'));

    }


    public function storeExercise(Request $request){
        $input = $request->all();
      
        $input['user_id'] = Auth::user()->user_id;
        Manufacturer::create($input);

        Session::put('success','Manufacturer saved successfully!');

        return Redirect::Back();
    }

}
