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
                <p><?= get_sess('userdata')['doc_name'] . "<br>" . get_sess('userdata')['doc_degree'];?></p>
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
                <a href="<?= admin_base_url();?>account">
                    <i class="fa fa-lock"></i>
                    <span>My Account</span>
                </a>
            </li>
            <li class="">
                <a href="<?= admin_base_url();?>myprofile">
                    <i class="fa fa-user-md"></i>
                    <span>My Profile</span>
                </a>
            </li>
            <li class="">
                <a href="<?= admin_base_url();?>photo-gallery">
                    <i class="fa fa-camera"></i>
                    <span>Photo Gallery</span>
                </a>
            </li>
            <li class="">
                <a href="<?= admin_base_url();?>video-gallery">
                    <i class="fa fa-video-camera"></i>
                    <span>Video Gallery</span>
                </a>
            </li>
            <li class="<?php active_page('appointments'); ?>">
                <a href="<?= admin_base_url();?>appointments">
                    <i class="fa fa-calendar"></i>
                    <span>Appointments</span>
                </a>
            </li>
            <li class="<?php active_page('all-testimonial'); ?>">
                <a href="<?= admin_base_url();?>all-testimonial">
                    <i class="fa fa-credit-card-alt"></i>
                    <span>Testimonials</span>
                </a>
            </li>
            <li class="<?php active_page('schedule'); ?>">
                <a href="<?= admin_base_url();?>schedule">
                    <i class="fa fa-clock-o"></i>
                    <span>Schedule</span>
                </a>
            </li>
            <li class="<?php active_page('posts'); ?>">
                <a href="<?= admin_base_url();?>Posts">
                    <i class="fa fa-clock-o"></i>
                    <span>Posts</span>
                </a>
            </li>
            <?php
            $sql_new = query("SELECT * FROM tbl_membership WHERE membership_id = ". get_sess('userdata')['doc_membership']);
            $fetch = fetch($sql_new);
            if($fetch['allow_branding'] == 1)
            {
                ?>
                <li class="<?php active_page('branding'); ?>">
                    <a href="<?= admin_base_url();?>branding">
                        <i class="fa fa-eye"></i>
                        <span>Branding (Premium)</span>
                    </a>
                </li>
                <?php
            }
            if($fetch['super_consultant'] == 1)
            {
                ?>
                <!--<li class="<?php active_page('clinical-services'); ?>">-->
                <!--    <a href="<?= admin_base_url();?>clinical-services">-->
                <!--        <i class="fa fa-sitemap"></i>-->
                <!--        <span>Clinical Services</span>-->
                <!--    </a>-->
                <!--</li>-->
                <?php
            }
            ?>
            <li class="">
                <a href="<?= admin_base_url();?>model/adminUser?act=logout">
                    <i class="fa fa-sign-out"></i>
                    <span>Logout</span>
                </a>
            </li>
		</ul>
	</div>
</aside>