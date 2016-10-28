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

    <title>{{isset($meta['page_title'])?$meta['page_title'].' - ':''}}Practice Tabs</title>
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
    <link href="{{ asset('public/dashboard/css/admin.css') }}" rel="stylesheet">
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('public/dashboard/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('public/dashboard/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/vnd.microsoft.icon" />

    <!-- ================== BEGIN BASE JS ================== -->
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
    @include('practitioner.header')
    <!-- end #header -->

    @yield('sidebar')
    <!-- begin #content -->
    <div id="content" class="content{{(isset($hide_sidebar) && (!empty($hide_sidebar))) ? ' '.$hide_sidebar : ''}}">
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
<script type="text/javascript" src="{{asset('public/dashboard/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
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
<script type="text/javascript" src="{{asset('public/dashboard/js/apps.min.js')}}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() {
        App.init();
        Dashboard.init();
    });
</script>
@yield('page-scripts')
</body>
</html>