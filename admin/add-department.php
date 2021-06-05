<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Departments</h1>
            <small>Add New Department</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add Department</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>list-department"> <i class="fa fa-list"></i> Department List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/departmentModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Department Name</label>
                                <input type="text" name="txt_dpt_name" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Department Name in Arabic</label>
                                <input type="text" name="txt_dpt_name_arabic" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Department URL (https://arabmedico.com/....)</label>
                                <input type="text" name="txt_dpt_url" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Icon (image only)</label>
                                <input type="file" name="txt_icon"  class="form-control onChangeImg" required>
                                <label class="txt_icon"></label>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Short Description</label>
                                <textarea name="txt_short_desc" rows="3" class="form-control" id="txt_desc"></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Short Description in Arabic</label>
                                <textarea name="txt_short_desc_arabic" rows="3" class="form-control" id="txt_desc_arabic"></textarea>
                            </div>
                            <div class="col-sm-12 form-group" style="display:none">
                                <label>Detail Description</label>
                                <textarea name="txt_desc" rows="6" class="form-control editor1"></textarea>
                            </div>
                            <div class="col-sm-12 form-group" style="display:none">
                                <label>Detail Description in Arabic</label>
                                <textarea name="txt_desc_arabic" rows="6" class="form-control" id="txt_desc_detail_arabic"></textarea>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>list-department" class="btn btn-warning">Cancel & Go Back</a>
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