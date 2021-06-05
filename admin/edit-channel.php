<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$chn_id = $_GET['chn_id'];
if($chn_id == 0 || $chn_id == '' || $chn_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>all-channel";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_channel where chn_id = '$chn_id'");
$chn = fetch($sql);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">  
            <h1>Channel</h1>
            <small>Edit Channel</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Edit Channel</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>all-channel"> <i class="fa fa-list"></i> Channel List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/channelModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Channel Name</label>
                                <input type="text" name="txt_name" class="form-control" value="<?= $chn['chn_name'];?>" required>
                                <input type="hidden" name="txt_chn_id" value="<?= $chn['chn_id'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Channel Name in Arabic</label>
                                <input type="text" name="txt_name_arabic" value="<?= $chn['chn_name_arabic'];?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>User's Name (Person / Institution)</label>
                                <input type="text" name="txt_user_name" value="<?= $chn['channel_user_name'];?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>User's Name (Person / Institution) in Arabic</label>
                                <input type="text" name="txt_user_name_arabic" value="<?= $chn['channel_username_ar'];?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Degree Title</label>
                                <input type="text" name="txt_degree" value="<?= $chn['chn_degree'];?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Degree Title in Arabic</label>
                                <input type="text" name="txt_degree_arabic" value="<?= $chn['chn_degree_ar'];?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job Title</label>
                                <input type="text" name="txt_job" value="<?= $chn['chn_job_title'];?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Job Title in Arabic</label>
                                <input type="text" name="txt_job_arabic" value="<?= $chn['chn_job_title_ar'];?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Institue</label>
                                <input type="text" name="txt_institue" value="<?= $chn['chn_institue'];?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Institue in Arabic</label>
                                <input type="text" name="txt_institute_arabic" value="<?= $chn['chn_institue_ar'];?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Department</label>
                                <select name="txt_depart" class="form-control select2">
                                    <option>Select Department</option>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_department WHERE dpt_active = 1");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <option value="<?= $row['dpt_id'];?>" <?= ($row['dpt_id'] == $chn['chn_department']) ? 'selected' : ''; ?> ><?= $row['dpt_name'];?></option>
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
                                        <option value="<?= $row['country_id'];?>" <?= ($row['country_id'] == $chn['chn_country']) ? 'selected' : ''; ?> ><?= $row['country_name'];?> - <?= $row['country_name_ar'];?></option>
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
                                    $sql = query("SELECT * FROM tbl_cities WHERE city_active = 1 AND city_country = ". $chn['chn_country'] );
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <option value="<?= $row['city_id'];?>" <?= ($row['city_id'] == $chn['chn_city']) ? 'selected' : ''; ?> ><?= $row['city_name'];?> - <?= $row['city_name_ar'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Location</label>
                                <select name="txt_area" id="txt_area" class="form-control" required>
                                    <option>Select Location</option>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_areas WHERE area_active = 1 AND area_city = ". $chn['chn_city'] );
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <option value="<?= $row['area_id'];?>" <?= ($row['area_id'] == $chn['chn_location']) ? 'selected' : ''; ?> ><?= $row['area_name'];?> - <?= $row['area_name_ar'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Channel URL (https://arabmedico.com/....)</label>
                                <input type="text" name="txt_chan_url" class="form-control" value="<?= $chn['chn_slug'];?>" required>
                                <input type="hidden" name="previous_slug" value="<?= $chn['chn_slug'];?>">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Channel icon (image only)</label>
                                <input type="file" name="txt_icon"  class="form-control onChangeImg">
                                <label class="txt_icon"></label>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Handlers Image (image only)</label>
                                <input type="file" name="txt_handler" id="txt_handler" class="form-control onChangeImg">
                                <label class="txt_handler"></label>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Short Description</label>
                                <textarea name="txt_short_desc" rows="3" class="form-control" id="txt_desc"><?= $chn['chn_short_desc'];?></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Short Description in Arabic</label>
                                <textarea name="txt_short_desc_arabic" rows="3" class="form-control" id="txt_desc_arabic"><?= $chn['chn_short_desc_arabic'];?></textarea>
                            </div>
                            <div class="col-sm-12 form-group" style="display:none">
                                <label>Detail Description</label>
                                <textarea name="txt_desc" rows="6" class="form-control editor1"></textarea>
                            </div>
                            <div class="col-sm-12 form-group" style="display:none">
                                <label>Detail Description in Arabic</label>
                                <textarea name="txt_desc_arabic" rows="6" class="form-control" id="txt_desc_detail_arabic"></textarea>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>all-channel" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit_chn" class="btn btn-success" value="Save">
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
<script type="text/javascript">
var area1, area2, area3, area4;
	$(document).ready(function(){
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
    function toggleArea1()
    {
        if(!area1)
        {
            area1 = new nicEditor({fullPanel : true}).panelInstance('txt_desc_arabic',{hasPanel : true});
        }
        else
        {
            area1.removeInstance('txt_desc_arabic');
            area1 = null;
        }
    }
    
    function toggleArea2()
    {
        if(!area2)
        {
            area2 = new nicEditor({fullPanel : true}).panelInstance('txt_desc_detail_arabic',{hasPanel : true});
        }
        else
        {
            area2.removeInstance('txt_desc_detail_arabic');
            area2 = null;
        }
    }
    
    function toggleArea3()
    {
        if(!area3)
        {
            area3 = new nicEditor({fullPanel : true}).panelInstance('txt_desc',{hasPanel : true});
        }
        else
        {
            area3.removeInstance('txt_desc');
            area3 = null;
        }
    }
    
    function toggleArea4()
    {
        if(!area4)
        {
            area4 = new nicEditor({fullPanel : true}).panelInstance('txt_desc_detail',{hasPanel : true});
        }
        else
        {
            area4.removeInstance('txt_desc_detail');
            area4 = null;
        }
    }
    bkLib.onDomLoaded(function() { toggleArea1(); toggleArea2(); toggleArea3(); toggleArea4(); });
</script>