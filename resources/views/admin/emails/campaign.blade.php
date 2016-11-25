@extends('layouts.adash')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="active">Email Marketing</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Create New Campaign <small></small></h1>
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
                <h4 class="panel-title">Create New Campaign</h4>
            </div>
            <div class="panel-body">
                {!! Form::open(array('url'=>'/admin/emails/store_campaign', 'class'=> 'form-horizontal', 'files'=>true,'data-parsley-validate' => 'true')) !!}
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-sm-12">
                        {!! Form::label('campaign_name','Campaign Name: * ', array('class'=>'control-label')) !!}
                        {!! Form::text('campaign_name', null, array('class'=>'form-control', 'placeholder'=> 'Campaign Name', 'data-parsley-required'=>'true')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="col-sm-12">

                        {!! Form::label('start_date','Start Date: *', array('class'=>' control-label')) !!}
                        {!! Form::text('start_date', null, array('id'=>'start_date', 'class'=>'form-control', 'placeholder'=> 'Start Date', 'readonly', 'data-parsley-required'=>'true')) !!}
                    </div>
                </div></div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="col-sm-12">

                        {!! Form::label('stop_date','Stop Date: *', array('class'=>' control-label')) !!}
                        {!! Form::text('stop_date', null, array('id'=>'stop_date', 'class'=>'form-control', 'placeholder'=> 'Stop Date', 'readonly', 'data-parsley-required'=>'true')) !!}
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-sm-12">

                        {!! Form::label('templates','Select Template: *', array('class'=>'control-label')) !!}

                            <select id="templates" name="et_id" class="form-control" onchange="loadTemplate(this)" data-parsley-required="true">
                                <option value="">Select Campaign Template</option>
                                @foreach($templates as $item)
                                    <option value="{{$item->et_id}}" data-template="{{$item->template}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="col-sm-12">

                        {!! Form::label('contact_groups','Contact Groups: *', array('class'=>'control-label')) !!}

                            <select id="contact_groups" name="ag_id" class="form-control" onchange="ajax();" data-parsley-required="true">
                                <option value="">Select Campaign Group</option>
                                @foreach($contact_groups as $item)
                                    <option value="{{$item->ag_id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-sm-12">

                        {!! Form::textarea('mail_body', null, array('class'=>'ckeditor','id'=>'mail_body', 'rows'=>'20')) !!}
                        </div></div>
                </div>
                <div class="col-md-12">
                    &nbsp;
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-sm-12">
                        {!! Form::submit('Start Campaign', array('class'=>'btn btn-success pull-right')) !!}
                    </div></div>
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
            $('#start_date').datepicker({
                todayHighlight: false,
                autoclose: true
            });

            $('#stop_date').datepicker({
                todayHighlight: true,
                autoclose: true
            });

            var d = new Date();
            var day = d.getDate();
            var month = d.getMonth();
            var year = d.getFullYear();
            var currentDate = (month+1) + "/" + day + "/" + year;

            $('#start_date').val(currentDate);
            $('#stop_date').val(currentDate);

            // link between dates
            $('#start_date').on("changeDate", function (e) {
                var endDate = new Date(e.date.valueOf());
                $('#stop_date').datepicker('setStartDate', endDate);
            });
            $('#stop_date').on("changeDate", function (e) {
                var startDate = new Date(e.date.valueOf());
                $('#start_date').datepicker('setEndDate', startDate);
            });
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