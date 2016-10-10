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
    <div id="header" class="header navbar navbar-default navbar-fixed-top">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <!-- begin mobile sidebar expand / collapse button -->
            <div class="navbar-header">
                <a href="#" class="navbar-brand" style="width: auto!important;">
                    <span class="navbar-logo"></span>
                </a>

                <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- end mobile sidebar expand / collapse button -->

            <ul class="nav navbar-nav">
                <li><a href="{{url('practitioner')}}">Dashboard</a></li>
                <li><a href="{{url('practitioner/marketing')}}">Marketing</a></li>
                <li><a href="{{url('practitioner/management')}}">Management</a></li>
            </ul>

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
                        <span class="label">5</span>
                    </a>
                    <ul class="dropdown-menu media-list pull-right animated fadeInDown">
                        <li class="dropdown-header">Notifications (5)</li>
                        <li class="media">
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
                                    <h6 class="media-heading">John Smith</h6>
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
                        </li>
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
                        <li><a href="{{url('/practitioner/index/change-password')}}">Change Password</a></li>
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