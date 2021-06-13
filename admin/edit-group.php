<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$groupID = $_GET['group_id'];
if($groupID == 0 || $groupID == '' || $groupID < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>group-list";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_communication_group where group_id = '$groupID'");
$grpData = fetch($sql);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Groups</h1>
            <small>Edit Group</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Group Group</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>group-list"> <i class="fa fa-list"></i> Group List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/groupModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" name="txt_group_id" value="<?= $grpData['group_id']; ?>">
                            <div class="col-sm-6 form-group">
                                <label>Group Name</label>
                                <input type="text" name="txt_name" value="<?= $grpData['group_name']; ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Group Name in Arabic</label>
                                <input type="text" name="txt_name_ar" value="<?= $grpData['group_name_ar']; ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Group Type</label>
                                <select name="txt_type" class="form-control select2">
                                    <option disabled selected>Select Type</option>
                                    <option <?= ($grpData['group_type'] == "1") ? 'selected' : ''; ?> value="1">Private</option>
                                    <option <?= ($grpData['group_type'] == "0") ? 'selected' : ''; ?> value="0">Public</option>
                                </select>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>group-list" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit_grp" class="btn btn-success" value="Save">
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