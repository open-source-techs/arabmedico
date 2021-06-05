<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$city_id = $_GET['city_id'];
if($city_id == 0 || $city_id == '' || $city_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>list-city";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_cities where city_id = '$city_id'");
$city = fetch($sql);
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
            <h1>city</h1>
            <small>Edit city</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Edit city</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>list-city"> <i class="fa fa-list"></i> city List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/locationModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" name="city_id" value="<?= $city['city_id'];?>">
                            <div class="col-sm-6 form-group">
                                <label>City Name</label>
                                <input type="text" name="city_name" value="<?= $city['city_name'];?>" class="form-control" placeholder="Enter city Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>City Name Arabic</label>
                                <input type="text" name="city_name_ar" value="<?= $city['city_name_ar'];?>" class="form-control" placeholder="Enter city Name Arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select country</label>
                                <select name="select_country" class="form-control select2" required>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_country WHERE country_active = 1");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <option <?=($city['city_country'] == $row['country_id'])? 'selected' : ''?> value="<?= $row['country_id'];?>"><?= $row['country_name'];?></option>
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
                                <a href="<?= admin_base_url();?>list-city" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit_city" class="btn btn-success" value="Save">
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