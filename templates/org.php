<?php
if(isset($_GET['slug']) && $_GET['slug'] != "" && $_GET['slug'] != null)
{
    $slug = $_GET['slug'];
    include 'doc-connection.php';
    $sql = query("SELECT * FROM tbl_organization WHERE organization_active = 1 AND organization_slug = '$slug'");
    if(nrows($sql) > 0)
    {
        $org             = fetch($sql);
        $orgID           = $org['organization_id'];
        $meta_title      = $org['organization_meta_title'];
        $meta_title_ar   = $org['organization_meta_title_ar'];
        $meta_keyword    = $org['organization_meta_tag'];
        $meta_keyword_ar = $org['organization_meta_tag_ar'];
        $meta_desc       = $org['organization_meta_desc'];
        $meta_desc_ar    = $org['organization_meta_desc_ar'];
        include 'clinic-header.php';
        ?>
        <header id="header" class="header">
                <div class="wsmobileheader clearfix">
                    <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
                    <span class="smllogo">
                    <img src="<?= file_url().$org['organization_icon'];?>" style="width:180px;height:40px" alt="mobile-logo"/></span>
                    <a href="<?= $_SERVER['SCRIPT_URI'];?><?= ($lang == "eng") ? '?lang=arabic' : '?lang=eng' ;?>" class="btn_lang"><?= ($lang == "eng") ? 'عربى' : 'English';?></a>
                </div>
                <div class="headtoppart bg-steelblue clearfix">
                    <div class="headerwp clearfix">
                        <div class="headertopleft">                         
                            <div class="address clearfix">
                                <span>
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?= ($lang == "eng") ? $siteData['site_address'] : $siteData['site_address_arabic']; ?>
                                </span>
                                <a href="tel:<?= $siteData['site_phone'];?>" class="callusbtn">
                                    <i class="fas fa-phone"></i>
                                    <?= $siteData['site_phone'];?>
                                </a>
                            </div>
                        </div>
                        <div class="headertopright">
                            <a target="_blank" class="googleicon" title="Google" href="<?= $siteData['site_google'];?>"><i class="fab fa-google"></i> <span class="mobiletext02">Google</span></a>
                            <a target="_blank" class="linkedinicon" title="Linkedin" href="<?= $siteData['site_linkedin'];?>"><i class="fab fa-linkedin-in"></i> <span class="mobiletext02">Linkedin</span></a>
                            <a target="_blank" class="twittericon" title="Twitter" href="<?= $siteData['site_twitter'];?>"><i class="fab fa-twitter"></i> <span class="mobiletext02">Twitter</span></a>
                            <a target="_blank" class="facebookicon" title="Facebook" href="<?= $siteData['site_facebook'];?>"><i class="fab fa-facebook-f"></i> <span class="mobiletext02">Facebook</span></a>
                            <a href="<?= $_SERVER['SCRIPT_URI'];?><?= ($lang == "eng") ? '?lang=arabic' : '?lang=eng' ;?>" class="facebookicon"><?= ($lang == "eng") ? 'عربى' : 'Eng';?></a>
                        </div>
                    </div>
                </div>
                <div class="wsmainfull menu clearfix">
                    <div class="wsmainwp clearfix" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important"' ;?>>
                        <div class="desktoplogo" <?= ($lang == "eng") ? '' : 'style="float:right"' ;?>>
                            <a href="#hero-10">
                                <img src="<?= file_url().$org['organization_icon'];?>"  style="width:180px;height:40px" alt="header-logo">
                            </a>
                        </div>
                        <nav class="wsmenu clearfix abc"  >
                            <?php
                            if($lang == "eng")
                            {
                                ?>
                                <ul class="wsmenu-list" >
                                    <li class="navbar-item"><a href="<?= base_url();?><?= $slug;?>"><?= ($lang == "eng") ? $lang_con[1]['lang_eng'] : $lang_con[1]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#doctors"><?= ($lang == "eng") ? $lang_con[226]['lang_eng'] : $lang_con[226]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#services"><?= ($lang == "eng") ? $lang_con[222]['lang_eng'] : $lang_con[222]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#offers"><?= ($lang == "eng") ? $lang_con[12]['lang_eng'] : $lang_con[12]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#photos"><?= ($lang == "eng") ? $lang_con[181]['lang_eng'] : $lang_con[181]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#videos"><?= ($lang == "eng") ? $lang_con[182]['lang_eng'] : $lang_con[182]['lang_arabic']; ?></a></li>
                                </ul>
                                <?php
                            }
                            else
                            {
                                ?>
                                <ul class="wsmenu-list" >
                                    <li class="navbar-item"><a href="#videos"><?= ($lang == "eng") ? $lang_con[182]['lang_eng'] : $lang_con[182]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#photos"><?= ($lang == "eng") ? $lang_con[181]['lang_eng'] : $lang_con[181]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#offers"><?= ($lang == "eng") ? $lang_con[12]['lang_eng'] : $lang_con[12]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#services"><?= ($lang == "eng") ? $lang_con[222]['lang_eng'] : $lang_con[222]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#doctors"><?= ($lang == "eng") ? $lang_con[222]['lang_eng'] : $lang_con[222]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="<?= base_url();?>/<?= $slug;?>"><?= ($lang == "eng") ? $lang_con[1]['lang_eng'] : $lang_con[1]['lang_arabic']; ?></a></li>
                                </ul>
                                <?php
                            }
                            ?>
                        </nav>
                    </div>
                </div>
            </header>
            <link href="<?= base_url();?>css/doc.css" rel="stylesheet">
            <link href="<?= base_url();?>css/prettyPhoto.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
            <style>
                iframe{
                    width:100% !important;
                    height:500px;
                }
                .appointmentDiv ul{
                    list-style:none ;
                }
                .text{
                    padding:0px 20px;
                }
                .text p{
                    margin-bottom:2px;
                }
                .text h5{
                    font-weight: 500 !important;
                    margin-bottom: 0rem !important;
                }
                .text h6{
                    font-weight: 500 !important;
                    margin-bottom: 0rem !important;
                }
                .doctor-2{
                    border: 1px solid #ccc !important;
                    border-radius: 7px;
                    border-bottom: 5px solid #ccc !important;
                    background: #fff !important;
                }
                .offer-wrapper{
                    border: 1px solid #ccc !important;
                    border-radius: 7px;
                    border-bottom: 5px solid #ccc !important;
                    background: #fff !important;
                    padding:10px 10px;
                    margin:0px 10px;
                    position:relative;
                }
                .certificate-card{
                    margin:0px 10px;
                }
                .image-gall{
                    margin:0px 10px;
                }
                .price-wrapper{
                    position:absolute;
                    height:65px;
                    width:65px;
                    top: 190px;
                    background-color: #00a3c8;
                    -ms-transform: rotate(45deg);
                    transform: rotate(45deg);
                    <?= ($lang == "eng") ? 'left: 15px;' : 'right: 15px;';?>
                    text-align: center;
                }
                .price-div{
                    color:white;
                    margin:auto;
                    margin-left: -5px;
                    -ms-transform: rotate(-45deg);
                    transform: rotate(-45deg);
                    margin-top: 16px;
                }
                .price-div span{
                    font-size:20px;
                }
                .offer-image-holder{
                    position: relative;
                    padding-top: 68%;
                }
                .offer-image-holder img {
                    position: absolute;
                    top: 0;
                    left: 0;
                    height: 100%;
                    width: 100%;
                    object-fit: contain;
                    object-position: center;
                }
                .title-wrapper{
                    <?= ($lang == "eng") ? 'padding-left: 80px;' : 'padding-right:80px;';?>
                    
                }
                .highlight-wrapper{
                    margin-top:10px;
                    <?= ($lang == "eng") ? 'padding-left:20px' : 'padding-right:20px;';?>
                }
                .highlight-list{
                    list-style:disc !important;
                }
                .highlight-list li{
                    padding:5px 0px 5px 0px;
                }
                .appointmentDiv h4{
                    text-align:center !important;
                }
                .img-holder2{
                    position: relative;
                    padding-top: 54%;
                }
                .img-holder2 img {
                    position: absolute;
                    top: 0;
                    left: 27px !important;
                    height: 100%;
                    width: 100%;
                    object-fit: contain;
                    object-position: center;
                }
                .img-holder1 {
                    position: relative;
                    padding-top: 95%;
                }
                .owl-carousel .owl-item img {
                    display: block;
                    width: 100%;
                }
                .img-holder1 img {
                    position: absolute;
                    top: 0;
                    left: 0;
                    height: 100%;
                    width: 100%;
                    object-fit: contain;
                    object-position: center;
                }
                @media (max-width: 575px){
                    .img-holder2 img {
                        position: absolute;
                        top: 0;
                        left: 0px !important;
                        height: 100%;
                        width: 100%;
                        object-fit: contain;
                        object-position: center;
                    }
                }
            </style>
            <section id="doctor-top" class="doctor-details-section">
                <div class="container p-0" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            $sql        = query("SELECT COUNT(slider_id) as count FROM tbl_org_slider WHERE slider_is_video = 1 AND slider_active = 1 AND slider_org = $orgID ");
                            $is_video   = fetch($sql)['count'];
                            if($is_video > 0)
                            {
                                $sql = query("SELECT * FROM tbl_org_slider WHERE slider_video_show = 1 AND slider_active = 1 AND slider_org = $orgID ");
                                while($slData = fetch($sql))
                                {
                                    ?>
                                    <section id="hero-9" class="hero-section division">
                                        <?php
                                        if($slData['slider_is_link'] == 1)
                                        {
                                            ?>
                                            <?= ($lang == "eng") ? $slData['slide_video'] : $slData['slide_video_ar']; ?>
                                            <?php
                                        }
                                        else
                                        {
                                           ?>
                                            <video controls autoplay playsinline loop id="myvid">
                                                <source src="<?= ($lang == "eng") ? file_url().$slData['slide_video'] : file_url().$slData['slide_video_ar']; ?>" type="video/mp4">
                                            </video>
                                           <?php
                                        }
                                        ?>
                                    </section>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>  
                                <section id="hero-9" class="hero-section division">
                                    <div class="slider blue-nav">
                                        <ul class="slides">
                                            <?php
                                            $sql = query("SELECT * FROM tbl_org_slider WHERE slider_is_video = 0 AND slider_active = 1 AND slider_clinic = $orgID ");
                                            while($slData = fetch($sql))
                                            {
                                                ?>
                                                <li id="slide-1">
                                                    <img src="<?= ($lang == "eng") ? file_url().$slData['slider_image'] : file_url().$slData['slider_image_ar']; ?>" alt="slide-background">
                                                    <div class="caption d-flex align-items-center left-align">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-sm-9 col-md-7 col-lg-6 offset-sm-3 offset-md-5 offset-lg-6">
                                                                    <div class="caption-txt">
                                                                        <h2 class="steelblue-color"><?= ($lang == "eng") ? $slData['slider_text'] : $slData['slider_text_arabic']; ?></h2>
                                                                        <p class="p-md"><?= ($lang == "eng") ? $slData['slider_desc'] : $slData['slider_desc_arabic']; ?></p>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                        </div> 
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </section>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    if(($org['organization_wel_head'] != null && $org['organization_wel_head_ar'] != "") || ($org['organization_wel_text'] != null && $org['organization_wel_text_arabic'] != ""))
                    {
                        $img = ($org['organization_welcome_image'] != null && $org['organization_welcome_image'] != "") ? true : false;
                        ?>
                        <section id="about-6" class="pt-100 about-section division">
                            <div class="container" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                                <div class="row d-flex align-items-center reverse">
                                    <div class="col-lg-<?= ($img) ? '6' : '12'; ?>" >
                                        <div class="txt-block pc-30 wow fadeInUp" data-wow-delay="0.4s">
                                            <!-- <span class="section-id blue-color"><?= ($lang == "eng") ? $lang_con[9]['lang_eng'] : $lang_con[9]['lang_arabic']; ?></span> -->
                                            <h3 class="h3-md steelblue-color left-after"><?= ($lang == "eng") ? $org['organization_wel_head'] : $org['organization_wel_head_ar']; ?></h3>
                                            <p><?= ($lang == "eng") ? $org['organization_wel_text'] : $org['organization_wel_text_arabic']; ?></p>
                                        </div>
                                    </div>
                                    <?php 
                                    if($img)
                                    {
                                        ?>
                                        <div class="col-lg-6">
                                            <div class="about-img text-center wow fadeInUp" data-wow-delay="0.6s">
                                                <img class="img-fluid" src="<?= file_url().$org['organization_welcome_image'];?>" alt="about-image">
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </section>
                        <?php
                    }
                    ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="appointmentDiv" id="services" style="margin:20px 0px 0px 0px;">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[222]['lang_eng'] : $lang_con[222]['lang_arabic']; ?></h4>
                                <hr>
                                <div id="tabs-nav" class="list-group text-center">
                                    <ul class="nav nav-pills" id="pills-tab" role="tablist" style="list-style:none !important">
                                        <?php
                                        $i = 0;
                                        $sql = query("SELECT * FROM tbl_org_services WHERE org_id = $orgID");
                                        while($pkg = fetch($sql))
                                        {
                                            $i++;
                                            ?>
                                            <li class="nav-item icon-xs">
                                                <a class="nav-link <?= ($i == 1) ? 'active' : ''; ?>" id="tab1-list" data-toggle="pill" href="#tab_<?= $pkg['dpt_service_id']; ?>" role="tab" aria-controls="tab-1" aria-selected="true">
                                                    <?= ($lang == "eng") ? $pkg['org_serv_title'] : $pkg['org_serv_title_ar']; ?>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="tab-content" id="pills-tabContent">
                                    <?php
                                    $i = 0;
                                    $sql = query("SELECT * FROM tbl_clinic_service WHERE dpt_clinic_id = $orgID");
                                    while($pkg = fetch($sql))
                                    {
                                        $i++;
                                        ?>
                                        <div class="tab-pane fade show <?= ($i == 1) ? 'active' : ''; ?>" id="tab_<?= $pkg['dpt_service_id']; ?>"  role="tabpanel" aria-labelledby="tab1-list">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-lg-5">
                                                    <?php
                                                    $ext = pathinfo($pkg['org_serv_img'], PATHINFO_EXTENSION);
                                                    if($ext == "jpeg" || $ext == "jpg" || $ext == "png" || $ext == "gif" || $ext == "jfif")
                                                    {
                                                        ?>
                                                        <div class="tab-img">
                                                            <img class="img-fluid" src="<?= file_url().$pkg['org_serv_img'];?>" alt="tab-image" />
                                                        </div>
                                                        <?php
                                                    }
                                                    else if($ext == "webm" || $ext == "mpg" || $ext == "mp2" || $ext == "mpeg" || $ext == "mpv" || $ext == "mp4" || $ext == "ogg")
                                                    {
                                                        ?>
                                                        <div class="tab-video">
                                                            <video controls autoplay muted playsinline loop id="myvid">
                                                                <source src="<?= file_url().$pkg['org_serv_img'];?>" type="video/<?= $ext;?>">
                                                            </video>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-lg-7" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                                                    <div class="txt-block pc-30">
                                                        <h3 class="h3-md steelblue-color <?= ($lang == "eng") ? 'left-after' : 'right-after' ;?>"><?= ($lang == "eng") ? $pkg['org_serv_title'] : $pkg['org_serv_title_ar']; ?></h3>
                                                        <p class="mb-30"><?= ($lang == "eng") ? $pkg['org_serv_desc'] : $pkg['org_serv_desc_ar']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="appointmentDiv" id="doctors" style="margin:20px 0px 0px 0px;">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[226]['lang_eng'] : $lang_con[226]['lang_arabic']; ?></h4>
                                <hr>
                                <div class="row">
                                    <?php
                                    $sql = query("SELECT * FROM tbl_org_doc WHERE doc_org = $orgID AND doc_active = 1");
                                    while($doc = fetch($sql))
                                    {
                                        ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="doctor-2">
                                                <div class="hover-overlay img-holder"> 
                                                    <img class="img-fluid" src="<?= file_url().$doc['doc_image'];?>" alt="doctor-foto"> 
                                                </div>
                                                <div class="doctor-meta">
                                                    <h5 class="h5-xs blue-color"><?= ($lang == "eng") ? $doc['doc_name'] : $doc['doc_name_ar']; ?></h5>
                                                    <span><?= ($lang == "eng") ? $doc['doc_degree'] : $doc['doc_degree_ar']; ?></span>
                                                    <span><?= ($lang == "eng") ? $doc['doc_designation'] : $doc['doc_designation_ar']; ?></span>
                                                    <span><?= ($lang == "eng") ? $doc['doc_regNo'] : $doc['doc_regNo_ar']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section id="blog-1" class="bordered blog-section division">
                        <div class="container">
                            <div class="row">   
                                <div class="col-lg-10 offset-lg-1 section-title">
                                    <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[12]['lang_eng'] : $lang_con[12]['lang_arabic']; ?></h4>
                                    <hr>
                                    <p><?= ($lang == "eng") ? $lang_con[85]['lang_eng'] : $lang_con[85]['lang_arabic']; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <?php
                                $sql = query("SELECT * FROM tbl_news n LEFT JOIN tbl_department d ON (d.dpt_id = n.news_category) WHERE n.news_active = 1 AND news_user_type = 'organizations' AND news_user_id = $orgID ");
                                while($blog = fetch($sql))
                                {
                                    ?>
                                    <div class="col-lg-4" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                                        <div class="blog-post wow fadeInUp" data-wow-delay="0.4s">
                                            <div class="blog-post-img img-holder">
                                                <img class="img-fluid" src="<?= file_url().$blog['news_image'];?>" alt="blog-post-image" /> 
                                            </div>
                                            <div class="blog-post-txt">
                                                <h5 class="h5-sm steelblue-color"><a target="_blank" href="<?= base_url();?><?= $blog['news_slug']; ?>"><?= ($lang == "eng") ? $blog['news_title'] : $blog['news_title_arabic']; ?></a></h5>
                                                <span><?= date('F j, Y', strtotime($blog['news_created_at']));?> by <span>Dr.Jeremy Smith</span></span>
                                                <p class="overflowing" style="overflow:hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;"><?= ($lang == "eng") ? $blog['news_short_desc'] : $blog['news_short_desc_arabic']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                
                            </div>
                        </div>      
                    </section>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="appointmentDiv" id="photos" style="margin:20px 0px 0px 0px;<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[181]['lang_eng'] : $lang_con[181]['lang_arabic']; ?></h4>
                                <hr>
                                <div class="owl-carousel owl-theme images-holder gallery clearfix">
                                    <?php
                                    $sql = query("SELECT * FROM tbl_org_gallery WHERE gall_org = $orgID");
                                    while($dpt = fetch($sql))
                                    {
                                        ?>
                                        <div class="image-gall" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                                            <div class="img-holder">
                                                <a href="<?= file_url().$dpt['gall_img'];?>" rel="prettyPhoto[photo-gall]">
                                                    <img src="<?= file_url().$dpt['gall_img'];?>"/>
                                                </a>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="appointmentDiv" id="videos" style="margin:20px 0px 0px 0px;<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[182]['lang_eng'] : $lang_con[182]['lang_arabic']; ?></h4>
                                <hr>
                                <div class="owl-carousel owl-theme video-holder">
                                    <?php
                                    $sql = query("SELECT * FROM tbl_org_video WHERE video_org = $orgID");
                                    while($dpt = fetch($sql))
                                    {
                                        ?>
                                        <div class="image-gall" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                                            
                                            <a data-fancybox="gallery" href="https://www.youtube-nocookie.com/embed/<?= $dpt['video_code'];?>?autoplay=1g">
                                                <div class="img-holder2">
                                                    <img style="width:auto;height:auto" src="https://img.youtube.com/vi/<?= $dpt['video_code'];?>/0.jpg">
                                                </div>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="services-3" class="bordered services-section division mobile-hide">
                <div class="container">
                    <div class="row">   
                        <div class="col-lg-10 offset-lg-1 section-title">
                            <h3 class="h3-md steelblue-color"><?= ($lang == "eng") ? $lang_con[193]['lang_eng'] : $lang_con[193]['lang_arabic']; ?></h3>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-md-12">                 
                            <div class="owl-carousel owl-theme certificate-holder">
                                <?php
                                $sql = query("SELECT * FROM tbl_org_awards WHERE award_active = 1 AND award_org = $orgID ORDER BY award_id DESC");
                                while($dpt = fetch($sql))
                                {
                                    ?>
                                    <div class="icon-sm certificate-card" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                                        <div class="img-holder1">
                                            <img class="img-fluid" src="<?= file_url().$dpt['award_image'];?>" alt="content-image" />  
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>                                  
                    </div>
                </div>
            </section>
            
            
            <footer id="footer-3" class="wide-40 footer division" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-info mb-40" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                                <a href="<?= base_url();?>"><img src="<?= file_url().$org['organization_icon'];?>" width="180" height="40" alt="footer-logo"></a>
                                <p class="p-sm mt-20"><?= ($lang == "eng") ? $org['organization_about'] : $org['organization_about_ar']; ?>
                                </p>
                                <!-- <div class="footer-socials-links mt-20">
                                    <ul class="foo-socials text-center clearfix">
                                        <li><a target="_blank" href="<?= $org['clinic_facebook'];?>" class="ico-facebook"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a target="_blank" href="<?= $org['clinic_twitter'];?>" class="ico-twitter"><i class="fab fa-twitter"></i></a></li>  
                                        <li><a target="_blank" href="<?= $org['clinic_youtube'];?>" class="ico-google-plus"><i class="fab fa-youtube"></i></a></li>
                                        <li><a target="_blank" href="<?= $org['clinic_linkedin'];?>" class="ico-linkedin-in"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a target="_blank" href="<?= $org['clinic_instagram'];?>" class="ico-linkedin-in"><i class="fab fa-instagram"></i></a></li>
                                    </ul>                                   
                                </div> -->
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-links mb-40" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                                <h5 class="h5-xs"><?= ($lang == "eng") ? $lang_con[2]['lang_eng'] : $lang_con[2]['lang_arabic']; ?></h5>
                                <ul class="foo-links clearfix">
                                    <li><a href="<?= base_url(); ?>news"><?= ($lang == "eng") ? $lang_con[6]['lang_eng'] : $lang_con[6]['lang_arabic']; ?></a></li>
                                    <li><a href="<?= base_url(); ?>gallery"><?= ($lang == "eng") ? $lang_con[5]['lang_eng'] : $lang_con[5]['lang_arabic']; ?></a></li>
                                    <li><a href="<?= base_url(); ?>about-us"><?= ($lang == "eng") ? $lang_con[2]['lang_eng'] : $lang_con[2]['lang_arabic']; ?></a></li>
                                    <?php
                                    $pSql = query("SELECT * FROM tbl_pages WHERE page_active = 1 AND page_position = 2");
                                    while($pData = fetch($pSql))
                                    {
                                        ?>
                                        <li><a href="<?= base_url().$pData['page_slug'];?>"><?= ($lang == "eng") ? $pData['page_name'] : $pData['page_name_arabic']; ?></a></li>
                                        <?php
                                    }
                                    ?>                                  
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-links mb-40" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                                <h5 class="h5-xs"><?= ($lang == "eng") ? $lang_con[149]['lang_eng'] : $lang_con[149]['lang_arabic']; ?></h5>
                                <ul class="clearfix">                                                                       
                                    <?php
                                    $pSql = query("SELECT * FROM tbl_pages WHERE page_active = 1 AND page_position = 3");
                                    while($pData = fetch($pSql))
                                    {
                                        ?>
                                        <li><a href="<?= base_url().$pData['page_slug'];?>"><?= ($lang == "eng") ? $pData['page_name'] : $pData['page_name_arabic']; ?></a></li>
                                        <?php
                                    }
                                    ?>                              
                                </ul>
                            </div>
                        </div>  
                    </div>
                    <div class="bottom-footer" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="footer-copyright">&copy; <?= date('Y');?> <span><?= ($lang == "eng") ? $siteData['site_name'] : $siteData['site_name_arabic']; ?></span>. <?= ($lang == "eng") ? $lang_con[31]['lang_eng'] : $lang_con[31]['lang_arabic']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <script src="<?= base_url();?>js/jquery-3.3.1.min.js"></script>
        <script src="<?= base_url();?>js/bootstrap.min.js"></script>    
        <script src="https://saudimedico.com/js/jquery-ui.js"></script>
        <script src="<?= base_url();?>js/modernizr.custom.js"></script>
        <script src="<?= base_url();?>js/jquery.easing.js"></script>
        <script src="<?= base_url();?>js/jquery.appear.js"></script>
        <script src="<?= base_url();?>js/jquery.stellar.min.js"></script>   
        <script src="<?= base_url();?>js/menu.js"></script>
        <script src="<?= base_url();?>js/sticky.js"></script>
        <script src="<?= base_url();?>js/jquery.scrollto.js"></script>
        <script src="<?= base_url();?>js/materialize.js"></script>  
        <script src="<?= base_url();?>js/owl.carousel.min.js"></script>
        <script src="<?= base_url();?>js/jquery.magnific-popup.min.js"></script>    
        <script src="<?= base_url();?>js/imagesloaded.pkgd.min.js"></script>
        <script src="<?= base_url();?>js/isotope.pkgd.min.js"></script>
        <script src="<?= base_url();?>js/hero-form.js"></script>
        <script src="<?= base_url();?>js/contact-form.js"></script>
        <script src="<?= base_url();?>js/comment-form.js"></script>
        <script src="<?= base_url();?>js/appointment-form.js"></script>
        <script src="<?= base_url();?>js/jquery.datetimepicker.full.js"></script>       
        <script src="<?= base_url();?>js/jquery.validate.min.js"></script>  
        <script src="<?= base_url();?>js/jquery.ajaxchimp.min.js"></script>
        <script src="<?= base_url();?>js/wow.js"></script>      
        <script src="<?= base_url();?>js/custom.js"></script>
        <script src="<?= base_url();?>js/jquery.prettyPhoto.js"></script>
        <script> 
            new WOW().init();
            $(document).ready(function(){
                $('body img').addClass('img-fluid');
                $('body').find('iframe').parent().addClass('video-holder');
                $("body").on("contextmenu",function(e){
                   return false;
                }); 
            });
        </script>
        <script src="https://fast.wistia.com/embed/medias/2x3lxzrixz.jsonp" async=""></script>
        <script src="https://fast.wistia.com/assets/external/E-v1.js" async=""></script>
        <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
        <script>
            $(document).ready(function(){
                var mq = window.matchMedia("(min-width: 768px)");
                if(mq.matches)
                {
                    $(".doc-banner").height($(".doc-image").height());
                    $(".relate-img").height($(".doc-image").height());
                }
                
                $("a[rel^='prettyPhoto']").prettyPhoto(
                    {
                        animation_speed: 'normal',
                        theme: 'dark_square',
                        slideshow: 3000,
                        autoplay_slideshow: false,
                        social_tools: false,
                        hideflash: true
                        
                    }
                );
            });
        
            $(".card-header h5").click(function(){
                $(this).find('fa').removeClass('fa-plus');
                $(this).find('fa').addClass('fa-minus');
            });
        
            var owl = $('.certificate-holder');
            owl.owlCarousel({
                items: 6,
                loop:true,
                <?= ($lang == "eng") ? '' : 'rtl:true,'; ?>
                autoplay:true,
                navBy: 1,
                autoplayTimeout: 4500,
                autoplayHoverPause: false,
                smartSpeed: 1500,
                responsive:{
                    0:{
                        items:2
                    },
                    767:{
                        items:4
                    },
                    768:{
                        items:3
                    },
                    991:{
                        items:3
                    },
                    1000:{
                        items:4
                    }
                }
            });
            
            var owl = $('.offer-holder');
            owl.owlCarousel({
                items: 6,
                <?= ($lang == "eng") ? '' : 'rtl:true,'; ?>
                loop:true,
                autoplay:true,
                navBy: 1,
                autoplayTimeout: 4500,
                autoplayHoverPause: false,
                smartSpeed: 1500,
                responsive:{
                    0:{
                        items:1
                    },
                    767:{
                        items:2
                    },
                    768:{
                        items:2
                    },
                    991:{
                        items:3
                    },
                    1000:{
                        items:3
                    }
                }
            });
            
            var owl = $('.images-holder');
            owl.owlCarousel({
                items: 4,
                autoplay:true,
                <?= ($lang == "eng") ? '' : 'rtl:true,'; ?>
                navBy: 1,
                dots: false,
                autoplayTimeout: 4500,
                autoplayHoverPause: false,
                smartSpeed: 1500,
                responsive:{
                    0:{
                        items:1
                    },
                    767:{
                        items:1
                    },
                    768:{
                        items:2
                    },
                    991:{
                        items:3
                    },
                    1000:{
                        items:3
                    }
                }
            });
            var owl = $('.video-holder');
            owl.owlCarousel({
                items: 2,
                autoplay:true,
                <?= ($lang == "eng") ? '' : 'rtl:true,'; ?>
                navBy: 1,
                dots: false,
                autoplayTimeout: 4500,
                autoplayHoverPause: false,
                smartSpeed: 1500,
                responsive:{
                    0:{
                        items:1
                    },
                    767:{
                        items:1
                    },
                    768:{
                        items:2
                    },
                    991:{
                        items:2
                    },
                    1000:{
                        items:2
                    }
                }
            });
            var owl = $('.insurance-holder');
            owl.owlCarousel({
                items: 5,
                loop:true,
                <?= ($lang == "eng") ? '' : 'rtl:true,'; ?>
                autoplay:true,
                navBy: 1,
                autoplayTimeout: 4500,
                autoplayHoverPause: false,
                smartSpeed: 1500,
                responsive:{
                    0:{
                        items:2
                    },
                    767:{
                        items:4
                    },
                    768:{
                        items:3
                    },
                    991:{
                        items:3
                    },
                    1000:{
                        items:4
                    }
                }
            });
        </script>
        <?php
    }
    else
    {
        echo "<script>window.history.go(-1);</script>";
    }
}
else
{
    echo "<script>window.history.go(-1);</script>";
}
?>