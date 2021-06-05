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
            <h1>Practice Loaction</h1>
            <small>Locations list</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">Locations</li>
            </ol>
        </div>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-success" href="<?= admin_base_url();?>add-location"> <i class="fa fa-plus"></i> Add Location
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="panel-header">
                                
                            </div>
                        </div>
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
                                    $sql = query("SELECT * FROM tbl_clinic_loc pl JOIN tbl_country cn ON (pl.loc_country = cn.country_id) JOIN tbl_cities c ON (pl.loc_city = c.city_id) JOIN tbl_areas a ON (pl.loc_area = a.area_id) WHERE loc_clinic_id = ".$clinic_id);
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><b><?= $row['loc_name'];?></b>, <?= $row['loc_address'];?>, <?= $row['country_name'];?>, <?= $row['city_name'];?>, <?= $row['area_name'];?></td>
                                            <td><?= $row['loc_email'];?></td>
                                            <td><?= $row['loc_number'];?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>edit-location?loc_id=<?= $row['loc_id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
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
    </section>
</div>
<?php require_once('layout/footer.php');?>
<?php
get_msg('msg');
?>