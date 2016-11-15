@extends('layouts.pradash')
@section('sidebar')
@include('layouts.mark-sidebar')
@endsection
@section('head')
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{ asset('public/dashboard/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css') }}" rel="stylesheet">
<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li><a href="{{url('/practitioner/emails')}}">Email List</a></li>
    <li class="active">Compose New Email</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Compose New Email <small></small></h1>
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
                <h4 class="panel-title">Compose New Email</h4>
            </div>
            <div class="panel-body">
                {!! Form::open(array('url'=>'/practitioner/emails/store', 'class'=> 'form-horizontal', 'files'=>true)) !!}

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('templates','Select Template: ', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            <select id="templates" name="et_id" class="form-control" onchange="loadTemplate(this)">
                                <option value="0">Select</option>
                                @foreach($templates as $item)
                                    <option value="{{$item->et_id}}" data-template="{{$item->template}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('contact_groups','Contact Groups: ', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            <select id="contact_groups" name="cg_id" class="form-control" onchange="ajax();">
                                <option value="0">Select</option>
                                @foreach($contact_groups as $item)
                                    <option value="{{$item->cg_id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('bcc','BCC: ', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('bcc', null, array('class'=>'form-control', 'placeholder'=> 'BCC Name')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('subject','Subject: ', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('subject', null, array('class'=>'form-control', 'placeholder'=> 'Subject', 'required'=>'required')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="getemail"></div>
                </div >
                <div class="col-md-12">
                    {!! Form::textarea('mail_body', null, array('class'=>'ckeditor','id'=>'mail_body', 'rows'=>'20')) !!}
                </div >
                <div class="col-md-12">
                    &nbsp;
                </div>
                <div class="col-md-12">
                    {!! Form::submit('Send', array('class'=>'btn btn-success pull-right')) !!}
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

            var roxyFileman = '{{asset('public/dashboard/plugins/fileman/index.html')}}';
            CKEDITOR.replace('mail_body',
                    {
                        filebrowserBrowseUrl:roxyFileman,
                        filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                        removeDialogTabs: 'link:upload;image:upload',
                        enterMode	: Number(2)
                    })
        });

        function loadTemplate(elm) {
            CKEDITOR.instances['mail_body'].setData($(elm).find(':selected').data('template'));
        }
        {{--$("#contact_groups").on('change',function(){--}}
        {{--var dataId = {'id': $("#contact_groups").val()};--}}
        {{--$.ajax({--}}
        {{--type:'GET',--}}
        {{--url:'{!! URL::route('findInfo') !!}',--}}
        {{--async:false,--}}
        {{--dataType:'json',--}}
        {{--data:dataId,--}}
        {{--success:function(data){--}}
        {{--var obj = JSON.parse(data);--}}
        {{--$.each(obj, function(index, value){--}}
        {{--$('#getemail').append(value.data.cg_id + ": " + value.data.email + " " + value.data.egd_id + "<br />");--}}
        {{--})--}}
        {{--}--}}
        {{--});--}}
        {{--});--}}
    </script>
@endsection