<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>Schedule Date</h1>
            <small>Add Date</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">Add Date</li>
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
</div>
<?php require_once('layout/footer.php');?>
<?php
get_msg('msg');
?>