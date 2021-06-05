<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$insurance = $_GET['insuran_id'];
if($insurance == 0 || $insurance == '' || $insurance < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>all-insurance";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_insurance where insurance_id = '$insurance'");
// echo "SELECT * FROM tbl_insurance where certificate_id = '$insurance_id'";
$insurance = fetch($sql);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
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
                            <div class="col-sm-6 form-group">
                                <label>Insurance Name</label>
                                <input type="hidden" name="txt_insurance_id" value="<?= $insurance['insurance_id']; ?>">
                                <input type="text" name="txt_insurance_name" class="form-control" value="<?= $insurance['insurance_title']; ?>" placeholder="Enter insurance Title" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Icon</label>
                                <input type="file" name="txt_icon" onchange="checkFileSize('txt_icon');" id="txt_icon" class="form-control">
                                <label class="txt_icon"></label>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Arabic Insurance Title</label>
                                <input type="text" name="txt_insurance_title_arabic" class="form-control" value="<?= $insurance['insurance_title_arabic']; ?>"  placeholder="Arabic insurance Title" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Insurance Active</label>
                                <select class="form-control" name="Active" id="active">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>all-insurance" class="btn btn-warning">Cancel & Go Back</a>
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