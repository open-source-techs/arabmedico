<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$org_id = get_sess("userdata")['organization_id'];
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>News</h1>
            <small>News list</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">News</li>
            </ol>
        </div>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-success" href="<?= admin_base_url();?>add-news"> <i class="fa fa-plus"></i> Add News
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
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_news n LEFT JOIN tbl_department d ON (d.dpt_id = n.news_category) WHERE news_user_type = 'organizations' AND news_user_id = '$org_id' ");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><img style="width:auto;height:50px" src="<?= file_url().$row['news_image'];?>" > </td>
                                            <td><?= $row['news_title'];?></td>
                                            <td><?= $row['dpt_name'];?></td>
                                            <td><?= ($row['news_active'] == 1) ? 'Active' : "Not Active";?></td>
                                            <td><?= date("d/m/Y",strtotime($row['news_created_at']));?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>edit-news?news_id=<?= $row['news_id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?= admin_base_url();?>model/newsModel?act=del&news_id=<?= $row['news_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
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