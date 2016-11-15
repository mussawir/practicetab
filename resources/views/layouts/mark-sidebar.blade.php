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
            <li class="has-sub <?php if(isset($sug_menu))echo $sug_menu;?>">
                <a href="javascript:;">
                    <i class="fa fa-briefcase"></i>
                    <span>Suggestions</span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php if(isset($sup_sug))echo $sup_sug;?>"><a href="{{url('/practitioner/suggestion/supplement-suggestions')}}">Supplements</a></li>
                    <li class="<?php if(isset($nut_sug))echo $nut_sug;?>"><a href="{{url('/practitioner/suggestion/nutrition-suggestions')}}">Nutritions</a></li>
                    <li class="<?php if(isset($sup_sug_list))echo $sup_sug_list;?>"><a href="{{url('/practitioner/suggestion/supplement-suggestions-list')}}">Supplements List</a></li>
                    <li class="<?php if(isset($nut_sug_list))echo $nut_sug_list;?>"><a href="{{url('/practitioner/suggestion/nutrition-suggestions-list')}}">Nutritions List</a></li>
                </ul>
            </li>

            <li class="has-sub <?php if(isset($social_marketing))echo $social_marketing; ?>">
                <a href="javascript:;">
                    <i class="fa fa-desktop"></i>
                    <span>Social Marketing</span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php if(isset($new_social_post))echo $new_social_post; ?>"><a href="{{url('/practitioner/social-post')}}">New Social Post</a></li>
                    <li class="<?php if(isset($social_posts_list))echo $social_posts_list; ?>"><a href="{{url('/practitioner/social-posts-list')}}">Post</a></li>
                    <li><a href="#">Settings</a></li>
                </ul>
            </li>
            <li class="has-sub <?php if(isset($blogging))echo $blogging;?>">
                <a href="javascript:;">
                    <i class="fa fa-comment "></i>
                    <span>Blogging</span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php if(isset($new_post))echo $new_post; ?>"><a href="{{url('/practitioner/blog/new')}}">Write a Post</a></li>
                    <li class="<?php if(isset($my_post))echo $my_post; ?>"><a href="{{url('/practitioner/blog/')}}">Posts</a></li>
                </ul>
            </li>
            <li class="has-sub <?php if(isset($template_menu))echo $template_menu;?>">
                <a href="javascript:;">
                    <i class="fa fa-envelope"></i>
                    <span>E-Mail Marketing</span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php if(isset($eg_sub_menu_new))echo $eg_sub_menu_new;?>"><a href="{{url('/practitioner/email-group/new')}}"> New Email Group</a></li>
                    <li class="<?php if(isset($eg_sub_menu_list))echo $eg_sub_menu_list;?>"><a href="{{url('/practitioner/email-group')}}">Email Group List</a></li>
                    <li class="<?php if(isset($compose_email))echo $compose_email;?>"><a href="{{url('/practitioner/emails/new')}}">Compose Email</a></li>
                    <li class="<?php if(isset($sent_mails))echo $sent_mails;?>"><a href="{{url('/practitioner/emails/sent_list')}}">Sent Emails</a></li>
                    <li class="<?php if(isset($campaign))echo $campaign;?>"><a href="{{url('/practitioner/emails/campaign')}}">Create Campaign</a></li>
                    <li class="<?php if(isset($sent_mails))echo $sent_mails;?>"><a href="{{url('/practitioner/emails/sent_list')}}">Sent Campaigns</a></li>
                    <li class="<?php if(isset($templates_list))echo $templates_list;?>"><a href="{{url('/practitioner/email-templates')}}">Templates</a></li>
                </ul>
            </li>
            <li class="has-sub {{isset($meta['cm_main_menu'])?$meta['cm_main_menu']:''}}">
                <a href="javascript:;">
                    <i class="fa fa-book"></i>
                    <span>Contact Management</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{isset($meta['cg_sub_menu_new'])?$meta['cg_sub_menu_new']:''}}"><a href="{{url('/practitioner/contact-group/new')}}"> New Group</a></li>
                    <li class="{{isset($meta['cg_sub_menu_list'])?$meta['cg_sub_menu_list']:''}}"><a href="{{url('/practitioner/contact-group')}}">Group List</a></li>
                    <li class="{{isset($meta['cnt_sub_menu_new'])?$meta['cnt_sub_menu_new']:''}}"><a href="{{url('/practitioner/contact/new')}}"> New Contact</a></li>
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