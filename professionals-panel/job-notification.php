<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php
$doc_id = get_sess("userdata")['candidate_id'];
$titlesql = query("SELECT DISTINCT job_title FROM tbl_job ORDER BY job_title ASC ");
$departsql = query("SELECT DISTINCT job_depart FROM tbl_job ORDER BY job_depart ASC ");
$locationsql = query("SELECT DISTINCT job_location FROM tbl_job ORDER BY job_location ASC ");
$candiate_id = get_sess("userdata")['candidate_id'];
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
                        <h3>Set Job Notification</h3>
                        <span>You can select 3 job titles, 3 specialities and 5 locations</span>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <form action="<?= admin_base_url(); ?>model/jobModel" method="post">
                                <?php
                                $sub_type = 'job_title';
                                $sql = query("SELECT * FROM tbl_job_notify_sub WHERE sub_type = '$sub_type' AND sub_userType = 'professional' AND sub_user = '$candiate_id' "); 
                                $num_rows = nrows($sql);
                                $job_field = '';
                                if($sub_type == "job_title")
                                {
                                    if($num_rows > 0)
                                    {
                                        $j=0;
                                        while ($data = fetch($sql))
                                        { 
                                            $j++;
                                            $job_field .= '<div class="col-sm-6 form-group">
                                                <label>Job Title no '.$j.'</label>
                                                <input type="text" name="txt_job_title['.$data['sub_id'].']" value="'.$data['sub_value'].'" class="form-control job_title">
                                            </div>';
                                        }
                                        $limit = 3 - $num_rows;
                                        for($i = 0; $i < $limit; $i++)
                                        {
                                            $job_field .= '<div class="col-sm-6 form-group">
                                                <label>Job Titleno '. (3 - ($limit - $i - 1 )) . ' </label>
                                                <input type="text" name="txt_job_title[0]['.$i.']" class="form-control job_title">
                                            </div>';
                                        }
                                        echo $job_field;
                                    }
                                    else
                                    {
                                        for($i = 0; $i < 3; $i++)
                                        {
                                            $job_field .= '<div class="col-sm-6 form-group">
                                                <label>Job Title  no ' . ($i + 1) . '</label>
                                                <input type="text" name="txt_job_title[0]['.$i.']" class="form-control job_title">
                                            </div>';
                                        }
                                    }
                                }
                                $sub_type = 'speciality';
                                $sql = query("SELECT * FROM tbl_job_notify_sub WHERE sub_type = '$sub_type' AND sub_userType = 'professional' AND sub_user = '$candiate_id' "); 
                                $num_rows = nrows($sql);
                                $job_field = '';
                                if($num_rows > 0)
                                {
                                    $j=0;
                                    while ($data = fetch($sql))
                                    { 
                                        $j++;
                                        $job_field .= '<div class="col-sm-6 form-group">
                                            <label>Speciality no '.$j.'</label>
                                            <input type="text" name="txt_speciality['.$data['sub_id'].']" value="'.$data['sub_value'].'" class="form-control txt_speciality">
                                        </div>';
                                    }
                                    $limit = 3 - $num_rows;
                                    for($i = 0; $i < $limit; $i++)
                                    {
                                        $job_field .= '<div class="col-sm-6 form-group">
                                            <label>Speciality no '. (3 - ($limit - $i - 1 )) . ' </label>
                                            <input type="text" name="txt_speciality[0]['.$i.']" class="form-control txt_speciality" >
                                        </div>';
                                    }
                                }
                                else
                                {
                                    for($i = 0; $i < 3; $i++)
                                    {
                                        $job_field .= '<div class="col-sm-6 form-group">
                                            <label>Speciality no ' . ($i + 1) . '</label>
                                            <input type="text" name="txt_speciality[0]['.$i.']" class="form-control txt_speciality" >
                                        </div>';
                                    }
                                }
                                echo $job_field;
                                $sub_type = 'location';
                                $sql = query("SELECT * FROM tbl_job_notify_sub WHERE sub_type = '$sub_type' AND sub_userType = 'professional' AND sub_user = '$candiate_id' "); 
                                $num_rows = nrows($sql);
                                $job_field = '';
                                if($num_rows > 0)
                                {
                                    $j = 0;
                                    while ($data = fetch($sql))
                                    { 
                                        $j++;
                                        $job_field .= '<div class="col-sm-6 form-group">
                                            <label>Location no '.$j.'</label>
                                            <input type="text" name="txt_location['.$data['sub_id'].']" value="'.$data['sub_value'].'" class="form-control txt_location">
                                        </div>';
                                    }
                                    $limit = 5 - $num_rows;
                                    for($i = 0; $i < $limit; $i++)
                                    {
                                        $job_field .= '<div class="col-sm-6 form-group">
                                            <label>Location no '. (5 - ($limit - $i - 1 )) . ' </label>
                                            <input type="text" name="txt_location[0]['.$i.']" class="form-control txt_location">
                                        </div>';
                                    }
                                }
                                else
                                {
                                    for($i = 0; $i < 5; $i++)
                                    {
                                        $job_field .= '<div class="col-sm-6 form-group">
                                            <label>Location no ' . ($i + 1) . '</label>
                                            <input type="text" name="txt_location[0]['.$i.']" class="form-control txt_location">
                                        </div>';
                                    }
                                }
                                echo $job_field;
                                ?>
                                 <div class="col-sm-12 reset-button">
                                    <input type="submit" name="btn_save_subscription" class="btn btn-success" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <?php 
                        $notificatioAlert = get_sess("userdata")['candidate_notifcations'];
                        ?>
                        <a class="btn btn-<?= ($notificatioAlert == 0) ? 'success' : 'danger'; ?> btn-sm" href="<?= admin_base_url()?>model/jobModel?act=notify&val=<?= ($notificatioAlert == 0) ? 1 : 0; ?>">Turn notifications <?= ($notificatioAlert == 0) ? 'on' : 'off'; ?></a>
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
<Script>
    $(document).ready(function(){
        var title = [
            <?php
            while($title = fetch($titlesql))
            {
                echo '"'.$title['job_title'].'",';
            }
            ?>
        ];
        var depart = [
            <?php
            while($depart = fetch($departsql))
            {
                echo '"'.$depart['job_depart'].'",';
            }
            ?>
        ];
        var location = [
            <?php
            while($location = fetch($locationsql))
            {
                echo '"'.$location['job_location'].'",';
            }
            ?>
        ];
        $( ".job_title" ).autocomplete({
            source: title
        });
        $( ".txt_speciality" ).autocomplete({
            source: depart
        });
        $( ".txt_location" ).autocomplete({
            source: location
        });
    });
</Script>