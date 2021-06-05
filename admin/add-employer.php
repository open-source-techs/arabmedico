<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Employer</h1>
            <small>Add New Employer</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add Employer</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>list-employer"> <i class="fa fa-list"></i> Employer List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/employeeModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Employer Name</label>
                                <input type="text" name="txt_emp_name" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Employer Name in Arabic</label>
                                <input type="text" name="txt_emp_name_ar" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Employer Number</label>
                                <input type="text" name="txt_emp_number" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Icon (image only)</label>
                                <input type="file" name="txt_icon" class="form-control onChangeImg" required>
                                <label class="txt_icon"></label>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Employer Website link</label>
                                <input type="url" name="txt_emp_url" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Corporate Email</label>
                                <input type="text" name="txt_corporate_email" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Location</label>
                                <input type="text" name="txt_location" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Location Arabic</label>
                                <input type="text" name="txt_location_ar" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Health Service Type</label>
                                <input type="text" name="txt_serviceType" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Health Service Type in Arabic</label>
                                <input type="text" name="txt_serviceType_ar" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Contact Person Name</label>
                                <input type="text" name="txt_c_person" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Cell No</label>
                                <input type="text" name="txt_c_number" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Email</label>
                                <input type="text" name="txt_c_email" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Position in Company</label>
                                <input type="text" name="txt_c_positin" class="form-control" required>
                            </div>
                            
                            
                            
                            <div class="col-sm-6 form-group">
                                <label>Employer login Username</label>
                                <input type="text" name="txt_emp_username" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Employer login Password</label>
                                <input type="password" name="txt_emp_password" class="form-control" required>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>list-employer" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_save_emp" class="btn btn-success" value="Save">
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