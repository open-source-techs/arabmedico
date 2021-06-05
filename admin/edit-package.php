<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$pkg_id = $_GET['pkg_id'];
if($pkg_id == 0 || $pkg_id == '' || $pkg_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>all-package";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_packages where pkg_id = '$pkg_id'");
$pkg = fetch($sql);
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
            <h1>Packages</h1>
            <small>Edit Package</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Edit Package</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>all-package"> <i class="fa fa-list"></i> Package List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/packageModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-12">
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                                <h3>English Form</h3>
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Package Name</label>
                                <input type="hidden" name="txt_pkg_id" value="<?= $pkg['pkg_id'];?>">
                                <input type="text" name="txt_title" class="form-control" value="<?= $pkg['pkg_name'];?>" placeholder="Enter Package Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Package Image</label>
                                <input type="file" name="txt_image" id="txt_image" onchange="checkFileSize('txt_image');" class="form-control">
                                <label class="txt_image"></label>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Short Description</label>
                                <textarea name="txt_short_desc" rows="3" class="form-control" id="txt_short_desc" placeholder="Enter short description for sections"><?= $pkg['pkg_description'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 1</label>
                                <input type="text" name="txt_hightlight_one" class="form-control" placeholder="Highlight light 1" required value="<?= $pkg['pkg_highlight_one'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 2</label>
                                <input type="text" value="<?= $pkg['pkg_highlight_two'];?>" name="txt_hightlight_two" class="form-control" placeholder="Highlight light 2" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 3</label>
                                <input type="text" name="txt_hightlight_three" value="<?= $pkg['pkg_highlight_three'];?>" class="form-control" placeholder="Highlight light 3" required>
                            </div>
                            <div class="col-sm-6 form-group">
                               <label>Highlight 4</label>
                                <input type="text" name="txt_hightlight_four" class="form-control" placeholder="Highlight light 4" required value="<?= $pkg['pkg_highlight_four'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 5</label>
                                <input type="text" name="txt_hightlight_five" class="form-control" placeholder="Highlight light 5" required value="<?= $pkg['pkg_highlight_five'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 6</label>
                                <input type="text" name="txt_hightlight_six" class="form-control" placeholder="Highlight light 6" required value="<?= $pkg['pkg_highlight_six'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 7</label>
                                <input type="text" name="txt_hightlight_seven" class="form-control" placeholder="Highlight light 7" required value="<?= $pkg['pkg_highlight_seven'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 8</label>
                                <input type="text" name="txt_hightlight_eight" class="form-control" placeholder="Highlight light 8" required value="<?= $pkg['pkg_highlight_eight'];?>">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Package Details</label>
                                <textarea name="txt_pkg_detail" rows="6" class="form-control" id="txt_detail"><?= $pkg['pkg_details'];?></textarea>
                            </div>
                            <div class="col-sm-12">
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                                <h3>Arabic Form</h3>
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Package Name</label>
                                <input type="text" name="txt_title_arabic" class="form-control" placeholder="Enter Package Name" required value="<?= $pkg['pkg_name_arabic'];?>">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Short Description</label>
                                <textarea name="txt_short_desc_arabic" rows="3" class="form-control" id="txt_short_desc" placeholder="Enter short description for sections"><?= $pkg['pkg_description_arabic'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 1</label>
                                <input type="text" name="txt_hightlight_one_arabic" class="form-control" placeholder="Highlight light 1" required value="<?= $pkg['pkg_highlight_one_arabic'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 2</label>
                                <input type="text" name="txt_hightlight_two_arabic" class="form-control" placeholder="Highlight light 2" required value="<?= $pkg['pkg_highlight_two_arabic'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 3</label>
                                <input type="text" name="txt_hightlight_three_arabic" class="form-control" placeholder="Highlight light 3" required value="<?= $pkg['pkg_highlight_three_arabic'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                               <label>Highlight 4</label>
                                <input type="text" name="txt_hightlight_four_arabic" class="form-control" placeholder="Highlight light 4" required value="<?= $pkg['pkg_highlight_four_arabic'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 5</label>
                                <input type="text" name="txt_hightlight_five_arabic" class="form-control" placeholder="Highlight light 5" required value="<?= $pkg['pkg_highlight_five_arabic'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 6</label>
                                <input type="text" name="txt_hightlight_six_arabic" class="form-control" placeholder="Highlight light 6" required value="<?= $pkg['pkg_highlight_six_arabic'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 7</label>
                                <input type="text" name="txt_hightlight_seven_arabic" class="form-control" placeholder="Highlight light 7" required value="<?= $pkg['pkg_highlight_seven_arabic'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 8</label>
                                <input type="text" name="txt_hightlight_eight_arabic" class="form-control" placeholder="Highlight light 8" required value="<?= $pkg['pkg_highlight_eight_arabic'];?>">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Package Details</label>
                                <textarea name="txt_pkg_detail_arabic" rows="6" class="form-control" id="txt_detail_arabic" ><?= $pkg['pkg_details_arabic'];?></textarea>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>all-package" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit_package" class="btn btn-success" value="Save">
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