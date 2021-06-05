<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$doc_id = get_sess("userdata")['doc_id'];
if($doc_id == 0 || $doc_id == '' || $doc_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>list-doctors";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_doctor where doc_id = '$doc_id'");
$doc = fetch($sql);
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
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/doctorModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" name="txt_doc_id" value="<?= $doc['doc_id']; ?>">
                            <div class="col-sm-12 form-group">
                                <label>Detailed Resume</label>
                                <textarea name="txt_desc" rows="6" class="form-control" id="txt_desc" ><?= htmlspecialchars_decode(html_entity_decode($doc['doc_details'])); ?></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Detailed Resume (Arabic)</label>
                                <textarea name="txt_desc_arabic" rows="6" class="form-control" id="txt_desc" ><?= htmlspecialchars_decode(html_entity_decode($doc['doc_details_arabic'])); ?></textarea>
                            </div>
                            
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_myprofile" class="btn btn-success" value="Save">
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