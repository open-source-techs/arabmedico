<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$doc_id = get_sess("userdata")['candidate_id'];
$tid = $_GET['tid'];
if($tid == 0 || $tid == '' || $tid < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>all-testimonial";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_can_testimonial where testimonial_candidate = '$tid'");
$testData = fetch($sql);
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Testimonial</h1>
            <small>Edit Testimonial</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Edit Testimonial</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>all-testimonial"> <i class="fa fa-list"></i> Testimonials List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/testimonialModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" value="<?= $doc_id; ?>" name="txt_clinicID">
                            <input type="hidden" value="<?= $tid; ?>" name="txt_test_id">
                            <div class="col-sm-6 form-group">
                                <label>Title</label>
                                <input type="text" name="txt_title" class="form-control" required value="<?= $testData['testimonial_title'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Title in Arabic</label>
                                <input type="text" name="txt_title_ar" class="form-control" required value="<?= $testData['testimonial_title_arabic'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Patient Name</label>
                                <input type="text" name="txt_username" class="form-control" required value="<?= $testData['testimonial_username'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Patient Name in Arabic</label>
                                <input type="text" name="txt_username_ar" class="form-control" required value="<?= $testData['testimonial_username_ar'];?>">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Short Description</label>
                                <textarea name="txt_short_desc" rows="3" class="form-control" id="txt_short"><?= $testData['testimonial_desc']; ?></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Short Description</label>
                                <textarea name="txt_short_desc_arabic" rows="3" class="form-control" id="txt_short_arabic"><?= $testData['testimonial_desc_arabic']; ?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Patient Image</label>
                                <input type="file" name="patient_img" class="form-control"  onchange="checkFileSize('patient_img');" id="patient_img">
                                <label class="patient_img"></label>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Status</label>
                                <select name="txt_user" class="form-control select2" required>
                                    <option>Select status</option>
                                    <option <?= ($testData['testimonial_active'] == 1) ? 'selected' : ''; ?> value="1">Active</option>
                                    <option <?= ($testData['testimonial_active'] == 0) ? 'selected' : ''; ?> value="0">Un Active</option>
                                </select>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>all-testimonial" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit_test" class="btn btn-success" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php require_once('layout/footer.php');?>
<script src="<?= admin_base_url();?>assets/plugins/niceedit/nicEdit.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<?php
get_msg('msg');
?>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
	$(document).ready(function(){
	    $(".select2").select2();
	});
</script>