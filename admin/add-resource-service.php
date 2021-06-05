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
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>Services Panel</h1>
            <small>Manage Services</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li>
                    <a href="<?= admin_base_url();?>list-resource">
                		<i class="pe-7s-home"></i> Patient Resources
                	</a>
                </li>
                <li class="active">Manage Services</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <!--<a class="btn btn-primary" href="<?= admin_base_url();?>all-certificates"> <i class="fa fa-list"></i> Services List </a>  -->
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/resourceModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            
                            <div class="dynamic_fields">
                                <?php
                                $sql = query("SELECT * FROM tbl_resource_service WHERE resource_depart_id = '$dpt_id' ORDER BY resource_service_id ASC");
                                if(nrows($sql) > 0)
                                {
                                    $i = 0;
                                    while ($row = fetch($sql))
                                    {
                                        $i++;
                                        ?>
                                        <div class="div-<?= $i;?>">
                                            <div class="col-md-12">
                                                <button class="btn btn-sm btn-danger pull-right btn_remove_record" type="button" data-row-id="<?= $i;?>"> Remove Record</button>
                                            </div>
                                            <input type="hidden" value="<?= $row['resource_service_id'];?>" name="txt_service_id[]">
                                            <div class="col-sm-6 form-group">
                                                <label>Service title</label>
                                                <input type="text" name="txt_cer_name[]" value="<?= $row['resource_service_title'];?>" class="form-control" placeholder="Enter Service Name" required>
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label>Service Title Arabic</label>
                                                <input type="text" name="arabic_cer_title[]" value="<?= $row['resource_service_title_arabic'];?>" class="form-control" placeholder="Serive Title Arabic" required>
                                            </div>
                                            <div class="col-sm-12 form-group">
                                                <label>Description</label>
                                                <textarea name="txt_short_desc[]" rows="3" class="form-control" id="txt_desc"><?= htmlspecialchars_decode($row['resource_service_desc']);?></textarea>
                                            </div>
                                            <div class="col-sm-12 form-group">
                                                <label>Description Arabic</label>
                                                <textarea name="txt_short_desc_arabic[]" rows="3" class="form-control" id="txt_desc_arabic"><?= htmlspecialchars_decode($row['resource_service_desc_arabic']);?></textarea>
                                            </div>
                                        </div>
                                        <?php
                                        
                                    }
                                }
                                else
                                {
                                    $i = 1;
                                    ?>
                                    <div class="div-1">
                                        <input type="hidden" value="0" name="txt_service_id[]">
                                        <div class="col-sm-6 form-group">
                                            <label>Service title</label>
                                            <input type="text" name="txt_cer_name[]" class="form-control" placeholder="Enter Service Name" required>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label>Service Title Arabic</label>
                                            <input type="text" name="arabic_cer_title[]" class="form-control" placeholder="Serive Title Arabic" required>
                                        </div>
                                        <div class="col-sm-12 form-group">
                                            <label>Description</label>
                                            <textarea name="txt_short_desc[]" rows="3" class="form-control" id="txt_desc"></textarea>
                                        </div>
                                        <div class="col-sm-12 form-group">
                                            <label>Description Arabic</label>
                                            <textarea name="txt_short_desc_arabic[]" rows="3" class="form-control" id="txt_desc_arabic"></textarea>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <input type="hidden" name='dpt_id' value="<?= $dpt_id; ?>">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-sm btn-success pull-right" id="btn_new_record" data-next-row="<?= $i+1; ?>">Add New Record</button>
                            </div>
                            
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>list-resource" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_save_service" class="btn btn-success" value="Save">
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<?php
get_msg('msg');
?>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
	$(document).ready(function(){
	    
	    $('body').delegate('.btn_remove_record', 'click', function(){
	        var divId = $(this).attr('data-row-id');
	        $(".div-"+divId).remove();
	    });
	    
	    $("#btn_new_record").click(function(e){
	        e.preventDefault();
	        var nextId = $(this).attr('data-next-row');
	        var div = '<div class="div-'+nextId+'">'+
	            '<div class="col-md-12">'+
                    '<button class="btn btn-sm btn-danger pull-right btn_remove_record" type="button" data-row-id="'+nextId+'"> Remove Record</button>'+
                '</div>'+
                '<input type="hidden" value="0" name="txt_service_id[]">'+
                '<div class="col-sm-6 form-group">'+
                    '<label>Service title</label>'+
                    '<input type="text" name="txt_cer_name[]" class="form-control" placeholder="Enter Service Name" required>'+
                '</div>'+
                '<div class="col-sm-6 form-group">'+
                    '<label>Service Title Arabic</label>'+
                    '<input type="text" name="arabic_cer_title[]" class="form-control" placeholder="Serive Title Arabic" required>'+
                '</div>'+
                '<div class="col-sm-12 form-group">'+
                    '<label>Description</label>'+
                    '<textarea name="txt_short_desc[]" rows="3" class="form-control" id="txt_desc'+nextId+'"></textarea>'+
                '</div>'+
                '<div class="col-sm-12 form-group">'+
                    '<label>Description Arabic</label>'+
                    '<textarea name="txt_short_desc_arabic[]" rows="3" class="form-control" id="txt_desc_arabic'+nextId+'"></textarea>'+
                '</div>'+
            '</div>';
            $(".dynamic_fields").append(div);
            var nextId1 = parseInt(nextId) + parseInt(1);
            $(this).attr('data-next-row', nextId1);
            var myNicEditor1 = new nicEditor({fullPanel : true});
            myNicEditor1.panelInstance("txt_desc"+nextId,{hasPanel : true});
            myNicEditor1.panelInstance("txt_desc_arabic"+nextId,{hasPanel : true});
            
	    });
	});
</script>