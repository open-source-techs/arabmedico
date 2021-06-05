<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php

$emp_id = get_sess("userdata")['candidate_id'];
if($emp_id == 0 || $emp_id == '' || $emp_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>model/adminUser?act=logout";
    </script>
    <?php
}

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
    d.contact_email LIKE '%".$query."%' 
    OR d.contact_phone LIKE '%".$query."%' 
    OR d.contact_name LIKE '%".$query."%'
    OR d.contact_job_title LIKE '%".$query."%'
    OR d.contact_message LIKE '%".$query."%'
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
            <h1>Messages</h1>
            <small>My Messages</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">My Messages</li>
            </ol>
        </div>
    </section>
    <?php
    if(isset($_GET['qid']) && $_GET['qid'] != null && $_GET['qid'] > 0)
    {
        $contactId = $_GET['qid'];
        $sql = query("SELECT * FROM tbl_candidate_contact d WHERE d.contact_id = $contactId");
        $sql2 = query("UPDATE tbl_candidate_contact SET contact_read = 1 WHERE d.contact_id = $contactId");
        $messgaeData = fetch($sql);
        ?>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Job Title: <small><?= $messgaeData['contact_job_title'];?></small></h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>Employer Name: <small><?= $messgaeData['contact_name'];?></small></h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>Employer Number: <small><?= $messgaeData['contact_phone'];?></small></h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>Employer Email: <small><?= $messgaeData['contact_email'];?></small></h4>
                                </div>
                                <div class="col-md-12">
                                    <h4>Message:</h4>
                                    <p><?= $messgaeData['contact_message']; ?></p>
                                </div>
                                <div class="col-sm-12 reset-button">
                                    <a href="<?= admin_base_url();?>my-queries" class="btn btn-warning">Go Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
    else
    {
        ?>
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
                                            <th>Job Title</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = query("SELECT * FROM tbl_candidate_contact d WHERE d.contact_candidate = $emp_id $where LIMIT $offset, $limit");
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $row['contact_job_title'];?></td>
                                                <td><?= $row['contact_name'];?></td>
                                                <td><?= $row['contact_email'];?></td>
                                                <td><?= $row['contact_phone'];?></td>
                                                <td><?= date("d/m/Y H:i a",strtotime($row['contact_time']));?></td>
                                                <td>
                                                    <a href="<?= admin_base_url();?>my-queries?qid=<?= $row['contact_id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i>
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
    							    $total_pages_sql = query("SELECT * FROM tbl_candidate_contact d WHERE 1=1 $where");
                                    $total_rows = nrows($total_pages_sql);
                                    $total_pages = ceil($total_rows / $limit);
            						for ($i=0; $i < $total_pages; $i++)
            						{
            							?>
            							<li class="<?= ( ($i+1) == $page ) ? 'active disabled' : ''; ?>"><a href="<?= admin_base_url().'my-queries?page='. ($i + 1);?><?= (isset($_GET['query'])) ? '&query='.$_GET['query'] : '';?>"><?= $i + 1;?></a></li>
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
        <?php
    }
    ?>
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
    var link = "<?= admin_base_url();?>my-queries?limit="+limit;
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
    var link = "<?= admin_base_url();?>my-queries?limit="+limit;
    if(query != "")
    {
        link += "&query="+query;
    }
    window.location.href = link;
});
</script>