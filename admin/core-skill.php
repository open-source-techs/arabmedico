<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$btName = "btn_save_skill";
if(isset($_GET['skill_id']))
{
    $skill_id = $_GET['skill_id'];
    if($skill_id == 0 || $skill_id == '' || $skill_id < 0)
    {
        ?>
        <script>
          window.location.href="<?php echo admin_base_url(); ?>core-skill";
        </script>
        <?php
    }
    $sql = query("SELECT * FROM tbl_can_coreskill where core_id = '$skill_id'");
    $coreSkill = fetch($sql);
    $btName = "btn_edit_skill";
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
            <h1>Core Skill</h1>
            <small><?= (isset($_GET['skill_id'])) ? 'Edit' :  'Add New' ;?> Skill</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active"><?= (isset($_GET['skill_id'])) ? 'Edit' :  'Add New' ;?> Skill</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/candidateModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                             <input type="hidden" name="core_id" value="<?= isset($_GET['skill_id']) ? $coreSkill['core_id'] : '' ?>">
                            <div class="col-sm-6 form-group">
                                <label>Skill Name</label>
                                <input type="text" name="coreSkill_name" class="form-control" value="<?= isset($_GET['skill_id']) ? $coreSkill['core_name'] : '' ?>" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Skill Name Arabic</label>
                                <input type="text" name="coreSkill_name_ar" value="<?= isset($_GET['skill_id']) ? $coreSkill['core_name_ar'] : '' ?>" class="form-control" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Specialty</label>
                                <select name="select_specialty" class="form-control select2" required>
                                    <option selected disabled> Select option</option>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_candiate_speciality WHERE can_speciality_active = 1");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                         <option <?=( (isset($_GET['skill_id'])) && ($coreSkill['core_speciality'] == $row['can_speciality_id']) ) ? 'selected' : ''?> value="<?= $row['can_speciality_id'];?>"><?= $row['can_speciality_name'];?></option>
                                        <?php
                                    }
                                    ?>
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
                                        <th>Name</th>
                                        <th>Arabic Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_can_coreskill");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><?= $row['core_name'];?></td>
                                            <td><?= $row['core_name_ar'];?></td>
                                            <td><?= ($row['core_active'] == 1) ? 'Active' : "Not Active";?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>core-skill?skill_id=<?= $row['core_id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?= admin_base_url();?>model/candidateModel?act_coreSkill=del&skill_id=<?= $row['core_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
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