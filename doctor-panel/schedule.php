<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>Schedule</h1>
            <small>Schedule list</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">Schedule</li>
            </ol>
        </div>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/scheduleModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" name='txt_doctor_id' value="<?= get_sess("userdata")['doc_id']; ?>">
                            <div class="col-sm-6 form-group">
                                <label>Working Day English</label>
                                <select name="txt_working_day" class="form-control" required>
                                    <option value="" selected disabled>Select Day</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Working Day Arabic</label>
                                <select name="txt_working_day_arabic" class="form-control" required>
                                    <option value="" selected disabled>Select Day</option>
                                    <option value="يَوم الإثنين">يَوم الإثنين</option>
                                    <option value="يَوم الثلاثاء">يَوم الثلاثاء</option>
                                    <option value="يَوم الأربعاء">يَوم الأربعاء</option>
                                    <option value="يَوم الخميس">يَوم الخميس</option>
                                    <option value="يَوم الجمعة">يَوم الجمعة</option>
                                    <option value="يَوم السبت">يَوم السبت</option>
                                    <option value="يَوم الأحَد">يَوم الأحَد</option>
                                </select>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <input type="submit" name="btn_save_date" class="btn btn-success" value="Save">
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
                        <h3>Schedule Details</h3>
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
                                          </div>
                                      </div>
                                  </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Date</th>
                                        <th>Arabic Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $sql = query("SELECT * FROM tbl_schedule_head WHERE schedule_doctor = '".get_sess("userdata")['doc_id']."' ");
                                    while ($row = fetch($sql))
                                    {
                                        $i++;
                                        ?>
                                        <tr>
                                            <td><?= $i;?></td>
                                            <td><?= $row['schedule_date'];?></td>
                                            <td><?= $row['schedule_date_ar'];?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>schedule-time?sch=<?= $row['schedule_id'] ?>" class="btn btn-warning btn-xs">Manage Timing</a>
                                                <a href="<?= admin_base_url();?>model/scheduleModel?act=del&sch=<?= $row['schedule_id'] ?>" class="btn btn-danger btn-xs">Delete</a>
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
<?php
get_msg('msg');
?>