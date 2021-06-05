<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$chn_id = $_GET['chn_id'];
if($chn_id == 0 || $chn_id == '' || $chn_id < 0)
{
    ?>
    <script>
      window.location.href="<?php echo admin_base_url(); ?>all-channel";
    </script>
    <?php
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>Video Panel</h1>
            <small>Video list</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                	<a href="<?= admin_base_url();?>">
                		<i class="pe-7s-home"></i> Home
                	</a>
                </li>
                <li>
                    <a href="<?= admin_base_url();?>all-channel">
                		<i class="pe-7s-home"></i> Channels
                	</a>
                </li>
                <li class="active">Videos</li>
            </ol>
        </div>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-success" href="<?= admin_base_url();?>add-chn-video?chn_id=<?= $chn_id; ?>"> <i class="fa fa-plus"></i> Add New Item
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="panel-header"></div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Title</th>
                                        <th>Arabic Title</th>
                                        <th>Video</th>
                                        <th>Video Arabic</th>
                                        <th>Thumbnail</th>
                                        <th>Thumbnail Arabic</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = query("SELECT * FROM tbl_chn_gallery WHERE chn_video_parent = '$chn_id' ");
                                    while ($row = fetch($sql))
                                    {
                                        ?>
                                        <tr>
                                            <td>
                                                <!--<a href="<?= admin_base_url();?>edit-dpt-video-item?chn_id=<?= $chn_id; ?>&gal_id=<?= $row['chn_video_parent']; ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i>-->
                                                <!--</a>-->
                                                <a href="<?= admin_base_url();?>model/channelModel?act=del-item&chn_id=<?= $row['chn_video_id']; ?>&parent_id=<?= $row['chn_video_parent']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                            <td><?= $row['chn_video_title'];?></td>
                                            <td><?= $row['chn_video_title_ar'];?></td>
                                            <?php
                                            if($row['chn_is_link'] == 0 )
                                            {
                                            ?>
                                            <td>
                                                <video style="width:200px;height:auto;" controls>
                                                    <source src="<?= file_url().$row['chn_video_media'];?>" type="video/mp4">
                                                </video>
                                            </td>
                                            <td>
                                                <video style="width:200px;height:auto;" controls>
                                                    <source src="<?= file_url().$row['chn_video_media_ar'];?>" type="video/mp4">
                                                </video>
                                            </td>
                                            <td><img src="<?= file_url().$row['chn_video_thumbnail'];?>" style="width:auto;height:70px"></td>
                                            <td><img src="<?= file_url().$row['chn_video_thumbnail_ar'];?>" style="width:auto;height:70px"></td>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <td style="width:150px;height:auto">
                                                <?= $row['chn_video_media']; ?>
                                            </td>
                                            <td style="width:150px;height:auto">
                                                <?= $row['chn_video_media_ar']; ?>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <?php
                                            }
                                            ?>
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
    $('body').delegate('.btn_switch','change',function(e)
    {
        e.preventDefault();
        var slide_id    = $(this).attr('data-id');
        var depar_id    = $(this).attr('data-dpt');
        var act         = "change_status";
        var value       = "deactive";
        if($(this).is(":checked"))
        {
            var value       = "active";
        }
        $.ajax({
            data: {sl_id: slide_id, action: act, val: value, chn_id:depar_id},
            type: "POST",
            url: "<?= admin_base_url();?>model/departmentModel",
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
</script>
<?php
get_msg('msg');
?>