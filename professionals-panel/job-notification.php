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
                        <h3>Subscribe to Notification</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <form action="<?= admin_base_url(); ?>model/jobModel" method="post">
                                <div class="col-sm-6 form-group">
                                    <label>Please select subscription Categroy</label>
                                    <select class="form-control" name="sub_type" id="sub_type" required>
                                        <option selected disabled>Select One</option>
                                        <option value="job_title">Job Title</option>
                                        <option value="speciality">Speciality</option>
                                        <option value="location">Location</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-body">

                                    </div>
                                </div>
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
        $("#sub_type").change(function(){
            var val = $(this).val();
            var act = "getfields";
            $.ajax({
                data:{subType: val, action: act},
                url: "<?= admin_base_url();?>model/jobModel",
                type: "post",
                success: function(response){
                    $(".form-body").empty();
                    $(".form-body").html(response);
                    if(val == "job_title")
                    {
                        $( ".job_title" ).autocomplete({
                            source: title
                        });
                    }
                    else if(val == "speciality")
                    {
                        $( ".txt_speciality" ).autocomplete({
                            source: depart
                        });
                    }
                    else if(val == "location")
                    {
                        $( ".txt_location" ).autocomplete({
                            source: location
                        });
                    }
                }
            });
        });
    });
</Script>