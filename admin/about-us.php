<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Website settings</h1>
            <small>About US</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Settings</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <?php
                        $sql = query("SELECT * FROM tbl_settings");
                        if(nrows($sql) > 0)
                        {
                            $data = fetch($sql);
                            ?>
                            <form  action="<?= admin_base_url()?>model/webModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                <div class="col-sm-12 form-group">
                                    <label>About Us Page</label>
                                    <input type="hidden" value="<?= $data['setting_id']?>" name="txt_site_id" >
                                    <textarea name="txt_desc" rows="6" class="form-control"><?= html_entity_decode(htmlspecialchars_decode($data['about_us']))?></textarea>
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label>About Us Page Arabic</label>
                                    <textarea name="txt_desc_arabic" rows="6" class="form-control"><?= $data['about_us_arabic']?></textarea>
                                </div>
                                <div class="col-sm-12 reset-button">
                                    <input type="submit" name="btn_save_aboutus" class="btn btn-success" value="Save">
                                </div>
                            </form>
                            <?php
                        }
                        ?>
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
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>