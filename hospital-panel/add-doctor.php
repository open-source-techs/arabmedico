<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$hospital_id = get_sess("userdata")['hospital_id'];
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>Doctor Panel</h1>
            <small>Add Doctor</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">Add Doctor</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>all-doctor"> <i class="fa fa-list"></i> Doctor List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/doctorModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Doctor Name</label>
                                <input type="hidden" value="<?= $hospital_id; ?>" name="hospital_id">
                                <input type="text" name="txt_doc_name" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Name Arabic</label>
                                <input type="text" name="txt_doc_name_ar" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Speciality</label>
                                <select class="form-control" name="txt_doc_speciality" required>
                                    <option value="">Select Speciality</option>
                                    <?php 
                                    $spcSql = query("SELECT * FROM tbl_hostpital_specialty WHERE specialty_status = 1");
                                    while ($spc = fetch($spcSql))
                                    {
                                        ?>
                                        <option value="<?= $spc['specialty_id'];?>"><?= $spc['specialty_name'];?> - <?= $spc['specialty_ar_name'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Degree</label>
                                <input type="text" name="txt_doc_degree" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Degree Arabic</label>
                                <input type="text" name="txt_doc_degree_ar" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Designation</label>
                                <input type="text" name="txt_doc_designation" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Designation Arabic</label>
                                <input type="text" name="txt_doc_designation_ar" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Registration No</label>
                                <input type="text" name="txt_doc_regno" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Image</label>
                                <input type="file" name="doc_image" class="form-control"  onchange="checkFileSize('doc_image');" id="doc_image" required>
                                <label class="doc_image"></label>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>all-doctor" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_save_doc" class="btn btn-success" value="Save">
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