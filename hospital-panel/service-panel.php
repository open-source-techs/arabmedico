<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$hospital_id = get_sess("userdata")['hospital_id'];
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>Services Panel</h1>
            <small>Services list</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">hospitalal Services</li>
            </ol>
        </div>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-success" href="<?= admin_base_url();?>add-service"> <i class="fa fa-plus"></i> Add New Item
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
                                        <th>Images</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_hospital_service WHERE dpt_hospital_id = '$hospital_id'");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                $ext = pathinfo($row['dpt_service_img'], PATHINFO_EXTENSION);
                							    if($ext == "jpeg" || $ext == "jpg" || $ext == "png" || $ext == "gif" || $ext == "jfif")
                							    {
                							        ?>
                    								<img class="img-fluid" src="<?= file_url().$row['dpt_service_img'];?>" alt="tab-image" style="width:auto;height:150px" />
                							        <?php
                							    }
                							    else if($ext == "webm" || $ext == "mpg" || $ext == "mp2" || $ext == "mpeg" || $ext == "mpv" || $ext == "mp4" || $ext == "ogg")
                							    {
                							        ?>
                									<video controls id="myvid" style="width:auto;height:150px">
                                                        <source src="<?= file_url().$row['dpt_service_img'];?>" type="video/<?= $ext;?>">
                                                    </video>
                							        <?php
                							    }
                                                ?>
                                            </td>
                                            <td><?= $row['dpt_service_title'];?></td>
                                            <td><?= ($row['dpt_service_active'] == 1) ? 'Active' : "Not Active";?></td>
                                            <td><?= date("d/m/Y",strtotime($row['dpt_service_created']));?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>edit-service?service=<?= $row['dpt_service_id'];?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?= admin_base_url();?>model/departmentModel?act=del-dpt-ser&service=<?= $row['dpt_service_id'];?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
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