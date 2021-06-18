<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$dpt_id = $_GET['dpt_id'];
if($dpt_id == 0 || $dpt_id == '' || $dpt_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>list-resource";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_resources where resource_id = '$dpt_id'");
$dpt = fetch($sql);
?>
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
            <h1>Patient Resources</h1>
            <small>Edit Resources</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Edit Resources</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>list-resource"> <i class="fa fa-list"></i>Resources List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/resourceModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>New Condition</label>
                                <input type="hidden" name="txt_dpt_id" value="<?= $dpt['resource_id'];?>">
                                <input type="text" name="txt_dpt_name" value="<?= $dpt['resource_name'];?>" class="form-control" placeholder="Enter Resource Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>New Condition in Arabic</label>
                                <input type="text" name="txt_dpt_name_arabic" value="<?= $dpt['resource_name_arabic'];?>" class="form-control" placeholder="Enter Resource Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Name</label>
                                <input type="text" name="txt_author" class="form-control" value="<?= $dpt['resource_author'];?>" placeholder="Enter Author Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Name in Arabic</label>
                                <input type="text" name="txt_author_ar" class="form-control" value="<?= $dpt['resource_author_ar'];?>" placeholder="Enter Author Arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Title</label>
                                <input type="text" name="txt_title" class="form-control" value="<?= $dpt['resource_title'];?>" placeholder="Enter Author Title" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Title in Arabic</label>
                                <input type="text" name="txt_title_ar" class="form-control" value="<?= $dpt['resource_title_ar'];?>" placeholder="Enter Title Arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Degree</label>
                                <input type="text" name="txt_deg" class="form-control" value="<?= $dpt['resource_deg'];?>" placeholder="Enter Degree" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Degree in Arabic</label>
                                <input type="text" name="txt_deg_ar" class="form-control" value="<?= $dpt['resource_deg_ar'];?>" placeholder="Enter Degree Arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Icon</label>
                                <input type="file" name="txt_icon" class="form-control onChangeImg">
                                <label class="txt_icon"></label>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Resource URL (https://arabmedico.com/....)</label>
                                <input type="hidden" value="<?= $dpt['resource_slug'];?>" name="previous_slug">
                                <input type="text" name="txt_dpt_url" class="form-control" value="<?= $dpt['resource_slug'];?>">
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Short Description</label>
                                <textarea name="txt_short_desc" rows="3" id="txt_desc_arabic" class="form-control editor"><?= $dpt['resource_short_desc'];?></textarea>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Short Description in Arabic</label>
                                <textarea name="txt_short_desc_arabic" rows="3" id="txt_desc_detail_arabic" class="form-control"><?= $dpt['resource_short_desc_arabic'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Title</label>
                                <input type="text" name="txt_meta_title" value="<?= $dpt['resource_meta_title'];?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Title for arabic</label>
                                <input type="text" name="txt_meta_title_ar" value="<?= $dpt['resource_meta_title_ar'];?>" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Tags</label>
                                <textarea name="txt_tag" rows="3" class="form-control"><?= $dpt['resource_meta_tag'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Tags for Arabic</label>
                                <textarea name="txt_tag_ar" rows="3" class="form-control"><?= $dpt['resource_meta_tag_ar'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Description</label>
                                <textarea name="txt_meta_desc" rows="3" class="form-control"><?= $dpt['resource_meta_desc'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Meta Description for Arabic</label>
                                <textarea name="txt_meta_desc_ar" rows="3" class="form-control"><?= $dpt['resource_meta_desc_ar'];?></textarea>
                            </div>
                            <div class="col-sm-12 form-group" style="display:none">
                                <label>Detail Description</label>
                                <textarea name="txt_desc" rows="6" class="form-control editor1"><?= $dpt['resource_description'];?></textarea>
                            </div>
                            <div class="col-sm-12 form-group" style="display:none">
                                <label>Detail Description</label>
                                <textarea name="txt_desc_arabic" rows="6" class="form-control"><?= $dpt['resource_description_arabic'];?></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Status</label>
                                <select class="form-control" name="txt_status" required>
                                    <option selected disabled>Department Staus</option>
                                    <option value="1" <?= ($dpt['resource_active'] == 1) ? 'selected' : '';?>>Active</option>
                                    <option value="0" <?= ($dpt['resource_active'] == 0) ? 'selected' : '';?>>Un Active</option>
                                </select>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>list-resource" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_edit_dpt" class="btn btn-success" value="Save">
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
    bkLib.onDomLoaded(function() { toggleArea1(); toggleArea2(); toggleArea3(); toggleArea4(); });
</script>