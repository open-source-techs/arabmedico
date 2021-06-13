<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$docImg = get_sess("userdata")['doc_image'];
$doc_id = get_sess("userdata")['doc_id'];
?>
<link rel="stylesheet" href="<?= admin_base_url();?>assets/marquee.css">
<style type="text/css">
    .content{
        background-color: #fff !important;
    }
    .wrap{
      width: 100%;
      white-space: nowrap;
      overflow: hidden;
      font-size: 0;
      background: #fff;
      border-radius: 3px;
      box-shadow: inset 0 0 7px rgba(52, 152, 219,0.5);
    }
    .jctkr-label{
      height: 35px;
      padding: 0px 17px 15px 17px;
      line-height: 35px;
      background: rgba(52, 152, 219);
      font-weight:bold;
      font-size: 19px;
      color: #fff !important;
      cursor: default;
      margin: 0px !important;
    }
    .jctkr-label:hover{
      background: rgba(52, 152, 219, 0.7);
      color: #fff;
    }
    [class*="js-conveyor-"] ul{
      display: inline-block;
      opacity: 0.5;
    }
    [class*="js-conveyor-"] ul li{
      padding: 0 20px;
      border-right:1px solid rgba(52, 152, 219,0.5);
      line-height: 35px;
      font-size: 16px;
    }
    .card-body
    {
        width: 100%;
        height: auto;
        min-height: 100px;
        border-bottom: 1px solid #E5E5E5;
        overflow: auto;
    }
    .body-left {
        width: 62px;
        height: auto;
        float: left;
        margin-left: 15px;
    }
    .img-box {
        width: 50px;
        height: 50px;
        margin: 10px 0px;
        border: 1px solid #F5F1F1;
    }
    .img-box img {
        width: 100%;
        height: 100%;
    }
    .text-type {
        width: 84%;
        height: auto;
        resize: none;
        margin: 10px 0px;
        font-size: 14px;
        color: #959698;
        border: none;
        overflow: hidden;
    }
    #body-bottom {
        border-top: 1px solid #8fc400;
        margin: 10px;
        display: none;
    }
    .c-footer {
        overflow: auto;
        margin-bottom: 5px;
    }
    .right-box {
        float: right;
        margin-top: 5px;
    }
    .right-box ul {
        list-style: none;
    }
    .right-box ul li {
        display: inline;
    }
    .btn2 {
        background: rgb(71, 100, 159) none repeat scroll 0% 0%;
        color: white;
        font-weight: bolder;
        font-size: 12px;
        margin: 0px 7px;
        width: 65px;
        height: 25px;
        border: 1px solid rgb(204, 204, 204);
        border-radius: 4px;
    }
    .tg-widget {
        width: 100%;
        float: left;
        margin: 0 0 30px;
    }
    .tg-widget > h3 {
        background-color: #3498db;
        width: 100%;
        float: left;
        margin: 0;
        color: #fff;
        padding: 20px;
        font-size: 16px;
        line-height: 16px;
        background: #505050;
        text-transform: uppercase;
    }
    .tg-widget.tg-widget-accordions ul {
        background: #bbeefb;
    }
    .tg-widget > ul {
        margin: 0;
        width: 100%;
        float: left;
        list-style: none;
        padding: 5px 20px;
        border: 1px solid #025389;
        line-height: 20px;
    }
    .tg-widget > ul > li {
        float: left;
        width: 100%;
        padding: 14px 0;
        line-height: normal;
        list-style-type: none;
    }
    .tg-widget.tg-widget-accordions ul li:first-child {
        border: 0;
    }
    .tg-widget.tg-widget-accordions ul li {
        background: none;
    }
    .tg-widget.tg-widget-accordions ul li{
        border: 0;
        margin: 0 !important;
        box-shadow: none;
        border-top: 1px solid #025389;
        border-radius: 0 !important;
    }
    .post-content{
        margin-top: 20px;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <form action="#" method="get" class="sidebar-form search-box pull-right hidden-md hidden-lg hidden-sm">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>   
        <div class="header-icon">
            <i class="fa fa-tachometer"></i>
        </div>
        <div class="header-title">
            <h1> Dashboard</h1>
            <small>Communication</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>l"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="comm-header">
                        <div class="wrap">
                            <h3 class="jctkr-label">News</h3>
                            <div class="js-conveyor-example">
                                <ul>
                                <?php
                                $newsSql = query("SELECT * FROM tbl_internal_news WHERE news_for = 'doctor' OR news_for = 'all'");
                                while($news = fetch($newsSql))
                                {
                                    ?>
                                    <li class="news-detail"><a href="#"><span><?= $news['news_title']; ?></span></a></li>
                                    <?php
                                }
                                ?>
                                </ul>
                            </div>
                        </div>
                        <br>
                        <div class="wrap">
                            <h3 class="jctkr-label">Arabic News</h3>
                            <div class="js-conveyor-example">
                                <ul>
                                <?php
                                $newsSql = query("SELECT * FROM tbl_internal_news WHERE news_for = 'doctor' OR news_for = 'all'");
                                while($news = fetch($newsSql))
                                {
                                    ?>
                                    <li class="news-detail"><a href="#"><span><?= $news['news_title_ar']; ?></span></a></li>
                                    <?php
                                }
                                ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="post-content">
                <div class="row">
                    <div class="col-md-9">
                        <div class="posts">
                            <div class="create-posts">
                                <form action="" method="post" enctype="multipart/form-data" style="border: 1px solid #E5E5E5; margin-bottom:10px !important">
                                    <div class="row" style="text-align:center;">
                                        <div style="width: 32% !important; margin-left:14px; border-bottom:1px solid #E5E5E5; border-left:1px solid #E5E5E5; height:60px; padding-top:10px; float:left; text-align:center;">
                                            <a href="#" title="Write something">
                                                <div class="fa-3x fa fa-edit"></div>
                                            </a>
                                        </div>
                                        <div style="width: 31% !important; height:60px; float:left; text-align:center; border-left:1px solid #E5E5E5; padding-top:10px; border-bottom:1px solid #E5E5E5;">
                                            <input type="file" onchange="readURL(this);" style="display:none;" name="post_image" id="uploadFile">
                                            <a id="uploadTrigger" name="post_image" title="Upload a Photo"><div class="fa-3x fa fa-image"></div></a>
                                        </div>
                                        <div style="width: 32% !important; height:60px; float:left; text-align:center; border-left:1px solid #E5E5E5; padding-top:10px; border-bottom:1px solid #E5E5E5;">
                                            <input type="file" onchange="readURL(this);" style="display:none;" name="post_video" id="uploadVideoFile">
                                            <a id="uploadTriggerVideo" name="post_video" title="Upload a Video"><div class="fa-3x fa fa-video-camera"></div></a>
                                        </div>
                                    </div>
                                    <div class="c-body">
                                        <div class="body-left">
                                            <div class="img-box">
                                                <img src="<?= file_url().$docImg;?>">

                                            </div>
                                        </div>
                                        <div class="body-right">
                                            <textarea class="text-type" name="status" placeholder="What's on your mind?"></textarea>
                                        </div>
                                        <div id="body-bottom">
                                            <img src="#" id="preview">
                                        </div>
                                    </div>
                                    <div class="c-footer">
                                        <div class="right-box">
                                            <ul>
                                                <li>
                                                    <div class="form-group" style="float:left; padding:0px !important">
                                                        <span class="select">
                                                            <select class="group" id="group_id" name="group_id" style="color:#000; min-width:250px; height:25px; padding:0px !important" required="">
                                                                <option value="">Please select group to post</option>
                                                                <option value="1">Medical Community</option>
                                                                <option value="2">Orthodontics</option>
                                                                <option value="4">Rheumatology</option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li><input type="submit" name="submit" value="Post" class="btn2"></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        
                                    </script>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="tg-widget tg-widget-accordions">
                            <h3 style="background-color:#3498db">Your Groups</h3>
                            <ul class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <?php
                                $mygroupSql = query("SELECT * FROM tbl_group_users gu JOIN tbl_communication_group g ON (du.grp_group_id = g.group_id) WHERE grp_user_type = 'doctor' AND grp_user_type = $doc_id AND grp_user_approved = 1");
                                while($mygroup = fetch($mygroupSql))
                                {
                                    ?>
                                    <li> <?= $mygroup['group_name'];?></li>
                                    <?php
                                    
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="tg-widget tg-widget-accordions">
                            <h3 style="background-color:#3498db">Dental Groups (3)</h3>
                            <ul class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <?php
                                $mygroupSql = query("SELECT * FROM tbl_communication_group");
                                while($mygroup = fetch($mygroupSql))
                                {
                                    ?>
                                    <li> <?= $mygroup['group_name'];?></li>
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
<script src="<?= admin_base_url();?>assets/marquee.js"></script>
<script>
  $(function() {
    $('.js-conveyor-example').jConveyorTicker();
    $("#uploadTrigger").click(function(){
       $("#uploadFile").click();
    });
    $("#uploadTriggerVideo").click(function(){
       $("#uploadVideoFile").click();
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#body-bottom').show();
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
  });
</script>
<?php
get_msg('msg');
?>