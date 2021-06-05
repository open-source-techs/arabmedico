<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">  
            <h1>Organizer</h1>
            <small>Add Organizer</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">Add Organizer</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>list-organizer"> <i class="fa fa-list"></i>Organizer List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/organizerModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Organizer Name</label>
                                <input type="text" name="txt_org_name" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Organizer Name in Arabic</label>
                                <input type="text" name="txt_org_name_ar" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Organizer Number</label>
                                <input type="text" name="txt_org_number" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Icon (image only)</label>
                                <input type="file" name="txt_icon" class="form-control onChangeImg" required>
                                <label class="txt_icon"></label>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Organizer Email</label>
                                <input type="email" name="txt_org_email" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Organizer login Username</label>
                                <input type="text" name="txt_org_username" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Organizer login Password</label>
                                <input type="password" name="txt_org_password" class="form-control" required>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>list-organizer" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_save_org" class="btn btn-success" value="Save">
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