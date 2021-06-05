<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<style>
    .dataTables_length{
        display: inline-block;
    }
    .dataTables_filter{
        display: inline-block;
        float: right;
    }
    .dataTables_paginate{
        display: inline-block;
        margin-bottom: 0;
        padding-left: 0;
        margin: 20px 0;
        border-radius: 4px;
        float:right;
    }
    .dataTables_paginate>a{
        display: inline;
    }
    .dataTables_paginate:first-child{
        margin-left: 0;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
    }
    .dataTables_paginate a{
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: #337ab7;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #ddd;
    }
    .dataTables_info{
        display:inline-block;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>Appointments</h1>
            <small>Appointments list</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">Appointment</li>
            </ol>
        </div>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <h3>Un Completed Appointments</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover uncompletedAppointment">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Department</th>
                                        <th>Doctor</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Message</th>
                                        <th>Patient Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // echo "SELECT * FROM tbl_appointment a JOIN tbl_department dpt ON (dpt.dpt_id = a.appointment_depart) JOIN tbl_doctor d ON (d.doc_id = a.appointment_doctor) WHERE a.appointment_read = 0";
                                    $sql = query("SELECT * FROM tbl_appointment a JOIN tbl_department dpt ON (dpt.dpt_id = a.appointment_depart) JOIN tbl_doctor d ON (d.doc_id = a.appointment_doctor) WHERE a.appointment_read = 0");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><?= date("d/m/Y",strtotime($row['appointment_date']));?></td>
                                            <td><?= $row['dpt_name'];?></td>
                                            <td><?= $row['doc_name'];?></td>
                                            <td><?= $row['appointment_user_name'];?></td>
                                            <td><?= $row['appointment_user_email'];?></td>
                                            <td><?= $row['appointment_user_number'];?></td>
                                            <td><?= $row['appointment_user_message'];?></td>
                                            <td><?= $row['appointment_visted_before'];?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>edit-appointment?appoint=<?= $row['appointment_id'] ?>" class="btn btn-warning btn-xs">Edit</a>
                                                <a href="<?= admin_base_url();?>model/appointModel?act=app_stat&appoint=<?= $row['appointment_id'] ?>&val=1" class="btn btn-info btn-xs">Completed</a>
                                                <a href="<?= admin_base_url();?>model/appointModel?act=app_stat&appoint=<?= $row['appointment_id'] ?>&val=2" class="btn btn-default btn-xs">No Show</a>
                                                <a href="<?= admin_base_url();?>model/appointModel?act=app_stat&appoint=<?= $row['appointment_id'] ?>&val=3" class="btn btn-danger btn-xs">Cancel</a>
                                                <a href="<?= admin_base_url();?>edit-appointment?appoint=<?= $row['appointment_id'] ?>&reschedule=1" class="btn btn-warning btn-xs">Reschedule</a>
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
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <h3>Completed Appointments</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover completedAppointment">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Department</th>
                                        <th>Doctor</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Message</th>
                                        <th>Patient Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // echo "SELECT * FROM tbl_appointment a JOIN tbl_department dpt ON (dpt.dpt_id = a.appointment_depart) JOIN tbl_doctor d ON (d.doc_id = a.appointment_doctor) WHERE a.appointment_read = 0";
                                    $sql = query("SELECT * FROM tbl_appointment a JOIN tbl_department dpt ON (dpt.dpt_id = a.appointment_depart) JOIN tbl_doctor d ON (d.doc_id = a.appointment_doctor) WHERE a.appointment_read = 1");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><?= date("d/m/Y",strtotime($row['appointment_date']));?></td>
                                            <td><?= $row['dpt_name'];?></td>
                                            <td><?= $row['doc_name'];?></td>
                                            <td><?= $row['appointment_user_name'];?></td>
                                            <td><?= $row['appointment_user_email'];?></td>
                                            <td><?= $row['appointment_user_number'];?></td>
                                            <td><?= $row['appointment_user_message'];?></td>
                                            <td><?= $row['appointment_visted_before'];?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>edit-appointment?appoint=<?= $row['appointment_id'] ?>" class="btn btn-warning btn-xs">Edit</a>
                                                <a href="<?= admin_base_url();?>model/appointModel?act=app_stat&appoint=<?= $row['appointment_id'] ?>&val=2" class="btn btn-default btn-xs">No Show</a>
                                                <a href="<?= admin_base_url();?>model/appointModel?act=app_stat&appoint=<?= $row['appointment_id'] ?>&val=3" class="btn btn-danger btn-xs">Cancel</a>
                                                <a href="<?= admin_base_url();?>edit-appointment?appoint=<?= $row['appointment_id'] ?>&reschedule=1" class="btn btn-warning btn-xs">Reschedule</a>
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
    <div class="container" style="padding-bottom:10px;">
        <div class=row"">
            <div class="col-md-4">
                <button class="btn btn-sm btn-info" id="btnNoShowAppointment">View No Show Appointment</button>
            </div>
            <div class="col-md-4">
                <button class="btn btn-sm btn-info" id="btnCancelledAppointment">View Cancelled Appointment</button>
            </div>
        </div>
    </div>
    <section class="content" id="noShowAppointment">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <h3>No Show Appointments</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover noShowAppointment">
                                <thead>
                                    <tr>
                                        <th>Requested Date</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Message</th>
                                        <th>Patient Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_appointment a JOIN tbl_department dpt ON (dpt.dpt_id = a.appointment_depart) JOIN tbl_doctor d ON (d.doc_id = a.appointment_doctor) WHERE a.appointment_read = 2 AND doc_id = '".get_sess("userdata")['doc_id']."' ");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><?= date("d/m/Y",strtotime($row['appointment_date']));?></td>
                                            <td><?= $row['appointment_user_name'];?></td>
                                            <td><?= $row['appointment_user_email'];?></td>
                                            <td><?= $row['appointment_user_number'];?></td>
                                            <td><?= $row['appointment_user_message'];?></td>
                                            <td><?= $row['appointment_visted_before'];?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>edit-appointment?appoint=<?= $row['appointment_id'] ?>&reschedule=1" class="btn btn-warning btn-xs">Reschedule</a>
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
    <section class="content" id="cancelAppointment">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <h3>Cancelled Appointments</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover cancelAppointment">
                                <thead>
                                    <tr>
                                        <th>Requested Date</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Message</th>
                                        <th>Patient Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_appointment a JOIN tbl_department dpt ON (dpt.dpt_id = a.appointment_depart) JOIN tbl_doctor d ON (d.doc_id = a.appointment_doctor) WHERE a.appointment_read = 3 AND doc_id = '".get_sess("userdata")['doc_id']."' ");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><?= date("d/m/Y",strtotime($row['appointment_date']));?></td>
                                            <td><?= $row['appointment_user_name'];?></td>
                                            <td><?= $row['appointment_user_email'];?></td>
                                            <td><?= $row['appointment_user_number'];?></td>
                                            <td><?= $row['appointment_user_message'];?></td>
                                            <td><?= $row['appointment_visted_before'];?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>edit-appointment?appoint=<?= $row['appointment_id'] ?>&reschedule=1" class="btn btn-warning btn-xs">Reschedule</a>
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
<script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
    $("#noShowAppointment").hide();
    $("#cancelAppointment").hide();
    $(".uncompletedAppointment").DataTable();
    $(".completedAppointment").DataTable();
    $("#btnNoShowAppointment").click(function(){
        $("#noShowAppointment").show();
        $("#cancelAppointment").hide();
        $(".noShowAppointment").DataTable();
    });
    
    $("#btnCancelledAppointment").click(function(){
        $("#cancelAppointment").show();
        $("#noShowAppointment").hide();
        $(".cancelAppointment").DataTable();
    });
});
</script>
<?php
get_msg('msg');
?>