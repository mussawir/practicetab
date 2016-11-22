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
            <li class="menu"><a href="{{url('/practitioner/management')}}"><i class="fa fa-calendar"></i><span>Calendar</span> </a></li>
            <li class="menu"><a href="{{url('/practitioner/management')}}"><i class="fa fa-calendar-plus-o"></i> <span>Today's Appointments </span></a></li>
            <li class="menu"><a href="javascript:;"><i class="fa fa-bell"></i> <span>Important notifications </span></a></li>
            <li class="menu <?php if(isset($new_patient))echo $new_patient ?>"><a href="{{url('/practitioner/patient/new')}}"><i class="fa fa-user-plus"></i> <span>New Patient</span></a></li>
            <li class="menu <?php if(isset($patients_list))echo $patients_list ?> "><a href="{{url('/practitioner/patient/')}}"><i class="fa fa-list"></i> <span>Patients List</span></a></li>
            <li class="menu"><a href="javascript:;"><i class="fa fa-cc-mastercard"></i> <span>Due Payments </span></a></li>
            <li class="menu"><a href="javascript:;"><i class="fa fa-money"></i> <span>Outdated Payments </span></a></li>



            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>


                <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
