@extends('layouts.pradash')
@section('sidebar')
    @include('layouts.manage-sidebar')
@endsection

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home</a></li>
        <li class="active">Calendar</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Calendar <small>header small text goes here...</small></h1>
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
            <h4 class="panel-title">Calendar</h4>
        </div>
        <div class="panel-body p-0">
            <div class="vertical-box">
                <div class="vertical-box-column p-15 bg-silver width-200">
                    <div id="external-events" class="fc-event-list">
                        <div class="row">
                            <div class="col-md-9">
                                <input readonly type="text" class="form-control" id="datepicker-default" placeholder="Select Date" onchange="changeCalender();" />
                            </div>
                            <div class="col-md-3">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </div>


                    </div>
                </div>
                <div id="calendar" class="vertical-box-column p-15 calendar"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <button id="my-button">POP IT UP</button>
    </div>
    <div id="element_to_pop_up">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1>
                        Appointments

                    </h1>

                    <div class="tabbable" id="tabs-477182">
                        <ul class="nav nav-tabs">
                            <li class="active">

                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="panel-144564">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="hidden" name="scheduleId" id="scheduleId" />
                                                        <label class="col-md-4 control-label">Patient Name : </label>
                                                        <div class="col-md-8">
                                                            <span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>
                                                            <input onchange="autoComplete();" type="text" name="patientname" id="patientname" class="form-control ui-autocomplete-input"  autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                                </br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label class="col-md-4 control-label">Reason : </label>
                                                        <div class="col-md-8">
                                                            <textarea class="form-control" placeholder="Textarea" rows="5" name="reason" id="reason"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                </br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            Date :
                                                            <input type="text" class="form-control" placeholder="" disabled="" name="pDate" id="pDate">
                                                        </div>
                                                        <div class="col-md-4">
                                                            Time :
                                                            <select class="form-control" id="time" name="time" disabled="" >
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            Duration:(min)
                                                            <input type="text" value="15" class="form-control" placeholder="" disabled="" name="pDuration" id="pDuration">

                                                        </div>
                                                    </div>
                                                </div>
                                                </br>
                                                <div class="col-md-12">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <label>
                                                            Description :
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <textarea class="form-control" placeholder="Description" rows="3" name="app_desc" id="app_desc"></textarea>
                                                </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">

                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <label class="col-md-12 control-label">Color : </label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-xs-1 no-padding color-m" onclick="jQuery('#color').val('5484ed')" style="background-color:#5484ed; cursor:pointer" title="Bold Blue"></div>
                                                        <div class="col-xs-1 no-padding color-m" onclick="jQuery('#color').val('a4bdfc')" style="background-color:#a4bdfc; cursor:pointer" title="Blue"></div>
                                                        <div class="col-xs-1 no-padding color-m" onclick="jQuery('#color').val('46d6db')" style="background-color:#46d6db; cursor:pointer" title="Turqoise"></div>
                                                        <div class="col-xs-1 no-padding color-m" onclick="jQuery('#color').val('7ae7bf')" style="background-color:#7ae7bf; cursor:pointer" title="Green"></div>
                                                        <div class="col-xs-1 no-padding color-m" onclick="jQuery('#color').val('51b749')" style="background-color:#51b749; cursor:pointer" title="Bold Green"></div>
                                                        <div class="col-xs-1 no-padding color-m" onclick="jQuery('#color').val('fbd75b')" style="background-color:#fbd75b; cursor:pointer" title="Yellow"></div>
                                                        <div class="col-xs-1 no-padding color-m" onclick="jQuery('#color').val('ffb878')" style="background-color:#ffb878; cursor:pointer" title="Orange"></div>
                                                        <div class="col-xs-1 no-padding color-m" onclick="jQuery('#color').val('ff887c')" style="background-color:#ff887c; cursor:pointer" title="Red"></div>
                                                        <div class="col-xs-1 no-padding color-m" onclick="jQuery('#color').val('dc2127')" style="background-color:#dc2127; cursor:pointer" title="Bold Red"></div>
                                                        <div class="col-xs-1 no-padding color-m" onclick="jQuery('#color').val('dbadff')" style="background-color:#dbadff; cursor:pointer" title="Purple"></div>
                                                        <div class="col-xs-1 no-padding color-m" onclick="jQuery('#color').val('e1e1e1')" style="background-color:#e1e1e1; cursor:pointer" title="Gray"></div>
                                                    </div>

                                                </div>
                                                </br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" placeholder=""  name="color" id="color">
                                                    </div>
                                                </div>
                                                </br>

                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div class="col-md-3">
                                                            <div class="row">
                                                        <label>Status *: </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                        <select class="form-control input-sm" name="status" id="status" onchange="if(this.options[this.selectedIndex].onclick != null){this.options[this.selectedIndex].onclick(this);}">
                                                            <option id="0">Please Select</option>
                                                            <option value="5" onclick="jQuery('#color').val('84D69B');">Arrived</option>
                                                            <option value="6" onclick="jQuery('#color').val('FAFF70');">In Session</option>
                                                            <option value="7" onclick="jQuery('#color').val('999999');">Complete</option>
                                                            <option value="8" onclick="jQuery('#color').val('141CFF');">Confirmed</option>
                                                            <option value="9" onclick="jQuery('#color').val('FF2432');">Not Confirmed</option>
                                                            <option value="10" onclick="jQuery('#color').val('FFE817');">Rescheduled</option>
                                                            <option value="11" onclick="jQuery('#color').val('2E2E2E');">Cancelled</option>
                                                            <option value="12" onclick="jQuery('#color').val('DF12FF');">No Show</option>
                                                            <option value="13" disabled="" >Request</option>
                                                        </select>
                                                        </div>
                                                    </div>


                                                </div>
                                                </br>
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <div class="col-md-9">
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox" value="0" name="chk_reminder">
                                                                    Reminder :
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                </br>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input id="saveBtn" type="button" value="Save" class="btn btn-sm btn-primary m-r-5" onclick="addMaster();" />
                                                        <input id="updateBtn" type="button" value="Update" class="btn btn-sm btn-primary m-r-5" onclick="updateScheduleData();" />
                                                        <button id="event-done" type="reset" class="btn btn-sm btn-default" onclick="$('#element_to_pop_up').bPopup().close();">Cancel</button>
                                                        <img src="/practicetab/public/img/transparent/ajax-loader.gif" id="ajaxloaderImg" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="panel-44682">
                                <div class="row">
                                    <div class="col-md-12">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript">
        var formData;
        $(document).ready(function(){
            $('#updateBtn').hide();
            fetchSchedulerData();
            $('#my-button').hide();
            $('#ajaxloaderImg').hide();
        });
        $(window).load(function(){
            $('.fc-left').children().click();
            $('#pDate').val(getDate());
            formData = $('#element_to_pop_up').html();
            $( "#patientname" ).autocomplete({
                source: availableTags
            });
        });
        function addMaster()
        {

            var id = $('#patientname').val();//$('#patientname').val('');
            var reason = $('#reason').val();//$('#reason').val('');
            var pDate = $('#pDate').val();//$('#pDate').val('');
            var pTime = $('#time').val();//$('#time').val('');
            var pDuration = $('#pDuration').val();//$('#pDuration').val('');
            var pColor = $('#color').val();//$('#color').val('');
            var pstatus = $('#status').val();//$('#status').val('');
            var app_desc = $('#app_desc').val();//$('#app_desc').val('');
            var breakTime = pTime.split(':');
            var breaktime2 = (parseInt(pDuration)+parseInt(breakTime[1]));
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
            $('#ajaxloaderImg').show();
            $.ajax({
                type: "POST",
                url: '{{ URL::to('/practitioner/schedule/') }}',
                data: {id:id
                    ,reason : reason
                    ,pDate:pDate
                    ,pTime:pTime
                    ,pDuration:pDuration
                    ,pColor:pColor
                    ,pstatus:pstatus
                    ,app_desc:app_desc
                },
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (result) {
                    $('#element_to_pop_up').bPopup().close();
                    fetchSchedulerData();
                    //                  $('#element_to_pop_up').html('');
//                    $('#element_to_pop_up').html(formData);
                    $( "#patientname" ).autocomplete({
                        source: availableTags
                    });


                },
                error:function (error) {
                    alert('error');
                    $('#ajaxloaderImg').hide();
                }
            });

        }
        function getMaxId()
        {
            $.ajax({
                type: "POST",
                url: '{{ URL::to('/practitioner/FetchscheduleMax/') }}',
                data: {},
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (result) {
                    var maxId = (parseInt(result)+1);
                    return maxId;
                } ,
                error:function (error) {
                    alert('error');
                }
            });
        }

        function fetchSchedulerData()
        {
            $.ajax({
                type: "POST",
                url: '{{ URL::to('/practitioner/Fetchschedule/') }}',
                data: {},
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (result) {
                    $('#calendar').fullCalendar('removeEvents');
                    // $('#element_to_pop_up').html('');
                    // $('#element_to_pop_up').html(formData);
                    $( "#patientname" ).autocomplete({
                        source: availableTags
                    });
                    $breakitfirst = result.split('|');
                    for(var i=0;i<$breakitfirst.length;i++)
                    {
                        $breakit = $breakitfirst[i].split(';');
                        var breakTime = $breakit[2].split(':');
                        var breaktime2 = (parseInt($breakit[3])+parseInt(breakTime[1]));
                        //if(pDuration==60)
                        //{
                        //     breakTime[0] = (parseInt(breakTime[0])+1);
                        // }
                        //else if(breaktime2>60|breaktime2==60)
                        //{
                        //      breakTime[0] = (parseInt(breakTime[0])+1);
                        //       breaktime2 = parseInt(breaktime2)-60;
                        //      breakTime[1] = breaktime2;
                        //   }
                        //   else
                        {
                            if(breaktime2==60)
                            {
                                breaktime2 = breaktime2-1;
                            }
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
        function fetchRowSchedule(id)
        {
            // $('#element_to_pop_up').html('');
            // $('#element_to_pop_up').html(formData);
            $( "#patientname" ).autocomplete({
                source: availableTags
            });
            var test = '';
            $('#ajaxloaderImg').show();
            $.ajax({
                type: "POST",
                url: '{{ URL::to('/practitioner/FetchscheduleRow/') }}',
                data: {
                    id : id
                },
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (result) {
                    if(result!="")
                    {
                        $('#scheduleId').val(id);
                        $('#patientname').val(result.split(';')[0]);
                        $('#reason').val(result.split(';')[2]);
                        $('#pDate').val(result.split(';')[1]);
                        $('#time').val(result.split(';')[4]);
                        $('#pDuration').val(result.split(';')[5]);
                        $('#color').val(result.split(';')[6]);
                        $('#status').val(result.split(';')[7]);
                        $('#app_desc').val(result.split(';')[3]);
                        $('#saveBtn').hide();
                        $('#updateBtn').show();
                        $('#ajaxloaderImg').hide();
                        return $('#scheduleId').val() + " ) " + $('#patientname').val();
                    }
                } ,
                error:function (error) {
                    alert('error');
                    $('#ajaxloaderImg').hide();
                }
            });
        }

        function updateScheduleData()
        {
            var id = $('#scheduleId').val();//$('#patientname').val('');
            var reason = $('#reason').val();//$('#reason').val('');
            var pDate = $('#pDate').val();//$('#pDate').val('');
            var pTime = $('#time').val();//$('#time').val('');
            var pDuration = $('#pDuration').val();//$('#pDuration').val('');
            var pColor = $('#color').val();//$('#color').val('');
            var pstatus = $('#status').val();//$('#status').val('');
            var app_desc = $('#app_desc').val();//$('#app_desc').val('');
            var patient_id = $('#patientname').val();//$('#patientname').val('');
            $('#ajaxloaderImg').show();
            $.ajax({
                type: "POST",
                url: '{{ URL::to('/practitioner/updateScheduleData/') }}',
                data: {id:id
                    ,reason : reason
                    ,pDate:pDate
                    ,pTime:pTime
                    ,pDuration:pDuration
                    ,pColor:pColor
                    ,pstatus:pstatus
                    ,app_desc:app_desc
                    ,patient_id:patient_id
                },
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (result) {
                    //alert('Successfully Updated Data in DataBase');
                    $('#element_to_pop_up').bPopup().close();
                    $('#ajaxloaderImg').hide();
                    fetchSchedulerData();
                    //   $('#element_to_pop_up').html('');
                    //  $('#element_to_pop_up').html(formData);
                    $( "#patientname" ).autocomplete({
                        source: availableTags
                    });
                } ,
                error:function (error) {
                    alert('error');
                    $('#ajaxloaderImg').hide();
                }
            });

        }

        function insertinCombo(id,result)
        {
            var option = new Option(result, result);
            $('#'+id).append($(option));
        }
        var hours = 0,mins= '00',result='';
        for(var i = 6;i<24;i++) {
            hours = i;
            result =hours;
            for(var j = 0;j<5;j++) {
                if (j==1)
                {
                    mins = '00';
                }
                if (j==2)
                {
                    mins = '15';
                }
                if (j==3)
                {
                    mins = '30';
                }
                if (j==4)
                {
                    mins = '45';
                }
                result = hours+':'+mins;
                insertinCombo('time',result);
            }
        }
        var map = {};
        $('#time option').each(function () {
            if (map[this.value]) {
                $(this).remove()
            }
            map[this.value] = true;
        })
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
            $('#pDate').val($('#datepicker-default').val());
        }
        function autoComplete()
        {
            $( "#patientname" ).autocomplete({
                source: availableTags
            });
        }
        function getDate()
        {
            var m_names = new Array("Jan", "Feb", "Mar",
                    "Apr", "May", "Jun", "Jul", "Aug", "Sep",
                    "Oct", "Nov", "Dec");

            var d = new Date();
            var curr_date = d.getDate();
            var curr_month = d.getMonth();
            var curr_year = d.getFullYear();
            var finaleDate = curr_date + "/" + m_names[curr_month] + "/" + curr_year;
            finaleDate = curr_year +"-"+ (curr_month+1) +"-"+ curr_date;
            var formatedDate = (curr_month+1)+"/"+curr_date+"/"+curr_year;
            return formatedDate;
        }
        var availableTags
        $( function() {
            availableTags = [<?php
                use App\Models\Practitioner;
                use Illuminate\Support\Facades\Auth;
                use Illuminate\Support\Facades\DB;
                $scheduler = DB::table('patients')
                        ->where('first_name','<>','')
                        ->get();
                $counter=0;
                $result='';
                foreach ($scheduler as $schedule)
                {
                    $result.= '"'.$schedule->first_name .' '. $schedule->middle_name .' '. $schedule->last_name.'"';
                    $result.= ',';
                }
                $result = substr($result, 0, -1);
                echo $result;
                ?>];
            $( "#patientname" ).autocomplete({
                source: availableTags
            });
        });


    </script>

    <!-- end panel -->
@endsection
