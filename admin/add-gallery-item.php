<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<style>
    .reset-button{
        margin-top:15px;
    }
</style>
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
            <h1>Gallery</h1>
            <small>Add New Gallery Item</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add gallery</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>all-news"> <i class="fa fa-list"></i> Gallery List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/galleryModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Select Category</label>
                                <select name="txt_depart" class="form-control select2" required>
                                    <option>Select Category</option>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_department WHERE dpt_active = 1");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <option value="<?= $row['dpt_id'];?>"><?= $row['dpt_name'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Is it a video?</label>
                                <select name="txt_is_video" id="is_video" class="form-control" required>
                                    <option selected disabled>Selet YES/NO</option>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <div class="video_div">
                                <div class="col-md-6">
                                    <label>Is it a link?</label>
                                    <select name="txt_is_link" id="is_link" class="form-control">
                                        <option selected disabled>Selet YES/NO</option>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="link_div">
                                    <div class="col-md-6 ">
                                        <label>Enter Embbed code here (<b class="text-danger">Please remove styles from IFRAME</b>)</label>
                                        <textarea name="txt_embed_code" id="txt_embed_code" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="input_vid">
                                    <div class="col-md-6 ">
                                        <label>Upload video</label>
                                        <input type="file" name="txt_video" id="txt_video" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="image_div">
                                <div class="col-sm-6 form-group">
                                    <label>Upload Image</label>
                                    <input type="file" name="txt_image" onchange="checkFileSize('txt_image');" id="txt_image" class="form-control">
                                    <label class="txt_image"></label>
                                </div>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>list-gallery" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_save_gallery" class="btn btn-success" value="Save">
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