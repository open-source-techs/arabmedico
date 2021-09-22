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
                <p><?= get_sess('userdata')['hospital_name'] . "<br>" . get_sess('userdata')['hospital_phone'];?></p>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="<?php active_page('index') | active_page(''); ?>">
                <a href="<?= admin_base_url();?>">
                    <i class="fa fa-hospital-o"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="<?php active_page('profile'); ?>">
                <a href="<?= admin_base_url();?>profile">
                    <i class="fa fa-edit"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="<?php active_page('page-welcome'); ?>">
                <a href="<?= admin_base_url();?>page-welcome">
                    <i class="fa fa-edit"></i>
                    <span>Page Welcome</span>
                </a>
            </li>
            <li class="<?php active_page('slider'); ?>">
                <a href="<?= admin_base_url();?>slider">
                    <i class="fa fa-lock"></i>
                    <span>Slider</span>
                </a>
            </li>
            <li class="<?php active_page('all-doctor'); ?>">
                <a href="<?= admin_base_url();?>all-doctor">
                    <i class="fa fa-user-md"></i>
                    <span>Doctor</span>
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
            <li class="<?php active_page('all-certificates'); ?>">
                <a href="<?= admin_base_url();?>service-panel">
                    <i class="fa fa-sitemap"></i>
                    <span>hospital Services</span>
                </a>
            </li>
            <li class="<?php active_page('all-certificates'); ?>">
                <a href="<?= admin_base_url();?>photo-gallery">
                    <i class="fa fa-camera"></i>
                    <span>Photo Gallery</span>
                </a>
            </li>
            <li class="<?php active_page('all-certificates'); ?>">
                <a href="<?= admin_base_url();?>video-gallery">
                    <i class="fa fa-video-camera"></i>
                    <span>Video Gallery</span>
                </a>
            </li>
            <li class="<?php active_page('all-certificates'); ?>">
                <a href="<?= admin_base_url();?>all-certificates">
                    <i class="fa fa-calendar"></i>
                    <span>Certificates</span>
                </a>
            </li>
            <li class="<?php active_page('all-testimonial'); ?>">
                <a href="<?= admin_base_url();?>all-testimonial">
                    <i class="fa fa-credit-card-alt"></i>
                    <span>Testimonials</span>
                </a>
            </li>
            <li class="<?php active_page('all-insurance'); ?>">
                <a href="<?= admin_base_url();?>all-insurance">
                    <i class="fa fa-certificate"></i>
                    <span>Insurance</span>
                </a>
            </li>
            <li class="<?php active_page('all-package'); ?>">
                <a href="<?= admin_base_url();?>all-package">
                    <i class="fa fa-briefcase"></i>
                    <span>Offers</span>
                </a>
            </li>
            <li class="<?php active_page('all-location'); ?>">
                <a href="<?= admin_base_url();?>all-location">
                    <i class="fa fa-fa map-marker"></i>
                    <span>Practice Location</span>
                </a>
            </li>
            <li class="">
                <a href="<?= admin_base_url();?>model/adminUser?act=logout">
                    <i class="fa fa-sign-out"></i>
                    <span>Logout</span>
                </a>
            </li>
		</ul>
	</div>
</aside>