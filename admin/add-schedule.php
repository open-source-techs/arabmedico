<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>\
<?php
$doc_id = $_GET['doc_id'];
if($doc_id == 0 || $doc_id == '' || $doc_id < 0)
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
            <h1>Schedule Date</h1>
            <small>Add Date</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">Add Date</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/scheduleModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" name='txt_doctor_id' value="<?=$_GET['doc_id'];?>">
                            <div class="col-sm-6 form-group">
                                <label>Select Date</label>
                                <input type="date" name="txt_date" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Enter Date in Arabic</label>
                                <input type="text" name="txt_date_arabic" class="form-control" placeholder="Enter Date in Arabic" required>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>schedule" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_save_date" class="btn btn-success" value="Save">
                            </div>
                        </form>
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