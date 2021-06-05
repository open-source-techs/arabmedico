<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$can_id = $_GET['can_id'];
if($can_id == 0 || $can_id == '' || $can_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>candidate-list";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_candidate where candidate_id = '$can_id'");
$candidate = fetch($sql);
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Candidate</h1>
            <small>Edit Candidate</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Edit Candidate</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>candidate-list"> <i class="fa fa-list"></i> Candidate List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/candidateModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" name="txt_candidate_id" value="<?= $candidate['candidate_id']; ?>">
                            <div class="col-sm-6 form-group">
                                <label>Name</label>
                                <input type="text" name="txt_candidate_name" class="form-control" required value="<?= $candidate['candidate_name']; ?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Name in Arabic</label>
                                <input type="text" name="txt_candidate_name_ar" class="form-control" required value="<?= $candidate['candidate_name_ar']; ?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Degree</label>
                                <input type="text" name="txt_candidate_degree" class="form-control" required value="<?= $candidate['candidate_degree']; ?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Degree in Arabic</label>
                                <input type="text" name="txt_candidate_degree_ar" class="form-control" required value="<?= $candidate['candidate_degree_ar']; ?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job title</label>
                                <input type="text" name="txt_job_title" class="form-control" required value="<?= $candidate['candidate_job']; ?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job title in Arabic</label>
                                <input type="text" name="txt_job_title_ar" class="form-control" required value="<?= $candidate['candidate_job_ar']; ?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Industry</label>
                                <input type="text" name="txt_industry" class="form-control" required value="<?= $candidate['candidate_industry']; ?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Industry in Arabic</label>
                                <input type="text" name="txt_industry_ar" class="form-control" required value="<?= $candidate['candidate_industry_ar']; ?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Company</label>
                                <input type="text" name="txt_company" class="form-control" required value="<?= $candidate['candidate_company']; ?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Company in Arabic</label>
                                <input type="text" name="txt_company_ar" class="form-control" required value="<?= $candidate['candidate_company_ar']; ?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Email</label>
                                <input type="email" name="txt_email" class="form-control" required value="<?= $candidate['candidate_email']; ?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Phone</label>
                                <input type="tel" name="txt_phone" class="form-control" required value="<?= $candidate['candidate_phone']; ?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Nationality</label>
                                <input type="text" name="txt_nationality" class="form-control" required value="<?= $candidate['candiate_nationality']; ?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Nationality in Arabic</label>
                                <input type="text" name="txt_nationality_ar" class="form-control" required value="<?= $candidate['candiate_nationality_ar']; ?>">
                            </div>
                            
                            <div class="col-sm-6 form-group">
                                <label>Select Gender</label>
                                <select name="txt_gender" class="form-control select2" required>
                                    <option selected disabled>Select Gender</option>
                                    <option value="Male" <?= ($candidate['candidate_gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                    <option value="Female" <?= ($candidate['candidate_gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Gender for Arabic</label>
                                <select name="txt_gender_ar" class="form-control select2" required>
                                    <option selected disabled>Select Gender for Arabic</option>
                                    <option <?= ($candidate['candidate_gender_ar'] == 'الذكر') ? 'selected' : ''; ?> value="الذكر">الذكر</option>
                                    <option <?= ($candidate['candidate_gender_ar'] == 'أنثى') ? 'selected' : ''; ?> value="أنثى">أنثى</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Country</label>
                                <select name="txt_country" id="txt_country" class="form-control" required>
                                    <option>Select Country</option>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_candidate_country WHERE country_active = 1");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <option <?= ($candidate['candidate_country'] == $row['country_id']) ? 'selected' : ''; ?> value="<?= $row['country_id'];?>"><?= $row['country_name'];?> - <?= $row['country_name_ar'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>City</label>
                                <select name="txt_city" id="txt_city" class="form-control" required>
                                    <option>Select City</option>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_candidate_cities WHERE city_active = 1 AND city_country = ". $candidate['candidate_country']);
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <option <?= ($candidate['candidate_city'] == $row['city_id']) ? 'selected' : ''; ?> value="<?= $row['city_id'];?>"><?= $row['city_name'];?> - <?= $row['city_name_ar'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Upload Image</label>
                                <input type="file" name="txt_image" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Upload Banner</label>
                                <input type="file" name="txt_banner" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Speciality</label>
                                <select name="txt_depart" class="form-control select2" required>
                                    <option>Select Speciality</option>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_candiate_speciality WHERE can_speciality_active = 1");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <option <?= ($candidate['candidate_department'] == $row['can_speciality_id']) ? 'selected' : ''; ?> value="<?= $row['can_speciality_id'];?>"><?= $row['can_speciality_name'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Web Slug (https://arabmedico.com/.....)</label>
                                <input type="text" name="txt_slug" class="form-control" required value="<?= $candidate['candidate_slug']; ?>">
                                <input type="hidden" name="txt_pre_slug" value="<?= $candidate['candidate_slug']; ?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Visa Status</label>
                                <select name="txt_visa_status" class="form-control" required>
                                    <option>Select Visa Status</option>
                                    <option <?= ($candidate['candidate_visa'] == 'National') ? 'selected' : ''; ?> value="National">National</option>
                                    <option <?= ($candidate['candidate_visa'] == 'Need Visa') ? 'selected' : ''; ?> value="Need Visa">Need Visa</option>
                                    <option <?= ($candidate['candidate_visa'] == 'GCC National') ? 'selected' : ''; ?> value="GCC National">GCC National</option>
                                    <option <?= ($candidate['candidate_visa'] == 'Have Transferable Iqama') ? 'selected' : ''; ?> value="Have Transferable Iqama">Have Transferable Iqama</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Visa Status for Arabic</label>
                                <select name="txt_visa_status_ar" class="form-control" required>
                                    <option>Select Visa Status</option>
                                    <option <?= ($candidate['candidate_visa_ar'] == 'وطني') ? 'selected' : ''; ?> value="وطني">وطني</option>
                                    <option <?= ($candidate['candidate_visa_ar'] == 'تحتاج فيزا') ? 'selected' : ''; ?> value="تحتاج فيزا">تحتاج فيزا</option>
                                    <option <?= ($candidate['candidate_visa_ar'] == 'مواطن خليجي') ? 'selected' : ''; ?> value="مواطن خليجي">مواطن خليجي</option>
                                    <option <?= ($candidate['candidate_visa_ar'] == 'أن يكون لديك إقامة قابلة للتحويل') ? 'selected' : ''; ?> value="أن يكون لديك إقامة قابلة للتحويل">أن يكون لديك إقامة قابلة للتحويل</option>
                                </select>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Detailed Resume</label>
                                <textarea name="txt_desc" rows="6" class="form-control" id="txt_desc" ><?= $candidate['candiadate_resume']; ?></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Detailed Resume in Arabic</label>
                                <textarea name="txt_desc_ar" rows="6" class="form-control" id="txt_desc_ar" ><?= $candidate['candiadate_resume_ar']; ?></textarea>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>candidate-list" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit_candidate" class="btn btn-success" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>candidate-list"> <i class="fa fa-list"></i> Candidate List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/candidateModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" name="txt_candidate_id" value="<?= $candidate['candidate_id']; ?>">
                            <div class="col-sm-6 form-group">
                                <label>Username</label>
                                <input type="text" name="txt_username" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Password</label>
                                <input type="password" name="txt_password" class="form-control">
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>candidate-list" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit_username" class="btn btn-success" value="Save">
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

    var area1, area2;
    
    function toggleArea1()
    {
        if(!area1)
        {
            area1 = new nicEditor({fullPanel : true}).panelInstance('txt_desc',{hasPanel : true});
        }
        else
        {
            area1.removeInstance('txt_desc');
            area1 = null;
        }
    }
    
    function toggleArea2()
    {
        if(!area2)
        {
            area2 = new nicEditor({fullPanel : true}).panelInstance('txt_desc_ar',{hasPanel : true});
        }
        else
        {
            area2.removeInstance('txt_desc_ar');
            area2 = null;
        }
    }
    bkLib.onDomLoaded(function() { toggleArea1(); toggleArea2(); });
	$(document).ready(function(){
        $("#txt_country").change(function(){
	        var value = $(this).val();
	        var act = "getcities";
	        $.ajax({
	            data:{countryID: value, action:act},
	            url:"<?= admin_base_url(); ?>model/candidateModel",
	            type:"post",
	            success:function(res)
	            {
	                var result = $.parseJSON(res);
	                $("#txt_city").empty();
	                if(result.msg == "success")
	                {
	                    var data = result.data;
	                    $("#txt_city").append("<option selected disabled>Select City</option>");
	                    $.each(data, function(index, value)
	                    {
	                        var li = '<option value="'+value.city_id+'">'+value.city_name+' - '+value.city_name_ar+'</option>';
	                        $("#txt_city").append(li);
	                    });
	                }
	                else
	                {
	                    alert("No city found againt selected country");
	                }
	            }
	        });
	    });
	});
</script>