<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$emp_id = get_sess("userdata")['emp_id'];
if($emp_id == 0 || $emp_id == '' || $emp_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>model/adminUser?act=logout";
    </script>
    <?php
}
?>
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
$sql = query("SELECT * FROM tbl_job where job_id = '$job_id'");
$job = fetch($sql);

$departsql = query("SELECT DISTINCT job_depart FROM tbl_job ORDER BY job_depart ASC ");
$locationsql = query("SELECT DISTINCT job_location FROM tbl_job ORDER BY job_location ASC ");
$depart_arab_sql = query("SELECT DISTINCT job_desc_ar FROM tbl_job ORDER BY job_desc_ar ASC ");
$location_arab_sql = query("SELECT DISTINCT job_location_ar FROM tbl_job ORDER BY job_location_ar ASC ");

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
            <form action="#" method="get" class="sidebar-form search-box pull-right hidden-md hidden-lg hidden-sm">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>  
            <h1>JOb</h1>
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
                            <a class="btn btn-primary" href="<?= admin_base_url();?>job-list"> <i class="fa fa-list"></i>Job List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/jobModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-12">
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                                <h3>English Form</h3>
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job Title</label>
                                <input type="hidden" name="txt_job_id" value="<?= $job['job_id'];?>">
                                <input type="text" name="txt_job_title" class="form-control" value="<?= $job['job_title']; ?>" placeholder="Enter Job title" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job Department</label>
                                <input type="text" name="txt_job_depart" id="txt_job_depart" class="form-control" value="<?= $job['job_depart']; ?>" placeholder="Enter Job Department" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job Location</label>
                                <input type="text" name="txt_job_loc" id="txt_job_loc" class="form-control" value="<?= $job['job_location'];?>" placeholder="Enter JOb Location" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Closing date</label>
                                <input type="date" name="txt_closing_time" class="form-control" value="<?= $job['job_close_date'];?>" placeholder="Enter Closing Date" required>
                            </div><div class="col-sm-6 form-group">
                                <label>Job Icon</label>
                                <input type="file" name="txt_job_icon" class="form-control">
                            </div>
                            <input type="hidden" value="<?= $emp_id; ?>" name="txt_employeer">
                            <div class="col-sm-12 form-group">
                                <label>Job Description</label>
                                <textarea name="txt_desc" rows="3" class="form-control" id="txt_short_desc"><?= $job['job_desc'];?></textarea>
                            </div>
                            <div class="col-sm-12">
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                                <h3>Arabic Form</h3>
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                            </div>
                           <div class="col-sm-6 form-group">
                                <label>Job Title Arabic</label>
                                <input type="text" name="ar_job_title" class="form-control" value="<?= $job['job_title_ar'];?>" placeholder="Enter Job title Arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job Department Arabic</label>
                                <input type="text" name="txt_job_depart_arabic" id="txt_job_depart_arabic" class="form-control" value="<?= $job['job_depart_ar'];?>" placeholder="Enter Job Speciality Arabic" required>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Job Description Arabic</label>
                                <textarea name="ar_desc" rows="3" class="form-control" id="txt_short_desc"><?= $job['job_desc_ar'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job Location Arabic</label>
                                <input type="text" name="ar_job_loc" id="ar_job_loc" class="form-control" value="<?= $job['job_location_ar'];?>" placeholder="Enter Job Loaction Arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Closing date Arabic</label>
                                <input type="date" name="ar_closing_time" class="form-control" value="<?= $job['job_close_date_ar'];?>" placeholder="Enter Closing Date Arabic" required>
                            </div>
                            <div class="col-sm-12 reset-button">
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
                echo '"'.$depart['job_depart'].'",';
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
        
        $( "#txt_job_depart" ).autocomplete({
            source: depart
        });
        $( "#txt_job_loc" ).autocomplete({
            source: location
        });
        
        $( "#ar_job_loc" ).autocomplete({
            source: depart_arab
        });
        $( "#txt_job_depart_arabic" ).autocomplete({
            source: location_arab
        });
    });
    
    
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
	$(document).ready(function(){
	    $(".select2").select2();
	});
</script>