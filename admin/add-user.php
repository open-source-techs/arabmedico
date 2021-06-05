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
            <h1>Admin Panel Users</h1>
            <small>Add New User</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add User</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>users"> <i class="fa fa-list"></i> User List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/adminUser" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>First Name</label>
                                <input type="text" name="txt_fname" class="form-control" placeholder="Enter First Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Last Name</label>
                                <input type="text" name="txt_lname" class="form-control" placeholder="Enter Last Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Email</label>
                                <input type="email" name="txt_email" class="form-control" placeholder="Enter Email" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Phone</label>
                                <input type="tel" name="txt_phone" class="form-control" placeholder="Enter Phone" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Username</label>
                                <input type="text" name="txt_username" class="form-control" placeholder="Enter Username" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>User Type</label>
                                <select class="form-control" name="txt_user_type" required>
                                    <option selected disabled>Select User Type</option>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_admin_roles WHERE role_active = 1");
                                    while($row = fetch($sql))
                                    {
                                        ?>
                                        <option value="<?= $row['role_id'];?>"><?= $row['role_name'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Password</label>
                                <input type="password" name="txt_password" class="form-control" placeholder="Enter Password" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="txt_cnf_passwod" class="form-control" placeholder="Confirm Password" required>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <a href="<?= admin_base_url();?>users" class="btn btn-warning">Cancel & Go Back</a>
                                <input type="submit" name="btn_save_user" class="btn btn-success" value="Save">
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