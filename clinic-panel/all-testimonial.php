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
            <h1>Testimonials</h1>
            <small>Testimonial list</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">Testimonials</li>
            </ol>
        </div>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-success" href="<?= admin_base_url();?>add-testimonial"> <i class="fa fa-plus"></i> Add Testimonial
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
                                        <th>Title</th>
                                        <th>Patient Name</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_clinic_testimonial WHERE testimonial_clinic = $clinic_id");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><img src="<?= file_url().$row['testimonial_image'];?>" style="width:50px;height:50px"></td>
                                            <td><?= $row['testimonial_title'];?></td>
                                            <td><?= $row['testimonial_username'];?></td>
                                            <td><?= ($row['testimonial_active'] == 1) ? 'Active' : "Not Active";?></td>
                                            <td><?= date("d/m/Y",strtotime($row['testimonial_created_at']));?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>edit-testimonial?tid=<?= $row['testimonial_id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?= admin_base_url();?>model/testimonialModel?act=del&tid=<?= $row['testimonial_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
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