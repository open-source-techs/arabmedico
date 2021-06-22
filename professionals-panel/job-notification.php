<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$doc_id = get_sess("userdata")['candidate_id'];
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>Job Notification</h1>
            <small>Job Notification list</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">Job Notifications</li>
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
                                        <th>Job Title</th>
                                        <th>Job Location</th>
                                        <th>Job Speciality</th>
                                        <th>Post Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_job_notifications jn JOIN tbl_job j ON (j.job_id = jn.notify_job_id) WHERE jn.notify_user = $doc_id AND notify_user_type = 'professional'");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><?= $row['job_title'];?></td>
                                            <td><?= $row['notify_job_location'];?></td>
                                            <td><?= $row['notify_speciality'];?></td>
                                            <td><?= date("d/m/Y",strtotime($row['job_close_date']));?></td>
                                            <td>
                                                <a target="_blank" href="<?= base_url().$row['job_slug'];?>" class="btn btn-info btn-xs">View Job
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