<style type="text/css">
    #chatDiv{
        height:300px;
    }
#border-right{
    height :250px;
    border-right-color: #4f4f4f;
    border-right-style: solid;
    border-right-width: thin;

    border-bottom-color: #4f4f4f;
    border-bottom-style: solid;
    border-bottom-width: thin;
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
        <h1 class="page-header">Connect With Practitioners</h1>
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
                    <div class="col-md-12">
                        <div class="col-md-6"  id="border-right">
                            <div class="row">
                            <div class="col-md-3">
                                <label class="control-label">
                                Practitioner :
                                </label>
                            </div>
                            <div class="col-md-9">
                            <select class="form-control" id="pra_id">
                                @foreach($practitioners as $values)
                                <option value="{{$values->pra_id}}">{{$values->first_name}} {{$values->last_name}}</option>
                                @endforeach
                            </select>
                            </div>
                            </div>
                            </br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <label class="control-label">
                                            Message :
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                            <textarea id="message" class="form-control" placeholder="Write a Message" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                            </br>
                            <div class="row">
                                <div class="col-md-10">
                                    </div>
                                <div class="col-md-2">
                                <button onclick="sendMessage();" type="button" class="btn btn-sm btn-primary m-r-5">Send</button>
                                    <img src="/practicetab/public/img/transparent/ajax-loader.gif" id="ajaxloaderImg" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p align="center" id="chatLoadingImage">  <img height="50px" width="50px" src="/practicetab/public/img/transparent/ajax-loader.gif" />
                            </p>
                            <div class="row" id="chatHeading">
                            <b>    <p align="center">
                            Start a Conversation with
                                </p></b>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                <div id="chatDiv"><ul class="chats"></ul></div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Messaging History</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <table id="data-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>To</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $counter=1; ?>
                        @foreach($messageHistory as $item)
                            <tr>
                                <td><?php echo $counter++; ?></td>
                                <td>
                                    {{$item->first_name}} {{$item->last_name}}
                                </td>
                                <td>
                                    <?php $msg_date = new DateTime($item->msg_date);
                                    $formatteddate = date_format($msg_date, 'm/d/Y');
                                    echo $formatteddate;
                                    ?>
                                </td>
                                <td>
                                    {{date("H:i",strtotime($item->created_at))}}
                                </td>
                                <td>
                                    <a href="{{URL::to('/patient/index/message-history?chat=')}}{{$item->practitioner_id}}"><i class="fa fa-eye"></i> View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
@section('page-scripts')
    <script type="text/javascript">
        loadChats();
        $('#chatLoadingImage').hide();
        setInterval(function(){
            loadChats();
        }, 6000);
        $('#chatHeading').html('');
        var appender = '';
        appender = '<b><p align="center">';
        appender += 'Start a conversation with ' + $("#pra_id option:selected").text();
        appender += '</p></b>';
        $('#chatHeading').html(appender);
        //$('#defaultLi').hide();
        $("#pra_id").change(function () {
            $('#chatHeading').html('');
            var appender = '';
            appender = '<b><p align="center">';
            appender += 'Start a conversation with ' + $("#pra_id option:selected").text();
            appender += '</p></b>';
            $('#chatHeading').html(appender);
            $('#chatDiv').html('');
            $('#chatLoadingImage').show();
            loadChats();
        });
        function addChat()
        {
            var appender = '';
            appender='<li class="right">';
            appender+= '<span class="date-time">' +gettoday()+'</span>';
            appender+='<a href="#" class="name"><span class="label label-primary">Me</span> Me</a>';
            appender+='<a href="javascript:;" class="image"><img alt="" src=""></a>';
            appender+='<div class="message">';
            appender+= $('#message').val();
            appender+='</div>';
            appender+='</li>';
            $('.chats').append(appender);
        }
        function loadChats()
        {
            var appender = '';
            var pra_id = $('#pra_id').val();
            $.ajax({
                type: "POST",
                url: '{{ URL::to('/patient/index/view-message-ajax')}}',
                data: {
                    pra_id : pra_id,
                    chatRestrict : 'today'
                },
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (result) {
                    //showError(result);
                    $('#chatDiv').html('');
                    appender='<div data-scrollbar="true" data-height="280px" class="bg-grey-100">';
                    appender+='<ul class="chats">';
                    appender+=result;
                    appender+='</ul></div>';
                    $('#chatDiv').html(appender);
                    $('#chatLoadingImage').hide();
                },
                error:function (error) {
                }
            });
        }
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
        $('#ajaxloaderImg').hide();
        function sendMessage()
        {
            if($('#message').val()=="") return;
            $('#ajaxloaderImg').show();
            $.ajax({
                type: "POST",
                url: '{{ URL::to('/patient/index/send-message-ajax')}}',
                data: {
                    pra_id : $('#pra_id').val(),
                    msg_date : gettoday(),
                    message : $('#message').val()
                },
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (result) {
                    $('#ajaxloaderImg').hide();
                    addChat();
                    $('#message').val('');
                    showSuccess('Message Sent Successfully');
                } ,
                error:function (error) {
                    $('#ajaxloaderImg').hide();
                    $('#message').val('');
                    showError('Could not send a message please try again');
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
            $('#chatDiv').slimScroll({
                height: '300px'
            });
        });
    </script>
@endsection
