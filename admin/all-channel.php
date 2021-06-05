<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>Channels</h1>
            <small>Channels list</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">Channels</li>
            </ol>
        </div>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-success" href="<?= admin_base_url();?>add-channel"> <i class="fa fa-plus"></i> Add Channel
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
                                        <th>More Info</th>
                                        <th>Icon</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_channel");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td>
                                                <a class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Video Panel" href="<?= admin_base_url();?>chn-video-panel?chn_id=<?= $row['chn_id']; ?>">
                                                    <i class="fa fa-video-camera"></i>
                                                </a>
                                            </td>
                                            <td><img style="width:auto;height:50px" src="<?= file_url().$row['chn_icon_name'];?>" > </td>
                                            <td><?= $row['chn_name'];?></td>
                                            <td><?= ($row['chn_active'] == 1) ? 'Active' : "Not Active";?></td>
                                            <td><?= date("d/m/Y",strtotime($row['chn_created_at']));?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>edit-channel?chn_id=<?= $row['chn_id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?= admin_base_url();?>model/channelModel?act=del&chn_id=<?= $row['chn_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="page-nation text-right">
                            <ul class="pagination pagination-large">
                                <li class="disabled"><span>«</span></li>
                                <li class="active"><span>1</span></li>
                                <li><a href="#">2</a></li>
                                <li class="disabled"><span>...</span></li><li>
                                <li><a rel="next" href="#">Next</a></li>
                            </ul>
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