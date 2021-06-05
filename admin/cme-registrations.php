<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>CME</h1>
            <small>CME Registration</small>
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
                                    $sql = query("SELECT * FROM tbl_cme_application a JOIN tbl_cme dpt ON (dpt.id = a.cme_app_no) WHERE a.cme_app_status = 0");
                                    while ($row = fetch($sql))
                                    {
                                        //echo '<pre>';
                                        //print_r($row);
                                        ?>
                                        <tr>
                                            <td><?= date("d/m/Y",strtotime($row['cme_app_date']));?></td>
                                            <td><?= $row['cme_topic'];?></td>
                                            <td><?= $row['cme_depart'];?></td>
                                            <td><?= $row['cme_delivery'];?></td>
                                            <td><?= $row['cme_loc'];?></td>
                                            <td><?= $row['cme_app_name'];?></td>
                                            <td><?= $row['cme_app_email'];?></td>
                                            <td><?= $row['cme_app_number'];?></td>
                                            <td><textarea style="width:200px !important;" class="form-control appMessage" data-app-id="<?= $row['cme_app_id'] ?>"><?= $row['cme_app_massage'];?></textarea></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>model/cmeModel?act=app_stat&app=<?= $row['cme_app_id'] ?>&val=1" class="btn btn-success btn-xs">Confirmed</a>
                                                <a href="<?= admin_base_url();?>model/cmeModel?act=app_stat&app=<?= $row['cme_app_id'] ?>&val=2" class="btn btn-danger btn-xs">Waiting</a>
                                                <a href="<?= admin_base_url();?>model/cmeModel?act=app_stat&app=<?= $row['cme_app_id'] ?>&val=3" class="btn btn-warning btn-xs">Cancelled</a>
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
                                    $sql = query("SELECT * FROM tbl_cme_application a JOIN tbl_cme dpt ON (dpt.id = a.cme_app_no) WHERE a.cme_app_status = 1");
                                    while ($row = fetch($sql))
                                    {
                                        //echo '<pre>';
                                        //print_r($row);
                                        ?>
                                        <tr>
                                            <td><?= date("d/m/Y",strtotime($row['cme_app_date']));?></td>
                                            <td><?= $row['cme_topic'];?></td>
                                            <td><?= $row['cme_depart'];?></td>
                                            <td><?= $row['cme_delivery'];?></td>
                                            <td><?= $row['cme_loc'];?></td>
                                            <td><?= $row['cme_app_name'];?></td>
                                            <td><?= $row['cme_app_email'];?></td>
                                            <td><?= $row['cme_app_no'];?></td>
                                            <td><textarea style="width:200px !important;" class="form-control appMessage" data-app-id="<?= $row['cme_app_id'] ?>"> <?php echo $row['cme_app_massage'];?> </textarea></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>model/cmeModel?act=app_stat&app=<?= $row['cme_app_id'] ?>&val=1" class="btn btn-success btn-xs">Confirmed</a>
                                                <a href="<?= admin_base_url();?>model/cmeModel?act=app_stat&app=<?= $row['cme_app_id'] ?>&val=2" class="btn btn-danger btn-xs">Waiting</a>
                                                <a href="<?= admin_base_url();?>model/cmeModel?act=app_stat&app=<?= $row['cme_app_id'] ?>&val=3" class="btn btn-warning btn-xs">Cancelled</a>
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
                        <h3>Waiting Registration</h3>
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
                                    $sql = query("SELECT * FROM tbl_cme_application a JOIN tbl_cme dpt ON (dpt.id = a.cme_app_no) WHERE a.cme_app_status = 2");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><?= date("d/m/Y",strtotime($row['cme_app_date']));?></td>
                                            <td><?= $row['cme_topic'];?></td>
                                            <td><?= $row['cme_depart'];?></td>
                                            <td><?= $row['cme_delivery'];?></td>
                                            <td><?= $row['cme_loc'];?></td>
                                            <td><?= $row['cme_app_name'];?></td>
                                            <td><?= $row['cme_app_email'];?></td>
                                            <td><?= $row['cme_app_no'];?></td>
                                            <td><textarea style="width:200px !important;" class="form-control appMessage" data-app-id="<?= $row['cme_app_id'] ?>"><?= $row['cme_app_massage'];?></textarea></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>model/cmeModel?act=app_stat&app=<?= $row['cme_app_id'] ?>&val=1" class="btn btn-success btn-xs">Confirmed</a>
                                                <a href="<?= admin_base_url();?>model/cmeModel?act=app_stat&app=<?= $row['cme_app_id'] ?>&val=2" class="btn btn-danger btn-xs">Waiting</a>
                                                <a href="<?= admin_base_url();?>model/cmeModel?act=app_stat&app=<?= $row['cme_app_id'] ?>&val=3" class="btn btn-warning btn-xs">Cancelled</a>
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
                        <h3>Cancelled Registration</h3>
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
                                    $sql = query("SELECT * FROM tbl_cme_application a JOIN tbl_cme dpt ON (dpt.id = a.cme_app_no) WHERE a.cme_app_status = 3");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><?= date("d/m/Y",strtotime($row['cme_app_date']));?></td>
                                            <td><?= $row['cme_topic'];?></td>
                                            <td><?= $row['cme_depart'];?></td>
                                            <td><?= $row['cme_delivery'];?></td>
                                            <td><?= $row['cme_loc'];?></td>
                                            <td><?= $row['cme_app_name'];?></td>
                                            <td><?= $row['cme_app_email'];?></td>
                                            <td><?= $row['cme_app_no'];?></td>
                                            <td><textarea style="width:200px !important;" class="form-control appMessage" data-app-id="<?= $row['cme_app_id'] ?>"><?= $row['cme_app_massage'];?></textarea></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>model/cmeModel?act=app_stat&app=<?= $row['cme_app_id'] ?>&val=1" class="btn btn-success btn-xs">Confirmed</a>
                                                <a href="<?= admin_base_url();?>model/cmeModel?act=app_stat&app=<?= $row['cme_app_id'] ?>&val=2" class="btn btn-danger btn-xs">Waiting</a>
                                                <a href="<?= admin_base_url();?>model/cmeModel?act=app_stat&app=<?= $row['cme_app_id'] ?>&val=3" class="btn btn-warning btn-xs">Cancelled</a>
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
<script>
    $('body').delegate('.appMessage','blur',function(){
        var jobid = $(this).attr('data-app-id');
        var message = $(this).val();
        var act = 'update_message';
        $.ajax({
            type:'POST',
            url: "<?= admin_base_url();?>model/cmeModel.php",
            data: {action:act, jobID:jobid, msg:message},
            success:function(data)
            {
                
            }
        });
    });
</script>
get_msg('msg');
?>