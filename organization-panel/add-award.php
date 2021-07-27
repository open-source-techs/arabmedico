<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$org_id = get_sess("userdata")['organization_id'];
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Awards</h1>
            <small>Add New Awards</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add Awards</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>all-award"> <i class="fa fa-list"></i> Awards List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/awardModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Award title</label>
                                <input type="hidden" value="<?= $org_id; ?>" name="txt_orgID">
                                <input type="text" name="txt_title" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Award Title Arabic</label>
                                <input type="text" name="txt_title_ar" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Award Picture</label>
                                <input type="file" name="txt_image" class="form-control" onchange="checkFileSize('txt_image');" id="txt_image" required>
                                <label class="txt_image"></label>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <input type="submit" name="btn_save_cer" class="btn btn-success" value="Save">
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