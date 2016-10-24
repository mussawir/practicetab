<?php

namespace App\Http\Controllers\Admin;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image as InterventionImage;

class ManufacturerController extends Controller
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
        $manufactures = Manufacturer::select('*')->orderBy('name', 'asc')->get();
        $meta = array('page_title'=>'Manufacturer', 'man_main_menu'=>'active', 'man_sub_menu_list'=> 'active', 'item_counter'=>(isset($manufactures)?count($manufactures):0));

        return view('admin.manufacturer.index')->with('manufactures', $manufactures)->with('meta', $meta);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meta = array('page_title'=>'Manufacturer', 'man_main_menu'=>'active', 'man_sub_menu_new'=> 'active', 'item_counter'=>(0));

        return view('admin.manufacturer.new')->with('meta', $meta);
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
            'name' => 'required|max:100'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        $filename = '';
        if($request->hasFile('logo_image')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file = $request->file('logo_image');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();

            $file->move(public_path().'/dashboard/img/manufac-img/', $filename);
        }

        $input['logo_image'] = $filename;
        $input['user_id'] = Auth::user()->user_id;
        Manufacturer::create($input);

        Session::put('success','Manufacturer saved successfully!');

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
        $manufacturer = Manufacturer::find($id);
        $meta = array('page_title'=>'Manufacturer', 'man_main_menu'=>'active', 'item_counter'=>(0));
        return view('admin.manufacturer.edit')->with('meta', $meta)->with('manufacturer', $manufacturer);
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

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $manufacturer = Manufacturer::find($request->man_id);

        $filename = '';
        if($request->hasFile('logo_image')) {
            //$file = InterventionImage::make($request->file('logo_image'));
            $file = $request->file('logo_image');
            $rand_num = rand(11111, 99999);
            $filename = $rand_num. '_' .$file->getClientOriginalName();

            if (isset($manufacturer->logo_image) && (!empty($manufacturer->logo_image))) {
                unlink(public_path() . '/dashboard/img/manufac-img/' . $manufacturer->logo_image);
            }

            $file->move(public_path().'/dashboard/img/manufac-img/', $filename);
        } else {
            $filename = $request->saved_logo;
        }

        $manufacturer->logo_image = $filename;
        $manufacturer->name = $request->name;
        $manufacturer->save();

        Session::put('success','Manufacturer updated successfully!');

        return Redirect::to('/admin/manufacturer/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manufacturer = Manufacturer::find($id);
        if(isset($manufacturer)){
            if (isset($manufacturer->logo_image) && (!empty($manufacturer->logo_image))) {
                unlink(public_path() . '/dashboard/img/manufac-img/' . $manufacturer->logo_image);
            }
            $manufacturer->delete();

            Session::put('success','Manufacturer deleted successfully!');
            //return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }
}
