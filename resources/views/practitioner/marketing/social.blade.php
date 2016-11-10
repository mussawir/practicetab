@extends('layouts.pradash')
@section('sidebar')
@include('layouts.mark-sidebar')
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
            });
            function formsubmit() {
                <?php if($_SESSION["user_id"] == "") { ?>
                $('#failbody').html('');
                $('#failbody').html('<strong>Please Login First!!</strong>');
                $("#failbody").show();
                setTimeout(function() { $("#failbody").hide(); }, 2000);
                return;
                <?php             } ?>
                $('#ajaxloaderImg').show();
                $.ajax({
                    type: "POST",
                    url: '{{ URL::to('/practitioner/SocialPost/formsubmit/') }}',
                    data: {msg:$('#msg').val()
                    },
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
                        $('#ajaxloaderImg').hide();
                        var appender;
                        if(result=='posted')
                        {
                            appender='<button data-dismiss="alert" class="close" type="button">×</button>';
                            appender+='<h4>Success</h4>';
                            appender+='<p>It has been successfully posted to your Timeline.</p>';
                            $('#sucessbody').html('');
                            $('#sucessbody').html(appender);
                            $("#sucessbody").show();
                            setTimeout(function() { $("#sucessbody").hide(); }, 2000);

                            $('#msg').val('')
                        }
                        else
                        {
                            appender='<button data-dismiss="alert" class="close" type="button">×</button>';
                            appender+='<h4>Oops Some Error Occured !</h4>';
                            appender+='<p>'+result+'</p>';
                            $('#failbody').html('');
                            $('#failbody').html(appender);
                            $("#failbody").show();
                            setTimeout(function() { $("#failbody").hide(); }, 2000);
                            $('#msg').val('')
                        }

                    } ,
                    error:function (error) {
                    }
                });
            }

        </script>
<!-- end page-header -->
        <?php
        session_start();
        require_once 'App\Models\FBCONFIG.php';
        ?>
        <?php
                if($_SESSION["user_id"]=="") {
        ?>
        <div class="container">
            <div class="margin10"></div>
            <div class="col-sm-3 col-sm-offset-4">
                <a class="btn btn-block btn-social btn-facebook" href="<?php echo $loginURL; ?>">
                    <i class="fa fa-facebook"></i>           Login with Facebook
                </a>
            </div>
        </div>
        <?php } ?>

<div class="row">


    <div class="container mainbody" id="resultbody">
        <div id="failbody" class="alert alert-dismissable alert-warning" style="display: none">
        </div>
            <div id="sucessbody" class="alert alert-dismissable alert-success" style="display: none">

            </div>


        <div class="clearfix"></div>

        <div class="row pull-right">
            <a class="btn btn-danger" href="<?php echo  SITE_URL.'logoutFb'; ?> "><span class="glyphicon glyphicon-log-out"></span> Logout</a>
        </div>
        <div class="clearfix"></div>



        <div class="row">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Post Message to your Facebook Timeline </h3>
                </div>
                <div class="panel-body">
                    <form class="bs-example form-horizontal" method="post" action="">
                        <input type="hidden" name="mode" value="type1" />
                        <fieldset>
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="select">What do you Feel ":</label>
                                <div class="col-lg-10">
                                    <input type="text" id="msg" name="msg" placeholder="Your Message" required class="form-control" autocomplete="off" >
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button class="btn btn-primary" type="button" onclick="formsubmit();">Post</button>
                                    <img src="/practicetab/public/img/transparent/ajax-loader.gif" id="ajaxloaderImg" />
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
</div>
</div>

@endsection