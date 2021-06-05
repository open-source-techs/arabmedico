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
$sql = query("SELECT * FROM tbl_clinic_offers where offer_id = '$pkg_id'");
$pkg = fetch($sql);
$clinic_id = get_sess("userdata")['clinic_id'];
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Special Offers</h1>
            <small>Edit Offer</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">Edit Offers</li>
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
                            <input type="hidden" name="txt_pkg_id" value="<?= $pkg['offer_id'];?>">
                            <input type="hidden" value="<?= $clinic_id; ?>" name="txt_clinicID">
                            <div class="col-sm-6 form-group">
                                <label>Offer Title</label>
                                <input type="text" name="txt_title" class="form-control" value="<?= $pkg['offer_name'] ;?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Offer Title Arabic</label>
                                <input type="text" name="txt_title_ar" class="form-control" value="<?= $pkg['offer_name_ar'];?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Offer Media</label>
                                <input type="file" onchange="checkFileSize('txt_image');" name="txt_image" id="txt_image" class="form-control">
                                <label class="txt_image"></label>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Offer Media Arabic</label>
                                <input type="file" onchange="checkFileSize('txt_image_ar');" name="txt_image_ar" id="txt_image_ar" class="form-control">
                                <label class="txt_image_ar"></label>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 1</label>
                                <input type="text" name="txt_hightlight_one" class="form-control" value="<?= $pkg['offer_hightlight1'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 1 in Arabic</label>
                                <input type="text" name="txt_hightlight_one_arabic" class="form-control" value="<?= $pkg['offer_highlight1_ar'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 2</label>
                                <input type="text" name="txt_hightlight_two" class="form-control" value="<?= $pkg['offer_hightlight2'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 2 in Arabic</label>
                                <input type="text" name="txt_hightlight_two_arabic" class="form-control" value="<?= $pkg['offer_hightlight2_ar'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 3</label>
                                <input type="text" name="txt_hightlight_three" class="form-control" value="<?= $pkg['offer_hightlight3'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 3 in Arabic</label>
                                <input type="text" name="txt_hightlight_three_arabic" class="form-control" value="<?= $pkg['offer_hightlight3_ar'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                               <label>Highlight 4</label>
                                <input type="text" name="txt_hightlight_four" class="form-control" value="<?= $pkg['offer_hightlight4'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                               <label>Highlight 4 in Arabic</label>
                                <input type="text" name="txt_hightlight_four_arabic" class="form-control" value="<?= $pkg['offer_hightlight4_ar'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 5</label>
                                <input type="text" name="txt_hightlight_five" class="form-control" value="<?= $pkg['offer_hightlight5'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 5 in Arabic</label>
                                <input type="text" name="txt_hightlight_five_arabic" class="form-control" value="<?= $pkg['offer_hightlight5_ar'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 6</label>
                                <input type="text" name="txt_hightlight_six" class="form-control" value="<?= $pkg['offer_hightlight6'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 6 in Arabic</label>
                                <input type="text" name="txt_hightlight_six_arabic" class="form-control" value="<?= $pkg['offer_hightlight6_ar'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 7</label>
                                <input type="text" name="txt_hightlight_seven" class="form-control" value="<?= $pkg['offer_hightlight7'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 7 in Arabic</label>
                                <input type="text" name="txt_hightlight_seven_arabic" class="form-control" value="<?= $pkg['offer_hightlight7_ar'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 8</label>
                                <input type="text" name="txt_hightlight_eight" class="form-control" value="<?= $pkg['offer_hightlight8'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 8 in Arabic</label>
                                <input type="text" name="txt_hightlight_eight_arabic" class="form-control" value="<?= $pkg['offer_hightlight8_ar'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 9</label>
                                <input type="text" name="txt_hightlight_nine" class="form-control" value="<?= $pkg['offer_hightlight9'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 9 in Arabic</label>
                                <input type="text" name="txt_hightlight_nine_arabic" class="form-control" value="<?= $pkg['offer_hightlight9_ar'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 10</label>
                                <input type="text" name="txt_hightlight_ten" class="form-control" value="<?= $pkg['offer_hightlight10'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Highlight 10 in Arabic</label>
                                <input type="text" name="txt_hightlight_ten_arabic" class="form-control" value="<?= $pkg['offer_hightlight10_ar'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Offer Price</label>
                                <input type="text" name="txt_price" class="form-control" required value="<?= $pkg['offer_price'];?>">
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