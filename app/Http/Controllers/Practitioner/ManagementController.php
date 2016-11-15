<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\Practitioner;
use App\Models\scheduler;
use Illuminate\Http\Request;
use DB;
use App\Quotation;
use App\Models\Patient;
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
    public function Fetchschedule()
    {
        $scheduler = DB::table('scheduler')
            ->where('pStatus','<>','13')
            ->get();

        foreach ($scheduler as $schedule)
        {
            echo $schedule->id .' ) Name : '.$schedule->patient_id . '. Reason : ' .$schedule->reason;
            echo ';';
            echo $schedule->pDate;
            echo ';';
            echo $schedule->pTime;
            echo ';';
            echo $schedule->pDuration;
            echo ';';
            echo $schedule->pColor;
            echo '|';
        }
    }
    public function FetchscheduleRow(Request $request)
    {
        $scheduler = DB::table('scheduler')->where([
            ['id', '=', $request->id],
        ])->get();
        foreach ($scheduler as $schedule) {
            echo $schedule->patient_id;
            echo ';';
            echo $schedule->pDate;
            echo ';';
            echo $schedule->reason;
            echo ';';
            echo $schedule->app_desc;
            echo ';';
            echo $schedule->pTime;
            echo ';';
            echo $schedule->pDuration;
            echo ';';
            echo $schedule->pColor;
            echo ';';
            echo $schedule->pstatus;
        }
    }
    public function FetchscheduleMax()
    {
        echo  DB::table('scheduler')->max('id');
    }
    public function updateScheduleData(Request $request)
    {
        $myId =  $request->id;
        $update = scheduler::find($myId);
        $update->pDate = $request->pDate;
        $update->reason = $request->reason;
        $update->pTime = $request->pTime;
        $update->pDuration = $request->pDuration;
        $update->pColor = $request->pColor;
        $update->app_desc = $request->app_desc;
        $update->pstatus = $request->pstatus;
        $update->patient_id = $request->patient_id;
        $update->save();
    }
    public function ifExist($date,$duration,$time)
    {
        if (scheduler::where([
            ['pDate', '=', $date],
            ['pDuration', '=', $duration],
            ['pTime', '=', $time]
            ,])->exists()) {
            return 'found';
        }
        else
        {
            return 'not found';
        }
    }
    public function saveData(Request $request)
    {
        $add=0;
        $goOrNot = $this->ifExist($request->pDate,$request->pDuration,$request->pTime);
        if($goOrNot=="found")
        {
            $timeExp = explode(":",$request->pTime);
            $add = (int)$timeExp[1] + 15;
            $request->pTime = $timeExp[0].':'.$add;
        }

        $practitioner = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();;
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
        $scheduler->practitioner_id=$practitioner->first_name . ' ' . $practitioner->middle_name.' '.$practitioner->last_name;
        $scheduler->save();
        return 'success';
    }
}
