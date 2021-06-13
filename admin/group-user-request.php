<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>Groups</h1>
            <small>User Request</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">User Requests</li>
            </ol>
        </div>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        
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
                                        <th>Name</th>
                                        <th>Group Name</th>
                                        <th>Requested by</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_group_users gu JOIN tbl_communication_group g ON (gu.grp_group_id = g.group_id) WHERE grp_user_approved = 0");
                                    while ($row = fetch($sql))
                                    {
                                        if($row['grp_user_type'] == 'doctor')
                                        {
                                            $userID     = $row['grp_user_id'];
                                            $userSql    = query("SELECT doc_name FROM tbl_doctor WHERE doc_id = $userID");
                                            $userData   = fetch($userSql);
                                            $userName   = $userData['doc_name'];
                                        }
                                        ?>
                                        <tr>
                                            <td><?= $userName ;?></td>
                                            <td><?= $row['group_name'];?></td>
                                            <td><?= strtoupper($row['grp_user_type']);?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>model/groupModel?act=acceptuser&group_id=<?= $row['grp_id']; ?>" class="btn btn-info btn-xs">Accept
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