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
            <small>Add Feature Doctor</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Add Doctor</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/featureModel" method="POST" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <div class="col-sm-6 form-group">
                                    <label>Select Doctor</label>
                                    <select name="txt_doctor"  id="doctor" class="form-control select2" required>
                                        <option>Select Doctor</option>
                                        <?php
                                        $sql = query("SELECT * FROM tbl_doctor WHERE doc_active = 1");
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <option value="<?= $row['doc_id'];?>"><?= $row['doc_name'];?></option>
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
                                <div class="col-sm-6 form-group">
                                    <label>Enable Feature for Home Page</label>
                                    <select name="txt_homefeature" id="txt_homefeature" class="form-control" required>
                                        <option value="no">NO</option>
                                        <option value="yes">YES</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" id="home_div" style="display:none">
                                <div class="col-sm-6 form-group">
                                    <label>Start Date</label>
                                    <input type="date" name="txt_homeStartDate" id="txt_homeStartDate" class="form-control">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Select Tenure</label>
                                    <select name="txt_homeTenure" id="txt_homeTenure" class="form-control">
                                        <option value="">Select One</option>
                                        <option value="quater">3 Months</option>
                                        <option value="half">6 Months</option>
                                        <option value="full">1 Year</option>
                                        <option value="fix">Permanent</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <input type="submit" name="btn_save_doctor" class="btn btn-success" value="Save">
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
                                        <th>Email</th>
                                        <th>List Tenure</th>
                                        <th>Start Date</th>
                                        <th>Landing Feature</th>
                                        <th>Home Tenure</th>
                                        <th>Start Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_feature_doctor fd JOIN tbl_doctor d ON (fd.f_doctor_id = d.doc_id)");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><img style="width:auto;height:50px" src="<?= file_url().$row['doc_image'];?>" > </td>
                                            <td><?= $row['doc_name'];?></td>
                                            <td><?= $row['doc_email'];?></td>
                                            <td><?= ($row['f_tenure'] == "quater") ? '3 Months' : (($row['f_tenure'] == "half") ? '6 Months' : (($row['f_tenure'] == "full") ? '1 Year' : 'Permanent' )); ?> </td>
                                            <td><?= date("d/m/Y",strtotime($row['f_start_date']));?></td>
                                            <td><?= strtoupper($row['f_home']);?></td>
                                            <td><?= ($row['f_home_tenure'] == "quater") ? '3 Months' : (($row['f_home_tenure'] == "half") ? '6 Months' : (($row['f_home_tenure'] == "full") ? '1 Year' : (($row['f_home_tenure'] == "fix") ? 'Permanent' : 'N/A') )); ?> </td>
                                            <td><?= ($row['f_home_start'] != null) ? date("d/m/Y",strtotime($row['f_home_start'])) : 'N/A';?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>model/featureModel?act=del-doc&f_id=<?= $row['f_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
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
        $("#txt_homefeature").change(function(){
            if($(this).val() == "yes")
            {
                $("#home_div").show();
            }
            else if($(this).val() == "no")
            {
                $("#home_div").hide();
                $("#txt_homeStartDate").val("");
                $("#txt_homeTenure").val("");
            }
        });
    });
</script>