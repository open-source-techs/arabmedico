<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <form action="#" method="get" class="sidebar-form search-box pull-right hidden-md hidden-lg hidden-sm">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>  
            <h1>Country</h1>
            <small>Add New Country</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add Country</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>list-country"> <i class="fa fa-list"></i> Country List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/locationModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Country Name</label>
                                <input type="text" name="country_name" class="form-control" placeholder="Enter Country Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Country Name Arabic</label>
                                <input type="text" name="country_name_ar" class="form-control" placeholder="Enter Country Name Arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Status</label>
                                <select name="select_status" class="form-control select2" required>
                                    <option>Select</option>
                                    <option value="1">Active</option>
                                    <option value="0">Unactive</option>
                                </select>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>list-country" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_save_country" class="btn btn-success" value="Save">
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