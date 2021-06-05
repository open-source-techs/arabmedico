<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
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
            <h1>Certificate</h1>
            <small>Add New Certificate</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add Certificate</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>all-certificates"> <i class="fa fa-list"></i> Certificate List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/certificateModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Certificate title</label>
                                <input type="text" name="txt_cer_name" class="form-control" placeholder="Enter Certificate Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Certificate Title Arabic</label>
                                <input type="text" name="arabic_cer_title" class="form-control" placeholder="Certificate Title Arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Certificate Picture</label>
                                <input type="file" name="cer_profile" class="form-control"  onchange="checkFileSize('cer_profile');" id="txt_profile" required>
                                <label class="txt_profile"></label>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <!--<a href="<?= admin_base_url();?>all-certificates.php" class="btn btn-warning">Cancel & Go Back</a>-->
                                <input type="submit" name="btn_save_cer" class="btn btn-success" value="Save">
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