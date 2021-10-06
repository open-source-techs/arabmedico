<?php
if(isset($_GET['slug']) && $_GET['slug'] != "" && $_GET['slug'] != null)
{
    $slug = $_GET['slug'];
    include 'doc-connection.php';
    $sql = query("SELECT * FROM tbl_doctor dr LEFT JOIN tbl_membership m ON (m.membership_id = dr.doc_membership) WHERE doc_active = 1 AND doc_slug = '$slug'");
    if(nrows($sql) > 0)
    {
        $doc                = fetch($sql);
        $docID              = $doc['doc_id'];
        $meta_title         = $doc['doc_meta_title'];
        $meta_title_ar      = $doc['doc_meta_title_ar'];
        $meta_keyword       = $doc['doc_meta_tag'];
        $meta_keyword_ar    = $doc['doc_meta_tag_ar'];
        $meta_desc          = $doc['doc_meta_desc'];
        $meta_desc_ar       = $doc['doc_meta_desc_ar'];

        function getIPAddress() {
            if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
            }
            else{  
                $ip = $_SERVER['REMOTE_ADDR'];  
            }  
            return $ip;  
        }
        $userIP = getIPAddress();
        $viewCountSql = query("SELECT * FROM tbl_doc_views where view_doc = $docID");
        $viewsql = query("SELECT * FROM tbl_doc_views where view_ip = '$userIP' AND view_doc = $docID ORDER BY view_id DESC LIMIT 1");
        $IPCount = nrows($viewsql);
        $viewCount = nrows($viewCountSql);
        if($IPCount <= 0)
        {
            $dataIP['view_ip']  = $userIP;
            $dataIP['view_doc'] = $docID;
            if(insert($dataIP, 'tbl_doc_views'))
            {
                $viewCount++;
            }
        }
        else
        {
            $ipData = fetch($viewsql);
            $previousTime = strtotime($ipData['view_time']);
            if($dif >= 86400)
            {
                $dataIP['view_ip']  = $userIP;
                $dataIP['view_doc'] = $docID;
                if(insert($dataIP, 'tbl_doc_views'))
                {
                    $viewCount++;
                }
            }
        }


        if($doc['allow_branding'] == 1 && $doc['super_consultant'] == 0)
        {
            include 'membership-header.php';
            ?>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
                <style>
                    iframe{
                        width:100% !important;
                    }
                    .intro-div * {
                            width: 100% !important;
                        }
                </style>
                <div class="wsmainfull menu clearfix">
    				<div class="wsmainwp clearfix" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important"' ;?>>
    					<div class="desktoplogo" <?= ($lang == "eng") ? '' : 'style="float:right"' ;?>><a href="<?= base_url();?>"><img src="<?= file_url().$doc['doc_logo'];?>"  style="width:180px;height:40px" alt="header-logo"></a></div>
      					<nav class="wsmenu clearfix abc"  >
      					    <?php
      					    if($lang == "eng")
      					    {
      					        ?>
        					    <ul class="wsmenu-list" >
    					        	<li class="navbar-item"><a href="<?= base_url();?><?= $slug;?>"><?= ($lang == "eng") ? $lang_con[1]['lang_eng'] : $lang_con[1]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#aboutme"><?= ($lang == "eng") ? $lang_con[180]['lang_eng'] : $lang_con[180]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#photo"><?= ($lang == "eng") ? $lang_con[181]['lang_eng'] : $lang_con[181]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#video"><?= ($lang == "eng") ? $lang_con[182]['lang_eng'] : $lang_con[182]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#news"><?= ($lang == "eng") ? $lang_con[6]['lang_eng'] : $lang_con[6]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#contact"><?= ($lang == "eng") ? $lang_con[183]['lang_eng'] : $lang_con[183]['lang_arabic']; ?></a></li>
            					</ul>
      					        <?php
      					    }
      					    else
      					    {
      					        ?>
        					    <ul class="wsmenu-list" >
    					        	<li class="navbar-item"><a href="#contact"><?= ($lang == "eng") ? $lang_con[183]['lang_eng'] : $lang_con[183]['lang_arabic']; ?></a></li>
    					        	<li class="navbar-item"><a href="#news"><?= ($lang == "eng") ? $lang_con[6]['lang_eng'] : $lang_con[6]['lang_arabic']; ?></a></li>
    					        	<li class="navbar-item"><a href="#video"><?= ($lang == "eng") ? $lang_con[182]['lang_eng'] : $lang_con[182]['lang_arabic']; ?></a></li>
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
            <section id="doctor-top" class="doctor-details-section">
                <div class="container p-0" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                    <div class="row flex-column-reverse flex-md-row">
                        <div class="col-md-4">
                            <div class="doc-image">
                                <div class="doctor-photo">
                                    <img class="img-fluid" src="<?= file_url().$doc['doc_image'];?>" alt="doctor-profile">
                    			</div>
                    			<div class="tg-box" style="<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
    		                        <h1 class="title1"><?= ($lang == "eng") ? $doc['doc_name'] : $doc['doc_name_arabic'];?></h1>
    		                        <h2 class="title2"><?= ($lang == "eng") ? $doc['doc_degree'] : $doc['doc_degree_arabic'];?></h2>
    		                        <h3 class="title3"><?= ($lang == "eng") ? $doc['doc_speciality'] : $doc['doc_speciality_arabic'];?></h3>
    		   		                <h3 class="title4"><?= ($lang == "eng") ? $lang_con[111]['lang_eng'] : $lang_con[111]['lang_arabic']; ?>: <?= ($lang == "eng") ? $doc['doc_reg_no'] : $doc['doc_reg_no_arabic'];?></h3>
    		   	                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="doc-banner">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <?php
                                        $sql = query("SELECT * FROM tbl_doc_slider WHERE doc_slider_doc = $docID");
                                        $i=0;
                                        while($data = fetch($sql))
                                        {
                                            ?>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i; ?>" class="<?= ($i == 0) ? "active" : '' ;?>"></li>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </ol>
                                    <div class="carousel-inner">
                                        <?php
                                        $sql = query("SELECT * FROM tbl_doc_slider WHERE doc_slider_doc = $docID");
                                        $i=0;
                                        while($data = fetch($sql))
                                        {
                                            ?>
                                            <div class="carousel-item <?= ($i == 0 ) ? "active" : '' ;?>">
                                                <img class="d-block w-100 relate-img" src="<?= file_url().$data['doc_slider_image'];?>" alt="">
                                                <?php
                                                if($data['doc_slider_title'] != null && $data['doc_slider_title'] != "" )
                                                {
                                                    ?>
                                                    <div class="carousel-caption d-none d-md-block" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                                                        <h5><?= ($lang == "eng") ? $data['doc_slider_title'] : $data['doc_silder_title_ar'];?></h5>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="doctor-info mt-2 mb-2 p-1">
                		        <div style="text-align:center; padding:5px; margin-top:0px">
            	                    <a href="<?= $doc['doc_facebook_url'];?>" target="_blank"><img src="https://saudimedico.com/images/icons/facebook_new.png"></a>
        	                        <a href="<?= $doc['doc_twitter_url'];?>" target="_blank"><img src="https://saudimedico.com/images/icons/twitter_new.png"></a>
                                    <a href="<?= $doc['doc_linkedin_url'];?>" target="_blank"><img src="https://saudimedico.com/images/icons/linkedin_new.png"></a>
                                    <a href="<?= $doc['doc_youtube_url'];?>" target="_blank"><img src="https://saudimedico.com/images/icons/youtube.png"></a>
                                    <a href="<?= $doc['doc_instagram_url'];?>" target="_blank"><img src="https://saudimedico.com/images/icons/instagram.png"></a>
                                </div>
                                <div style="font-size:18px; text-align:center; padding:5px;">
                                    <i class="fa fa-star" style="color:#dddddd; margin-right:3px;"></i>
                                    <i class="fa fa-star" style="color:#dddddd; margin-right:3px;"></i>
                                    <i class="fa fa-star" style="color:#dddddd; margin-right:3px;"></i>
                                    <i class="fa fa-star" style="color:#dddddd; margin-right:3px;"></i>
                                    <i class="fa fa-star" style="color:#dddddd; margin-right:3px;"></i>
                                    <span style="font-size:18px; color:#148c82"> / <?= $viewCount;?> <?= ($lang == "eng") ? $lang_con[224]['lang_eng'] : $lang_con[224]['lang_arabic']; ?></span>
                                </div>
                                <div class="doctor-photo-btn text-center">
            						<a href="<?= base_url()."appointment";?>&dep=<?= $doc['doctor_department']; ?>&doc=<?= $doc['doc_id'];?>" class="btn btn-md btn-blue blue-hover"><?= ($lang == "eng") ? $lang_con[113]['lang_eng'] : $lang_con[113]['lang_arabic']; ?></a>
            					</div>
            				</div>
            				<div class="pract-loc1" style="margin-bottom:12px">
            				    <h3><?= ($lang == "eng") ? $lang_con[190]['lang_eng'] : $lang_con[190]['lang_arabic']; ?></h3>
                                <hr>
                                <ul class="tg-doccontactinfo" style="padding-bottom:5px; ">
                                    <?php
                                    $query = query("SELECT * FROM tbl_doc_practice_loc pc JOIN tbl_country c ON (c.country_id = pc.loc_country) JOIN tbl_cities ci ON (ci.city_id = pc.loc_city) WHERE loc_doc_id = $docID");
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
                                    <?php 
                                    if($doc['doc_website_url'] != null && $doc['doc_website_url'] != ""){
                                    ?>
                                    <li class="list-item">
                                        <i class="fa fa-link"></i>
                                        <span><a style="font-size: 12px !important;" href="<?= $doc['doc_website_url'];?>" target="_blank"><?= $doc['doc_website_url'];?></a></span>
                                    </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="pract-loc" style="margin-bottom:12px">
                                <h3><?= ($lang == "eng") ? $lang_con[191]['lang_eng'] : $lang_con[191]['lang_arabic']; ?></h3>
                                <hr>
                                <ul class="img-ul">
                                    <?php
                                    $query = query("SELECT * FROM tbl_doc_speciality ds JOIN tbl_specialty s ON (ds.doc_speciality = s.specialty_id) WHERE doc_spec_doc = $docID");
                                    while($spec = fetch($query))
                                    {
                                        ?>
                                        <li><img class="img-fluid" style="height:30px;" src="<?= file_url().$spec['speciality_icon']; ?>"><span><?= ($lang == "eng") ? $spec['specialty_name'] : $spec['specialty_ar_name']; ?></span></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="pract-loc" style="margin-bottom:12px">
                                <h3><?= ($lang == "eng") ? $lang_con[192]['lang_eng'] : $lang_con[192]['lang_arabic']; ?></h3>
                                <hr>
                                <ul>
                                    <?php
                                    $query = query("SELECT * FROM tbl_doc_services WHERE service_doc = $docID");
                                    while($service = fetch($query))
                                    {
                                        ?>
                                        <li><?= ($lang == "eng") ? $service['service_desc'] : $service['service_desc_ar']; ?><span style="float:right"><?= $service['service_amount'];?></span></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            
                            <div class="pract-loc" style="margin-bottom:12px">
                                <h3><?= ($lang == "eng") ? $lang_con[64]['lang_eng'] : $lang_con[64]['lang_arabic']; ?></h3>
                                <hr>
                                <ul>
                                    <?php
                                    if($doc['doc_lang1'] != "" && $doc['doc_lang1'] != null && $doc['doc_lang1_arabic'] != "" && $doc['doc_lang1_arabic'] != null )
                                    {
                                        ?>
                                        <li><?= ($lang == "eng") ? $doc['doc_lang1'] : $doc['doc_lang1_arabic']; ?></li>
                                        <?php
                                    }
                                    if($doc['doc_lang2'] != "" && $doc['doc_lang2'] != null && $doc['doc_lang2_arabic'] != "" && $doc['doc_lang2_arabic'] != null )
                                    {
                                        ?>
                                        <li><?= ($lang == "eng") ? $doc['doc_lang2'] : $doc['doc_lang2_arabic']; ?></li>
                                        <?php
                                    }
                                    if($doc['doc_lang3'] != "" && $doc['doc_lang3'] != null && $doc['doc_lang3_arabic'] != "" && $doc['doc_lang3_arabic'] != null )
                                    {
                                        ?>
                                        <li><?= ($lang == "eng") ? $doc['doc_lang3'] : $doc['doc_lang3_arabic']; ?></li>
                                        <?php
                                    }
                                    if($doc['doc_lang4'] != "" && $doc['doc_lang4'] != null && $doc['doc_lang4_arabic'] != "" && $doc['doc_lang4_arabic'] != null )
                                    {
                                        ?>
                                        <li><?= ($lang == "eng") ? $doc['doc_lang4'] : $doc['doc_lang4_arabic']; ?></li>
                                        <?php
                                    }
                                    if($doc['doc_lang5'] != "" && $doc['doc_lang5'] != null && $doc['doc_lang5_arabic'] != "" && $doc['doc_lang5_arabic'] != null )
                                    {
                                        ?>
                                        <li><?= ($lang == "eng") ? $doc['doc_lang5'] : $doc['doc_lang5_arabic']; ?></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="pract-loc" style="margin-bottom:20px">
                                <h3><?= ($lang == "eng") ? $lang_con[193]['lang_eng'] : $lang_con[193]['lang_arabic']; ?></h3>
                                <hr>
                                <div class="tg-tabwidet-content" style="padding-bottom:10px; padding-top:0px; padding-right:10px; padding-left:10px">
                                    <div class="tab-content">
                                        <div role="tg-tabpanel" class="tg-tab-pane tab-pane active" style="text-align:center">
                                            <?php
                                            $query = query("SELECT * FROM tbl_doc_awards WHERE doc_award_doc = $docID");
                                            while($award = fetch($query))
                                            {
                                                ?>
                                                <a href="<?= file_url().$award['doc_award_image'];?>" target="_blank">
                                                    <img src="<?= file_url().$award['doc_award_image'];?>" style="padding-top:10px">
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="intro-div">
                                <h4><?= ($lang == "eng") ? $lang_con[184]['lang_eng'] : $lang_con[184]['lang_arabic']; ?></h4>
                                <hr>
                                <div class="info">
                                    <?= ($lang == "eng") ? htmlspecialchars_decode(html_entity_decode($doc['doc_intro'])) : htmlspecialchars_decode(html_entity_decode($doc['doc_intro_arabic'])); ?>
                                </div>
                            </div>
                            <div class="appointmentDiv" id="appointmentDiv" style="margin:20px 0px 0px 0px;<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[116]['lang_eng'] : $lang_con[116]['lang_arabic']; ?></h4>
                                <hr>
                                <ul>
                                <?php
                                $sql_app = query("SELECT * FROM tbl_doc_appoint WHERE doc_appoint_doc = $docID");
                                while($app = fetch($sql_app))
                                {
                                    ?>
                                    <li><?= ($lang == "eng") ? $app['doc_appoint_title'] : $app['doc_appoint_title_ar']; ?></li>
                                    <?php
                                }
                                ?>
                                </ul>
                            </div>
                            <div class="appointmentDiv" id="intrestDiv" style="margin:20px 0px 0px 0px;<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[185]['lang_eng'] : $lang_con[185]['lang_arabic']; ?></h4>
                                <hr>
                                <ul>
                                <?php
                                $sql_app = query("SELECT * FROM tbl_special_intrest WHERE intrest_doc = $docID");
                                while($app = fetch($sql_app))
                                {
                                    ?>
                                    <li><?= ($lang == "eng") ? $app['intrest_name'] : $app['intrest_name_ar']; ?></li>
                                    <?php
                                }
                                ?>
                                </ul>
                            </div>
                            <div class="appointmentDiv" id="intrestDiv1" style="margin:20px 0px 0px 0px;<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[186]['lang_eng'] : $lang_con[186]['lang_arabic']; ?></h4>
                                <hr>
                                <ul>
                                <?php
                                $sql_app = query("SELECT * FROM tbl_doc_treatments dt JOIN tbl_specialty s ON (dt.treatment_speciality = s.specialty_id) JOIN tbl_treatment t ON (t.treatment_id = dt.treatment_condition) WHERE treatment_doc = $docID");
                                while($app = fetch($sql_app))
                                {
                                    ?>
                                    <li><?= ($lang == "eng") ? $app['specialty_name'] : $app['specialty_ar_name']; ?>, <?= ($lang == "eng") ? $app['treatment_name'] : $app['treatment_ar_name']; ?></li>
                                    <?php
                                }
                                ?>
                                </ul>
                            </div>
                            <div class="appointmentDiv" id="intrestDiv2" style="margin:20px 0px 0px 0px;<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[187]['lang_eng'] : $lang_con[187]['lang_arabic']; ?></h4>
                                <hr>
                                <ul>
                                <?php
                                $sql_app = query("SELECT * FROM tbl_prof_mem WHERE prof_doc = $docID");
                                while($app = fetch($sql_app))
                                {
                                    ?>
                                    <li><?= ($lang == "eng") ? $app['prof_name'] : $app['prof_name_ar']; ?></li>
                                    <?php
                                }
                                ?>
                                </ul>
                            </div>
                            <div class="appointmentDiv" id="intrestDiv3" style="margin:20px 0px 0px 0px;<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[188]['lang_eng'] : $lang_con[188]['lang_arabic']; ?></h4>
                                <hr>
                                <ul>
                                <?php
                                $sql_app = query("SELECT * FROM tbl_doc_institue WHERE institute_doc = $docID");
                                while($app = fetch($sql_app))
                                {
                                    ?>
                                    <li><?= ($lang == "eng") ? $app['institute_name'] : $app['institute_name_ar']; ?></li>
                                    <?php
                                }
                                ?>
                                </ul>
                            </div>
                            <div class="appointmentDiv" id="intrestDiv4" style="margin:20px 0px 0px 0px;<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[181]['lang_eng'] : $lang_con[181]['lang_arabic']; ?></h4>
                                <hr>
                                <div class="owl-carousel owl-theme images-holder">
                				    <?php
                				    $sql = query("SELECT * FROM tbl_doctor_gallery WHERE doc_gall_docID = $docID");
                         		    while($dpt = fetch($sql))
                         		    {
                         		        ?>
                    					<div <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                    						<div class="img-holder">
                    						    <a href="<?= file_url().$dpt['doc_gall_img'];?>" rel="prettyPhoto[gallery-1]">
                    						        <img src="<?= file_url().$dpt['doc_gall_img'];?>"/>
                    						    </a>
                					        </div>
                    					</div>
                    					<?php
                			        }
                			        ?>
                				</div>
                            </div>
                            <div class="appointmentDiv" id="intrestDiv5" style="margin:20px 0px 0px 0px;<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[182]['lang_eng'] : $lang_con[182]['lang_arabic']; ?></h4>
                                <hr>
                                <div class="owl-carousel owl-theme video-holder">
                				    <?php
                				    $sql = query("SELECT * FROM tbl_doc_video WHERE doc_video_doc = $docID");
                         		    while($dpt = fetch($sql))
                         		    {
                         		        ?>
                    					<a data-fancybox="gallery" href="https://www.youtube-nocookie.com/embed/<?= $dpt['doc_video_code'];?>?autoplay=1g">
                						    <div class="img-holder">
            					                <img style="width:auto;height:auto" src="https://img.youtube.com/vi/<?= $dpt['doc_video_code'];?>/0.jpg">
            					            </div>
                                        </a>
                    					<?php
                			        }
                			        ?>
                				</div>
                            </div>
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button style="width:100%" class="btn btn-link d-flex justify-content-between" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <span><?= ($lang == "eng") ? $lang_con[189]['lang_eng'] : $lang_con[189]['lang_arabic']; ?> <?= ($lang == "eng") ? $doc['doc_name'] : $doc['doc_name_arabic'];?></span>
                                            <i class="fa fa-plus"></i>
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="doctor-bio">
                         					<?= ($lang == "eng") ? htmlspecialchars_decode(html_entity_decode($doc['doc_details'])) : htmlspecialchars_decode(html_entity_decode($doc['doc_details_arabic'])); ?>
                        				</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            include 'footer.php';
            ?>
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
                });
                
                $(".card-header h5").click(function(){
                    $(this).find('fa').removeClass('fa-plus');
                    $(this).find('fa').addClass('fa-minus');
                });
                
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
            </script>
            <?php
        }
        else if($doc['super_consultant'] == 1)
        {
            include 'membership-header.php';
            ?>
                <div class="wsmainfull menu clearfix">
    				<div class="wsmainwp clearfix" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important"' ;?>>
    					<div class="desktoplogo" <?= ($lang == "eng") ? '' : 'style="float:right"' ;?>><a href="#hero-10"><img src="<?= file_url().$doc['doc_logo'];?>" style="width:180px;height:40px" alt="header-logo"></a></div>
      					<nav class="wsmenu clearfix abc"  >
      					    <?php
      					    if($lang == "eng")
      					    {
      					        ?>
        					    <ul class="wsmenu-list" >
    					        	<li class="navbar-item"><a href="<?= base_url();?><?= $slug;?>"><?= ($lang == "eng") ? $lang_con[1]['lang_eng'] : $lang_con[1]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#aboutme"><?= ($lang == "eng") ? $lang_con[180]['lang_eng'] : $lang_con[180]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#photo"><?= ($lang == "eng") ? $lang_con[181]['lang_eng'] : $lang_con[181]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#video"><?= ($lang == "eng") ? $lang_con[182]['lang_eng'] : $lang_con[182]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#news"><?= ($lang == "eng") ? $lang_con[6]['lang_eng'] : $lang_con[6]['lang_arabic']; ?></a></li>
                                    <li class="navbar-item"><a href="#contact"><?= ($lang == "eng") ? $lang_con[183]['lang_eng'] : $lang_con[183]['lang_arabic']; ?></a></li>
            					</ul>
      					        <?php
      					    }
      					    else
      					    {
      					        ?>
        					    <ul class="wsmenu-list" >
    					        	<li class="navbar-item"><a href="#contact"><?= ($lang == "eng") ? $lang_con[183]['lang_eng'] : $lang_con[183]['lang_arabic']; ?></a></li>
    					        	<li class="navbar-item"><a href="#news"><?= ($lang == "eng") ? $lang_con[6]['lang_eng'] : $lang_con[6]['lang_arabic']; ?></a></li>
    					        	<li class="navbar-item"><a href="#video"><?= ($lang == "eng") ? $lang_con[182]['lang_eng'] : $lang_con[182]['lang_arabic']; ?></a></li>
    					        	<li class="navbar-item"><a href="#photo"><?= ($lang == "eng") ? $lang_con[181]['lang_eng'] : $lang_con[181]['lang_arabic']; ?></a></li>
    					        	<li class="navbar-item"><a href="#aboutme"><?= ($lang == "eng") ? $lang_con[180]['lang_eng'] : $lang_con[180]['lang_arabic']; ?></a></li>
    					        	<li class="navbar-item"><a href="<?= base_url();?>dr<?= $pram;?>/<?= $slug;?>"><?= ($lang == "eng") ? $lang_con[1]['lang_eng'] : $lang_con[1]['lang_arabic']; ?></a></li>
            					</ul>
      					        <?php
      					    }
      					    ?>
        				</nav>
    				</div>
    			</div>
			</header>
	        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
			<style>
			    iframe{
                    width:100% !important;
                }
			    #doctor-top-mobile{
			        display:none;
			    }
			    #doctor-top{
			        display:block;
			    }
			    .mobile-hide{
			        display:block;
			    }
                .appointmentDiv ul{
                    list-style:none !important;
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
                @media (max-width: 575px){
                    #doctor-top-mobile{
    			        display:block;
    			    }
    			    #doctor-top{
    			        display:none;
    			    }
    			    .mobile-hide{
    			        display:none;
    			    }
			    }
            </style>
			<section id="doctor-top-mobile" class="doctor-details-section">
			    <div class="container p-0" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="doc-image-mobile">
                                <div class="doctor-photo">
                                    <img class="img-fluid" src="<?= file_url().$doc['doc_image'];?>" alt="doctor-profile">
                    			</div>
                    			<div class="tg-box" style="<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
    		                        <h1 class="title1"><?= ($lang == "eng") ? $doc['doc_name'] : $doc['doc_name_arabic'];?></h1>
    		                        <h2 class="title2"><?= ($lang == "eng") ? $doc['doc_degree'] : $doc['doc_degree_arabic'];?></h2>
    		                        <h3 class="title3"><?= ($lang == "eng") ? $doc['doc_speciality'] : $doc['doc_speciality_arabic'];?></h3>
    		   		                <h3 class="title4"><?= ($lang == "eng") ? $lang_con[111]['lang_eng'] : $lang_con[111]['lang_arabic']; ?>: <?= ($lang == "eng") ? $doc['doc_reg_no'] : $doc['doc_reg_no_arabic'];?></h3>
    		   	                </div>
                            </div>
                            <div class="doctor-info mt-2 mb-2 p-1">
                		        <div style="text-align:center; padding:5px; margin-top:0px">
            	                    <a href="<?= $doc['doc_facebook_url'];?>" target="_blank"><img src="https://saudimedico.com/images/icons/facebook_new.png"></a>
        	                        <a href="<?= $doc['doc_twitter_url'];?>" target="_blank"><img src="https://saudimedico.com/images/icons/twitter_new.png"></a>
                                    <a href="<?= $doc['doc_linkedin_url'];?>" target="_blank"><img src="https://saudimedico.com/images/icons/linkedin_new.png"></a>
                                    <a href="<?= $doc['doc_youtube_url'];?>" target="_blank"><img src="https://saudimedico.com/images/icons/youtube.png"></a>
                                    <a href="<?= $doc['doc_instagram_url'];?>" target="_blank"><img src="https://saudimedico.com/images/icons/instagram.png"></a>
                                </div>
                                <div style="font-size:18px; text-align:center; padding:5px;">
                                    <i class="fa fa-star" style="color:#dddddd; margin-right:3px;"></i>
                                    <i class="fa fa-star" style="color:#dddddd; margin-right:3px;"></i>
                                    <i class="fa fa-star" style="color:#dddddd; margin-right:3px;"></i>
                                    <i class="fa fa-star" style="color:#dddddd; margin-right:3px;"></i>
                                    <i class="fa fa-star" style="color:#dddddd; margin-right:3px;"></i>
                                    <span style="font-size:18px; color:#148c82"> <?= $IPCount;?> / <?= ($lang == "eng") ? $lang_con[224]['lang_eng'] : $lang_con[224]['lang_arabic']; ?></span>
                                </div>
                                <div class="doctor-photo-btn text-center">
            						<a href="<?= base_url()."appointment";?>&dep=<?= $doc['doctor_department']; ?>&doc=<?= $doc['doc_id'];?>" class="btn btn-md btn-blue blue-hover"><?= ($lang == "eng") ? $lang_con[113]['lang_eng'] : $lang_con[113]['lang_arabic']; ?></a>
            					</div>
            				</div>
                        </div>
                        <div class="col-md-12">
                            <div class="doc-banner1">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <?php
                                        $sql = query("SELECT * FROM tbl_doc_slider WHERE doc_slider_doc = $docID");
                                        $i=0;
                                        while($data = fetch($sql))
                                        {
                                            ?>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i; ?>" class="<?= ($i == 0) ? "active" : '' ;?>"></li>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </ol>
                                    <div class="carousel-inner">
                                        <?php
                                        $sql = query("SELECT * FROM tbl_doc_slider WHERE doc_slider_doc = $docID");
                                        $i=0;
                                        while($data = fetch($sql))
                                        {
                                            ?>
                                            <div class="carousel-item <?= ($i == 0 ) ? "active" : '' ;?>">
                                                <img class="d-block w-100 relate-img" src="<?= file_url().$data['doc_slider_image'];?>" alt="">
                                                <?php
                                                if($data['doc_slider_title'] != null && $data['doc_slider_title'] != "" )
                                                {
                                                    ?>
                                                    <div class="carousel-caption d-none d-md-block" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                                                        <h5><?= ($lang == "eng") ? $data['doc_slider_title'] : $data['doc_silder_title_ar'];?></h5>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="intro-div">
                                <h4><?= ($lang == "eng") ? $lang_con[184]['lang_eng'] : $lang_con[184]['lang_arabic']; ?></h4>
                                <hr>
                                <div class="info">
                                    <?= ($lang == "eng") ? htmlspecialchars_decode(html_entity_decode($doc['doc_intro'])) : htmlspecialchars_decode(html_entity_decode($doc['doc_intro_arabic'])); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="appointmentDiv">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[150]['lang_eng'] : $lang_con[150]['lang_arabic']; ?></h4>
                                <hr>
                                <div class="row ">
                                    <div class="col-md-12">
                            			<div id="tabs-nav" class="list-group text-center">
                            			    <ul class="nav nav-pills" id="pills-tab" role="tablist" style="list-style:none !important;">
                            			        <?php
                            			        $i = 0;
                            			        $sql = query("SELECT * FROM tbl_doc_clinicalServices WHERE c_doc_id = $docID");
                            			        while($pkg = fetch($sql))
                            			        {
                            			            $i++;
                            			            ?>
                            			            <li class="nav-item icon-xs">
                                				    	<a class="nav-link <?= ($i == 1) ? 'active' : ''; ?>" id="tab1-list" data-toggle="pill" href="#tab-<?= $pkg['c_id']; ?>" role="tab" aria-controls="tab-1" aria-selected="true">
                                				    		<?= ($lang == "eng") ? $pkg['c_name'] : $pkg['c_name_ar']; ?>
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
                        					$sql = query("SELECT * FROM tbl_doc_clinicalServices WHERE c_doc_id = $docID");
                        					while($pkg = fetch($sql))
                        					{
                        					    $i++;
                        					    ?>
                        					    <div class="tab-pane fade show <?= ($i == 1) ? 'active' : ''; ?>" id="tab-<?= $pkg['c_id']; ?>"  role="tabpanel" aria-labelledby="tab1-list">
                            						<div class="row d-flex align-items-center">
                            							<div class="col-lg-5 col-md-5 col-12">
                            							    <?php
                            							    $ext = pathinfo($pkg['c_image'], PATHINFO_EXTENSION);
                            							    if($ext == "jpeg" || $ext == "jpg" || $ext == "png" || $ext == "gif" || $ext == "jfif")
                            							    {
                            							        ?>
                            							        <div class="tab-img">
                            									<img class="img-fluid" src="<?= file_url().$pkg['c_image'];?>" alt="tab-image" />
                            								</div>
                            							        <?php
                            							    }
                            							    else if($ext == "webm" || $ext == "mpg" || $ext == "mp2" || $ext == "mpeg" || $ext == "mpv" || $ext == "mp4" || $ext == "ogg")
                            							    {
                            							        ?>
                            							        <div class="tab-video">
                                									<video controls autoplay muted playsinline loop id="myvid">
                                                                        <source src="<?= file_url().$pkg['c_image'];?>" type="video/mp4">
                                                                    </video>
                                								</div>
                            							        <?php
                            							    }
                            							    ?>
                            								
                            							</div>
                            							<div class="col-lg-7 col-md-7 col-12" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                            								<div class="txt-block pc-30">
                            									<h3 class="h3-md steelblue-color <?= ($lang == "eng") ? 'left-after' : 'right-after' ;?>"><?= ($lang == "eng") ? $pkg['c_name'] : $pkg['c_name_ar']; ?></h3>
                            									<p class="mb-30"><?= ($lang == "eng") ? $pkg['c_desc'] : $pkg['c_desc_ar']; ?></p>
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
                        </div>
                        <div class="col-md-12">
                            <div class="pract-loc" style="margin-bottom:12px">
                                <h3><?= ($lang == "eng") ? $lang_con[191]['lang_eng'] : $lang_con[191]['lang_arabic']; ?></h3>
                                <hr>
                                <ul class="img-ul">
                                    <?php
                                    $query = query("SELECT * FROM tbl_doc_speciality ds JOIN tbl_specialty s ON (ds.doc_speciality = s.specialty_id) WHERE doc_spec_doc = $docID");
                                    while($spec = fetch($query))
                                    {
                                        ?>
                                        <li><img class="img-fluid" style="height:30px;" src="<?= file_url().$spec['speciality_icon']; ?>"><span><?= ($lang == "eng") ? $spec['specialty_name'] : $spec['specialty_ar_name']; ?></span></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="appointmentDiv" id="appointmentDiv" style="margin:20px 0px 0px 0px;<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[194]['lang_eng'] : $lang_con[194]['lang_arabic']; ?></h4>
                                <hr>
                                <ul>
                                <?php
                                $sql_app = query("SELECT * FROM tbl_doc_appoint a JOIN tbl_country co ON (a.app_hospCountry = co.country_id) JOIN tbl_cities ci on (a.app_hospCity = ci.city_id)  WHERE doc_appoint_doc = $docID");
                                while($app = fetch($sql_app))
                                {
                                    ?>
                                    <li>
                                        <div class="d-flex">
                                            <div class="img">
                                                <img class="img-fluid" style="height:50px; width:auto" src="<?= file_url().$app['app_hospLogo']?>">
                                            </div>
                                            <div class="text">
                                                <h5><?= ($lang == "eng") ? $app['doc_appoint_title'] : $app['doc_appoint_title_ar']; ?></h5>
                                                <h6><?= ($lang == "eng") ? $app['app_hospName'] : $app['app_hospName_ar']; ?></h6>
                                                <p><?= ($lang == "eng") ? date('Y', strtotime($app['app_hospStartDate'])) : date('Y', strtotime($app['app_hospStartDate'])); ?> - <?php 
                                                if($app['app_hospEndDate'] == "Present")
                                                {
                                                   ?>
                                                   <?= ($lang == "eng") ? $app['app_hospEndDate'] : $app['app_hospEndDate'];?>
                                                   <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <?= ($lang == "eng") ? date('Y', strtotime($app['app_hospEndDate'])) : date('Y', strtotime($app['app_hospEndDate'])); ?>
                                                   <?php
                                                }
                                                ?> </p>
                                                <p style="margin-top: -8px;"><?= ($lang == "eng") ? $app['city_name'] : $app['city_name_ar']; ?> , <?= ($lang == "eng") ? $app['country_name'] : $app['country_name_ar']; ?></p>
                                            </div>
                                        </div>
                                        
                                    </li>
                                    <?php
                                }
                                ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="appointmentDiv" id="appointmentDiv" style="margin:20px 0px 0px 0px;<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[187]['lang_eng'] : $lang_con[187]['lang_arabic']; ?></h4>
                                <hr>
                                <ul>
                                <?php
                                $sql_app = query("SELECT * FROM tbl_prof_mem a JOIN tbl_country co ON (a.prof_country = co.country_id) JOIN tbl_cities ci on (a.prof_city = ci.city_id)  WHERE prof_doc = $docID");
                                while($app = fetch($sql_app))
                                {
                                    ?>
                                    <li>
                                        <div class="d-flex">
                                            <div class="img">
                                                <img class="img-fluid" style="height:50px; width:auto" src="<?= file_url().$app['prof_logo']?>">
                                            </div>
                                            <div class="text">
                                                <h5><?= ($lang == "eng") ? $app['prof_name'] : $app['prof_name_ar']; ?></h5>
                                                <h6><?= ($lang == "eng") ? $app['prof_bodyname'] : $app['prof_bodyname_ar']; ?></h6>
                                                <p><?= ($lang == "eng") ? date('Y', strtotime($app['prof_yearfrom'])) : changeNumberToArabic(date('Y', strtotime($app['prof_yearfrom']))) ; ?> - <?= ($lang == "eng") ? date('Y', strtotime($app['prof_yearto'])) : changeNumberToArabic(date('Y', strtotime($app['prof_yearto']))); ?></p>
                                                <p style="margin-top: -8px;"><?= ($lang == "eng") ? $app['city_name'] : $app['city_name_ar']; ?> , <?= ($lang == "eng") ? $app['country_name'] : $app['country_name_ar']; ?></p>
                                            </div>
                                        </div>
                                        
                                    </li>
                                    <?php
                                }
                                ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="appointmentDiv" id="appointmentDiv" style="margin:20px 0px 0px 0px;<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[195]['lang_eng'] : $lang_con[195]['lang_arabic']; ?></h4>
                                <hr>
                                <ul>
                                <?php
                                $sql_app = query("SELECT * FROM tbl_doc_education a JOIN tbl_country co ON (a.edu_country = co.country_id) JOIN tbl_cities ci on (a.edu_city = ci.city_id)  WHERE edu_doc = $docID");
                                while($app = fetch($sql_app))
                                {
                                    ?>
                                    <li>
                                        <div class="d-flex">
                                            <div class="img">
                                                <img class="img-fluid" style="height:50px; width:auto" src="<?= file_url().$app['edu_logo']?>">
                                            </div>
                                            <div class="text">
                                                <h5><?= ($lang == "eng") ? $app['edu_degree'] : $app['edu_degree_ar']; ?></h5>
                                                <h6><?= ($lang == "eng") ? $app['edu_institute'] : $app['edu_institute_ar']; ?></h6>
                                                <p><?= ($lang == "eng") ? date('Y', strtotime($app['edu_year'])) : changeNumberToArabic(date('Y', strtotime($app['edu_year']))); ?></p>
                                                <p style="margin-top: -8px;"><?= ($lang == "eng") ? $app['city_name'] : $app['city_name_ar']; ?> , <?= ($lang == "eng") ? $app['country_name'] : $app['country_name_ar']; ?></p>
                                            </div>
                                        </div>
                                        
                                    </li>
                                    <?php
                                }
                                ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button style="width:100%" class="btn btn-link d-flex justify-content-between" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <span><?= ($lang == "eng") ? $lang_con[189]['lang_eng'] : $lang_con[189]['lang_arabic']; ?> <?= ($lang == "eng") ? $doc['doc_name'] : $doc['doc_name_arabic'];?></span>
                                            <i class="fa fa-plus"></i>
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="doctor-bio">
                         					<?= ($lang == "eng") ? htmlspecialchars_decode(html_entity_decode($doc['doc_details'])) : htmlspecialchars_decode(html_entity_decode($doc['doc_details_arabic'])); ?>
                        				</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="services-3" class="bordered services-section division doctor-info1">
                    		    <div class="row">	
                        			<div class="col-lg-10 offset-lg-1 section-title">
                        				<h3 class="h3-md steelblue-color"><?= ($lang == "eng") ? $lang_con[135]['lang_eng'] : $lang_con[135]['lang_arabic']; ?></h3>
                        				
                        				<p><?= ($lang == "eng") ? $lang_con[136]['lang_eng'] : $lang_con[136]['lang_arabic']; ?></p>
                        			</div> 
                        		</div>
                                <div class="row">
                        			<div class="col-md-12">					
                        				<div class="owl-carousel owl-theme certificate-holder">
                        				    <?php
                        				    $sql = query("SELECT * FROM tbl_certificate WHERE certificate_active = 1 ORDER BY certificate_id DESC");
                                 		    while($dpt = fetch($sql))
                                 		    {
                                 		        ?>
                            					<div class="icon-sm" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                            						<div class="img-holder">
                        					            <img class="img-fluid" src="<?= file_url().$dpt['cetificate_image'];?>" alt="content-image" />	
                        					        </div>
                        					        <!--<h5 class="h5-xs steelblue-color"><a href="javascript.void();"><?= ($lang == "eng") ? $dpt['certificate_title'] : $dpt['certificate_title_arabic']; ?></a></h5>-->
                            					</div>
                            					<?php
                        			        }
                        			        ?>
                        				</div>
                        			</div>									
                        		</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="reviews-2" class="bordered reviews-section division doctor-info1">
                        		<div class="row">
                        			<div class="col-lg-10 offset-lg-1 section-title">
                        				<h3 class="h3-md steelblue-color"><?= ($lang == "eng") ? $lang_con[11]['lang_eng'] : $lang_con[11]['lang_arabic']; ?></h3>
                        				<p><?= ($lang == "eng") ? $lang_con[84]['lang_eng'] : $lang_con[84]['lang_arabic']; ?></p>
                        			</div> 
                        		</div>
                        		<style>
                        		    #reviews-2 .testimonial-avatar img{
                    		            width: 120px;
                                        height: 120px;
                                        margin: 0 0 5px 0;
                        		    }
                        		</style>
                        		<div class="row">
                        			<div class="col-md-12">					
                        				<div class="owl-carousel owl-theme reviews-holder">
                        				    <?php
                        				    $rSql = query("SELECT * FROM tbl_doc_testimonial where testimonial_doc = $docID");
                        				    while($rData = fetch($rSql))
                        				    {
                        				        ?>
                        					    <div class="review-2">
                            						<div class="review-txt text-center">
                            							
                            							<div class="testimonial-avatar">
                            								<img src="<?= file_url().$rData['testimonial_image'];?>" alt="testimonial-avatar">
                            							</div>
                            							<p>
                            							    <?= ($lang == "eng") ? $rData['testimonial_desc'] : $rData['testimonial_desc_arabic']; ?>
                            							</p>
                            							<div class="review-author">
                            								<h5 class="h5-sm"><?= ($lang == "eng") ? $rData['testimonial_username'] : $rData['testimonial_username_ar'];?></h5>
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
                        </div>
                        <div class="col-md-12">
                            <div class="pract-loc" style="margin-bottom:12px">
                                <h3><?= ($lang == "eng") ? $lang_con[192]['lang_eng'] : $lang_con[192]['lang_arabic']; ?></h3>
                                <hr>
                                <ul>
                                    <?php
                                    $query = query("SELECT * FROM tbl_doc_services WHERE service_doc = $docID");
                                    while($service = fetch($query))
                                    {
                                        ?>
                                        <li><?= ($lang == "eng") ? $service['service_desc'] : $service['service_desc_ar']; ?><span style="float:right"><?= $service['service_amount'];?></span></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="pract-loc" style="margin-bottom:12px">
                                <h3><?= ($lang == "eng") ? $lang_con[64]['lang_eng'] : $lang_con[64]['lang_arabic']; ?></h3>
                                <hr>
                                <ul>
                                    <?php
                                    if($doc['doc_lang1'] != "" && $doc['doc_lang1'] != null && $doc['doc_lang1_arabic'] != "" && $doc['doc_lang1_arabic'] != null )
                                    {
                                        ?>
                                        <li><?= ($lang == "eng") ? $doc['doc_lang1'] : $doc['doc_lang1_arabic']; ?></li>
                                        <?php
                                    }
                                    if($doc['doc_lang2'] != "" && $doc['doc_lang2'] != null && $doc['doc_lang2_arabic'] != "" && $doc['doc_lang2_arabic'] != null )
                                    {
                                        ?>
                                        <li><?= ($lang == "eng") ? $doc['doc_lang2'] : $doc['doc_lang2_arabic']; ?></li>
                                        <?php
                                    }
                                    if($doc['doc_lang3'] != "" && $doc['doc_lang3'] != null && $doc['doc_lang3_arabic'] != "" && $doc['doc_lang3_arabic'] != null )
                                    {
                                        ?>
                                        <li><?= ($lang == "eng") ? $doc['doc_lang3'] : $doc['doc_lang3_arabic']; ?></li>
                                        <?php
                                    }
                                    if($doc['doc_lang4'] != "" && $doc['doc_lang4'] != null && $doc['doc_lang4_arabic'] != "" && $doc['doc_lang4_arabic'] != null )
                                    {
                                        ?>
                                        <li><?= ($lang == "eng") ? $doc['doc_lang4'] : $doc['doc_lang4_arabic']; ?></li>
                                        <?php
                                    }
                                    if($doc['doc_lang5'] != "" && $doc['doc_lang5'] != null && $doc['doc_lang5_arabic'] != "" && $doc['doc_lang5_arabic'] != null )
                                    {
                                        ?>
                                        <li><?= ($lang == "eng") ? $doc['doc_lang5'] : $doc['doc_lang5_arabic']; ?></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="pract-loc" style="margin-bottom:20px">
                                <h3><?= ($lang == "eng") ? $lang_con[193]['lang_eng'] : $lang_con[193]['lang_arabic']; ?></h3>
                                <hr>
                                <div class="tg-tabwidet-content" style="padding-bottom:10px; padding-top:0px; padding-right:10px; padding-left:10px">
                                    <div class="tab-content">
                                        <div role="tg-tabpanel" class="tg-tab-pane tab-pane active" style="text-align:center">
                                            <?php
                                            $query = query("SELECT * FROM tbl_doc_awards WHERE doc_award_doc = $docID");
                                            while($award = fetch($query))
                                            {
                                                ?>
                                                <a href="<?= file_url().$award['doc_award_image'];?>" target="_blank">
                                                    <img src="<?= file_url().$award['doc_award_image'];?>" style="padding-top:10px">
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="appointmentDiv" id="intrestDiv4" style="margin:20px 0px 0px 0px;<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[181]['lang_eng'] : $lang_con[181]['lang_arabic']; ?></h4>
                                <hr>
                                <div class="owl-carousel owl-theme images-holder">
                				    <?php
                				    $sql = query("SELECT * FROM tbl_doctor_gallery WHERE doc_gall_docID = $docID");
                         		    while($dpt = fetch($sql))
                         		    {
                         		        ?>
                    					<div <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                    						<div class="img-holder">
                    						    <a href="<?= file_url().$dpt['doc_gall_img'];?>" rel="prettyPhoto[mobile-gallery]">
                    						        <img src="<?= file_url().$dpt['doc_gall_img'];?>"/>
                    						    </a>
                					        </div>
                    					</div>
                    					<?php
                			        }
                			        ?>
                				</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="appointmentDiv" id="intrestDiv5" style="margin:20px 0px 0px 0px;<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[182]['lang_eng'] : $lang_con[182]['lang_arabic']; ?></h4>
                                <hr>
                                <div class="owl-carousel owl-theme video-holder">
                				    <?php
                				    $sql = query("SELECT * FROM tbl_doc_video WHERE doc_video_doc = $docID");
                         		    while($dpt = fetch($sql))
                         		    {
                         		        ?>
                    					<a data-fancybox="gallery" href="https://www.youtube-nocookie.com/embed/<?= $dpt['doc_video_code'];?>?autoplay=1g">
                    						    <div class="img-holder">
                					                <img style="width:auto;height:auto" src="https://img.youtube.com/vi/<?= $dpt['doc_video_code'];?>/0.jpg">
                					            </div>
                                            </a>
                    					<?php
                			        }
                			        ?>
                				</div>
                            </div>
                        </div>
                        <div class="col-md-12">
            				<div class="pract-loc1" style="margin-bottom:12px">
            				    <h3><?= ($lang == "eng") ? $lang_con[190]['lang_eng'] : $lang_con[190]['lang_arabic']; ?></h3>
                                <hr>
                                <ul class="tg-doccontactinfo" style="padding-bottom:5px; ">
                                    <?php
                                    $query = query("SELECT * FROM tbl_doc_practice_loc pc JOIN tbl_country c ON (c.country_id = pc.loc_country) JOIN tbl_cities ci ON (ci.city_id = pc.loc_city) WHERE loc_doc_id = $docID");
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
                                    <?php 
                                    if($doc['doc_website_url'] != null && $doc['doc_website_url'] != ""){
                                    ?>
                                    <li class="list-item">
                                        <i class="fa fa-link"></i>
                                        <span><a style="font-size: 12px !important;" href="<?= $doc['doc_website_url'];?>" target="_blank"><?= $doc['doc_website_url'];?></a></span>
                                    </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
			</section>
            <section id="doctor-top" class="doctor-details-section">
                <div class="container p-0" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="doc-image">
                                <div class="doctor-photo">
                                    <img class="img-fluid" src="<?= file_url().$doc['doc_image'];?>" alt="doctor-profile">
                    			</div>
                    			<div class="tg-box" style="<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
    		                        <h1 class="title1"><?= ($lang == "eng") ? $doc['doc_name'] : $doc['doc_name_arabic'];?></h1>
    		                        <h2 class="title2"><?= ($lang == "eng") ? $doc['doc_degree'] : $doc['doc_degree_arabic'];?></h2>
    		                        <h3 class="title3"><?= ($lang == "eng") ? $doc['doc_speciality'] : $doc['doc_speciality_arabic'];?></h3>
    		   		                <h3 class="title4"><?= ($lang == "eng") ? $lang_con[111]['lang_eng'] : $lang_con[111]['lang_arabic']; ?>: <?= ($lang == "eng") ? $doc['doc_reg_no'] : $doc['doc_reg_no_arabic'];?></h3>
    		   	                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="doc-banner">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <?php
                                        $sql = query("SELECT * FROM tbl_doc_slider WHERE doc_slider_doc = $docID");
                                        $i=0;
                                        while($data = fetch($sql))
                                        {
                                            ?>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i; ?>" class="<?= ($i == 0) ? "active" : '' ;?>"></li>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </ol>
                                    <div class="carousel-inner">
                                        <?php
                                        $sql = query("SELECT * FROM tbl_doc_slider WHERE doc_slider_doc = $docID");
                                        $i=0;
                                        while($data = fetch($sql))
                                        {
                                            ?>
                                            <div class="carousel-item <?= ($i == 0 ) ? "active" : '' ;?>">
                                                <img class="d-block w-100 relate-img" src="<?= file_url().$data['doc_slider_image'];?>" alt="">
                                                <?php
                                                if($data['doc_slider_title'] != null && $data['doc_slider_title'] != "" )
                                                {
                                                    ?>
                                                    <div class="carousel-caption d-none d-md-block" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                                                        <h5><?= ($lang == "eng") ? $data['doc_slider_title'] : $data['doc_silder_title_ar'];?></h5>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="doctor-info mt-2 mb-2 p-1">
                		        <div style="text-align:center; padding:5px; margin-top:0px">
            	                    <a href="<?= $doc['doc_facebook_url'];?>" target="_blank"><img src="https://saudimedico.com/images/icons/facebook_new.png"></a>
        	                        <a href="<?= $doc['doc_twitter_url'];?>" target="_blank"><img src="https://saudimedico.com/images/icons/twitter_new.png"></a>
                                    <a href="<?= $doc['doc_linkedin_url'];?>" target="_blank"><img src="https://saudimedico.com/images/icons/linkedin_new.png"></a>
                                    <a href="<?= $doc['doc_youtube_url'];?>" target="_blank"><img src="https://saudimedico.com/images/icons/youtube.png"></a>
                                    <a href="<?= $doc['doc_instagram_url'];?>" target="_blank"><img src="https://saudimedico.com/images/icons/instagram.png"></a>
                                </div>
                                <div style="font-size:18px; text-align:center; padding:5px;">
                                    <i class="fa fa-star" style="color:#dddddd; margin-right:3px;"></i>
                                    <i class="fa fa-star" style="color:#dddddd; margin-right:3px;"></i>
                                    <i class="fa fa-star" style="color:#dddddd; margin-right:3px;"></i>
                                    <i class="fa fa-star" style="color:#dddddd; margin-right:3px;"></i>
                                    <i class="fa fa-star" style="color:#dddddd; margin-right:3px;"></i>
                                    <span style="font-size:18px; color:#148c82"> <?= $viewCount;?> / <?= ($lang == "eng") ? $lang_con[224]['lang_eng'] : $lang_con[224]['lang_arabic']; ?></span>
                                </div>
                                <div class="doctor-photo-btn text-center">
            						<a href="<?= base_url()."appointment";?>&dep=<?= $doc['doctor_department']; ?>&doc=<?= $doc['doc_id'];?>" class="btn btn-md btn-blue blue-hover"><?= ($lang == "eng") ? $lang_con[113]['lang_eng'] : $lang_con[113]['lang_arabic']; ?></a>
            					</div>
            				</div>
            				<div class="pract-loc1" style="margin-bottom:12px">
            				    <h3><?= ($lang == "eng") ? $lang_con[190]['lang_eng'] : $lang_con[190]['lang_arabic']; ?></h3>
                                <hr>
                                <ul class="tg-doccontactinfo" style="padding-bottom:5px; ">
                                    <?php
                                    $query = query("SELECT * FROM tbl_doc_practice_loc pc JOIN tbl_country c ON (c.country_id = pc.loc_country) JOIN tbl_cities ci ON (ci.city_id = pc.loc_city) WHERE loc_doc_id = $docID");
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
                                    <?php 
                                    if($doc['doc_website_url'] != null && $doc['doc_website_url'] != ""){
                                    ?>
                                    <li class="list-item">
                                        <i class="fa fa-link"></i>
                                        <span><a style="font-size: 12px !important;" href="<?= $doc['doc_website_url'];?>" target="_blank"><?= $doc['doc_website_url'];?></a></span>
                                    </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="pract-loc" style="margin-bottom:12px">
                                <h3><?= ($lang == "eng") ? $lang_con[191]['lang_eng'] : $lang_con[191]['lang_arabic']; ?></h3>
                                <hr>
                                <ul class="img-ul">
                                    <?php
                                    $query = query("SELECT * FROM tbl_doc_speciality ds JOIN tbl_specialty s ON (ds.doc_speciality = s.specialty_id) WHERE doc_spec_doc = $docID");
                                    while($spec = fetch($query))
                                    {
                                        ?>
                                        <li><img class="img-fluid" style="height:30px;" src="<?= file_url().$spec['speciality_icon']; ?>"><span><?= ($lang == "eng") ? $spec['specialty_name'] : $spec['specialty_ar_name']; ?></span></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="pract-loc" style="margin-bottom:12px">
                                <h3><?= ($lang == "eng") ? $lang_con[192]['lang_eng'] : $lang_con[192]['lang_arabic']; ?></h3>
                                <hr>
                                <ul>
                                    <?php
                                    $query = query("SELECT * FROM tbl_doc_services WHERE service_doc = $docID");
                                    while($service = fetch($query))
                                    {
                                        ?>
                                        <li><?= ($lang == "eng") ? $service['service_desc'] : $service['service_desc_ar']; ?><span style="float:right"><?= $service['service_amount'];?></span></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            
                            <div class="pract-loc" style="margin-bottom:12px">
                                <h3><?= ($lang == "eng") ? $lang_con[64]['lang_eng'] : $lang_con[64]['lang_arabic']; ?></h3>
                                <hr>
                                <ul>
                                    <?php
                                    if($doc['doc_lang1'] != "" && $doc['doc_lang1'] != null && $doc['doc_lang1_arabic'] != "" && $doc['doc_lang1_arabic'] != null )
                                    {
                                        ?>
                                        <li><?= ($lang == "eng") ? $doc['doc_lang1'] : $doc['doc_lang1_arabic']; ?></li>
                                        <?php
                                    }
                                    if($doc['doc_lang2'] != "" && $doc['doc_lang2'] != null && $doc['doc_lang2_arabic'] != "" && $doc['doc_lang2_arabic'] != null )
                                    {
                                        ?>
                                        <li><?= ($lang == "eng") ? $doc['doc_lang2'] : $doc['doc_lang2_arabic']; ?></li>
                                        <?php
                                    }
                                    if($doc['doc_lang3'] != "" && $doc['doc_lang3'] != null && $doc['doc_lang3_arabic'] != "" && $doc['doc_lang3_arabic'] != null )
                                    {
                                        ?>
                                        <li><?= ($lang == "eng") ? $doc['doc_lang3'] : $doc['doc_lang3_arabic']; ?></li>
                                        <?php
                                    }
                                    if($doc['doc_lang4'] != "" && $doc['doc_lang4'] != null && $doc['doc_lang4_arabic'] != "" && $doc['doc_lang4_arabic'] != null )
                                    {
                                        ?>
                                        <li><?= ($lang == "eng") ? $doc['doc_lang4'] : $doc['doc_lang4_arabic']; ?></li>
                                        <?php
                                    }
                                    if($doc['doc_lang5'] != "" && $doc['doc_lang5'] != null && $doc['doc_lang5_arabic'] != "" && $doc['doc_lang5_arabic'] != null )
                                    {
                                        ?>
                                        <li><?= ($lang == "eng") ? $doc['doc_lang5'] : $doc['doc_lang5_arabic']; ?></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="pract-loc" style="margin-bottom:20px">
                                <h3><?= ($lang == "eng") ? $lang_con[193]['lang_eng'] : $lang_con[193]['lang_arabic']; ?></h3>
                                <hr>
                                <div class="tg-tabwidet-content" style="padding-bottom:10px; padding-top:0px; padding-right:10px; padding-left:10px">
                                    <div class="tab-content">
                                        <div role="tg-tabpanel" class="tg-tab-pane tab-pane active" style="text-align:center">
                                            <?php
                                            $query = query("SELECT * FROM tbl_doc_awards WHERE doc_award_doc = $docID");
                                            while($award = fetch($query))
                                            {
                                                ?>
                                                <a href="<?= file_url().$award['doc_award_image'];?>" target="_blank">
                                                    <img src="<?= file_url().$award['doc_award_image'];?>" style="padding-top:10px">
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="intro-div">
                                <h4><?= ($lang == "eng") ? $lang_con[184]['lang_eng'] : $lang_con[184]['lang_arabic']; ?></h4>
                                <hr>
                                <div class="info">
                                    <?= ($lang == "eng") ? $doc['doc_intro'] : $doc['doc_intro_arabic']; ?>
                                </div>
                            </div>
                            <div class="appointmentDiv">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[150]['lang_eng'] : $lang_con[150]['lang_arabic']; ?></h4>
                                <hr>
                                <div class="row ">
                                    <div class="col-md-12">
                            			<div id="tabs-nav" class="list-group text-center">
                            			    <ul class="nav nav-pills" id="pills-tab" role="tablist" style="list-style:none !important;">
                            			        <?php
                            			        $i = 0;
                            			        $sql = query("SELECT * FROM tbl_doc_clinicalServices WHERE c_doc_id = $docID");
                            			        while($pkg = fetch($sql))
                            			        {
                            			            $i++;
                            			            ?>
                            			            <li class="nav-item icon-xs">
                                				    	<a class="nav-link <?= ($i == 1) ? 'active' : ''; ?>" id="tab1-list" data-toggle="pill" href="#tab-<?= $pkg['c_id']; ?>a" role="tab" aria-controls="tab-1" aria-selected="true">
                                				    		<?= ($lang == "eng") ? $pkg['c_name'] : $pkg['c_name_ar']; ?>
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
                        					$sql = query("SELECT * FROM tbl_doc_clinicalServices WHERE c_doc_id = $docID");
                        					while($pkg = fetch($sql))
                        					{
                        					    $i++;
                        					    ?>
                        					    <div class="tab-pane fade show <?= ($i == 1) ? 'active' : ''; ?>" id="tab-<?= $pkg['c_id']; ?>a"  role="tabpanel" aria-labelledby="tab1-list">
                            						<div class="row d-flex align-items-center">
                            							<div class="col-lg-5 col-md-5 col-12">
                            							    <?php
                            							    $ext = pathinfo($pkg['c_image'], PATHINFO_EXTENSION);
                            							    if($ext == "jpeg" || $ext == "jpg" || $ext == "png" || $ext == "gif" || $ext == "jfif")
                            							    {
                            							        ?>
                            							        <div class="tab-img">
                            									<img class="img-fluid" src="<?= file_url().$pkg['c_image'];?>" alt="tab-image" />
                            								</div>
                            							        <?php
                            							    }
                            							    else if($ext == "webm" || $ext == "mpg" || $ext == "mp2" || $ext == "mpeg" || $ext == "mpv" || $ext == "mp4" || $ext == "ogg")
                            							    {
                            							        ?>
                            							        <div class="tab-video">
                                									<video controls autoplay muted playsinline loop id="myvid">
                                                                        <source src="<?= file_url().$pkg['c_image'];?>" type="video/mp4">
                                                                    </video>
                                								</div>
                            							        <?php
                            							    }
                            							    ?>
                            								
                            							</div>
                            							<div class="col-lg-7 col-md-7 col-12" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                            								<div class="txt-block pc-30">
                            									<h3 class="h3-md steelblue-color <?= ($lang == "eng") ? 'left-after' : 'right-after' ;?>"><?= ($lang == "eng") ? $pkg['c_name'] : $pkg['c_name_ar']; ?></h3>
                            									<p class="mb-30"><?= ($lang == "eng") ? $pkg['c_desc'] : $pkg['c_desc_ar']; ?></p>
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
                            <div class="appointmentDiv" id="appointmentDiv" style="margin:20px 0px 0px 0px;<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[194]['lang_eng'] : $lang_con[194]['lang_arabic']; ?></h4>
                                <hr>
                                <ul>
                                <?php
                                $sql_app = query("SELECT * FROM tbl_doc_appoint a JOIN tbl_country co ON (a.app_hospCountry = co.country_id) JOIN tbl_cities ci on (a.app_hospCity = ci.city_id)  WHERE doc_appoint_doc = $docID");
                                while($app = fetch($sql_app))
                                {
                                    ?>
                                    <li>
                                        <div class="d-flex">
                                            <div class="img">
                                                <img class="img-fluid" style="height:50px; width:auto" src="<?= file_url().$app['app_hospLogo']?>">
                                            </div>
                                            <div class="text">
                                                <h5><?= ($lang == "eng") ? $app['doc_appoint_title'] : $app['doc_appoint_title_ar']; ?></h5>
                                                <h6><?= ($lang == "eng") ? $app['app_hospName'] : $app['app_hospName_ar']; ?></h6>
                                                <p><?= ($lang == "eng") ? date('Y', strtotime($app['app_hospStartDate'])) : date('Y', strtotime($app['app_hospStartDate'])); ?> - <?php 
                                                if($app['app_hospEndDate'] == "Present")
                                                {
                                                   ?>
                                                   <?= ($lang == "eng") ? $app['app_hospEndDate'] : $app['app_hospEndDate'];?>
                                                   <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <?= ($lang == "eng") ? date('Y', strtotime($app['app_hospEndDate'])) : date('Y', strtotime($app['app_hospEndDate'])); ?>
                                                   <?php
                                                }
                                                ?> </p>
                                                <p style="margin-top: -8px;"><?= ($lang == "eng") ? $app['city_name'] : $app['city_name_ar']; ?> , <?= ($lang == "eng") ? $app['country_name'] : $app['country_name_ar']; ?></p>
                                            </div>
                                        </div>
                                        
                                    </li>
                                    <?php
                                }
                                ?>
                                </ul>
                            </div>
                            
                            <div class="appointmentDiv" id="appointmentDiv" style="margin:20px 0px 0px 0px;<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[187]['lang_eng'] : $lang_con[187]['lang_arabic']; ?></h4>
                                <hr>
                                <ul>
                                <?php
                                $sql_app = query("SELECT * FROM tbl_prof_mem a JOIN tbl_country co ON (a.prof_country = co.country_id) JOIN tbl_cities ci on (a.prof_city = ci.city_id)  WHERE prof_doc = $docID");
                                while($app = fetch($sql_app))
                                {
                                    ?>
                                    <li>
                                        <div class="d-flex">
                                            <div class="img">
                                                <img class="img-fluid" style="height:50px; width:auto" src="<?= file_url().$app['prof_logo']?>">
                                            </div>
                                            <div class="text">
                                                <h5><?= ($lang == "eng") ? $app['prof_name'] : $app['prof_name_ar']; ?></h5>
                                                <h6><?= ($lang == "eng") ? $app['prof_bodyname'] : $app['prof_bodyname_ar']; ?></h6>
                                                <p><?= ($lang == "eng") ? date('Y', strtotime($app['prof_yearfrom'])) : changeNumberToArabic(date('Y', strtotime($app['prof_yearfrom']))) ; ?> - <?= ($lang == "eng") ? date('Y', strtotime($app['prof_yearto'])) : changeNumberToArabic(date('Y', strtotime($app['prof_yearto']))); ?></p>
                                                <p style="margin-top: -8px;"><?= ($lang == "eng") ? $app['city_name'] : $app['city_name_ar']; ?> , <?= ($lang == "eng") ? $app['country_name'] : $app['country_name_ar']; ?></p>
                                            </div>
                                        </div>
                                        
                                    </li>
                                    <?php
                                }
                                ?>
                                </ul>
                            </div>
                            
                            
                            <div class="appointmentDiv" id="appointmentDiv" style="margin:20px 0px 0px 0px;<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[195]['lang_eng'] : $lang_con[195]['lang_arabic']; ?></h4>
                                <hr>
                                <ul>
                                <?php
                                $sql_app = query("SELECT * FROM tbl_doc_education a JOIN tbl_country co ON (a.edu_country = co.country_id) JOIN tbl_cities ci on (a.edu_city = ci.city_id)  WHERE edu_doc = $docID");
                                while($app = fetch($sql_app))
                                {
                                    ?>
                                    <li>
                                        <div class="d-flex">
                                            <div class="img">
                                                <img class="img-fluid" style="height:50px; width:auto" src="<?= file_url().$app['edu_logo']?>">
                                            </div>
                                            <div class="text">
                                                <h5><?= ($lang == "eng") ? $app['edu_degree'] : $app['edu_degree_ar']; ?></h5>
                                                <h6><?= ($lang == "eng") ? $app['edu_institute'] : $app['edu_institute_ar']; ?></h6>
                                                <p><?= ($lang == "eng") ? date('Y', strtotime($app['edu_year'])) : changeNumberToArabic(date('Y', strtotime($app['edu_year']))); ?></p>
                                                <p style="margin-top: -8px;"><?= ($lang == "eng") ? $app['city_name'] : $app['city_name_ar']; ?> , <?= ($lang == "eng") ? $app['country_name'] : $app['country_name_ar']; ?></p>
                                            </div>
                                        </div>
                                        
                                    </li>
                                    <?php
                                }
                                ?>
                                </ul>
                            </div>
                            
                            <div class="appointmentDiv" id="intrestDiv4" style="margin:20px 0px 0px 0px;<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[181]['lang_eng'] : $lang_con[181]['lang_arabic']; ?></h4>
                                <hr>
                                <div class="owl-carousel owl-theme images-holder gallery clearfix">
                				    <?php
                				    $sql = query("SELECT * FROM tbl_doctor_gallery WHERE doc_gall_docID = $docID");
                         		    while($dpt = fetch($sql))
                         		    {
                         		        ?>
                    					<div <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                    						<div class="img-holder">
                    						    <a href="<?= file_url().$dpt['doc_gall_img'];?>" rel="prettyPhoto[photo-gall]">
                    						        <img src="<?= file_url().$dpt['doc_gall_img'];?>"/>
                    						    </a>
                					        </div>
                    					</div>
                    					<?php
                			        }
                			        ?>
                				</div>
                            </div>
                            <div class="appointmentDiv" id="intrestDiv5" style="margin:20px 0px 0px 0px;<?= ($lang == "eng") ? '' : 'direction:rtl !important;text-align:right' ;?>">
                                <h4 style="color:#124c82;font-weight:100 !important"><?= ($lang == "eng") ? $lang_con[182]['lang_eng'] : $lang_con[182]['lang_arabic']; ?></h4>
                                <hr>
                                <div class="owl-carousel owl-theme video-holder">
                				    <?php
                				    $sql = query("SELECT * FROM tbl_doc_video WHERE doc_video_doc = $docID");
                         		    while($dpt = fetch($sql))
                         		    {
                         		        ?>
                    					<div <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                    						
                    						<a data-fancybox="gallery" href="https://www.youtube-nocookie.com/embed/<?= $dpt['doc_video_code'];?>?autoplay=1g">
                    						    <div class="img-holder">
                					                <img style="width:auto;height:auto" src="https://img.youtube.com/vi/<?= $dpt['doc_video_code'];?>/0.jpg">
                					            </div>
                                            </a>
                    					</div>
                    					<?php
                			        }
                			        ?>
                				</div>
                            </div>
                            
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button style="width:100%" class="btn btn-link d-flex justify-content-between" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <span><?= ($lang == "eng") ? $lang_con[189]['lang_eng'] : $lang_con[189]['lang_arabic']; ?> <?= ($lang == "eng") ? $doc['doc_name'] : $doc['doc_name_arabic'];?></span>
                                            <i class="fa fa-plus"></i>
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="doctor-bio">
                         					<?= ($lang == "eng") ? htmlspecialchars_decode(html_entity_decode($doc['doc_details'])) : htmlspecialchars_decode(html_entity_decode($doc['doc_details_arabic'])); ?>
                        				</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="reviews-2" class="bordered reviews-section division  mobile-hide">
            	<div class="container">
            		<div class="row">	
            			<div class="col-lg-10 offset-lg-1 section-title">
            				<h3 class="h3-md steelblue-color"><?= ($lang == "eng") ? $lang_con[11]['lang_eng'] : $lang_con[11]['lang_arabic']; ?></h3>
            				<p><?= ($lang == "eng") ? $lang_con[84]['lang_eng'] : $lang_con[84]['lang_arabic']; ?></p>
            			</div> 
            		</div>
            		<style>
            		    #reviews-2 .testimonial-avatar img{
        		            width: 120px;
                            height: 120px;
                            margin: 0 0 5px 0;
            		    }
            		</style>
            		<div class="row">
            			<div class="col-md-12">					
            				<div class="owl-carousel owl-theme reviews-holder">
            				    <?php
            				    $rSql = query("SELECT * FROM tbl_doc_testimonial where testimonial_doc = $docID");
            				    while($rData = fetch($rSql))
            				    {
            				        ?>
            					    <div class="review-2">
                						<div class="review-txt text-center">
                							
                							<div class="testimonial-avatar">
                								<img src="<?= file_url().$rData['testimonial_image'];?>" alt="testimonial-avatar">
                							</div>
                							<p>
                							    <?= ($lang == "eng") ? $rData['testimonial_desc'] : $rData['testimonial_desc_arabic']; ?>
                							</p>
                							<div class="review-author">
                								<h5 class="h5-sm"><?= ($lang == "eng") ? $rData['testimonial_username'] : $rData['testimonial_username_ar'];?></h5>
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
            </section>
            <section id="services-3" class="bordered services-section division mobile-hide">
            	<div class="container">
            		<div class="row">	
            			<div class="col-lg-10 offset-lg-1 section-title">
            				<h3 class="h3-md steelblue-color"><?= ($lang == "eng") ? $lang_con[135]['lang_eng'] : $lang_con[135]['lang_arabic']; ?></h3>
            				
            				<p><?= ($lang == "eng") ? $lang_con[136]['lang_eng'] : $lang_con[136]['lang_arabic']; ?></p>
            			</div> 
            		</div>
            		<style>
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
                        .intro-div * {
                            width: 100% !important;
                        }
            		</style>
            		<div class="row">
            			<div class="col-md-12">					
            				<div class="owl-carousel owl-theme certificate-holder">
            				    <?php
            				    $sql = query("SELECT * FROM tbl_certificate WHERE certificate_active = 1 ORDER BY certificate_id DESC");
                     		    while($dpt = fetch($sql))
                     		    {
                     		        ?>
                					<div class="icon-sm" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                						<div class="img-holder1">
            					            <img class="img-fluid" src="<?= file_url().$dpt['cetificate_image'];?>" alt="content-image" />	
            					        </div>
            					        <!--<h5 class="h5-xs steelblue-color"><a href="javascript.void();"><?= ($lang == "eng") ? $dpt['certificate_title'] : $dpt['certificate_title_arabic']; ?></a></h5>-->
                					</div>
                					<?php
            			        }
            			        ?>
            				</div>
            			</div>									
            		</div>
            	</div>
            </section>
            <?php
            include 'footer.php';
            ?>
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
            		<?= ($lang == "eng") ? '' : 'rtl:true,'; ?>
            		loop:true,
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
            				items:5
            			},
            			991:{
            				items:6
            			},
            			1000:{
            				items:6
            			}
            		}
            	});
            	
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
            </script>
            <?php
        }
        else
        {
            include 'simple-doc-header.php';
            ?>
            <style>
                #doctor-breadcrumbs{
                    background-image : url('<?= base_url().$doc['doc_banner']?>');
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
             					<img class="img-fluid" src="<?= file_url().$doc['doc_image'];?>" alt="doctor-profile">
             					<div class="doctor-info">
            						<table class="table table-striped">
            							<tbody>
            							    <tr>
            							        <td colspan="2" class="text-center">
            							            <h5 class="h2-xs text-center"><?= ($lang == "eng") ? $doc['doc_name'] : $doc['doc_name_arabic'];?></h5>
            							            <p><?= ($lang == "eng") ? $doc['doc_degree'] : $doc['doc_degree_arabic'];?></p>
            							            <p><?= ($lang == "eng") ? $doc['doc_speciality'] : $doc['doc_speciality_arabic'];?></p>
            							        </td>
            							    </tr>
            							    <tr>
            							        <td><?= ($lang == "eng") ? $lang_con[111]['lang_eng'] : $lang_con[111]['lang_arabic']; ?>: </td>
            							        <td><p><?= ($lang == "eng") ? $doc['doc_reg_no'] : $doc['doc_reg_no_arabic'];?></p></td>
            							    </tr>
            							    <tr>
            							      	<td><?= ($lang == "eng") ? $lang_con[80]['lang_eng'] : $lang_con[80]['lang_arabic']; ?></td>
            							      	<td>
            							      	    <?php
            							      	    $experties = $doc['doc_area_of_experty'];
            							      	    if($lang != "eng")
            							      	    {
            							      	        $experties = $doc['doc_area_of_experty_arabic'];
            							      	    }
            							      	    $arr = explode(",", $experties);
            							      	    foreach($arr as $val)
            							      	    {
            							      	        ?>
            							      	        <span><i class="fas fa-angle-double-right"></i><?= $val; ?></span>
            							      	        <?php
            							      	    }
            							      	    ?>
            							      	</td>
            							   	</tr>
            							   	<tr>
            							      	<td><?= ($lang == "eng") ? $lang_con[112]['lang_eng'] : $lang_con[112]['lang_arabic']; ?></td>
            							      	<td>
            							      	    <?php
            							      	    if($doc['doc_lang1'] != '' && $doc['doc_lang1'] != '')
            							      	    {
            							      	        if($lang == "eng")
            							      	        {
            							      	            echo $doc['doc_lang1'] . ",";
            							      	        }
            							      	        else
            							      	        {
            							      	            echo $doc['doc_lang1_arabic'] . ",";
            							      	        }
            							      	    }
            							      	    
            							      	    if($doc['doc_lang2'] != '' && $doc['doc_lang2'] != '')
            							      	    {
            							      	        if($lang == "eng")
            							      	        {
            							      	            echo $doc['doc_lang2'] . ",";
            							      	        }
            							      	        else
            							      	        {
            							      	            echo $doc['doc_lang2_arabic'] . ",";
            							      	        }
            							      	    }
            							      	    if($doc['doc_lang3'] != '' && $doc['doc_lang3'] != '')
            							      	    {
            							      	        if($lang == "eng")
            							      	        {
            							      	            echo $doc['doc_lang3'] . ",";
            							      	        }
            							      	        else
            							      	        {
            							      	            echo $doc['doc_lang3_arabic'] . ",";
            							      	        }
            							      	    }
            							      	    if($doc['doc_lang4'] != '' && $doc['doc_lang4'] != '')
            							      	    {
            							      	        if($lang == "eng")
            							      	        {
            							      	            echo $doc['doc_lang4'] . ",";
            							      	        }
            							      	        else
            							      	        {
            							      	            echo $doc['doc_lang4_arabic'] . ",";
            							      	        }
            							      	    }
            							      	    if($doc['doc_lang5'] != '' && $doc['doc_lang5'] != '')
            							      	    {
            							      	        if($lang == "eng")
            							      	        {
            							      	            echo $doc['doc_lang5'] . ",";
            							      	        }
            							      	        else
            							      	        {
            							      	            echo $doc['doc_lang5_arabic'] . ",";
            							      	        }
            							      	    }
            							      	    ?>
                                                </td>
            							   	</tr>
            							</tbody>
            						</table>
            					</div>
            					<div class="doctor-photo-btn text-center">
            						<a href="<?= base_url()."appointment";?>&dep=<?= $doc['doctor_department']; ?>&doc=<?= $doc['doc_id'];?>" class="btn btn-md btn-blue blue-hover"><?= ($lang == "eng") ? $lang_con[113]['lang_eng'] : $lang_con[113]['lang_arabic']; ?></a>
            					</div>
             				</div>
             			</div>
            			<div class="col-md-7">
            				<div class="doctor-bio">
             					<?= ($lang == "eng") ? htmlspecialchars_decode(html_entity_decode($doc['doc_details'])) : htmlspecialchars_decode(html_entity_decode($doc['doc_details_arabic'])); ?>
            				</div>
            			</div>
            		</div>
            	</div>
            </section>
            <section id="reviews-2" class="bg-lightgrey wide-100 reviews-section division">
            	<div class="container">
            		<div class="row">	
            			<div class="col-lg-10 offset-lg-1 section-title">
            				<h3 class="h3-md steelblue-color"><?= ($lang == "eng") ? $lang_con[11]['lang_eng'] : $lang_con[11]['lang_arabic']; ?></h3>
            				<p><?= ($lang == "eng") ? $lang_con[84]['lang_eng'] : $lang_con[84]['lang_arabic']; ?></p>
            			</div> 
            		</div>
            		<style>
            		    #reviews-2 .testimonial-avatar img{
        		            width: 120px;
                            height: 120px;
                            margin: 0 0 5px 0;
            		    }
            		</style>
            		<div class="row">
            			<div class="col-md-12">					
            				<div class="owl-carousel owl-theme reviews-holder">
            				    <?php
            				    $rSql = query("SELECT * FROM tbl_doc_testimonial where testimonial_doc = $docID");
            				    while($rData = fetch($rSql))
            				    {
            				        ?>
            					    <div class="review-2">
                						<div class="review-txt text-center">
                							
                							<div class="testimonial-avatar">
                								<img src="<?= file_url().$rData['testimonial_image'];?>" alt="testimonial-avatar">
                							</div>
                							<p>
                							    <?= ($lang == "eng") ? substr($rData['testimonial_desc'],0,80)."..." : substr($rData['testimonial_desc_arabic'],0,80)."..."; ?>
                							</p>
                							<div class="review-author">
                								<h5 class="h5-sm"><?= ($lang == "eng") ? $rData['testimonial_username'] : $rData['testimonial_username_ar']; ?></h5>
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