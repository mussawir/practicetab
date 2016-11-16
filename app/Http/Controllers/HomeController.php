<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\BlogPost;
use App\Models\Hours;
use App\Models\Pages;
use App\Models\Practitioner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function showPublicProfile($url = null)
    {
        $pra = Practitioner::where('url', '=', $url)->firstOrFail();
        $posts = BlogPost::where('pra_id', '=', $pra->pra_id)->orderBy('created_at', 'desc')->get();
        $op_hours = Hours::where('pra_id', '=', $pra->pra_id)->first();

        return view('pra-public-profile')->with('pra', $pra)
            ->with('posts', $posts)->with('op_hours', $op_hours);
    }

    public function showPageBySlug($slug = null)
    {
        $table1 = Pages::where('slug', '=', $slug)->firstOrFail();

        return view('cms')
            ->with('table1', $table1)
            ->with('meta', array('page_title'=>(isset($table1) ? $table1->title: '')));
    }
}
