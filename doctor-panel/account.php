<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$doc_id = get_sess("userdata")['doc_id'];
$sql = query("SELECT * FROM tbl_doctor where doc_id = '$doc_id'");
$doc = fetch($sql);

$btn_name = "btn_save_service";
if(isset($_GET['serv_id']) && $_GET['serv_id'] != null && $_GET['serv_id'] != "" && $_GET['serv_id'] > 0)
{
    $srvId = $_GET['serv_id'];
    $sql = query("SELECT * FROM tbl_doc_clinicalServices where c_id = '$srvId'");
    $fetch = fetch($sql);
    $btn_name = "btn_edit_service";
}
$sql_new1 = query("SELECT * FROM tbl_membership WHERE membership_id = ". get_sess('userdata')['doc_membership']);
$fetch1 = fetch($sql_new1);
?>
<style>
    .tab-pane *{
        width:100% !important;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Account</h1>
            <small>Update Account</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Account</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <h3>Acount Information</h3>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/doctorModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Name</label>
                                <input type="hidden" name="txt_doc_id" value="<?= $doc['doc_id']; ?>">
                                <input type="text" name="txt_doc_name" value="<?= $doc['doc_name'];?>" class="form-control" placeholder="Enter Doctor Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Name in Arabic</label>
                                <input type="text" name="txt_doc_name_arabic" value="<?= $doc['doc_name_arabic']; ?>" class="form-control" placeholder="Enter Doctor Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Email</label>
                                <input type="text" name="txt_doc_email" value="<?= $doc['doc_email']; ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Number</label>
                                <input type="text" name="txt_doc_number" value="<?= $doc['doc_phone_no']; ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Registration No</label>
                                <input type="text" name="txt_doc_reg_no" value="<?= $doc['doc_reg_no']; ?>" class="form-control" placeholder="Enter Registration No" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Degree</label>
                                <input type="text" name="txt_doc_degree" value="<?= $doc['doc_degree']; ?>" class="form-control" placeholder="Enter Doctor Degree" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Degree</label>
                                <input type="text" name="txt_doc_degree_arabic" value="<?= $doc['doc_degree_arabic']; ?>" class="form-control" placeholder="Enter Doctor Degree" required>
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
                                <label>Job Title</label>
                                <input type="text" name="txt_job_title" value="<?= $doc['doc_job_title']; ?>" class="form-control" placeholder="Enter Job title" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job Title in Arabic</label>
                                <input type="text" name="txt_job_title_arabic" value="<?= $doc['doc_job_title_arabic']; ?>" class="form-control" placeholder="Enter Job title" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Speciality</label>
                                <input type="text" name="txt_doc_speciality" value="<?= $doc['doc_speciality']; ?>" class="form-control" placeholder="Enter Doctor Speciality" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Doctor Speciality In Arabic</label>
                                <input type="text" name="txt_doc_speciality_arabic" value="<?= $doc['doc_speciality_arabic']; ?>" class="form-control" placeholder="Enter Doctor Speciality" required>
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
                                <label>Language No 5 In Arabic </label>
                                <input type="text" name="txt_doc_lang5_arabic" value="<?= $doc['doc_lang5_arabic']; ?>" class="form-control" placeholder="Enter Language No 5 In Arabic">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Add Website Url</label>
                                <input type="text" name="doc_web_url" value="<?= $doc['doc_website_url']; ?>" class="form-control" placeholder="Add Website Url">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Add Facebook Url</label>
                                <input type="text" name="doc_facebook_url" value="<?= $doc['doc_facebook_url']; ?>" class="form-control" placeholder="Add Facebook Url">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Add Linkedin Url</label>
                                <input type="text" name="doc_linkedin_url" value="<?= $doc['doc_linkedin_url']; ?>" class="form-control" placeholder="Add Linkedin Url">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Add Instagram Url</label>
                                <input type="text" name="doc_instagram_url" value="<?= $doc['doc_instagram_url']; ?>" class="form-control" placeholder="Add Instagram Url">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Add Twitter Url</label>
                                <input type="text" name="doc_tiwtter_url" value="<?= $doc['doc_twitter_url']; ?>" class="form-control" placeholder="Add Twitter Url">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Add Youtube Url</label>
                                <input type="text" name="doc_youtube_url" value="<?= $doc['doc_youtube_url']; ?>" class="form-control" placeholder="Add Youtube Url">
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
                                <label>Slug (https:/arabmedico.com/YourSlug)</label>
                                <input type="text" id="txt_doc_slug" name="txt_doc_slug" value="<?= $doc['doc_slug']; ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Doctor Introduction</label>
                                <textarea name="txt_short_desc" rows="3" class="form-control" id="txt_short_desc"><?= $doc['doc_intro']; ?></textarea>
                            </div>
                            <div class="col-sm-12 form-group">    
                                <label>Doctor Introduction in Arabic</label>
                                <textarea name="txt_short_desc_arabic" rows="3" class="form-control" id="txt_short_desc_ar"><?= $doc['doc_intro_arabic']; ?></textarea>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <input type="submit" name="btn_update_profile" class="btn btn-success" value="Save">
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
                        <h3>Practice Location</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form  action="<?= admin_base_url()?>model/doctorModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                <input type="hidden" name="txt_doc_id" value="<?= $doc['doc_id']; ?>">
                                <div class="col-sm-6 form-group">
                                    <label>Clinic Name</label>
                                    <input type="text" name="txt_name" class="form-control" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Clinic Name in Arabic</label>
                                    <input type="text" name="txt_name_arabic" class="form-control" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Building</label>
                                    <input type="text" name="txt_building" class="form-control" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Building Arabic</label>
                                    <input type="text" name="txt_building_ar" class="form-control" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Street Address</label>
                                    <input type="text" name="txt_street_add" class="form-control" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Street Address Arabic</label>
                                    <input type="text" name="txt_street_add_ar" class="form-control" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Zip/Post Code</label>
                                    <input type="text" name="txt_zip" class="form-control" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Country</label>
                                    <select name="txt_country" id="txt_country_loc" class="form-control" required>
                                        <option>Select Country</option>
                                        <?php
                                        $sql = query("SELECT * FROM tbl_country WHERE country_active = 1");
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
                                    <select name="txt_city" id="txt_city_loc" class="form-control" required>
                                        <option>Select City</option>
                                        <?php
                                        $country = $doc['doc_country'];
                                        $sql = query("SELECT * FROM tbl_cities WHERE city_active = 1 AND city_country = '$country'");
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <option value="<?= $row['city_id'];?>"><?= $row['city_name'];?> - <?= $row['city_name_ar'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Area</label>
                                    <select name="txt_area" id="txt_area_loc" class="form-control" required>
                                        <option>Select Area</option>
                                        <?php
                                        $city = $doc['doc_city'];
                                        $sql = query("SELECT * FROM tbl_areas WHERE area_active = 1 AND area_city = '$city'");
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <option <?= ($row['area_id'] == $doc['doc_area']) ? 'selected' : ''; ?> value="<?= $row['area_id'];?>"><?= $row['area_name'];?> - <?= $row['area_name_ar'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Email</label>
                                    <input type="text" name="txt_email" class="form-control" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Number</label>
                                    <input type="text" name="txt_number" class="form-control" required>
                                </div>
                                <div class="col-sm-12 reset-button">
                                    <input type="submit" name="btn_add_location" class="btn btn-success" value="Save">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Location</th>
                                            <th>Email Address</th>
                                            <th>Phone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        $sql = query("SELECT * FROM tbl_doc_practice_loc pl JOIN tbl_country cn ON (pl.loc_country = cn.country_id) JOIN tbl_cities c ON (pl.loc_city = c.city_id) JOIN tbl_areas a ON (pl.loc_area = a.area_id) WHERE loc_doc_id = ".$doc_id);
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <tr>
                                                <td><b><?= $row['loc_name'];?></b>, <?= $row['loc_address'];?>, <?= $row['country_name'];?>, <?= $row['city_name'];?>, <?= $row['area_name'];?></td>
                                                <td><?= $row['loc_email'];?></td>
                                                <td><?= $row['loc_number'];?></td>
                                                <td>
                                                    <a href="<?= admin_base_url();?>model/doctorModel?act=del-loc&loc_id=<?= $row['loc_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                        <h3>Services</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form  action="<?= admin_base_url()?>model/doctorModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                <input type="hidden" name="txt_doc_id" value="<?= $doc['doc_id']; ?>">
                                <div class="col-sm-6 form-group">
                                    <label>Service Name</label>
                                    <input type="text" name="txt_service" class="form-control" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Service Name in Arabic</label>
                                    <input type="text" name="txt_service_arabic" class="form-control" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Charges</label>
                                    <input type="text" name="txt_charges" class="form-control" required>
                                </div>
                                <div class="col-sm-12 reset-button">
                                    <input type="submit" name="btn_doc_service" class="btn btn-success" value="Save">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Service</th>
                                            <th>Charges</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        $sql = query("SELECT * FROM tbl_doc_services WHERE service_doc = ".$doc_id);
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $row['service_desc'];?></td>
                                                <td><?= $row['service_amount'];?></td>
                                                <td>
                                                    <a href="<?= admin_base_url();?>model/doctorModel?act=del-service&serv_id=<?= $row['doc_service_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                        <h3>Speciality</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form  action="<?= admin_base_url()?>model/doctorModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                <input type="hidden" name="txt_doc_id" value="<?= $doc['doc_id']; ?>">
                                <div class="col-sm-6 form-group">
                                    <label>Specialty</label>
                                    <select name="txt_speciality" class="form-control" required>
                                        <option value="" disabled selected>----Select Speciality----</option>
                                        <?php
                                        $sql = query('SELECT * FROM tbl_specialty WHERE specialty_status = 1');
                                        while($spc = fetch($sql))
                                        {
                                            ?>
                                            <option value="<?= $spc['specialty_id']; ?>"><?= $spc['specialty_name'];?> - <?= $spc['specialty_ar_name'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-12 reset-button">
                                    <input type="submit" name="btn_speciality" class="btn btn-success" value="Save">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Speciality</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        $sql = query("SELECT * FROM tbl_doc_speciality dc JOIN tbl_specialty sp ON (dc.doc_speciality = sp.specialty_id) WHERE doc_spec_doc = ".$doc_id);
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $row['specialty_name'];?></td>
                                                <td>
                                                    <a href="<?= admin_base_url();?>model/doctorModel?act=del-speciality&speciality=<?= $row['doc_speciality_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                        <h3>Conditions & Treatments</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form  action="<?= admin_base_url()?>model/doctorModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                <input type="hidden" name="txt_doc_id" value="<?= $doc['doc_id']; ?>">
                                <div class="col-sm-6 form-group">
                                    <label>Specialty</label>
                                    <select name="txt_speciality" id="txt_speciality" class="form-control" required>
                                        <option value="" disabled selected>----Select Speciality----</option>
                                        <?php
                                        $sql = query('SELECT * FROM tbl_specialty WHERE specialty_status = 1');
                                        while($spc = fetch($sql))
                                        {
                                            ?>
                                            <option value="<?= $spc['specialty_id']; ?>"><?= $spc['specialty_name'];?> - <?= $spc['specialty_ar_name'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Treatment/Condition</label>
                                    <select name="txt_treatment" id="txt_treatment" class="form-control" required></select>
                                </div>
                                <div class="col-sm-12 reset-button">
                                    <input type="submit" name="btn_treatment" class="btn btn-success" value="Save">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Speciality</th>
                                            <th>Medical Conditions/Treatments</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        $sql = query("SELECT * FROM tbl_doc_treatments dt JOIN tbl_specialty sp ON (dt.treatment_speciality = sp.specialty_id) JOIN tbl_treatment tr ON (tr.treatment_id = dt.treatment_condition) WHERE treatment_doc = ".$doc_id);
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $row['specialty_name'];?></td>
                                                <td><?= $row['treatment_name'];?></td>
                                                <td>
                                                    <a href="<?= admin_base_url();?>model/doctorModel?act=del-treatemnt&treatemnt=<?= $row['doc_treatment_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                        <h3>Institutional Affiliation</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form  action="<?= admin_base_url()?>model/doctorModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                <input type="hidden" name="txt_doc_id" value="<?= $doc['doc_id']; ?>">
                                <div class="col-sm-6 form-group">
                                <label>Institute Name</label>
                                    <input type="text" name="txt_institute" class="form-control" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Institute Name in Arabic</label>
                                    <input type="text" name="txt_institute_arabic" class="form-control" required>
                                </div>
                                <div class="col-sm-12 reset-button">
                                    <input type="submit" name="btn_doc_institute" class="btn btn-success" value="Save">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Institute</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        $sql = query("SELECT * FROM tbl_doc_institue WHERE institute_doc = ".$doc_id);
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $row['institute_name'];?></td>
                                                <td>
                                                    <a href="<?= admin_base_url();?>model/doctorModel?act=del-institute&institute_id=<?= $row['institute_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    if($fetch1['super_consultant'] == 1)
    {
        ?>
        <section class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <h3>Appoinment</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <form  action="<?= admin_base_url()?>model/doctorModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                    <input type="hidden" name="txt_doc_id" value="<?= $doc['doc_id']; ?>">
                                    <div class="col-sm-6 form-group">
                                        <label>Appoinment Title</label>
                                        <input type="text" name="txt_appoint" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Appoinment Title in Arabic</label>
                                        <input type="text" name="txt_appoint_arabic" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Hospital Name</label>
                                        <input type="text" name="txt_hospName" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Hospital Name in Arabic</label>
                                        <input type="text" name="txt_hospName_ar" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Country</label>
                                        <select name="txt_country" id="txt_country_app" class="form-control" required>
                                            <option>Select Country</option>
                                            <?php
                                            $sql = query("SELECT * FROM tbl_country WHERE country_active = 1");
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
                                        <select name="txt_city" id="txt_city_app" class="form-control" required>
                                            <option>Select City</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-sm-6 form-group">
                                        <label>Start Date</label>
                                        <input type="date" name="txt_start_date" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>End</label>
                                        <select class="form-control" name="txt_end_cont" id="txt_end_cont">
                                            <option value="cont">Continue</option>
                                            <option value="end">Ended</option>
                                        </select>
                                        <div class="date" style="display:none;">
                                            <input type="date" name="txt_end_arabic" class="form-control date_end">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Employer Logo</label>
                                        <input type="file" name="txt_logo" class="form-control" required>
                                    </div>
                                    <div class="col-sm-12 reset-button">
                                        <input type="submit" name="btn_doc_appoint" class="btn btn-success" value="Save">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Logo</th>
                                                <th>Post Title</th>
                                                <th>Hospital Name </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <?php
                                            $sql = query("SELECT * FROM tbl_doc_appoint WHERE doc_appoint_doc = ".$doc_id);
                                            while ($row = fetch($sql))
                                            {
                                                ?>
                                                <tr>
                                                    <td><img src="<?= file_url().$row['app_hospLogo'];?>" style="height:80px;width:80px;" ></td>
                                                    <td><?= $row['doc_appoint_title'];?></td>
                                                    <td><?= $row['app_hospName'];?></td>
                                                    <td>
                                                        <a href="<?= admin_base_url();?>model/doctorModel?act=del-appoint&appoint_id=<?= $row['doc_appoint_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                    
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
                                <h3>Manage clinical Services</h3>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <form  action="<?= admin_base_url()?>model/servicesModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                    <input type="hidden" name="txt_doc_id" value="<?= $doc_id; ?>">
                                    <?php
                                    if(isset($_GET['serv_id']))
                                    {
                                        ?>
                                        <input type="hidden" name="txt_serv_id" value="<?= $fetch['c_id']; ?>">
                                        <?php
                                    }
                                    ?>
                                    <div class="col-sm-6 form-group">
                                        <label>Service title</label>
                                        <input type="text" name="txt_cer_name" <?= (isset($_GET['serv_id'])) ? 'value="'.$fetch['c_name'].'"' : '';?> class="form-control" placeholder="Enter Service Name" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Service Title Arabic</label>
                                        <input type="text" name="arabic_cer_title" <?= (isset($_GET['serv_id'])) ? 'value="'.$fetch['c_name_ar'].'"' : '';?> class="form-control" placeholder="Serive Title Arabic" required>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Description</label>
                                        <textarea name="txt_short_desc" rows="3" class="form-control" id="txt_desc"><?= (isset($_GET['serv_id'])) ? $fetch['c_desc'] : '';?></textarea>
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label>Description Arabic</label>
                                        <textarea name="txt_short_desc_arabic" rows="3" class="form-control" id="txt_desc_arabic"><?= (isset($_GET['serv_id'])) ? $fetch['c_desc_ar'] : '';?></textarea>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Service Image</label>
                                        <input type="file" name="cer_profile" class="form-control"  onchange="checkFileSize('cer_profile');" id="txt_profile" <?= (isset($_GET['serv_id'])) ? '' : 'required';?>>
                                        <label class="txt_profile"></label>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="btn-block">Action</label>
                                        <input type="submit" name="<?= $btn_name; ?>" class="btn btn-success" value="Save">
                                    </div>
                                </form>
                            </div>
                            <br>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Sr#</th>
                                                <th>Image</th>
                                                <th>Title</th>
                                                <th>Active?</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = query("SELECT * FROM tbl_doc_clinicalServices where c_doc_id = '$doc_id'");
                                            $i=0;
                                            while ($row = fetch($sql))
                                            {
                                                $i++;
                                                ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><img style="width:80px;height:80px" src="<?= file_url().$row['c_image'];?>"></td>
                                                    <td><?= $row['c_name']; ?></td>
                                                    <td><?= ($row['c_active'] == 1) ? 'Active' : 'Not Active' ; ?></td>
                                                    <td>
                                                        <a href="<?= admin_base_url();?>account?serv_id=<?= $row['c_id']; ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                                                        <a href="<?= admin_base_url();?>model/servicesModel?act=del-serv&serv_id=<?= $row['c_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
        
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
                            <h3>Professional Memberships</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <form  action="<?= admin_base_url()?>model/doctorModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                    <input type="hidden" name="txt_doc_id" value="<?= $doc['doc_id']; ?>">
                                    <div class="col-sm-6 form-group">
                                        <label>Membership Name</label>
                                        <input type="text" name="txt_intrest" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Membership Name in Arabic</label>
                                        <input type="text" name="txt_intrest_arabic" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Professional Body Name</label>
                                        <input type="text" name="txt_prof_body" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Professional Body Name in Arabic</label>
                                        <input type="text" name="txt_prof_body_ar" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Country</label>
                                        <select name="txt_country" id="txt_country_mem" class="form-control" required>
                                            <option>Select Country</option>
                                            <?php
                                            $sql = query("SELECT * FROM tbl_country WHERE country_active = 1");
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
                                        <select name="txt_city" id="txt_city_mem" class="form-control" required>
                                            <option>Select City</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>From Year</label>
                                        <input type="month" name="txt_from_year" id="txt_from_year" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>To Year</label>
                                        <input type="month" name="txt_to_year" id="txt_to_year" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Logo of Proffessional body</label>
                                        <input type="file" name="mem_profile" class="form-control"  onchange="checkFileSize('mem_profile');" id="mem_profile">
                                        <label class="mem_profile"></label>
                                    </div>
                                    <div class="col-sm-12 reset-button">
                                        <input type="submit" name="btn_doc_membership" class="btn btn-success" value="Save">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Logo</th>
                                                <th>Membership</th>
                                                <th>Body Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <?php
                                            $sql = query("SELECT * FROM tbl_prof_mem WHERE prof_doc = ".$doc_id);
                                            while ($row = fetch($sql))
                                            {
                                                ?>
                                                <tr>
                                                    <td><img style="width:80px;height:80px" src="<?= file_url().$row['prof_logo'];?>"></td>
                                                    <td><?= $row['prof_name'];?></td>
                                                    <td><?= $row['prof_bodyname'];?></td>
                                                    <td>
                                                        <a href="<?= admin_base_url();?>model/doctorModel?act=del-member&member_id=<?= $row['prof_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                    
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
                            <h3>Qualification</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <form  action="<?= admin_base_url()?>model/doctorModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                    <input type="hidden" name="txt_doc_id" value="<?= $doc['doc_id']; ?>">
                                    <div class="col-sm-6 form-group">
                                        <label>Degree Name</label>
                                        <input type="text" name="txt_degree" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Degree Name in Arabic</label>
                                        <input type="text" name="txt_degree_ar" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Institute Name</label>
                                        <input type="text" name="txt_institute" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Institute Name in Arabic</label>
                                        <input type="text" name="txt_institute_ar" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Country</label>
                                        <select name="txt_country" id="txt_country_edu" class="form-control" required>
                                            <option>Select Country</option>
                                            <?php
                                            $sql = query("SELECT * FROM tbl_country WHERE country_active = 1");
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
                                        <select name="txt_city" id="txt_city_edu" class="form-control" required>
                                            <option>Select City</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label>Passing Year</label>
                                        <input type="month" name="txt_from_year" id="txt_year" class="form-control" required>
                                    </div>
                                    
                                    <div class="col-sm-6 form-group">
                                        <label>Logo of Institue</label>
                                        <input type="file" name="edu_profile" class="form-control"  onchange="checkFileSize('edu_profile');" id="edu_profile">
                                        <label class="edu_profile"></label>
                                    </div>
                                    <div class="col-sm-12 reset-button">
                                        <input type="submit" name="btn_doc_edu" class="btn btn-success" value="Save">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Logo</th>
                                                <th>Institute</th>
                                                <th>Degree</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <?php
                                            $sql = query("SELECT * FROM tbl_doc_education WHERE edu_doc = ".$doc_id);
                                            while ($row = fetch($sql))
                                            {
                                                ?>
                                                <tr>
                                                    <td><img style="width:80px;height:80px" src="<?= file_url().$row['edu_logo'];?>"></td>
                                                    <td><?= $row['edu_institute'];?></td>
                                                    <td><?= $row['edu_degree'];?></td>
                                                    <td>
                                                        <a href="<?= admin_base_url();?>model/doctorModel?act=del-edu&edu_id=<?= $row['edu_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                    
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
    ?>
</div>
<?php require_once('layout/footer.php');?>
<script src="<?= admin_base_url();?>assets/plugins/niceedit/nicEdit.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<?php
get_msg('msg');
?>
<script type="text/javascript">
    
    bkLib.onDomLoaded(function() {
        new nicEditor({fullPanel : true}).panelInstance('txt_short_desc');
		new nicEditor({fullPanel : true}).panelInstance('txt_short_desc_ar');
    });
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
	
	
	$(document).ready(function(){
	    $(".select2").select2();
	    $("#txt_country").change(function(){
	        var value = $(this).val();
	        var act = "getcities";
	        $.ajax({
	            data:{countryID: value, action:act},
	            url:"<?= admin_base_url(); ?>model/doctorModel",
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
	            url:"<?= admin_base_url(); ?>model/doctorModel",
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
	    $("#txt_country_loc").change(function(){
	        var value = $(this).val();
	        var act = "getcities";
	        $.ajax({
	            data:{countryID: value, action:act},
	            url:"<?= admin_base_url(); ?>model/doctorModel",
	            type:"post",
	            success:function(res)
	            {
	                var result = $.parseJSON(res);
	                $("#txt_city_loc").empty();
	                if(result.msg == "success")
	                {
	                    var data = result.data;
	                    $("#txt_city_loc").append("<option selected disabled>Select City</option>");
	                    $.each(data, function(index, value)
	                    {
	                        var li = '<option value="'+value.city_id+'">'+value.city_name+' - '+value.city_name_ar+'</option>';
	                        $("#txt_city_loc").append(li);
	                    });
	                }
	                else
	                {
	                    alert("No city found againt selected country");
	                }
	            }
	        });
	    });
	    $("#txt_city_loc").change(function(){
	        var value = $(this).val();
	        var act = "getarea";
	        $.ajax({
	            data:{cityID: value, action:act},
	            url:"<?= admin_base_url(); ?>model/doctorModel",
	            type:"post",
	            success:function(res)
	            {
	                
	                var result = $.parseJSON(res);
	                $("#txt_area_loc").empty();
	                if(result.msg == "success")
	                {
	                    var data = result.data;
	                    $("#txt_area_loc").append("<option selected disabled>Select Area</option>");
	                    $.each(data, function(index, value)
	                    {
	                        var li = '<option value="'+value.area_id+'">'+value.area_name+' - '+value.area_name_ar+'</option>';
	                        $("#txt_area_loc").append(li);
	                    });
	                }
	                else
	                {
	                    alert("No area found againt selected country");
	                }
	            }
	        });
	    });
	    $("#txt_speciality").change(function(){
	        var value = $(this).val();
	        var act = "getCondition";
	        $.ajax({
	            data:{speciality: value, action:act},
	            url:"<?= admin_base_url(); ?>model/doctorModel",
	            type:"post",
	            success:function(res)
	            {
	                
	                var result = $.parseJSON(res);
	                $("#txt_treatment").empty();
	                if(result.msg == "success")
	                {
	                    var data = result.data;
	                    $("#txt_treatment").append("<option selected disabled>Select Condition/Treatment</option>");
	                    $.each(data, function(index, value)
	                    {
	                        var li = '<option value="'+value.treatment_id+'">'+value.treatment_name+' - '+value.treatment_ar_name+'</option>';
	                        $("#txt_treatment").append(li);
	                    });
	                }
	                else
	                {
	                    alert("No area found againt selected country");
	                }
	            }
	        });
	    });
	    $("#txt_country_mem").change(function(){
	        var value = $(this).val();
	        var act = "getcities";
	        $.ajax({
	            data:{countryID: value, action:act},
	            url:"<?= admin_base_url(); ?>model/doctorModel",
	            type:"post",
	            success:function(res)
	            {
	                var result = $.parseJSON(res);
	                $("#txt_city_mem").empty();
	                if(result.msg == "success")
	                {
	                    var data = result.data;
	                    $("#txt_city_mem").append("<option selected disabled>Select City</option>");
	                    $.each(data, function(index, value)
	                    {
	                        var li = '<option value="'+value.city_id+'">'+value.city_name+' - '+value.city_name_ar+'</option>';
	                        $("#txt_city_mem").append(li);
	                    });
	                }
	                else
	                {
	                    alert("No city found againt selected country");
	                }
	            }
	        });
	    });
	    $("#txt_country_app").change(function(){
	        var value = $(this).val();
	        var act = "getcities";
	        $.ajax({
	            data:{countryID: value, action:act},
	            url:"<?= admin_base_url(); ?>model/doctorModel",
	            type:"post",
	            success:function(res)
	            {
	                var result = $.parseJSON(res);
	                $("#txt_city_app").empty();
	                if(result.msg == "success")
	                {
	                    var data = result.data;
	                    $("#txt_city_app").append("<option selected disabled>Select City</option>");
	                    $.each(data, function(index, value)
	                    {
	                        var li = '<option value="'+value.city_id+'">'+value.city_name+' - '+value.city_name_ar+'</option>';
	                        $("#txt_city_app").append(li);
	                    });
	                }
	                else
	                {
	                    alert("No city found againt selected country");
	                }
	            }
	        });
	    });
	    $("#txt_country_edu").change(function(){
	        var value = $(this).val();
	        var act = "getcities";
	        $.ajax({
	            data:{countryID: value, action:act},
	            url:"<?= admin_base_url(); ?>model/doctorModel",
	            type:"post",
	            success:function(res)
	            {
	                var result = $.parseJSON(res);
	                $("#txt_city_edu").empty();
	                if(result.msg == "success")
	                {
	                    var data = result.data;
	                    $("#txt_city_edu").append("<option selected disabled>Select City</option>");
	                    $.each(data, function(index, value)
	                    {
	                        var li = '<option value="'+value.city_id+'">'+value.city_name+' - '+value.city_name_ar+'</option>';
	                        $("#txt_city_edu").append(li);
	                    });
	                }
	                else
	                {
	                    alert("No city found againt selected country");
	                }
	            }
	        });
	    });
	    $("#txt_doc_slug").keyup(function(){
	        var value = $(this).val();
	        var act = "checkslug";
	        $.ajax({
	            data:{slug: value, action:act},
	            url:"<?= admin_base_url(); ?>model/doctorModel",
	            type:"post",
	            success:function(res)
	            {
	                if(res == "exist")
	                {
	                    alert("Sorry this URL is already taken");
	                    $("#txt_doc_slug").val("<?= $doc['doc_slug']; ?>");
	                }
	            }
	        });
	    });
	    $("#txt_end_cont").change(function(){
	        if($(this).val() == "cont")
	        {
	            $(".date").hide();
	            $(".date_end").attr('required','false');
	        }
	        else
	        {
	            $(".date").show();
	            $(".date_end").attr('required','true');
	        }
	    });
	    
	});
	
</script>