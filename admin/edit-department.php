<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$dpt_id = $_GET['dpt_id'];
if($dpt_id == 0 || $dpt_id == '' || $dpt_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>list-department";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_department where dpt_id = '$dpt_id'");
$dpt = fetch($sql);
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
            <h1>Departments</h1>
            <small>Edit Department</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Edit Department</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>list-department"> <i class="fa fa-list"></i> Department List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/departmentModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Department Name</label>
                                <input type="hidden" name="txt_dpt_id" value="<?= $dpt['dpt_id'];?>">
                                <input type="text" name="txt_dpt_name" value="<?= $dpt['dpt_name'];?>" class="form-control" placeholder="Enter First Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Department Name in Arabic</label>
                                <input type="text" name="txt_dpt_name_arabic" value="<?= $dpt['dpt_name_arabic'];?>" class="form-control" placeholder="Enter Department Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Department URL (https://arabmedico.com/....)</label>
                                <input type="hidden" value="<?= $dpt['dpt_slug'];?>" name="previous_slug">
                                <input type="text" name="txt_dpt_url" class="form-control" value="<?= $dpt['dpt_slug'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Icon</label>
                                <input type="file" name="txt_icon" class="form-control onChangeImg">
                                <label class="txt_icon"></label>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Short Description</label>
                                <textarea name="txt_short_desc" rows="3" class="form-control editor"><?= $dpt['dpt_short_desc'];?></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Short Description in Arabic</label>
                                <textarea name="txt_short_desc_arabic" rows="3" class="form-control"><?= $dpt['dpt_short_desc_arabic'];?></textarea>
                            </div>
                            <div class="col-sm-12 form-group" style="display:none">
                                <label>Detail Description</label>
                                <textarea name="txt_desc" rows="6" class="form-control editor1"><?= $dpt['dpt_description'];?></textarea>
                            </div>
                            <div class="col-sm-12 form-group" style="display:none">
                                <label>Detail Description in Arbaic</label>
                                <textarea name="txt_desc_arabic" rows="6" class="form-control"><?= $dpt['dpt_description_arabic'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Status</label>
                                <select class="form-control" name="txt_status" required>
                                    <option selected disabled>Department Staus</option>
                                    <option value="1" <?= ($dpt['dpt_active'] == 1) ? 'selected' : '';?>>Active</option>
                                    <option value="0" <?= ($dpt['dpt_active'] == 0) ? 'selected' : '';?>>Un Active</option>
                                </select>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>list-department" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit_dpt" class="btn btn-success" value="Save">
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