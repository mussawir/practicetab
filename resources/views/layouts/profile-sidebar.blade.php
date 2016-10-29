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
            <li class="has-sub <?php if(isset($profile))echo $profile ?> ">
                <a href="{{url('/practitioner/profile')}}">
                    <i class="fa fa-briefcase"></i>
                <span>Public Profile</span>
                </a>
            </li>

            <li class="has-sub <?php if(isset($practice))echo $practice ?> ">
                <a href="{{url('/practitioner/profile/practice')}}">
                    <i class="fa fa-briefcase"></i>
                    <span>Practice Profile</span>
                </a>
            </li>

            <li class="has-sub <?php if(isset($clinic))echo $clinic ?>">
                <a href="{{url('/practitioner/profile/clinic')}}">
                    <i class="fa fa-clock-o"></i>
                    <span>Clinic</span>
                </a>
            </li>

            <li class="has-sub <?php if(isset($hours))echo $hours ?>">
                <a href="{{url('/practitioner/profile/hours')}}">
                    <i class="fa fa-clock-o"></i>
                    <span>Operating Hours</span>
                </a>
            </li>

            <li class="has-sub ">
                <a href="javascript:;">
                    <i class="fa fa-cog"></i>
                    <span>Other Setting</span>
                </a>
                <ul class="sub-menu">
                    <li class=" "><a href="">Social Media</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Merchant Account</a></li>

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