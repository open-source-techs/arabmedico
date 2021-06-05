<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$btName = "btn_save_specialty";
if(isset($_GET['specialty_id']))
{
    $specialty_id = $_GET['specialty_id'];
    if($specialty_id == 0 || $specialty_id == '' || $specialty_id < 0)
    {
        ?>
        <script>
          window.location.href="<?php echo admin_base_url(); ?>candidate-specialities";
        </script>
        <?php
    }
    $sql = query("SELECT * FROM tbl_candiate_speciality where can_speciality_id = '$specialty_id'");
    $specialty = fetch($sql);
    $btName = "btn_edit_specialty";
}

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
            <h1>Candidate Specialty</h1>
            <small>Add New Specialty</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add Specialty</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/candidateModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                             <input type="hidden" name="specialty_id" value="<?= $specialty['can_speciality_id'];?>">
                            <div class="col-sm-6 form-group">
                                <label>Specialty Name</label>
                                <input type="text" name="specialty_name" class="form-control" value="<?= $specialty['can_speciality_name'];?>" placeholder="Enter Specialty Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Specialty Name Arabic</label>
                                <input type="text" name="specialty_name_ar" value="<?= $specialty['can_speciality_name_ar'];?>" class="form-control" placeholder="Enter Specialty Name Arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Specialty Icon</label>
                                <input type="file" name="specialty_icon" class="form-control" <?= isset($_GET['specialty_id']) ? '' : 'required' ?>>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Status</label>
                                <select name="select_status" class="form-control select2" required>
                                    <option value="1">Active</option>
                                    <option value="0">Unactive</option>
                                </select>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <input type="submit" name="<?= $btName; ?>" class="btn btn-success" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="panel-header">
                                
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Icon</th>
                                        <th>Name</th>
                                        <th>Arabic Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_candiate_speciality");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><img class="img-fluid" src="<?= file_url().$row['can_speciality_icon'];?>" style="height:50px;width:50px;"></td>
                                            <td><?= $row['can_speciality_name'];?></td>
                                            <td><?= $row['can_speciality_name_ar'];?></td>
                                            <td><?= ($row['can_speciality_active'] == 1) ? 'Active' : "Not Active";?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>candidate-specialities?specialty_id=<?= $row['can_speciality_id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?= admin_base_url();?>model/candidateModel?act_specialty=del&specialty_id=<?= $row['can_speciality_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
                                                </a>
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
    </section>
</div>
<?php require_once('layout/footer.php');?>
<script src="<?= admin_base_url();?>assets/plugins/niceedit/nicEdit.js" type="text/javascript"></script>
<?php
get_msg('msg');
?>