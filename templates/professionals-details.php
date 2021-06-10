<?php
if(isset($_GET['slug']) && $_GET['slug'] != "" && $_GET['slug'] != null)
{
    $slug = $_GET['slug'];
    include 'proff-connection.php';
    $sql = query("SELECT * FROM tbl_candidate WHERE candidate_active = 1 AND candidate_slug = '$slug'");
    if(nrows($sql) > 0)
    {
        $candidate = fetch($sql);
        $candidateID = $candidate['candidate_id'];
        if($candidate['candidate_package'] == 1)
        {
            include 'professionals-header.php';
            ?>
                <style>
                    iframe{
                        width:100% !important;
                    }
                    .intro-div * {
                        width: 100% !important;
                    }
                    .dart-no-padding-tb{
                        padding-top: 0px !important;
                    }
                    .tg-docprofilechart{
                        border-bottom:  none !important;
                        padding:  0px !important;
                        margin:  0px !important;
                    }
                </style>
                <div class="wsmainfull menu clearfix">
                    <div class="wsmainwp clearfix" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important"' ;?>>
                        <div class="desktoplogo" <?= ($lang == "eng") ? '' : 'style="float:right"' ;?>><a href="<?= base_url();?>"><img src="<?= file_url().$candidate['candidate_logo'];?>" style="width:180px;height:40px" alt="header-logo"></a></div>
                        <nav class="wsmenu clearfix abc"  >
                            <?php
                            if($lang == "eng")
                            {
                                ?>
                                <ul class="wsmenu-list" >
                                    <li class="navbar-item"><a href="<?= base_url();?><?= $slug;?>"><?= ($lang == "eng") ? $lang_con[1]['lang_eng'] : $lang_con[1]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#aboutme"><?= ($lang == "eng") ? $lang_con[180]['lang_eng'] : $lang_con[180]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#photo"><?= ($lang == "eng") ? $lang_con[181]['lang_eng'] : $lang_con[181]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#videogallery"><?= ($lang == "eng") ? $lang_con[182]['lang_eng'] : $lang_con[182]['lang_arabic']; ?></a></li>
                                </ul>
                                <?php
                            }
                            else
                            {
                                ?>
                                <ul class="wsmenu-list" >
                                    <li class="navbar-item"><a href="#videogallery"><?= ($lang == "eng") ? $lang_con[182]['lang_eng'] : $lang_con[182]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#photo"><?= ($lang == "eng") ? $lang_con[181]['lang_eng'] : $lang_con[181]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#aboutme"><?= ($lang == "eng") ? $lang_con[180]['lang_eng'] : $lang_con[180]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="<?= base_url();?><?= $slug;?>"><?= ($lang == "eng") ? $lang_con[1]['lang_eng'] : $lang_con[1]['lang_arabic']; ?></a></li>
                                </ul>
                                <?php
                            }
                            ?>
                        </nav>
                    </div>
                </div>
            </header>
            <section class="dart-no-padding-tb">
                <div class="ms-layers-template">
                    <!-- masterslider -->
                    <div class="master-slider ms-skin-black-2 round-skin" id="masterslider">
                        <div class="ms-slide slide-1" style="z-index: 10" data-delay="10">
                            <span><img src="https://saudimedico.com/images/featured.png" style="position:absolute" /></span>
                            <img class="ttpbanner" src="<?= file_url().$candidate['candidate_banner'];?>" style="width:100% !important; height:260px">
                        </div>
                    </div>
                </div>
            </section>
            <div class="clearfix"></div>
            <main id="main" class="tg-haslayout" <?= ($lang == 'eng') ? '' : 'style="direction:rtl;text-align:right !important"'; ?>>
                <div class="container">
                    <!-- <div class="row" style="margin-bottom:25px; margin-left:0px !important; margin-right:0px !important; padding:0px !important"></div> -->
                    <div style="margin-top:-150px; margin-left:35px; margin-bottom:5px" class="row displayphoto">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="margin-bottom:-10px !important; ">
                            <aside id="tg-sidebar">
                                <div class="tg-widget tg-widget-doctor">
                                    <figure class="tg-docprofile-img" style="margin-bottom:5px !important;">
                                        <a href="#">
                                            <img src="<?= file_url().$candidate['candidate_image'];?>" alt="<?= ($lang == "eng") ? $candidate['candidate_name'] : $candidate['candidate_name_ar'];?>" style="width:75%; margin:auto; border-radius:10%;border:5px solid #1adaea">
                                        </a>
                                    </figure>
                                    <div class="detailstitlemob" style="margin-top:-90px">
                                        <h1 style="font-size:17px !important;  margin:0px !important; padding:0px !important; color:#124c82; font-weight:bold; "><?= ($lang == "eng") ? $candidate['candidate_name'] : $candidate['candidate_name_ar'];?></h1>
                                        <h2 style="font-size:15px !important;  margin:0px !important; padding:0px !important; color:#598dca; font-size:18px; "><?= ($lang == "eng") ? $candidate['candidate_degree'] : $candidate['candidate_degree_ar'];?></h2>
                                        <h3 style="font-size:13px !important; margin:0px !important; padding:0px !important; color:#818181; "><?= ($lang == "eng") ? $candidate['candidate_job'] : $candidate['candidate_job_ar'];?></h3>


                                        <h3 style="font-size:13px !important; margin:0px !important; padding:0px !important; color:#ff6d00; margin-bottom:10px;"><?= ($lang == "eng") ? $candidate['candidate_company'] : $candidate['candidate_company_ar'];?></h3>
                                    </div>
                                </div>
                            </aside>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 namedetails" style="margin-top:100px !important; margin-left:-34px !important; margin-bottom:0px; ">
                            <div class="tg-box" style="margin-left:0px !important">
                                <h1 style="margin:0px !important; padding:0px !important; color:#124c82; font-weight:bold; font-size:24px"><?= ($lang == "eng") ? $candidate['candidate_name'] : $candidate['candidate_name_ar'];?></h1>
                                <h2 style="margin:0px !important; padding:0px !important; color:#598dca; font-size:18px"><?= ($lang == "eng") ? $candidate['candidate_degree'] : $candidate['candidate_job_ar'];?></h2>
                                <h3 style="margin:0px !important; padding:0px !important; color:#818181; font-size:18px"><?= ($lang == "eng") ? $candidate['candidate_job'] : $candidate['candidate_degree_ar'];?></h3>


                                <h3 style="margin:0px !important; padding:0px !important; color:#ff6d00; font-size:18px;"><?= ($lang == "eng") ? $candidate['candidate_company'] : $candidate['candidate_company_ar'];?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                            <aside id="tg-sidebar">
                                <!-- <div style="text-align:center; padding:5px; margin-top:-20px">
                                    <a href="https://www.facebook.com" target="_blank">
                                        <img src="https://saudimedico.com/images/icons/facebook_new.png" />
                                    </a>
                                    <a href="https://twitter.com/" target="_blank">
                                        <img src="https://saudimedico.com/images/icons/twitter_new.png" />
                                    </a>
                                    <a href="https://www.linkedin.com/feed/" target="_blank">
                                        <img src="https://saudimedico.com/images/icons/linkedin_new.png" />
                                    </a>
                                    <a href="https://www.youtube.com/" target="_blank">
                                        <img src="https://saudimedico.com/images/icons/youtube.png" />
                                    </a>
                                    <a href="https://www.instagram.com/" target="_blank">
                                        <img src="https://saudimedico.com/images/icons/instagram.png" />
                                    </a>
                                </div>
                                <div style="font-size:18px; text-align:center; padding:5px;">
                                    <i class="fa fa-star-o" style="color:#dddddd; margin-right:3px;"></i>
                                    <i class="fa fa-star-o" style="color:#dddddd; margin-right:3px;"></i>
                                    <i class="fa fa-star-o" style="color:#dddddd; margin-right:3px;"></i>
                                    <i class="fa fa-star-o" style="color:#dddddd; margin-right:3px;"></i>
                                    <i class="fa fa-star-o" style="color:#dddddd; margin-right:3px;"></i>
                                    <span style="font-size:18px; color:#148c82"> / 1285 View(s)</span>
                                </div> -->
                                <div style="padding:5px; margin-top:-10px; margin-bottom:10px;">
                                    <div class="doctor-photo-btn text-center">
                                        <a href="<?= base_url()."contact-professional/".$slug;?>" class="btn btn-md btn-blue blue-hover"><?= ($lang == "eng") ? $lang_con[183]['lang_eng'] : $lang_con[183]['lang_arabic']; ?> <?= ($lang == "eng") ? $lang_con[207]['lang_eng'] : $lang_con[207]['lang_arabic']; ?></a>
                                    </div>
                                </div>

                                <div class="tg-widget tg-widget-accordions" style="margin-bottom:12px">
                                    <h3 style="background-color:#124c82"><?= ($lang == "eng") ? $lang_con[218]['lang_eng'] : $lang_con[218]['lang_arabic']; ?></h3>
                                    <ul>
                                        <li><?= $candidate['candidate_email'];?></li>
                                        <li><?= ($lang == "eng") ? $candidate['candidate_phone'] : $candidate['candidate_phone_ar'];?></li>
                                        <li><?= ($lang == "eng") ? $candidate['candidate_gender'] : $candidate['candidate_gender_ar'];?></li>
                                        <li><?= ($lang == "eng") ? $candidate['candiate_nationality'] : $candidate['candiate_nationality_ar'];?></li>
                                        <li><?= ($lang == "eng") ? $candidate['candidate_visa'] : $candidate['candidate_visa_ar'];?></li>
                                    </ul>
                                </div>


                                <div class="tg-widget tg-widget-accordions" style="margin-bottom:12px">
                                    <h3 style="background-color:#124c82"><?= ($lang == "eng") ? $lang_con[190]['lang_eng'] : $lang_con[190]['lang_arabic']; ?></h3>
                                    <ul class="tg-doccontactinfo" style="padding-bottom:5px; ">
                                        <?php
                                        $query = query("SELECT * FROM tbl_can_practice_loc pc JOIN tbl_candidate_country c ON (c.country_id = pc.loc_country) JOIN tbl_candidate_cities ci ON (ci.city_id = pc.loc_city) WHERE loc_can_id = $candidateID");
                                        while($loc = fetch($query))
                                        {
                                            ?>
                                            <li class="list-item">
                                                <i class="fa fa-home"></i>
                                                <address>
                                                    <b><?= ($lang == "eng") ? $loc['loc_name'] : $loc['loc_name_ar'] ;?></b>
                                                </address>
                                            </li>
                                            <hr style="margin-top: .10rem;margin-bottom: .10rem;background-color:#00a3c8;height:1px;">
                                            <li class="list-item">
                                                <i class="fa fa-map-marker" style="float:<?= ($lang == "eng") ? 'left' : 'right' ;?>"></i>
                                                <address><?= ($lang == "eng") ? $loc['loc_address'] : $loc['loc_address_ar'] ;?>, <?= ($lang == "eng") ? $loc['country_name'] : $loc['country_name_ar'] ;?>,  <?= ($lang == "eng") ? $loc['city_name'] : $loc['city_name_ar'] ;?><br><?= ($lang == "eng") ? $loc['loc_zip'] : $loc['loc_zip'] ;?>, </address>
                                            </li>
                                            <li class="list-item">
                                                <i class="fa fa-phone"></i>
                                                <span>
                                                    <a href="tel:<?= $loc['loc_number']; ?>"><?= ($lang == "eng") ? $loc['loc_number'] : $loc['loc_number_ar'] ;?></a>
                                                </span>
                                            </li>
                                            <hr style="margin-top: .10rem;margin-bottom: .10rem;background-color:#00a3c8;height:1px;">
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="tg-widget tg-widget-accordions" style="margin-bottom:12px">
                                    <h3 style="background-color:#124c82"><?= ($lang == "eng") ? $lang_con[32]['lang_eng'] : $lang_con[32]['lang_arabic']; ?></h3>
                                    <ul>
                                        <?php
                                        $query = query("SELECT * FROM tbl_can_speciality ds JOIN tbl_candiate_speciality s ON (ds.can_speciality = s.can_speciality_id) WHERE can_spec_can = $candidateID");
                                        while($spec = fetch($query))
                                        {
                                            ?>
                                            <li><?= ($lang == "eng") ? $spec['can_speciality_name'] : $spec['can_speciality_name_ar']; ?></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="tg-widget tg-widget-accordions" style="margin-bottom:12px">
                                    <h3 style="background-color:#124c82"><?= ($lang == "eng") ? $lang_con[222]['lang_eng'] : $lang_con[222]['lang_arabic']; ?></h3>
                                    <ul>
                                        <?php
                                        $query = query("SELECT * FROM tbl_can_services WHERE c_can_id = $candidateID");
                                        while($service = fetch($query))
                                        {
                                            ?>
                                            <li><?= ($lang == "eng") ? $service['c_name'] : $service['c_name_ar']; ?></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="tg-widget tg-tab-widget hidemobile" style="margin-bottom:20px">
                                    <h3 style="background-color:#124c82"><?= ($lang == "eng") ? $lang_con[193]['lang_eng'] : $lang_con[193]['lang_arabic']; ?></h3>
                                    <div class="tg-tabwidet-content" style="padding-bottom:10px; padding-top:0px; padding-right:10px; padding-left:10px">
                                        <div class="tab-content">
                                            <div role="tg-tabpanel" class="tg-tab-pane tab-pane active" style="text-align:center">
                                                <?php
                                                $query = query("SELECT * FROM tbl_can_awards WHERE can_award_can = $candidateID");
                                                while($award = fetch($query))
                                                {
                                                    ?>
                                                    <a href="<?= file_url().$award['can_award_image'];?>" target="_blank">
                                                        <img src="<?= file_url().$award['can_award_image'];?>" style="padding-top:10px">
                                                    </a>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pull-right" style="margin-top:0px">
                            <div class="tg-dashboard tg-haslayout">
                                <div class="tg-docprofilechart tg-haslayout">
                                    <script src="https://saudimedico.com/js/jssor.slider.min.js" type="text/javascript"></script>
                                    <script type="text/javascript">
                                        jssor_1_slider_init = function() {
                                            var jssor_1_SlideshowTransitions = [
                                                {$Duration:1200,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
                                                {$Duration:1200,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
                                            ];
                                            var jssor_1_options = {
                                                $AutoPlay: 1,
                                                $SlideshowOptions: {
                                                    $Class: $JssorSlideshowRunner$,
                                                    $Transitions: jssor_1_SlideshowTransitions,
                                                    $TransitionsOrder: 1
                                                },
                                                $ArrowNavigatorOptions: {
                                                    $Class: $JssorArrowNavigator$
                                                },
                                                $ThumbnailNavigatorOptions: {
                                                    $Class: $JssorThumbnailNavigator$,
                                                    $Orientation: 2,
                                                    $NoDrag: true
                                                }
                                            };
                                            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
                                            var MAX_WIDTH = 750;
                                            function ScaleSlider() {
                                                var containerElement = jssor_1_slider.$Elmt.parentNode;
                                                var containerWidth = containerElement.clientWidth;
                                                if (containerWidth)
                                                {
                                                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);
                                                    jssor_1_slider.$ScaleWidth(expectedWidth);
                                                }
                                                else {
                                                    window.setTimeout(ScaleSlider, 30);
                                                }
                                            }
                                            ScaleSlider();
                                            $Jssor$.$AddEvent(window, "load", ScaleSlider);
                                            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
                                            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
                                        };
                                    </script>
                                    <style>
                                        /* jssor slider loading skin spin css */
                                        .jssorl-009-spin img {
                                          animation-name: jssorl-009-spin;
                                          animation-duration: 1.6s;
                                          animation-iteration-count: infinite;
                                          animation-timing-function: linear;
                                        }

                                        @keyframes jssorl-009-spin {
                                          from {
                                              transform: rotate(0deg);
                                          }

                                          to {
                                              transform: rotate(360deg);
                                          }
                                        }
                                        .jssora061 {display:block;position:absolute;cursor:pointer;}
                                        .jssora061 .a {fill:none;stroke:#fff;stroke-width:360;stroke-linecap:round;}
                                        .jssora061:hover {opacity:.8;}
                                        .jssora061.jssora061dn {opacity:.5;}
                                        .jssora061.jssora061ds {opacity:.3;pointer-events:none;}
                                    </style>
                                    <div id="jssor_1" style="position:relative;margin:0 auto;top:-60px;left:0px;width:750px;height:410px;overflow:hidden;visibility:hidden;">
                                        <!-- Loading Screen -->
                                        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                                            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="https://saudimedico.com//images/spin.svg" />
                                        </div>
                                        <div data-u="slides" style="border:1px solid #e1e0e0; cursor:default;position:relative;top:0px;left:0px;width:750px;height:410px;overflow:hidden;">
                                            <?php
                                            $sql = query("SELECT * FROM tbl_can_slider WHERE can_slider_doc = $candidateID");
                                            while($data = fetch($sql))
                                            {
                                                ?>
                                                <div>
                                                    <img data-u="image" src="<?= file_url().$data['can_slider_image'];?>" />
                                                    
                                                    <?php
                                                    if($data['can_slider_title'] != null && $data['can_slider_title'] != "" )
                                                    {
                                                        ?>
                                                        <div data-u="thumb"><?= ($lang == "eng") ? $data['can_slider_title'] : $data['can_silder_title_ar'];?></div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div data-u="thumbnavigator" style="position:absolute;bottom:0px;left:0px;width:980px;height:50px;color:#FFF;overflow:hidden;cursor:default;background-color:rgba(0,0,0,.5);">
                                            <div data-u="slides">
                                                <div data-u="prototype" style="position:absolute;top:0;left:0;width:980px;height:50px;">
                                                    <div data-u="thumbnailtemplate" style="position:absolute;top:0;left:0;width:100%;height:100%;font-family:verdana;font-weight:normal;line-height:50px;font-size:16px;padding-left:10px;box-sizing:border-box;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-u="arrowleft" class="jssora061" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                                            <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                <path class="a" d="M11949,1919L5964.9,7771.7c-127.9,125.5-127.9,329.1,0,454.9L11949,14079"></path>
                                            </svg>
                                        </div>
                                        <div data-u="arrowright" class="jssora061" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                                            <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                                <path class="a" d="M5869,1919l5984.1,5852.7c127.9,125.5,127.9,329.1,0,454.9L5869,14079"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <script type="text/javascript">jssor_1_slider_init();</script>
                                    <div class="tg-doc-feature tg-haslayout">
                                        <div class="tg-heading-border tg-small" style="padding-bottom:0px !important; ">
                                            <h4 <?= ($lang == 'eng') ? '' : 'style="direction:rtl;text-align:right !important"'; ?>><?= ($lang == "eng") ? $lang_con[116]['lang_eng'] : $lang_con[116]['lang_arabic']; ?></h4>
                                        </div>
                                        <div class="tg-description" style="margin-bottom:25px; ">
                                            <ul>
                                                <?php
                                                $sql_app = query("SELECT * FROM tbl_can_appoint WHERE app_appoint_can = $candidateID");
                                                while($app = fetch($sql_app))
                                                {
                                                    ?>
                                                    <li><?= ($lang == "eng") ? $app['app_appoint_title'] : $app['app_appoint_title_ar']; ?></li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tg-doc-feature tg-haslayout">
                                        <div class="tg-heading-border tg-small" style="padding-bottom:0px !important; ">
                                            <h4 <?= ($lang == 'eng') ? '' : 'style="direction:rtl;text-align:right !important"'; ?>><?= ($lang == "eng") ? $lang_con[220]['lang_eng'] : $lang_con[220]['lang_arabic']; ?></h4>
                                        </div>
                                        <div class="tg-description" style="margin-bottom:25px; ">
                                            <ul>
                                                <?php
                                                $sql_app = query("SELECT * FROM tbl_can_coreskill cr JOIN tbl_candidate_coreskill cc ON (cr.can_skill = cc.core_id) WHERE can_skill_can = $candidateID");
                                                while($app = fetch($sql_app))
                                                {
                                                    ?>
                                                    <li><?= ($lang == "eng") ? $app['core_name'] : $app['core_name_ar']; ?></li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tg-doc-feature tg-haslayout">
                                        <div class="tg-heading-border tg-small" style="padding-bottom:0px !important; ">
                                            <h4 <?= ($lang == 'eng') ? '' : 'style="direction:rtl;text-align:right !important"'; ?>><?= ($lang == "eng") ? $lang_con[187]['lang_eng'] : $lang_con[187]['lang_arabic']; ?></h4>
                                        </div>
                                        <?php
                                        $sql_app = query("SELECT * FROM tbl_can_prof_mem WHERE prof_can = $candidateID");
                                        while($app = fetch($sql_app))
                                        {
                                            ?>
                                            <li><?= ($lang == "eng") ? $app['prof_name'] : $app['prof_name_ar']; ?></li>
                                            <?php
                                        }
                                        ?>
                                    </div>

                                    <div class="tg-doc-feature tg-haslayout">
                                        <div class="tg-heading-border tg-small" style="padding-bottom:0px !important; ">
                                            <h4 <?= ($lang == 'eng') ? '' : 'style="direction:rtl;text-align:right !important"'; ?>><?= ($lang == "eng") ? $lang_con[223]['lang_eng'] : $lang_con[223]['lang_arabic']; ?></h4>
                                        </div>
                                        <div class="tg-description" style="margin-bottom:25px; ">
                                            <ul>
                                                <?php
                                                $sql_app = query("SELECT * FROM tbl_can_institue WHERE institute_can = $candidateID");
                                                while($app = fetch($sql_app))
                                                {
                                                    ?>
                                                    <li><?= ($lang == "eng") ? $app['institute_name'] : $app['institute_name_ar']; ?></li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div id="photo">
                                        <div class="tg-doc-photos" style="margin-top:0px !important; border-top:0px; padding-top:0px !important; margin-bottom:0px !important">
                                            <h4 <?= ($lang == 'eng') ? '' : 'style="direction:rtl;text-align:right !important"'; ?>><?= ($lang == "eng") ? $lang_con[181]['lang_eng'] : $lang_con[181]['lang_arabic']; ?></h4>
                                            <div class="owl-carousel owl-theme images-holder gallery clearfix">
                                                <?php
                                                $sql = query("SELECT * FROM tbl_can_gallery WHERE can_gall_canID = $candidateID");
                                                while($dpt = fetch($sql))
                                                {
                                                    ?>
                                                    <div <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                                                        <div class="img-holder">
                                                            <a href="<?= file_url().$dpt['can_gall_img'];?>" rel="prettyPhoto[photo-gall]">
                                                                <img src="<?= file_url().$dpt['can_gall_img'];?>"/>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="videogallery">
                                        <div class="tg-doc-photos" style="margin-top:0px !important; border-top:0px; padding-top:0px !important; margin-bottom:0px !important">
                                            <h4 <?= ($lang == 'eng') ? '' : 'style="direction:rtl;text-align:right !important"'; ?>><?= ($lang == "eng") ? $lang_con[182]['lang_eng'] : $lang_con[182]['lang_arabic']; ?></h4>
                                            <div class="owl-carousel owl-theme video-holder">
                                                <?php
                                                $sql = query("SELECT * FROM tbl_can_video WHERE can_video_doc = $candidateID");
                                                while($dpt = fetch($sql))
                                                {
                                                    ?>
                                                    <a data-fancybox="gallery" href="https://www.youtube-nocookie.com/embed/<?= $dpt['can_video_code'];?>?autoplay=1g">
                                                        <div class="img-holder">
                                                            <img style="width:auto;height:auto" src="https://img.youtube.com/vi/<?= $dpt['can_video_code'];?>/0.jpg">
                                                        </div>
                                                    </a>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">&nbsp;</div>
                                <div class="tg-doc-feature" >
                                    <div class="tg-heading-border tg-small" style="background-color:#124c82; padding-left:10px; padding-right:10px; margin-bottom:40px !important; ">
                                        <h4 style="color:#fff !important; vertical-align:middle"><?= ($lang == "eng") ? $lang_con[189]['lang_eng'] : $lang_con[189]['lang_arabic']; ?> <?= ($lang == "eng") ? $candidate['candidate_name'] : $candidate['candidate_name_ar'];?>
                                            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#moreprofile" style="float:right; margin-right:10px; margin-top:1px; margin-bottom:0px; font-size:28px; font-weight:bold; padding-top:0px; padding-bottom:0px; padding-right:10px; padding-left:10px; color:#FFF">+</button>
                                        </h4>
                                    </div>
                                    <div id="moreprofile" class="collapse">
                                        <div class="pdfdesktop">
                                            <?= ($lang == "eng") ? $candidate['candiadate_resume'] : $candidate['candiadate_resume_ar'];?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php
            include 'footer.php';
            ?>
            <script src="https://fast.wistia.com/embed/medias/2x3lxzrixz.jsonp" async=""></script>
            <script src="https://fast.wistia.com/assets/external/E-v1.js" async=""></script>
            <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
            <script>
                $(document).ready(function(){
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
                    var owl = $('.images-holder');
                    owl.owlCarousel({
                        items: 4,
                        <?= ($lang == "eng") ? '' : 'rtl:true,'; ?>
                        autoplay:true,
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
                        <?= ($lang == "eng") ? '' : 'rtl:true,'; ?>
                        autoplay:true,
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
                });
            </script>
            <?php
        }
        else
        {
            include 'simple-doc-header.php';
            ?>
            <style>
                #doctor-breadcrumbs{
                    background-image : url('<?= base_url().$candidate['candidate_banner']?>');
                }
                .doctor-photo-btn{
                    padding-top:10px;
                }
                .doctor-info{
                    margin-top: 20px;
                }
            </style>
            <section id="doctor-breadcrumbs" class="bg-fixed doctor-details-section division">  
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 offset-md-5">
                            <div class="doctor-data white-color">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="doctor-1-details" class="doctor-details-section division"> 
                <div class="container" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                    <div class="row">
                        <div class="col-md-5">
                            <br><br><br><br><br><br><br><br><br>
                            <div class="doctor-photo mb-40">
                                <img class="img-fluid" src="<?= file_url().$candidate['candidate_image'];?>" alt="doctor-profile">
                                <div class="doctor-info mt-2 mb-2 p-1">
                                    <div style="font-size:18px; text-align:center; padding:5px;">
                                        <span style="font-size:18px; color:#148c82"> 0 View(s)</span>
                                    </div>
                                    <div class="doctor-photo-btn text-center">
                                        <a href="<?= base_url()."contact-professional/".$slug;?>" class="btn btn-md btn-blue blue-hover"><?= ($lang == "eng") ? $lang_con[183]['lang_eng'] : $lang_con[183]['lang_arabic']; ?> <?= ($lang == "eng") ? $lang_con[207]['lang_eng'] : $lang_con[207]['lang_arabic']; ?></a>
                                    </div>
                                </div>
                                <div class="doctor-info">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td colspan="2" class="text-center">
                                                    <h5 class="h2-xs text-center"><?= ($lang == "eng") ? $candidate['candidate_name'] : $candidate['candidate_name_ar'];?></h5>
                                                    <p><?= ($lang == "eng") ? $candidate['candidate_degree'] : $candidate['candidate_degree_ar'];?></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?= ($lang == "eng") ? $lang_con[206]['lang_eng'] : $lang_con[206]['lang_arabic']; ?>: </td>
                                                <td><p>
                                                    <?php
                                                    $specSql = query("SELECT * FROM tbl_can_speciality cs JOIN tbl_candiate_speciality s ON (cs.can_speciality = s.can_speciality_id) WHERE can_spec_can = $candidateID");
                                                    while($spec = fetch($specSql))
                                                    {
                                                        echo ($lang == "eng") ? $spec['can_speciality_name'] : $spec['can_speciality_name_ar'];
                                                        echo ",";
                                                    }
                                                    ?>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><?= ($lang == "eng") ? $lang_con[208]['lang_eng'] : $lang_con[208]['lang_arabic']; ?>: </td>
                                                <td><p><?= ($lang == "eng") ? $candidate['candidate_job'] : $candidate['candidate_job_ar'];?></p></td>
                                            </tr>
                                            <tr>
                                                <td><?= ($lang == "eng") ? $lang_con[209]['lang_eng'] : $lang_con[209]['lang_arabic']; ?>: </td>
                                                <td><p><?= ($lang == "eng") ? $candidate['candidate_industry'] : $candidate['candidate_industry_ar'];?></p></td>
                                            </tr>
                                            <tr>
                                                <td><?= ($lang == "eng") ? $lang_con[99]['lang_eng'] : $lang_con[99]['lang_arabic']; ?>: </td>
                                                <td><p><?= ($lang == "eng") ? $candidate['candidate_email'] : $candidate['candidate_email'];?></p></td>
                                            </tr>
                                            <tr>
                                                <td><?= ($lang == "eng") ? $lang_con[82]['lang_eng'] : $lang_con[82]['lang_arabic']; ?>: </td>
                                                <td><p><?= ($lang == "eng") ? $candidate['candidate_phone'] : $candidate['candidate_phone_ar'];?></p></td>
                                            </tr>
                                            <tr>
                                                <td><?= ($lang == "eng") ? $lang_con[210]['lang_eng'] : $lang_con[210]['lang_arabic']; ?>: </td>
                                                <td><p><?= ($lang == "eng") ? $candidate['candiate_nationality'] : $candidate['candiate_nationality_ar'];?></p></td>
                                            </tr>
                                            <tr>
                                                <td><?= ($lang == "eng") ? $lang_con[211]['lang_eng'] : $lang_con[211]['lang_arabic']; ?>: </td>
                                                <td><p><?= ($lang == "eng") ? $candidate['candidate_gender'] : $candidate['candidate_gender_ar'];?></p></td>
                                            </tr>
                                            <tr>
                                                <td><?= ($lang == "eng") ? $lang_con[212]['lang_eng'] : $lang_con[212]['lang_arabic']; ?>: </td>
                                                <td><p><?= ($lang == "eng") ? $candidate['candidate_visa'] : $candidate['candidate_visa_ar'];?></p></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="doctor-bio">
                                <?= ($lang == "eng") ? htmlspecialchars_decode(html_entity_decode($candidate['candiadate_resume'])) : htmlspecialchars_decode(html_entity_decode($candidate['candiadate_resume_ar'])); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            include 'footer.php';
        }
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