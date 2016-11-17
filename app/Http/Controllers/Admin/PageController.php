<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pages;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function __construct()
    {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table1 = Pages::where('user_id', Auth::user()->user_id)->orderBy('created_at', 'desc')->get();

        return view('admin.page.index')->with('table1', $table1)
            ->with('meta', array('page_title'=>'Page List', 'item_counter'=> isset($table1)?count($table1):0))
            ->with('pages_menu','active')
            ->with('page_list','active');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.new')
            ->with('meta', array('page_title'=>'New Page', 'item_counter'=>0))
            ->with('pages_menu','active')
            ->with('new_page','active');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
                $validator = \Validator::make($request->toArray(), [
                    'category' => 'required|max:100'
                ]);
                if ($validator->fails()) {
                    return Redirect::back()->withErrors($validator)->withInput();
                }
        */
        $inputs = $request->all();
        $inputs['user_id'] = Auth::user()->user_id;

        Pages::create($inputs);

        Session::put('success','New page is published!');

        return Redirect::to('/admin/page/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $table1 = Pages::find($id);

        return view('admin.page.edit')
            ->with('table1', $table1)
            ->with('meta', array('page_title'=>'Edit Page', 'item_counter'=>0))
            ->with('pages_menu','active');
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
        /*
                $validator = \Validator::make($request->toArray(), [
                    'name' => 'required|max:100'
                ]);

                if ($validator->fails()) {
                    return Redirect::back()->withErrors($validator)->withInput();
                }
        */
        $table1 = Pages::find($request->page_id);
        $table1->title = $request->title;
        $table1->contents = $request->contents;
        $table1->save();

        Session::put('success','Page is updated successfully!');

        return Redirect::to('/admin/page/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table1 = Pages::find($id);
        if(isset($table1)){
            $table1->delete();

            Session::put('success','Page is deleted successfully!');
            //return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }
}
