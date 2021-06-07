<?php require_once('config/db.php');?>
<?php 
if(get_sess('candidate_logged_in') != 1)
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
    <title>Professionals Panel</title>
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
                    <ul class="nav navbar-nav"></ul>
                </div>
            </nav>
        </header>