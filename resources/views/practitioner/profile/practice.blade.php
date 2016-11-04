@extends('layouts.pradash')
@section('sidebar')
@include('layouts.profile-sidebar')
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li><a href="{{url('/practitioner/profile')}}">Update Practice Profile</a></li>

</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Update Practice Profile</h1>
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
                {!! Form::model($table1, array('url'=>'/practitioner/profile/practice-update', 'method' => 'PATCH', 'class'=> 'form-horizontal', 'files'=>true)) !!}
                <div class="col-md-12">
                    <h4>About & Expertise </h4>    <hr/></div>
                  <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('about','About You :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::textarea('about', null, array('class'=>'form-control', 'placeholder'=> 'Write a good introduction' )) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('website_url','Website URL :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('website_url', null, array('class'=>'form-control', 'placeholder'=> 'Add Website URL if any' )) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('practice_years','Year of Practice:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('practice_years', null, array('class'=>'form-control', 'placeholder'=> 'Document Footer')) !!}
                        </div>
                    </div>
                </div>
             <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('degree','Degree :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('degree', null, array('class'=>'form-control', 'placeholder'=> 'Medical Doctor, Chiropractor, Acupuncture')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('accepts_new_patients','Accepts New Patients :', array('class'=>'col-md-4 control-label')) !!}
                        <div class="col-md-8">
                            {!! Form::select('accepts_new_patients', array('Yes', 'No'),$table1->accepts_new_patients, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h4>Accepted Insurance </h4>    <hr/></div>
                <div class="col-md-6">
                    <div class="form-group">
                     {!! Form::label('ai_woc','WOC :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::checkbox('ai_woc', $table1->ai_woc,$table1->ai_woc, array('class'=>'control-label')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('ai_pi','PI :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::checkbox('ai_pi', $table1->ai_pi, $table1->ai_pi) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('ai_ppo','PPO :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::checkbox('ai_ppo', $table1->ai_ppo, $table1->ai_ppo) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('ai_hmo','HMO :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::checkbox('ai_hmo', $table1->ai_hmo, $table1->ai_hmo) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('ai_medicaid','MEDICAID :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::checkbox('ai_medicaid', $table1->ai_medicaid, $table1->ai_medicaid) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('ai_medicare','MEDICARE :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::checkbox('ai_medicare', $table1->ai_medicare, $table1->ai_medicare) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h4>Languages & Specialities </h4>    <hr/></div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('languages_spoken','Languages :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('languages_spoken', null, array('class'=>'form-control', 'placeholder'=> 'English, Spanish, French etc.')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('specialties','specialties :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('specialties', null, array('class'=>'form-control', 'placeholder'=> 'Enter your Specialities')) !!}
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
