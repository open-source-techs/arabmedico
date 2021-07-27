<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$org_id = get_sess("userdata")['organization_id'];
$award_id = $_GET['award_id'];
if($award_id == 0 || $award_id == '' || $award_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>all-award";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_org_awards where award_id = '$award_id'");
$cer = fetch($sql);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Awards</h1>
            <small>Edit Awards</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Edit Awards</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>all-award"> <i class="fa fa-list"></i> Awards List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/awardModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Award Name</label>
                                <input type="hidden" value="<?= $org_id; ?>" name="txt_orgID">
                                <input type="hidden" name="txt_id" value="<?= $cer['award_id']; ?>">
                                <input type="text" name="txt_title" class="form-control" value="<?= $cer['award_title']; ?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Award Arabic Title</label>
                                <input type="text" name="txt_title_ar" class="form-control" value="<?= $cer['award_title_ar']; ?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Icon</label>
                                <input type="file" name="txt_image" onchange="checkFileSize('txt_image');" id="txt_image" class="form-control">
                                <label class="txt_image"></label>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Award Active</label>
                                <select class="form-control" name="txt_active" id="active">
                                <option value="1" <?= ($cer['award_active'] == 1 ) ? 'selected' : ''; ?> >Yes</option>
                                <option value="0" <?= ($cer['award_active'] == 0 ) ? 'selected' : ''; ?> >No</option>
                                </select>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>all-award" class="btn btn-warning">Cancel & Go Back</a>
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