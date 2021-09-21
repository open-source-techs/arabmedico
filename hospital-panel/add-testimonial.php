<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$hospital_id = get_sess("userdata")['hospital_id'];
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title"> 
            <h1>Testimonial</h1>
            <small>Add New Testimonial</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add Testimonial</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>all-testimonial"> <i class="fa fa-list"></i> Testimonials List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/testimonialModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" value="<?= $hospital_id; ?>" name="txt_hospitalID">
                            <div class="col-sm-6 form-group">
                                <label>Title</label>
                                <input type="text" name="txt_title" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Title in Arabic</label>
                                <input type="text" name="txt_title_ar" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Patient Name</label>
                                <input type="text" name="txt_username" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Patient Name in Arabic</label>
                                <input type="text" name="txt_username_ar" class="form-control" required>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Short Description</label>
                                <textarea name="txt_short_desc" rows="3" class="form-control" id="txt_short"></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Short Description</label>
                                <textarea name="txt_short_desc_arabic" rows="3" class="form-control" id="txt_short_arabic"></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Patient Image</label>
                                <input type="file" name="patient_img" class="form-control"  onchange="checkFileSize('patient_img');" id="patient_img" required>
                                <label class="patient_img"></label>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>all-testimonial" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_save_test" class="btn btn-success" value="Save">
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
    var area1, area2;
    
    function toggleArea1()
    {
        if(!area1)
        {
            area1 = new nicEditor({fullPanel : true}).panelInstance('txt_short',{hasPanel : true});
        }
        else
        {
            area1.removeInstance('txt_short');
            area1 = null;
        }
        if(!area2)
        {
            area2 = new nicEditor({fullPanel : true}).panelInstance('txt_short_arabic',{hasPanel : true});
        }
        else
        {
            area2.removeInstance('txt_short_arabic');
            area2 = null;
        }
    }
	bkLib.onDomLoaded(function() { toggleArea1(); });
</script>