<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>Organization</h1>
            <small>Organization list</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">Organization</li>
            </ol>
        </div>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-success" href="<?= admin_base_url();?>add-organization"> <i class="fa fa-plus"></i> Add Organization
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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_organization o JOIN tbl_country c ON (o.organization_country = c.country_id) JOIN tbl_cities ci ON (ci.city_id = o.organization_city) JOIN tbl_areas a ON (a.area_id = o.organization_area)");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><img style="width:auto;height:50px" src="<?= file_url().$row['organization_icon'];?>" > </td>
                                            <td><?= $row['organization_name'];?></td>
                                            <td><?= $row['organization_phone'];?></td>
                                            <td><?= $row['organization_address'] . ", " . $row['area_name'] . ", " . $row['city_name'] . ", " . $row['country_name'];?></td>
                                            <td><?= ($row['organization_active'] == 1) ? 'Active' : "Not Active";?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>edit-organization?org_id=<?= $row['organization_id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?= admin_base_url();?>model/organizationModel?act=del&org_id=<?= $row['organization_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
                                                </a>
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