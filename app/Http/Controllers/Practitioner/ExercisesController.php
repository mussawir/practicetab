<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\Execategories;
use App\Models\Exercises;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ExercisesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exercises = Exercises::select('*')->orderBy('heading', 'asc')->get();
        $meta = array('page_title'=>'Exercises', 'exe_main_menu'=>'active', 'exe_sub_menu_list'=> 'active', 'item_counter'=>(isset($exercises)?count($exercises):0));

        return view('practitioner.exercises.index')->with('exercises', $exercises)->with('meta', $meta);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exercises = Exercises::find($id);
        $execats = Execategories::select('execat_id', 'category')->orderBy('category', 'asc')->get();
        $meta = array('page_title'=>'Exercise Details', 'exe_main_menu'=>'active', 'item_counter'=>(0));

        return view('practitioner.exercises.details')->with('meta', $meta)->with('exercises', $exercises)
            ->with('execats', $execats);
    }

  }