<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$dpt_id = $_GET['dpt_id'];
if($dpt_id == 0 || $dpt_id == '' || $dpt_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>list-resource";
    </script>
    <?php
}
$service = $_GET['service'];
if($service == 0 || $service == '' || $service < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>list-resource";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_resource_service WHERE resource_service_id = ".$service);
$data = fetch($sql);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
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
            <h1>Services Panel</h1>
            <small>Services list</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li>
                    <a href="<?= admin_base_url();?>list-resource">
                		<i class="pe-7s-home"></i> Patient Resource
                	</a>
                </li>
                <li class="active">Add Services</li>
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
                        <form  action="<?= admin_base_url()?>model/resourceModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Service title</label>
                                <input type="hidden" value="<?= $dpt_id; ?>" name="dpt_id">
                                <input type="hidden" value="<?= $service; ?>" name="dpt_service_id">
                                <input type="text" name="txt_cer_name" value="<?= $data['resource_service_title'];?>" class="form-control" placeholder="Enter Service Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Service Title Arabic</label>
                                <input type="text" name="arabic_cer_title" value="<?= $data['resource_service_title_arabic'];?>" class="form-control" placeholder="Serive Title Arabic" required>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Description</label>
                                <textarea name="txt_short_desc" rows="3" class="form-control" id="txt_desc"><?= $data['resource_service_desc'];?></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Description Arabic</label>
                                <textarea name="txt_short_desc_arabic" rows="3" class="form-control" id="txt_desc_arabic"><?= $data['resource_service_desc_arabic'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Service Image</label>
                                <input type="file" name="cer_profile" class="form-control"  onchange="checkFileSize('cer_profile');" id="txt_profile">
                                <label class="txt_profile"></label>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>resource-service-panel?dpt_id=<?= $dpt_id; ?>" class="btn btn-warning">Cancel & Go Back</a>
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