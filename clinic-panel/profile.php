<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$clinic_id = get_sess("userdata")['clinic_id'];
if($clinic_id == 0 || $clinic_id == '' || $clinic_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_clinic where clinic_id = '$clinic_id'");
$clinic = fetch($sql);

?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Clinic Profile</h1>
            <small>Edit Profile</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">Edit Profile</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/adminUser" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" value="<?= $clinic_id; ?>" name="txt_clinicID">
                            <div class="col-sm-6 form-group">
                                <label>Name</label>
                                <input type="text" name="txt_clinic_name" class="form-control" value="<?= $clinic['clinic_name'];?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Name in Arabic</label>
                                <input type="text" name="txt_clinic_name_ar" class="form-control" value="<?= $clinic['clinic_name_ar'];?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Phone</label>
                                <input type="text" name="txt_clinic_phone" class="form-control" value="<?= $clinic['clinic_phone'];?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Icon (image only)</label>
                                <input type="file" name="txt_icon" class="form-control onChangeImg">
                                <label class="txt_icon"></label>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Address</label>
                                <textarea name="txt_clinic_address" class="form-control" required><?= $clinic['clinic_address'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Address in Arabic</label>
                                <textarea name="txt_clinic_address_ar" class="form-control" required><?= $clinic['clinic_address_ar'];?></textarea>
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
                                        <option <?= ($row['country_id'] == $clinic['clinic_country']) ? 'selected': '';?> value="<?= $row['country_id'];?>"><?= $row['country_name'];?> - <?= $row['country_name_ar'];?></option>
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
                                    $sql = query("SELECT * FROM tbl_cities WHERE city_country = ".$clinic['clinic_country']);
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <option <?= ($row['city_id'] == $clinic['clinic_city']) ? 'selected': '';?> value="<?= $row['city_id'];?>"><?= $row['city_name'];?> - <?= $row['city_name_ar'];?></option>
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
                                    $sql = query("SELECT * FROM tbl_areas WHERE area_city = ".$clinic['clinic_city']);
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <option <?= ($row['area_id'] == $clinic['clinic_area']) ? 'selected': '';?> value="<?= $row['area_id'];?>"><?= $row['area_name'];?> - <?= $row['area_name_ar'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="col-sm-6 form-group">
                                <label>Website URL</label>
                                <input type="text" name="txt_clinic_url" class="form-control" value="<?= $clinic['clinic_url'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Facebook URL</label>
                                <input type="text" name="txt_fb_url" class="form-control" value="<?= $clinic['clinic_facebook'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Instagram URL</label>
                                <input type="text" name="txt_insta_url" class="form-control" value="<?= $clinic['clinic_instagram'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Youtube URL</label>
                                <input type="text" name="txt_yt_url" class="form-control" value="<?= $clinic['clinic_youtube'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Linkedin URL</label>
                                <input type="text" name="txt_linked_url" class="form-control" value="<?= $clinic['clinic_linkedin'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Twitter URL</label>
                                <input type="text" name="txt_twitter_url" class="form-control" value="<?= $clinic['clinic_twitter'];?>">
                            </div>
                            <div class="col-sm-12 reset-button">
                                <input type="submit" name="btn_profile" class="btn btn-success" value="Save">
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
<?php
get_msg('msg');
?>
<script>
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
</script>