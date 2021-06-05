<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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
            <h1>News</h1>
            <small>Add New News</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add News</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>all-news"> <i class="fa fa-list"></i> News List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/newsModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-12">
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                                <h3>English Form</h3>
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>News Name</label>
                                <input type="text" name="txt_news_name" class="form-control" placeholder="Enter News Title" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Image</label>
                                <input type="file" name="txt_image" onchange="checkFileSize('txt_image');" id="txt_image" class="form-control" required>
                                <label class="txt_image"></label>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Category</label>
                                <select name="txt_depart" class="form-control select2" required>
                                    <option>Select Category</option>
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
                            <div class="col-sm-12 form-group">
                                <label>Short Description</label>
                                <textarea name="txt_short_desc" rows="3" class="form-control" id="txt_shot_desc"></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Detail News</label>
                                <textarea name="txt_desc" rows="6" class="form-control" id="txt_desc"></textarea>
                            </div>
                            <div class="col-sm-12">
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                                <h3>Arabic Form</h3>
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                            </div>
                            
                            <div class="col-sm-6 form-group">
                                <label>News Name</label>
                                <input type="text" name="txt_news_name_arabic" class="form-control" placeholder="Enter News Title" required>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Short Description</label>
                                <textarea name="txt_short_desc_arabic" rows="3" class="form-control" id="txt_short_desc_arabic"></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Detail Description</label>
                                <textarea name="txt_desc_arabic" rows="6" class="form-control" id="txt_desc_arabic"></textarea>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>all-news" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_save_news" class="btn btn-success" value="Save">
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
	var area1, area2, area3, area4;
    
    function toggleArea1()
    {
        if(!area1)
        {
            area1 = new nicEditor({fullPanel : true}).panelInstance('txt_shot_desc',{hasPanel : true});
        }
        else
        {
            area1.removeInstance('txt_shot_desc');
            area1 = null;
        }
        if(!area2)
        {
            area2 = new nicEditor({fullPanel : true}).panelInstance('txt_desc',{hasPanel : true});
        }
        else
        {
            area2.removeInstance('txt_desc');
            area2 = null;
        }
        if(!area3)
        {
            area3 = new nicEditor({fullPanel : true}).panelInstance('txt_short_desc_arabic',{hasPanel : true});
        }
        else
        {
            area3.removeInstance('txt_short_desc_arabic');
            area3 = null;
        }
        if(!area4)
        {
            area4 = new nicEditor({fullPanel : true}).panelInstance('txt_desc_arabic',{hasPanel : true});
        }
        else
        {
            area4.removeInstance('txt_desc_arabic');
            area4 = null;
        }
    }
	bkLib.onDomLoaded(function() { toggleArea1(); });
	$(document).ready(function(){
	    $(".select2").select2();
	});
</script>