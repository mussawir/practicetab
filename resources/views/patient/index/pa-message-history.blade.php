<style type="text/css">
    #chatHistoryDiv{
        height:100%;
        /*background-color: #e7e7e7;*/
        border-right-color: #4f4f4f;
        border-right-style: solid;
        border-right-width: thin;
    }
    #person-chat
    {
        height:100%;
    }

</style>
@extends('layouts.padash')
@section('content')
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="javascript:;">Home</a></li>
            <li class="active">Message</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Your Message History</h1>
        <div class="alert alert-danger fade in" id="errorLog" style="display: none">
        </div>
        <div class="alert alert-success fade in" id="successLog" style="display: none">
        </div>
        <!-- end page-header -->
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Connect With Others</h4>
            </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div  id="chatHistoryDiv">
                        <table class="table table-hover">
                            <tbody>
                            @foreach($messageHistory as $value)
                               <tr id="practitioners">
                                   <td id="{{$value->practitioner_id}}">
                                      <a href="#">{{$value->first_name}} {{$value->last_name}}</a>
                                   </td>
                               </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div  class="col-md-9">
                    <p align="center" id="ajaxloaderImg">  <img height="150px" width="150px" src="/practicetab/public/img/transparent/ajax-loader.gif" />
                    </p>
                    <div id="person-chat">
                        <ul class="chats">

                        </ul>
                    </div>

                </div>
            </div>
        </div>
        </div>
@endsection
@section('page-scripts')
    <script type="text/javascript">
        $('#ajaxloaderImg').hide();
        <?php if (isset($_GET['chat'])) { ?>
                loadChats(<?php echo $_GET['chat']; ?>);
        <?php } ?>
$("tr#practitioners td").click(function(e){
            var pra_id = $(this).attr('id');
            loadChats(pra_id);
        });
        function loadChats(tr_pra_id)
        {
            $('#person-chat').html('');
            $('#ajaxloaderImg').show();
            var appender = '';
            var pra_id = tr_pra_id;
            $.ajax({
                type: "POST",
                url: '{{ URL::to('/patient/index/view-message-ajax')}}',
                data: {
                    pra_id : pra_id
                },
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (result) {
                    //showError(result);
                    $('#ajaxloaderImg').hide();
                    $('#person-chat').html('');
                    appender='<ul class="chats">';
                    appender+=result;
                    appender+='</ul>';
                    $('#person-chat').html(appender);

                },
                error:function (error) {
                    $('#ajaxloaderImg').hide();
                }
            });
        }
        function gettoday()
        {
            var d = new Date();
            var curr_date = d.getDate();
            var curr_month = d.getMonth();
            var curr_year = d.getFullYear();
            //var finaleDate = curr_date + "/" + m_names[curr_month] + "/" + curr_year;
            var finaleDate = curr_year +"-"+ (curr_month+1) +"-"+ curr_date;
            return finaleDate;
        }
        function showError(result)
        {
            var append = '<strong> Error! </strong>';
            append+='<strong> '+result+' </strong>';
            append+='<span class="close" data-dismiss="alert">×</span>';
            $('#errorLog').html('');
            $('#errorLog').html(append);
            $("#errorLog").show();
            setTimeout(function () {
                $("#errorLog").hide();
            }, 2000);
        }
        function showSuccess(result)
        {
            var append = '<strong> Success! </strong>';
            append+='<strong> '+result+' </strong>';
            append+='<span class="close" data-dismiss="alert">×</span>';
            $('#successLog').html('');
            $('#successLog').html(append);
            $("#successLog").show();
            setTimeout(function () {
                $("#successLog").hide();
            }, 2000);
        }
        $(function(){
            $('#chatHistoryDiv').slimScroll({
                height: '100%'
            });
            $('#person-chat').slimScroll({
                height: '100%'
            });
        });

    </script>
@endsection
