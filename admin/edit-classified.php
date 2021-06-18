<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$job_id = $_GET['job_id'];
if($job_id == 0 || $job_id == '' || $job_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>job-list";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_classified_job where job_id = '$job_id'");
$job = fetch($sql);

$departsql = query("SELECT DISTINCT job_section FROM tbl_classified_job ORDER BY job_section ASC ");
$locationsql = query("SELECT DISTINCT job_location FROM tbl_classified_job ORDER BY job_location ASC ");
$depart_arab_sql = query("SELECT DISTINCT job_section_ar FROM tbl_classified_job ORDER BY job_section_ar ASC ");
$location_arab_sql = query("SELECT DISTINCT job_location_ar FROM tbl_classified_job ORDER BY job_location_ar ASC ");

?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Classified Job</h1>
            <small>Edit Job</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Edit Job</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>classified-job-list"> <i class="fa fa-list"></i> Job List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/classifiedjobModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Job Title</label>
                                <input type="hidden" name="txt_job_id" value="<?= $job['job_id'];?>">
                                <input type="text" name="txt_job_title" class="form-control" value="<?= $job['job_title']; ?>" placeholder="Enter Job title" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job Title Arabic</label>
                                <input type="text" name="ar_job_title" class="form-control" value="<?= $job['job_title_ar'];?>" placeholder="Enter Job title Arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job Section</label>
                                <input type="text" name="txt_job_section" id="txt_job_section" class="form-control" value="<?= $job['job_section']; ?>" placeholder="Enter Job Department" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job Section Arabic</label>
                                <input type="text" name="txt_job_section_arabic" id="txt_job_section_arabic" class="form-control" value="<?= $job['job_section_ar'];?>" placeholder="Enter Job Speciality Arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job Location</label>
                                <input type="text" name="txt_job_loc" id="txt_job_loc" class="form-control" value="<?= $job['job_location'];?>" placeholder="Enter JOb Location" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job Location Arabic</label>
                                <input type="text" name="ar_job_loc" id="ar_job_loc" class="form-control" value="<?= $job['job_location_ar'];?>" placeholder="Enter Job Loaction Arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Posted by (Person/Agency)</label>
                                <input type="text" id="txt_posted_by" name="txt_posted_by" value="<?= $job['job_posted_by'] ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Posted by in Arabic (Person/Agency)</label>
                                <input type="text" id="txt_postedby_ar" name="txt_postedby_ar" value="<?= $job['job_posted_by_ar'] ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Closing date</label>
                                <input type="date" name="txt_closing_time" class="form-control" value="<?= $job['job_close_date'];?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job Icon</label>
                                <input type="file" name="txt_job_icon" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job URL Slug (https:arabmedico.com/.......)</label>
                                <input type="text" id="txt_slug" name="txt_slug" class="form-control" value="<?= $job['job_slug'] ?>" required>
                                <input type="hidden" name="previous_slug" value="<?= $dpt['job_slug'];?>">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Job Description</label>
                                <textarea name="txt_desc" rows="3" class="form-control" id="txt_desc"><?= $job['job_desc'];?></textarea>
                            </div><div class="col-sm-12 form-group">
                                <label>Job Description Arabic</label>
                                <textarea name="ar_desc" rows="3" class="form-control" id="txt_short_desc"><?= $job['job_desc_ar'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Title</label>
                                <input type="text" name="txt_meta_title" value="<?= $job['job_meta_title'];?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Title for arabic</label>
                                <input type="text" name="txt_meta_title_ar" value="<?= $job['job_meta_title_ar'];?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Tags</label>
                                <textarea name="txt_tag" rows="3" class="form-control"><?= $job['job_meta_tag'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Tags for Arabic</label>
                                <textarea name="txt_tag_ar" rows="3" class="form-control"><?= $job['job_meta_tag_ar'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Description</label>
                                <textarea name="txt_meta_desc" rows="3" class="form-control"><?= $job['job_meta_desc'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Description for Arabic</label>
                                <textarea name="txt_meta_desc_ar" rows="3" class="form-control"><?= $job['job_meta_desc_ar'];?></textarea>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>classified-list" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit_job" class="btn btn-success" value="Save">
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
                echo '"'.$depart_arab['job_section_ar'].'",';
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
	$(document).ready(function(){
	    $(".select2").select2();
	});
</script>