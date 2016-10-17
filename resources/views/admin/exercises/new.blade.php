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
                <h4 class="panel-title">New Exercise</h4>
            </div>
            <div class="panel-body">
                {!! Form::open(array('url'=>'/admin/Exercise/store', 'class'=> 'form-horizontal', 'files'=>true)) !!}

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('man_id','Category *:', array('class'=>'col-md-4 control-label')) !!}
                        <div class="col-md-8">
                            <select id="man_id" name="man_id" class="form-control">
                                <option value="">Select</option>
                                @foreach($manufacturers as $item)
                                    <option value="{{$item->man_id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('man_id'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('man_id') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('name','Heading *:', array('class'=>'col-md-4 control-label')) !!}
                        <div class="col-md-8">
                            {!! Form::text('name', null, array('class'=>'form-control', 'placeholder'=> 'Exercise Heading')) !!}
                        </div>
                        @if ($errors->has('name'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('main_image','Main Image :', array('class'=>'col-md-4 control-label')) !!}
                        <div class="col-md-8">
                        {!! Form::file('main_image', array('class'=>'form-control', 'accept'=>'image/*')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('main_image','Banner Image :', array('class'=>'col-md-4 control-label')) !!}
                        <div class="col-md-8">
                            {!! Form::file('main_image', array('class'=>'form-control', 'accept'=>'image/*')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('name','Video Link:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('name', null, array('class'=>'form-control', 'placeholder'=> 'Exercise Heading')) !!}
                        </div>
                        @if ($errors->has('name'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('name','Short Description:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('name', null, array('class'=>'form-control', 'placeholder'=> 'Short Description')) !!}
                        </div>
                        @if ($errors->has('name'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>




                <div class="col-md-12">
                   {!! Form::textarea('content', null, array('class'=>'ckeditor', 'placeholder'=> 'Used For', 'id'=>'editor1', 'name'=>'editor1'
                   , 'rows'=>'20')) !!}
                    </div>
                <div class="col-md-12">
                    &nbsp;
</div>
                    <div class="col-md-12">
                        {!! Form::submit('Save', array('class'=>'btn btn-success pull-right')) !!}
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
