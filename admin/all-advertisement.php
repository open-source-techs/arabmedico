<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Advertisement</h1>
            <small>All Advertisement</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">All Advertisement</li>
            </ol>
        </div>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-success" href="<?= admin_base_url();?>add-advertisement"> <i class="fa fa-plus"></i> Add Advertisement
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
                                        <th>Sr#</th>
                                        <th>Poster</th>
                                        <th>Video</th>
                                        <th>Display Location</th>
                                        <th>Activation Date</th>
                                        <th>Display Duration</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_advertisment");
                                    $i = 0;
                                    while ($row = fetch($sql))
                                    {
                                        $i++;
                                        ?>
                                        <tr>
                                            <td><?= $i ;?></td>
                                            <?php
                                            if($row['add_media'] == 'poster')
                                            {
                                                ?>
                                                <td><img style="width:auto;height:50px" src="<?= file_url().$row['add_image'];?>" > </td>
                                                <?php
                                            }
                                            else
                                            {
                                                echo "<td></td>";
                                            }
                                            ?>
                                            <?php
                                            if($row['add_media'] == 'video')
                                            {
                                                if($row['add_is_link'] == '0')
                                                {
                                                    ?>
                                                    <td>
                                                        <video style="width:200px;height:auto;" controls>
                                                            <source src="<?= file_url().$row['add_video'];?>" type="video/mp4">
                                                        </video>
                                                    </td>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <td style="width:150px;height:auto">
                                                        <?= $row['add_video']; ?>
                                                    </td>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                echo "<td></td>";
                                            }
                                            ?>
                                            <td><?= $row['add_location'];?></td>
                                            <td><?= date("d/m/Y",strtotime($row['add_activationDate']));?></td>
                                            <td><?= $row['add_displayTime'];?> Days</td>
                                            <td><?= ($row['add_status'] == 1) ? 'Active' : "Not Active";?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>edit-advertisement?add_id=<?= $row['add_id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?= admin_base_url();?>model/channelModel?act=del&add_id=<?= $row['add_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
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