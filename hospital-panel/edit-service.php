<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$hospital_id = get_sess("userdata")['hospital_id'];
$service = $_GET['service'];
if($service == 0 || $service == '' || $service < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>list-department";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_hospital_service WHERE dpt_service_id = ".$service);
$data = fetch($sql);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>Services Panel</h1>
            <small>Edit Service</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">Edit Services</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <!--<a class="btn btn-primary" href="<?= admin_base_url();?>all-certificates"> <i class="fa fa-list"></i> Services List </a>  -->
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/departmentModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Service title</label>
                                <input type="hidden" value="<?= $hospital_id; ?>" name="hospital_id">
                                <input type="hidden" value="<?= $service; ?>" name="dpt_service_id">
                                <input type="text" name="txt_cer_name" value="<?= $data['dpt_service_title'];?>" class="form-control" placeholder="Enter Service Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Service Title Arabic</label>
                                <input type="text" name="arabic_cer_title" value="<?= $data['dpt_service_title_arabic'];?>" class="form-control" placeholder="Serive Title Arabic" required>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Description</label>
                                <textarea name="txt_short_desc" rows="3" class="form-control" id="txt_desc"><?= $data['dpt_service_desc'];?></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Description Arabic</label>
                                <textarea name="txt_short_desc_arabic" rows="3" class="form-control" id="txt_desc_arabic"><?= $data['dpt_service_desc_arabic'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Service Image</label>
                                <input type="file" name="cer_profile" class="form-control"  onchange="checkFileSize('cer_profile');" id="txt_profile">
                                <label class="txt_profile"></label>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>service-panel" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit_service" class="btn btn-success" value="Save">
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