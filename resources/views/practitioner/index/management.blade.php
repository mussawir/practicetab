@extends('layouts.pradash')
@section('sidebar')
    @include('layouts.manage-sidebar')
@endsection

@section('head-scripts')
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{asset('public/dashboard/plugins/fullcalendar/fullcalendar.print.css')}}" rel="stylesheet" media='print'>
<link href="{{asset('public/dashboard/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet">
<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection

@section('content')

    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home</a></li>
        <li class="active">Calendar</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Scheduler <small>Manage your appointments.</small></h1>
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
    <!-- end panel -->

    @endsection

@section('page-scripts')

<!-- ================== BEGIN PAGE LEVEL JS ================== -->

<script type="text/javascript" src="{{asset('public/dashboard/plugins/fullcalendar/lib/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/jquery/jquery-1.9.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/jquery/jquery-migrate-1.1.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/jquery-ui/ui/minified/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/jquery/jquery-migrate-1.1.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/slimscroll/jquery.slimscroll.min.js')}}" ></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/jquery-cookie/jquery.cookie.js')}}" ></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/js/calendar.demo.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/js/apps.min.js')}}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

@endsection
