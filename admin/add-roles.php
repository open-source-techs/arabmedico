<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
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
            <h1>Roles & Permissions</h1>
            <small>Add New Role</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add Roles</li>
            </ol>
        </div>
    </section>
	<section class="content">
		<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>roles"> <i class="fa fa-list"></i> Roles List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/roleModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-12 form-group">
                                <label>Role Name</label>
                                <input type="text" name="role_name" class="form-control" placeholder="Enter Role Name" required>
                            </div>
                            <div class="col-sm-12 form-check">
                            	<label>Assign Modules</label><br>
                            	<div class="row">
								<?php
								$i = 0;
								$get_permissions = query("select * from tbl_navigation");
								while ($permit = fetch($get_permissions))
								{
									$i++;
									if($permit['nav_is_have_child'])
									{
										?>
										<div class="col-sm-12">
											<label class="radio-inline">
			                                  	<input type="checkbox" name="permissions[]" value="<?php echo $permit['nav_id']; ?>"> Manage <?php echo $permit["nav_name"]; ?>
			                                </label>
										</div>
										<?php
									}
									else
									{
										if($i == 1)
										{
											?>
											<div class="col-sm-12">
												<label class="radio-inline">
				                                  	<input type="checkbox" name="permissions[]" value="<?php echo $permit['nav_id']; ?>"> Manage <?php echo $permit["nav_name"]; ?>
				                                </label>
											</div>
											<?php
										}
										else
										{
											?>
											<div class="col-sm-1"></div>
											<div class="col-sm-3">
												<label class="radio-inline">
				                                  	<input type="checkbox" name="permissions[]" value="<?php echo $permit['nav_id']; ?>"> Manage <?php echo $permit["nav_name"]; ?>
				                                </label>
											</div>
											<?php
										}
									}
								}
			                	?>
                            	</div>
			                </div>
							<div class="col-sm-12 reset-button">
								<a href="<?= admin_base_url();?>roles" class="btn btn-warning">Cancel & Go Back</a>
								<input type="submit" name="btn_save_role" class="btn btn-success" value="Save" />
							</div>
						</form>
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