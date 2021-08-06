<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Advertisement</h1>
            <small>Add New Advertisement</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add Advertisement</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>all-advertisement"> <i class="fa fa-list"></i> Advertisement List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/advertModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Select Location</label>
                                <select class="form-control" name="txt_displayLocation" required>
                                    <option disabled selected>Select Option</option>
                                    <option value="clinics">Clinics</option>
                                    <option value="CME Pages">CME Pages</option>
                                    <option value="Job Pages">Job Pages</option>
                                    <option value="New Pages">New Pages</option>
                                    <option value="organizations">Organizations</option>
                                    <option value="Landing Pages">Landing Pages</option>
                                    <option value="Department Pages">Department Pages</option>
                                    <option value="Patient Resource Pages">Patient Resource Pages</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Activation Date</label>
                                <input type="date" class="form-control"name="txt_activeDate" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select type</label>
                                <select class="form-control" name="txt_is_horizontal" required>
                                    <option disabled selected>Select Option</option>
                                    <option value="1">Horizontal</option>
                                    <option value="0">Vertical</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Enter Advertisement Link</label>
                                <input type="text" class="form-control"name="txt_link" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Advertisement Days</label>
                                <input type="number" class="form-control"name="txt_durationDays" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Advertisement Type</label>
                                <select class="form-control" name="txt_type" required id="txt_type">
                                    <option disabled selected>Select Option</option>
                                    <option value="poster">Poster</option>
                                    <option value="video">Video</option>
                                </select>
                            </div>
                            <div class="col-md-12" id="poster_div" style="display:none">
                                <div class="col-sm-6 form-group">
                                    <label>Upload Poster</label>
                                    <input type="file" class="form-control" name="txt_poster">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Upload Poster for Arabic Version</label>
                                    <input type="file" class="form-control" name="txt_poster_ar">
                                </div>
                            </div>
                            
                            <div class="col-md-12" id="video_div" style="display:none">
                                <div class="col-sm-6 form-group">
                                    <label>Select Video Type</label>
                                    <select class="form-control" name="txt_is_link" id="txt_is_link" required>
                                        <option disabled selected>Select Option</option>
                                        <option value="1">Links</option>
                                        <option value="0">Videos</option>
                                    </select>
                                </div>
                                <div class="col-md-12" id="link_div" style="display:none">
                                    <div class="col-sm-6 form-group">
                                        <label>Paste embeded code</label>
                                        <textarea name="txt_video_link" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Paste embeded code for Arabic Version</label>
                                        <textarea name="txt_video_link_ar" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12" id="upload_div" style="display:none">
                                    <div class="col-sm-6 form-group">
                                        <label>Upload Video</label>
                                        <input type="file" class="form-control"name="txt_video">
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Upload video for Arabic Version</label>
                                        <input type="file" class="form-control" name="txt_video_ar">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>all-advertisement" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_add_new" class="btn btn-success" value="Save">
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
<script type="text/javascript">
    
    $(document).ready(function(){
        $("#txt_type").change(function(){
            if($(this).val() == "poster")
            {
                $("#poster_div").show();
                $("#video_div").hide();
            }
            else if($(this).val() == "video")
            {
                $("#poster_div").hide();
                $("#video_div").show();
            }
        });
        $("#txt_is_link").change(function(){
            if($(this).val() == "1")
            {
                $("#link_div").show();
                $("#upload_div").hide();
            }
            else if($(this).val() == "0")
            {
                $("#link_div").hide();
                $("#upload_div").show();
            }
        });
    });
</script>