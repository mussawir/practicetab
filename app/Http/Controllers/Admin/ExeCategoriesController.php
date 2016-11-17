<?php

namespace App\Http\Controllers\Admin;

use App\Models\Execategories;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image as InterventionImage;

class ExecategoriesController extends Controller
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
        $cats = Execategories::select('*')->orderBy('category', 'asc')->get();
        $meta = array('page_title'=>'Exercise Categories', 'exe_main_menu'=>'active', 'execat_sub_menu_list'=> 'active', 'item_counter'=>(isset($cats)?count($cats):0));

        return view('admin.execategories.index')->with('cats', $cats)->with('meta', $meta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meta = array('page_title'=>'Exercise Categories', 'exe_main_menu'=>'active', 'exe_sub_menu_new'=> 'active', 'item_counter'=>(0));

        return view('admin.execategories.new')->with('meta', $meta);
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
            'category' => 'required|max:100'
        ]);
/*
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
*/
        $input = $request->all();

        $filename = '';
        if($request->hasFile('cat_image')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file = $request->file('cat_image');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '-' .$file->getClientOriginalName();

            $file->move(public_path().'/img/execats/', $filename);
        }

       // $input['category'] =  $request->file('category');
        $input['cat_image'] = $filename;
        $input['user_id'] = Auth::user()->user_id;

        Execategories::create($input);

        Session::put('success','Category saved successfully!');

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
        $execat = Execategories::find($id);
        $meta = array('page_title'=>'Exercise Categories', 'exe_main_menu'=>'active', 'item_counter'=>(0));

        return view('admin.execategories.edit')->with('meta', $meta)->with('execat', $execat);
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
            'name' => 'required|max:100'
        ]);
/*
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
*/
        $execats = Execategories::find($request->execat_id);

        $filename = '';
        if($request->hasFile('cat_image')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file = $request->file('cat_image');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();

            if (isset($execats->cat_image) && (!empty($execats->cat_image))) {
                if(file_exists(public_path() . '/img/execats/' . $execats->cat_image)){
                    unlink(public_path() . '/img/execats/' . $execats->cat_image);
                }
               }

            $file->move(public_path().'/img/execats/', $filename);
        } else {
            $filename = $request->saved_logo;
        }

        $execats->cat_image = $filename;
        $execats->category = $request->category;
        $execats->save();

        Session::put('success','Category updated successfully!');

        return Redirect::to('/admin/execategories/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $execats = Execategories::find($id);
        if(isset($execats)){
            if (isset($execats->cat_image) && (!empty($execats->cat_image))) {
                if(file_exists(public_path() . '/img/execats/' . $execats->cat_image)) {
                    unlink(public_path() . '/img/execats/' . $execats->cat_image);
                }
            }
            $execats->delete();

            Session::put('success','Category is deleted successfully!');
            //return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }
}
