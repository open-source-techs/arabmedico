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
                            <div class="col-sm-6 form-group">
                                <label>Doctor Name</label>
                                <input type="hidden" name="txt_doc_id" value="<?= $doc['doc_id']; ?>">
                                <input type="text" name="txt_doc_name" value="<?= $doc['doc_name'];?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Name in Arabic</label>
                                <input type="text" name="txt_doc_name_arabic" value="<?= $doc['doc_name_arabic']; ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Degree</label>
                                <input type="text" name="txt_doc_degree" value="<?= $doc['doc_degree']; ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Degree in Arabic</label>
                                <input type="text" name="txt_doc_degree_arabic" value="<?= $doc['doc_degree_arabic']; ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job Title</label>
                                <input type="text" name="txt_job_title" value="<?= $doc['doc_job_title']; ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job Title in Arabic</label>
                                <input type="text" name="txt_job_title_arabic" value="<?= $doc['doc_job_title_arabic']; ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Speciality</label>
                                <input type="text" name="txt_doc_speciality" value="<?= $doc['doc_speciality']; ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Speciality in Arabic</label>
                                <input type="text" name="txt_doc_speciality_arabic" value="<?= $doc['doc_speciality_arabic']; ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Experties Area</label>
                                <input type="text" name="txt_doc_experty" value="<?= $doc['doc_area_of_experty']; ?>" class="form-control" placeholder="Enter experties and use comma (,) to seperate them" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Experties Area in Arabic</label>
                                <input type="text" name="txt_doc_experty_arabic" value="<?= $doc['doc_area_of_experty_arabic']; ?>" class="form-control" placeholder="Enter experties and use comma (,) to seperate them" required>
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
                                <input type="text" name="txt_doc_lang1" value="<?= $doc['doc_lang1']; ?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Language No 1 In Arabic</label>
                                <input type="text" name="txt_doc_lang1_arabic" value="<?= $doc['doc_lang1_arabic']; ?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Language No 2</label>
                                <input type="text" name="txt_doc_lang2" value="<?= $doc['doc_lang2']; ?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Language No 2 In Arabic</label>
                                <input type="text" name="txt_doc_lang2_arabic" value="<?= $doc['doc_lang2_arabic']; ?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Language No 3</label>
                                <input type="text" name="txt_doc_lang3" value="<?= $doc['doc_lang3']; ?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Language No 3 In Arabic</label>
                                <input type="text" name="txt_doc_lang3_arabic" value="<?= $doc['doc_lang3_arabic']; ?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Language No 4</label>
                                <input type="text" name="txt_doc_lang4" value="<?= $doc['doc_lang4']; ?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Language No 4 In Arabic</label>
                                <input type="text" name="txt_doc_lang4_arabic" value="<?= $doc['doc_lang4_arabic']; ?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Language No 5</label>
                                <input type="text" name="txt_doc_lang5" value="<?= $doc['doc_lang5']; ?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Language No 5 In Arabic</label>
                                <input type="text" name="txt_doc_lang5_arabic" value="<?= $doc['doc_lang5_arabic']; ?>" class="form-control">
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
                            <div class="col-sm-6 form-group">
                                <label>Select Membership</label>
                                <select name="txt_membership" class="form-control select2" required>
                                    <option <?= ($row['membership_id'] == 0) ? 'selected' : ''; ?> value="0">Free Membership</option>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_membership WHERE membership_active = 1");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <option <?= ($row['membership_id'] == $doc['doc_membership']) ? 'selected' : ''; ?> value="<?= $row['membership_id'];?>"><?= $row['membership_name'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Country</label>
                                <select name="txt_country" id="txt_country" class="form-control" required>
                                    <option>Select Country</option>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_country WHERE country_active = 1");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <option <?= ($row['country_id'] == $doc['doc_country']) ? 'selected' : ''; ?> value="<?= $row['country_id'];?>"><?= $row['country_name'];?> - <?= $row['country_name_ar'];?></option>
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
                                    if($doc['doc_city'] != null && $doc['doc_city'] != "")
                                    {
                                        $country = $doc['doc_country'];
                                        $sql = query("SELECT * FROM tbl_cities WHERE city_active = 1 AND city_country = '$country'");
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <option <?= ($row['city_id'] == $doc['doc_city']) ? 'selected' : ''; ?> value="<?= $row['city_id'];?>"><?= $row['city_name'];?> - <?= $row['city_name_ar'];?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Area</label>
                                <select name="txt_area" id="txt_area" class="form-control" required>
                                    <option>Select Area</option>
                                    <?php
                                    if($doc['doc_area'] != null && $doc['doc_area'] != "")
                                    {
                                        $city = $doc['doc_city'];
                                        $sql = query("SELECT * FROM tbl_areas WHERE area_active = 1 AND area_city = '$city'");
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <option <?= ($row['area_id'] == $doc['doc_area']) ? 'selected' : ''; ?> value="<?= $row['area_id'];?>"><?= $row['area_name'];?> - <?= $row['area_name_ar'];?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Slug (https://arabmedico.com/......)</label>
                                <input type="text" name="txt_slug" class="form-control" value="<?= $doc['doc_slug']; ?>">
                                <input type="hidden" name="txt_prev_slug" value="<?= $doc['doc_slug']; ?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Add Website Url</label>
                                <input type="text" name="doc_web_url" value="<?= $doc['doc_website_url']; ?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Add Facebook Url</label>
                                <input type="text" name="doc_facebook_url" value="<?= $doc['doc_facebook_url']; ?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Add Linkedin Url</label>
                                <input type="text" name="doc_linkedin_url" value="<?= $doc['doc_linkedin_url']; ?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Add Instagram Url</label>
                                <input type="text" name="doc_instagram_url" value="<?= $doc['doc_instagram_url']; ?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Add Twitter Url</label>
                                <input type="text" name="doc_tiwtter_url" value="<?= $doc['doc_twitter_url']; ?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Add Youtube Url</label>
                                <input type="text" name="doc_youtube_url" value="<?= $doc['doc_youtube_url']; ?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group" style="display:flex;margin-top: 25px;">
                                <?php if($doc['doc_status_head']== 1) {?>
                                 <input type="checkbox" checked id="checkDocHead" style="width: 40px;height: 20px;" name="check_doc_head" class="form-control">
                                <?php } else {?>
                                <input type="checkbox" id="checkDocHead" style="width: 40px;height: 20px;" name="check_doc_head" class="form-control">
                                <?php }?>
                                <label for="checkDocHead" style="margin-top:5px">Check if Doctor is Head of Department</label>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Registration No</label>
                                <input type="text" name="txt_doc_reg_no" value="<?= $doc['doc_reg_no']; ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Username</label>
                                <input type="text" name="txt_username" value="<?= $doc['username']; ?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Password</label>
                                <input type="password" name="txt_password" class="form-control" >
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Doctor Introduction</label>
                                <textarea name="txt_short_desc" rows="3" class="form-control" id="txt_short_desc"><?= htmlspecialchars_decode($doc['doc_intro']); ?></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Doctor Introduction in Arabic</label>
                                <textarea name="txt_short_desc_arabic" rows="3" class="form-control" id="txt_short_desc"><?= htmlspecialchars_decode($doc['doc_intro_arabic']); ?></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Detailed Resume</label>
                                <textarea name="txt_desc" rows="6" class="form-control" id="txt_desc" ><?= htmlspecialchars_decode($doc['doc_details']); ?></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Detailed Resume in Arabic</label>
                                <textarea name="txt_desc_arabic" rows="6" class="form-control" id="txt_desc" ><?= htmlspecialchars_decode($doc['doc_details_arabic']); ?></textarea>
                            </div>


                            <div class="col-sm-6 form-group">
                                <label>Meta Title</label>
                                <input type="text" name="txt_meta_title" value="<?= $doc['doc_meta_title']; ?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Title for arabic</label>
                                <input type="text" name="txt_meta_title_ar" value="<?= $doc['doc_meta_title_ar']; ?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Tags</label>
                                <textarea name="txt_tag" rows="3" class="form-control"><?= $doc['doc_meta_tag']; ?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Tags for Arabic</label>
                                <textarea name="txt_tag_ar" rows="3" class="form-control"><?= $doc['doc_meta_tag_ar']; ?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Description</label>
                                <textarea name="txt_meta_desc" rows="3" class="form-control"><?= $doc['doc_meta_desc']; ?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Description for Arabic</label>
                                <textarea name="txt_meta_desc_ar" rows="3" class="form-control"><?= $doc['doc_meta_desc_ar']; ?></textarea>
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
	var area1, area2, area3, area4;
    
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
    
    function toggleArea3()
    {
        if(!area3)
        {
            area3 = new nicEditor({fullPanel : true}).panelInstance('txt_short_desc_arabic',{hasPanel : true});
        }
        else
        {
            area3.removeInstance('txt_short_desc_arabic');
            area3 = null;
        }
    }
    
    function toggleArea4()
    {
        if(!area4)
        {
            area4 = new nicEditor({fullPanel : true}).panelInstance('txt_desc_arabic',{hasPanel : true});
        }
        else
        {
            area4.removeInstance('txt_desc_arabic');
            area4 = null;
        }
    }
    bkLib.onDomLoaded(function() { toggleArea1(); toggleArea2(); toggleArea3(); toggleArea4(); });
	$(document).ready(function(){
	    $(".select2").select2();
	    $("#txt_country").change(function(){
	        var value = $(this).val();
	        var act = "getcities";
	        $.ajax({
	            data:{countryID: value, action:act},
	            url:"<?= admin_base_url(); ?>model/channelModel",
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
	    $("#txt_city").change(function(){
	        var value = $(this).val();
	        var act = "getarea";
	        $.ajax({
	            data:{cityID: value, action:act},
	            url:"<?= admin_base_url(); ?>model/channelModel",
	            type:"post",
	            success:function(res)
	            {
	                
	                var result = $.parseJSON(res);
	                $("#txt_area").empty();
	                if(result.msg == "success")
	                {
	                    var data = result.data;
	                    $("#txt_area").append("<option selected disabled>Select Area</option>");
	                    $.each(data, function(index, value)
	                    {
	                        var li = '<option value="'+value.area_id+'">'+value.area_name+' - '+value.area_name_ar+'</option>';
	                        $("#txt_area").append(li);
	                    });
	                }
	                else
	                {
	                    alert("No area found againt selected country");
	                }
	            }
	        });
	    });
	});
</script>