@extends('layouts.pradash')

@section('sidebar')
@include('layouts.mark-sidebar')
@endsection

@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner/marketing')}}">Marketing Dashboard</a></li>
    <li><a href="{{url('/practitioner/email-group')}}">Email Groups</a></li>
    <li class="active">New</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Email Groups <small>New Email Group</small></h1>
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
        <div class="col-md-12">
        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">New Email Group</h4>
            </div>
            <div class="panel-body">
                {!! Form::open(array('url'=>'/practitioner/email-group/toContact', 'class'=> 'form-horizontal','data-parsley-validate' => 'true')) !!}

                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('name','Email Group Name *:', array('class'=>'text-center control-label','style'=>'margin-bottom:10px')) !!}
                        {!! Form::text('name', null, array('class'=>'form-control', 'placeholder'=> 'Email Group Name', 'data-parsley-required'=>'true'
)) !!}
                        @if ($errors->has('name'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('description','Email Group Description *:', array('class'=>'text-center control-label','style'=>'margin-bottom:10px')) !!}
                        {!! Form::textarea('description', null, array('class'=>'form-control', 'placeholder'=> 'Email Group Name', 'data-parsley-required'=>'true'
)) !!}
                        @if ($errors->has('description'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('description') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
                    <div class="col-md-12">
                        {!! Form::submit('Next', array('class'=>'btn btn-success pull-right')) !!}
                    </div>
                {!! Form::close() !!}
        </div>
        
                
            </div>
        </div>
        <!-- end panel -->


    </div>
    <!-- end col 6 -->
</div>
<!-- end row -->
@endsection