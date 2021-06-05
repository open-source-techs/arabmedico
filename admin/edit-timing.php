<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$tid = $_GET['tid'];
if($tid == 0 || $tid == '' || $tid < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>timings";
    </script>
    <?php
}
$sql = query("SELECT * FROM tbl_timings where timing_id = '$tid'");
$time = fetch($sql);
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
            <h1>Timing</h1>
            <small>Edit Timing</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Edit Timing</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= admin_base_url();?>timings"> <i class="fa fa-list"></i> Timing List </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="<?= admin_base_url();?>model/timingModel" method="POST">
                            <div class="row">
                                <input type="hidden" id="timeID" class="form-control" value="<?= $time['timing_id']?>" name="timeID">
                                <div class="form-group col-sm-6">
                                    <label for="days">Select English day</label>
                                    <select name="days" class="form-control" required>
                                        <option value="" selected disabled>Select Day</option>
                                        <option <?= ($time['timing_day'] == "Monday") ? 'selected' : ''; ?> value="Monday">Monday</option>
                                        <option <?= ($time['timing_day'] == "Tuesday") ? 'selected' : ''; ?> value="Tuesday">Tuesday</option>
                                        <option <?= ($time['timing_day'] == "Wednesday") ? 'selected' : ''; ?> value="Wednesday">Wednesday</option>
                                        <option <?= ($time['timing_day'] == "Thursday") ? 'selected' : ''; ?> value="Thursday">Thursday</option>
                                        <option <?= ($time['timing_day'] == "Friday") ? 'selected' : ''; ?> value="Friday">Friday</option>
                                        <option <?= ($time['timing_day'] == "Saturday") ? 'selected' : ''; ?> value="Saturday">Saturday</option>
                                        <option <?= ($time['timing_day'] == "Sunday") ? 'selected' : ''; ?> value="Sunday">Sunday</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="default-picker">Time Open</label>
                                    <input type="text" class="form-control" name="time_open" value="<?= $time['timing_open']?>" placeholder="Select opening time">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="default-pickerr">Closs Open</label>
                                    <input type="text" class="form-control" name="time_close" value="<?= $time['timing_close']?>" placeholder="Select closing time">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="days">Select Arabic day</label>
                                    <select name="days_arabic" class="form-control" required>
                                        <option value="" selected disabled>Select Day</option>
                                        <option <?= ($time['timing_day_arabic'] == "يَوم الإثنين")  ? 'selected' : '';?> value="يَوم الإثنين">يَوم الإثنين</option>
                                        <option <?= ($time['timing_day_arabic'] == "يَوم الثلاثاء") ? 'selected' : ''; ?> value="يَوم الثلاثاء">يَوم الثلاثاء</option>
                                        <option <?= ($time['timing_day_arabic'] == "يَوم الأربعاء") ? 'selected' : ''; ?> value="يَوم الأربعاء">يَوم الأربعاء</option>
                                        <option <?= ($time['timing_day_arabic'] == "يَوم الخميس") ? 'selected' : ''; ?> value="يَوم الخميس">يَوم الخميس</option>
                                        <option <?= ($time['timing_day_arabic'] == "يَوم الجمعة") ? 'selected' : ''; ?> value="يَوم الجمعة">يَوم الجمعة</option>
                                        <option <?= ($time['timing_day_arabic'] == "يَوم السبت") ? 'selected' : ''; ?> value="يَوم السبت">يَوم السبت</option>
                                        <option <?= ($time['timing_day_arabic'] == "يَوم الأحَد") ? 'selected' : ''; ?> value="يَوم الأحَد">يَوم الأحَد</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="default-picker">Time Open in Arabic</label>
                                    <input type="text" class="form-control" name="time_open_arabic" value="<?= $time['timing_open_arabic']?>" placeholder="Select opening time in Arabic">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="default-pickerr">Closs Open in Arabic</label>
                                    <input type="text" class="form-control" name="time_closs_arabic" value="<?= $time['timing_close_arabic']?>" placeholder="Select closing time in Arabic">
                                </div>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <input type="submit" name="btn_edit_time" class="btn btn-success" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php require_once('layout/footer.php');?>