<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Appointments</h1>
            <small>Add New Appointment</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add Appointment</li>
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
                            <div class="col-sm-6 form-group">
                                <label>Patient Full Name</label>
                                <input type="text" name="txt_f_name" class="form-control" placeholder="Enter patient full name">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Patient Email</label>
                                <input type="email" name="txt_email" class="form-control" placeholder="Enter patient email">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Patient Phone Number</label>
                                <input type="tel" name="txt_number" class="form-control" placeholder="Enter patient phone number">
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
                                        <option value="<?= $row['dpt_id'];?>"><?= $row['dpt_name'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Doctor</label>
                                <select name="txt_doctor"  id="doctor" class="form-control select2" required>
                                    <option>Select Doctor</option>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_doctor WHERE doc_active = 1");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <option value="<?= $row['doc_id'];?>"><?= $row['doc_name'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Vistited Before?</label>
                                <select name="txt_visit" class="form-control select2" required>
                                    <option value="New Patient">New Patient</option>
									<option value="Returning Patient">Returning Patient</option>
									<option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Patient Requested Appointment Date</label>
                                <input type="date" id="date" class="form-control" name="txt_date" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Patient Requested Appointment Time</label>
                                <select name="txt_time" class="form-control select21" required>
                                    <option value="">Select date first</option>
                                </select>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Aditional Notes</label>
                                <textarea name="txt_notes" rows="6" class="form-control" id="txt_notes" ></textarea>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>appointments" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_save_app" class="btn btn-success" value="Save">
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
<?php
get_msg('msg');
?>
<script type="text/javascript">
    var area1;
    
    function toggleArea1()
    {
        if(!area1)
        {
            area1 = new nicEditor({fullPanel : true}).panelInstance('txt_notes',{hasPanel : true});
        }
        else
        {
            area1.removeInstance('txt_notes');
            area1 = null;
        }
    }
	bkLib.onDomLoaded(function() { toggleArea1(); });
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