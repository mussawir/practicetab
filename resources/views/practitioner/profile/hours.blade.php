@extends('layouts.pradash')
@section('sidebar')
@include('layouts.profile-sidebar')
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li><a href="{{url('/practitioner/profile')}}">Hours of Operation</a></li>

</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Update Hours of Operation</h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
    <!-- begin col-6 -->
    <div class="col-md-12">
        <div class="msg">
            @if(Session::has('success'))
                <div class="alert alert-success fade in">
                    <strong>Success!</strong>
                    <strong>{{Session::pull('success')}}</strong>
                    <span class="close" data-dismiss="alert">×</span>
                </div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger fade in">
                    <strong>Error!</strong>
                    <strong>{{Session::pull('error')}}</strong>
                    <span class="close" data-dismiss="alert">×</span>
                </div>
            @endif
        </div>
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Update Details</h4>
            </div>
            <div class="panel-body">
                {!! Form::model($table1, array('url'=>'/practitioner/profile/hours-update', 'method' => 'PATCH', 'class'=> 'form-horizontal', 'files'=>true)) !!}
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('monday_open','Monday Open :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('monday_open',array(

"Closed"=>"Closed",
"By Appointment"=>"By Appointment",
"1 AM"=>"1 AM",
"2 AM"=>"2 AM",
"3 AM"=>"3 AM",
"4 AM"=>"4 AM",
"5 AM"=>"5 AM",
"6 AM"=>"6 AM",
"7 AM"=>"7 AM",
"8 AM"=>"8 AM",
"9 AM"=>"9 AM",
"10 AM"=>"10 AM",
"11 AM"=>"11 AM",
"12 PM"=>"12 PM",
"1 PM"=>"1 PM",
"2 PM"=>"2 PM",
"3 PM"=>"3 PM",
"4 PM"=>"4 PM",
"5 PM"=>"5 PM",
"6 PM"=>"6 PM",
"7 PM"=>"7 PM",
"8 PM"=>"8 PM",
"9 PM"=>"9 PM",
"10 PM"=>"10 PM",
"11 PM"=>"11 PM"
),$table1->monday_open, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('monday_close','Monday Close :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('monday_close',array(

"Closed"=>"Closed",
"By Appointment"=>"By Appointment",
"1 AM"=>"1 AM",
"2 AM"=>"2 AM",
"3 AM"=>"3 AM",
"4 AM"=>"4 AM",
"5 AM"=>"5 AM",
"6 AM"=>"6 AM",
"7 AM"=>"7 AM",
"8 AM"=>"8 AM",
"9 AM"=>"9 AM",
"10 AM"=>"10 AM",
"11 AM"=>"11 AM",
"12 PM"=>"12 PM",
"1 PM"=>"1 PM",
"2 PM"=>"2 PM",
"3 PM"=>"3 PM",
"4 PM"=>"4 PM",
"5 PM"=>"5 PM",
"6 PM"=>"6 PM",
"7 PM"=>"7 PM",
"8 PM"=>"8 PM",
"9 PM"=>"9 PM",
"10 PM"=>"10 PM",
"11 PM"=>"11 PM"
),$table1->monday_close, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('tuesday_open','Tuesday Open :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('tuesday_open',array(

"Closed"=>"Closed",
"By Appointment"=>"By Appointment",
"1 AM"=>"1 AM",
"2 AM"=>"2 AM",
"3 AM"=>"3 AM",
"4 AM"=>"4 AM",
"5 AM"=>"5 AM",
"6 AM"=>"6 AM",
"7 AM"=>"7 AM",
"8 AM"=>"8 AM",
"9 AM"=>"9 AM",
"10 AM"=>"10 AM",
"11 AM"=>"11 AM",
"12 PM"=>"12 PM",
"1 PM"=>"1 PM",
"2 PM"=>"2 PM",
"3 PM"=>"3 PM",
"4 PM"=>"4 PM",
"5 PM"=>"5 PM",
"6 PM"=>"6 PM",
"7 PM"=>"7 PM",
"8 PM"=>"8 PM",
"9 PM"=>"9 PM",
"10 PM"=>"10 PM",
"11 PM"=>"11 PM"
),$table1->tuesday_open, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('tuesday_close','Tuesday Close :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('tuesday_close',array(

"Closed"=>"Closed",
"By Appointment"=>"By Appointment",
"1 AM"=>"1 AM",
"2 AM"=>"2 AM",
"3 AM"=>"3 AM",
"4 AM"=>"4 AM",
"5 AM"=>"5 AM",
"6 AM"=>"6 AM",
"7 AM"=>"7 AM",
"8 AM"=>"8 AM",
"9 AM"=>"9 AM",
"10 AM"=>"10 AM",
"11 AM"=>"11 AM",
"12 PM"=>"12 PM",
"1 PM"=>"1 PM",
"2 PM"=>"2 PM",
"3 PM"=>"3 PM",
"4 PM"=>"4 PM",
"5 PM"=>"5 PM",
"6 PM"=>"6 PM",
"7 PM"=>"7 PM",
"8 PM"=>"8 PM",
"9 PM"=>"9 PM",
"10 PM"=>"10 PM",
"11 PM"=>"11 PM"
),$table1->tuesday_close, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('wednesday_open','Wednesday Open :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('wednesday_open',array(

"Closed"=>"Closed",
"By Appointment"=>"By Appointment",
"1 AM"=>"1 AM",
"2 AM"=>"2 AM",
"3 AM"=>"3 AM",
"4 AM"=>"4 AM",
"5 AM"=>"5 AM",
"6 AM"=>"6 AM",
"7 AM"=>"7 AM",
"8 AM"=>"8 AM",
"9 AM"=>"9 AM",
"10 AM"=>"10 AM",
"11 AM"=>"11 AM",
"12 PM"=>"12 PM",
"1 PM"=>"1 PM",
"2 PM"=>"2 PM",
"3 PM"=>"3 PM",
"4 PM"=>"4 PM",
"5 PM"=>"5 PM",
"6 PM"=>"6 PM",
"7 PM"=>"7 PM",
"8 PM"=>"8 PM",
"9 PM"=>"9 PM",
"10 PM"=>"10 PM",
"11 PM"=>"11 PM"
),$table1->wednessday_open, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('wednesday_close','Wednesday Close :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('wednessday_close',array(

"Closed"=>"Closed",
"By Appointment"=>"By Appointment",
"1 AM"=>"1 AM",
"2 AM"=>"2 AM",
"3 AM"=>"3 AM",
"4 AM"=>"4 AM",
"5 AM"=>"5 AM",
"6 AM"=>"6 AM",
"7 AM"=>"7 AM",
"8 AM"=>"8 AM",
"9 AM"=>"9 AM",
"10 AM"=>"10 AM",
"11 AM"=>"11 AM",
"12 PM"=>"12 PM",
"1 PM"=>"1 PM",
"2 PM"=>"2 PM",
"3 PM"=>"3 PM",
"4 PM"=>"4 PM",
"5 PM"=>"5 PM",
"6 PM"=>"6 PM",
"7 PM"=>"7 PM",
"8 PM"=>"8 PM",
"9 PM"=>"9 PM",
"10 PM"=>"10 PM",
"11 PM"=>"11 PM"
),$table1->wednesday_close, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('thursday_open','Thursday Open :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('thursday_open',array(

"Closed"=>"Closed",
"By Appointment"=>"By Appointment",
"1 AM"=>"1 AM",
"2 AM"=>"2 AM",
"3 AM"=>"3 AM",
"4 AM"=>"4 AM",
"5 AM"=>"5 AM",
"6 AM"=>"6 AM",
"7 AM"=>"7 AM",
"8 AM"=>"8 AM",
"9 AM"=>"9 AM",
"10 AM"=>"10 AM",
"11 AM"=>"11 AM",
"12 PM"=>"12 PM",
"1 PM"=>"1 PM",
"2 PM"=>"2 PM",
"3 PM"=>"3 PM",
"4 PM"=>"4 PM",
"5 PM"=>"5 PM",
"6 PM"=>"6 PM",
"7 PM"=>"7 PM",
"8 PM"=>"8 PM",
"9 PM"=>"9 PM",
"10 PM"=>"10 PM",
"11 PM"=>"11 PM"
),$table1->thursday_open, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('thursday_close','Thursday Close :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('thursday_close',array(

"Closed"=>"Closed",
"By Appointment"=>"By Appointment",
"1 AM"=>"1 AM",
"2 AM"=>"2 AM",
"3 AM"=>"3 AM",
"4 AM"=>"4 AM",
"5 AM"=>"5 AM",
"6 AM"=>"6 AM",
"7 AM"=>"7 AM",
"8 AM"=>"8 AM",
"9 AM"=>"9 AM",
"10 AM"=>"10 AM",
"11 AM"=>"11 AM",
"12 PM"=>"12 PM",
"1 PM"=>"1 PM",
"2 PM"=>"2 PM",
"3 PM"=>"3 PM",
"4 PM"=>"4 PM",
"5 PM"=>"5 PM",
"6 PM"=>"6 PM",
"7 PM"=>"7 PM",
"8 PM"=>"8 PM",
"9 PM"=>"9 PM",
"10 PM"=>"10 PM",
"11 PM"=>"11 PM"
),$table1->thursday_close, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('friday_open','Friday Open :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('friday_open',array(

"Closed"=>"Closed",
"By Appointment"=>"By Appointment",
"1 AM"=>"1 AM",
"2 AM"=>"2 AM",
"3 AM"=>"3 AM",
"4 AM"=>"4 AM",
"5 AM"=>"5 AM",
"6 AM"=>"6 AM",
"7 AM"=>"7 AM",
"8 AM"=>"8 AM",
"9 AM"=>"9 AM",
"10 AM"=>"10 AM",
"11 AM"=>"11 AM",
"12 PM"=>"12 PM",
"1 PM"=>"1 PM",
"2 PM"=>"2 PM",
"3 PM"=>"3 PM",
"4 PM"=>"4 PM",
"5 PM"=>"5 PM",
"6 PM"=>"6 PM",
"7 PM"=>"7 PM",
"8 PM"=>"8 PM",
"9 PM"=>"9 PM",
"10 PM"=>"10 PM",
"11 PM"=>"11 PM"
),$table1->friday_open, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('friday_close','Friday Close :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('friday_close',array(

"Closed"=>"Closed",
"By Appointment"=>"By Appointment",
"1 AM"=>"1 AM",
"2 AM"=>"2 AM",
"3 AM"=>"3 AM",
"4 AM"=>"4 AM",
"5 AM"=>"5 AM",
"6 AM"=>"6 AM",
"7 AM"=>"7 AM",
"8 AM"=>"8 AM",
"9 AM"=>"9 AM",
"10 AM"=>"10 AM",
"11 AM"=>"11 AM",
"12 PM"=>"12 PM",
"1 PM"=>"1 PM",
"2 PM"=>"2 PM",
"3 PM"=>"3 PM",
"4 PM"=>"4 PM",
"5 PM"=>"5 PM",
"6 PM"=>"6 PM",
"7 PM"=>"7 PM",
"8 PM"=>"8 PM",
"9 PM"=>"9 PM",
"10 PM"=>"10 PM",
"11 PM"=>"11 PM"
),$table1->friday_close, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('saturday_open','Saturday Open :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('saturday_open',array(

"Closed"=>"Closed",
"By Appointment"=>"By Appointment",
"1 AM"=>"1 AM",
"2 AM"=>"2 AM",
"3 AM"=>"3 AM",
"4 AM"=>"4 AM",
"5 AM"=>"5 AM",
"6 AM"=>"6 AM",
"7 AM"=>"7 AM",
"8 AM"=>"8 AM",
"9 AM"=>"9 AM",
"10 AM"=>"10 AM",
"11 AM"=>"11 AM",
"12 PM"=>"12 PM",
"1 PM"=>"1 PM",
"2 PM"=>"2 PM",
"3 PM"=>"3 PM",
"4 PM"=>"4 PM",
"5 PM"=>"5 PM",
"6 PM"=>"6 PM",
"7 PM"=>"7 PM",
"8 PM"=>"8 PM",
"9 PM"=>"9 PM",
"10 PM"=>"10 PM",
"11 PM"=>"11 PM"
),$table1->saturday_open, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('saturday_close','Saturay Close :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('saturday_close',array(

"Closed"=>"Closed",
"By Appointment"=>"By Appointment",
"1 AM"=>"1 AM",
"2 AM"=>"2 AM",
"3 AM"=>"3 AM",
"4 AM"=>"4 AM",
"5 AM"=>"5 AM",
"6 AM"=>"6 AM",
"7 AM"=>"7 AM",
"8 AM"=>"8 AM",
"9 AM"=>"9 AM",
"10 AM"=>"10 AM",
"11 AM"=>"11 AM",
"12 PM"=>"12 PM",
"1 PM"=>"1 PM",
"2 PM"=>"2 PM",
"3 PM"=>"3 PM",
"4 PM"=>"4 PM",
"5 PM"=>"5 PM",
"6 PM"=>"6 PM",
"7 PM"=>"7 PM",
"8 PM"=>"8 PM",
"9 PM"=>"9 PM",
"10 PM"=>"10 PM",
"11 PM"=>"11 PM"
),$table1->saturday_close, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('sunday_open','Sunday Open :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('sunday_open',array(

"Closed"=>"Closed",
"By Appointment"=>"By Appointment",
"1 AM"=>"1 AM",
"2 AM"=>"2 AM",
"3 AM"=>"3 AM",
"4 AM"=>"4 AM",
"5 AM"=>"5 AM",
"6 AM"=>"6 AM",
"7 AM"=>"7 AM",
"8 AM"=>"8 AM",
"9 AM"=>"9 AM",
"10 AM"=>"10 AM",
"11 AM"=>"11 AM",
"12 PM"=>"12 PM",
"1 PM"=>"1 PM",
"2 PM"=>"2 PM",
"3 PM"=>"3 PM",
"4 PM"=>"4 PM",
"5 PM"=>"5 PM",
"6 PM"=>"6 PM",
"7 PM"=>"7 PM",
"8 PM"=>"8 PM",
"9 PM"=>"9 PM",
"10 PM"=>"10 PM",
"11 PM"=>"11 PM"
),$table1->sunday_open, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('sunday_close','Sunday Close :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('sunday_close',array(

"Closed"=>"Closed",
"By Appointment"=>"By Appointment",
"1 AM"=>"1 AM",
"2 AM"=>"2 AM",
"3 AM"=>"3 AM",
"4 AM"=>"4 AM",
"5 AM"=>"5 AM",
"6 AM"=>"6 AM",
"7 AM"=>"7 AM",
"8 AM"=>"8 AM",
"9 AM"=>"9 AM",
"10 AM"=>"10 AM",
"11 AM"=>"11 AM",
"12 PM"=>"12 PM",
"1 PM"=>"1 PM",
"2 PM"=>"2 PM",
"3 PM"=>"3 PM",
"4 PM"=>"4 PM",
"5 PM"=>"5 PM",
"6 PM"=>"6 PM",
"7 PM"=>"7 PM",
"8 PM"=>"8 PM",
"9 PM"=>"9 PM",
"10 PM"=>"10 PM",
"11 PM"=>"11 PM"
),$table1->sunday_close, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    {!! Form::submit('Update', array('class'=>'btn btn-success pull-right')) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col 6 -->
</div>
<!-- end row -->
@endsection

@section('page-scripts')
    <script language="JavaScript/text">

    </script>
@endsection
