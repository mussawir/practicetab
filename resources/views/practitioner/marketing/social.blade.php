@extends('layouts.pradash')
@section('sidebar')
@include('layouts.mark-sidebar')
@section('head')

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('public/dashboard/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css') }}" rel="stylesheet">
    <!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Home</a></li>
    <li class="active">Social Posts</li>
</ol>
        <style>
            .container {
                background: white;
            }
        </style>
        <?php
        require_once 'App\Models\FBCONFIG.php';
                ?>
<h1 class="page-header">Dashboard <small>Social Posts</small></h1>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#ajaxloaderImg').hide();
                //$('#file').hide();
                $('#fileLabel').hide();

            });
            function uploadimage()
            {
                var result='';
                $('#ajaxloaderImg').show();
                var file_data = $('#file').prop('files')[0];
                var form_data = new FormData();
                form_data.append('file', file_data);
                $.ajax({
                    url: '{{ URL::to('/practitioner/SocialPost/uploadImage/') }}',
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
                    <?php if($_SESSION["user_id"] == "") { ?>
                    $('#failbody').html('');
                    $('#failbody').html('<strong>Please Login First!!</strong>');
                    $("#failbody").show();
                    setTimeout(function () {
                        $("#failbody").hide();
                    }, 2000);
                    return;
                    <?php             } ?>
                    $('#ajaxloaderImg').show();

                    $.ajax({
                        type: "POST",
                        url: '{{ URL::to('/practitioner/SocialPost/formsubmit/') }}',
                        data: {
                            msg: $('#msg').val(),
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

                                $('#msg').val('')
                            }
                            else {
                                appender = '<button data-dismiss="alert" class="close" type="button">×</button>';
                                appender += '<h4>Oops Some Error Occured !</h4>';
                                appender += '<p>' + result + '</p>';
                                $('#failbody').html('');
                                $('#failbody').html(appender);
                                $("#failbody").show();
                                setTimeout(function () {
                                    $("#failbody").hide();
                                }, 2000);
                                $('#msg').val('')
                            }

                        },
                        error: function (error) {
                        }
                    });
            }

        </script>
<!-- end page-header -->


<div class="row">


    <div class="container mainbody" id="resultbody">
        <div id="failbody" class="alert alert-dismissable alert-warning" style="display: none">
        </div>
            <div id="sucessbody" class="alert alert-dismissable alert-success" style="display: none">

            </div>

        <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Post Message to your Timeline </h3>
        </div>
            <div class="row">&nbsp;</div>
        </div>
        <div class="col-lg-2">
            <?php
            session_start();
            require_once 'App\Models\FBCONFIG.php';
            ?>
            <?php
            if($_SESSION["user_id"]=="") {
            ?>
                <div class="row">
                <a class="" href="<?php echo $loginURL; ?>">
                <i class="fa fa-facebook-square fa-3x pull-left fb-ico" id="fbbtn_text"></i>
                    Log In
                </a>
                    </div>
        <?php }
                else { ?>
                <div class="row">
                    <a class="" href="<?php echo  SITE_URL.'logoutFb'; ?> ">
                        <i class="fa fa-facebook-square fa-3x pull-left fb-ico" id=""></i>
                        Logout</a>
                </div>
                <div class="row">&nbsp;</div>
                <?php } ?>
            </div>
        <div  class="col-lg-2">
            <!-- LogOut -->
            <?php
            require_once 'App\Models\TWITTERCONFIG.php';
            require_once base_path().'\TwitterInc\twitteroauth.php';
            ?>
            <?php if(isset($_SESSION['status']) && $_SESSION['status'] == 'verified')
            { ?>
            <div class="row">
                <a href="<?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; echo $actual_link;?>/twitterlogout">
                    <i class="fa fa-twitter-square fa-3x pull-left fb-ico" id="fbbtn_text"></i> Log Out
                </a>
            </div>
        <?php } else {?>
            <!-- Login -->
<div class="row">

<a href="<?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; echo $actual_link;?>/twitterlogin">
    <i class="fa fa-twitter-square fa-3x pull-left fb-ico" id="fbbtn_text"></i> Log In
</a>
</div>
            <?php } ?>


        </div>
        <div class="col-lg-10">

        <div class="row">
            <div class="panel panel-success">
                <div class="panel-body">
                    <form class="bs-example form-horizontal" method="post" id="fbposting" enctype="multipart/form-data">
                        <input type="hidden" name="mode" value="type1" />
                        <input type="hidden" name="imagepath" value="" id="imagepath" />
                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="select">What do you Feel ":</label>
                                <div class="col-lg-7">
                                    <input type="text" id="msg" name="msg" placeholder="Your Message" required class="form-control" autocomplete="off" >
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-lg-2 control-label" for="select">Link ":</label>
                            <div class="col-lg-7">
                                <input type="text" id="link" name="link" placeholder="Your link" required class="form-control" autocomplete="off" >
                            </div>
                </div>
                            <div class="form-group">
                                    <label id="fileLabel" class="col-lg-2 control-label" for="select">File Upload ":</label>
                                <div class="col-lg-7">
                                    <input type="file"  id="file"  name="file"  />
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button class="btn btn-success pull-right" type="button"  onclick="afterUpload();">Post</button>
                                    <img src="/practicetab/public/img/transparent/ajax-loader.gif" id="ajaxloaderImg" />
                                </div>

                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <!-- Ckeditor -->


        </div>


</div>
</div>

@endsection
@section('bottom')

@endsection
@section('page-scripts')

@endsection