<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$chn_id = $_GET['chn_id'];
if($chn_id == 0 || $chn_id == '' || $chn_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>all-channel";
    </script>
    <?php
}
?>
<style>
    .reset-button{
        margin-top:15px;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>Video Panel</h1>
            <small>Video list</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li>
                    <a href="<?= admin_base_url();?>all-channel">
                		<i class="pe-7s-home"></i> Channels
                	</a>
                </li>
                <li class="active">Add Video</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>dpt-video-panel?dpt_id=<?= $chn_id; ?>"> <i class="fa fa-list"></i> View List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/channelModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" name="txt_channel" value="<?= $chn_id; ?>">
                            <div class="col-md-6 ">
                                <label>Video title</label>
                                <input type="text" name="txt_video_title" id="txt_video_title" class="form-control"/>
                            </div>
                            <div class="col-md-6 ">
                                <label>Video title Arabic</label>
                                <input type="text" name="txt_video_title_ar" id="txt_video_title_ar" class="form-control"/>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Do you want to upload link?</label>
                                <select class="form-control" name="txt_is_link" id="txt_is_link">
                                    <option disabled selected>Select an option</option>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <div class="col-md-12" id="video-div" style="display:none;">
                                <div class="col-sm-6 form-group">
                                    <label>Upload Image</label>
                                    <input type="file" name="txt_image" onchange="checkFileSize('txt_image');" id="txt_image" class="form-control">
                                    <label class="txt_image"></label>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Upload Image for Arabic</label>
                                    <input type="file" name="txt_image_ar" onchange="checkFileSize('txt_image_ar');" id="txt_image_ar" class="form-control">
                                    <label class="txt_image_ar"></label>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Upload video</label>
                                    <input type="file" name="txt_video" id="txt_video" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Upload video for Arabic</label>
                                    <input type="file" name="txt_video_ar" id="txt_video_ar" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12" id="link-div" style="display:none;">
                                <div class="col-md-6 form-group">
                                    <label>Video Link</label>
                                    <textarea class="form-control" name="txt_video_link" rows="3"></textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Video Link for Arabic</label>
                                    <textarea class="form-control" name="txt_video_link_ar" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>chn-video-panel?dpt_id=<?= $chn_id; ?>" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_save_chn_video" class="btn btn-success" value="Save">
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	    $(".select2").select2();
	    $("#txt_is_link").change(function(){
	        if($(this).val() == 0)
	        {
	            $("#video-div").show();
	            $("#link-div").hide();
	            
	        }
	        else
	        {
	            $("#link-div").show();
	            $("#video-div").hide();
	            
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