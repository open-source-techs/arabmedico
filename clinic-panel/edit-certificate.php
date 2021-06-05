<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$clinic_id = get_sess("userdata")['clinic_id'];
$cer_id = $_GET['certificate_id'];
if($cer_id == 0 || $cer_id == '' || $cer_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>all-certificates";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_clinic_certificate where certificate_id = '$cer_id'");
// echo "SELECT * FROM tbl_certificate where certificate_id = '$cer_id'";
$cer = fetch($sql);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Certificate</h1>
            <small>Edit Certificate</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Edit Certificate</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>all-certificates"> <i class="fa fa-list"></i> Certificate List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/certificateModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Certificate Name</label>
                                <input type="hidden" value="<?= $clinic_id; ?>" name="txt_clinicID">
                                <input type="hidden" name="txt_cer_id" value="<?= $cer['certificate_id']; ?>">
                                <input type="text" name="txt_cer_name" certificate_title class="form-control" value="<?= $cer['certificate_title']; ?>" placeholder="Enter Certificate Title" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Icon</label>
                                <input type="file" name="txt_icon" onchange="checkFileSize('txt_icon');" id="txt_icon" class="form-control">
                                <label class="txt_icon"></label>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Arabic Certificate Title</label>
                                <input type="text" name="txt_cer_title_arabic" class="form-control" value="<?= $cer['certificate_title_arabic']; ?>"  placeholder="Arabic Certificate Title" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Certificate Active</label>
                                <select class="form-control" name="Active" id="active">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>all-certificates" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit_cer" class="btn btn-success" value="Save">
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
<?php
get_msg('msg');
?>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>