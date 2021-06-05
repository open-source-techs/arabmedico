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
            <h1>Roles &  Permission</h1>
            <small>User Role & Permission List</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">Roles & Permission</li>
            </ol>
        </div>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-success" href="<?= admin_base_url();?>add-roles"> <i class="fa fa-plus"></i> Add Role
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
                                        <th>Sr</th>
                                        <th>Role Name</th>
                                        <th>Staus </th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php
                                    $i = 0;
                                	$sql = query("SELECT * FROM tbl_admin_roles");
                                	while ($row = fetch($sql))
                                	{
                                        $i++;
                                		?>
                                		<tr>
                                			<td><?= $i; ?></td>
                                			<td><?= $row['role_name'];?></td>
                                			<td><?= ($row['role_active'] == 1) ? "Active" : "Non Active";?></td>
                                			<td>
	                                            <a href="<?= admin_base_url();?>edit-role?roleID=<?= $row['role_id'];?>" class="btn btn-info btn-xs" ><i class="fa fa-pencil"></i>
	                                            </a>
	                                            <a href="<?= admin_base_url();?>model/roleModel?act=del-role&roleID=<?= $row['role_id']; ?>" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#ordine"><i class="fa fa-trash-o"></i>
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