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
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{ asset('public/dashboard/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/dashboard/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    @yield('head');

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
                <a href="{{url('/admin')}}" class="navbar-brand"><span class="navbar-logo"></span> Practice Tabs</a>
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
                        <span class="label">2</span>
                    </a>
                    <ul class="dropdown-menu media-list pull-right animated fadeInDown">
                        <li class="dropdown-header">Notifications (2)</li>

                        <li class="media">
                            <a href="javascript:;">
                                <div class="media-left"><i class="fa fa-plus media-object bg-green"></i></div>
                                <div class="media-body">
                                    <h6 class="media-heading"> New Practitioner Registered</h6>
                                    <div class="text-muted f-s-11">1 hour ago</div>
                                </div>
                            </a>
                        </li>
                        <li class="media">
                            <a href="javascript:;">
                                <div class="media-left"><i class="fa fa-plus media-object bg-green"></i></div>
                                <div class="media-body">
                                    <h6 class="media-heading"> New Patient Registered</h6>
                                    <div class="text-muted f-s-11">1 hour ago</div>
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
                        <li><a href="{{url('/admin/index/change-password')}}">Change Password</a></li>
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
            <!-- begin sidebar user -->
            <ul class="nav">
                <li class="nav-profile">
                    <div class="image">
                        <a href="javascript:;"><img src="{{url('public/dashboard/img/user-13.jpg')}}" alt="" /></a>
                    </div>
                    <div class="info">
                        Peter Behrouzi
                        <small>Super Admin</small>
                    </div>
                </li>
            </ul>
            <!-- end sidebar user -->
            <!-- begin sidebar nav -->
            <ul class="nav">
                <li class="nav-header">Navigation</li>
                <li class="has-sub {{isset($meta['db_main_menu'])?$meta['db_main_menu']:''}}">
                    <a href="{{url('/admin')}}">
                        <i class="fa fa-laptop"></i>
                        <span>Dashboard</span>
                    </a>
                    <li>
                </li>

                <li class="has-sub {{isset($meta['sup_main_menu'])?$meta['sup_main_menu']:''}}">
                    <a href="javascript:;">
                        <span class="badge pull-right"></span>
                        <i class="fa fa-medkit"></i>
                        <span>Supplements</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="{{isset($meta['sup_sub_menu_new'])?$meta['sup_sub_menu_new']:''}}"><a href="{{url('/admin/supplements/new')}}">Add New</a></li>
                        <li class="{{isset($meta['sup_sub_menu_list'])?$meta['sup_sub_menu_list']:''}}"><a href="{{url('/admin/supplements/index')}}">List</a></li>
                    </ul>
                </li>

                <li class="has-sub {{isset($meta['nut_main_menu'])?$meta['nut_main_menu']:''}}">
                    <a href="javascript:;">
                        <span class="badge pull-right"></span>
                        <i class="fa fa-fire"></i>
                        <span>Nutrition</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="{{isset($meta['nut_sub_menu_new'])?$meta['nut_sub_menu_new']:''}}"><a href="{{url('/admin/nutrition/new')}}">Add New</a></li>
                        <li class="{{isset($meta['nut_sub_menu_list'])?$meta['nut_sub_menu_list']:''}}"><a href="{{url('/admin/nutrition')}}">List</a></li>
                    </ul>
                </li>

                <li class="has-sub {{isset($meta['exe_main_menu'])?$meta['exe_main_menu']:''}}">
                    <a href="javascript:;">
                        <span class="badge pull-right"></span>
                        <i class="fa fa-heart"></i>
                        <span>Exercises</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="{{isset($meta['exe_sub_menu_new'])?$meta['exe_sub_menu_new']:''}}"><a href="{{url('/admin/exercises/new')}}">Add New</a></li>
                        <li class="{{isset($meta['exe_sub_menu_list'])?$meta['exe_sub_menu_list']:''}}"><a href="{{url('/admin/exercises/index')}}">List</a></li>
                        <li class="{{isset($meta['execat_sub_menu_new'])?$meta['execat_sub_menu_new']:''}}"><a href="{{url('/admin/execategories/new')}}">Add New Category</a></li>
                        <li class="{{isset($meta['execat_sub_menu_list'])?$meta['execat_sub_menu_list']:''}}"><a href="{{url('/admin/execategories/index')}}">Categories List</a></li>
                    </ul>
                </li>
                <li class="has-sub {{isset($meta['man_main_menu'])?$meta['man_main_menu']:''}}">
                    <a href="javascript:;">
                        <span class="badge pull-right"></span>
                        <i class="fa fa-industry"></i>
                        <span>Manufacturers</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="{{isset($meta['man_sub_menu_new'])?$meta['man_sub_menu_new']:''}}"><a href="{{url('/admin/manufacturer/new')}}">Add New</a></li>
                        <li class="{{isset($meta['man_sub_menu_list'])?$meta['man_sub_menu_list']:''}}"><a href="{{url('/admin/manufacturer/index')}}">List</a></li>
                    </ul>
                </li>

                <li class="has-sub <?php if(isset($active_pra_menu))echo $active_pra_menu?>">
                    <a href="javascript:;">
                        <span class="badge pull-right"></span>
                        <i class="fa fa-user-md"></i>
                        <span>Practitioners</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php if(isset($active_pra_list))echo $active_pra_list?>"><a href="{{url('/admin/index/practitioners')}}">List</a></li>
                        <!-- <li class="<?php //if(isset($block_pra_list))echo $block_pra_list?>"><a href="//{{url('/admin/index/active-practitioners/1')}}">Blocked List</a></li>
                        <li class="<?php //if(isset($inactive_pra_menu))echo $inactive_pra_menu?>"><a href="#">Inactive List</a></li> -->
                    </ul>
                </li>

                <li class="has-sub <?php if(isset($pages_menu))echo $pages_menu;?>">
                    <a href="javascript:;">
                        <span class="badge pull-right"></span>
                        <i class="fa fa-file"></i>
                        <span>Pages</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php if(isset($new_page))echo $new_page;?>"><a href="{{url('/admin/page/new')}}">New</a></li>
                        <li class="<?php if(isset($page_list))echo $page_list;?>"><a href="{{url('/admin/page')}}">List</a></li>
                    </ul>
                </li>

                <li class="has-sub <?php if(isset($template_menu))echo $template_menu;?>">
                    <a href="javascript:;">
                        <span class="badge pull-right"></span>
                        <i class="fa fa-envelope"></i>
                        <span>E-Mail Templates</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php if(isset($new_template))echo $new_template;?>"><a href="{{url('/admin/email-templates/new')}}">New</a></li>
                        <li class="<?php if(isset($templates_list))echo $templates_list;?>"><a href="{{url('/admin/email-templates')}}">List</a></li>
                    </ul>
                </li>

                <li class="has-sub">
                    <a href="javascript:;">
                        <i class="fa fa-medkit"></i>
                        <span>Reprots</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="#">Sales</a></li>
                        <li><a href="#">Visits</a></li>
                    </ul>
                </li>

                <li class="has-sub <?php if(isset($user_menu))echo $user_menu?>">
                    <a href="javascript:;">
                        <span class="badge pull-right"></span>
                        <i class="fa fa-medkit"></i>
                        <span>Users</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php if(isset($new_user))echo $new_user?>"><a href="#">Add New</a></li>
                        <li class="<?php if(isset($user_list))echo $user_list?>"><a href="{{url('/admin/index/users')}}">List</a></li>
                    </ul>
                </li>

                <li class="has-sub <?php if(isset($coupon_menu))echo $coupon_menu?>">
                    <a href="javascript:;">
                        <span class="badge pull-right"></span>
                        <i class="fa fa-tags"></i>
                        <span>Coupon</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php if(isset($new_coupon))echo $new_coupon?>"><a href="<?php echo e(url('/admin/coupon/new')); ?>">Generate New</a></li>
                        <li class="<?php if(isset($list_coupon))echo $list_coupon?>"><a href="<?php echo e(url('/admin/coupon')); ?>">List</a></li>
                    </ul>
                </li>

                <!-- begin sidebar minify button -->
                <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
                <!-- end sidebar minify button -->
            </ul>
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
<script type="text/javascript" src="{{asset('public/dashboard/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/DataTables/media/js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/js/dashboard.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/parsley/dist/parsley.js')}}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
@yield('bottom');
<script type="text/javascript" src="{{asset('public/dashboard/js/apps.min.js')}}"></script>
<script src="{{asset('public/dashboard/plugins/datepicker/form-plugins.demo.min.js')}}"></script>
<script>
    $(document).ready(function() {
        App.init();
        Dashboard.init();
        FormPlugins.init();
        var render = '<div class="row">';
        render+='<a id="deleteDialogue" href="#modal-dialog" class="btn btn-sm btn-success" data-toggle="modal">Delete</a>';
        render+='        <div class="modal fade" id="modal-dialog">';
        render+='<div class="modal-dialog">';
        render+='<div class="modal-content">';
        render+='<div class="modal-header">';
        render+='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
        render+='<h4 class="modal-title">Delete Entry</h4>';
        render+='</div>';
        render+='<div class="modal-body">';
        render+='<div class="alert alert-danger m-b-0">';
        render+='<h4><i class="fa fa-info-circle"></i> Sure you want to Delete this entry permanently?</h4>';
        render+='</div>';
        render+='</div>';
        render+='<div class="modal-footer">';
        render+='<input type="button" value="Yes" id="btnDelete" class="btn btn-sm btn-success" />';
        render+='<a href="javascript:;" class="btn btn-sm btn-danger" data-dismiss="modal">No</a>';
        render+='</div>';
        render+='</div>';
        render+='</div>';
        render+='</div>';
        render+='</div>';
        $('#content').append(render);
        $('[id^="delete_"]').removeAttr('onclick');
        $('#deleteDialogue').hide();
           });
    $('[id^="delete_"]').click(function() {
        var deleteId = $(this).attr('id').split('_')[1];
        $('#deleteDialogue').click();
//        $("#btnDelete").click(DelteDialouge(deleteId));
        $("#btnDelete").attr("onclick", "DelteDialouge("+deleteId+")");
    });
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

</script>
<script  type="text/javascript">
    function DelteDialouge(id)
    {
        doDelete(id,'');
        $('#deleteDialogue').click();
    }
</script>
@yield('page-scripts')
</body>
</html>
