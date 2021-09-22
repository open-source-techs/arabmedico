<?php require_once('config/db.php');?>
<?php 
if(get_sess('hospital_logged_in') == 1)
{
    jump(admin_base_url());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>hospital Web Admin | Login</title>
    <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
    <link href="<?= admin_base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= admin_base_url();?>assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
    <link href="<?= admin_base_url();?>assets/dist/css/stylehealth.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= admin_base_url();?>assets/plugins/toastr/toastr.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <div class="login-wrapper">
        <div class="container-center">
            <div class="panel panel-bd">
                <div class="panel-heading">
                    <div class="view-header">
                        <div class="header-icon">
                            <i class="pe-7s-unlock"></i>
                        </div>
                        <div class="header-title">
                            <h3>Login</h3>
                            <small><strong>Please enter your credentials to login.</strong></small>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="<?= admin_base_url();?>model/adminUser" method="post" id="loginForm" novalidate>
                        <div class="form-group">
                            <label class="control-label" for="username">Email / Username</label>
                            <input type="text" placeholder="example@gmail.com" title="Please enter you username or Email" name="username" id="username" class="form-control">
                            <span class="help-block small">Enter your email or usernameto login</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="password">Password</label>
                            <input type="password" title="Please enter your password" placeholder="******" name="password" id="password" class="form-control">
                            <span class="help-block small">Enter your Password</span>
                        </div>
                        <div>
                            <button class="btn btn-primary" name="btn_login">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
    <script src="<?= admin_base_url();?>assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= admin_base_url();?>assets/plugins/toastr/toastr.min.js" type="text/javascript"></script>
    <?php
    get_msg('msg');
    ?>
</html>