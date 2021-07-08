<style>
    .user-panel .info p{
        line-height: 20px;
    }
</style>
<aside class="main-sidebar">
	<div class="sidebar">
        <div class="user-panel">
            <div class="image pull-left">
                <img src="assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
            </div>
            <div class="info">
                <h4>Welcome</h4>
                <p><?= get_sess('userdata')['candidate_name'];?></p>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="">
                <a href="<?= admin_base_url();?>">
                    <i class="fa fa-hospital-o"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="">
                <a href="<?= admin_base_url();?>myprofile">
                    <i class="fa fa-user-md"></i>
                    <span>My Profile</span>
                </a>
            </li>
            <li class="<?php active_page('contacts'); ?>">
                <a href="<?= admin_base_url();?>my-contacts">
                    <i class="fa fa-users"></i>
                    <span>My Contacts</span>
                </a>
            </li>
            <li class="<?php active_page('inbox'); ?>">
                <a href="<?= admin_base_url();?>inbox">
                    <i class="fa fa-envelope"></i>
                    <span>Inbox</span>
                </a>
            </li>
            <li class="">
                <a href="<?= admin_base_url();?>my-queries">
                    <i class="fa fa-briefcase"></i>
                    <span>Messages</span>
                </a>
            </li>
            <li class="">
                <a href="<?= admin_base_url();?>job-notification">
                    <i class="fa fa-briefcase"></i>
                    <span>Job Notification</span>
                </a>
            </li>
            <?php
            $pacakge = get_sess("userdata")['candidate_package'];
            if($pacakge == 1) { ?>
            <li class="<?php active_page('branding'); ?>">
                <a href="<?= admin_base_url();?>branding">
                    <i class="fa fa-eye"></i>
                    <span>Branding (Premium)</span>
                </a>
            </li>
            <li class="">
                <a href="<?= admin_base_url();?>account">
                    <i class="fa fa-lock"></i>
                    <span>My Account (Premium)</span>
                </a>
            </li>
            <li class="">
                <a href="<?= admin_base_url();?>photo-gallery">
                    <i class="fa fa-camera"></i>
                    <span>Photo Gallery (Premium)</span>
                </a>
            </li>
            <li class="">
                <a href="<?= admin_base_url();?>video-gallery">
                    <i class="fa fa-video-camera"></i>
                    <span>Video Gallery (Premium)</span>
                </a>
            </li>

            <li class="">
                <a href="<?= admin_base_url();?>all-testimonial">
                    <i class="fa fa-credit-card-alt"></i>
                    <span>Reviews (Premium)</span>
                </a>
            </li>
            <?php } ?>
            <li class="">
                <a href="<?= admin_base_url();?>model/adminUser?act=logout">
                    <i class="fa fa-sign-out"></i>
                    <span>Logout</span>
                </a>
            </li>
		</ul>
	</div>
</aside>