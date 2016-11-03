<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\Practitioner;
use App\Models\scheduler;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ManagementController extends Controller
{
    var $practitioner_info = null;
    public function __construct()
    {
        $this->practitioner_info = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
        Session::set('management', 'active');
        Session::pull('marketing');
        Session::pull('dashboard');


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('practitioner.management.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function saveData(Request $request)
    {
        $myId =  $request->id;
        $scheduler = new scheduler();
        $scheduler->patient_id = $myId;
        $scheduler->reason = $request->reason;
        $scheduler->pDate = $request->pDate;
        $scheduler->pTime = $request->pTime;
        $scheduler->pDuration = $request->pDuration;
        $scheduler->pColor = $request->pColor;
        $scheduler->pstatus = $request->pstatus;
        $scheduler->app_desc = $request->app_desc;
        $scheduler->save();
        return 'success';
    }
}
