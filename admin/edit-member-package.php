<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$pkg_id = $_GET['pkg_id'];
if($pkg_id == 0 || $pkg_id == '' || $pkg_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>member-packages";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_membership where membership_id = '$pkg_id'");
$pkg = fetch($sql);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Memberships</h1>
            <small>Edit Mebership Package</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Edit Mebership Package</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>member-packages"> <i class="fa fa-list"></i> Member Packages List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/membershipModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Package Name</label>
                                <input type="text" name="txt_name" value="<?= $pkg['membership_name'];?>" class="form-control" placeholder="Enter Name" required>
                                <input type="hidden" name="txt_id" value="<?= $pkg['membership_id'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Package Price</label>
                                <input type="text" name="txt_price" value="<?= $pkg['membership_price'];?>" class="form-control" placeholder="Enter Price" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Allow Branding</label>
                                <select class="form-control" name="txt_branding" required>
                                    <option disabled selected> Select an Option </option>
                                    <option <?= ($pkg['allow_branding'] == 1) ? 'selected' : '' ?> value="1">Yes</option>
                                    <option <?= ($pkg['allow_branding'] == 0) ? 'selected' : '' ?> value="0">No</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Super Consultant</label>
                                <select class="form-control" name="txt_consultant" required>
                                    <option disabled selected> Select an Option </option>
                                    <option <?= ($pkg['super_consultant'] == 1) ? 'selected' : '' ?> value="1">Yes</option>
                                    <option <?= ($pkg['super_consultant'] == 0) ? 'selected' : '' ?> value="0">No</option>
                                </select>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>member-packages" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit" class="btn btn-success" value="Save">
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