<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>Jobs</h1>
            <small>CME Registrations</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">CME Registration</li>
            </ol>
        </div>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <h3>New Registration</h3>
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
                                        <th>Date</th>
                                        <th>CME Topic</th>
                                        <th>Speciality</th>
                                        <th>Delivery</th>
                                        <th>Location</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_job_application a JOIN tbl_job dpt ON (dpt.job_id = a.job_app_no) WHERE a.job_app_status = 0");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><?= date("d/m/Y",strtotime($row['job_app_date']));?></td>
                                            <td><?= $row['job_title'];?></td>
                                            <td><?= $row['job_depart'];?></td>
                                            <td><?= $row['job_location'];?></td>
                                            <td><?= $row['job_app_name'];?></td>
                                            <td><?= $row['job_app_email'];?></td>
                                            <td><?= $row['job_app_number'];?></td>
                                            <td><textarea style="width:200px !important;" class="form-control appMessage" data-app-id="<?= $row['job_app_id'] ?>"><?= $row['job_app_message'];?></textarea></td>
                                            <td><a class="btn btn-xs btn-primary" href="<?= file_url().$row['job_app_resume'];?>" download="><?= $row['job_title']." Job Application of ".$row['job_app_name']."(".$row['job_app_number'].")";?>">Download</a></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>model/jobModel?act=app_stat&app=<?= $row['job_app_id'] ?>&val=1" class="btn btn-success btn-xs">Confirm</a>
                                                <a href="<?= admin_base_url();?>model/jobModel?act=app_stat&app=<?= $row['job_app_id'] ?>&val=2" class="btn btn-danger btn-xs">Waiting</a>
                                                <a href="<?= admin_base_url();?>model/jobModel?act=app_stat&app=<?= $row['job_app_id'] ?>&val=3" class="btn btn-warning btn-xs">Cancelled</a>
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
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <h3>Confirmed Registration</h3>
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
                                        <th>Date</th>
                                        <th>CME Topic</th>
                                        <th>Speciality</th>
                                        <th>Delivery</th>
                                        <th>Location</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_job_application a JOIN tbl_job dpt ON (dpt.job_id = a.job_app_no) WHERE a.job_app_status = 1");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><?= date("d/m/Y",strtotime($row['job_app_date']));?></td>
                                            <td><?= $row['job_title'];?></td>
                                            <td><?= $row['job_depart'];?></td>
                                            <td><?= $row['job_location'];?></td>
                                            <td><?= $row['job_app_name'];?></td>
                                            <td><?= $row['job_app_email'];?></td>
                                            <td><?= $row['job_app_number'];?></td>
                                            <td><textarea style="width:200px !important;" class="form-control" data-app-id="<?= $row['job_app_id'] ?>"><?= $row['job_app_message'];?></textarea></td>
                                            <td><a class="btn btn-xs btn-primary" href="<?= file_url().$row['job_app_resume'];?>" download="><?= $row['job_title']." Job Application of ".$row['job_app_name']."(".$row['job_app_number'].")";?>">Download</a></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>model/jobModel?act=app_stat&app=<?= $row['job_app_id'] ?>&val=2" class="btn btn-danger btn-xs">Reject</a>
                                                <a href="<?= admin_base_url();?>model/jobModel?act=app_stat&app=<?= $row['job_app_id'] ?>&val=3" class="btn btn-default btn-xs">On hold </a>
                                                <a href="<?= admin_base_url();?>model/jobModel?act=app_stat&app=<?= $row['job_app_id'] ?>&val=4" class="btn btn-info btn-xs">Interviewed</a>
                                                <a href="<?= admin_base_url();?>model/jobModel?act=app_stat&app=<?= $row['job_app_id'] ?>&val=5" class="btn btn-warning btn-xs">Selected</a>
                                                <a href="<?= admin_base_url();?>model/jobModel?act=app_stat&app=<?= $row['job_app_id'] ?>&val=6" class="btn btn-default btn-xs">Appointed</a>
                                                <a href="<?= admin_base_url();?>model/jobModel?act=app_stat&app=<?= $row['job_app_id'] ?>&val=7" class="btn btn-primary btn-xs">Joined</a>
                                                <a href="<?= admin_base_url();?>model/jobModel?act=app_stat&app=<?= $row['job_app_id'] ?>&val=8" class="btn btn-warning btn-xs">Job offered </a>
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
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <h3>Hold Applications</h3>
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
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Department</th>
                                        <th>Location</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Message</th>
                                        <th>Resume</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_job_application a JOIN tbl_job dpt ON (dpt.job_id = a.job_app_no) WHERE a.job_app_status = 3");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><?= date("d/m/Y",strtotime($row['job_app_date']));?></td>
                                            <td><?= $row['job_title'];?></td>
                                            <td><?= $row['job_depart'];?></td>
                                            <td><?= $row['job_location'];?></td>
                                            <td><?= $row['job_app_name'];?></td>
                                            <td><?= $row['job_app_email'];?></td>
                                            <td><?= $row['job_app_number'];?></td>
                                            <td><textarea readonly style="width:200px !important;" class="form-control" data-app-id="<?= $row['job_app_id'] ?>"><?= $row['job_app_message'];?></textarea></td>
                                            <td><a class="btn btn-xs btn-primary" href="<?= file_url().$row['job_app_resume'];?>" download="><?= $row['job_title']." Job Application of ".$row['job_app_name']."(".$row['job_app_number'].")";?>">Download</a></td>
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
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <h3>Interviewed Applications</h3>
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
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Department</th>
                                        <th>Location</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Message</th>
                                        <th>Resume</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_job_application a JOIN tbl_job dpt ON (dpt.job_id = a.job_app_no) WHERE a.job_app_status = 4");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><?= date("d/m/Y",strtotime($row['job_app_date']));?></td>
                                            <td><?= $row['job_title'];?></td>
                                            <td><?= $row['job_depart'];?></td>
                                            <td><?= $row['job_location'];?></td>
                                            <td><?= $row['job_app_name'];?></td>
                                            <td><?= $row['job_app_email'];?></td>
                                            <td><?= $row['job_app_number'];?></td>
                                            <td><textarea readonly style="width:200px !important;" class="form-control" data-app-id="<?= $row['job_app_id'] ?>"><?= $row['job_app_message'];?></textarea></td>
                                            <td><a class="btn btn-xs btn-primary" href="<?= file_url().$row['job_app_resume'];?>" download="><?= $row['job_title']." Job Application of ".$row['job_app_name']."(".$row['job_app_number'].")";?>">Download</a></td>
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
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <h3>Selected Applications</h3>
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
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Department</th>
                                        <th>Location</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Message</th>
                                        <th>Resume</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_job_application a JOIN tbl_job dpt ON (dpt.job_id = a.job_app_no) WHERE a.job_app_status = 5");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><?= date("d/m/Y",strtotime($row['job_app_date']));?></td>
                                            <td><?= $row['job_title'];?></td>
                                            <td><?= $row['job_depart'];?></td>
                                            <td><?= $row['job_location'];?></td>
                                            <td><?= $row['job_app_name'];?></td>
                                            <td><?= $row['job_app_email'];?></td>
                                            <td><?= $row['job_app_number'];?></td>
                                            <td><textarea readonly style="width:200px !important;" class="form-control" data-app-id="<?= $row['job_app_id'] ?>"><?= $row['job_app_message'];?></textarea></td>
                                            <td><a class="btn btn-xs btn-primary" href="<?= file_url().$row['job_app_resume'];?>" download="><?= $row['job_title']." Job Application of ".$row['job_app_name']."(".$row['job_app_number'].")";?>">Download</a></td>
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
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <h3>Appointed Applications</h3>
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
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Department</th>
                                        <th>Location</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Message</th>
                                        <th>Resume</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_job_application a JOIN tbl_job dpt ON (dpt.job_id = a.job_app_no) WHERE a.job_app_status = 6");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><?= date("d/m/Y",strtotime($row['job_app_date']));?></td>
                                            <td><?= $row['job_title'];?></td>
                                            <td><?= $row['job_depart'];?></td>
                                            <td><?= $row['job_location'];?></td>
                                            <td><?= $row['job_app_name'];?></td>
                                            <td><?= $row['job_app_email'];?></td>
                                            <td><?= $row['job_app_number'];?></td>
                                            <td><textarea readonly style="width:200px !important;" class="form-control" data-app-id="<?= $row['job_app_id'] ?>"><?= $row['job_app_message'];?></textarea></td>
                                            <td><a class="btn btn-xs btn-primary" href="<?= file_url().$row['job_app_resume'];?>" download="><?= $row['job_title']." Job Application of ".$row['job_app_name']."(".$row['job_app_number'].")";?>">Download</a></td>
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
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <h3>Joined Applications</h3>
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
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Department</th>
                                        <th>Location</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Message</th>
                                        <th>Resume</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_job_application a JOIN tbl_job dpt ON (dpt.job_id = a.job_app_no) WHERE a.job_app_status = 7");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><?= date("d/m/Y",strtotime($row['job_app_date']));?></td>
                                            <td><?= $row['job_title'];?></td>
                                            <td><?= $row['job_depart'];?></td>
                                            <td><?= $row['job_location'];?></td>
                                            <td><?= $row['job_app_name'];?></td>
                                            <td><?= $row['job_app_email'];?></td>
                                            <td><?= $row['job_app_number'];?></td>
                                            <td><textarea readonly style="width:200px !important;" class="form-control" data-app-id="<?= $row['job_app_id'] ?>"><?= $row['job_app_message'];?></textarea></td>
                                            <td><a class="btn btn-xs btn-primary" href="<?= file_url().$row['job_app_resume'];?>" download="><?= $row['job_title']." Job Application of ".$row['job_app_name']."(".$row['job_app_number'].")";?>">Download</a></td>
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
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <h3>Job offered Applications</h3>
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
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Department</th>
                                        <th>Location</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Message</th>
                                        <th>Resume</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_job_application a JOIN tbl_job dpt ON (dpt.job_id = a.job_app_no) WHERE a.job_app_status = 8");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><?= date("d/m/Y",strtotime($row['job_app_date']));?></td>
                                            <td><?= $row['job_title'];?></td>
                                            <td><?= $row['job_depart'];?></td>
                                            <td><?= $row['job_location'];?></td>
                                            <td><?= $row['job_app_name'];?></td>
                                            <td><?= $row['job_app_email'];?></td>
                                            <td><?= $row['job_app_number'];?></td>
                                            <td><textarea readonly style="width:200px !important;" class="form-control" data-app-id="<?= $row['job_app_id'] ?>"><?= $row['job_app_message'];?></textarea></td>
                                            <td><a class="btn btn-xs btn-primary" href="<?= file_url().$row['job_app_resume'];?>" download="><?= $row['job_title']." Job Application of ".$row['job_app_name']."(".$row['job_app_number'].")";?>">Download</a></td>
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
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <h3>Rejected Applications</h3>
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
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Department</th>
                                        <th>Location</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Number</th>
                                        <th>Message</th>
                                        <th>Resume</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_job_application a JOIN tbl_job dpt ON (dpt.job_id = a.job_app_no) WHERE a.job_app_status = 2");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><?= date("d/m/Y",strtotime($row['job_app_date']));?></td>
                                            <td><?= $row['job_title'];?></td>
                                            <td><?= $row['job_depart'];?></td>
                                            <td><?= $row['job_location'];?></td>
                                            <td><?= $row['job_app_name'];?></td>
                                            <td><?= $row['job_app_email'];?></td>
                                            <td><?= $row['job_app_number'];?></td>
                                            <td><textarea readonly style="width:200px !important;" class="form-control" data-app-id="<?= $row['job_app_id'] ?>"><?= $row['job_app_message'];?></textarea></td>
                                            <td><a class="btn btn-xs btn-primary" href="<?= file_url().$row['job_app_resume'];?>" download="><?= $row['job_title']." Job Application of ".$row['job_app_name']."(".$row['job_app_number'].")";?>">Download</a></td>
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
<script>
    $('body').delegate('.appMessage','blur',function(){
        var jobid = $(this).attr('data-app-id');
        var message = $(this).val();
        var act = 'update-message';
        $.ajax({
            type:'POST',
            url: "<?= admin_base_url();?>model/jobModel.php",
            data: {action:act, jobID:jobid, msg:message},
            success:function(data)
            {
                
            }
        });
    });
</script>
get_msg('msg');
?>