<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php
$departsql = query("SELECT DISTINCT cme_depart FROM tbl_cme ORDER BY cme_depart ASC ");
$locationsql = query("SELECT DISTINCT cme_loc FROM tbl_cme ORDER BY cme_loc ASC ");

$depart_arab_sql = query("SELECT DISTINCT cme_ar_depart FROM tbl_cme ORDER BY cme_ar_depart ASC ");
$location_arab_sql = query("SELECT DISTINCT cme_ar_loc FROM tbl_cme ORDER BY cme_ar_loc ASC ");
?>
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
            <small>Add New CME</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add CME</li>
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
                            <div class="col-sm-6 form-group">
                                <label>CME Topic</label>
                                <input type="text" name="txt_cme_topic" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>CME Topic Arabic</label>
                                <input type="text" name="ar_cme_topic" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>CME Department</label>
                                <input type="text" name="txt_cme_depart" id="txt_cme_depart" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>CME Department Arabic</label>
                                <input type="text" name="txt_cme_depart_arabic" id="txt_cme_depart_arabic" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>CME Location</label>
                                <input type="text" name="txt_cme_loc" id="txt_cme_loc" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>CME Location Arabic</label>
                                <input type="text" id="ar_cme_loc" name="ar_cme_loc" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>CME Credits</label>
                                <input type="text" name="txt_credits" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>CME Credits in Arabic</label>
                                <input type="text" name="ar_credits" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Course Delivery</label>
                                <select class="form-control" name="cours_deli">
                                    <option value="online" class="form-control">Online</option>
                                    <option value="on site" class="form-control">On Site</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Course Delivery Arabic</label>
                                <select class="form-control " name="cours_deli_ar">
                                    <option value="عبر الانترنت" class="form-control">عبر الانترنت</option>
                                    <option value="بالموقع" class="form-control">بالموقع</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Time</label>
                                <input type="time" name="txt_time" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Delivery Date</label>
                                <input type="date" name="txt_date" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Duration</label>
                                <input type="text" name="txt_duration" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Arabic Duration</label>
                                <input type="text" name="ar_duration" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Closing Date</label>
                                <input type="date" name="closing_date" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>CME Icon</label>
                                <input type="file" name="txt_cme_icon" class="form-control" required>
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
                                        <option value="<?= $emp['org_id'];?>"><?= $emp['org_name'];?> - <?= $emp['org_name_ar'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>CME URL (https://arabmedico.com/....)</label>
                                <input type="text" name="txt_slug" class="form-control" required>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>CME Description</label>
                                <textarea name="txt_desc" rows="3" class="form-control" id="txt_desc"></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>CME Description Arabic</label>
                                <textarea name="ar_desc" rows="3" class="form-control" id="txt_short_desc"></textarea>
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
                                <a href="<?= admin_base_url();?>job-list" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_save_cme" class="btn btn-success" value="Save">
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
</script>