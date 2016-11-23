@extends('layouts.adash')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li><a href="{{url('/admin/execategories')}}">Exercise Categories</a></li>
    <li class="active">New</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Exercise Categories <small></small></h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
    <!-- begin col-6 -->
    <div class="col-md-10 col-md-offset-1">
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
                <h4 class="panel-title">Edit Exercise Category</h4>
            </div>
            <div class="panel-body">
                {!! Form::model($execat, array('url'=>'/admin/execategories/update', 'method' => 'PATCH', 'class'=> 'form-horizontal', 'files'=>true, 'data-parsley-validate' => 'true')) !!}

                {!! Form::hidden('execat_id') !!}

                    <div class="col-md-4">
                        @if(isset($execat->cat_image) && (!empty($execat->cat_image)))
                            <img src="{{asset('public/img/execats/'.$execat->cat_image)}}" alt="{{$execat->category}}" class="img-responsive" style="max-height: 250px;" />
                        @else
                            <img src="{{asset('public/dashboard/img/execats/no_image_64x64.jpg')}}" alt="{{$execat->category}}" />
                        @endif
                    <div class="form-group">
                        {!! Form::file('cat_image', array('class'=>'form-control', 'accept'=>'image/*')) !!}
                    </div>
                        <input type="hidden" name="saved_Image" value="{{$execat->cat_image}}"/>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            {!! Form::label('category','Category *:', array('class'=>'col-md-3 control-label')) !!}
                            <div class="col-md-9">
                                {!! Form::text('category', null, array('class'=>'form-control', 'placeholder'=> 'Category Name', 'data-parsley-required'=>'true')) !!}
                            </div>
                            @if ($errors->has('category'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </div>
                            @endif
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