<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$doc_id = $_GET['doc_id'];
if($doc_id == 0 || $doc_id == '' || $doc_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>list-doctors";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_doctor where doc_id = '$doc_id'");
$doc = fetch($sql);
?>
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
            <h1>Doctor</h1>
            <small>Edit Doctor</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Edit Doctor</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>list-doctors"> <i class="fa fa-list"></i> Doctor List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/doctorModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-12">
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                                <h3>English Form</h3>
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Name</label>
                                <input type="hidden" name="txt_doc_id" value="<?= $doc['doc_id']; ?>">
                                <input type="text" name="txt_doc_name" value="<?= $doc['doc_name'];?>" class="form-control" placeholder="Enter Doctor Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Degree</label>
                                <input type="text" name="txt_doc_degree" value="<?= $doc['doc_degree']; ?>" class="form-control" placeholder="Enter Doctor Degree" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job Title</label>
                                <input type="text" name="txt_job_title" value="<?= $doc['doc_job_title']; ?>" class="form-control" placeholder="Enter Job title" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Speciality</label>
                                <input type="text" name="txt_doc_speciality" value="<?= $doc['doc_speciality']; ?>" class="form-control" placeholder="Enter Doctor Speciality" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Registration No</label>
                                <input type="text" name="txt_doc_reg_no" value="<?= $doc['doc_reg_no']; ?>" class="form-control" placeholder="Enter Registration No" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Experties Area</label>
                                <input type="text" name="txt_doc_experty" value="<?= $doc['doc_area_of_experty']; ?>" class="form-control" placeholder="Enter experties and use comma (,) to seperate them" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Exiting Profile Image</label>
                                <div class="col-sm-12">
                                    <img src="<?= file_url().$doc['doc_image'];?>" style="height: 50px; width: 100px;">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Exiting Banner</label>
                                <div class="col-sm-12">
                                    <img src="<?= file_url().$doc['doc_banner'];?>" style="height: 50px; width: 100px;">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Profile Picture</label>
                                <input type="file" name="txt_profile" class="form-control" onchange="checkFileSize('txt_profile');" id="txt_profile">
                                <label class="txt_profile"></label>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Profile Banner</label>
                                <input type="file" name="txt_banner" class="form-control" onchange="checkFileSize('txt_banner');" id="txt_banner">
                                <label class="txt_banner"></label>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Language No 1</label>
                                <input type="text" name="txt_doc_lang1" value="<?= $doc['doc_lang1']; ?>" class="form-control" placeholder="Enter Language No 1">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Language No 1 In Arabic</label>
                                <input type="text" name="txt_doc_lang1_arabic" value="<?= $doc['doc_lang1_arabic']; ?>" class="form-control" placeholder="Enter Language No 1 In Arabic">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Language No 2</label>
                                <input type="text" name="txt_doc_lang2" value="<?= $doc['doc_lang2']; ?>" class="form-control" placeholder="Enter Language No 2">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Language No 2 In Arabic</label>
                                <input type="text" name="txt_doc_lang2_arabic" value="<?= $doc['doc_lang2_arabic']; ?>" class="form-control" placeholder="Enter Language No 2 In Arabic">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Language No 3</label>
                                <input type="text" name="txt_doc_lang3" value="<?= $doc['doc_lang3']; ?>" class="form-control" placeholder="Enter Language No 3">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Language No 3 In Arabic</label>
                                <input type="text" name="txt_doc_lang3_arabic" value="<?= $doc['doc_lang3_arabic']; ?>" class="form-control" placeholder="Enter Language No 3 In Arabic">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Language No 4</label>
                                <input type="text" name="txt_doc_lang4" value="<?= $doc['doc_lang4']; ?>" class="form-control" placeholder="Enter Language No 4">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Language No 4 In Arabic</label>
                                <input type="text" name="txt_doc_lang4_arabic" value="<?= $doc['doc_lang4_arabic']; ?>" class="form-control" placeholder="Enter Language No 4 In Arabic">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Language No 5</label>
                                <input type="text" name="txt_doc_lang5" value="<?= $doc['doc_lang5']; ?>" class="form-control" placeholder="Enter Language No 5">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Language No 5 In Arabic</label>
                                <input type="text" name="txt_doc_lang5_arabic" value="<?= $doc['doc_lang5_arabic']; ?>" class="form-control" placeholder="Enter Language No 5 In Arabic">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Department</label>
                                <select name="txt_depart" class="form-control select2" required>
                                    <option>Select Department</option>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_department WHERE dpt_active = 1");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <option <?= ($row['dpt_id'] == $doc['doctor_department']) ? 'selected' : ''; ?> value="<?= $row['dpt_id'];?>"><?= $row['dpt_name'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group" style="display:flex;margin-top: 25px;">
                                <?php if($doc['doc_status_head']== 1) {?>
                                 <input type="checkbox" checked id="checkDocHead" style="width: 40px;height: 20px;" name="check_doc_head" class="form-control">
                                <?php } else {?>
                                <input type="checkbox" id="checkDocHead" style="width: 40px;height: 20px;" name="check_doc_head" class="form-control">
                                <?php }?>
                                <label for="checkDocHead" style="margin-top:5px">Check if Doctor is Head of Department</label>
                                
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Doctor Introduction</label>
                                <textarea name="txt_short_desc" rows="3" class="form-control" id="txt_short_desc"><?= $doc['doc_intro']; ?></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Detailed Resume</label>
                                <textarea name="txt_desc" rows="6" class="form-control" id="txt_desc" ><?= $doc['doc_details']; ?></textarea>
                            </div>
                            
                            <div class="col-sm-6 form-group">
                                <label>Working Day Start English</label>
                                <select name="txt_working_day" class="form-control" required>
                                    <option value="" selected disabled>Select Day</option>
                                    <option <?= ($doc['start_working_days'] == "Monday") ? 'selected' : ''; ?> value="Monday">Monday</option>
                                    <option <?= ($doc['start_working_days'] == "Tuesday") ? 'selected' : ''; ?> value="Tuesday">Tuesday</option>
                                    <option <?= ($doc['start_working_days'] == "Wednesday") ? 'selected' : ''; ?> value="Wednesday">Wednesday</option>
                                    <option <?= ($doc['start_working_days'] == "Thursday") ? 'selected' : ''; ?> value="Thursday">Thursday</option>
                                    <option <?= ($doc['start_working_days'] == "Friday") ? 'selected' : ''; ?> value="Friday">Friday</option>
                                    <option <?= ($doc['start_working_days'] == "Saturday") ? 'selected' : ''; ?> value="Saturday">Saturday</option>
                                    <option <?= ($doc['start_working_days'] == "Sunday") ? 'selected' : ''; ?> value="Sunday">Sunday</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Working Day End English</label>
                                <select name="txt_end_day" class="form-control" required>
                                    <option value="" selected disabled>Select Day</option>
                                    <option <?= ($doc['end_working_days'] == "Monday") ? "selected" : '' ?> value="Monday">Monday</option>
                                    <option <?= ($doc['end_working_days'] == "Tuesday") ? "selected" : '' ?> value="Tuesday">Tuesday</option>
                                    <option <?= ($doc['end_working_days'] == "Wednesday") ? "selected" : '' ?> value="Wednesday">Wednesday</option>
                                    <option <?= ($doc['end_working_days'] == "Thursday") ? "selected" : '' ?> value="Thursday">Thursday</option>
                                    <option <?= ($doc['end_working_days'] == "Friday") ? "selected" : '' ?> value="Friday">Friday</option>
                                    <option <?= ($doc['end_working_days'] == "Saturday") ? "selected" : '' ?> value="Saturday">Saturday</option>
                                    <option <?= ($doc['end_working_days'] == "Sunday") ? "selected" : '' ?> value="Sunday">Sunday</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Working Day Start time English</label>
                                <input type="text" name="txt_working_time" value="<?= $doc['start_working_time']; ?>" class="form-control" placeholder="Enter start working time in English" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Working Day End Time English</label>
                                <input type="text" name="txt_end_time" value="<?= $doc['end_working_time']; ?>" class="form-control" placeholder="Enter end working time in English" required>
                            </div>
                            <div class="col-sm-12">
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                                <h3>Arabic Form</h3>
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Name</label>
                                <input type="text" name="txt_doc_name_arabic" value="<?= $doc['doc_name_arabic']; ?>" class="form-control" placeholder="Enter Doctor Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Degree</label>
                                <input type="text" name="txt_doc_degree_arabic" value="<?= $doc['doc_degree_arabic']; ?>" class="form-control" placeholder="Enter Doctor Degree" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job Title</label>
                                <input type="text" name="txt_job_title_arabic" value="<?= $doc['doc_job_title_arabic']; ?>" class="form-control" placeholder="Enter Job title" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Speciality</label>
                                <input type="text" name="txt_doc_speciality_arabic" value="<?= $doc['doc_speciality_arabic']; ?>" class="form-control" placeholder="Enter Doctor Speciality" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Experties Area</label>
                                <input type="text" name="txt_doc_experty_arabic" value="<?= $doc['doc_area_of_experty_arabic']; ?>" class="form-control" placeholder="Enter experties and use comma (,) to seperate them" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Registration No</label>
                                <input type="text" name="txt_doc_reg_no_arabic" value="<?= $doc['doc_reg_no_arabic']; ?>" class="form-control" placeholder="Enter Registration No in Arabic" required>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Doctor Introduction</label>
                                <textarea name="txt_short_desc_arabic" rows="3" class="form-control" id="txt_short_desc"><?= $doc['doc_intro_arabic']; ?></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Detailed Resume</label>
                                <textarea name="txt_desc_arabic" rows="6" class="form-control" id="txt_desc" ><?= $doc['doc_details_arabic']; ?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Working Day Start Arabic</label>
                                <select name="txt_working_day_arabic" class="form-control" required>
                                    <option value="" selected disabled>Select Day</option>
                                    <option <?= ($doc['start_working_days_arabic'] == "يَوم الإثنين")  ? 'selected' : '';?> value="يَوم الإثنين">يَوم الإثنين</option>
                                    <option <?= ($doc['start_working_days_arabic'] == "يَوم الثلاثاء") ? 'selected' : ''; ?> value="يَوم الثلاثاء">يَوم الثلاثاء</option>
                                    <option <?= ($doc['start_working_days_arabic'] == "يَوم الأربعاء") ? 'selected' : ''; ?> value="يَوم الأربعاء">يَوم الأربعاء</option>
                                    <option <?= ($doc['start_working_days_arabic'] == "يَوم الخميس") ? 'selected' : ''; ?> value="يَوم الخميس">يَوم الخميس</option>
                                    <option <?= ($doc['start_working_days_arabic'] == "يَوم الجمعة") ? 'selected' : ''; ?> value="يَوم الجمعة">يَوم الجمعة</option>
                                    <option <?= ($doc['start_working_days_arabic'] == "يَوم السبت") ? 'selected' : ''; ?> value="يَوم السبت">يَوم السبت</option>
                                    <option <?= ($doc['start_working_days_arabic'] == "يَوم الأحَد") ? 'selected' : ''; ?> value="يَوم الأحَد">يَوم الأحَد</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Working Day End Arabic</label>
                                <select name="txt_end_day_arabic" class="form-control" required>
                                    <option value="" selected disabled>Select Day</option>
                                    <option <?= ($doc['end_working_days_arabic'] == "يَوم الإثنين")  ? 'selected' : '';?> value="يَوم الإثنين">يَوم الإثنين</option>
                                    <option <?= ($doc['end_working_days_arabic'] == "يَوم الثلاثاء") ? 'selected' : ''; ?> value="يَوم الثلاثاء">يَوم الثلاثاء</option>
                                    <option <?= ($doc['end_working_days_arabic'] == "يَوم الأربعاء") ? 'selected' : ''; ?> value="يَوم الأربعاء">يَوم الأربعاء</option>
                                    <option <?= ($doc['end_working_days_arabic'] == "يَوم الخميس") ? 'selected' : ''; ?> value="يَوم الخميس">يَوم الخميس</option>
                                    <option <?= ($doc['end_working_days_arabic'] == "يَوم الجمعة") ? 'selected' : ''; ?> value="يَوم الجمعة">يَوم الجمعة</option>
                                    <option <?= ($doc['end_working_days_arabic'] == "يَوم السبت") ? 'selected' : ''; ?> value="يَوم السبت">يَوم السبت</option>
                                    <option <?= ($doc['end_working_days_arabic'] == "يَوم الأحَد") ? 'selected' : ''; ?> value="يَوم الأحَد">يَوم الأحَد</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Working Day Start time Arabic</label>
                                <input type="text" name="txt_working_time_arabic" value="<?= $doc['start_working_time_arabic']; ?>" class="form-control" placeholder="Enter start working time in arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Working Day End Time Arabic</label>
                                <input type="text" name="txt_end_time_arabic" value="<?= $doc['end_working_time_arabic']; ?>" class="form-control" placeholder="Enter end working time in arabic" required>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>list-doctors" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit_doc" class="btn btn-success" value="Save">
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