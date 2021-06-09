<?php
if(isset($_GET['slug']) && $_GET['slug'] != "" && $_GET['slug'] != null)
{
    $slug = $_GET['slug'];
    include 'header.php';
    $sql = query("SELECT * FROM tbl_channel WHERE chn_active = 1 AND chn_slug = '$slug'");
    if(nrows($sql) > 0)
    {
        $chn = fetch($sql);
        ?>
        <style>
            .wide-60 {
                padding-top: 0px !important;
            }
            .text-detail{
                padding: 15px;
                background: #fff;
                border-radius: 12px;
                margin-bottom:30px;
            }
            .right-bar{
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
            @media(min-width:992px){
                .side-bar-toggler{
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
            .side-bar {
                box-shadow: 0px 1px 3px 0px rgba(0,0,0,0.3);
                overflow: hidden;
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
                padding: 5px 5px;
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
            .advice p{
                font-weight:600;
            }
            .right-bar{
                overflow:hidden;
                padding-top:60px !important;
                position:relative;
            }
            .slides li{
                height: 500px !important;
                border-radius: 0;
            }
            .right-bar-header{
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
            .pod ~ .pod{
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
            .pod .text h6{
                font-size:16px;
            }
            .pod .text{
                text-align:center;
                padding: 10px 0px 0px 0px
            }
            .slider.blue-nav li{
                width:100%;
            }
            .pod .text p{
                font-size:13px;
                margin:0px 0px 10px
            }
            .detail-holder{
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
            @media (max-width: 768px){ 
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
            @media (min-width: 768px){
                .depart-list{
                    margin: 5px auto;
                    width: 22vw;
                }
            }
            @media (max-width: 786px){
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
                .depart-list #mobile-sideBar .side-bar ul{
                    z-index: 10;
                    position:unset !important;
                    height: 315px !important;
                }
            }
            .depart-list,
            .depart-list #mobile-sideBar,
            .depart-list #mobile-sideBar ul{
                height:100%;
            }
            .depart-list #mobile-sideBar .side-bar ul{
                border-left: 1px solid #ccc !important;
                border-right: 1px solid #ccc !important;
            }
            .depart-list #mobile-sideBar .side-bar ul{
                position:absolute;
                left:0px;
                width:100%;
                height: calc(100% - 17px);
            }
            .depart-list,
            .depart-list #sideBar,
            .depart-list #sideBar ul{
                height:100%;
            }
            .depart-list #sideBar .side-bar ul{
                border-left: 1px solid #ccc !important;
                border-right: 1px solid #ccc !important;
            }
            .depart-list #sideBar .side-bar ul{
                position:absolute;
                left:0px;
                width:100%;
                height: calc(100% - 17px);
            }
        </style>
        <style>
            .video-div-small{
                display: flex;
                justify-content: flex-start;
                padding: 5px 5px;
                background-color: white;
                box-shadow: 0px 1px 3px 0px rgba(0,0,0,0.3);
            }
            .video-meta{
                width: 100%;
                margin-top: -5px;
                padding: 0px 10px 5px;
            }
            .video-title{
                font-size: 17px !important;
                margin: 0px !important;
            }
            .video-meta-data{
                padding:10px;
            }
            .video-department, .video-channel{
                color: #9a9a9a;
                margin: 0px !important;
                font-weight: 100 !important;
                font-size: 14px !important;
                text-transform: capitalize !important;
            }
            .iframe-meta{
                width: 96px;
                height: 60px;
            }
            .iframe-meta iframe{
                width: 96px;
                height: 60px;
            }
            .logo-holder{
                padding:10px;
                padding: 10px 5px;
                margin-top: -13px;
            }
            .related-video-div{
                padding:5px;
            }
            .related-header{
                padding:0px 10px !important;
            }
        </style>
        <section id="hero-9" class="hero-section division">
            <div class="container p-0" <?= ($lang == "eng") ? 'style="background-color:white"' : 'style="direction:rtl;background-color:white"' ;?> >
                <div class="row no-gutters">
                    <div class="col-xl-12 col-lg-12 col-12 " >
                        <div class="depart-list">
                            <a href="#mobile-sideBar" data-toggle="collapse" class="side-bar-toggler"><?= ($lang == "eng") ? $chn['chn_name'] : $chn['chn_name_arabic'];?> <i class="fa fa-angle-down"></i> </a>
                            <div id="mobile-sideBar" class="collapse" >
                        	    <div class="side-bar" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                        	        <ul >
                        	            <?php
       								    $sql = query("SELECT * FROM tbl_channel where chn_active = 1");
       								    $i = 0;
       								    while($dptData = fetch($sql))
       								    {
       								        $i++;
   								            ?>
   								               <li><a <?= ($flag) ? 'class="active"' : ''; ?> href="<?= base_url().$dptData['chn_slug']?>"><?= ($lang == "eng") ? $dptData['chn_name'] : $dptData['chn_name_arabic'] ;?></a></li>
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
                        if(isset($_GET['video']) && $_GET['video'] != null && $_GET['video'] != "")
                        {
                            $video_id = filter_this($_GET['video']);
                            $sql = query("SELECT * FROM tbl_chn_gallery WHERE chn_video_id = ".$video_id);
                        }
                        else
                        {
                            $sql = query("SELECT * FROM tbl_chn_gallery WHERE chn_video_parent = ".$chn['chn_id']." ORDER BY chn_video_id DESC LIMIT 1");
                        }
                        while($vidData = fetch($sql))
                        {
                            if($vidData['chn_is_link'] == 1)
                            {
                                ?>
                                <div class="iframe-div">
                                    <?= ($lang == "eng") ? $vidData['chn_video_media'] : $vidData['chn_video_media_ar']; ?>
                                </div>
                                <?php
                            }
                            else
                            {
                                ?>
                                <div class="video-div">
                                    <video controls id="myvid">
                                        <source src="<?= file_url();?><?= ($lang == "eng") ? $vidData['chn_video_media'] : $vidData['chn_video_media_ar']; ?>" type="video/mp4">
                                    </video>
                                </div>
                                <?php
                            }
                        ?>
                        <div class="video-meta-data">
                            <div class="video-meta-title">
                                <h3 class="video-meta-h3 <?= ($lang == "eng") ? 'text-left' : 'text-right' ?>"><?= ($lang == "eng") ? $vidData['chn_video_title'] : $vidData['chn_video_title_ar']; ?></h3>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-12" id="mobile-list">
                        <div class="depart-list">
                            <div id="sideBar" class="collapse show" >
                    	        <div class="side-bar" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                    	            <ul>
                    	                <li>
                    	                    <div class="logo-holder">
                    	                        <img class="img-responsive img-fluid" src="<?= file_url().$chn['chn_icon_name'];?>" style="height: auto;width: 100%;">
                    	                    </div>
                    	                </li>
                    	                <?php
                    	                if(isset($_GET['video']) && $_GET['video'] != null && $_GET['video'] != "")
                                        {
                                            $video_id = filter_this($_GET['video']);
                                            $sql = query("SELECT * FROM tbl_chn_gallery g JOIN tbl_channel c ON (c.chn_id = g.chn_video_parent) LEFT JOIN tbl_department d ON (d.dpt_id = c.chn_department) where chn_video_active = 1 AND chn_video_parent = ".$chn['chn_id']." AND chn_video_id != (SELECT chn_video_id FROM tbl_chn_gallery WHERE chn_video_id = ".$video_id.")");
                                        }
                                        else
                                        {
                                            $sql = query("SELECT * FROM tbl_chn_gallery g JOIN tbl_channel c ON (c.chn_id = g.chn_video_parent) LEFT JOIN tbl_department d ON (d.dpt_id = c.chn_department) where chn_video_active = 1 AND chn_video_parent = ".$chn['chn_id']." AND chn_video_id != (SELECT chn_video_id FROM tbl_chn_gallery WHERE chn_video_parent = ".$chn['chn_id']." ORDER BY chn_video_id DESC LIMIT 1)");
                                        }
                   					    while($dptData = fetch($sql))
                   					    {
                   				            ?>
                                            <li>
                                                <a href="<?= base_url().$dptData['chn_slug'];?>?video=<?= $dptData['chn_video_id'] ?>">
                                                    <div class="video-div-small">
                                                        <div class="video-thumbnail">
                                                            <?php
                                                            if($dptData['chn_is_link'] == 1)
                                                            {
                                                                ?>
                                                                <div class="iframe-meta">
                                                                    <?= ($lang == "eng") ? $dptData['chn_video_media'] : $dptData['chn_video_media_ar']; ?>
                                                                </div>
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                ?>
                                                                <img class="img-responsive img-fluid" src="<?= file_url();?><?= ($lang == "eng") ? $dptData['chn_video_thumbnail'] : $dptData['chn_video_thumbnail_ar'] ?>" style="height: auto;width: 165px;">
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="video-meta <?= ($lang == "eng") ? 'text-left' : 'text-right' ?>">
                                                            <h3 class="video-title"><?= ($lang == "eng") ? $dptData['chn_video_title'] : $dptData['chn_video_title_ar'] ?></h3>
                                                            <?php
                                                            if($dptData['dpt_name'] != null && $dptData['dpt_name'] != "")
                                                            {
                                                                ?>
                                                                <h5 class="video-department"><?= ($lang == "eng") ? $dptData['dpt_name'] : $dptData['dpt_name_arabic'] ?></h5>
                                                                <?php
                                                            }
                                                            ?>
                                                            <h5 class="video-channel"><?= ($lang == "eng") ? $dptData['chn_name'] : $dptData['chn_name_arabic'] ?></h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <?php
                   					    }
                   					    ?>
                                    </ul>
                        	    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xs-12" style="display:none" id="related-div" >
                        <div class="related-header">
                            <h3 class="h3-md steelblue-color <?= ($lang == "eng") ? 'left-after text-left' : 'right-after text-right' ;?>"><?= ($lang == "eng") ? $lang_con[93]['lang_eng'] : $lang_con[93]['lang_arabic']; ?></h3>
                        </div>
                        <div class="owl-carousel owl-theme related-list-carousel">
        				    <?php
        				    if(isset($_GET['video']) && $_GET['video'] != null && $_GET['video'] != "")
                            {
                                $video_id = filter_this($_GET['video']);
                                $sql = query("SELECT * FROM tbl_chn_gallery g JOIN tbl_channel c ON (c.chn_id = g.chn_video_parent) LEFT JOIN tbl_department d ON (d.dpt_id = c.chn_department) where chn_video_active = 1 AND chn_video_parent = ".$chn['chn_id']." AND chn_video_id != (SELECT chn_video_id FROM tbl_chn_gallery WHERE chn_video_id = ".$video_id.")");
                            }
                            else
                            {
                                $sql = query("SELECT * FROM tbl_chn_gallery g JOIN tbl_channel c ON (c.chn_id = g.chn_video_parent) LEFT JOIN tbl_department d ON (d.dpt_id = c.chn_department) where chn_video_active = 1 AND chn_video_parent = ".$chn['chn_id']." AND chn_video_id != (SELECT chn_video_id FROM tbl_chn_gallery WHERE chn_video_parent = ".$chn['chn_id']." ORDER BY chn_video_id DESC LIMIT 1)");
                            }
                 		    while($dptData = fetch($sql))
       					    {
       				            ?>
       				            <div class="related-video-div">
                					<a href="<?= base_url().$dptData['chn_slug'];?>?video=<?= $dptData['chn_video_id'] ?>">
                                        <div class="video-div-small">
                                            <div class="video-thumbnail">
                                                <?php
                                                if($dptData['chn_is_link'] == 1)
                                                {
                                                    ?>
                                                    <div class="iframe-meta">
                                                        <?= ($lang == "eng") ? $dptData['chn_video_media'] : $dptData['chn_video_media_ar']; ?>
                                                    </div>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                    <img class="img-responsive img-fluid" src="<?= file_url();?><?= ($lang == "eng") ? $dptData['chn_video_thumbnail'] : $dptData['chn_video_thumbnail_ar'] ?>" style="height: auto;width: 165px;">
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="video-meta <?= ($lang == "eng") ? 'text-left' : 'text-right' ?>">
                                                <h3 class="video-title"><?= ($lang == "eng") ? $dptData['chn_video_title'] : $dptData['chn_video_title_ar'] ?></h3>
                                                <?php
                                                if($dptData['dpt_name'] != null && $dptData['dpt_name'] != "")
                                                {
                                                    ?>
                                                    <h5 class="video-department"><?= ($lang == "eng") ? $dptData['dpt_name'] : $dptData['dpt_name_arabic'] ?></h5>
                                                    <?php
                                                }
                                                ?>
                                                <h5 class="video-channel"><?= ($lang == "eng") ? $dptData['chn_name'] : $dptData['chn_name_arabic'] ?></h5>
                                            </div>
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
        </section>
        <section id="info-4" class="wide-100 info-section division detail-holder">
            <div class="container" <?= ($lang == "eng") ? '' : 'style="direction:rtl"' ;?>>
                <div class="row">
                    <div class="col-md-7 col-sm-12 col-12">
                        <div class="aurthor-detail">
                            <div class="txt-block pc-30">
                                <h3 class="h3-md steelblue-color <?= ($lang == "eng") ? 'left-after text-left' : 'right-after text-right' ;?>"><?= ($lang == "eng") ? $chn['channel_user_name'] : $chn['channel_username_ar']; ?></h3>
                                <?php
                                if($chn['chn_degree'] != null && $chn['chn_degree'] != "" && $chn['chn_degree_ar'] != null && $chn['chn_degree_ar'] != "")
                                {
                                    ?>
                                    <p class="mb-10 <?= ($lang == "eng") ? 'text-left' : 'text-right' ;?>" ><?= ($lang == "eng") ? $chn['chn_degree'] : $chn['chn_degree_ar']; ?></p>
                                    <?php
                                }
                                if($chn['chn_job_title'] != null && $chn['chn_job_title'] != "" && $chn['chn_job_title_ar'] != null && $chn['chn_job_title_ar'] != "")
                                {
                                    ?>
                                    <p class="mb-10 <?= ($lang == "eng") ? 'text-left' : 'text-right' ;?>" ><?= ($lang == "eng") ? $chn['chn_job_title'] : $chn['chn_job_title_ar']; ?></p>
                                    <?php
                                }
                                if($chn['chn_institue'] != null && $chn['chn_institue'] != "" && $chn['chn_institue_ar'] != null && $chn['chn_institue_ar'] != "")
                                {
                                    ?>
                                    <p class="mb-10 <?= ($lang == "eng") ? 'text-left' : 'text-right' ;?>" ><?= ($lang == "eng") ? $chn['chn_institue'] : $chn['chn_institue_ar']; ?></p>
                                    <?php
                                }
                                ?>
        						<p class="mb-10 <?= ($lang == "eng") ? 'text-left' : 'text-right' ;?>" ><?= ($lang == "eng") ? $chn['chn_short_desc'] : $chn['chn_short_desc_arabic']; ?></p>
        					</div>	
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12 col-12 dimg">
                        <div class="image-holder">
                            <div class="tab-img">
        						<img class="img-fluid doc-img" src="<?= file_url().$chn['chn_handler_img'];?>" alt="tab-image" />
        					</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
        include 'footer.php';
        ?>
        <script>
            $(document).ready(function() {
                if ($(window).width() < 1005) {
                    $( "#sideBar" ).removeClass('show');
                    $("#mobile-list").hide();
                    $("#related-div").show();
                }
                else {
                    $( "#sideBar" ).addClass('show');
                    $("#mobile-list").show();
                    $("#related-div").hide();
                }
            });
            $( window ).resize(function() {
                if ($(window).width() < 1005) {
                    $( "#sideBar" ).removeClass('show');
                    $("#mobile-list").hide();
                    $("#related-div").show();
                }
                else {
                    $( "#sideBar" ).addClass('show');
                    $("#mobile-list").show();
                    $("#related-div").hide();
                }
            });
            
            var owlRelated = $('.related-list-carousel');
    		owlRelated.owlCarousel({
    			items: 4,
    			loop:false,
    			autoplay:true,
    			navBy: 1,
    			<?= ($lang == "eng") ? '' : 'rtl:true,'; ?>
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
    					items:5
    				},
    				1000:{
    					items:5
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