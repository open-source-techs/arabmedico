<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
if(isset($_GET['limit']) && $_GET['limit'] != "" && $_GET['limit'] != null)
{
    $limit = $_GET['limit'];
}
else
{
    $limit = 10;
}
if(isset($_GET['query']) && $_GET['query'] != "" && $_GET['query'] != null)
{
    $query = $_GET['query'];
    $where = " AND (
    d.doc_name LIKE '%".$query."%' 
    OR d.doc_name_arabic LIKE '%".$query."%' 
    OR d.doc_job_title LIKE '%".$query."%'
    OR d.doc_job_title_arabic LIKE '%".$query."%'
    OR d.doc_degree LIKE '%".$query."%'
    OR d.doc_degree_arabic LIKE '%".$query."%'
    OR d.doc_speciality LIKE '%".$query."%'
    OR d.doc_speciality_arabic LIKE '%".$query."%'
    OR d.doc_reg_no LIKE '%".$query."%'
    OR d.doc_area_of_experty LIKE '%".$query."%'
    OR d.doc_area_of_experty_arabic LIKE '%".$query."%'
    OR d.doc_intro_arabic LIKE '%".$query."%'
    OR d.doc_details LIKE '%".$query."%'
    OR d.doc_details_arabic LIKE '%".$query."%'
    OR td.dpt_name LIKE '%".$query."%'
    OR td.dpt_name_arabic LIKE '%".$query."%'
    )";
}
else 
{
    $where = '';
}

if(isset($_GET['page']) && $_GET['page'] != "" && $_GET['page'] != null)
{
    $page = $_GET['page'];
}
else
{
    $page = 1;
}
$offset = ($page - 1 ) * $limit;
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
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
            <h1>JOBS</h1>
            <small>jobs list</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">Job</li>
            </ol>
        </div>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-success" href="<?= admin_base_url();?>add-job"> <i class="fa fa-plus"></i> Add Job
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="panel-header">
                                <div class="col-sm-4 col-xs-12">
                                    <div class="dataTables_length">
                                        <label>Display 
                                            <select name="limit" id="txt_limit">
                                                <option value="10" <?= ($limit == 10) ? 'selected' : ''?>>10</option>
                                                <option value="25" <?= ($limit == 25) ? 'selected' : ''?>>25</option>
                                                <option value="50" <?= ($limit == 50) ? 'selected' : ''?>>50</option>
                                                <option value="100" <?= ($limit == 100) ? 'selected' : ''?>>100</option>
                                            </select> records per page</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="dataTables_length">
                                            <div class="input-group custom-search-form">
                                                <input type="search" id="query" value="<?= (isset($_GET['query'])) ? $_GET['query'] : '';?>" name="query" class="form-control" placeholder="search..">
                                                <span class="input-group-btn">
                                                <button class="btn btn-primary" type="button" id="btn_search">
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
                                        <th>Icon</th>
                                        <th>Title</th>
                                        <th>Speciality</th>
                                        <th>Location</th>
                                        <th>Closing date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_job WHERE job_status = 0");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td><img src="<?= file_url().$row['job_icon'];?>" class="img-fluid" style="width:auto;height:50px"></td>
                                            <td><?= $row['job_title'];?></td>
                                            <td><?= $row['job_depart'];?></td>
                                            <td><?= $row['job_location'];?></td>
                                            <td><?= $row['job_close_date'];?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>model/jobModel?act=appr&job_id=<?= $row['job_id']; ?>" class="btn btn-warning btn-xs"><i class="fa fa-check"></i>
                                                </a>
                                                <a href="<?= admin_base_url();?>edit-job?job_id=<?= $row['job_id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?= admin_base_url();?>model/jobModel?act=del&job_id=<?= $row['job_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
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
                                <?php
							    $total_pages_sql = query("SELECT * FROM tbl_doctor d JOIN tbl_department td ON (td.dpt_id = d.doctor_department) WHERE 1=1 $where");
                                $total_rows = nrows($total_pages_sql);
                                $total_pages = ceil($total_rows / $limit);
        						for ($i=0; $i < $total_pages; $i++)
        						{
        							?>
        							<li class="<?= ( ($i+1) == $page ) ? 'active disabled' : ''; ?>"><a href="<?= admin_base_url().'list-doctors?page='. ($i + 1);?><?= (isset($_GET['query'])) ? '&query='.$_GET['query'] : '';?>"><?= $i + 1;?></a></li>
        							<?php
        						}
        						?>
                            </ul>
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
<script>
$('body').delegate('#txt_limit','change',function(e){
    e.preventDefault();
    var limit = $(this).val();
    var query = $("#query").val();
    var link = "<?= admin_base_url();?>list-doctors?limit="+limit;
    if(query != "")
    {
        link += "&query="+query;
    }
    window.location.href = link;
});

$('body').delegate('#btn_search','click',function(e){
    e.preventDefault();
    var limit = $("#txt_limit").val();
    var query = $("#query").val();
    var link = "<?= admin_base_url();?>job-list?limit="+limit;
    if(query != "")
    {
        link += "&query="+query;
    }
    window.location.href = link;
});
</script>