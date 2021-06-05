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
<style>
    /* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
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
            <h1>Video/Image Panel</h1>
            <small>Video/Image list</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li>
                    <a href="<?= admin_base_url();?>list-resource">
                		<i class="pe-7s-home"></i> Patient Resource
                	</a>
                </li>
                <li class="active">Video / Image</li>
            </ol>
        </div>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-success" href="<?= admin_base_url();?>add-resource-video?dpt_id=<?= $dpt_id; ?>"> <i class="fa fa-plus"></i> Add New Item
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="panel-header">
                                <div class="col-sm-4 col-xs-12">
                                    <div class="dataTables_length">
                                        <label>Display 
                                            <select name="example_length">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select> records per page</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="dataTables_length">
                                         <a class="btn btn-default buttons-copy btn-sm" tabindex="0">
                                             <span>Copy</span></a>
                                             <a class="btn btn-default buttons-csv buttons-html5 btn-sm" tabindex="0"><span>CSV</span></a>
                                             <a class="btn btn-default buttons-excel buttons-html5 btn-sm" tabindex="0"><span>Excel</span></a>
                                             <a class="btn btn-default buttons-pdf buttons-html5 btn-sm" tabindex="0"><span>PDF</span></a>
                                             <a class="btn btn-default buttons-print btn-sm" tabindex="0"><span>Print</span></a>
                                             
                                         </div>
                                     </div>
                                     <div class="col-sm-4 col-xs-12">
                                        <div class="dataTables_length">
                                            <div class="input-group custom-search-form">
                                                <input type="search" class="form-control" placeholder="search..">
                                                <span class="input-group-btn">
                                                  <button class="btn btn-primary" type="button">
                                                      <span class="glyphicon glyphicon-search"></span>
                                                  </button>
                                              </span>
                                          </div><!-- /input-group -->
                                      </div>
                                  </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Arabic Item</th>
                                        <th>Status</th>
                                        <th>Active</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_resource_gallery WHERE resource_gallery_depart = '$dpt_id' ");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <?php
                                            if($row['resource_gallery_is_video'] == 1)
                                            {
                                                if($row['resource_gallery_is_link'] == 1)
                                                {
                                                    ?>
                                                    <td style="width:200px;height:auto">
                                                        <?= $row['resource_gallery_video']; ?>
                                                    </td>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <td>
                                                        <video style="width:200px;height:auto;" controls>
                                                            <source src="<?= file_url().$row['resource_gallery_video'];?>" type="video/mp4">
                                                        </video>
                                                    </td>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <td><img class="img-responsive" style="width:200px;height:auto;" src="<?= file_url().$row['resource_gallery_image'];?>"></td>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                            
                                            if($row['resource_gallery_is_video'] == 1 && $row['resource_gallery_video_ar'] != "" && $row['resource_gallery_video_ar'] != null)
                                            {
                                                if($row['resource_gallery_is_link'] == 1)
                                                {
                                                    ?>
                                                    <td style="width:200px;height:auto">
                                                        <?= $row['resource_gallery_video_ar']; ?>
                                                    </td>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <td>
                                                        <video style="width:200px;height:auto;" controls>
                                                            <source src="<?= file_url().$row['resource_gallery_video_ar'];?>" type="video/mp4">
                                                        </video>
                                                    </td>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                if($row['resource_gallery_image_ar'] != null && $row['resource_gallery_image_ar'] != '')
                                                {
                                                    ?>
                                                    <td><img class="img-responsive" style="width:200px;height:auto;" src="<?= file_url().$row['resource_gallery_image_ar'];?>"></td>
                                                    <?php
                                                }
                                                else
                                                {
                                                    echo "<td>&nbsp;</td>";
                                                }
                                            }
                                            ?>
                                            
                                            
                                            
                                            <td>
                                                <?php
                                                if($row['resource_gallery_is_video'] == 1)
                                                {
                                                    ?>
                                                    <label class="switch">
                                                        <input type="checkbox" <?= ($row['resource_gallery_video_show'] == 1) ? 'checked' : ''; ?> class="btn_switch" data-dpt="<?= $row['resource_gallery_depart']; ?>" data-id="<?= $row['resource_gallery_id']; ?>" id="active_home<?= $row['resource_gallery_id']; ?>" value="1">
                                                        <span class="slider round"></span>
                                                    </label>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td><?= ($row['resource_gallery_active'] == 1) ? 'Active' : "Not Active";?></td>
                                            <td><?= date("d/m/Y",strtotime($row['resource_gallery_created_at']));?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>edit-resource-video?dpt_id=<?= $dpt_id; ?>&gal_id=<?= $row['resource_gallery_id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?= admin_base_url();?>model/resourceModel?act=del-item&gal_id=<?= $row['resource_gallery_id']; ?>&dpt_id=<?= $row['resource_gallery_depart']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="page-nation text-right">
                            <ul class="pagination pagination-large">
                                <li class="disabled"><span>«</span></li>
                                <li class="active"><span>1</span></li>
                                <li><a href="#">2</a></li>
                                <li class="disabled"><span>...</span></li><li>
                                <li><a rel="next" href="#">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php require_once('layout/footer.php');?>
<script>
    $('body').delegate('.btn_switch','change',function(e)
    {
        e.preventDefault();
        var slide_id    = $(this).attr('data-id');
        var depar_id    = $(this).attr('data-dpt');
        var act         = "change_status";
        var value       = "deactive";
        if($(this).is(":checked"))
        {
            var value       = "active";
        }
        $.ajax({
            data: {sl_id: slide_id, action: act, val: value, dpt_id:depar_id},
            type: "POST",
            url: "<?= admin_base_url();?>model/resourceModel",
            success:function(responce){
                var res = $.parseJSON(responce);
                if(res.status == "done")
                {
                    swal({
                        title: "Success...!!!",
                        text: res.responce,
                        type: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "OK"
                    },
                    function () {
                        window.location.reload();
                    });
                }
                else if(res.status == "error")
                {
                    swal({
                        title: "ERROR...!!!",
                        text: res.responce,
                        type: "danger",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "OK"
                    },
                    function () {
                        window.location.reload();
                    });
                }
            }
        });
        
    });
</script>
<?php
get_msg('msg');
?>