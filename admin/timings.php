<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Website settings</h1>
            <small>Website Settings</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Settings</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <form action="<?= admin_base_url();?>model/timingModel" method="POST">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="days">Select English day</label>
                                    <select name="days" class="form-control" required>
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
                                <div class="form-group col-sm-6">
                                    <label for="default-picker">Time Open</label>
                                    <input type="text" class="form-control" name="time_open" placeholder="Select opening time">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="default-pickerr">Closs Open</label>
                                    <input type="text" class="form-control" name="time_closs" placeholder="Select closing time">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="days">Select Arabic day</label>
                                    <select name="days_arabic" class="form-control" required>
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
                                <div class="form-group col-sm-6">
                                    <label for="default-picker">Time Open in Arabic</label>
                                    <input type="text" class="form-control" name="time_open_arabic" placeholder="Select opening time in Arabic">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="default-pickerr">Closs Open in Arabic</label>
                                    <input type="text" class="form-control" name="time_closs_arabic" placeholder="Select closing time in Arabic">
                                </div>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <input type="submit" name="btn_save" class="btn btn-success" value="Save">
                            </div>
                        </form>
                        <table class="table-responsive table table-striped">
                            <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>Day</th>
                                    <th>Time Start</th>
                                    <th>Time End</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = query("SELECT * FROM tbl_timings");
                            $i = 0;
                            while($time= fetch($sql))
                            {
                                $i++;
                                ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $time['timing_day'];?></td>
                                    <td><?= $time['timing_open'];?></td>
                                    <td><?= $time['timing_close'];?></td>
                                    <td>
                                        <a href="<?= admin_base_url();?>edit-timing?tid=<?= $time['timing_id']; ?>" class="btn btn-info btn-xs" name="btn_edit_time"><i class="fa fa-pencil"></i></a>
                                        <a href="<?= admin_base_url();?>model/timingModel?act=del&tid=<?= $time['timing_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
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
    </section>
</div>
<?php require_once('layout/footer.php');?>
<?php
get_msg('msg');
?>