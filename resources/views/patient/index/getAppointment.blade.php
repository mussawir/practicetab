@extends('layouts.padash')
@section('content')
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="javascript:;">Home</a></li>
            <li class="active">Get Appointment</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Get Appointment</h1>
        <!-- end page-header -->
        <!-- begin panel -->
        <div class="row">
            <div class="col-md-12">
                <label class="col-md-2 control-label">Practitioner Name : </label>
                <div class="col-md-3">
                    <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
                    <input type="text" name="practitionerName" id="practitionerName" class="form-control ui-autocomplete-input"  autocomplete="off">
                </div>
            </div>

        </div>
        </br>
        <div class="row">
            <div class="col-md-12">
            <label class="col-md-2 control-label">Date : </label>
            <div class="col-md-3">
                <input type="text" class="form-control" id="datepicker-default" placeholder="Select Date" onchange="changeCalender();" />
            </div>
                <input id="searchBtn" type="button" value="Search" class="btn btn-sm btn-primary m-r-5" onclick="fetchSchedulerData();">
            </div>
        </div>
        </br>


        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Calendar</h4>
            </div>
            <div class="panel-body p-0">
                <div class="vertical-box">

                    <div id="calendar" class="vertical-box-column p-15 calendar"></div>
                </div>
            </div>
        </div>
        <div class="row">
        <button id="my-button">Request Form</button>
        </div>
        <div id="element_to_pop_up">
            <div class="container-fluid">
                <div class="row">
                    <h2>Request Form </h2>

                </div>
                <div class="row">
                    &nbsp;
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <div class="col-md-2">
                            Request Time :</div>
                        <div class="col-md-3">
                            <input type="text" class="form-control small" placeholder="" disabled="" name="time" id="time">
                        </div>
                        </div>
                </div>
                <div class="row">
                    &nbsp;
                </div>
                <div class="row" style="display:none">
                    <div class="col-md-12">

                        <div class="col-md-2">
                           Request Type :</div>
                        <div class="col-md-3">
                            <input value="13" type="text" class="form-control small" placeholder="" disabled="" name="scheduleType" id="scheduleType">
                        </div>
                    </div>
                </div>
                <div class="row">
                    &nbsp;
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <div class="col-md-2">
                            Request Date :</div>
                        <div class="col-md-3">
                            <input value="Request" type="text" class="form-control small" placeholder="" disabled="" name="reqDate" id="reqDate">
                        </div>
                    </div>
                </div>
                <div class="row">
                    &nbsp;
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <div class="col-md-2">
                            Duration :</div>
                        <div class="col-md-3">
                            <input  type="text" class="form-control small" placeholder="" value="30"  name="pDuration" id="pDuration" disabled="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    &nbsp;
                </div>
                <div class="row">
                    <div class="col-md-2"> Request Description </div>
                    <div class="col-md-6">
                        <textarea class="form-control" name="app_desc" id="app_desc"></textarea>
                    </div>
                </div>
                <div class="row">
                    &nbsp;
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3"></div>
                        <div class="col-md-3"><input id="requestBtn" type="button" value="Request" class="btn btn-sm btn-primary m-r-5" onclick="addMaster();" />
                            <img src="/practicetab/public/img/transparent/ajax-loader.gif" id="ajaxloaderImg" />
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>

                    </div>

                </div>
            </div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
    var calendarDataa="";
    var formData;
    $(window).load(function(){
        $('#ajaxloaderImg').hide();
        fetchSchedulerData();
        $('.fc-left').children().click();
        $('#my-button').hide();
        formData = $('#element_to_pop_up').html();
    });
    function addMaster()
    {
        var practitioner_id = $('#practitionerName').val()
                ,pDate=$('#reqDate').val(),pTime=$('#time').val(),ptype
                =$('#scheduleType').val()
                ,pDesc=$('#app_desc').val(),pDuration=$('#pDuration').val();
        $('#ajaxloaderImg').show();
        $.ajax({
                type: "POST",
            url: '{{ URL::to('/patient/index/requestSchedule')}}',
            data: {
                practitioner_id : practitioner_id,
                pDate : pDate,
                pTime : pTime,
                ptype : ptype,
                pDesc : pDesc,
                pDuration : pDuration
            },
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (result) {
                    $('#calendar').fullCalendar('removeEvents');
                    fetchSchedulerData();
                    $('#element_to_pop_up').bPopup().close();
                    $('#ajaxloaderImg').hide();
                    $('#element_to_pop_up').html('');
                    $('#element_to_pop_up').html(formData);
                },
                error:function (error) {
                    alert('error');
                    $('#ajaxloaderImg').hide();
                }
            });

    }


    function fetchSchedulerData()
    {
        $.ajax({
            type: "POST",
            url: '{{ URL::to('/patient/index/Fetchschedule')}}',
            data: {
                practitionerId : $('#practitionerName').val(),
                reqDate : gettoday()
            },
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
            },
            success: function (result) {
                $breakitfirst = result.split('|');
                $('#calendar').fullCalendar('removeEvents');
                for(var i=0;i<$breakitfirst.length;i++)
                {
                    $breakit = $breakitfirst[i].split(';');
                    var breakTime = $breakit[2].split(':');
                    var breaktime2 = (parseInt($breakit[3])+parseInt(breakTime[1]));
                    if(pDuration==60)
                    {
                        breakTime[0] = (parseInt(breakTime[0])+1);
                    }
                    else if(breaktime2>60|breaktime2==60)
                    {
                        breakTime[0] = (parseInt(breakTime[0])+1);
                        breaktime2 = parseInt(breaktime2)-60;
                        breakTime[1] = breaktime2;
                    }
                    else
                    {
                        breakTime[1] = breaktime2;
                    }
                    eventData = {
                        title: $breakit[0],
                        start: $breakit[1]+' '+ $breakit[2],
                        end: $breakit[1]+' '+ breakTime[0]+":"+breakTime[1],
                        color:'#'+$breakit[4],
                        textColor : 'black'
                    };
                    $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                    eventData = {};
                }
            } ,
            error:function (error) {
                alert('error');
            }
        });
    }
    var m_names = new Array("Jan", "Feb", "Mar",
            "Apr", "May", "Jun", "Jul", "Aug", "Sep",
            "Oct", "Nov", "Dec");

    var d = new Date();
    var curr_date = d.getDate();
    var curr_month = d.getMonth();
    var curr_year = d.getFullYear();
    var finaleDate = curr_date + "/" + m_names[curr_month] + "/" + curr_year;
    finaleDate = curr_year +"-"+ (curr_month+1) +"-"+ curr_date;
    $('#pDate').val(finaleDate);
    $('#datepicker-default').val((curr_month+1)+"/"+curr_date+"/"+curr_year);

    function changeCalender()
    {
        $('#calendar').fullCalendar('gotoDate', $('#datepicker-default').val());
        //$('#pDate').val($('#datepicker-default').val());
        $('#element_to_pop_up').html('');
        $('#element_to_pop_up').html(formData);
    }

    $(document).ready(function() {
        executeCalendar();
    });
    function executeCalendar()
    {
        $('#calendar').fullCalendar({
            header: {
                left: 'agendaDay',
                center: 'title',
                right: 'prev,today,next '
            },
            //droppable: true, // this allows things to be dropped onto the calendar
            drop: function () {
                $(this).remove();
            },
            selectable: true,
            selectHelper: true,
           /* eventClick: function (calEvent, jsEvent, view) {
                $('#calendar').fullCalendar('removeEvents', function (calEvent) {
                    return true;
                });
            },*/
            select: function (start, end) {
                var title = '';
                $('#my-button').click();
                $('#calendar').fullCalendar('unselect');
                var aDate;
                var test = start.toString();
                if (test.indexOf('GMT') > -1) {
                    test = test.substring(0, test.indexOf('GMT'));
                    aDate = new Date(Date.parse(test));
                    $('#reqDate').val(aDate.getFullYear()+'-'+(aDate.getMonth()+1)+'-'+(aDate.getDate()));
                }
                var mins = aDate.getMinutes() == "0" ? "00" : aDate.getMinutes();
                var selectedTime = aDate.getHours() + ":" + mins;
                if($('#practitionerName').val()!="" && $('#datepicker-default').val()!="")
                {
                    $('#element_to_pop_up').html('');
                    $('#element_to_pop_up').html(formData);
                }
                $('#time').val(selectedTime);
                $('#reqDate').val(aDate.getFullYear()+'-'+(aDate.getMonth()+1)+'-'+(aDate.getDate()));
                //$('#reqDate').val($('#datepicker-default').val());
                $('#calendar').fullCalendar('unselect');

            },
            editable: true,
            eventLimit: true // allow "more" link when too many events
        });
    }
    $( function() {
        var availableTags = [<?php
            use App\Models\Practitioner;
            use Illuminate\Support\Facades\Auth;
            use Illuminate\Support\Facades\DB;
            $scheduler = DB::table('practitioners')
                    ->where('first_name','<>','')
                    ->get();
            $result='';
            foreach ($scheduler as $schedule)
            {
                $result.= '"'.$schedule->first_name .' '. $schedule->middle_name .' '. $schedule->last_name.'"';
                $result.= ',';
            }
            $result = substr($result, 0, -1);
            echo $result;
         ?>];
        $( "#practitionerName" ).autocomplete({
            source: availableTags
        });
    });

function gettoday()
{
    var d = new Date();
    var curr_date = d.getDate();
    var curr_month = d.getMonth();
    var curr_year = d.getFullYear();
    var finaleDate = curr_date + "/" + m_names[curr_month] + "/" + curr_year;
    finaleDate = curr_year +"-"+ (curr_month+1) +"-"+ curr_date;
    return finaleDate;
}
</script>

        <!-- end panel -->
@endsection
