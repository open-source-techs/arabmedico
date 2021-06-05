<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$page_id = $_GET['page_id'];
if($page_id == 0 || $page_id == '' || $page_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>all-page";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_pages where page_id = '$page_id'");
$page = fetch($sql);
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
            <h1>Pages</h1>
            <small>Edit Page</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Edit Page</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>all-page"> <i class="fa fa-list"></i> Pages List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/pageModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" name="txt_page_id" value="<?= $page['page_id'];?>">
                            <div class="col-sm-12">
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                                <h3>English Form</h3>
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Page Name</label>
                                <input type="text" name="txt_name" value="<?= $page['page_name'];?>" class="form-control" placeholder="Enter Page Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Title</label>
                                <input type="text" name="txt_title" value="<?= $page['page_title'];?>" class="form-control" placeholder="Enter Page Title" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Description</label>
                                <textarea name="txt_meta_desc" rows="6" class="form-control"><?= $page['page_meta_desc'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Tags</label>
                                <textarea name="txt_tags" rows="6" class="form-control"><?= $page['page_meta_tag'];?></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Page Data</label>
                                <textarea name="txt_data" rows="6" class="form-control"><?= $page['page_data'];?></textarea>
                            </div>
                            <div class="col-sm-12">
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                                <h3>Arabic Form</h3>
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Arabic Name</label>
                                <input type="text" name="txt_name_arabic" value="<?= $page['page_name_arabic'];?>" class="form-control" placeholder="Enter Page Name in Arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Title In Arabic</label>
                                <input type="text" name="txt_title_arabic" value="<?= $page['page_title_arabic'];?>" class="form-control" placeholder="Enter Title In Arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Description In Arabic</label>
                                <textarea name="txt_desc_arabic" rows="6" class="form-control"><?= $page['page_meta_desc_arabic'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Tags In Arabic</label>
                                <textarea name="txt_tags_arabic" rows="6" class="form-control"><?= $page['page_meta_tag_arabic'];?></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Page Data In Arabic</label>
                                <textarea name="txt_data_arabic" rows="6" class="form-control"><?= $page['page_data_arabic'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Banner</label>
                                <input type="file" name="txt_banner" onchange="checkFileSize('txt_banner');" id="txt_banner" class="form-control">
                                <label class="txt_banner"></label>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Page Position</label>
                                <select class="form-control" name="txt_position">
                                    <option <?= ($page['page_position'] == 1) ? "selected" : ""; ?> value="1">Header Menu</option>
                                    <option <?= ($page['page_position'] == 2) ? "selected" : ""; ?> value="2">Footer Menu 1</option>
                                    <option <?= ($page['page_position'] == 3) ? "selected" : ""; ?> value="3">Footer Menu 2</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Status</label>
                                <select class="form-control" name="txt_status">
                                    <option <?= ($page['page_active'] == 0) ? "selected" : ""; ?> value="0">Un active</option>
                                    <option <?= ($page['page_active'] == 1) ? "selected" : ""; ?> value="1">Active</option>
                                </select>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>all-page" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit_page" class="btn btn-success" value="Save">
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