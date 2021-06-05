<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$doc_id = get_sess("userdata")['doc_id'];
$btn_name = "btn_save_service";
if(isset($_GET['serv_id']) && $_GET['serv_id'] != null && $_GET['serv_id'] != "" && $_GET['serv_id'] > 0)
{
    $srvId = $_GET['serv_id'];
    $sql = query("SELECT * FROM tbl_doc_clinicalServices where c_id = '$srvId'");
    $fetch = fetch($sql);
    $btn_name = "btn_edit_service";
}

?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Clinnical Services</h1>
            <small>Manage Clinical Services</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Clinical Services</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <h3>Manage clinical Services</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <form  action="<?= admin_base_url()?>model/servicesModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                <input type="hidden" name="txt_doc_id" value="<?= $doc_id; ?>">
                                <?php
                                if(isset($_GET['serv_id']))
                                {
                                    ?>
                                    <input type="hidden" name="txt_serv_id" value="<?= $fetch['c_id']; ?>">
                                    <?php
                                }
                                ?>
                                <div class="col-sm-6 form-group">
                                    <label>Service title</label>
                                    <input type="text" name="txt_cer_name" <?= (isset($_GET['serv_id'])) ? 'value="'.$fetch['c_name'].'"' : '';?> class="form-control" placeholder="Enter Service Name" required>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Service Title Arabic</label>
                                    <input type="text" name="arabic_cer_title" <?= (isset($_GET['serv_id'])) ? 'value="'.$fetch['c_name_ar'].'"' : '';?> class="form-control" placeholder="Serive Title Arabic" required>
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label>Description</label>
                                    <textarea name="txt_short_desc" rows="3" class="form-control" id="txt_desc"><?= (isset($_GET['serv_id'])) ? $fetch['c_desc'] : '';?></textarea>
                                </div>
                                <div class="col-sm-12 form-group">
                                    <label>Description Arabic</label>
                                    <textarea name="txt_short_desc_arabic" rows="3" class="form-control" id="txt_desc_arabic"><?= (isset($_GET['serv_id'])) ? $fetch['c_desc_ar'] : '';?></textarea>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Service Image</label>
                                    <input type="file" name="cer_profile" class="form-control"  onchange="checkFileSize('cer_profile');" id="txt_profile" <?= (isset($_GET['serv_id'])) ? '' : 'required';?>>
                                    <label class="txt_profile"></label>
                                </div>
                                <div class="col-sm-6">
                                    <label class="btn-block">Action</label>
                                    <input type="submit" name="<?= $btn_name; ?>" class="btn btn-success" value="Save">
                                </div>
                            </form>
                        </div>
                        <br>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sr#</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Active?</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = query("SELECT * FROM tbl_doc_clinicalServices where c_doc_id = '$doc_id'");
                                        $i=0;
                                        while ($row = fetch($sql))
                                        {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><img style="width:80px;height:80px" src="<?= file_url().$row['c_image'];?>"></td>
                                                <td><?= $row['c_name']; ?></td>
                                                <td><?= ($row['c_active'] == 1) ? 'Active' : 'Not Active' ; ?></td>
                                                <td>
                                                    <a href="<?= admin_base_url();?>clinical-services?serv_id=<?= $row['c_id']; ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                                                    <a href="<?= admin_base_url();?>model/servicesModel?act=del-serv&serv_id=<?= $row['c_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
    
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require_once('layout/footer.php');?>
<script src="<?= admin_base_url();?>assets/plugins/niceedit/nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
	$(document).ready(function(){
	    $(".select2").select2();
	});
</script>
<?php
get_msg('msg');
?>