<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php
$doc_id = get_sess("userdata")['doc_id'];
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
                                <div class="col-md-12">
                                    <h4 style="background-color: #e6e6e6;padding: 10px 20px;">Job Title (Select up to 3 job titles)</h4>
                                </div>
                                <div class="col-md-12">
                                    <?php
                                    $sub_type = 'job_title';
                                    $sql = query("SELECT * FROM tbl_job_notify_sub WHERE sub_type = '$sub_type' AND sub_userType = 'doctor' AND sub_user = '$doc_id' "); 
                                    $num_rows = nrows($sql);
                                    $job_field = '';
                                    if($num_rows > 0)
                                    {
                                        $j=0;
                                        while ($data = fetch($sql))
                                        { 
                                            $j++;
                                            $job_field .= '<div class="col-sm-6 form-group">
                                                <label>Job Title no '.$j.'</label>
                                                <select name="txt_job_title['.$data['sub_id'].']" value="'.$data['sub_value'].'" class="form-control">';
                                                $titlesql1 = query("SELECT DISTINCT job_title FROM tbl_job ORDER BY job_title ASC");
                                                while($title = fetch($titlesql1))
                                                {
                                                    $selected = '';
                                                    if($data['sub_value'] == $title['job_title'])
                                                    {
                                                        $selected = 'selected';
                                                    }
                                                    
                                                    $job_field .= '<option ' . $selected . ' value="' . $title['job_title'] . '">' . $title['job_title'] . '</option>';
                                                }
                                                $job_field .= '</select>
                                            </div>';
                                        }
                                        $limit = 3 - $num_rows;
                                        for($i = 0; $i < $limit; $i++)
                                        {
                                            $titlesql1 = query("SELECT DISTINCT job_title FROM tbl_job ORDER BY job_title ASC ");
                                            $job_field .= '<div class="col-sm-6 form-group">
                                                <label>Job Title no '. (3 - ($limit - $i - 1 )) . ' </label>
                                                <select name="txt_job_title[0]['.$i.']" class="form-control">';
                                                $job_field .= '<option selected disabled>Select one</option>';
                                                while($title = fetch($titlesql1))
                                                {
                                                    $job_field .= '<option value="' . $title['job_title'] . '">' . $title['job_title'] . '</option>';
                                                }
                                            $job_field .= '</select>
                                            </div>';
                                        }
                                    }
                                    else
                                    {
                                        for($i = 0; $i < 3; $i++)
                                        {
                                            $titlesql1 = query("SELECT DISTINCT job_title FROM tbl_job ORDER BY job_title ASC ");
                                            $job_field .= '<div class="col-sm-6 form-group">
                                                <label>Job Title  no ' . ($i + 1) . '</label>
                                                <select name="txt_job_title[0]['.$i.']" class="form-control">';
                                                $job_field .= '<option selected disabled>Select one</option>';
                                                while($title = fetch($titlesql1))
                                                {
                                                    $job_field .= '<option value="' . $title['job_title'] . '">' . $title['job_title'] . '</option>';
                                                }
                                            $job_field .= '</select>
                                            </div>';
                                        }
                                    }
                                    echo $job_field;
                                    ?>
                                </div>
                                <div class="col-md-12">
                                    <h4 style="background-color: #e6e6e6;padding: 10px 20px;">Speciality (Select up to 3 specialities)</h4>
                                </div>
                                <div class="col-md-12">
                                <?php
                                    $sub_type = 'speciality';
                                    $sql = query("SELECT * FROM tbl_job_notify_sub WHERE sub_type = '$sub_type' AND sub_userType = 'doctor' AND sub_user = '$doc_id' "); 
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
                                                <select name="txt_speciality['.$data['sub_id'].']" value="'.$data['sub_value'].'" class="form-control">';
                                                $departsql = query("SELECT DISTINCT job_depart FROM tbl_job ORDER BY job_depart ASC ");
                                                $job_field .= '<option selected disabled>Select one</option>';
                                                while($spec = fetch($departsql))
                                                {
                                                    $selected = '';
                                                    if($data['sub_value'] == $spec['job_depart'])
                                                    {
                                                        $selected = 'selected';
                                                    }
                                                    $job_field .= '<option ' . $selected . ' value="' . $spec['job_depart'] . '">' . $spec['job_depart'] . '</option>';
                                                }
                                            $job_field .= '</select>
                                            </div>';
                                        }
                                        $limit = 3 - $num_rows;
                                        for($i = 0; $i < $limit; $i++)
                                        {
                                            $job_field .= '<div class="col-sm-6 form-group">
                                                <label>Speciality no '. (3 - ($limit - $i - 1 )) . ' </label>
                                                <select name="txt_speciality[0]['.$i.']" class="form-control">';
                                                $departsql = query("SELECT DISTINCT job_depart FROM tbl_job ORDER BY job_depart ASC ");
                                                $job_field .= '<option selected disabled>Select one</option>';
                                                while($spec = fetch($departsql))
                                                {
                                                    $job_field .= '<option value="' . $spec['job_depart'] . '">' . $spec['job_depart'] . '</option>';
                                                }
                                            $job_field .= '</select>
                                            </div>';
                                        }
                                    }
                                    else
                                    {
                                        for($i = 0; $i < 3; $i++)
                                        {
                                            $job_field .= '<div class="col-sm-6 form-group">
                                                <label>Speciality no ' . ($i + 1) . '</label>
                                                <select name="txt_speciality[0]['.$i.']" class="form-control">';
                                                $departsql = query("SELECT DISTINCT job_depart FROM tbl_job ORDER BY job_depart ASC ");
                                                $job_field .= '<option selected disabled>Select one</option>';
                                                while($spec = fetch($departsql))
                                                {
                                                    $job_field .= '<option value="' . $spec['job_depart'] . '">' . $spec['job_depart'] . '</option>';
                                                }
                                            $job_field .= '</select>
                                            </div>';
                                        }
                                    }
                                    echo $job_field;
                                ?>
                                </div>
                                <div class="col-md-12">
                                    <h4 style="background-color: #e6e6e6;padding: 10px 20px;">Locations (Select up to 5 locations)</h4>
                                </div>
                                <div class="col-md-12">
                                    <?php
                                    $sub_type = 'location';
                                    $sql = query("SELECT * FROM tbl_job_notify_sub WHERE sub_type = '$sub_type' AND sub_userType = 'doctor' AND sub_user = '$doc_id' "); 
                                    $num_rows = nrows($sql);
                                    $job_field = '';
                                    if($num_rows > 0)
                                    {
                                        $j = 0;
                                        while ($data = fetch($sql))
                                        { 
                                            $j++;
                                            $locationsql = query("SELECT DISTINCT job_location FROM tbl_job ORDER BY job_location ASC ");
                                            $job_field .= '<div class="col-sm-6 form-group">
                                                <label>Location no '.$j.'</label>
                                                <select name="txt_location['.$data['sub_id'].']" value="'.$data['sub_value'].'" class="form-control">';
                                                $job_field .= '<option selected disabled>Select one</option>';
                                                while($loc = fetch($locationsql))
                                                {
                                                    $selected = '';
                                                    if($data['sub_value'] == $loc['job_location'])
                                                    {
                                                        $selected = 'selected';
                                                    }
                                                    $job_field .= '<option ' . $selected . ' value="' . $loc['job_location'] . '">' . $loc['job_location'] . '</option>';
                                                }
                                                $job_field .= '</select>
                                            </div>';
                                        }
                                        $limit = 5 - $num_rows;
                                        for($i = 0; $i < $limit; $i++)
                                        {
                                            $locationsql = query("SELECT DISTINCT job_location FROM tbl_job ORDER BY job_location ASC ");
                                            $job_field .= '<div class="col-sm-6 form-group">
                                                <label>Location no '. (5 - ($limit - $i - 1 )) . ' </label>
                                                <select name="txt_location[0]['.$i.']" class="form-control">';
                                                $job_field .= '<option selected disabled>Select one</option>';
                                                while($loc = fetch($locationsql))
                                                {
                                                    $job_field .= '<option value="' . $loc['job_location'] . '">' . $loc['job_location'] . '</option>';
                                                }
                                                $job_field .= '</select>
                                            </div>';
                                        }
                                    }
                                    else
                                    {
                                        for($i = 0; $i < 5; $i++)
                                        {
                                            $locationsql = query("SELECT DISTINCT job_location FROM tbl_job ORDER BY job_location ASC ");
                                            $job_field .= '<div class="col-sm-6 form-group">
                                                <label>Location no ' . ($i + 1) . '</label>
                                                <select name="txt_location[0]['.$i.']" class="form-control">';
                                                $job_field .= '<option selected disabled>Select one</option>';
                                                while($loc = fetch($locationsql))
                                                {
                                                    $job_field .= '<option value="' . $loc['job_location'] . '">' . $loc['job_location'] . '</option>';
                                                }
                                                $job_field .= '</select>
                                            </div>';
                                        }
                                    }
                                    echo $job_field;
                                    ?>
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
                        <?php 
                        $notificatioAlert = get_sess("userdata")['doctor_notification'];
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
                                    $sql = query("SELECT * FROM tbl_job_notifications jn JOIN tbl_job j ON (j.job_id = jn.notify_job_id) WHERE jn.notify_user = $doc_id AND notify_user_type = 'doctor'");
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