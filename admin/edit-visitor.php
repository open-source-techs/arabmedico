<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$uid = $_GET['uid'];
if($uid == 0 || $uid == '' || $uid < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>all-visitor";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_users where user_id = '$uid'");
$user = fetch($sql);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <form action="#" method="get" class="sidebar-form search-box pull-right hidden-md hidden-lg hidden-sm">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>  
            <h1>Visitor</h1>
            <small>Edit Visitor</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Edit Visitor</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>all-visitor"> <i class="fa fa-list"></i> Visitors List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/visitorModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Full Name</label>
                                <input type="hidden" name="txt_user_id" value="<?= $user['user_id']; ?>" >
                                <input type="text" name="txt_full_name" value="<?= $user['user_name']; ?>" class="form-control" placeholder="Enter Full Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Full Name Arabic</label>
                                <input type="text" name="txt_full_name_arabic" value="<?= $user['user_name_arabic']; ?>" class="form-control" placeholder="Enter Full Name In Arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Profile image</label>
                                <label class="txt_icon"></label>
                                <input type="file" name="txt_icon" onchange="checkFileSize('txt_icon');" id="txt_icon" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Phone Number</label>
                                <input type="tel" name="txt_phone" value="<?= $user['user_phone']; ?>" class="form-control" placeholder="Enter Phone Number" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Phone Number In Arabic</label>
                                <input type="tel" name="txt_phone_arabic" value="<?= $user['user_phone_arabic']; ?>" class="form-control" placeholder="Enter Phone Number In Arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Email</label>
                                <input type="email" name="txt_email" value="<?= $user['user_email']; ?>" class="form-control" placeholder="Enter Email" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Verified </label>
                                <select name="txt_is_veirfied" class="form-control">
                                    <option <?= ($user['user_verified'] == 0) ? 'selected' : "";?> value="0">No</option>
                                    <option <?= ($user['user_verified'] == 1) ? 'selected' : "";?> value="1">Yes</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Active</label>
                                <select name="txt_is_active" class="form-control">
                                    <option <?= ($user['user_status'] == 0) ? 'selected' : "";?> value="0">No</option>
                                    <option <?= ($user['user_status'] == 1) ? 'selected' : "";?> value="1">Yes</option>
                                </select>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>all-visitor" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit_user" class="btn btn-success" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/visitorModel" onsubmit="return checkPass()" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Password</label>
                                <input type="hidden" name="txt_user_id" value="<?= $user['user_id']; ?>" >
                                <input type="password" name="txt_pass" id="txt_pass" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="txt_cnf_pass" id="txt_cnf_pass" class="form-control" required>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>all-visitor" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit_user_password" class="btn btn-success" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php require_once('layout/footer.php');?>
<?php
get_msg('msg');
?>
<script>
    function checkPass()
    {
        if($("#txt_pass").val() != "" && $("#txt_pass").val() != null
        {
            if($("#txt_pass").val() == $("#txt_cnf_pass").val())
            {
                return true
            }
            else
            {
                setTimeout(function () {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 5000
                    };
                    toastr.error('Fields Error', 'Passwords does not match');
                }, 100);
                return false;
            }
        }
        else
        {
            setTimeout(function () {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 5000
                };
                toastr.error('Fields Error', 'Passwords can not be null or empty');
            }, 100);
            return false;
        }
    }
</script>