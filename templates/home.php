<?php
include 'header.php';
$sql        = query("SELECT COUNT(slider_id) as count FROM tbl_slider WHERE slider_is_video = 1 AND slider_active = 1 ");
$is_video   = fetch($sql)['count'];
if($is_video > 0)
{
    $sql = query("SELECT * FROM tbl_slider WHERE slider_video_show = 1 AND slider_active = 1");
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
                <video controls playsinline loop id="myvid">
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
        	    $sql = query("SELECT * FROM tbl_slider WHERE slider_is_video = 0 AND slider_active = 1 ");
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
<style>
    .hero-section iframe{
        width:100%;
        height:500px;
    }
    .hero-section video{
        width:100%;
        height:auto;
    }
    @media (max-width: 768px)
    { 
        .hero-section iframe{
            width:100%;
            height:300px;
        }
        .hero-section video{
            width:100%;
            height:auto;
        }
    }
    @media (max-width: 575px){
        #tabs-1 .nav-item, #tabs-2 .nav-item {
            display: inline-block;
            width: auto;
        }
        .nav-pills .nav-link {
            font-size: 11px;
            padding: 10px 10px;
            display: inline-block;
        }
    }
    #reviews-2 .testimonial-avatar img{
        width: 120px;
        height: 120px;
        margin: 0 0 5px 0;
    }
</style>
<!-- ABOUT-6
============================================= -->
<section id="about-6" class="pt-100 about-section division">
	<div class="container" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
		<div class="row d-flex align-items-center reverse">
			<div class="col-lg-6" >
				<div class="txt-block pc-30 wow fadeInUp" data-wow-delay="0.4s">
		 			<span class="section-id blue-color"><?= ($lang == "eng") ? $lang_con[9]['lang_eng'] : $lang_con[9]['lang_arabic']; ?></span>
					<h3 class="h3-md steelblue-color left-after"><?= ($lang == "eng") ? $siteData['welcome_heading'] : $siteData['welcome_heading_arabic']; ?></h3>
					<p><?= ($lang == "eng") ? $siteData['site_welcome_text'] : $siteData['site_welcome_text_arabic']; ?></p>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="about-img text-center wow fadeInUp" data-wow-delay="0.6s">
					<img class="img-fluid" src="<?= file_url().$siteData['site_welcome_image'];?>" alt="about-image">
				</div>
			</div>
		</div>
	</div>
</section>
<style>
    .advertiement-div{
        margin-top:15px;
        padding: 20px 20px;
        height: 230px;
        background-color: #e0e0e0;
        position:relative;
    }
    .add-img-holder {
        height: 198px;
        margin: auto;
        text-align:center;
    }
    .add-img-holder img {
        height: 190px;
        object-fit: contain;
        margin: auto;
    }
    .close-add-holder{
        top:0px;
        width: 98.4%;
        display: flex;
        position:absolute;
        justify-content: space-between;
    }
    .close-add-holder span{
        color:#c3c3c3;
    }
    .close-add-holder .close-button {
        background: none;
        border: none;
    }
    .doctor-2{
        border: none !important;
    }
    .doctor-2 .img-holder{
        padding-top: 109%;
    }
</style>
<section class="about-section division" id="add-1">
    <div class="container p-0">
        <div class="col-md-12 p-0">
            <div class="advertiement-div">
                <div class="close-add-holder">
                    <span>Addvertisement</span>
                    <button class="close-button" data-add-id="add-1"><i class="fa fa-times"></i></button>
                </div>
                <div class="owl-carousel owl-theme advertisement-holder">
				    <?php
				    $sql = query("SELECT * FROM tbl_advertisment WHERE add_location = 'Landing Pages' AND add_status = 1 ORDER BY rand()");
         		    while($add = fetch($sql))
         		    {
         		        ?>
    					<div class="add-img-holder" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
					        <img class="img-fluid" src="<?= ($lang == "eng") ? file_url().$add['add_image'] : file_url().$add['add_image_ar'];?>" alt="content-image" />
    					</div>
    					<?php
			        }
			        ?>
				</div>
            </div>
            <!--</div>-->
        </div>
    </div>
</section>

<section id="services-3" class="bg-lightgrey wide-100 services-section division">
	<div class="container">
		<div class="row">	
			<div class="col-lg-10 offset-lg-1 section-title">
				<h3 class="h3-md steelblue-color"><?= ($lang == "eng") ? $lang_con[10]['lang_eng'] : $lang_con[10]['lang_arabic']; ?></h3>
				
				<p><?= ($lang == "eng") ? $lang_con[83]['lang_eng'] : $lang_con[83]['lang_arabic']; ?></p>
			</div> 
		</div>
		<div class="row">
			<div class="col-md-12">					
				<div class="owl-carousel owl-theme services-holder">
				    <?php
				    $sql = query("SELECT * FROM tbl_department WHERE dpt_active = 1 ORDER BY dpt_id DESC");
         		    while($dpt = fetch($sql))
         		    {
         		        ?>
    					<div class="sbox-3 icon-sm" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
    						<div class="img-holder">
					            <img class="img-fluid" src="<?= file_url().$dpt['dpt_icon_name'];?>" alt="content-image" />	
					        </div>
    						<h5 class="h5-xs steelblue-color"><a href="<?= base_url().$dpt['dpt_slug'];?>"><?= ($lang == "eng") ? $dpt['dpt_name'] : $dpt['dpt_name_arabic']; ?></a></h5>
                            <!--<p style="overflow:hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;"><?= ($lang == "eng") ? $dpt['dpt_short_desc'] : $dpt['dpt_short_desc_arabic'] ; ?></p>-->
    					</div>
    					<?php
			        }
			        ?>
				</div>
			</div>									
		</div>
	</div>
</section>
<section id="services-3" class="bg-lightgrey wide-100 services-section division">
    <div class="container">
        <div class="row">   
            <div class="col-lg-10 offset-lg-1">
                <h3 class="h3-md steelblue-color text-center"><?= ($lang == "eng") ? $lang_con[227]['lang_eng'] : $lang_con[227]['lang_arabic']; ?></h3>
            </div> 
        </div>
        <div class="row">
            <div class="col-md-12">                 
                <div class="owl-carousel owl-theme feature-doctor-holder">
                    <?php
                    $currentDate = date('Y-m-d');
                    $sql = query("SELECT * FROM tbl_feature_doctor f JOIN  tbl_doctor d ON (f.f_doctor_id = d.doc_id) WHERE f_home = 'yes' AND  f_home_end >= '$currentDate' AND f_active = 1");
                    while($doc = fetch($sql))
                    {
                        ?>
                        <div class="sbox-3 " <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                            <div class="doctor-2">
                                <div class="hover-overlay img-holder"> 
                                    <img class="img-fluid" src="<?= file_url().$doc['doc_image'];?>" alt="doctor-foto"> 
                                </div>
                                <div class="doctor-meta">
                                    <h5 class="h5-xs blue-color"><?= ($lang == "eng") ? $doc['doc_name'] : $doc['doc_name_arabic']; ?></h5>
                                    <span><?= ($lang == "eng") ? $doc['doc_job_title'] : $doc['doc_job_title_arabic']; ?></span>
                                    <a class="btn btn-sm btn-blue blue-hover mt-15" href="<?= base_url().$doc['doc_slug'];?>" title=""><?= ($lang == "eng") ? $lang_con[90]['lang_eng'] : $lang_con[90]['lang_arabic']; ?></a>
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

<!-- TABS-1
============================================= -->
<div class="container p-0">	
    <section id="tabs-1" class="tabs-section division">
            <div class="row">	
    			<div class="col-lg-10 offset-lg-1 section-title">
    				<h3 class="h3-md steelblue-color"><?= ($lang == "eng") ? $lang_con[119]['lang_eng'] : $lang_con[119]['lang_arabic']; ?></h3>
    			</div> 
    		</div>
            <div class="row">
                <div class="col-md-12">
        			<div id="tabs-nav" class="list-group text-center">
        			    <ul class="nav nav-pills" id="pills-tab" role="tablist">
        			        <?php
        			        $i = 0;
        			        $sql = query("SELECT * FROM tbl_packages WHERE pkg_active = 1");
        			        while($pkg = fetch($sql))
        			        {
        			            $i++;
        			            ?>
        			            <li class="nav-item icon-xs">
            				    	<a class="nav-link <?= ($i == 1) ? 'active' : ''; ?>" id="tab1-list" data-toggle="pill" href="#tab-<?= $pkg['pkg_id']; ?>" role="tab" aria-controls="tab-1" aria-selected="true">
            				    		<?= ($lang == "eng") ? $pkg['pkg_name'] : $pkg['pkg_name_arabic']; ?>
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
    					$sql = query("SELECT * FROM tbl_packages WHERE pkg_active = 1");
    					while($pkg = fetch($sql))
    					{
    					    $i++;
    					    ?>
    					    <div class="tab-pane fade show <?= ($i == 1) ? 'active' : ''; ?>" id="tab-<?= $pkg['pkg_id']; ?>"  role="tabpanel" aria-labelledby="tab1-list">
        						<div class="row d-flex align-items-center">
        							<div class="col-lg-6">
        								<div class="tab-img">
        									<img class="img-fluid" src="<?= file_url().$pkg['pkg_image'];?>" alt="tab-image" />
        								</div>
        							</div>
        							<div class="col-lg-6" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
        								<div class="txt-block pc-30">
        									<h3 class="h3-md steelblue-color <?= ($lang == "eng") ? 'left-after' : 'right-after' ;?>"><?= ($lang == "eng") ? $pkg['pkg_name'] : $pkg['pkg_name_arabic']; ?></h3>
        									<p class="mb-30"><?= ($lang == "eng") ? $pkg['pkg_description'] : $pkg['pkg_description_arabic']; ?></p>
        									<div class="row">
        										<div class="col-xl-6">
        											<div class="box-list" >	
        											    <div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
        												<p class="p-sm"><?= ($lang == "eng") ? $pkg['pkg_highlight_one'] : $pkg['pkg_highlight_one_arabic']; ?></p>
        											</div>
        											<div class="box-list" >	
        												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
        												<p class="p-sm"><?= ($lang == "eng") ? $pkg['pkg_highlight_two'] : $pkg['pkg_highlight_two_arabic']; ?></p>				
        											</div>
        											<div class="box-list" >	
        												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
        												<p class="p-sm"><?= ($lang == "eng") ? $pkg['pkg_highlight_three'] : $pkg['pkg_highlight_three_arabic']; ?></p>				
        											</div>
        											<div class="box-list" >	
        												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
        												<p class="p-sm"><?= ($lang == "eng") ? $pkg['pkg_highlight_four'] : $pkg['pkg_highlight_four_arabic']; ?></p>
        											</div>
        										</div>
        										<div class="col-xl-6">
        											<div class="box-list" >
        												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
        												<p class="p-sm"><?= ($lang == "eng") ? $pkg['pkg_highlight_five'] : $pkg['pkg_highlight_five_arabic']; ?></p>							
        											</div>
        											<div class="box-list" >	
        												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
        												<p class="p-sm"><?= ($lang == "eng") ? $pkg['pkg_highlight_six'] : $pkg['pkg_highlight_six_arabic']; ?></p>				
        											</div>
        											<div class="box-list" >	
        												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
        												<p class="p-sm"><?= ($lang == "eng") ? $pkg['pkg_highlight_seven'] : $pkg['pkg_highlight_seven_arabic']; ?></p>
        											</div>
        											<div class="box-list" >	
        												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
        												<p class="p-sm"><?= ($lang == "eng") ? $pkg['pkg_highlight_eight'] : $pkg['pkg_highlight_eight_arabic']; ?></p>
        											</div>
        										</div>
        									</div>
        									<!--<a href="#" class="btn btn-blue blue-hover mt-30">View More Details</a>-->
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
    </section>
</div>
<section class="about-section division" id="add-2">
    <div class="container p-0">
        <div class="col-md-12 p-0">
            <div class="advertiement-div">
                <div class="close-add-holder">
                    <span>Addvertisement</span>
                    <button class="close-button" data-add-id="add-2"><i class="fa fa-times"></i></button>
                </div>
                <div class="owl-carousel owl-theme advertisement-holder">
				    <?php
				    $sql = query("SELECT * FROM tbl_advertisment WHERE add_location = 'Landing Pages' AND add_status = 1 ORDER BY rand()");
         		    while($add = fetch($sql))
         		    {
         		        ?>
    					<div class="add-img-holder" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
					        <img class="img-fluid" src="<?= ($lang == "eng") ? file_url().$add['add_image'] : file_url().$add['add_image_ar'];?>" alt="content-image" />
    					</div>
    					<?php
			        }
			        ?>
				</div>
            </div>
            <!--</div>-->
        </div>
    </div>
</section>
<section id="services-3" class="bg-lightgrey wide-100 services-section division">
    <div class="container">
        <div class="row">   
            <div class="col-lg-10 offset-lg-1">
                <h3 class="h3-md steelblue-color text-center"><?= ($lang == "eng") ? $lang_con[227]['lang_eng'] : $lang_con[227]['lang_arabic']; ?></h3>
            </div> 
        </div>
        <div class="row">
            <div class="col-md-12">                 
                <div class="owl-carousel owl-theme feature-doctor-holder">
                    <?php
                    $currentDate = date('Y-m-d');
                    $sql = query("SELECT * FROM tbl_feature_clinic f JOIN  tbl_clinic d ON (f.f_clinic_id = d.clinic_id) WHERE f_home = 'yes' AND  f_home_end >= '$currentDate' AND f_active = 1");
                    while($doc = fetch($sql))
                    {
                        ?>
                        <div class="sbox-3 " <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                            <div class="doctor-2">
                                <div class="hover-overlay img-holder"> 
                                    <img class="img-fluid" src="<?= file_url().$doc['clinic_icon'];?>" alt="doctor-foto">   
                                </div>
                                <div class="doctor-meta">
                                    <h5 class="h5-xs blue-color"><?= ($lang == "eng") ? $doc['clinic_name'] : $doc['clinic_name_ar']; ?></h5>
                                    <span><?= ($lang == "eng") ? $doc['clinic_phone'] : $doc['clinic_phone_ar']; ?></span>
                                    <a class="btn btn-sm btn-blue blue-hover mt-15" href="<?= base_url().$doc['clinic_slug'];?>" title=""><?= ($lang == "eng") ? $lang_con[90]['lang_eng'] : $lang_con[90]['lang_arabic']; ?></a>
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
<section id="reviews-2" class="bordered reviews-section division">
	<div class="container">
		<div class="row">	
			<div class="col-lg-10 offset-lg-1 section-title">
				<h3 class="h3-md steelblue-color"><?= ($lang == "eng") ? $lang_con[11]['lang_eng'] : $lang_con[11]['lang_arabic']; ?></h3>
				<p><?= ($lang == "eng") ? $lang_con[84]['lang_eng'] : $lang_con[84]['lang_arabic']; ?></p>
			</div> 
		</div>
		<div class="row">
			<div class="col-md-12">					
				<div class="owl-carousel owl-theme reviews-holder">
				    <?php
				    $rSql = query("SELECT * FROM tbl_testimonial t JOIN tbl_users u ON (u.user_id = t.testimonial_user)");
				    while($rData = fetch($rSql))
				    {
				        ?>
					    <div class="review-2">
    						<div class="review-txt text-center">
    							<div class="testimonial-avatar">
    								<img src="<?= file_url().$rData['user_image'];?>" alt="testimonial-avatar">
    							</div>
    							<p>
    							    <?= ($lang == "eng") ? $rData['testimonial_desc'] : $rData['testimonial_desc_arabic']; ?>
    							</p>
    							<div class="review-author">
    								<h5 class="h5-sm"><?= ($lang == "eng") ? $rData['user_name'] : $rData['user_name_arabic'];?></h5>
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
<section class="about-section division" id="add-3">
    <div class="container p-0">
        <div class="col-md-12 p-0">
            <div class="advertiement-div">
                <div class="close-add-holder">
                    <span>Addvertisement</span>
                    <button class="close-button" data-add-id="add-3"><i class="fa fa-times"></i></button>
                </div>
                <div class="owl-carousel owl-theme advertisement-holder">
                    <?php
                    $sql = query("SELECT * FROM tbl_advertisment WHERE add_location = 'Landing Pages' AND add_status = 1 ORDER BY rand()");
                    while($add = fetch($sql))
                    {
                        ?>
                        <div class="add-img-holder" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                            <img class="img-fluid" src="<?= ($lang == "eng") ? file_url().$add['add_image'] : file_url().$add['add_image_ar'];?>" alt="content-image" />
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!--</div>-->
        </div>
    </div>
</section>
<section id="services-3" class="bordered services-section division">
	<div class="container">
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
</section>

<section id="blog-1" class="bordered blog-section division">				
    <div class="container">
        <div class="row">	
            <div class="col-lg-10 offset-lg-1 section-title">
                <h3 class="h3-md steelblue-color"><?= ($lang == "eng") ? $lang_con[12]['lang_eng'] : $lang_con[12]['lang_arabic']; ?></h3>
                <p><?= ($lang == "eng") ? $lang_con[85]['lang_eng'] : $lang_con[85]['lang_arabic']; ?></p>
            </div>
        </div>
		<div class="row">
		    <?php
		    $sql = query("SELECT * FROM tbl_news n JOIN tbl_department d ON (d.dpt_id = n.news_category) WHERE n.news_active = 1 limit 3");
		    while($blog = fetch($sql))
		    {
		        ?>
		        <div class="col-lg-4" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
    	 			<div class="blog-post wow fadeInUp" data-wow-delay="0.4s">
    		 			<div class="blog-post-img img-holder">
    						<img class="img-fluid" src="<?= file_url().$blog['news_image'];?>" alt="blog-post-image" />	
    					</div>
    					<div class="blog-post-txt">
    						<h5 class="h5-sm steelblue-color"><a href="<?= base_url();?><?= $blog['news_slug']; ?>"><?= ($lang == "eng") ? $blog['news_title'] : $blog['news_title_arabic']; ?></a></h5>
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
<section id="services-3" class="bg-lightgrey wide-100 services-section division">
	<div class="container">
		<div class="row">	
			<div class="col-lg-10 offset-lg-1 section-title">
				<h3 class="h3-md steelblue-color"><?= ($lang == "eng") ? $lang_con[138]['lang_eng'] : $lang_con[138]['lang_arabic']; ?></h3>
				
				<p><?= ($lang == "eng") ? $lang_con[139]['lang_eng'] : $lang_con[139]['lang_arabic']; ?></p>
			</div> 
		</div>
		<div class="row">
			<div class="col-md-12">					
				<div class="owl-carousel owl-theme insurance-holder">
				    <?php
				    $sql = query("SELECT * FROM tbl_insurance WHERE insurance_active = 1 ORDER BY insurance_id DESC");
         		    while($dpt = fetch($sql))
         		    {
         		        ?>
    					<div class="icon-sm" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
    						<div class="img-holder">
					            <img class="img-fluid" src="<?= file_url().$dpt['insurance_image'];?>" alt="content-image" />	
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
include 'footer.php'
?>
<script>
    var owl = $('.certificate-holder');
	owl.owlCarousel({
		items: 6,
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
	var owl = $('.insurance-holder');
	owl.owlCarousel({
		items: 5,
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
				items:3
			},
			768:{
				items:4
			},
			991:{
				items:5
			},
			1000:{
				items:5
			}
		}
	});
	
	var owlAdd = $('.advertisement-holder');
	owlAdd.owlCarousel({
		items: 1,
		loop:true,
		autoplay:true,
        nav:false,
        dots:false,
		animateOut: 'fadeOut',
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
				items:1
			},
			991:{
				items:1
			},
			1000:{
				items:1
			}
		}
	});

    var owlAdd = $('.feature-doctor-holder');
    owlAdd.owlCarousel({
        items: 1,
        autoplay:true,
        nav:false,
        dots:false,
        animateOut: 'fadeOut',
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

    
	$(document).ready(function(){
	    $(".close-button").click(function(e){
	        e.preventDefault();
	        var addID = $(this).attr('data-add-id');
	        $("#"+addID).hide();
	    });
	});
</script>