<?php

namespace App\Http\Controllers\Admin;

use App\Models\Manufacturer;
use App\Models\Supplement;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SupplementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplements = DB::table("supplements AS s")
            ->join("manufacturers AS m", "m.man_id", "=", "s.man_id")
            ->select('s.*', 'm.name as manufacName')
            //->where('u.user_id', '!=', Auth::user()->user_id)
            ->get();

        $meta = array('page_title'=>'Supplements', 'sup_main_menu'=>'active', 'sup_sub_menu_list'=> 'active', 'item_counter'=>(isset($supplements)?count($supplements):0));

        return view('admin.supplements.index')->with('supplements', $supplements)->with('meta', $meta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meta = array('page_title'=>'Create New Supplement', 'sup_main_menu'=>'active', 'sup_sub_menu_new'=> 'active', 'item_counter'=>(0));
        $manufacturers = Manufacturer::select('man_id', 'name')->orderBy('name', 'asc')->get();

        return view('admin.supplements.new')->with('meta', $meta)->with('manufacturers', $manufacturers);
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

            $file->move(public_path().'/dashboard/img/sup-img/', $filename);
        }

        $input['main_image'] = $filename;
        $input['user_id'] = Auth::user()->user_id;
        Supplement::create($input);

        Session::put('success','Supplement saved successfully!');

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
        $supplement = Supplement::find($id);
        $manufacturers = Manufacturer::select('man_id', 'name')->orderBy('name', 'asc')->get();
        $meta = array('page_title'=>'Edit Supplement', 'sup_main_menu'=>'active', 'item_counter'=>(0));

        return view('admin.supplements.edit')->with('meta', $meta)->with('supplement', $supplement)
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

        $supplement = Supplement::find($request->sup_id);

        $filename = '';
        if($request->hasFile('main_image')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file = $request->file('main_image');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();

            if (isset($supplement->main_image) && (!empty($supplement->main_image))) {
                unlink(public_path() . '/dashboard/img/sup-img/' . $supplement->main_image);
            }

            $file->move(public_path().'/dashboard/img/sup-img/', $filename);
        } else {
            $filename = $request->saved_image;
        }

        $supplement->main_image = $filename;
        $supplement->name = $request->name;
        $supplement->man_id = $request->man_id;
        $supplement->used_for = $request->used_for;
        $supplement->url = $request->url;
        $supplement->how_to_get = $request->how_to_get;
        $supplement->benefits = $request->benefits;
        $supplement->usability = $request->usability;
        $supplement->main_price = $request->main_price;
        $supplement->discount = $request->discount;
        $supplement->short_description = $request->short_description;
        $supplement->long_description = $request->long_description;
        $supplement->save();

        Session::put('success','Supplement updated successfully!');

        return Redirect::to('/admin/supplements/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplement = Supplement::find($id);
        if(isset($supplement)){
            if (isset($supplement->main_image) && (!empty($supplement->main_image))) {
                unlink(public_path() . '/dashboard/img/sup-img/' . $supplement->main_image);
            }
            $supplement->delete();

            Session::put('success','Supplement deleted successfully!');
            //return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }
}
