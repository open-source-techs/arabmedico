<?php
if(isset($_GET['appoint']) && $_GET['appoint'] != "" && $_GET['appoint'] != null)
{
    $appoint = $_GET['appoint'];
    require_once('layout/header.php');
    require_once('layout/sidebar.php');
    $sql = query("SELECT * FROM tbl_appointment WHERE appointment_id = ".$appoint);
    $data = fetch($sql);
    ?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="header-icon">
                <i class="pe-7s-note2"></i>
            </div>
            <div class="header-title">
                <h1>Appointments</h1>
                <small>Edit Appointment</small>
                <ol class="breadcrumb hidden-xs">
                    <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                    <li class="active">Edit Appointment</li>
                </ol>
            </div>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group"> 
                                <a class="btn btn-primary" href="<?= admin_base_url();?>appointments"> <i class="fa fa-list"></i> Appointment List </a>  
                            </div>
                        </div>
                        <div class="panel-body">
                            <form  action="<?= admin_base_url()?>model/appointModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                <input type="hidden" value="<?= $data['appointment_id'];?>" name="app_id" >
                                <input type="hidden" value="<?= (isset($_GET['reschedule']) && $_GET['reschedule'] == 1) ? 1 : 0;?>" name="reschedule" >
                                <div class="col-sm-6 form-group">
                                    <label>Patient Full Name</label>
                                    <input type="text" value="<?= $data['appointment_user_name'];?>" name="txt_f_name" class="form-control" placeholder="Enter patient full name">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Patient Email</label>
                                    <input type="email" value="<?= $data['appointment_user_email'];?>" name="txt_email" class="form-control" placeholder="Enter patient email">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Patient Phone Number</label>
                                    <input type="tel" value="<?= $data['appointment_user_number'];?>" name="txt_number" class="form-control" placeholder="Enter patient phone number">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Select Department</label>
                                    <select name="txt_depart" class="form-control select2" required>
                                        <option>Select Department</option>
                                        <?php
                                        $sql = query("SELECT * FROM tbl_department WHERE dpt_active = 1");
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <option <?= ($data['appointment_depart'] == $row['dpt_id']) ? 'selected' : '';?> value="<?= $row['dpt_id'];?>"><?= $row['dpt_name'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Select Doctor</label>
                                    <select name="txt_doctor" id="doctor" class="form-control select2" required>
                                        <option>Select Doctor</option>
                                        <?php
                                        $sql = query("SELECT * FROM tbl_doctor WHERE doc_active = 1");
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <option <?= ($data['appointment_doctor'] == $row['doc_id']) ? 'selected' : '';?> value="<?= $row['doc_id'];?>"><?= $row['doc_name'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Vistited Before?</label>
                                    <select name="txt_visit" class="form-control select2" required>
                                        <option <?= ($data['appointment_visted_before'] == "New Patient") ? 'selected' : '';?> value="New Patient">New Patient</option>
    									<option <?= ($data['appointment_visted_before'] == "Returning Patient") ? 'selected' : '';?> value="Returning Patient">Returning Patient</option>
    									<option <?= ($data['appointment_visted_before'] == "Other") ? 'selected' : '';?> value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Patient Requested Appointment Date</label>
                                    <input type="date"  id="date" value="<?= $data['appointment_date'];?>" class="form-control" name="txt_date" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Patient Requested Appointment Time</label>
                                    <select name="txt_time" class="form-control select21" required>
                                    <?php
                                    $dateName   = date('l', strtotime($data['appointment_date']));
                                    $sql = query("SELECT * FROM tbl_schedule_head WHERE schedule_date = '$dateName' AND schedule_doctor = ".$data['appointment_doctor']);
                                    while($head = fetch($sql))
                                    {
                                        $headID = $head['schedule_id'];
                                        $sql1 = query("SELECT * FROM tbl_schedule_time WHERE time_head = '$headID' ");
                                        while($res1 = fetch($sql1))
                                        {
                                            ?>
                                            <option <?= ($data['appointment_time'] == $res1['time_id']) ? 'selected' : '';?> value="<?= $res1['time_id']; ?>"><?= $res1['time_start']; ?> - <?= $res1['time_end']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                    </select>
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label>Aditional Notes</label>
                                    <textarea name="txt_notes" rows="6" class="form-control" id="txt_notes" > <?= $data['appointment_user_message'];?></textarea>
                                </div>
                                <div class="col-sm-12 reset-button">
                                    <a href="<?= admin_base_url();?>appointments" class="btn btn-warning">Cancel & Go Back</a>
                                    <input type="submit" name="btn_edit_app" class="btn btn-success" value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php require_once('layout/footer.php');?>
    <script src="<?= admin_base_url();?>assets/plugins/niceedit/nicEdit.js" type="text/javascript"></script>
    <script type="text/javascript">
    	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
    	$(document).ready(function(){
    	    $("#date").change(function(e){
                e.preventDefault();
                
                var date = $(this).val();
                var doc = $('#doctor').val();
                
                var act = "get_time";
                $.ajax({
                    data: {action: act, doctor:doc, app_date:date},
                    type: "post",
                    url: "<?= admin_base_url();?>model/appointModel",
                    success:function(data)
                    {
                        var res = $.parseJSON(data);
                        if(res.status == "success")
                        {
                            var result = res.data;
                            $(".select21").empty();
                            var li = '<option>Select Time Slot</option>';
                            $(".select21").append(li);
                            $.each(res.data, function(index, value)
                            {
                                li = '<option value="'+value.time_id+'">'+value.time_start+' - '+value.time_end+'</option>'
                                $(".select21").append(li);
                            });
                        }
                        else
                        {
                            
                        }
                        
                    }
                });
            });
    	});
    </script>
    <?php
    get_msg('msg');
}
else
{
    echo "<script>window.history.go(-1);</script>";
}
?>