<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$sch = $_GET['sch'];
if($sch == 0 || $sch == '' || $sch < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>schedule";
    </script>
    <?php
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>Schedule Timing</h1>
            <small>Manage Timings</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li>
                    <a href="<?= admin_base_url();?>schedule">
                		<i class="pe-7s-home"></i> Timing
                	</a>
                </li>
                <li class="active">Manage Timings</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/scheduleModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            
                            <div class="dynamic_fields">
                                <?php
                                $sql = query("SELECT * FROM tbl_schedule_time WHERE time_head = '$sch' ORDER BY time_id ASC");
                                if(nrows($sql) > 0)
                                {
                                    $i = 0;
                                    while ($row = fetch($sql))
                                    {
                                        $i++;
                                        ?>
                                        <div class="div-<?= $i;?>">
                                            <div class="col-md-12">
                                                <button class="btn btn-sm btn-danger pull-right btn_remove_record" data-remove-id="<?= $row['time_id'];?>" type="button" data-row-id="<?= $i;?>"> Remove Record</button>
                                            </div>
                                            <input type="hidden" value="<?= $row['time_id'];?>" name="txt_time_id[]">
                                            <div class="col-sm-6 form-group">
                                                <label>Start Time</label>
                                                <input type="time" name="txt_start_time[]" value="<?= date('H:i' , strtotime($row['time_start']));?>" class="form-control" required>
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label>End Time</label>
                                                <input type="time" name="txt_end_time[]" value="<?= date('H:i' , strtotime($row['time_end']));?>" class="form-control" required>
                                            </div>
                                        </div>
                                        <?php
                                        
                                    }
                                }
                                else
                                {
                                    $i = 1;
                                    ?>
                                    <div class="div-1">
                                        <input type="hidden" value="0" name="txt_time_id[]">
                                        <div class="col-sm-6 form-group">
                                            <label>Start Time</label>
                                            <input type="time" name="txt_start_time[]" class="form-control" required>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label>End Time</label>
                                            <input type="time" name="txt_end_time[]" class="form-control" required>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <input type="hidden" name='time_head' value="<?= $sch; ?>">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-sm btn-success pull-right" id="btn_new_record" data-next-row="<?= $i+1; ?>">Add New Record</button>
                            </div>
                            
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>schedule" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_save_time" class="btn btn-success" value="Save">
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<?php
get_msg('msg');
?>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
	$(document).ready(function(){
	    
	    $('body').delegate('.btn_remove_record', 'click', function(){
	        var divId = $(this).attr('data-row-id');
	        var timeID = $(this).attr('data-remove-id');
	        var act = "delTime";
	        if(timeID != 0)
	        {
	            $.ajax({
                    data: {action: act, txt_time:timeID},
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
	        }
	        $(".div-"+divId).remove();
	    });
	    
	    $("#btn_new_record").click(function(e){
	        e.preventDefault();
	        var nextId = $(this).attr('data-next-row');
	        var div = '<div class="div-'+nextId+'">'+
	            '<div class="col-md-12">'+
                    '<button class="btn btn-sm btn-danger pull-right btn_remove_record" type="button" data-remove-id="0" data-row-id="'+nextId+'"> Remove Record</button>'+
                '</div>'+
                '<input type="hidden" value="0" name="txt_time_id[]">'+
                '<div class="col-sm-6 form-group">'+
                    '<label>Start Time</label>'+
                    '<input type="time" name="txt_start_time[]" class="form-control" required>'+
                '</div>'+
                '<div class="col-sm-6 form-group">'+
                    '<label>End Time</label>'+
                    '<input type="time" name="txt_end_time[]" class="form-control" required>'+
                '</div>'+
            '</div>';
            $(".dynamic_fields").append(div);
            var nextId1 = parseInt(nextId) + parseInt(1);
            $(this).attr('data-next-row', nextId1);
	    });
	});
</script>