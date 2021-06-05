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
            <h1>Language</h1>
            <small>Add New Language</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add Language</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>list-language"> <i class="fa fa-list"></i> Language List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/webModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>English Language</label>
                                <input type="text" name="txt_eng_lang" class="form-control" placeholder="Enter Title" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Arabic Language</label>
                                <input type="text" name="txt_ar_lang" class="form-control" placeholder="Enter Title" required>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>all-language" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_save_language" class="btn btn-success" value="Save">
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