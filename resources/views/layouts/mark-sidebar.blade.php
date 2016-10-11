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
                    Peter Bahrouzi
                    <small>Practitioner</small>
                </div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">Navigation</li>
            <li class="has-sub active">
                <a href="javascript:;">
                    <i class="fa fa-briefcase"></i>
                    <span>Suggestions</span>
                </a>
                <ul class="sub-menu">
                    <li class=" "><a href="">Supplements</a></li>
                    <li><a href="#">Nutritions</a></li>
                    <li><a href="#">Exercises</a></li>
                </ul>
            </li>

            <li class="has-sub">
                <a href="javascript:;">
                    <i class="fa fa-desktop"></i>
                    <span>Social Marketing</span>
                </a>
                <ul class="sub-menu">
                    <li class=" "><a href="">Write something</a></li>
                    <li><a href="#">Social Settings</a></li>
                </ul>
            </li>
            <li class="has-sub ">
                <a href="javascript:;">
                    <i class="fa fa-comment"></i>
                    <span>Blogging</span>
                </a>
                <ul class="sub-menu">
                    <li class=" "><a href="">Write a Post</a></li>
                    <li><a href="#">My Posts</a></li>
                </ul>
            </li>
            <li class="has-sub ">
                <a href="javascript:;">
                    <i class="fa fa-envelope"></i>
                    <span>E-Mail Marketing</span>
                </a>
                <ul class="sub-menu">
                    <li class=" "><a href="#">Send eMail</a></li>
                    <li><a href="#">Templates</a></li>
                </ul>
            </li>
            <li class="has-sub {{isset($meta['cm_main_menu'])?$meta['cm_main_menu']:''}}">
                <a href="javascript:;">
                    <i class="fa fa-book"></i>
                    <span>Contact Management</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{isset($meta['cg_sub_menu_new'])?$meta['cg_sub_menu_new']:''}}"><a href="{{url('/practitioner/contact-group/new')}}">Create New Group</a></li>
                    <li class="{{isset($meta['cg_sub_menu_list'])?$meta['cg_sub_menu_list']:''}}"><a href="{{url('/practitioner/contact-group')}}">Group List</a></li>
                    <li class="{{isset($meta['cnt_sub_menu_new'])?$meta['cnt_sub_menu_new']:''}}"><a href="{{url('/practitioner/contact/new')}}">Create New Contact</a></li>
                    <li class="{{isset($meta['cnt_sub_menu_list'])?$meta['cnt_sub_menu_list']:''}}"><a href="{{url('/practitioner/contact')}}">Contact List</a></li>
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