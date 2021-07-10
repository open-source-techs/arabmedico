<?php require_once('config/db.php');?>
<?php 
if(get_sess('doctor_logged_in') != 1)
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
    <title>Doctor Panel | Arabmedico</title>
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
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="pe-7s-bell"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header"><i class="fa fa-bell"></i>
                                4 Messages</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#" class="border-gray">
                                                <div class="pull-left">
                                                    <img src="assets/dist/img/avatar2.png" class="img-thumbnail" alt="User Image">
                                                </div>
                                                <h4>Alrazy</h4>
                                                <p>Lorem Ipsum is simply dummy text of...</p>
                                                <span class="label label-success pull-right">11.00am</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="border-gray">
                                                <div class="pull-left">
                                                <img src="assets/dist/img/avatar4.png" class="img-thumbnail" alt="User Image"></div>
                                                <h4>Tanjil</h4>
                                                <p>Lorem Ipsum is simply dummy text of...
                                                </p>
                                                <span class="label label-success pull-right"> 12.00am</span>
                                            </a>       

                                        </li>
                                        <li>
                                            <a href="#" class="border-gray">
                                                <div class="pull-left">
                                                <img src="assets/dist/img/avatar3.png" class="img-thumbnail" alt="User Image"></div>
                                                <h4>Jahir</h4>
                                                <p>Lorem Ipsum is simply dummy text of...
                                                </p>
                                                <span class="label label-success pull-right"> 10.00am</span>
                                            </a>       

                                        </li>
                                        <li>
                                           <a href="#" class="border-gray">
                                                <div class="pull-left">
                                                <img src="assets/dist/img/avatar4.png" class="img-thumbnail" alt="User Image"></div>
                                                <h4>Shawon</h4>
                                                <p>Lorem Ipsum is simply dummy text of...
                                                </p>
                                                <span class="label label-success pull-right"> 09.00am</span>
                                            </a>       

                                        </li>
                                        <li>
                                            <a href="#" class="border-gray">
                                                <div class="pull-left">
                                                <img src="assets/dist/img/avatar3.png" class="img-thumbnail" alt="User Image"></div>
                                                <h4>Shipon</h4>
                                                <p>Lorem Ipsum is simply dummy text of...
                                                </p>
                                                <span class="label label-success pull-right"> 03.00pm</span>
                                            </a>       
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See all messages <i class=" fa fa-arrow-right"></i></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>