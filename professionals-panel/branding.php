<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$doc_id = get_sess("userdata")['candidate_id'];
$sql = query("SELECT * FROM tbl_candidate where candidate_id  = '$doc_id'");
$doc = fetch($sql);
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Branding</h1>
            <small>Manage branding</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Branding</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                        <form  action="<?= admin_base_url()?>model/candidateModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                            <input type="hidden" name="txt_doc_id" value="<?= $doc_id; ?>">
                            <div class="col-sm-6 form-group">
                                <label>Exiting Logo</label>
                                <div class="col-sm-12">
                                    <img src="<?= file_url().$doc['candidate_logo'];?>" style="height: 50px; width: 100px;">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Upload Image</label>
                                <input type="file" name="txt_image" class="form-control" onchange="checkFileSize('txt_image');" id="txt_image">
                                <label class="txt_profile"></label>
                            </div>
                            <div class="col-sm-12 reset-button">
                                <input type="submit" name="btn_upload_logo" class="btn btn-success" value="Save">
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
                        <div class="btn-group"> 
                            <h3>Manage Slider</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <form  action="<?= admin_base_url()?>model/candidateModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                <input type="hidden" name="txt_doc_id" value="<?= $doc_id; ?>">
                                <div class="col-sm-6 form-group">
                                    <label>Slide Title</label>
                                    <input type="text" name="doc_slider_title" class="form-control" placeholder="Title">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Slider Title in Arabic</label>
                                    <input type="text" name="doc_slider_title_ar" class="form-control" placeholder="Title">
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>Upload Slider Image</label>
                                    <input type="file" name="txt_image" class="form-control" onchange="checkFileSize('txt_image');" id="txt_image">
                                    <label class="txt_image"></label>
                                </div>
                                <div class="col-sm-6">
                                    <label class="btn-block">Action</label>
                                    <input type="submit" name="btn_upload_slide" class="btn btn-success" value="Save">
                                </div>
                            </form>
                        </div>
                        <br>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sr#</th>
                                            <th>Title</th>
                                            <th>Slide Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = query("SELECT * FROM tbl_can_slider where can_slider_doc = '$doc_id'");
                                        $i=0;
                                        while ($row = fetch($sql))
                                        {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row['can_slider_title']; ?></td>
                                                <td><img style="width:100px;height:auto" src="<?= file_url().$row['can_slider_image'];?>"></td>
                                                <td>
                                                    <a href="<?= admin_base_url();?>model/candidateModel?act=del-slide&sld_id=<?= $row['can_slider_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <h3>Manage Awards</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <form  action="<?= admin_base_url()?>model/candidateModel" method="POST" enctype="multipart/form-data" class="col-sm-12">
                                <input type="hidden" name="txt_doc_id" value="<?= $doc_id; ?>">
                                <div class="col-sm-6 form-group">
                                    <label>Upload Award Image</label>
                                    <input type="file" name="txt_award" class="form-control" onchange="checkFileSize('txt_award');" id="txt_award">
                                    <label class="txt_award"></label>
                                </div>
                                <div class="col-sm-6">
                                    <label class="btn-block">Action</label>
                                    <input type="submit" name="btn_upload_award" class="btn btn-success" value="Save">
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sr#</th>
                                            <th>Award Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = query("SELECT * FROM tbl_can_awards where can_award_can = '$doc_id'");
                                        $i=0;
                                        while ($row = fetch($sql))
                                        {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><img style="width:100px;height:auto" src="<?= file_url().$row['can_award_image'];?>"></td>
                                                <td>
                                                    <a href="<?= admin_base_url();?>model/candidateModel?act=del-award&award_id=<?= $row['can_award_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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
        </div>
    </section>
</div>

<?php require_once('layout/footer.php');?>
<script src="<?= admin_base_url();?>assets/plugins/niceedit/nicEdit.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<?php
get_msg('msg');
?>