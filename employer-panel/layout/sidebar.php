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
                <p><?= get_sess('userdata')['emp_name'];?></p>
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
            <li class="">
                <a href="<?= admin_base_url();?>my-jobs">
                    <i class="fa fa-briefcase"></i>
                    <span>My Jobs</span>
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
                <a href="<?= admin_base_url();?>add-job">
                    <i class="fa fa-briefcase"></i>
                    <span>Add Jobs</span>
                </a>
            </li>
            <li class="">
                <a href="<?= admin_base_url();?>job-applications">
                    <i class="fa fa-briefcase"></i>
                    <span>Job Applications</span>
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