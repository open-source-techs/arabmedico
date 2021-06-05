<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$clinic_id = get_sess("userdata")['clinic_id'];
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>Doctor Panel</h1>
            <small>Add Doctor</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">Add Doctor</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>all-location"> <i class="fa fa-list"></i> Location List </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/doctorModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" value="<?= $clinic_id; ?>" name="clinic_id">
                            <div class="col-sm-6 form-group">
                                <label>Location Name</label>
                                <input type="text" name="txt_name" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Location Name in Arabic</label>
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
                                <a href="<?= admin_base_url();?>all-location" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_add_location" class="btn btn-success" value="Save">
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
<script>
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
</script>