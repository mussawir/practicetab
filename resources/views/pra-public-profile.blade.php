@extends('layouts.front')

@section('content')
    <section style="background-color: #f1f1f2; max-height: 180px;">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="profile-container" style="margin-top: 50px;">
                    <div style="max-width: 200px; display: block; float: left; position: absolute;">
                        @if(isset($pra->photo) && (!empty($pra->photo)))
                            <img src="{{asset('public/practitioners/'. $pra->directory .'/'.$pra->photo)}}" alt="Profile Photo" class="img-responsive" />
                        @else
                            <img src="{{asset('public/img/no-user.jpg')}}" alt="Profile Photo" class="img-responsive" />
                        @endif
                    </div>
                    <div style="padding-left: 218px;">
                        <h2>{{$pra->first_name}} {{$pra->middle_name}} {{$pra->last_name}}</h2>
                        <h4>{{$pra->clinic_name}}</h4>
                    </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="margin-top: 150px;">
                        <h4>HOURS OF OPERATION</h4>
                        <div style="font-size: 9px;">
                        <ul class="list-inline" style="margin-bottom: 0;"><li style="width: 150px;">Mon</li><li>{{$op_hours->monday_open}}</li></ul>
                        <ul class="list-inline" style="margin-bottom: 0;"><li style="width: 150px;">Tues</li><li>{{$op_hours->tuesday_open}}</li></ul>
                        <ul class="list-inline" style="margin-bottom: 0;"><li style="width: 150px;">Wed</li><li>{{$op_hours->wednesday_open}}</li></ul>
                        <ul class="list-inline" style="margin-bottom: 0;"><li style="width: 150px;">Thur</li><li>{{$op_hours->thursday_open}}</li></ul>
                        <ul class="list-inline" style="margin-bottom: 0;"><li style="width: 150px;">Sat</li><li>{{$op_hours->saturday_open}}</li></ul>
                        <ul class="list-inline" style="margin-bottom: 0;"><li style="width: 150px;">Fri</li><li>{{$op_hours->friday_open}}</li></ul>
                        <ul class="list-inline" style="margin-bottom: 0;"><li style="width: 150px;">Sun</li><li>{{$op_hours->sunday_open}}</li></ul>
                        </div>
                    </div>
                </div>
            </div>
            <div style="" class="col-md-8">
                <hr/>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div style="background-color: #f1f1f2; padding: 10px 20px;">
                        <h1 class="text-primary">Blog Post</h1>
                    @foreach($posts as $post)
                        <div style="border-bottom: 1px solid #aaa; margin-bottom: 10px; padding-bottom: 10px;">
                            <h2 class="text-primary">{{$post->heading}}</h2>
                            <div>
                                {!! substr($post->contents, 0, 300) !!}
                                <span>&nbsp;
                                    <a href="#" class="text-primary">Read More</a>
                                </span>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>
    </section>
@endsection