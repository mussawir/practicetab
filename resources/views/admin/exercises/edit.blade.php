@extends('layouts.adash')
@section('head')
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li><a href="{{url('/admin/Exercise')}}">Exercise</a></li>
    <li class="active">New</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Exercise <small></small></h1>
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
                <h4 class="panel-title">Edit Exercise</h4>
            </div>
            <div class="panel-body">
                {!! Form::model($exercises, array('url'=>'/admin/exercises/update', 'method' => 'PATCH', 'class'=> 'form-horizontal', 'files'=>true, 'data-parsley-validate' => 'true')) !!}
                {!! Form::hidden('exe_id') !!} 
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('man_id','Category *:', array('class'=>'col-md-4 control-label')) !!}
                            <div class="col-md-8">
                                <select id="execat_id" name="execat_id" class="form-control" data-parsley-required="true">
                                    <option value="">Select</option>
                                    @foreach($execats as $exe)
                                        <option value="{{$exe->execat_id}}" {{($exercises->execat_id==$exe->execat_id) ? 'selected' :''}}>{{$exe->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('execat_id'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('execat_id') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                         <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('heading','Heading *:', array('class'=>'col-md-4 control-label')) !!}
                        <div class="col-md-8">
                            {!! Form::text('heading', null, array('class'=>'form-control', 'placeholder'=> 'Exercise Heading',  'data-parsley-required'=>'true')) !!}
                        </div>
                        @if ($errors->has('heading'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('heading') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('image1','Image 1*:', array('class'=>'col-md-4 control-label')) !!}
                        <div class="col-md-8">
                            {!! Form::file('image1', array('class'=>'form-control', 'accept'=>'image/*', 'data-parsley-required'=>'true')) !!}
                        </div>
                        <input type="hidden" name="saved_image1" value="{{$exercises->image1}}"/>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('image2','Image 2:', array('class'=>'col-md-4 control-label')) !!}
                        <div class="col-md-8">
                            {!! Form::file('image2', array('class'=>'form-control', 'accept'=>'image/*', 'data-parsley-required'=>'true')) !!}
                        </div>
                        <input type="hidden" name="saved_image2" value="{{$exercises->image2}}"/>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="form-group">
                        {!! Form::label('description','Description *:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::textarea('description', null, array('class'=>'form-control', 'placeholder'=> 'Short Description', 'rows'=>'10', 'data-parsley-required'=>'true')) !!}
                        </div>
                        @if ($errors->has('description'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('description') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-2">
&nbsp;</div>
                    <div class="col-md-2">
                        <strong>Image 1:</strong>
                    @if(isset($exercises->image1) && (!empty($exercises->image1)))
                          <img src="{{asset('public/img/exercise/'.$exercises->image1)}}" alt="{{$exercises->heading}}" class="img-responsive" style="max-height: 100px;" />
                        @else
                            <img src="{{asset('public/img/exercise/no_image_64x64.jpg')}}" alt="{{$exercises->heading}}" />
                        @endif
                        
                    </div>
                    <div class="col-md-2">
                        <strong>Image 2:</strong>
                    @if(isset($exercises->image2) && (!empty($exercises->image2)))
                        <img src="{{asset('public/img/exercise/'.$exercises->image2)}}" alt="{{$exercises->heading}}" class="img-responsive" style="max-height: 100px;" />
                    @else
                        <img src="{{asset('public/img/exercise/no_image_64x64.jpg')}}" alt="{{$exercises->heading}}" />
                    @endif
                </div>
                
                </div>

                <!-- div class="col-md-12">
                    {-- !! Form::textarea('content', '<h1>Sample text</h1>', array('class'=>'ckeditor','id'=>'editor1', 'rows'=>'20')) !! --}
                    </div -->
                <div class="col-md-12">
                    &nbsp;
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
@section('bottom')
        <!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script type="text/javascript" src="{{asset('public/dashboard/plugins/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/js/form-wysiwyg.demo.min.j')}}s"></script>
@endsection
@section('page-scripts')
    <script>
        $(document).ready(function() {
            FormWysihtml5.init();
        });
    </script>
@endsection
