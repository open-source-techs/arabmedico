<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
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
            <h1>Patient Resources</h1>
            <small>Resource list</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">Patient Resources</li>
            </ol>
        </div>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-success" href="<?= admin_base_url();?>add-resource"> <i class="fa fa-plus"></i> Add Resource
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
                                        <th>More Info</th>
                                        <th>Icon</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_resources");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td>
                                                <a class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Video Panel" href="<?= admin_base_url();?>resource-video-panel?dpt_id=<?= $row['resource_id']; ?>">
                                                    <i class="fa fa-video-camera"></i>
                                                </a>
                                                <a class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Packages Panel" href="<?= admin_base_url();?>add-resource-service?dpt_id=<?= $row['resource_id']; ?>">
                                                    <i class="fa fa-sitemap"></i>
                                                </a>
                                            </td>
                                            <td><img style="width:auto;height:50px" src="<?= file_url().$row['resource_icon_name'];?>" > </td>
                                            <td><?= $row['resource_name'];?></td>
                                            <td><?= ($row['resource_active'] == 1) ? 'Active' : "Not Active";?></td>
                                            <td><?= date("d/m/Y",strtotime($row['resource_created_at']));?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>edit-resource?dpt_id=<?= $row['resource_id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?= admin_base_url();?>model/resourceModel?act=del&dpt_id=<?= $row['resource_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
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
                                <li class="disabled"><span>??</span></li>
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