<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Candidate</h1>
            <small>Add New Candidate</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add Candidate</li>
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
                            <div class="col-sm-6 form-group">
                                <label>Name</label>
                                <input type="text" name="txt_candidate_name" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Name in Arabic</label>
                                <input type="text" name="txt_candidate_name_ar" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Degree</label>
                                <input type="text" name="txt_candidate_degree" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Degree in Arabic</label>
                                <input type="text" name="txt_candidate_degree_ar" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job title</label>
                                <input type="text" name="txt_job_title" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job title in Arabic</label>
                                <input type="text" name="txt_job_title_ar" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Industry</label>
                                <input type="text" name="txt_industry" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Industry in Arabic</label>
                                <input type="text" name="txt_industry_ar" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Company</label>
                                <input type="text" name="txt_company" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Company in Arabic</label>
                                <input type="text" name="txt_company_ar" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Email</label>
                                <input type="email" name="txt_email" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Phone</label>
                                <input type="tel" name="txt_phone" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Nationality</label>
                                <input type="text" name="txt_nationality" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Nationality in Arabic</label>
                                <input type="text" name="txt_nationality_ar" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Gender</label>
                                <select name="txt_gender" class="form-control select2" required>
                                    <option selected disabled>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Gender for Arabic</label>
                                <select name="txt_gender_ar" class="form-control select2" required>
                                    <option selected disabled>Select Gender for Arabic</option>
                                    <option value="??????????">??????????</option>
                                    <option value="????????">????????</option>
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
                                        <option value="<?= $row['country_id'];?>"><?= $row['country_name'];?> - <?= $row['country_name_ar'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>City</label>
                                <select name="txt_city" id="txt_city" class="form-control" required>
                                    <option>Select City</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Username</label>
                                <input type="text" name="txt_username" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Password</label>
                                <input type="password" name="txt_password" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Upload Image</label>
                                <input type="file" name="txt_image" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Upload Banner</label>
                                <input type="file" name="txt_banner" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Package</label>
                                <select name="txt_package" class="form-control select2" required>
                                    <option>Select one</option>
                                    <option value="1">Premium</option>
                                    <option value="0">Basic</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Speciality</label>
                                <select name="txt_speciality" class="form-control select2" required>
                                    <option>Select one</option>
                                   <?php
                                    $sql = query('SELECT * FROM tbl_candiate_speciality WHERE can_speciality_active = 1');
                                    while($spc = fetch($sql))
                                    {
                                        ?>
                                        <option value="<?= $spc['can_speciality_id']; ?>"><?= $spc['can_speciality_name'] . " - " . $spc['can_speciality_name_ar']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Web Slug (https://arabmedico.com/.....)</label>
                                <input type="text" name="txt_slug" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Visa Status</label>
                                <select name="txt_visa_status" class="form-control" required>
                                    <option>Select Visa Status</option>
                                    <option value="National">National</option>
                                    <option value="Need Visa">Need Visa</option>
                                    <option value="GCC National">GCC National</option>
                                    <option value="Have Transferable Iqama">Have Transferable Iqama</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Visa Status for Arabic</label>
                                <select name="txt_visa_status_ar" class="form-control" required>
                                    <option>Select Visa Status</option>
                                    <option value="????????">????????</option>
                                    <option value="?????????? ????????">?????????? ????????</option>
                                    <option value="?????????? ??????????">?????????? ??????????</option>
                                    <option value="???? ???????? ???????? ?????????? ?????????? ??????????????">???? ???????? ???????? ?????????? ?????????? ??????????????</option>
                                </select>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Detailed Resume</label>
                                <textarea name="txt_desc" rows="6" class="form-control" id="txt_desc"></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Detailed Resume in Arabic</label>
                                <textarea name="txt_desc_ar" rows="6" class="form-control" id="txt_desc_ar"></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Title</label>
                                <input type="text" name="txt_meta_title" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Title for arabic</label>
                                <input type="text" name="txt_meta_title_ar" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Tags</label>
                                <textarea name="txt_tag" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Tags for Arabic</label>
                                <textarea name="txt_tag_ar" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Description</label>
                                <textarea name="txt_meta_desc" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Description for Arabic</label>
                                <textarea name="txt_meta_desc_ar" rows="3" class="form-control"></textarea>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>candidate-list" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_save_candidate" class="btn btn-success" value="Save">
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