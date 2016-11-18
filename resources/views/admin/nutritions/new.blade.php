@extends('layouts.adash')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li><a href="{{url('/admin/nutrition')}}">Nutrition</a></li>
    <li class="active">New</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Nutrition <small></small></h1>
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
                <h4 class="panel-title">New Nutrition</h4>
            </div>
            <div class="panel-body">
                {!! Form::open(array('url'=>'/admin/nutrition/store', 'class'=> 'form-horizontal', 'files'=>true)) !!}

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('main_image','Main Image :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                        {!! Form::file('main_image', array('class'=>'form-control', 'accept'=>'image/*')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('man_id','Manufactures *:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
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
                            {!! Form::label('name','Name *:', array('class'=>'col-md-3 control-label')) !!}
                            <div class="col-md-9">
                                {!! Form::text('name', null, array('class'=>'form-control', 'placeholder'=> 'Name')) !!}
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
                        {!! Form::label('how_to_get','How To Get :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('how_to_get', null, array('class'=>'form-control', 'placeholder'=> 'How To Get')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('benefits','Benefits :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('benefits', null, array('class'=>'form-control', 'placeholder'=> 'Benefits')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('usability','Usability :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('usability', null, array('class'=>'form-control', 'placeholder'=> 'Usability')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('main_price','Main Price :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('main_price', null, array('class'=>'form-control', 'placeholder'=> 'Main Price')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('discount','Discount :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('discount', null, array('class'=>'form-control', 'placeholder'=> 'Discount')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('url','Url :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('url', null, array('class'=>'form-control', 'placeholder'=> 'Url')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('short_description','Short Description *:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('short_description', null, array('class'=>'form-control', 'placeholder'=> 'Short Description')) !!}
                        </div>
                        @if ($errors->has('short_description'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('short_description') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('long_description','Long Description:', array('class'=>'col-md-2')) !!}
                        <div class="col-md-10">
                            <!--Form::textarea('long_description', null, array('class'=>'form-control', 'placeholder'=> 'Long Description', 'rows'=>'3'))-->
                            {!! Form::textarea('long_description',null, array('class'=>'ckeditor','id'=>'long_description', 'rows'=>'20')) !!}
                        </div>
                    </div>
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
    <script type="text/javascript" src="{{asset('public/dashboard/plugins/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/dashboard/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/dashboard/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/dashboard/js/form-wysiwyg.demo.min.j')}}s"></script>
@endsection
@section('page-scripts')
    <script>
        $(document).ready(function() {
            FormWysihtml5.init();

            var roxyFileman = '{{asset('public/dashboard/plugins/fileman/index.html')}}';
            CKEDITOR.replace('long_description',
                    {
                        filebrowserBrowseUrl:roxyFileman,
                        filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                        removeDialogTabs: 'link:upload;image:upload',
                        enterMode	: Number(2)
                    })
        });
    </script>
@endsection