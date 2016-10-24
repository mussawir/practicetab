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
        $exercises = Exercises::select('*')->orderBy('exe_id', 'desc')->get();
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
        if($request->hasFile('image1')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file = $request->file('image1');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();
            $file->move(public_path().'/img/exercise/', $filename);
        }

        $filename1 = '';
        if($request->hasFile('image2')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file1 = $request->file('image2');
            $rand_num = rand(11111, 99999);
            $filename1 = $rand_num. '_' .$file1->getClientOriginalName();
            $file1->move(public_path().'/img/exercise/', $filename1);
        }

        $input['image1'] = $filename;
        $input['image2'] = $filename1;
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

        return view('admin.exercises.edit')->with('meta', $meta)->with('exercises', $exercises)->with('execats', $execats);
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
/*
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
*/
        $exercise = Exercises::find($request->exe_id);

        $filename = '';
        if($request->hasFile('image1')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file = $request->file('image1');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();

            if (isset($exercise->image1) && (!empty($exercise->image1))) {
                if(file_exists(public_path() . '/img/exercise/' . $exercise->image1)) {
                unlink(public_path() . '/img/exercise/' . $exercise->image1);
            }
                $file->move(public_path().'/img/exercise/', $filename);
            }

        } else {
            $filename = $request->saved_image1;
        }

        $filename1 = '';
        if($request->hasFile('image2')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file1 = $request->file('image2');
            $rand_num = rand(11111, 99999);
            $filename1 = $rand_num. '_' .$file1->getClientOriginalName();

            if (isset($exercise->image2) && (!empty($exercise->image2))) {
                if(file_exists(public_path() . '/img/exercise/' . $exercise->image2)) {
                    unlink(public_path() . '/img/exercise/' . $exercise->image2);
                }
                $file1->move(public_path().'/img/exercise/', $filename1);
            }


        } else {
            $filename1 = $request->saved_image2;
        }


        $exercise->image1 = $filename;
        $exercise->image2 = $filename1;
        $exercise->execat_id = $request->execat_id;
        $exercise->heading = $request->heading;
        $exercise->description = $request->description;
        $exercise->save();

        Session::put('success','Exercise updated successfully!');

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
            if (isset($exercise->image1) && (!empty($exercise->image1))) {
                if(file_exists(public_path() . '/img/exercise/' . $exercise->image1)) {
                    if(file_exists(public_path() . '/img/exercise/' . $exercise->image1)) {
                    unlink(public_path() . '/img/exercise/' . $exercise->image1);
                }
                }
            }

            if (isset($exercise->image2) && (!empty($exercise->image2))) {
                if(file_exists(public_path() . '/img/exercise/' . $exercise->image2)) {
                    if(file_exists(public_path() . '/img/exercise/' . $exercise->image2)) {
                        unlink(public_path() . '/img/exercise/' . $exercise->image2);
                    }
                }
            }
            $exercise->delete();
            Session::put('success','Exercise deleted successfully!');
            //return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }
}
