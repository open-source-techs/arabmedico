<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$candidate_id = get_sess("userdata")['candidate_id'];

$btn_name = "btn_save_service";
if(isset($_GET['serv_id']) && $_GET['serv_id'] != null && $_GET['serv_id'] != "" && $_GET['serv_id'] > 0)
{
    $srvId = $_GET['serv_id'];
    $sql = query("SELECT * FROM tbl_can_services where c_id = '$srvId'");
    $fetch = fetch($sql);
    $btn_name = "btn_edit_service";
}
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
                        <h3>Practice Location</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form  action="<?= admin_base_url()?>model/candidateModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                <input type="hidden" name="txt_doc_id" value="<?= $candidate_id; ?>">
                                <div class="col-sm-6 form-group">
                                    <label>Work Place Name</label>
                                    <input type="text" name="txt_name" class="form-control" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Work Place Name in Arabic</label>
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
                                    <select name="txt_city" id="txt_city_loc" class="form-control" required>
                                        <option>Select City</option>
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
                                        $sql = query("SELECT * FROM tbl_can_practice_loc pl JOIN tbl_candidate_country cn ON (pl.loc_country = cn.country_id) JOIN tbl_candidate_cities c ON (pl.loc_city = c.city_id) WHERE loc_can_id = ".$candidate_id);
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <tr>
                                                <td><b><?= $row['loc_name'];?></b>, <?= $row['loc_address'];?>, <?= $row['country_name'];?>, <?= $row['city_name'];?></td>
                                                <td><?= $row['loc_email'];?></td>
                                                <td><?= $row['loc_number'];?></td>
                                                <td>
                                                    <a href="<?= admin_base_url();?>model/candidateModel?act=del-loc&loc_id=<?= $row['loc_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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
                            <form  action="<?= admin_base_url()?>model/candidateModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                <input type="hidden" name="txt_doc_id" value="<?= $candidate_id; ?>">
                                <div class="col-sm-6 form-group">
                                    <label>Specialty</label>
                                    <select name="txt_speciality" class="form-control" required>
                                        <option value="" disabled selected>----Select Speciality----</option>
                                        <?php
                                        $sql = query('SELECT * FROM tbl_candiate_speciality WHERE can_speciality_active = 1');
                                        while($spc = fetch($sql))
                                        {
                                            ?>
                                            <option value="<?= $spc['can_speciality_id']; ?>"><?= $spc['can_speciality_name'];?> - <?= $spc['can_speciality_name_ar'];?></option>
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
                                        $sql = query("SELECT * FROM tbl_can_speciality dc JOIN tbl_candiate_speciality sp ON (dc.can_speciality = sp.can_speciality_id) WHERE dc.can_spec_can = ".$candidate_id);
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $row['can_speciality_name'];?></td>
                                                <td>
                                                    <a href="<?= admin_base_url();?>model/candidateModel?act=del-speciality&speciality=<?= $row['can_spec_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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
                        <h3>Core Skills</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form  action="<?= admin_base_url()?>model/candidateModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                <input type="hidden" name="txt_can_id" value="<?= $candidate_id; ?>">
                                <div class="col-sm-6 form-group">
                                    <label>Specialty</label>
                                    <select name="txt_speciality" id="txt_speciality" class="form-control" required>
                                        <option value="" disabled selected>----Select Speciality----</option>
                                        <?php
                                        $sql = query('SELECT * FROM tbl_candiate_speciality WHERE can_speciality_active = 1');
                                        while($spc = fetch($sql))
                                        {
                                            ?>
                                            <option value="<?= $spc['can_speciality_id']; ?>"><?= $spc['can_speciality_name'];?> - <?= $spc['can_speciality_name_ar'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Core Skill</label>
                                    <select name="txt_coreskill" id="txt_coreskill" class="form-control" required></select>
                                </div>
                                <div class="col-sm-12 reset-button">
                                    <input type="submit" name="btn_skill" class="btn btn-success" value="Save">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Speciality</th>
                                            <th>Core Skill</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        $sql = query("SELECT * FROM tbl_can_coreskill ck JOIN tbl_candiate_speciality cp ON (ck.can_skill_speciality = cp.can_speciality_id) JOIN tbl_candidate_coreskill cck ON (cck.core_id = ck.can_skill) WHERE can_skill_can = ".$candidate_id);
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $row['can_speciality_name'];?></td>
                                                <td><?= $row['core_name'];?></td>
                                                <td>
                                                    <a href="<?= admin_base_url();?>model/candidateModel?act=del-core&core_id=<?= $row['can_skill_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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
                            <form  action="<?= admin_base_url()?>model/candidateModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                <input type="hidden" name="txt_doc_id" value="<?= $candidate_id; ?>">
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
                                        $sql = query("SELECT * FROM tbl_can_institue WHERE institute_can = ".$candidate_id);
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $row['institute_name'];?></td>
                                                <td>
                                                    <a href="<?= admin_base_url();?>model/candidateModel?act=del-institute&institute_id=<?= $row['institute_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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
                        <h3>Current Posting</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form  action="<?= admin_base_url()?>model/candidateModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                <input type="hidden" name="txt_doc_id" value="<?= $candidate_id; ?>">
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
                                        $sql = query("SELECT * FROM tbl_can_appoint WHERE app_appoint_can = ".$candidate_id);
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <tr>
                                                <td><img src="<?= file_url().$row['app_hospLogo'];?>" style="height:80px;width:80px;" ></td>
                                                <td><?= $row['app_appoint_title'];?></td>
                                                <td><?= $row['app_hospName'];?></td>
                                                <td>
                                                    <a href="<?= admin_base_url();?>model/candidateModel?act=del-appoint&appoint_id=<?= $row['app_appoint_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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
                            <h3>Manage Services</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <form  action="<?= admin_base_url()?>model/candidateModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                <input type="hidden" name="txt_doc_id" value="<?= $candidate_id; ?>">
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
                                        $sql = query("SELECT * FROM tbl_can_services where c_can_id = '$candidate_id'");
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
                                                    <a href="<?= admin_base_url();?>model/candidateModel?act=del-serv&serv_id=<?= $row['c_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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
                            <form  action="<?= admin_base_url()?>model/candidateModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                <input type="hidden" name="txt_doc_id" value="<?= $candidate_id; ?>">
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
                                        $sql = query("SELECT * FROM tbl_can_prof_mem WHERE prof_can = ".$candidate_id);
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <tr>
                                                <td><img style="width:80px;height:80px" src="<?= file_url().$row['prof_logo'];?>"></td>
                                                <td><?= $row['prof_name'];?></td>
                                                <td><?= $row['prof_bodyname'];?></td>
                                                <td>
                                                    <a href="<?= admin_base_url();?>model/candidateModel?act=del-member&member_id=<?= $row['prof_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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
                            <form  action="<?= admin_base_url()?>model/candidateModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                <input type="hidden" name="txt_doc_id" value="<?= $candidate_id; ?>">
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
                                        $sql = query("SELECT * FROM tbl_can_education WHERE edu_can = ".$candidate_id);
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <tr>
                                                <td><img style="width:80px;height:80px" src="<?= file_url().$row['edu_logo'];?>"></td>
                                                <td><?= $row['edu_institute'];?></td>
                                                <td><?= $row['edu_degree'];?></td>
                                                <td>
                                                    <a href="<?= admin_base_url();?>model/candidateModel?act=del-edu&edu_id=<?= $row['edu_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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
	    $("#txt_city").change(function(){
	        var value = $(this).val();
	        var act = "getarea";
	        $.ajax({
	            data:{cityID: value, action:act},
	            url:"<?= admin_base_url(); ?>model/candidateModel",
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
	            url:"<?= admin_base_url(); ?>model/candidateModel",
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
	    $("#txt_speciality").change(function(){
	        var value = $(this).val();
	        var act = "getCondition";
	        $.ajax({
	            data:{speciality: value, action:act},
	            url:"<?= admin_base_url(); ?>model/candidateModel",
	            type:"post",
	            success:function(res)
	            {
	                
	                var result = $.parseJSON(res);
	                $("#txt_coreskill").empty();
	                if(result.msg == "success")
	                {
	                    var data = result.data;
	                    $("#txt_coreskill").append("<option selected disabled>Select Condition/Treatment</option>");
	                    $.each(data, function(index, value)
	                    {
	                        var li = '<option value="'+value.core_id+'">'+value.core_name+' - '+value.core_name_ar+'</option>';
	                        $("#txt_coreskill").append(li);
	                    });
	                }
	                else
	                {
	                    alert("No skill found against selected speciality");
	                }
	            }
	        });
	    });
	    $("#txt_country_mem").change(function(){
	        var value = $(this).val();
	        var act = "getcities";
	        $.ajax({
	            data:{countryID: value, action:act},
	            url:"<?= admin_base_url(); ?>model/candidateModel",
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
	            url:"<?= admin_base_url(); ?>model/candidateModel",
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
	            url:"<?= admin_base_url(); ?>model/candidateModel",
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