<?php

namespace App\Http\Controllers\Practitioner;

use App\Models\BlogPost;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image as InterventionImage;

class BlogController extends Controller
{
    protected $baseUrl;

    public function __construct(UrlGenerator $url)
    {
        $this->baseUrl = $url;
        Session::set('marketing', 'active');
        Session::pull('management');
        Session::pull('dashboard');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prac = Session::get('practitioner_session');
        $table1 = BlogPost::select('*')->where('pra_id', $prac['pra_id'])->orderBy('post_id', 'asc')->get();
        return view('practitioner.blog.index')->with('table1', $table1)
            ->with('meta', array('page_title'=>'Posts List',isset($table1)?count($table1):0))
            ->with('blogging','active')
            ->with('my_post','active')
            ->with('directory', $prac['directory']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('practitioner.blog.new')
            ->with('meta', array('page_title'=>'New Blog Post'))
            ->with('blogging','active')
            ->with('new_post','active');;
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
        $input = $request->all();
        $prac = Session::get('practitioner_session');
        $input['pra_id'] = $prac['pra_id'];
        BlogPost::create($input);
        Session::put('success','New Post is published!');
        return Redirect::to('/practitioner/blog/');
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
        $table1 = BlogPost::find($id);
        $prac = Session::get('practitioner_session');
        return view('practitioner.blog.edit')
            ->with('table1', $table1)
            ->with('meta', array('page_title'=>'Edit Blog Post'))
            ->with('blogging','active')
            ->with('directory', $prac['directory']);
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
        $prac = Session::get('practitioner_session');
        $table1 = BlogPost::find($request->post_id);
        $table1->heading = $request->heading;
        $table1->contents = $request->contents;
        $table1->save();
        Session::put('success','You post is updated successfully!');
        return Redirect::to('/practitioner/blog/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table1 = Patient::find(id);
        if(isset($table1)){
            if (isset($table1->photo) && (!empty($table1->photo))) {
                if(file_exists(public_path() . '/practitioner/peter222220/' . $table1->photo)){
                    unlink(public_path() . '/practitioner/peter222220/' . $table1->photo);
                }
            }
            $table1->delete();
            Session::put('success','Patient is deleted successfully!');
            //return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }
}
