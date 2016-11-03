<?php

namespace App\Http\Controllers;

use App\scheduler;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SchedulerController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->all();
        scheduler::create($input);
    }

    public function saveData()
    {
        $inputs = array();
        return 'success';
    }
}
