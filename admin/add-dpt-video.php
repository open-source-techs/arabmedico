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
            <form action="#" method="get" class="sidebar-form search-box pull-right hidden-md hidden-lg hidden-sm">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>   
            <h1>Video/Image Panel</h1>
            <small>Video/Image list</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li>
                    <a href="<?= admin_base_url();?>list-department">
                		<i class="pe-7s-home"></i> Departments
                	</a>
                </li>
                <li class="active">Add Video/Image</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>dpt-video-panel?dpt_id=<?= $dpt_id; ?>"> <i class="fa fa-list"></i> View List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/departmentModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" name="txt_depart" value="<?= $dpt_id; ?>">
                            <div class="col-sm-6 form-group">
                                <label>Is it a video?</label>
                                <select name="txt_is_video" id="is_video" class="form-control" required>
                                    <option selected disabled>Select YES/NO</option>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <div class="video_div">
                                <div class="col-md-6">
                                    <label>Is it a link?</label>
                                    <select name="txt_is_link" id="is_link" class="form-control">
                                        <option selected disabled>Select YES/NO</option>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="link_div col-md-12">
                                    <div class="col-md-6 ">
                                        <label>Enter Embbed code here (<b class="text-danger">Please remove styles from IFRAME</b>)</label>
                                        <textarea name="txt_embed_code" id="txt_embed_code" class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-6 ">
                                        <label>Enter Embbed code for arabic here (<b class="text-danger">Please remove styles from IFRAME</b>)</label>
                                        <textarea name="txt_embed_code_ar" id="txt_embed_code_ar" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="input_vid col-md-12">
                                    <div class="col-md-6 ">
                                        <label>Upload video</label>
                                        <input type="file" name="txt_video" id="txt_video" class="form-control">
                                    </div>
                                    <div class="col-md-6 ">
                                        <label>Upload video for Arabic</label>
                                        <input type="file" name="txt_video_ar" id="txt_video_ar" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="image_div col-md-12">
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
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>dpt-video-panel?dpt_id=<?= $dpt_id; ?>" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_save_dpt_video" class="btn btn-success" value="Save">
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
	    $(".video_div").hide();
	    $(".image_div").hide();
	    $(".input_vid").hide();
	    $(".link_div").hide();
	    $("#is_video").change(function(){
	        if($(this).val() == 0)
	        {
	            $(".video_div").hide();
	            $("#txt_embed_code").val('');
	            $("#txt_video").val('');
	            $(".image_div").show();
	            
	        }
	        else
	        {
	            $("#txt_image").val('');
	            $(".image_div").hide();
	            $(".video_div").show();
	            
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