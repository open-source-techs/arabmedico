<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$btName = "btn_save_treatment";
if(isset($_GET['treatment_id']))
{
    $treatment_id = $_GET['treatment_id'];
    if($treatment_id == 0 || $treatment_id == '' || $treatment_id < 0)
    {
        ?>
        <script>
          window.location.href="<?php echo admin_base_url(); ?>conditions-treatments";
        </script>
        <?php
    }
    $sql = query("SELECT * FROM tbl_treatment where treatment_id = '$treatment_id'");
    $treatment = fetch($sql);
    $btName = "btn_edit_treatment";
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
            <h1>Treatment</h1>
            <small>Add New Treatment</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add Treatment</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/specialty_treatment_Model" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" name="treatment_id" value="<?= $treatment['treatment_id'];?>">
                            <div class="col-sm-6 form-group">
                                <label>Treatment Name</label>
                                <input type="text" name="treatment_name" value="<?= isset($_GET['treatment_id']) ? $treatment['treatment_name'] : '' ?>" class="form-control" placeholder="Enter treatment Name" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Treatment Name Arabic</label>
                                <input type="text" name="treatment_name_ar" value="<?= isset($_GET['treatment_id']) ? $treatment['treatment_ar_name'] : '' ?> " class="form-control" placeholder="Enter Treatment Name Arabic" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Specialty</label>
                                <select name="select_specialty" class="form-control select2" required>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_specialty WHERE specialty_status = 1");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                         <option <?=( (isset($_GET['treatment_id'])) && ($treatment['select_specialty'] == $row['specialty_id']) ) ? 'selected' : ''?> value="<?= $row['specialty_id'];?>"><?= $row['specialty_name'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
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
                                        <th>Name</th>
                                        <th>Arabic Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_treatment");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><?= $row['treatment_name'];?></td>
                                            <td><?= $row['treatment_ar_name'];?></td>
                                            <td><?= ($row['treatment_status'] == 1) ? 'Active' : "Not Active";?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>conditions-treatments?treatment_id=<?= $row['treatment_id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?= admin_base_url();?>model/specialty_treatment_Model?act_treatment=del&treatment_id=<?= $row['treatment_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
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
<script src="<?= admin_base_url();?>assets/plugins/niceedit/nicEdit.js" type="text/javascript"></script>
<?php
get_msg('msg');
?>