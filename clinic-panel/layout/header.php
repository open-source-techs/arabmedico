<?php require_once('config/db.php');?>
<?php 
if(get_sess('clinic_logged_in') != 1)
{
    jump(admin_base_url()."login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medical Web Admin</title>
    <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
    <link href="<?= admin_base_url();?>assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= admin_base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= admin_base_url();?>assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= admin_base_url();?>assets/plugins/pace/flash.css" rel="stylesheet" type="text/css"/>
    <link href="<?= admin_base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= admin_base_url();?>assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
    <link href="<?= admin_base_url();?>assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
    <link href="<?= admin_base_url();?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
    <link href="<?= admin_base_url();?>assets/plugins/toastr/toastr.css" rel="stylesheet" type="text/css"/>
    <link href="<?= admin_base_url();?>assets/plugins/emojionearea/emojionearea.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= admin_base_url();?>assets/plugins/monthly/monthly.css" rel="stylesheet" type="text/css"/>
    <link href="<?= admin_base_url();?>assets/dist/css/stylehealth.min.css" rel="stylesheet" type="text/css"/>
    
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">
        <header class="main-header">
            <a href="<?= admin_base_url();?>" class="logo">
                <span class="logo-mini">
                    <img src="assets/dist/img/mini-logo.png" alt="">
                </span>
                <span class="logo-lg">
                    <img src="assets/dist/img/logo.png" alt="">
                </span>
            </a>
            <nav class="navbar navbar-static-top ">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="fa fa-tasks"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!--<li class="dropdown messages-menu">-->
                        <!--   <a href="#" class="dropdown-toggle admin-notification" data-toggle="dropdown"> -->
                        <!--        <i class="pe-7s-cart"></i>-->
                        <!--        <span class="label label-primary">5</span>-->
                        <!--    </a>-->
                        <!--    <ul class="dropdown-menu">-->
                        <!--        <li class="header"><i class="fa fa-shopping-basket"></i> 4 Orders</li>-->
                        <!--        <li>-->
                        <!--            <ul class="menu">-->
                        <!--                <li >-->
                        <!--                    <a href="#" class="border-gray">-->
                        <!--                        <div class="pull-left">-->
                        <!--                            <img src="assets/dist/img/stethescope.png" class="img-thumbnail" alt="User Image">-->
                        <!--                        </div>-->
                        <!--                        <h4>stethescope</h4>-->
                        <!--                        <p><strong>total item:</strong> 21</p>-->
                        <!--                    </a>-->
                        <!--                </li>-->
                        <!--                <li>-->
                        <!--                    <a href="#" class="border-gray">-->
                        <!--                        <div class="pull-left">-->
                        <!--                            <img src="assets/dist/img/nocontrol.png" class="img-thumbnail" alt="User Image">-->
                        <!--                        </div>-->
                        <!--                    <h4>Nocontrol</h4>-->
                        <!--                    <p><strong>total item:</strong> 11-->
                        <!--                    </p>-->
                        <!--                    </a> -->
                        <!--                </li>-->
                        <!--                <li>-->
                        <!--                    <a href="#" class="border-gray">-->
                        <!--                        <div class="pull-left">-->
                        <!--                            <img src="assets/dist/img/lab.png" class="img-thumbnail" alt="User Image">-->
                        <!--                        </div>-->
                        <!--                        <h4>lab</h4>-->
                        <!--                        <p><strong>total item:</strong> 16-->
                        <!--                        </p>-->
                        <!--                    </a> -->
                        <!--                </li>-->
                        <!--                <li class="nav-list">-->
                        <!--                    <a href="#" class="border-gray">-->
                        <!--                        <div class="pull-left">-->
                        <!--                            <img src="assets/dist/img/therm.jpg" class="img-thumbnail" alt="User Image">-->
                        <!--                        </div>-->
                        <!--                        <h4>Pressure machine</h4>-->
                        <!--                        <p><strong>total item:</strong> 10</p>-->
                        <!--                    </a> -->
                        <!--                </li>-->
                        <!--            </ul>-->
                        <!--        </li>-->
                        <!--        <li class="footer"><a href="#"> See all Orders <i class="fa fa-arrow-right"></i></a></li>-->
                        <!--    </ul>-->
                        <!--</li>-->
                        <!--<li class="dropdown messages-menu">-->
                        <!--    <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
                        <!--        <i class="pe-7s-mail"></i>-->
                        <!--        <span class="label label-success">4</span>-->
                        <!--    </a>-->
                        <!--    <ul class="dropdown-menu">-->
                        <!--        <li class="header"><i class="fa fa-envelope-o"></i>-->
                        <!--        4 Messages</li>-->
                        <!--        <li>-->
                        <!--            <ul class="menu">-->
                        <!--                <li>-->
                        <!--                    <a href="#" class="border-gray">-->
                        <!--                        <div class="pull-left">-->
                        <!--                            <img src="assets/dist/img/avatar2.png" class="img-thumbnail" alt="User Image">-->
                        <!--                        </div>-->
                        <!--                        <h4>Alrazy</h4>-->
                        <!--                        <p>Lorem Ipsum is simply dummy text of...</p>-->
                        <!--                        <span class="label label-success pull-right">11.00am</span>-->
                        <!--                    </a>-->
                        <!--                </li>-->
                        <!--                <li>-->
                        <!--                    <a href="#" class="border-gray">-->
                        <!--                        <div class="pull-left">-->
                        <!--                        <img src="assets/dist/img/avatar4.png" class="img-thumbnail" alt="User Image"></div>-->
                        <!--                        <h4>Tanjil</h4>-->
                        <!--                        <p>Lorem Ipsum is simply dummy text of...-->
                        <!--                        </p>-->
                        <!--                        <span class="label label-success pull-right"> 12.00am</span>-->
                        <!--                    </a>       -->

                        <!--                </li>-->
                        <!--                <li>-->
                        <!--                    <a href="#" class="border-gray">-->
                        <!--                        <div class="pull-left">-->
                        <!--                        <img src="assets/dist/img/avatar3.png" class="img-thumbnail" alt="User Image"></div>-->
                        <!--                        <h4>Jahir</h4>-->
                        <!--                        <p>Lorem Ipsum is simply dummy text of...-->
                        <!--                        </p>-->
                        <!--                        <span class="label label-success pull-right"> 10.00am</span>-->
                        <!--                    </a>       -->

                        <!--                </li>-->
                        <!--                <li>-->
                        <!--                   <a href="#" class="border-gray">-->
                        <!--                        <div class="pull-left">-->
                        <!--                        <img src="assets/dist/img/avatar4.png" class="img-thumbnail" alt="User Image"></div>-->
                        <!--                        <h4>Shawon</h4>-->
                        <!--                        <p>Lorem Ipsum is simply dummy text of...-->
                        <!--                        </p>-->
                        <!--                        <span class="label label-success pull-right"> 09.00am</span>-->
                        <!--                    </a>       -->

                        <!--                </li>-->
                        <!--                <li>-->
                        <!--                    <a href="#" class="border-gray">-->
                        <!--                        <div class="pull-left">-->
                        <!--                        <img src="assets/dist/img/avatar3.png" class="img-thumbnail" alt="User Image"></div>-->
                        <!--                        <h4>Shipon</h4>-->
                        <!--                        <p>Lorem Ipsum is simply dummy text of...-->
                        <!--                        </p>-->
                        <!--                        <span class="label label-success pull-right"> 03.00pm</span>-->
                        <!--                    </a>       -->
                        <!--                </li>-->
                        <!--            </ul>-->
                        <!--        </li>-->
                        <!--        <li class="footer"><a href="#">See all messages <i class=" fa fa-arrow-right"></i></a>-->
                        <!--        </li>-->
                        <!--    </ul>-->
                        <!--</li>-->
                        <!--<li class="dropdown notifications-menu">-->
                        <!--    <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
                        <!--        <i class="pe-7s-bell"></i>-->
                        <!--        <span class="label label-warning">8</span>-->
                        <!--    </a>-->
                        <!--    <ul class="dropdown-menu">-->
                        <!--        <li class="header"><i class="fa fa-bell"></i> 8 Notifications</li>-->
                        <!--        <li>-->
                        <!--            <ul class="menu">-->
                        <!--                <li>-->
                        <!--                <a href="#" class="border-gray"><i class="fa fa-inbox"></i> Inbox  <span class=" label-success label label-default pull-right">9</span></a>-->
                        <!--                </li>-->
                        <!--                <li>-->
                        <!--                <a href="#" class="border-gray"><i class="fa fa-cart-plus"></i> New Order <span class=" label-success label label-default pull-right">3</span> </a>-->
                        <!--                </li>-->
                        <!--                <li>-->
                        <!--                <a href="#" class="border-gray"><i class="fa fa-money"></i> Payment Failed  <span class="label-success label label-default pull-right">6</span> </a>-->
                        <!--                </li>-->
                        <!--                <li>-->
                        <!--                <a href="#" class="border-gray"><i class="fa fa-cart-plus"></i> Order Confirmation <span class="label-success label label-default pull-right">7</span> </a>-->
                        <!--                </li>-->
                        <!--                <li>-->
                        <!--                <a href="#" class="border-gray"><i class="fa fa-cart-plus"></i> Update system status <span class=" label-success label label-default pull-right">11</span> </a>-->
                        <!--                </li>-->
                        <!--                <li>-->
                        <!--                <a href="#" class="border-gray"><i class="fa fa-cart-plus"></i> client update <span class="label-success label label-default pull-right">12</span> </a>-->
                        <!--                </li>-->
                        <!--                <li>-->
                        <!--                <a href="#" class="border-gray"><i class="fa fa-cart-plus"></i> shipment cancel -->
                        <!--                <span class="label-success label label-default pull-right">2</span> </a>-->
                        <!--                </li>-->
                        <!--            </ul>-->
                        <!--        </li>-->
                        <!--       <li class="footer">-->
                        <!--       <a href="#"> See all Notifications <i class=" fa fa-arrow-right"></i></a>-->
                        <!--        </li>-->
                        <!--    </ul>-->
                        <!--</li>-->
                        <!--<li class="dropdown tasks-menu">-->
                        <!--    <a href="#" class="dropdown-toggle" data-toggle="dropdown">-->
                        <!--        <i class="pe-7s-file"></i>-->
                        <!--        <span class="label label-danger">9</span>-->
                        <!--    </a>-->
                        <!--    <ul class="dropdown-menu">-->
                        <!--        <li class="header"><i class="fa fa-file"></i> 9 tasks</li>-->
                        <!--        <li>-->
                        <!--            <ul class="menu">-->
                        <!--                <li>-->
                        <!--                    <a href="#">-->
                        <!--                        <h3>-->
                        <!--                            <i class="fa fa-check-circle"></i> Data table error-->
                        <!--                            <span class="label-primary label label-default pull-right">35%</span>-->
                        <!--                        </h3>-->
                        <!--                        <div class="progress">-->
                        <!--                            <div class="progress-bar progress-bar-primary progress-bar-striped active" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" data-original-title="35%" style="width: 35%">-->
                        <!--                                <span class="sr-only">35% Complete (primary)</span>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <!--                    </a>-->
                        <!--                </li>-->
                        <!--                <li>-->
                        <!--                    <a href="#">-->
                        <!--                        <h3>-->
                        <!--                          <i class="fa fa-check-circle"></i>  Change theme color-->
                        <!--                           <span class="label-success label label-default pull-right">55%</span>-->
                        <!--                        </h3>-->
                        <!--                        <div class="progress">-->
                        <!--                            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" data-original-title="55%" style="width: 55%">-->
                        <!--                                <span class="sr-only">55% Complete (primary)</span>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <!--                    </a>-->
                        <!--                </li>-->
                        <!--                <li>-->
                        <!--                    <a href="#">-->
                        <!--                        <h3>-->
                        <!--                            <i class="fa  fa-check-circle"></i> Change the font-family -->
                        <!--                            <span class="label-info label label-default pull-right">60%</span>-->
                        <!--                        </h3>-->
                        <!--                        <div class="progress">-->
                        <!--                            <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" data-original-title="60%" style="width: 60%">-->
                        <!--                                <span class="sr-only">60% Complete (info)</span>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <!--                    </a>-->
                        <!--                </li>-->
                        <!--                <li>-->
                        <!--                    <a href="#">-->
                        <!--                        <h3>-->
                        <!--                           <i class="fa  fa-check-circle"></i> Animation should be skip-->
                        <!--                           <span class="label-warning label label-default pull-right">80%</span>-->
                        <!--                        </h3>-->
                        <!--                        <div class="progress">-->
                        <!--                            <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" data-original-title="80%"  style="width: 80%">-->
                        <!--                                <span class="sr-only">80% Complete (warning)</span>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <!--                    </a>-->
                        <!--                </li>-->
                        <!--            </ul>-->
                        <!--        </li>-->
                        <!--        <li class="footer"><a href="#">See all tasks <i class=" fa fa-arrow-right"></i></a></li>-->
                        <!--    </ul>-->
                        <!--</li>-->
                        <!--<li class="dropdown dropdown-user admin-user">-->
                        <!--    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> -->
                        <!--    <div class="user-image">-->
                        <!--    <img src="<?= admin_base_url();?>assets/dist/img/avatar4.png" class="img-circle" height="40" width="40" alt="User Image">-->
                        <!--    </div>-->
                        <!--    </a>-->
                        <!--    <ul class="dropdown-menu">-->
                        <!--        <li><a href="<?= admin_base_url();?>profile"><i class="fa fa-users"></i> User Profile</a></li>-->
                        <!--        <li><a href="<?= admin_base_url();?>model/adminUser?act=logout"><i class="fa fa-sign-out"></i> Logout</a></li>-->
                        <!--    </ul>-->
                        <!--</li>-->
                    </ul>
                </div>
            </nav>
        </header>