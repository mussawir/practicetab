<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>Color Admin | Calendar</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="{{asset('public/dashboard/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/dashboard/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/dashboard/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/dashboard/css/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/dashboard/css/style.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/dashboard/css/PopupBox.css')}}" rel="stylesheet" />
    <link href="{{asset('public/dashboard/css/style-responsive.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/dashboard/css/theme/default.css')}}" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{asset('public/dashboard/plugins/fullcalendar/fullcalendar.print.css')}}" rel="stylesheet" media='print' />
    <link href="{{asset('public/dashboard/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('public/dashboard/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/css/jquery.ui.autocomplete.min.css') }}" rel="stylesheet">
    @yield('head')
    <!-- ================== END PAGE LEVEL STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{asset('public/dashboard/plugins/pace/pace.min.js')}}"></script>
    <!-- ================== END BASE JS ================== -->
</head>
<body>
<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
    <!-- begin #header -->
    @include('practitioner.header')
            <!-- end #header -->
    <!-- begin #sidebar -->
    @yield('sidebar')
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
<script src="{{asset('public/dashboard/plugins/fullcalendar/lib/moment.min.js')}}"></script>
<script src="{{asset('public/dashboard/plugins/jquery/jquery-1.9.1.min.js')}}"></script>
<script src="{{asset('public/dashboard/plugins/jquery/jquery-migrate-1.1.0.min.js')}}"></script>
<script src="{{asset('public/dashboard/plugins/jquery-ui/ui/minified/jquery-ui.min.js')}}"></script>
<script src="{{asset('public/dashboard/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<!--[if lt IE 9]>
<script src="{{asset('public/dashboard/crossbrowserjs/html5shiv.js')}}"></script>
<script src="{{asset('public/dashboard/crossbrowserjs/respond.min.js')}}"></script>
<script src="{{asset('public/dashboard/crossbrowserjs/excanvas.min.js')}}"></script>
<![endif]-->
<script src="{{asset('public/dashboard/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('public/dashboard/plugins/jquery-cookie/jquery.cookie.js')}}"></script>
<!-- ================== END BASE JS ================== -->
<script type="text/javascript" src="{{asset('public/dashboard/plugins/gritter/js/jquery.gritter.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/flot/jquery.flot.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/flot/jquery.flot.time.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/flot/jquery.flot.resize.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/flot/jquery.flot.pie.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/sparkline/jquery.sparkline.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/DataTables/media/js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/js/dashboard.min.js')}}"></script>

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{asset('public/dashboard/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{asset('public/dashboard/plugins/fullcalendar/fullcalendar.js')}}"></script>
<script src="{{asset('public/dashboard/plugins/popup/jquery.bpopup.js')}}"></script>
<script src="{{asset('public/dashboard/js/calendar.demo.min.js')}}"></script>
<script src="{{asset('public/dashboard/plugins/datepicker/form-plugins.demo.min.js')}}"></script>

<script src="{{asset('public/dashboard/plugins/Autocomplete/jquery.ui.autocomplete.min.js')}}"></script>

@yield('bottom');
<script src="{{asset('public/dashboard/js/apps.min.js')}}"></script>
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
                $('#element_to_pop_up').html('');
                $('#element_to_pop_up').html(formData);
                autoComplete();
                $('#my-button').click();
                var id = event.title;
                id = id.split(')')[0];
                //event.title = id + " ) " + $('#patientname').val();
                event.title =fetchRowSchedule(parseInt(id));
                //$('#calendar').fullCalendar('updateEvent', event);

            },
            select: function(start, end) {
                var title='';
                $('#element_to_pop_up').html('');
                $('#element_to_pop_up').html(formData);
                autoComplete();
                $('#saveBtn').show();
                $('#updateBtn').hide();
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
</script>
@yield('bottom')
@yield('page-scripts')

</body>
</html>
