@extends('layouts.pradash')
@section('sidebar')
    @include('layouts.mark-sidebar')
@endsection
@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
        <li class="active">New Social Posts</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">New Social Posts<small></small></h1>
    <!-- end page-header -->
    <!-- begin row -->
    <style>
        #linkId {
            color:white;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#ajaxloaderImg').hide();
            //$('#file').hide();
            $('#fileLabel').hide();
            $('#toggle_link').hide();
            getUrl();
        });
        $(function(){
            $('#add_url').click(function () {
                $('#toggle_link').toggle();
            });
        });
        function uploadimage()
        {
            var result='';
            $('#ajaxloaderImg').show();
            var file_data = $('#file').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url: '{{ URL::to('/practitioner/social-post/uploadImage/') }}',
                type: "POST",
                data: form_data,
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(data){
                    $('#ajaxloaderImg').hide();
                    $('#imagepath').val(data);
                    formsubmit();
                },
                error: function(data){
                    $('#ajaxloaderImg').hide();
                    result= 'error';
                }
            });
        }
        function getUrl()
        {
            $.ajax({
                url: '{{ URL::to('/practitioner/social-post/socialStatus/') }}',
                type: "POST",
                data: {},
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(data){
                    var divData = $('#fbLink').html();
                    $('#fbLink').html('');
                    $('#fbLink').html(divData + data);

                },
                error: function(data){

                }
            });
        }
        function isUrlValid(url) {
            return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
        }
        function afterUpload()
        {
            if ($('#file').get(0).files.length === 0) {
                formsubmit();
            }
            else {
                //uploadimage();
            }
        }
        function formsubmit() {
            <?php session_start(); ?>
            <?php if(isset($_SESSION["user_id"]) == "") { ?>
            $('#failbody').html('');
            $('#failbody').html('<strong>Please Login First!!</strong>');
            $("#failbody").show();
            setTimeout(function () {
                $("#failbody").hide();
            }, 2000);
            return;
            <?php       } ?>

            $('#ajaxloaderImg').show();
            if(!isUrlValid($('#link').val())&&$('#link').val()!="")
            {
                $('#failbody').html('');
                $('#failbody').html('<strong>Please Enter a Valid URL</strong>');
                $("#failbody").show();
                setTimeout(function () {
                    $("#failbody").hide();
                }, 2000);
                return;
            }
            $.ajax({
                type: "POST",
                url: '{{ URL::to('/practitioner/social-post/formsubmit/') }}',
                data: {
                    msg: $('#fb_description').val(),
                    link: $('#link').val(),
                    imagePath : $('#imagepath').val()
                },
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (result) {
                    $('#ajaxloaderImg').hide();
                    var appender;
                    if (result == 'posted') {
                        appender = '<button data-dismiss="alert" class="close" type="button">×</button>';
                        appender += '<h4>Success</h4>';
                        appender += '<p>It has been successfully posted to your Timeline.</p>';
                        $('#sucessbody').html('');
                        $('#sucessbody').html(appender);
                        $("#sucessbody").show();
                        setTimeout(function () {
                            $("#sucessbody").hide();
                        }, 2000);

                        $('#content').val('')
                    }
                    else {
                        appender = '<button data-dismiss="alert" class="close" type="button">×</button>';
                        appender += '<h4>Oops Some Error Occured !</h4>';
                        appender += '<p>' + result + '</p>';linkIdl
                        $('#failbody').html('');
                        $('#failbody').html(appender);
                        $("#failbody").show();
                        setTimeout(function () {
                            $("#failbody").hide();
                        }, 2000);
                        $('#content').val('')
                    }

                },
                error: function (error) {
                }
            });
        }

    </script>
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-md-12">
            <div class="errorlog">
                    <div class="alert alert-success fade in" id="sucessbody" style="display: none;">
                        <strong>Success!</strong>
                        <strong>{{Session::pull('success')}}</strong>
                        <span class="close" data-dismiss="alert">×</span>
                    </div>
                    <div class="alert alert-danger fade in" id="failbody" style="display: none;">
                        <strong>Error!</strong>
                        <strong>{{Session::pull('error')}}</strong>
                        <span class="close" data-dismiss="alert">×</span>
                    </div>
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
                    <h4 class="panel-title">Write a Social Post for all your networks</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-4">
                        <!-- begin panel -->
                        <div class="panel panel-danger" data-sortable-id="ui-widget-16">
                            <div class="panel-heading">
                                <h4 class="panel-title">Social Networks</h4>
                            </div>
                            <div class="panel-body bg-red text-white">

                                <table>
                                    <tr><td>
                                            <i class="fa fa-pinterest"></i>
                                        </td>
                                        <td>
                                            <div class="checkbox text-white">
                                                <label class="text-white">
                                                    <input type="checkbox" value="" checked="checked">
                                                    Send to PRACTICE TABS
                                                </label>
                                            </div>
                                        </td></tr>

                                    <tr><td>
                                            <i class="fa fa-facebook"></i>
                                        </td>
                                        <td>
                                            <div class="checkbox text-white" id="fbLink">
                                                <label class="text-white">
                                                    <input type="checkbox" value="">
                                                    Send to FACEBOOK
                                                </label>
                                                    <?php
                                                    require_once 'App\Models\TWITTERCONFIG.php';
                                                    require_once base_path().'\TwitterInc\twitteroauth.php';
                                                    ?>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr><td>
                                            <i class="fa fa-twitter"></i>
                                        </td>
                                        <td>
                                            <div class="checkbox text-white">
                                                <label class="text-white">
                                                    <input type="checkbox" value="">
                                                    Send to TWITTER
                                                </label>
                                                <label class="text-white">
                                                    <?php
                                                    if(isset($_SESSION['status']) && $_SESSION['status'] == 'verified')
                                                    {
                                                    ?>
                                                        <a id="linkId" href="<?php $actual_link = "http://$_SERVER[HTTP_HOST]"; echo $actual_link.'/practicetab/practitioner/social-post'.'/twitterlogout' ?>">
                                                            Logout
                                                        </a>
                                                    <?php }  else {?>
                                                    <a id="linkId" href="<?php $actual_link = "http://$_SERVER[HTTP_HOST]"; echo $actual_link.'/practicetab/practitioner/social-post'.'/twitterlogin' ?>">
                                                    Login
                                                    </a>
                                                    <?php } ?>
                                                </label>
                                            </div>
                                        </td></tr>

                                    <tr><td>
                                            <i class="fa fa-google-plus"></i>
                                        </td>
                                        <td>
                                            <div class="checkbox text-white">
                                                <label class="text-white">
                                                    <input type="checkbox" value="">
                                                    Send to Google+
                                                </label>
                                            </div>
                                        </td></tr>

                                    <tr><td>
                                            <i class="fa fa-linkedin"></i>
                                        </td>
                                        <td>
                                            <div class="checkbox text-white">
                                                <label class="text-white">
                                                    <input type="checkbox" value="">
                                                    Send to LINKEDIN
                                                </label>
                                            </div>
                                        </td></tr>

                                </table>


                            </div>
                        </div>
                        <!-- end panel -->

                    </div>

                    <div class="col-md-8">
                        {!! Form::open(array('url'=>'/admin/manufacturer/store', 'class'=> 'form-horizontal', 'files'=>true)) !!}
                        <div class="form-group">
                            {!! Form::label('name','Heading *:', array('class'=>'control-label')) !!}
                            <div >
                                {!! Form::text('name', null, array('class'=>'form-control', 'placeholder'=> 'Name')) !!}
                            </div>
                            @if ($errors->has('name'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            {!! Form::label('content','Post Contents *:', array('class'=>'control-label')) !!}
                            <div >
                                {!! Form::textarea('fb_description', null, array('class'=>'form-control', 'placeholder'=> 'Write something interesting','id'=>'fb_description')) !!}
                            </div>
                            @if ($errors->has('name'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <a href="#" class="fa fa-link" id="add_url" data-toggle="tooltip" data-placement="top" title="Add URL"></a>
                        </div>
                        <div class="form-group" id="toggle_link">
                            <div class="col-md-4">
                                {!! Form::text('link', null, array('class'=>'form-control', 'placeholder'=> 'Add link','id'=>'link')) !!}
                            </div>

                        </div>

                    </div>

                    <div class="col-md-12">

                        {!! Form::button('Save', array('class'=>'btn btn-success pull-right','onclick'=>'formsubmit();')) !!}
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
    <script type="text/javascript">
        $(function () {
            if ($('#data-table').length !== 0) {
                $('#data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[1, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,2]}]
                });
            }
        });
    </script>
@endsection