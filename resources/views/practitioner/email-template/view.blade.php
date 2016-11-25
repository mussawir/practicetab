@extends('layouts.pradash')
@section('sidebar')
@include('layouts.mark-sidebar')
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li class="active">Email Templates</li>
    <li class="active">View</li>
</ol>

<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Email Templates <small>With Sample Data</small></h1>
<!-- end page-header -->
<!-- begin row -->
<div class="row">
    <!-- begin col-6 -->
    <!-- begin panel -->
    <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">Subject: {{$data->name}}</h4>
        </div>
        <div class="panel-body">
            <?php
            $first_name = array(
                    'Christopher',
                    'Ryan',
                    'Ethan',
                    'John'
            );

            //PHP array containing surnames.
            $middle_name = array(
                    'Walker',
                    'Thompson',
                    'Anderson',
                    'Johnson'

            );
            $last_name = array(
                    'Tremblay',
                    'Mether',
                    'Stock',
                    'Zander',

            );
            $email = array(
                    'abc@example.com',
                    'xyz@example.com',
                    'cyan@test.com',
                    'johndoe@example.com',

            );
            $primary_phone = array(
                    '+60123456789',
                    '+60123456788',
                    '+60123456786',
                    '+60123456731',

            );
            $r_first = $first_name[mt_rand(0, sizeof($first_name) - 1)];
            $r_middle = $middle_name[mt_rand(0, sizeof($middle_name) - 1)];
            $r_last = $last_name[mt_rand(0, sizeof($last_name) - 1)];
            $r_email = $email[mt_rand(0, sizeof($email) - 1)];
            $r_phone = $primary_phone[mt_rand(0, sizeof($primary_phone) - 1)];
            $placeholders = array('PR.FirstName', 'PR.MiddleName', 'PR.LastName', 'PR.Email', 'PR.Phone',
                    'PA.FirstName', 'PA.MiddleName', 'PA.LastName', 'PA.Email', 'PA.Phone');
            $replace_with = array($r_first, $r_middle, $r_last, $r_email, $r_phone ,
                    $r_first, $r_middle, $r_last, $r_email, $r_phone);

            $mail_body = preg_replace('/\{[^}]*\)|[{}]/', '', $data->template);
            $mail_body = str_replace($placeholders, $replace_with, $mail_body);
            echo $mail_body;
            ?>

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
    </script>
@endsection