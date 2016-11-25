<!DOCTYPE html>
<html lang="en">
<head>
    {{--<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta http-equiv="Content-Type" content="image/svg+xml, text/html; charset=UTF-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="author" content="aliinfotech.com">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Practice Tabs</title>
    <!-- Fonts -->
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">--}}

            <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('public/dashboard/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/css/style-responsive.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/css/theme/default.css') }}" rel="stylesheet">
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{asset('public/dashboard/plugins/fullcalendar/fullcalendar.print.css')}}" rel="stylesheet" media='print' />
    <link href="{{asset('public/dashboard/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('public/dashboard/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/dashboard/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    <link href="{{asset('public/dashboard/css/PopupBox.css')}}" rel="stylesheet" />
    <link href="{{ asset('public/dashboard/css/jquery.ui.autocomplete.min.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/vnd.microsoft.icon" />

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{asset('public/dashboard/plugins/fullcalendar/lib/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/dashboard/plugins/pace/pace.min.js')}}"></script>
    <!-- ================== END BASE JS ================== -->
</head>
<body>
<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
    <!-- begin #header -->
    <div id="header" class="header navbar navbar-default navbar-fixed-top">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <!-- begin mobile sidebar expand / collapse button -->
            <div class="navbar-header">
                <a href="#" class="navbar-brand"><span class="navbar-logo"></span> Practice Tabs</a>
                <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- end mobile sidebar expand / collapse button -->

            <!-- begin header navigation right -->
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <form class="navbar-form full-width">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter keyword" />
                            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
                        <i class="fa fa-bell-o"></i>
                        <span class="label">0</span>
                    </a>
                    <ul class="dropdown-menu media-list pull-right animated fadeInDown">
                        <li class="dropdown-header">Notifications</li>
                    <!--<li class="media">
                        <a href="javascript:;">
                            <div class="media-left"><i class="fa fa-bug media-object bg-red"></i></div>
                            <div class="media-body">
                                <h6 class="media-heading">Server Error Reports</h6>
                                <div class="text-muted f-s-11">3 minutes ago</div>
                            </div>
                        </a>
                    </li>
                    <li class="media">
                        <a href="javascript:;">
                            <div class="media-left"><img src="{{url('public/dashboard/img/user-1.jpg')}}" class="media-object" alt="" /></div>
                            <div class="media-body">
                                <h6 class="media-heading">Peter Behrouzi</h6>
                                <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                                <div class="text-muted f-s-11">25 minutes ago</div>
                            </div>
                        </a>
                    </li>
                    <li class="media">
                        <a href="javascript:;">
                            <div class="media-left"><img src="{{url('public/dashboard/img/user-2.jpg')}}" class="media-object" alt="" /></div>
                            <div class="media-body">
                                <h6 class="media-heading">Olivia</h6>
                                <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                                <div class="text-muted f-s-11">35 minutes ago</div>
                            </div>
                        </a>
                    </li>
                    <li class="media">
                        <a href="javascript:;">
                            <div class="media-left"><i class="fa fa-plus media-object bg-green"></i></div>
                            <div class="media-body">
                                <h6 class="media-heading"> New User Registered</h6>
                                <div class="text-muted f-s-11">1 hour ago</div>
                            </div>
                        </a>
                    </li>
                    <li class="media">
                        <a href="javascript:;">
                            <div class="media-left"><i class="fa fa-envelope media-object bg-blue"></i></div>
                            <div class="media-body">
                                <h6 class="media-heading"> New Email From John</h6>
                                <div class="text-muted f-s-11">2 hour ago</div>
                            </div>
                        </a>
                    </li>-->
                        <?php
                        use App\Models\Patient;
                        use Illuminate\Support\Facades\Auth;
                        use Illuminate\Support\Facades\DB;
                        use App\Models\scheduler;
                        $patient = Patient::where('user_id', '=', Auth::user()->user_id)->first();;
                        $scheduler = DB::table('scheduler')
                                ->where('pDate', '>=', date('m/d/Y'))
                                ->where('patient_id','=',$patient->first_name . ' ' . $patient->middle_name.' '.$patient->last_name)
                                ->where ('pStatus','<>','13')
                                ->get();
                        foreach ($scheduler as $schedule)
                        {
                            echo '<li class="media">';
                            echo '<a href="javascript:;">';
                            echo '<div class="media-left"><i class="fa fa-envelope media-object bg-blue"></i></div>';
                            echo '<div class="media-body">';
                            echo '<h6 class="media-heading"> Appointment Date '. $schedule->pDate  .'</h6>';
                            echo '<div class="text-muted f-s-11">'.$schedule->pDate.'</div>';
                            echo '</div>';
                            echo '</a>';
                            echo '</li>';
                        }
                        ?>
                        <li class="dropdown-footer text-center">
                            <a href="javascript:;">View more</a>
                        </li>
                    </ul>
                </li>
                @if (!Auth::guest())
                <li class="dropdown navbar-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{url('public/dashboard/img/user-13.jpg')}}" alt="" />
                        <span class="hidden-xs">&nbsp;{{Auth::user()->first_name . ' ' .Auth::user()->last_name}}&nbsp;</span> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu animated fadeInLeft">
                        <li class="arrow"></li>
                        <li><a href="javascript:;">Edit Profile</a></li>
                        <li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li>
                        <li><a href="javascript:;">Calendar</a></li>
                        <li><a href="javascript:;">Setting</a></li>
                        <li><a href="{{url('/patient/index/change-password')}}">Change Password</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ url('/logout') }}">Log Out</a></li>
                    </ul>
                </li>
                @endif
            </ul>
            <!-- end header navigation right -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end #header -->

    <!-- begin #sidebar -->
    <div id="sidebar" class="sidebar">
        <!-- begin sidebar scrollbar -->
        <div data-scrollbar="true" data-height="100%">

           @include('patient.patient-menu')
                    <!-- end sidebar nav -->
        </div>
        <!-- end sidebar scrollbar -->
    </div>
    <div class="sidebar-bg"></div>
    <!-- end #sidebar -->

    <!-- begin #content -->
    <div id="content" class="content">
        @yield('content')
    </div>
    <!-- end #content -->

    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->




</div>
<!-- end page container -->
<!-- ================== BEGIN BASE JS ================== -->
<script type="text/javascript" src="{{asset('public/dashboard/plugins/jquery/jquery-1.9.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/jquery/jquery-migrate-1.1.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/jquery-ui/ui/minified/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<!--[if lt IE 9]>
<script src="/public/dashboard/crossbrowserjs/html5shiv.js"></script>
<script src="/public/dashboard/crossbrowserjs/respond.min.js"></script>
<script src="/public/dashboard/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script type="text/javascript" src="{{asset('public/dashboard/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/jquery-cookie/jquery.cookie.js')}}"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script type="text/javascript" src="{{asset('public/dashboard/plugins/gritter/js/jquery.gritter.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/flot/jquery.flot.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/flot/jquery.flot.time.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/flot/jquery.flot.resize.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/flot/jquery.flot.pie.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/sparkline/jquery.sparkline.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/select2/dist/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/DataTables/media/js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/js/dashboard.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/parsley/dist/parsley.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/js/apps.min.js')}}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script src="{{asset('public/dashboard/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{asset('public/dashboard/plugins/fullcalendar/fullcalendar.js')}}"></script>
<script src="{{asset('public/dashboard/plugins/popup/jquery.bpopup.js')}}"></script>
<script src="{{asset('public/dashboard/js/calendar.demo.min.js')}}"></script>
<script src="{{asset('public/dashboard/plugins/datepicker/form-plugins.demo.min.js')}}"></script>

<script src="{{asset('public/dashboard/plugins/Autocomplete/jquery.ui.autocomplete.min.js')}}"></script>

<style>
    #element_to_pop_up {
        background-color:#fff;
        border-radius:15px;
        color:#000;
        display:none;
        padding:20px;
        width: 40%;
        min-width: 900px;
        max-height: 90vh;
    }
    .b-close{
        cursor:pointer;
        position:absolute;
        right:10px;
        top:5px;
    }


</style>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    ;(function($) {

        // DOM Ready
        $(function() {

            // Binding a click event
            // From jQuery v.1.7.0 use .on() instead of .bind()
            $('#my-button').bind('click', function(e) {

                // Prevents the default action to be triggered.
                e.preventDefault();

                // Triggering bPopup when click event is fired
                $('#element_to_pop_up').bPopup();

            });

        });

    })(jQuery);

    $(document).ready(function() {
        App.init();
        FormPlugins.init();
        $('#calendar').fullCalendar({
            header: {
                left: 'agendaDay',
                center: 'title',
                right: 'prev,today,next '
            },
            //droppable: true, // this allows things to be dropped onto the calendar
            drop: function() {
                $(this).remove();
            },
            selectable: true,
            selectHelper: true,
            eventClick: function(event, element) {
                $('#my-button').click();
                var id = event.title;
                id = id.split(')')[0];
                //event.title = id + " ) " + $('#patientname').val();
                event.title =fetchRowSchedule(parseInt(id));
                //$('#calendar').fullCalendar('updateEvent', event);

            },
            select: function(start, end) {
                var title='';
                $('#saveBtn').show();
                $('#my-button').click();
                $('#calendar').fullCalendar('unselect');
                var aDate;
                var test = start.toString();
                if (test.indexOf('GMT') > -1) {
                    test = test.substring(0,test.indexOf('GMT'));
                    aDate = new Date(Date.parse(test));
                    $('#pDate').val(aDate.getFullYear()+'-'+(aDate.getMonth()+1)+'-'+(aDate.getDate()));

                }
                var mins = aDate.getMinutes()=="0"?"00":aDate.getMinutes();
                var timeset = aDate.getHours()+":"+mins;
                $('#time').val(timeset);

                return;
                var eventData;

                if (title) {
                    eventData = {
                        title: title,
                        start: start,
                        end: end
                    };
                    $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                }
                $('#calendar').fullCalendar('unselect');
            },
            editable: true,
            eventLimit: true // allow "more" link when too many events
        });
    });
    function showDialouge(renderIn,Title,Content)
    {
        var render = '';
        render='<a id="reqDialouge_link" href="#modal-without-animation" class="btn btn-sm btn-default" data-toggle="modal">showDialouge</a>';
        render+='<div class="modal in" id="modal-without-animation" style="display: block; padding-right: 17px;">';
        render+='<div class="modal-dialog" id="reqDialouge">';
        render+='<div class="modal-content">';
        render+='<div class="modal-header">';
        render+='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
        render+='<h4 class="modal-title" id ="reqDial_title">'+Title+'</h4>';
        render+='</div>';
        render+='<div class="modal-body" id="reqDial_content">';
        render+=Content;
        render+='</div>';
        render+='<div class="modal-footer">';
        render+='<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>';
        render+='</div>';
        render+='</div>';
        render+='</div>';
        render+='</div>';
        if($("#reqDialouge").length == 0) {
            $('#'+renderIn).append(render);
            $('#reqDialouge_link').hide();
            $('#reqDialouge_link').click();
        }
        else
        {
            $('#reqDialouge_link').hide();
            $('#reqDial_title').text('');
            $('#modal-body').text('');
            $('#reqDial_title').text(Title);
            $('#modal-body').text(Content);
            $('#reqDialouge_link').click();
        }
    }
</script>
@yield('page-scripts')
</body>
</html>