<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$org_id = get_sess("userdata")['organization_id'];
if($org_id == 0 || $org_id == '' || $org_id < 0)
{
    ?>
    <script>
      window.location.href="<?= admin_base_url(); ?>";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_organization where organization_id = '$org_id'");
$org = fetch($sql);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Organization Page Management</h1>
            <small>Edit Welcome Section</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">Page Welcome</li>
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
                        <form  action="<?= admin_base_url()?>model/adminUser" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" value="<?= $org_id; ?>" name="txt_orgID">
                            <div class="col-sm-6 form-group">
                                <label>Welcome Heading</label>
                                <input type="text" name="txt_welcome_head" class="form-control" value="<?= $org['organization_wel_head'];?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Welcome Heading Arabic</label>
                                <input type="text" name="txt_welcome_head_arabic" class="form-control" value="<?= $org['organization_wel_head_ar'];?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Welcome Text</label>
                                <textarea name="txt_welcome" rows="3" class="form-control" placeholder="Enter Welcome Text" required><?= $org['organization_wel_text'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Welcome Text Arabic</label>
                                <textarea name="txt_welcome_arabic" rows="3" class="form-control" placeholder="Enter Welcome Text in Arabic" required><?= $org['organization_wel_text_arabic'];?></textarea>
                            </div>
                            <?php 
                            if($org['organization_welcome_image'] != null && $org['organization_welcome_image'] != '')
                            {
                                ?>
                                <div class="col-sm-6 form-group">
                                    <label>Current Welcome Image</label><br>
                                    <img src="<?= file_url().$org['organization_welcome_image']; ?>" style="height: 100px; width:auto ;">
                                </div>
                                <?php
                            }
                            ?>
                            <div class="col-sm-6 form-group">
                                <label>Welcome Image</label>
                                <input type="file" name="txt_welcome_image" class="form-control">
                            </div>
                            <div class="col-sm-12 reset-button">
                                <input type="submit" name="btn_welcome" class="btn btn-success" value="Save">
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