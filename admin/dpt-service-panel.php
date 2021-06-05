<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$dpt_id = $_GET['dpt_id'];
if($dpt_id == 0 || $dpt_id == '' || $dpt_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>list-department";
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
            <form action="#" method="get" class="sidebar-form search-box pull-right hidden-md hidden-lg hidden-sm">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>   
            <h1>Services Panel</h1>
            <small>Services list</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li>
                    <a href="<?= admin_base_url();?>list-department">
                		<i class="pe-7s-home"></i> Departments
                	</a>
                </li>
                <li class="active">Services</li>
            </ol>
        </div>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-success" href="<?= admin_base_url();?>add-dpt-service?dpt_id=<?= $dpt_id; ?>"> <i class="fa fa-plus"></i> Add New Item
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
                                        <th>Images</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_dpt_service WHERE dpt_depart_id = '$dpt_id'");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                $ext = pathinfo($row['dpt_service_img'], PATHINFO_EXTENSION);
                							    if($ext == "jpeg" || $ext == "jpg" || $ext == "png" || $ext == "gif" || $ext == "jfif")
                							    {
                							        ?>
                    								<img class="img-fluid" src="<?= file_url().$row['dpt_service_img'];?>" alt="tab-image" style="width:auto;height:150px" />
                							        <?php
                							    }
                							    else if($ext == "webm" || $ext == "mpg" || $ext == "mp2" || $ext == "mpeg" || $ext == "mpv" || $ext == "mp4" || $ext == "ogg")
                							    {
                							        ?>
                									<video controls id="myvid" style="width:auto;height:150px">
                                                        <source src="<?= file_url().$row['dpt_service_img'];?>" type="video/mp4">
                                                    </video>
                							        <?php
                							    }
                                                ?>
                                            </td>
                                            <td><?= $row['dpt_service_title'];?></td>
                                            <td><?= ($row['dpt_service_active'] == 1) ? 'Active' : "Not Active";?></td>
                                            <td><?= date("d/m/Y",strtotime($row['dpt_service_created']));?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>edit-dpt-service?service=<?= $row['dpt_service_id'];?>&dpt_id=<?= $dpt_id;?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?= admin_base_url();?>model/departmentModel?act=del-dpt-ser&service=<?= $row['dpt_service_id'];?>&dpt_id=<?= $dpt_id;?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
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
<?php
get_msg('msg');
?>