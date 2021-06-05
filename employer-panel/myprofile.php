<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$emp_id = get_sess("userdata")['emp_id'];
if($emp_id == 0 || $emp_id == '' || $emp_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>model/adminUser?act=logout";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_employer where emp_id = '$emp_id'");
$emp = fetch($sql);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>My Profile</h1>
            <small>Update Profile</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">My Profile</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/employeeModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" value="<?= $emp['emp_id']; ?>" name="txt_emp_id">
                            <div class="col-sm-6 form-group">
                                <label>Employer Name</label>
                                <input type="text" name="txt_emp_name" value="<?= $emp['emp_name'];?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Employer Name in Arabic</label>
                                <input type="text" name="txt_emp_name_ar" value="<?= $emp['emp_name_ar'];?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Employer Number</label>
                                <input type="text" name="txt_emp_number" value="<?= $emp['emp_number'];?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Icon (image only)</label>
                                <input type="file" name="txt_icon" class="form-control onChangeImg">
                                <label class="txt_icon"></label>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Employer Website link</label>
                                <input type="url" name="txt_emp_url" value="<?= $emp['emp_url'];?>" class="form-control" required>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <input type="submit" name="btn_edit_emp" class="btn btn-success" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/employeeModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" value="<?= $emp['emp_id']; ?>" name="txt_emp_id">
                            <div class="col-sm-6 form-group">
                                <label>Username</label>
                                <input type="text" name="txt_username" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Current Password</label>
                                <input type="password" name="txt_c_password" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>New Password</label>
                                <input type="password" name="txt_n_password" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="txt_r_password" class="form-control">
                            </div>
                            <div class="col-sm-12 reset-button">
                                <input type="submit" name="btn_edit_credentail" class="btn btn-success" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php 
require_once('layout/footer.php');
get_msg('msg');
?>