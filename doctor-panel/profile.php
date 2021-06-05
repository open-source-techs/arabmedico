<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$doc_id = get_sess("userdata")['doc_id'];
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
                            <div class="col-sm-12 form-group">
                                <label>Doctor Introduction</label>
                                <textarea name="txt_short_desc" rows="3" class="form-control" id="txt_short_desc"><?= htmlspecialchars_decode(html_entity_decode($doc['doc_intro'])); ?></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Detailed Resume</label>
                                <textarea name="txt_desc" rows="6" class="form-control" id="txt_desc" ><?= htmlspecialchars_decode(html_entity_decode($doc['doc_details'])); ?></textarea>
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
                                <textarea name="txt_short_desc_arabic" rows="3" class="form-control" id="txt_short_desc"><?= htmlspecialchars_decode(html_entity_decode($doc['doc_intro_arabic'])); ?></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Detailed Resume</label>
                                <textarea name="txt_desc_arabic" rows="6" class="form-control" id="txt_desc" ><?= htmlspecialchars_decode(html_entity_decode($doc['doc_details_arabic'])); ?></textarea>
                            </div>
                            <div class="col-sm-12">
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                                <h3>Credentials</h3>
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                            </div>
                            
                            <div class="col-sm-6 form-group">
                                <label>Username</label>
                                <input type="text" name="txt_username" value="<?= $doc['username']; ?>" class="form-control" placeholder="Enter Username">
                            </div>
                            
                            <div class="col-sm-6 form-group">
                                <label>Password</label>
                                <input type="password" name="txt_password" class="form-control" placeholder="Enter Password">
                            </div>
                            
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>" class="btn btn-warning">Cancel & Go Back</a>
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