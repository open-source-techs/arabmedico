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
    #body-bottom img {
        margin: 10px;
        height: 95px;
        width: 95px;
    }
    .grp-join{
        display: flex;
        justify-content: space-between;
    }
    .post-show {
        width: 100%;
        background: #FFF none repeat scroll 0% 0%;
        border-radius: 2px;
        border: 1px solid #E1E0E0;
    }
    .post-show-inner {
        width: 95%;
        margin: 10px auto;
    }
    .post-header {
        width: 100%;
        height: 60px;
    }
    .post-left-box {
        width: 80%;
        height: auto;
    }
    .id-img-box {
        width: 50px;
        height: 50px;
        float: left;
    }
    .id-name {
        padding: 0px 55px;
    }
    .post-left-box ul {
        list-style: none;
        padding-left: 0px;
    }
    .post-left-box ul li {
        display: block;
    }
    .post-header-text {
        margin: 8px 0px;
    }
    .post-img {
        width: 100%;
        height: auto;
    }
    .post-img img {
        max-width: 520px;
    }
    .post-img video {
        width: 100%;
    }
    .post-footer {
        width: 100%;
        height: 20px;
        margin-top: 5px;
    }
    .post-footer ul {
        list-style: none;
        padding-left: 0px;
    }
    .post-footer ul li {
        display: inline;
        margin: 0px 4px;
    }
    .post-footer a {
        text-decoration: none;
        font-size: 13px;
        color: #3F66B7;
    }
    .c-body-comments {
        width: 100%;
        height: auto;
        padding: 5px;
        border-bottom: 1px solid #E5E5E5;
        overflow: none;
        background: #f0f1f1;
    }
    .body-left-comments {
        width: 45px;
        height: auto;
        float: left;
    }
    .img-box-comments {
        width: 38px;
        height: 38px;
        margin: 0px 0px;
        border: 1px solid #dedede;
        padding: 0px !important;
    }
    .img-box-comments img {
        width: 100%;
        height: 100%;
    }
    .text-type-comments {
        width: 82%;
        height: auto;
        resize: none;
        margin: 10px 0px;
        font-size: 12px;
        color: #959698;
        border: 1px solid #dedede;
        overflow: hidden;
    }
    .id-img-box img {
        width: 100%;
        height: 100%;
    }
    .btn22 {
        background: rgb(71, 100, 159) none repeat scroll 0% 0%;
        color: white;
        font-weight: bolder;
        font-size: 12px;
        margin: 0px 3px;
        width: 40px;
        height: 40px;
        border: 1px solid rgb(204, 204, 204);
        border-radius: 4px;
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
                        <div class="wrap" style="margin-top: 5px;">
                            <h3 class="jctkr-label">خبر</h3>
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
                    <div class="col-md-6">
                        <div class="posts">
                            <div class="create-posts">
                                <?php
                                if(isset($_GET['grpID']) && $_GET['grpID'] != null && $_GET['grpID'] != "" && $_GET['grpID'] > 0)
                                {
                                    ?>
                                    <form action="<?= admin_base_url()?>model/postModel" method="post" enctype="multipart/form-data" style="border: 1px solid #E5E5E5; margin-bottom:10px !important">
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
                                        <input type="hidden" name="txt_group_id" value="<?= $_GET['grpID']; ?>">
                                        <div class="c-footer">
                                            <div class="right-box">
                                                <ul>
                                                    <li><input type="submit" name="btn_post_submit" value="Post" class="btn2"></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </form>
                                <?php
                                }
                                $where = '';
                                if(isset($_GET['grpID']) && $_GET['grpID'] != null && $_GET['grpID'] != "" && $_GET['grpID'] > 0)
                                {
                                    $groupID = $_GET['grpID'];
                                    $where = "AND post_group = ".$groupID;
                                }
                                $postSql = query("SELECT * FROM tbl_post p JOIN tbl_doctor d ON (p.post_user = d.doc_id) JOIN tbl_communication_group cg ON (p.post_group = cg.group_id) WHERE post_user = $doc_id AND post_userType = 'doctor' AND post_active = 1 $where");
                                while($postDetail = fetch($postSql))
                                {
                                    ?>
                                    <div class="post-show">
                                        <div class="post-show-inner">
                                            <div class="post-header">
                                                <div class="post-left-box">
                                                    <div class="id-img-box">
                                                        <img src="<?= file_url().$postDetail['doc_image'];?>">
                                                    </div>
                                                    <div class="id-name">
                                                        <ul>
                                                            <li style="font-size:32px"><?= $postDetail['doc_name'];?></li>
                                                            <li><small><?= time_ago($postDetail['post_time']); ?> in <b><?= $postDetail['group_name'];?></b></small></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="post-right-box"></div>
                                            </div>
                                            <div class="post-body">
                                                <div class="post-header-text"><?= $postDetail['post_text'];?></div>
                                                <div class="post-img">
                                                    <?php
                                                    if($postDetail['post_image'] != null && $postDetail['post_image'] != "")
                                                    {
                                                        ?>
                                                        <img src="<?= file_url().$postDetail['post_image'];?>" style="width:100%">
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if($postDetail['post_video'] != null && $postDetail['post_video'] != "")
                                                    {
                                                        $ext = pathinfo($postDetail['post_video'], PATHINFO_EXTENSION);
                                                        ?>
                                                        <video controls id="myvid">
                                                            <source src="<?= file_url().$postDetail['post_video'];?>" type="video/<?= $ext; ?>">
                                                        </video>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="post-footer">
                                                    <div class="post-footer-inner">
                                                        <ul>
                                                            <li>
                                                                <?php
                                                                $likSql = query("SELECT * FROM tbl_post_like WHERE like_post = ".$postDetail['post_id']);
                                                                $likeCount = nrows($likSql);
                                                                $like = true;
                                                                while($likeData = fetch($likSql))
                                                                {
                                                                    if($likeData['like_user'] == $doc_id && $likeData['like_userType'] == 'doctor' )
                                                                    {
                                                                        $like = false;
                                                                    }
                                                                }
                                                                ?>
                                                                <div id="like_count_<?= $postDetail['post_id']; ?>" style="font-weight:bold; float:left; margin-top:1px"><?= $likeCount; ?></div>
                                                                <?php
                                                                if($like)
                                                                {
                                                                    ?>
                                                                    <a href="javascript:like_post(<?= $postDetail['post_id']; ?>);" id="post_like_<?= $postDetail['post_id']; ?>">
                                                                         Like
                                                                    </a>
                                                                    <a href="javascript:unlike_post(<?= $postDetail['post_id']; ?>);" id="post_unllike_<?= $postDetail['post_id']; ?>" style="display: none;">
                                                                         Unlike
                                                                    </a>
                                                                    <?php
                                                                }
                                                                else
                                                                {
                                                                    ?>
                                                                    <a style="display: none;" href="javascript:like_post(<?= $postDetail['post_id']; ?>);" id="post_like_<?= $postDetail['post_id']; ?>">
                                                                         Like
                                                                    </a>
                                                                    <a href="javascript:unlike_post(<?= $postDetail['post_id']; ?>);" id="post_unllike_<?= $postDetail['post_id']; ?>">
                                                                         Unlike
                                                                    </a>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:showcomments(<?= $postDetail['post_id']; ?>);">Comment</a>
                                                            </li>
                                                            <!-- <li><a href="#">Share</a></li> -->
                                                            <!-- <li>
                                                                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=https://saudimedico.com/post/<?= $postDetail['post_id']; ?>-hi" target="_blank">
                                                                    <img src="<?= admin_base_url();?>assets/icons/linkedin_new.png" alt="LinkedIn" title="Share to LinkedIn" style="width:25px !important; margin-top:-5px">
                                                                </a>
                                                                <a href="https://wa.me/?text=https%3A%2F%2Fsaudimedico.com%2Fpost%2F<?= $postDetail['post_id']; ?>-hi" target="_blank">
                                                                    <img src="<?= admin_base_url();?>assets/icons/whatsapp.png" alt="WhatsApp" style="width:25px !important; margin-top:-5px" title="Share by WhatsApp">
                                                                </a>
                                                                <a href="http://www.facebook.com/sharer.php?u=https://saudimedico.com/post/<?= $postDetail['post_id']; ?>-hi" target="_blank">
                                                                    <img src="<?= admin_base_url();?>assets/icons/facebook_new.png" alt="Facebook" title="Share to Facebook" style="width:25px !important; margin-top:-5px">
                                                                </a>
                                                                <a href="https://twitter.com/home?status=https://saudimedico.com/post/<?= $postDetail['post_id']; ?>-hi" target="_blank">
                                                                    <img src="<?= admin_base_url();?>assets/icons/twitter_new.png" alt="Facebook" title="Share to Twitter" style="width:25px !important; margin-top:-5px">
                                                                </a>
                                                                <a href="fb-messenger://share/?link=https://saudimedico.com/post/<?= $postDetail['post_id']; ?>-hi" target="_blank">
                                                                    <img src="<?= admin_base_url();?>assets/icons/messenger.png" alt="Facebook Messenger" title="Share to Messenger" style="width:25px !important; margin-top:-5px">
                                                                </a>
                                                                <a href="https://saudimedico.com/post/<?= $postDetail['post_id']; ?>-hi" target="_blank">
                                                                    <img src="<?= admin_base_url();?>assets/icons/link.png" alt="Copy Link" title="Copy Link" style="width:25px !important; margin-top:-5px">
                                                                </a>
                                                            </li> -->
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div id="showcomments<?= $postDetail['post_id']; ?>" style="display:none; margin-top:10px; padding:0px !important">
                                                    <?php
                                                    $commSql = query("SELECT * FROM tbl_post_comment WHERE comment_post = ".$postDetail['post_id'] );
                                                    while($commData = fetch($commSql))
                                                    {
                                                        if($commData['comment_userType'] == 'doctor')
                                                        {
                                                            $userID     = $commData['comment_user'];
                                                            $userSql    = query("SELECT doc_name, doc_image FROM tbl_doctor WHERE doc_id = $userID");
                                                            $userData   = fetch($userSql);
                                                            $userName   = $userData['doc_name'];
                                                            $userimage  = $userData['doc_image'];
                                                        }
                                                        ?>
                                                        <div class="c-body-comments">
                                                            <div class="body-left-comments" style="margin:0px !important; width:43px">
                                                                <div class="img-box-comments">
                                                                    <img src="<?= file_url().$userimage;?>">
                                                                </div>
                                                            </div>
                                                            <div class="body-right" style="margin-top:0px; height:40px; padding-top:0px; padding-bottom:0px !important; width:100%;"><?= $commData['comment_text']; ?></div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <form action="<?= admin_base_url();?>model/postModel" method="post">
                                                        <div class="c-body-comments">
                                                            <div class="body-left-comments" style="margin:0px !important; width:43px">
                                                                <div class="img-box-comments">
                                                                    <img src="<?= file_url().$docImg;?>">
                                                                </div>
                                                            </div>
                                                            <div class="body-right" style="margin-top:0px; height:40px; padding-top:0px; padding-bottom:0px !important; width:100%;">
                                                                <input type="hidden" name="post_id" value="<?= $postDetail['post_id']; ?>">
                                                                <?php
                                                                if(isset($_GET['grpID']) && $_GET['grpID'] != null && $_GET['grpID'] != "" && $_GET['grpID'] > 0)
                                                                {
                                                                    ?>
                                                                    <input type="hidden" name="groupID" value="<?= $_GET['grpID']; ?>">
                                                                    <?php
                                                                }
                                                                ?>
                                                                <textarea class="text-type-comments" name="comment" placeholder="What's on your mind?" style="overflow:auto; height:38px; margin-top:0px !important; padding:2px !important"></textarea>
                                                                <input type="submit" name="postcomment" value="Post" class="btn22" style="float:right">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="height:10px; width:100%">&nbsp;</div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <div class="tg-widget tg-widget-accordions">
                            <h3 style="background-color:#3498db">My Groups</h3>
                            <ul class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <?php
                                $mygroupSql = query("SELECT * FROM tbl_group_users gu JOIN tbl_communication_group g ON (gu.grp_group_id = g.group_id) WHERE grp_user_type = 'doctor' AND grp_user_id = $doc_id AND grp_user_approved = 1");
                                while($mygroup = fetch($mygroupSql))
                                {
                                    ?>
                                    <li><a href="<?= admin_base_url()?>?grpID=<?= $mygroup['group_id']?>"><?= $mygroup['group_name'];?></a></li>
                                    <?php
                                    
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="tg-widget tg-widget-accordions">
                            <h3 style="background-color:#3498db">Other Groups</h3>
                            <ul class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <?php

                                $groupSql = query("SELECT t1.*, t2.* FROM tbl_communication_group t1 LEFT JOIN tbl_group_users t2 ON (t2.grp_group_id = t1.group_id) WHERE t2.grp_user_id IS NULL OR (t2.grp_user_id != $doc_id AND t2.grp_user_approved != 1)");
                                while($group = fetch($groupSql))
                                {
                                    ?>
                                    <li>
                                        <div class="grp-join">
                                            <span><?= $group['group_name'];?></span>
                                            <a href="<?= admin_base_url()?>model/postModel?act=joinGroup&grpID=<?= $group['group_id']?>"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </li>
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
    function showcomments(val)
    {
        document.getElementById("showcomments"+val).style.display = "block";
    }
    function like_post(val)
    {
        var action = 'post_like'
        $.ajax({
            type: "POST",
            url: "model/postModel",
            data: {
                btn_like: action,
                post_id:val,
                user_id:<?= $doc_id; ?>
            },
            success: function (response)
            {
                var res = $.parseJSON(response);
                if(res.code == "success")
                {
                    $("#like_count_"+val).html(res.data);
                    $("#post_unllike_"+val).show();
                    $("#post_like_"+val).hide();
                }
            }
        });
    }
    function unlike_post(val)
    {
        var action = 'post_unlike'
        $.ajax({
            type: "POST",
            url: "model/postModel",
            data: {
                btn_unlike: action,
                post_id:val,
                user_id:<?= $doc_id; ?>
            },
            success: function (response)
            {
                var res = $.parseJSON(response);
                if(res.code == "success")
                {
                    $("#like_count_"+val).html(res.data);
                    $("#post_unllike_"+val).hide();
                    $("#post_like_"+val).show();
                }
            }
        });
    }
    $(function() {
        $('.js-conveyor-example').jConveyorTicker();
        $("#uploadTrigger").click(function(){
           $("#uploadFile").click();
        });
        $("#uploadTriggerVideo").click(function(){
           $("#uploadVideoFile").click();
        });
  });
</script>
<?php
get_msg('msg');
?>