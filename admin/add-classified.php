<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php
$departsql = query("SELECT DISTINCT job_section FROM tbl_classified_job ORDER BY job_section ASC ");
$locationsql = query("SELECT DISTINCT job_location FROM tbl_classified_job ORDER BY job_location ASC ");

$depart_arab_sql = query("SELECT DISTINCT job_desc_ar FROM tbl_classified_job ORDER BY job_desc_ar ASC ");
$location_arab_sql = query("SELECT DISTINCT job_location_ar FROM tbl_classified_job ORDER BY job_location_ar ASC ");
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Classified</h1>
            <small>Add New</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add Classified</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>classified-list"> <i class="fa fa-list"></i> Classified List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/classifiedjobModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Classified Title</label>
                                <input type="text" name="txt_job_title" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Classified Title Arabic</label>
                                <input type="text" name="ar_job_title" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Classified Section</label>
                                <input type="text" name="txt_job_section" id="txt_job_section" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Classified Section Arabic</label>
                                <input type="text" name="txt_job_section_arabic" id="txt_job_section_arabic" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Classified Location</label>
                                <input type="text" name="txt_job_loc" id="txt_job_loc" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Classified Location Arabic</label>
                                <input type="text" id="ar_job_loc" name="ar_job_loc" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Posted by (Person/Agency)</label>
                                <input type="text" id="txt_posted_by" name="txt_posted_by" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Posted by in Arabic (Person/Agency)</label>
                                <input type="text" id="txt_postedby_ar" name="txt_postedby_ar" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Closing date</label>
                                <input type="date" name="txt_closing_time" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Classified Icon</label>
                                <input type="file" name="txt_job_icon" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Classified URL Slug (https:arabmedico.com/.......)</label>
                                <input type="text" id="txt_slug" name="txt_slug" class="form-control" required>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Classified Description</label>
                                <textarea name="txt_desc" rows="3" class="form-control" id="txt_desc"></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Classified Description Arabic</label>
                                <textarea name="ar_desc" rows="3" class="form-control" id="txt_short_desc"></textarea>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>classified-list" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_save_job" class="btn btn-success" value="Save">
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

    $(document).ready(function(){
        var depart = [
            <?php
            while($depart = fetch($departsql))
            {
                echo '"'.$depart['job_section'].'",';
            }
            ?>
        ];
        var location = [
            <?php
            while($location = fetch($locationsql))
            {
                echo '"'.$location['job_location'].'",';
            }
            ?>
        ];
        
        var depart_arab = [
            <?php
            while($depart_arab = fetch($depart_arab_sql))
            {
                echo '"'.$depart_arab['job_desc_ar'].'",';
            }
            ?>
        ];
        var location_arab = [
            <?php
            while($location_arab = fetch($location_arab_sql))
            {
                echo '"'.$location_arab['job_location_ar'].'",';
            }
            ?>
        ];
        
        $( "#txt_job_section" ).autocomplete({
            source: depart
        });
        $( "#txt_job_loc" ).autocomplete({
            source: location
        });
        
        $( "#ar_job_loc" ).autocomplete({
            source: depart_arab
        });
        $( "#txt_job_section_arabic" ).autocomplete({
            source: location_arab
        });
    });
    var area1, area2;
    
    function toggleArea1()
    {
        if(!area1)
        {
            area1 = new nicEditor({fullPanel : true}).panelInstance('txt_short_desc',{hasPanel : true});
        }
        else
        {
            area1.removeInstance('txt_short_desc');
            area1 = null;
        }
    }
    
    function toggleArea2()
    {
        if(!area2)
        {
            area2 = new nicEditor({fullPanel : true}).panelInstance('txt_desc',{hasPanel : true});
        }
        else
        {
            area2.removeInstance('txt_desc');
            area2 = null;
        }
    }
	bkLib.onDomLoaded(function() { toggleArea1(); toggleArea2(); });
</script>