<?php
if(isset($_GET['slug']) && $_GET['slug'] != "" && $_GET['slug'] != null)
{
    $slug = $_GET['slug'];
    $sql = query("SELECT * FROM tbl_department WHERE dpt_active = 1 AND dpt_slug = '$slug'");
    if(nrows($sql) > 0)
    {
        $dpt = fetch($sql);
        $meta_title         = $dpt['dpt_meta_title'];
        $meta_title_ar      = $dpt['dpt_meta_title_ar'];
        $meta_keyword       = $dpt['dpt_meta_tag'];
        $meta_keyword_ar    = $dpt['dpt_meta_tag_ar'];
        $meta_desc          = $dpt['dpt_meta_desc'];
        $meta_desc_ar       = $dpt['dpt_meta_desc_ar'];
        include 'header.php';
        ?>
        <style>
            .wide-60 {
                padding-top: 0px !important;
            }
            .text-detail
            {
                padding: 15px;
                background: #fff;
                border-radius: 12px;
                margin-bottom:30px;
            }
            .right-bar
            {
                background: #fff;
                padding: 15px;
                border-radius: 12px;
            }
            
            .side-bar-toggler {
                display: inline-flex;
                align-items:center;
                justify-content:space-between;
                width: 100%;
                padding: 8px 15px;
                background-color: #fff;
                font-weight: 400;
                font-size: 14px;
                box-shadow: 0px 1px 3px 0px rgba(0,0,0,0.3);
                border-radius: 5px;
                margin-bottom:10px;
                transition:.1s linear;
            }
            @media(min-width:992px)
            {
                .side-bar-toggler 
                {
                    display:none !important;
                }
            }
            
            @media (min-width: 1000px) and (max-width: 1205px) {
            	.depart-list {
                    width: 17vw !important;
                }
            }
            
            .side-bar-toggler:hover {
                background-color: #00a3c8;
                color: #fff!important;
            }
            .side-bar 
            {
                box-shadow: 0px 1px 3px 0px rgba(0,0,0,0.3);
                /*border-radius: 10px;*/
                overflow: hidden;
                /*margin-bottom:30px;*/
            }
            .side-bar ul{
                height: 400px;
                overflow: auto;
            }
            .side-bar ul::-webkit-scrollbar{
                width: 12px;
                background-color: #eeeeee;
                position: absolute;
            }
            .side-bar ul::-webkit-scrollbar-thumb{
                background-color: #aaaaaa;
                border-radius: 50px;
            }
            .side-bar ul::-webkit-scrollbar-track{
                background-color: transparent;
            }
            #info-4 .container{
                border:none;
            }
            .side-bar ul li a {
                display: inline-block;
                width: 100%;
                padding: 8px 15px;
                background-color: #fff;
                font-weight: 400;
                font-size: 16px;
                transition:.15s linear;
            }
            .side-bar ul li ~ li {
                border-top: 1px solid #ddd;
            }
            .side-bar ul li a:hover {
                background-color: #00a3c8;
                color: #fff!important;
            }
            
            .side-bar ul li .active {
                background-color: #00a3c8;
                color: #fff!important;
            }
            
            .btn-blue {
                background-color: #00a3c8;
                color: #fff!important;
                line-height: 30px;
                margin-top: 15px;
                margin-left: 10px;
                padding: 5px 15px 5px 15px;
                border-radius:7px;
                transition:.1s linear;
            }
            .btn-blue:hover {
                background-color: #0e8eab;
            }
            .advice{
                border-radius:15px;
                background-color:#eee;
                padding:30px 15px;
            }
            .advice p
            {
                font-weight:600;
            }
            .right-bar
            {
                overflow:hidden;
                padding-top:60px !important;
                position:relative;
            }
            .slides li{
                height: 500px !important;
                border-radius: 0;
            }
            .right-bar-header
            {
                position:absolute;
                left:0px;
                top:0px;
                padding:10px 15px;
                color:#fff;
                background:#004861;
                width:100%;
                border-radius:12px 12px 0px 0px;
            }
            .slider .slides li img{
                width: 100%;
                height: 350px;
            }
            .slider .slides li{
                width: 100%;
                height: 350px !important;
            }
            .pod ~ .pod
            {
                margin-top:15px;
                border-top:1px solid #ddd;
                padding-top:15px;
            }
            .pod{
                text-align:center;
            }
            .img-holder{
                padding-top: 73%;
            }
            .img-holder-one img{
                height:150px;
                width:auto;
            }
            .pod .text h6
            {
                font-size:16px;
            }
            .pod .text
            {
                text-align:center;
                padding: 10px 0px 0px 0px
            }
            .slider.blue-nav li{
                width:100%;
            }
            .pod .text p
            {
                font-size:13px;
                margin:0px 0px 10px
            }
            .detail-holder
            {
              background-color: #00a3c8;  
            }
            .info-section{
                padding-top: 0px !important;
                padding-bottom: 0px !important;
            }
            @media only screen and (max-width: 600px) {
              .slides li {
                height: 300px !important;
              }
              .slider.blue-nav{
                  height:300px !important;
              }
              .hero-section{
                  margin-top:10px !important;
              }
            }
            .hero-section iframe{
                width:100%;
                height:350px;
            }
            .hero-section video{
                width:100%;
                margin: 5px auto;
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
            .section-title{
                text-align: center;
                margin: auto;
                margin-top: 30px;
            }
            #info-4 .container{
                background: #fff;
                border: 1px solid #ccc !important;
                border-bottom: 5px solid #ddd !important;
                border-radius: 7px;
                margin: 10px auto;
            }
            h3.h3-md{
                margin-top: 20px;
            }
            .slider {
                position: relative;
                max-width: 100%;
                height: 350px;
            }
            .h4-md{
                font-size: 17px;
                color: #545454;
            }
            @media (min-width: 768px)
            {
                .depart-list{
                    margin: 5px auto;
                    width: 22vw;
                }
            }
            @media (max-width: 786px)
            {
                #about-6 .row{
                    flex-direction: column-reverse;
                }
                .depart-list{
                    margin: 65px 0px 0px 0px  !important;
                }
                .h3-md {
                    font-size: 18px !important;
                    margin: auto;
                    text-align: center;
                }
                h4.h4-md {
                    font-size: 1.2rem;
                    margin: 15px auto;
                    text-align: center;
                }
                .depart-list #sideBar .side-bar ul{
                    z-index: 10;
                    height: 315px !important;
                }
            }
            .depart-list,
            .depart-list #sideBar,
            .depart-list #sideBar ul
            {
                height:100%;
            }
            .depart-list #sideBar .side-bar
            {
                box-shadow:none !important;
            }
            .depart-list #sideBar .side-bar
            {
               box-shadow: none !important;
            }
            .depart-list #sideBar .side-bar ul{
               box-shadow: 0px 1px 3px 0px rgba(0,0,0,0.3);
            }
            .depart-list #sideBar .side-bar ul
            {
                position:absolute;
                left:0px;
                width:100%;
                height: calc(100% - 17px);
            }
        </style>
        <section id="hero-9" class="hero-section division">
            <div class="container p-0">
                <div class="row no-gutters">
                    <div class="col-xl-3 col-lg-3 col-12 " >
                        <div class="depart-list">
                            <a href="#sideBar" data-toggle="collapse" class="side-bar-toggler"><?= ($lang == "eng") ? $dpt['dpt_name'] : $dpt['dpt_name_arabic'];?> <i class="fa fa-angle-down"></i> </a>
                            <div id="sideBar" class="collapse show" >
                        	    <div class="side-bar" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                        	        <ul >
                        	            <?php
                   					    $sql = query("SELECT * FROM tbl_department where dpt_active = 1");
                   					    while($dptData = fetch($sql))
                   					    {
                   					        $flag = false;
                   					        if($dptData['dpt_slug'] == $slug)
                   					        {
                   					            $flag = true;
                   					        }
                   				            ?>
                                            <li ><a <?= ($flag) ? 'class="active"' : ''; ?> href="<?= base_url().$dptData['dpt_slug']?>"><?= ($lang == "eng") ? $dptData['dpt_name'] : $dptData['dpt_name_arabic'] ;?></a></li>
                                            <?php
                   					    }
                   					    ?>  
                                    </ul>
                        	    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-12">
                        <?php
                        $sql        = query("SELECT COUNT(dpt_gallery_id) as count FROM tbl_dpt_gallery WHERE dpt_gallery_is_video = 1 AND dpt_gallery_active = 1 AND dpt_gallery_depart = ".$dpt['dpt_id']);
                        $is_video   = fetch($sql)['count'];
                        if($is_video > 0)
                        {
                            $sql = query("SELECT * FROM tbl_dpt_gallery WHERE dpt_gallery_active = 1 AND dpt_gallery_video_show = 1 AND dpt_gallery_depart = ".$dpt['dpt_id']);
                            while($slData = fetch($sql))
                            {
                                if($slData['dpt_gallery_is_link'] == 1)
                                {
                                    ?>
                                    <div class="iframe-div">
                                        <?= ($lang == "eng") ? $slData['dpt_gallery_video'] : $slData['dpt_gallery_video_ar']; ?>
                                    </div>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <div class="video-div">
                                        <video autoplay playsinline muted loop id="myvid">
                                            <source src="<?= file_url();?><?= ($lang == "eng") ? $slData['dpt_gallery_video'] : $slData['dpt_gallery_video_ar']; ?>" type="video/mp4">
                                        </video>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        else
                        {
                            ?>
                        	<div class="slider blue-nav">
                            	<ul class="slides">
                            	    <?php
                            	    $sql = query("SELECT * FROM tbl_dpt_gallery WHERE dpt_gallery_is_video = 0 AND dpt_gallery_active = 1 AND dpt_gallery_depart = ".$dpt['dpt_id']);
                            	    while($slData = fetch($sql))
                            	    {
                            	        ?>
                            	        <li id="slide-1">
                            	        	<img src="<?= file_url();?><?= ($lang == "eng") ? $slData['dpt_gallery_image'] : $slData['dpt_gallery_image_ar']; ?>" alt="slide-background">
                            		    </li>
                            	        <?php
                            	    }
                            	    ?>
                        	    </ul>
                            </div>
                            <?php
                        }
                        ?>
                     </div>
                </div>
            </div>
        </section>
        <section id="info-4" class="wide-100 info-section division detail-holder">
            <?php
            $sql1 = query("SELECT * FROM tbl_dpt_service WHERE dpt_service_active = 1 AND dpt_depart_id = ".$dpt['dpt_id']);
            if(nrows($sql1) > 0)
            {
                ?>
                <div class="container" style="padding:10px">
                <div class="row">	
        			<div class="col-lg-10 offset-lg-1 section-title">
        				<h3 class="h3-md steelblue-color"><?= ($lang == "eng") ? $lang_con[150]['lang_eng'] : $lang_con[150]['lang_arabic']; ?></h3>
        			</div> 
        		</div>
                <div class="row">
                    <div class="col-md-12">
            			<div id="tabs-nav" class="list-group text-center d-flex justify-content-center">
            			    <ul class="nav nav-pills" id="pills-tab" role="tablist">
            			        <?php
            			        $i = 0;
            			        $sql = query("SELECT * FROM tbl_dpt_service WHERE dpt_service_active = 1 AND dpt_depart_id = ".$dpt['dpt_id']);
            			        while($pkg = fetch($sql))
            			        {
            			            $i++;
            			            ?>
            			            <li class="nav-item icon-xs">
                				    	<a class="nav-link <?= ($i == 1) ? 'active' : ''; ?>" id="tab1-list" data-toggle="pill" href="#tab-<?= $pkg['dpt_service_id']; ?>" role="tab" aria-controls="tab-1" aria-selected="true">
                				    		<?= ($lang == "eng") ? $pkg['dpt_service_title'] : $pkg['dpt_service_title_arabic']; ?>
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
        					$sql = query("SELECT * FROM tbl_dpt_service WHERE dpt_service_active = 1 AND dpt_depart_id = ".$dpt['dpt_id']);
        					while($pkg = fetch($sql))
        					{
        					    $i++;
        					    ?>
        					    <div class="tab-pane fade show <?= ($i == 1) ? 'active' : ''; ?>" id="tab-<?= $pkg['dpt_service_id']; ?>"  role="tabpanel" aria-labelledby="tab1-list">
            						<div class="row d-flex justify-content-center">
            							<div class="col-lg-6">
            							    <?php
            							    $ext = pathinfo($pkg['dpt_service_img'], PATHINFO_EXTENSION);
            							    if($ext == "jpeg" || $ext == "jpg" || $ext == "png" || $ext == "gif" || $ext == "jfif")
            							    {
            							        ?>
            							        <div class="tab-img">
                									<img class="img-fluid" src="<?= file_url().$pkg['dpt_service_img'];?>" alt="tab-image" />
                								</div>
            							        <?php
            							    }
            							    else if($ext == "webm" || $ext == "mpg" || $ext == "mp2" || $ext == "mpeg" || $ext == "mpv" || $ext == "mp4" || $ext == "ogg")
            							    {
            							        ?>
            							        <div class="tab-video">
                									<video autoplay playsinline muted loop id="myvid">
                                                        <source src="<?= file_url().$pkg['dpt_service_img'];?>" type="video/mp4">
                                                    </video>
                								</div>
            							        <?php
            							    }
            							    ?>
            							</div>
            							<div class="col-lg-6" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
            								<div class="txt-block pc-30">
            									<h3 class="h3-md steelblue-color <?= ($lang == "eng") ? 'left-after' : 'right-after' ;?>"><?= ($lang == "eng") ? $pkg['dpt_service_title'] : $pkg['dpt_service_title_arabic']; ?></h3>
            									<p class="mb-30"><?= ($lang == "eng") ? $pkg['dpt_service_desc'] : $pkg['dpt_service_desc_arabic']; ?></p>
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
                <?php
            }
            ?>
        </section>
        <section id="info-4" class="wide-100 info-section division detail-holder">
            <div class="container">
                <?php
                $dptid = $dpt['dpt_id'];
                $sql = query("SELECT * FROM tbl_doctor WHERE doc_status_head = 1 AND doctor_department = ".$dptid); 
                $doc_da = fetch($sql);
                ?>
                <div class="row">
                    <div class="col-md-7 col-sm-12 col-12">
                        <div class="aurthor-detail">
                            <div class="txt-block pc-30">
                                <h3 class="h3-md steelblue-color text-left <?= ($lang == "eng") ? 'left-after' : 'right-after' ;?>"><?= ($lang == "eng") ? $lang_con[151]['lang_eng'] : $lang_con[151]['lang_arabic']; ?></h3>
        						<h5><?= ($lang == "eng") ? $doc_da['doc_name'] : $doc_da['doc_name_arabic']; ?></h5>
        						<p class="mb-10"><?= ($lang == "eng") ? $doc_da['doc_job_title'] : $doc_da['doc_job_title']; ?></p>
        						<p class="mb-10"><?= ($lang == "eng") ? $doc_da['doc_degree'] : $doc_da['doc_degree']; ?></p>
        					</div>	
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12 col-12 dimg">
                        <div class="image-holder">
                            <div class="tab-img">
        						<img class="img-fluid doc-img" src="<?= file_url().$doc_da['doc_image'];?>" alt="tab-image" />
        					</div>
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
        </style>
        <?php
        $sqlcount = query("SELECT count(*) as count FROM tbl_advertisment WHERE add_location = 'Department Pages' AND add_status = 1");
        $countAdd = fetch($sqlcount);
        if($countAdd['count'] > 0)
        {
        ?>
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
        				    $sql = query("SELECT * FROM tbl_advertisment WHERE add_location = 'Department Pages' AND add_status = 1 ORDER BY rand()");
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
        <?php } ?>
        <style>
            .h4-text  {
                font-size: 30px !important;font-weight: 100 !important;
            }
            .h5-text  {
                font-size: 28px !important;font-weight: 100 !important;
            }
            .h6-text  {
                font-size: 26px !important;font-weight: 100 !important;
            }
            @media (max-width: 786px){
                .h4-text  {
                    font-size: 17px !important;
                    margin: auto;
                    text-align: center;
                }
                .h5-text  {
                    font-size: 16px !important;
                    margin: auto;
                    text-align: center;
                }
                .h6-text  {
                    font-size: 15px !important;
                    margin: auto;
                    text-align: center;
                }
            }
        </style>
        <?php
        $sql = query("SELECT * FROM tbl_doctor WHERE doc_status_head = 0 AND doctor_department = ".$dpt['dpt_id']); 
        if(nrows($sql) > 0)
        {
            ?>
            <section id="doctors-3" class="bg-lightgrey wide-60 doctors-section division">
            	<div class="container" style="padding-right:0px !important; padding-left:0px !important">
            		<div class="row">
            		    <?php
            		    while($doc = fetch($sql))
            		    {
            		        ?>
                			<div class="col-md-6 col-lg-4">
                				<div class="doctor-2">
                					<div class="hover-overlay img-holder"> 
                						<img class="img-fluid" src="<?= file_url().$doc['doc_image'];?>" alt="doctor-foto">	
                					</div>
                					<div class="doctor-meta">
                						<h5 class="h5-xs blue-color"><?= ($lang == "eng") ? $doc['doc_name'] : $doc['doc_name_arabic']; ?></h5>
                						<span><?= ($lang == "eng") ? $doc['doc_job_title'] : $doc['doc_job_title_arabic']; ?></span>
                						<a class="btn btn-sm btn-blue blue-hover mt-15" href="<?= base_url()."dr".$pram."/".$doc['doc_slug'];?>" title=""><?= ($lang == "eng") ? $lang_con[90]['lang_eng'] : $lang_con[90]['lang_arabic']; ?></a>
                					</div>
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
        include 'footer.php';
        ?>
        <script>
            $(document).ready(function() {
                if ($(window).width() < 1005) {
                    $( "#sideBar" ).removeClass('show');
                }
                else {
                    $( "#sideBar" ).addClass('show');
                }
                 $(".close-button").click(function(e){
        	        e.preventDefault();
        	        var addID = $(this).attr('data-add-id');
        	        $("#"+addID).hide();
        	    });
            });
            $( window ).resize(function() {
                if ($(window).width() < 1005) {
                    $( "#sideBar" ).removeClass('show');
                }
                else {
                    $( "#sideBar" ).addClass('show');
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