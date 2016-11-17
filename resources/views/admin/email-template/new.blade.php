@extends('layouts.adash')
@section('head')
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{ asset('public/dashboard/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css') }}" rel="stylesheet">
<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li><a href="{{url('/admin/email-templates')}}">Email Templates</a></li>
    <li class="active">New Email Template</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">New Email Template <small></small></h1>
<!-- end page-header -->

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-info">
            <strong>Note: </strong>Replace the default template with your template
        </div>
    </div>
    <div class="col-md-12 msg">
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
</div>

<!-- begin row -->
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Template Placeholders</h4>
            </div>
            <div class="panel-body">
                <ul>
                    <li>Practitioner
                        <ul>
                            <li>{PR.FirstName}</li>
                            <li>{PR.MiddleName}</li>
                            <li>{PR.LastName}</li>
                            <li>{PR.Email}</li>
                            <li>{PR.Phone}</li>
                        </ul>
                    </li>
                    <li>Patient
                        <ul>
                            <li>{PA.FirstName}</li>
                            <li>{PA.MiddleName}</li>
                            <li>{PA.LastName}</li>
                            <li>{PA.Email}</li>
                            <li>{PA.Phone}</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- begin col-6 -->
    <div class="col-md-9">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Create New Email Template</h4>
            </div>
            <div class="panel-body">
                {!! Form::open(array('url'=>'/admin/email-templates/store', 'class'=> 'form-horizontal', 'files'=>true, 'data-parsley-validate' => 'true')) !!}

                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('name','Template Name *:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('name', 'My Default Email Template', array('class'=>'form-control', 'placeholder'=> 'Enter you template name', 'data-parsley-required'=>'true')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    {!! Form::textarea('template', setDefaultTemplate(), array('class'=>'ckeditor','id'=>'template', 'rows'=>'20', 'data-parsley-required'=>'true')) !!}
                </div >
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

            var roxyFileman = '{{asset('public/dashboard/plugins/fileman/index.html')}}';
            CKEDITOR.replace('template',
                    {
                        filebrowserBrowseUrl:roxyFileman,
                        filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                        removeDialogTabs: 'link:upload;image:upload',
                        enterMode	: Number(2)
                    })
        });
    </script>
@endsection

<?php
function setDefaultTemplate()
    {
        return "<p>Dear {PA.FirstName},</p>
                <p>&nbsp;</p>
                <p>Your practitioner {PR.FirstName} {PR.MiddleName} {PR.LastName} has recommended a new supplement for you to add to your regimen. Please do not hesitate to contact our office if you have any questions.</p>
                <p>&nbsp;</p>
                <p>As always, thank you for choosing {PR.FirstName} {PR.MiddleName} {PR.LastName}.</p>
                <p>&nbsp;</p>
                <p>Best in health,</p>
                <p>&nbsp;</p>
                <p>{PR.FirstName} {PR.MiddleName} {PR.LastName}</p>
                <p>&nbsp;</p>
                <p>{PR.Email}</p>
                <p>{PR.Phone}</p>";
    }
?>