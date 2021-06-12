<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Internal News</h1>
            <small>Add Internal News</small>
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
                            <a class="btn btn-primary" href="<?= admin_base_url();?>all-internal-news"> <i class="fa fa-list"></i> News List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/internalNewsModel" method="POST" enctype="multipart/form-data" class="col-sm-12">

                            <div class="col-sm-6 form-group">
                                <label>News Title</label>
                                <input type="text" class="form-control"name="txt_title" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>News Title in Arabic</label>
                                <input type="text" class="form-control"name="txt_title_ar" required>
                            </div>
                            <div class="col-sm-6 form-group" required>
                                <label>Select News For</label>
                                <select class="form-control" name="txt_news_for" required>
                                    <option value="All">All</option>
                                    <option value="doctor">Doctor</option>
                                    <option value="employeer">Employeer</option>
                                    <option value="clinic">Clinic</option>
                                    <option value="organizer">Organizer</option>
                                    <option value="professional">Professional</option>
                                </select>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>News Content</label>
                                <textarea name="txt_desc" rows="3" class="form-control" id="txt_desc"></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>News Content in Arabic</label>
                                <textarea name="txt_desc_ar" rows="3" class="form-control" id="txt_desc_ar"></textarea>
                            </div>
                            
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>all-internal-news" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_add_news" class="btn btn-success" value="Save">
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

    var area1, area2;
    function toggleArea1()
    {
        if(!area1)
        {
            area1 = new nicEditor({fullPanel : true}).panelInstance('txt_desc_ar',{hasPanel : true});
        }
        else
        {
            area1.removeInstance('txt_desc_ar');
            area1 = null;
        }
    }
    
    function toggleArea2()
    {
        if(!area2)
        {
            area2 = new nicEditor({fullPanel : true}).panelInstance('txt_desc',{hasPanel : true});
        }
        else
        {
            area2.removeInstance('txt_desc');
            area2 = null;
        }
    }
	bkLib.onDomLoaded(function() { toggleArea1(); toggleArea2(); });

</script>