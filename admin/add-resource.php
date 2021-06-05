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
            <h1>Resources</h1>
            <small>Add New Resource</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add Resource</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>list-resource"> <i class="fa fa-list"></i> Department List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/resourceModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-12">
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                                <h3>English Form</h3>
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>New Condition</label>
                                <input type="text" name="txt_dpt_name" class="form-control" placeholder="Enter Resource Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Name</label>
                                <input type="text" name="txt_author" class="form-control" placeholder="Enter Resource Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Title</label>
                                <input type="text" name="txt_title" class="form-control" placeholder="Enter Resource Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Degree</label>
                                <input type="text" name="txt_deg" class="form-control" placeholder="Enter Resource Name" required>
                            </div>
                            <input type="hidden" value="1" id="countDepImg">
                            <div class="col-sm-6 form-group">
                                <label>Author Image</label>
                                <input type="file" name="txt_icon"  class="form-control onChangeImg" required>
                                <label class="txt_icon"></label>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Short Description</label>
                                <textarea name="txt_short_desc" rows="3" class="form-control" id="txt_desc"></textarea>
                            </div>
                            <div class="col-sm-12">
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                                <h3>Arabic Form</h3>
                                <hr style="width: 100%;height: 1px;margin: 5px auto;">
                            </div>
                            
                            <div class="col-sm-6 form-group">
                                <label>New Condition</label>
                                <input type="text" name="txt_dpt_name_arabic" class="form-control" placeholder="Enter Resource Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Name</label>
                                <input type="text" name="txt_author_ar" class="form-control" placeholder="Enter Resource Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Title</label>
                                <input type="text" name="txt_title_ar" class="form-control" placeholder="Enter Resource Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Degree</label>
                                <input type="text" name="txt_deg_ar" class="form-control" placeholder="Enter Resource Name" required>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Short Description</label>
                                <textarea name="txt_short_desc_arabic" rows="3" class="form-control" id="txt_desc_arabic"></textarea>
                            </div>
                            <div class="col-sm-12 form-group" style="display:none">
                                <label>Detail Description</label>
                                <textarea name="txt_desc_arabic_ar" rows="6" class="form-control" id="txt_desc_detail_arabic"></textarea>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>list-resource" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_save_dpt" class="btn btn-success" value="Save">
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
<script type="text/javascript">
    var area1, area2, area3, area4;
    
    function toggleArea1()
    {
        if(!area1)
        {
            area1 = new nicEditor({fullPanel : true}).panelInstance('txt_desc_arabic',{hasPanel : true});
        }
        else
        {
            area1.removeInstance('txt_desc_arabic');
            area1 = null;
        }
    }
    
    function toggleArea2()
    {
        if(!area2)
        {
            area2 = new nicEditor({fullPanel : true}).panelInstance('txt_desc_detail_arabic',{hasPanel : true});
        }
        else
        {
            area2.removeInstance('txt_desc_detail_arabic');
            area2 = null;
        }
    }
    
    function toggleArea3()
    {
        if(!area3)
        {
            area3 = new nicEditor({fullPanel : true}).panelInstance('txt_desc',{hasPanel : true});
        }
        else
        {
            area3.removeInstance('txt_desc');
            area3 = null;
        }
    }
    
    function toggleArea4()
    {
        if(!area4)
        {
            area4 = new nicEditor({fullPanel : true}).panelInstance('txt_desc_detail',{hasPanel : true});
        }
        else
        {
            area4.removeInstance('txt_desc_detail');
            area4 = null;
        }
    }
    function readURL(input)
    {  
        if (input.files && input.files[0])
        {
            var reader = new FileReader();
            reader.onload = function(e)
            {
                $('#sldImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }
    bkLib.onDomLoaded(function() { toggleArea1(); toggleArea2(); toggleArea3(); toggleArea4(); });
</script>