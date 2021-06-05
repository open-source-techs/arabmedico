<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$tid = $_GET['tid'];
if($tid == 0 || $tid == '' || $tid < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>list-department";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_testimonial where testimonial_id = '$tid'");
$testData = fetch($sql);
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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
            <h1>Testimonial</h1>
            <small>Add New Testimonial</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add Testimonial</li>
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
                            <div class="col-sm-12">
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                                <h3>English Form</h3>
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Title</label>
                                <input type="hidden" name="txt_test_id" value="<?= $testData['testimonial_id'];?>" >
                                <input type="text" name="txt_title" value="<?= $testData['testimonial_name'];?>" class="form-control" placeholder="Enter Title" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select User</label>
                                <select name="txt_user" class="form-control select2" required>
                                    <option>Select User</option>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_users WHERE user_status = 1");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <option <?= ($row['user_id'] == $testData['testimonial_user']) ? 'selected' : ''; ?> value="<?= $row['user_id'];?>"><?= $row['user_name'] . ' => ' . $row['user_email'] ;?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Short Description</label>
                                <textarea name="txt_short_desc" rows="3" class="form-control"><?= $testData['testimonial_desc'];?></textarea>
                            </div>
                            <div class="col-sm-12">
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                                <h3>Arabic Form</h3>
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                            </div>
                            
                            <div class="col-sm-6 form-group">
                                <label>Title</label>
                                <input type="text" name="txt_title_arabic" value="<?= $testData['testimonial_name_arabic'];?>" class="form-control" placeholder="Enter Title" required>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Short Description</label>
                                <textarea name="txt_short_desc_arabic" rows="3" class="form-control"><?= $testData['testimonial_desc_arabic'];?></textarea>
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