<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Memberships</h1>
            <small>Add New Mebership Package</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add Mebership Package</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>member-packages"> <i class="fa fa-list"></i> Member Packages List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/membershipModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Package Name</label>
                                <input type="text" name="txt_name" class="form-control" placeholder="Enter Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Package Price</label>
                                <input type="text" name="txt_price" class="form-control" placeholder="Enter Price" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Allow Branding</label>
                                <select class="form-control" name="txt_branding" required>
                                    <option disabled selected> Select an Option </option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Super Consultant</label>
                                <select class="form-control" name="txt_consultant" required>
                                    <option disabled selected> Select an Option </option>
                                    <option value="1">Yes</option>
                                    <option value="0">no</option>
                                </select>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>member-packages" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_save" class="btn btn-success" value="Save">
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