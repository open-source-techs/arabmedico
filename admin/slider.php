<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<style>
    /* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

iframe{
    width:200px !important;
    height:auto !important;
}
</style>
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
    $where = " AND (slider_text LIKE '%".$query."%' OR slider_text_arabic LIKE '%".$query."%' OR slider_desc LIKE '%".$query."%'  OR slider_desc_arabic LIKE '%".$query."%')";
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
            <h1>Slider</h1>
            <small>Slider list</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li class="active">Slider</li>
            </ol>
        </div>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-success" href="<?= admin_base_url();?>add-slider"> 
                                <i class="fa fa-plus"></i> Add Slide
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
                                        <th>Slide</th>
                                        <th>Slide Arabic</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_slider WHERE 1=1 $where LIMIT $offset, $limit");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <?php
                                            if($row['slider_is_video'] == 1)
                                            {
                                                if($row['slider_is_link'] == 1)
                                                {
                                                    ?>
                                                    <td style="width:200px;height:auto">
                                                        <?= $row['slide_video']; ?>
                                                    </td>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <td>
                                                        <video style="width:200px;height:auto;" controls>
                                                            <source src="<?= file_url().$row['slide_video'];?>" type="video/mp4">
                                                        </video>
                                                    </td>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <td><img style="width:auto;height:50px" src="<?= file_url().$row['slider_image'];?>" > </td>
                                                <?php
                                            }
                                            ?>
                                            
                                            
                                            
                                            <?php
                                            if($row['slider_is_video'] == 1 && $row['slide_video_ar'] != "" && $row['slide_video_ar'] != null)
                                            {
                                                if($row['slider_is_link'] == 1)
                                                {
                                                    ?>
                                                    <td style="width:200px;height:auto">
                                                        <?= $row['slide_video_ar']; ?>
                                                    </td>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <td>
                                                        <video style="width:200px;height:auto;" controls>
                                                            <source src="<?= file_url().$row['slide_video_ar'];?>" type="video/mp4">
                                                        </video>
                                                    </td>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                if($row['slider_image_ar'] != null && $row['slider_image_ar'] != '')
                                                {
                                                    ?>
                                                    <td><img style="width:auto;height:50px" src="<?= file_url().$row['slider_image_ar'];?>" > </td>
                                                    <?php
                                                }
                                                else
                                                {
                                                    echo "<td>&nbsp;</td>";
                                                }
                                                
                                            }
                                            ?>
                                            
                                            <td><?= $row['slider_text'];?></td>
                                            <td>
                                                <?php
                                                if($row['slider_is_video'] == 1)
                                                {
                                                    ?>
                                                    <label class="switch">
                                                        <input type="checkbox" <?= ($row['slider_video_show'] == 1) ? 'checked' : ''; ?> class="btn_switch" data-id="<?= $row['slider_id']; ?>" id="active_home<?= $row['slider_id']; ?>" value="1">
                                                        <span class="slider round"></span>
                                                    </label>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                            <td><?= date("d/m/Y",strtotime($row['slider_created_at']));?></td>
                                            <td>
                                                <a href="<?= admin_base_url();?>edit-slider?sl_id=<?= $row['slider_id']; ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="<?= admin_base_url();?>model/sliderModel?act=del&sl_id=<?= $row['slider_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
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
							    $total_pages_sql = query("SELECT count(*) as count FROM tbl_slider where 1=1 $where");
                                $total_rows = fetch($total_pages_sql)[count];
                                $total_pages = ceil($total_rows / $limit);
        						for ($i=0; $i < $total_pages; $i++)
        						{
        						    
        							?>
        							<li class="<?= ( ($i+1) == $page ) ? 'active disabled' : ''; ?>"><a href="<?= admin_base_url().'slider?page='. ($i + 1);?><?= (isset($_GET['query'])) ? '&query='.$_GET['query'] : '';?>"><?= $i + 1;?></a></li>
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
    $(document).ready(function(){
        
        $('body').delegate('#txt_limit','change',function(e){
            e.preventDefault();
            var limit = $(this).val();
            var query = $("#query").val();
            var link = "<?= admin_base_url();?>slider?limit="+limit;
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
            var link = "<?= admin_base_url();?>slider?limit="+limit;
            if(query != "")
            {
                link += "&query="+query;
            }
            window.location.href = link;
        });
        
        
        $('body').delegate('.btn_switch','change',function(e){
            e.preventDefault();
            var slide_id    = $(this).attr('data-id');
            var act         = "change_status";
            var value       = "deactive";
            if($(this).is(":checked"))
            {
                var value       = "active";
            }
            
            $.ajax({
                data: {sl_id: slide_id, action: act, val: value},
                type: "POST",
                url: "<?= admin_base_url();?>model/sliderModel",
                success:function(responce){
                    var res = $.parseJSON(responce);
                    if(res.status == "done")
                    {
                        swal({
                            title: "Success...!!!",
                            text: res.responce,
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "OK"
                        },
                        function () {
                            window.location.reload();
                        });
                    }
                    else if(res.status == "error")
                    {
                        swal({
                            title: "ERROR...!!!",
                            text: res.responce,
                            type: "danger",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "OK"
                        },
                        function () {
                            window.location.reload();
                        });
                    }
                }
            });
            
        });
    });
</script>