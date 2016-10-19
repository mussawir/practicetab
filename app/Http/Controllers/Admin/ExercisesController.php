<?php

namespace App\Http\Controllers\Admin;

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

        return view('admin.exercises.index')->with('exercises', $exercises)->with('meta', $meta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meta = array('page_title'=>'Add New Exercise', 'exe_main_menu'=>'active', 'exe_sub_menu_new'=> 'active', 'item_counter'=>(0));
        $execats = Execategories::select('execat_id', 'category')->orderBy('category', 'asc')->get();

        return view('admin.exercises.new')->with('meta', $meta)->with('execats', $execats);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->toArray(), [
            'content' => 'required|max:8000',
            'execat_id' => 'required',
            'short_description' => 'required',
        ], [
            'man_id.required' => 'The manufacturers field is required.',
        ]);
/*
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
*/
        $input = $request->all();

        $filename = '';
        if($request->hasFile('main_image')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file = $request->file('main_image');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();

            $file->move(public_path().'/img/exercise/', $filename);
        }

        $input['main_image'] = $filename;
      //  $input['content'] = 'content';
        $input['user_id'] = Auth::user()->user_id;
        Exercises::create($input);

        Session::put('success','Exercise is saved successfully!');

        return Redirect::Back();
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
        $exercises = Exercises::find($id);
        $execats = Execategories::select('execat_id', 'category')->orderBy('category', 'asc')->get();
        $meta = array('page_title'=>'Edit Exercises', 'exe_main_menu'=>'active', 'item_counter'=>(0));

        return view('admin.exercises.edit')->with('meta', $meta)->with('exercises', $exercises)
            ->with('execats', $execats);
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
        $validator = \Validator::make($request->toArray(), [
            'name' => 'required|max:100',
            'man_id' => 'required',
            'short_description' => 'required',
        ], [
            'man_id.required' => 'The manufacturers field is required.',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $exercise = Exercises::find($request->sup_id);

        $filename = '';
        if($request->hasFile('main_image')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file = $request->file('main_image');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();

            if (isset($exercise->main_image) && (!empty($exercise->main_image))) {
                unlink(public_path() . '/dashboard/img/sup-img/' . $exercise->main_image);
            }

            $file->move(public_path().'/dashboard/img/sup-img/', $filename);
        } else {
            $filename = $request->saved_image;
        }

        $exercise->main_image = $filename;
        $exercise->name = $request->name;
        $exercise->man_id = $request->man_id;
        $exercise->used_for = $request->used_for;
        $exercise->url = $request->url;
        $exercise->how_to_get = $request->how_to_get;
        $exercise->benefits = $request->benefits;
        $exercise->usability = $request->usability;
        $exercise->main_price = $request->main_price;
        $exercise->discount = $request->discount;
        $exercise->short_description = $request->short_description;
        $exercise->long_description = $request->long_description;
        $exercise->save();

        Session::put('success','Exercises updated successfully!');

        return Redirect::to('/admin/exercises/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exercise = Exercises::find($id);
        if(isset($exercise)){
            if (isset($exercise->main_image) && (!empty($exercise->main_image))) {
                if(file_exists(public_path() . '/img/exercise/' . $exercise->main_image)) {
                    unlink(public_path() . '/img/exercise/' . $exercise->main_image);
                }
            }
            $exercise->delete();

            Session::put('success','Exercise deleted successfully!');
            //return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }
}
