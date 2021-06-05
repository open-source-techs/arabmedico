<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$sli_id = $_GET['sl_id'];
if($sli_id == 0 || $sli_id == '' || $sli_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>list-department";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_slider where slider_id = '$sli_id'");
$dpt = fetch($sql);
?>
<style>
    .reset-button{
        margin-top:15px;
    }
</style>
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
            <h1>Slider</h1>
            <small>Edit Slide</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Edit Slide</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>slider"> <i class="fa fa-list"></i> Slides List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/sliderModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" name="txt_id" value="<?= $dpt['slider_id'];?>">
                            <div class="col-sm-6 form-group">
                                <label>Is it a video?</label>
                                <select name="txt_is_video" id="is_video" class="form-control" required>
                                    <option <?= ($dpt['slider_is_video'] == 0) ? 'selected' : "";?> value="0">No</option>
                                    <option <?= ($dpt['slider_is_video'] == 1) ? 'selected' : "";?> value="1">Yes</option>
                                </select>
                            </div>
                            <div class="video_div" <?= ($dpt['slider_is_video'] == 0) ? 'style="display:none;"': '';?>>
                                <div class="col-md-6">
                                    <label>Is it a link?</label>
                                    <select name="txt_is_link" id="is_link" class="form-control">
                                        <option <?= ($dpt['slider_is_link'] == 0) ? 'selected' : "";?> value="0">No</option>
                                        <option <?= ($dpt['slider_is_link'] == 1) ? 'selected' : "";?> value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="link_div col-md-12" <?= ($dpt['slider_is_link'] == 0) ? 'style="display:none;"': '';?>>
                                    <div class="col-md-6 ">
                                        <label>Enter Embbed code here (<b class="text-danger">Please remove styles from IFRAME</b>)</label>
                                        <textarea name="txt_embed_code" id="txt_embed_code"  class="form-control"><?= $dpt['slide_video'];?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Enter Embbed code for Arabic video here (<b class="text-danger">Please remove styles from IFRAME</b>)</label>
                                        <textarea name="txt_embed_code_ar" id="txt_embed_code_ar" class="form-control"><?= $dpt['slide_video_ar'];?></textarea>
                                    </div>
                                </div>
                                <div class="input_vid col-md-12" <?= ($dpt['slider_is_link'] == 1) ? 'style="display:none;"': '';?>>
                                    <div class="col-md-6 ">
                                        <label>Upload video</label>
                                        <input type="file" name="txt_video" id="txt_video" class="form-control">
                                    </div>
                                    <div class="col-md-6 ">
                                        <label>Upload video in Arabic</label>
                                        <input type="file" name="txt_video_ar" id="txt_video_ar" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="image_div" <?= ($dpt['slider_is_video'] == 1) ? 'style="display:none;"': '';?> >
                                <div class="col-sm-12">
                                    <hr style="width: 100%;height: 1px;margin: 5px auto;">
                                    <h3>English Form</h3>
                                    <hr style="width: 100%;height: 1px;margin: 5px auto;">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Slide Title</label>
                                    <input type="text" name="txt_title" value="<?= $dpt['slider_text'];?>" class="form-control" placeholder="Enter Slider Text">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Slider Image</label>
                                    <input type="file" name="txt_image" id="txt_image" onchange="checkFileSize('txt_image');" class="form-control">
                                    <label class="txt_image"></label>
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label>Short Description</label>
                                    <textarea name="txt_short_desc" rows="3" class="form-control" id="txt_short_desc" placeholder="Enter short description for sections"><?= $dpt['slider_desc'];?></textarea>
                                </div>
                                <div class="col-sm-12">
                                    <hr style="width: 100%;height: 1px;margin: 5px auto;">
                                    <h3>Arabic Form</h3>
                                    <hr style="width: 100%;height: 1px;margin: 5px auto;">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Slide Title</label>
                                    <input type="text" value="<?= $dpt['slider_text_arabic'];?>" name="txt_title_arabic" class="form-control" placeholder="Enter Slider Text">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Slider Image for arabic</label>
                                    <input type="file" name="txt_image_ar" id="txt_image_ar" onchange="checkFileSize('txt_image_ar');" class="form-control">
                                    <label class="txt_image"></label>
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label>Short Description</label>
                                    <textarea name="txt_short_desc_arabic" rows="3" id="txt_short_desc_arabic" class="form-control"><?= $dpt['slider_desc_arabic'];?></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>slider" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit_slide" class="btn btn-success" value="Save">
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
    $(document).ready(function(){
	    var slider_simple, slider_arabic;
	    $("#is_video").change(function(){
	        if($(this).val() == 0)
	        {
	            $(".video_div").hide();
	            $("#txt_embed_code").val('');
	            $("#txt_video").val('');
	            $(".image_div").show();
	            slider_simple = new nicEditor({fullPanel : true}).panelInstance('txt_short_desc');
	            slider_arabic = new nicEditor({fullPanel : true}).panelInstance('txt_short_desc_arabic');
	        }
	        else
	        {
	            $("#txt_video").val('');
	            $(".image_div").hide();
	            $(".video_div").show();
	            slider_simple.removeInstance('txt_short_desc');
	            slider_arabic.removeInstance('txt_short_desc_arabic');
	        }
	    });
	    $("#is_link").change(function(){
	        if($(this).val() == 0)
	        {
	            $("#txt_embed_code").val('');
	            $(".link_div").hide();
	            $(".input_vid").show();
	            
	        }
	        else
	        {
	            $("#txt_video").val('');
	            $(".input_vid").hide();
                $(".link_div").show();
	        }
	    });
	});
</script>