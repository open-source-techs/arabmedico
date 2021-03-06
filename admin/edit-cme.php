<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$cme_id = $_GET['cme_id'];
if($cme_id == 0 || $cme_id == '' || $cme_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>list-cme";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_cme where id = '$cme_id'");
$cme = fetch($sql);

$departsql = query("SELECT DISTINCT cme_depart FROM tbl_cme ORDER BY cme_depart ASC ");
$locationsql = query("SELECT DISTINCT cme_loc FROM tbl_cme ORDER BY cme_loc ASC ");
$depart_arab_sql = query("SELECT DISTINCT cme_ar_depart FROM tbl_cme ORDER BY cme_ar_depart ASC ");
$location_arab_sql = query("SELECT DISTINCT cme_ar_loc FROM tbl_cme ORDER BY cme_ar_loc ASC ");

?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
            <h1>CME</h1>
            <small>Edit CME</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Edit CME</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>list-cme"> <i class="fa fa-list"></i> CME List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/cmeModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" name="txt_cme_id" value="<?= $cme['id'];?>">
                            <div class="col-sm-6 form-group">
                                <label>CME Topic</label>
                                <input type="text" name="txt_cme_topic" value="<?= $cme['cme_topic'];?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>CME Topic Arabic</label>
                                <input type="text" name="ar_cme_topic" value="<?= $cme['cme_ar_topic'];?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>CME Department</label>
                                <input type="text" name="txt_cme_depart" value="<?= $cme['cme_depart'];?>" id="txt_cme_depart" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>CME Department Arabic</label>
                                <input type="text" name="txt_cme_depart_arabic" value="<?= $cme['cme_ar_depart'];?>" id="txt_cme_depart_arabic" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>CME Location</label>
                                <input type="text" name="txt_cme_loc" value="<?= $cme['cme_loc'];?>" id="txt_cme_loc" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>CME Location Arabic</label>
                                <input type="text" id="ar_cme_loc" value="<?= $cme['cme_ar_loc'];?>" name="ar_cme_loc" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>CME Credits</label>
                                <input type="text" name="txt_credits" value="<?= $cme['cme_credits'];?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>CME Credits in Arabic</label>
                                <input type="text" name="ar_credits" value="<?= $cme['cme_ar_credits'];?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Course Delivery</label>
                                <select class="form-control" name="cours_deli">
                                    <option <?= ($cme['cme_delivery'] == "online") ? 'selected' : ''; ?> value="online" class="form-control">Online</option>
                                    <option <?= ($cme['cme_delivery'] == "on site") ? 'selected' : ''; ?> value="on site" class="form-control">On Site</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Course Delivery Arabic</label>
                                <select class="form-control " name="cours_deli_ar">
                                    <option <?= ($cme['cme_ar_delivery'] == "?????? ????????????????") ? 'selected' : ''; ?> value="?????? ????????????????" class="form-control">?????? ????????????????</option>
                                    <option <?= ($cme['cme_ar_delivery'] == "??????????????") ? 'selected' : ''; ?> value="??????????????" class="form-control">??????????????</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Time</label>
                                <input type="time" name="txt_time" value="<?= $cme['cme_time'];?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Delivery Date</label>
                                <input type="date" name="txt_date" value="<?= $cme['cme_date'];?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Duration</label>
                                <input type="text" name="txt_duration" value="<?= $cme['cme_duration'];?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Arabic Duration</label>
                                <input type="text" name="ar_duration" value="<?= $cme['cme_ar_duration'];?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Closing Date</label>
                                <input type="date" name="closing_date" value="<?= $cme['close_date'];?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>CME Icon</label>
                                <input type="file" name="txt_cme_icon" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Organizer</label>
                                <select class="form-control" name="txt_organizer">
                                    <option value="0">No Organizer</option>
                                    <?php
                                    $sql_emp = query("SELECT * FROM tbl_organizer");
                                    while($emp = fetch($sql_emp))
                                    {
                                        ?>
                                         <option <?= ($cme['cme_organizer'] == $emp['org_id']) ? 'selected' : ''; ?> value="<?= $emp['org_id'];?>"><?= $emp['org_name'];?> - <?= $emp['org_name_ar'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Course URL (https://arabmedico.com/....)</label>
                                <input type="hidden" value="<?= $cme['cme_slug'];?>" name="previous_slug">
                                <input type="text" name="txt_dpt_url" class="form-control" value="<?= $cme['cme_slug'];?>">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>CME Description</label>
                                <textarea name="txt_desc" rows="3" class="form-control" id="txt_desc"><?= $cme['cme_des'];?></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>CME Description Arabic</label>
                                <textarea name="ar_desc" rows="3" class="form-control" id="txt_short_desc"><?= $cme['cme_ar_des'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Title</label>
                                <input type="text" name="txt_meta_title" value="<?= $cme['cme_meta_title'];?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Title for arabic</label>
                                <input type="text" name="txt_meta_title_ar" value="<?= $cme['cme_meta_title_ar'];?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Tags</label>
                                <textarea name="txt_tag" rows="3" class="form-control"><?= $cme['cme_meta_tag'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Tags for Arabic</label>
                                <textarea name="txt_tag_ar" rows="3" class="form-control"><?= $cme['cme_meta_tag_ar'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Description</label>
                                <textarea name="txt_meta_desc" rows="3" class="form-control"><?= $cme['cme_meta_desc'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Description for Arabic</label>
                                <textarea name="txt_meta_desc_ar" rows="3" class="form-control"><?= $cme['cme_meta_desc_ar'];?></textarea>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>list-cme" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit_cme" class="btn btn-success" value="Save">
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
    
    $(document).ready(function(){
        var depart = [
            <?php
            while($depart = fetch($departsql))
            {
                echo '"'.$depart['cme_depart'].'",';
            }
            ?>
        ];
        var location = [
            <?php
            while($location = fetch($locationsql))
            {
                echo '"'.$location['cme_loc'].'",';
            }
            ?>
        ];
        
        var depart_arab = [
            <?php
            while($depart_arab = fetch($depart_arab_sql))
            {
                echo '"'.$depart_arab['cme_ar_depart'].'",';
            }
            ?>
        ];
        var location_arab = [
            <?php
            while($location_arab = fetch($location_arab_sql))
            {
                echo '"'.$location_arab['cme_ar_loc'].'",';
            }
            ?>
        ];
        
        $( "#txt_cme_depart" ).autocomplete({
            source: depart
        });
        $( "#txt_cme_loc" ).autocomplete({
            source: location
        });
        
        $( "#ar_cme_loc" ).autocomplete({
            source: depart_arab
        });
        $( "#txt_cme_depart_arabic" ).autocomplete({
            source: location_arab
        });
    });
    
    
	var area1, area2;
    
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
    bkLib.onDomLoaded(function() { toggleArea1(); toggleArea2(); });
	$(document).ready(function(){
	    $(".select2").select2();
	});
</script>