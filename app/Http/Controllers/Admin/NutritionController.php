<?php

namespace App\Http\Controllers\Admin;

use App\Models\Manufacturer;
use App\Models\Nutrition;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class NutritionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nutritions = DB::table("nutritions AS n")
            ->join("manufacturers AS m", "m.man_id", "=", "n.man_id")
            ->select('n.*', 'm.name as manufacName')
            ->get();

        $meta = array('page_title'=>'Nutrition', 'nut_main_menu'=>'active', 'nut_sub_menu_list'=> 'active', 'item_counter'=>(isset($nutritions)?count($nutritions):0));

        return view('admin.nutritions.index')->with('nutritions', $nutritions)->with('meta', $meta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meta = array('page_title'=>'Create New Nutrition', 'nut_main_menu'=>'active', 'nut_sub_menu_new'=> 'active', 'item_counter'=>(0));
        $manufacturers = Manufacturer::select('man_id', 'name')->orderBy('name', 'asc')->get();

        return view('admin.nutritions.new')->with('meta', $meta)->with('manufacturers', $manufacturers);
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
            'name' => 'required|max:100',
            'man_id' => 'required',
            'short_description' => 'required',
        ], [
            'man_id.required' => 'The manufacturers field is required.',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        $filename = '';
        if($request->hasFile('main_image')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file = $request->file('main_image');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();

            $file->move(public_path().'/dashboard/img/nutrition/', $filename);
        }

        $input['main_image'] = $filename;
        $input['user_id'] = Auth::user()->user_id;
        Nutrition::create($input);

        Session::put('success','Nutrition saved successfully!');

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
        $nutrition = Nutrition::find($id);
        $manufacturers = Manufacturer::select('man_id', 'name')->orderBy('name', 'asc')->get();
        $meta = array('page_title'=>'Edit Nutrition', 'nut_main_menu'=>'active', 'item_counter'=>(0));

        return view('admin.nutritions.edit')->with('meta', $meta)->with('nutrition', $nutrition)
            ->with('manufacturers', $manufacturers);
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

        $nutrition = Nutrition::find($request->nut_id);

        $filename = '';
        if($request->hasFile('main_image')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file = $request->file('main_image');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();

            if (isset($nutrition->main_image) && (!empty($nutrition->main_image))) {
                unlink(public_path() . '/dashboard/img/nutrition/' . $nutrition->main_image);
            }

            $file->move(public_path().'/dashboard/img/nutrition/', $filename);
        } else {
            $filename = $request->saved_image;
        }

        $nutrition->main_image = $filename;
        $nutrition->name = $request->name;
        $nutrition->man_id = $request->man_id;
        $nutrition->url = $request->url;
        $nutrition->how_to_get = $request->how_to_get;
        $nutrition->benefits = $request->benefits;
        $nutrition->usability = $request->usability;
        $nutrition->main_price = $request->main_price;
        $nutrition->discount = $request->discount;
        $nutrition->short_description = $request->short_description;
        $nutrition->long_description = $request->long_description;
        $nutrition->save();

        Session::put('success','Nutrition updated successfully!');

        return Redirect::to('/admin/nutrition');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nutrition = Nutrition::find($id);
        if(isset($nutrition)){
            if (isset($nutrition->main_image) && (!empty($nutrition->main_image))) {
                unlink(public_path() . '/dashboard/img/nutrition/' . $nutrition->main_image);
            }
            $nutrition->delete();

            Session::put('success','Nutrition deleted successfully!');
            //return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }
}
