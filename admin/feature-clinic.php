<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Features</h1>
            <small>Add Feature Clinic</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add Clinic</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/featureModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label>Select Clinic</label>
                                <select name="txt_clinic"  id="doctor" class="form-control select2" required>
                                    <option>Select Clinic</option>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_clinic WHERE clinic_active = 1");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <option value="<?= $row['clinic_id'];?>"><?= $row['clinic_name'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Start Date</label>
                                <input type="date" name="txt_startDate" class="form-control">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Select Tenure</label>
                                <select name="txt_tenure" class="form-control select2" required>
                                    <option value="quater">3 Months</option>
									<option value="half">6 Months</option>
									<option value="full">1 Year</option>
                                    <option value="fix">Permanent</option>
                                </select>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <input type="submit" name="btn_save_clinic" class="btn btn-success" value="Save">
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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Start Date</th>
                                        <th>Tenure</th>
                                        <th>End Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_feature_clinic fc JOIN tbl_clinic c ON (fc.f_clinic_id = c.clinic_id)");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><img style="width:auto;height:50px" src="<?= file_url().$row['clinic_icon'];?>" > </td>
                                            <td><?= $row['clinic_name'];?></td>
                                            <td><?= $row['clinic_phone'];?></td>
                                            <td><?= date("d/m/Y",strtotime($row['f_start_date']));?></td>
                                            <td><?= ($row['f_tenure'] == "quater") ? '3 Months' : (($row['f_tenure'] == "half") ? '6 Months' : (($row['f_tenure'] == "full") ? '1 Year' : 'Permanent' )); ?> </td>
                                            <td><?= date("d/m/Y",strtotime($row['f_end_date']));?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>model/featureModel?act=del-clinic&f_id=<?= $row['f_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<?php
get_msg('msg');
?>
<script type="text/javascript">
    $(document).ready(function(){
        $(".select2").select2();
    });
</script>