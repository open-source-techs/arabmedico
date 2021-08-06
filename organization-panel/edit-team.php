<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$org_id = get_sess("userdata")['organization_id'];
$doc_id = $_GET['doc_id'];
if($doc_id == 0 || $doc_id == '' || $doc_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>all-team";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_org_doc WHERE doc_id = ".$doc_id);
$data = fetch($sql);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>Team Panel</h1>
            <small>Edit Member</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">Edit Memebr</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>all-team"> <i class="fa fa-list"></i> Team List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/doctorModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" value="<?= $org_id; ?>" name="org_id">
                            <input type="hidden" value="<?= $doc_id; ?>" name="doctor_id">
                            <div class="col-sm-6 form-group">
                                <label>Name</label>
                                <input type="text" name="txt_doc_name" class="form-control" value="<?= $data['doc_name'];?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Name Arabic</label>
                                <input type="text" name="txt_doc_name_ar" class="form-control" value="<?= $data['doc_name_ar'];?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Degree</label>
                                <input type="text" name="txt_doc_degree" class="form-control" value="<?= $data['doc_degree'];?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Degree Arabic</label>
                                <input type="text" name="txt_doc_degree_ar" class="form-control" value="<?= $data['doc_degree_ar'];?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Designation</label>
                                <input type="text" name="txt_doc_designation" class="form-control" value="<?= $data['doc_designation'];?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Designation Arabic</label>
                                <input type="text" name="txt_doc_designation_ar" class="form-control" value="<?= $data['doc_designation_ar'];?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Registration No</label>
                                <input type="text" name="txt_doc_regno" class="form-control" value="<?= $data['doc_regNo'];?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Image</label>
                                <input type="file" name="doc_image" class="form-control"  onchange="checkFileSize('doc_image');" id="doc_image">
                                <label class="doc_image"></label>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>all-team" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit_doc" class="btn btn-success" value="Save">
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