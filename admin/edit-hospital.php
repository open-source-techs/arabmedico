<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$hospital_id = $_GET['hospital_id'];
if($hospital_id == 0 || $hospital_id == '' || $hospital_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>list-city";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_hospital where hospital_id = '$hospital_id'");
$hospital = fetch($sql);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Hospital</h1>
            <small>Edit Hospital</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Edit Hospital</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>all-hospital"> <i class="fa fa-list"></i> Hospital List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/hospitalModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" name="hospital_id" value="<?= $hospital['hospital_id'];?>">
                            <div class="col-sm-6 form-group">
                                <label>Name</label>
                                <input type="text" name="txt_hospital_name" class="form-control" value="<?= $hospital['hospital_name'];?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Name in Arabic</label>
                                <input type="text" name="txt_hospital_name_ar" class="form-control" value="<?= $hospital['hospital_name_ar'];?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Phone</label>
                                <input type="text" name="txt_hospital_phone" class="form-control" value="<?= $hospital['hospital_phone'];?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Icon (image only)</label>
                                <input type="file" name="txt_icon" class="form-control onChangeImg">
                                <label class="txt_icon"></label>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Address</label>
                                <textarea name="txt_hospital_address" class="form-control" required><?= $hospital['hospital_address'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Address in Arabic</label>
                                <textarea name="txt_hospital_address_ar" class="form-control" required><?= $hospital['hospital_address_ar'];?></textarea>
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
                                        <option <?= ($row['country_id'] == $hospital['hospital_country']) ? 'selected': '';?> value="<?= $row['country_id'];?>"><?= $row['country_name'];?> - <?= $row['country_name_ar'];?></option>
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
                                    $sql = query("SELECT * FROM tbl_cities WHERE city_country = ".$hospital['hospital_country']);
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <option <?= ($row['city_id'] == $hospital['hospital_city']) ? 'selected': '';?> value="<?= $row['city_id'];?>"><?= $row['city_name'];?> - <?= $row['city_name_ar'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Area</label>
                                <select name="txt_area" id="txt_area" class="form-control" required>
                                    <option>Select Area</option>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_areas WHERE area_city = ".$hospital['hospital_city']);
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <option <?= ($row['area_id'] == $hospital['hospital_area']) ? 'selected': '';?> value="<?= $row['area_id'];?>"><?= $row['area_name'];?> - <?= $row['area_name_ar'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="col-sm-6 form-group">
                                <label>Website URL</label>
                                <input type="text" name="txt_hospital_url" class="form-control" value="<?= $hospital['hospital_url'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Facebook URL</label>
                                <input type="text" name="txt_fb_url" class="form-control" value="<?= $hospital['hospital_facebook'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Instagram URL</label>
                                <input type="text" name="txt_insta_url" class="form-control" value="<?= $hospital['hospital_instagram'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Youtube URL</label>
                                <input type="text" name="txt_yt_url" class="form-control" value="<?= $hospital['hospital_youtube'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Linkedin URL</label>
                                <input type="text" name="txt_linked_url" class="form-control" value="<?= $hospital['hospital_linkedin'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Twitter URL</label>
                                <input type="text" name="txt_twitter_url" class="form-control" value="<?= $hospital['hospital_twitter'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Clinic URL (https://arabmedico.com/.....)</label>
                                <input type="hidden" name="previous_slug" value="<?= $hospital['hospital_slug'];?>">
                                <input type="text" name="txt_hospital_url" class="form-control" value="<?= $hospital['hospital_slug'];?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Title</label>
                                <input type="text" name="txt_meta_title" value="<?= $hospital['hospital_twitter'];?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Title for arabic</label>
                                <input type="text" name="txt_meta_title_ar" value="<?= $hospital['hospital_twitter'];?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Tags</label>
                                <textarea name="txt_tag" rows="3" class="form-control"><?= $hospital['hospital_twitter'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Tags for Arabic</label>
                                <textarea name="txt_tag_ar" rows="3" class="form-control"><?= $hospital['hospital_twitter'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Description</label>
                                <textarea name="txt_meta_desc" rows="3" class="form-control"><?= $hospital['hospital_twitter'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Description for Arabic</label>
                                <textarea name="txt_meta_desc_ar" rows="3" class="form-control"><?= $hospital['hospital_twitter'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Status</label>
                                <select name="txt_status" class="form-control select2" required>
                                    <option value="1" <?= ($hospital['hospital_active'] == 1 ) ? 'selected' : ''; ?>>Active</option>
                                    <option value="0" <?= ($hospital['hospital_active'] == 0 ) ? 'selected' : ''; ?>>Unactive</option>
                                </select>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>all-hospital" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit_hospital" class="btn btn-success" value="Save">
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
                        <div class="btn-group"></div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/hospitalModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" name="hospital_id" value="<?= $hospital['hospital_id'];?>">
                            <div class="col-sm-6 form-group">
                                <label>Username</label>
                                <input type="text" name="txt_username" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Password</label>
                                <input type="text" name="txt_password" class="form-control">
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>all-hospital" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_username" class="btn btn-success" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php require_once('layout/footer.php');?>
<?php
get_msg('msg');
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#txt_country").change(function(){
	        var value = $(this).val();
	        var act = "getcities";
	        $.ajax({
	            data:{countryID: value, action:act},
	            url:"<?= admin_base_url(); ?>model/hospitalModel",
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
	            url:"<?= admin_base_url(); ?>model/hospitalModel",
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