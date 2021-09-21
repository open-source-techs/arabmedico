<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$hospital_id = get_sess("userdata")['hospital_id'];
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Insurance</h1>
            <small>Add New Insurance</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add Insurance</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>all-insurance"> <i class="fa fa-list"></i> Insurance List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/insuranceModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" value="<?= $hospital_id; ?>" name="txt_hospitalID">
                            <div class="col-sm-6 form-group">
                                <label>Insurance title</label>
                                <input type="text" name="txt_insurance_name" class="form-control" placeholder="Enter insurance Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Insurance Title Arabic</label>
                                <input type="text" name="arabic_insurance_title" class="form-control" placeholder="insurance Title Arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Insurance Picture</label>
                                <input type="file" name="insurance_profile" class="form-control"  onchange="checkFileSize('cer_profile');" id="txt_profile" required>
                                <label class="txt_profile"></label>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>all-insurance.php" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_save_cer" class="btn btn-success" value="Save">
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