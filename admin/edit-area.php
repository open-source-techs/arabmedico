<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$area_id = $_GET['area_id'];
if($area_id == 0 || $area_id == '' || $area_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>list-area";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_areas where area_id = '$area_id'");
$area = fetch($sql);
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
            <h1>Area</h1>
            <small>Edit Area</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Edit Area</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>list-area"> <i class="fa fa-list"></i> Area List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/locationModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" name="area_id" value="<?= $area['area_id'];?>">
                            <div class="col-sm-6 form-group">
                                <label>Area Name</label>
                                <input type="text" name="area_name" value="<?= $area['area_name'];?>" class="form-control" placeholder="Enter Area Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Area Name Arabic</label>
                                <input type="text" name="area_name_ar" value="<?= $area['area_name_ar'];?>" class="form-control" placeholder="Enter Area Name Arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select City</label>
                                
                                <select name="select_city" class="form-control select2" required >
                                    <?php
                                    $sql = query("SELECT * FROM tbl_cities WHERE city_active = 1");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <option <?=($city['city_country'] == $row['city_id'])?"selected" : '' ?> value="<?= $row['city_id'];?>"><?= $row['city_name'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Status</label>
                                <select name="select_status" class="form-control select2" required>
                                    <option value="1">Active</option>
                                    <option value="0">Unactive</option>
                                </select>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>list-area" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit_area" class="btn btn-success" value="Save">
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
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>