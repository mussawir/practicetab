<ul class="nav">
                <li class="nav-header">Navigation</li>
                <li class="has-sub active">
                    <a href="{{url('/patient')}}">
                        <i class="fa fa-laptop"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li><a href="{{url('patient/index/get-appointment')}}"><i class="fa fa-calendar-o"></i> <span>Get Appointment</span></a></li>
                <li><a href="{{url('patient/index/appointmentHistory')}}"><i class="fa fa-calendar"></i> <span>Appointments</span></a></li>
                <li class="has-sub <?php if(isset($template_menu))echo $template_menu;?>">
                    <a href="javascript:;">
                        <i class="fa fa-medkit"></i>
                        <span>Supplement</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{url('/patient/index/supplement-request')}}"><i class="fa fa-medkit"></i> <span>Request Supplements</span></a></li>
                        <li><a href="{{url('/patient/index/supplement-request-list')}}"><i class="fa fa-list-alt"></i> <span>Requested List</span></a></li>
                    </ul>
                </li>
                <li class="has-sub <?php if(isset($template_menu))echo $template_menu;?>">
                    <a href="javascript:;">
                        <i class="fa fa-fire"></i>
                        <span>Nutrition</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{url('/patient/index/nutrition-request')}}"><i class="fa fa-fire"></i> <span>Request Nutritions</span></a></li>
                        <li><a href="{{url('/patient/index/nutrition-request-list')}}"><i class="fa fa-list-alt"></i> <span>Requested List</span></a></li>
                    </ul>
                </li>
                <li class="has-sub <?php if(isset($template_menu))echo $template_menu;?>">
                    <a href="javascript:;">
                        <i class="fa fa-heart"></i>
                        <span>Exercise</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{url('patient/index/exercise-request')}}"><i class="fa fa-heart"></i> <span>Request Exercises</span></a></li>
                        <li><a href="{{url('/patient/index/exercise-request-list')}}"><i class="fa fa-list-alt"></i> <span>Requested List</span></a></li>
                    </ul>
                </li>

                <li><a href="{{url('#')}}"><i class="fa fa-comment-o"></i> <span>New Message</span></a></li>
                <li><a href="{{url('#')}}"><i class="fa fa-comments-o"></i> <span>Message Box</span></a></li>
                <li><a href="{{url('#')}}"><i class="fa fa-money"></i> <span>Payments</span></a></li>
                <li><a href="{{url('#')}}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>

                <!-- begin sidebar minify button -->
                <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
                <!-- end sidebar minify button -->
            </ul>
