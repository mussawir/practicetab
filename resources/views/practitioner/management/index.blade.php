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
                            <h5 class="m-t-0 m-b-10">Draggable Events</h5>
                            <div class="fc-event" data-color="#00acac"><div class="fc-event-icon"><i class="fa fa-circle-o fa-fw text-success"></i></div> Meeting with Client</div>
                            <div class="fc-event" data-color="#348fe2"><div class="fc-event-icon"><i class="fa fa-circle-o fa-fw text-primary"></i></div> IOS App Development</div>
                            <div class="fc-event" data-color="#f59c1a"><div class="fc-event-icon"><i class="fa fa-circle-o fa-fw text-warning"></i></div> Group Discussion</div>
                            <div class="fc-event" data-color="#ff5b57"><div class="fc-event-icon"><i class="fa fa-circle-o fa-fw text-danger"></i></div> New System Briefing</div>
                            <div class="fc-event"><div class="fc-event-icon"><i class="fa fa-circle-o fa-fw text-inverse"></i></div> Brainstorming</div>
                            <h5 class="m-t-20 m-b-10">Other Events</h5>
                            <div class="fc-event" data-color="#b6c2c9"><div class="fc-event-icon"><i class="fa fa-circle-o fa-fw text-muted"></i></div> Other Event 1</div>
                            <div class="fc-event" data-color="#b6c2c9"><div class="fc-event-icon"><i class="fa fa-circle-o fa-fw text-muted"></i></div> Other Event 2</div>
                            <div class="fc-event" data-color="#b6c2c9"><div class="fc-event-icon"><i class="fa fa-circle-o fa-fw text-muted"></i></div> Other Event 3</div>
                            <div class="fc-event" data-color="#b6c2c9"><div class="fc-event-icon"><i class="fa fa-circle-o fa-fw text-muted"></i></div> Other Event 4</div>
                            <div class="fc-event" data-color="#b6c2c9"><div class="fc-event-icon"><i class="fa fa-circle-o fa-fw text-muted"></i></div> Other Event 5</div>
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
                        <div class="tabbable" id="tabs-477182">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#panel-144564" data-toggle="tab">Section 1</a>
                                </li>
                                <li>
                                    <a href="#panel-44682" data-toggle="tab">Section 2</a>
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
                                                            <label class="col-md-4 control-label">Patient Name : </label>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control" placeholder="Patient Name" id="patientname" name="patientname">
                                                        </div>
                                                    </div>
                                                    </div>
                                                    </br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label class="col-md-3 control-label">Reason : </label>
                                                            <div class="col-md-9">
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
                                                                <select class="form-control" id="time" name="time">
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                Duration:(min)
                                                                <input type="text" class="form-control" placeholder=""  name="pDuration" id="pDuration">
                                                            </div>
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

    <div class="col-md-7">

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
        </select>

    </div>
    <div class="col-md-5"></div>

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
                                                            <textarea class="form-control" name="app_desc" id="app_desc"></textarea>
                                                        </div>
                                                    </div>
                                                    </br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input type="button" value="Save" class="btn btn-sm btn-primary m-r-5" onclick="addMaster();" />
                                                            <button id="event-done" type="reset" class="btn btn-sm btn-default" onclick="$('#element_to_pop_up').bPopup().close();">Cancel</button>
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
        formData = $('#element_to_pop_up').html();
    });
    function addMaster()
    {
        var id = $('#patientname').val();
        var reason = $('#reason').val();
        var pDate = $('#pDate').val();
        var pTime = $('#time').val();
        var pDuration = $('#pDuration').val();
        var pColor = $('#color').val();
        var pstatus = $('#status').val();
        var app_desc = $('#app_desc').val();
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
                    alert('Data successfully Entered into Database');
                    $('#element_to_pop_up').bPopup().close();
                    $('#element_to_pop_up').html('');
                    $('#element_to_pop_up').html(formData);
                },
                error:function (error) {
                    alert('error');
                }
            });
            return false;

        return false;
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
            console.log(result);
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
    $('#pDate').val(finaleDate);

</script>

        <!-- end panel -->
@endsection
