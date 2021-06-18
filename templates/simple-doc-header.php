<?php
$current_file_name = basename($_SERVER['PHP_SELF']);
$current_name_arr = explode('.',$current_file_name);
$file_name = $current_name_arr[0];
if($file_name == 'index' || $file_name == "")
{
    $file_name = "home";
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title><?= ($lang == "eng") ? $meta_title : $meta_title_ar; ?></title>
		<meta name="keywords" content="<?= ($lang == "eng") ? $meta_keyword : $meta_keyword_ar; ?> ">
	    <meta name="description" content="<?= ($lang == "eng") ? $meta_desc : $meta_desc_ar; ?> ">
	    <meta property="og:title" content="<?= ($lang == "eng") ? $meta_title : $meta_title_ar; ?> "/>
	    <meta property="og:description" content="<?= ($lang == "eng") ? $meta_desc : $meta_desc_ar; ?> "/>
	    <meta property="og:image" content="<?= file_url().$siteData['site_logo_header'];?>" />
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet"> 	
		<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet"> 
		<link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" rel="stylesheet" crossorigin="anonymous">
		<link href="<?= file_url().$siteData['site_favicon'];?>" type="image/x-icon" rel="icon">
		<link href="<?= base_url();?>css/bootstrap.min.css" rel="stylesheet">
		<link href="<?= base_url();?>css/flaticon.css" rel="stylesheet">
		<link href="<?= base_url();?>css/menu.css" rel="stylesheet">	
		<link href="<?= base_url();?>css/dropdown-effects/fade-down.css" media="all" rel="stylesheet"  id="effect">
		<link href="<?= base_url();?>css/magnific-popup.css" rel="stylesheet">	
		<link href="<?= base_url();?>css/owl.carousel.min.css" rel="stylesheet">
		<link href="<?= base_url();?>css/owl.theme.default.min.css" rel="stylesheet">
		<link href="<?= base_url();?>css/animate.css" rel="stylesheet">
		<link href="<?= base_url();?>css/jquery.datetimepicker.min.css" rel="stylesheet">
		<link href="<?= base_url();?>css/style.css" rel="stylesheet">
		<link href="<?= base_url();?>css/responsive.css" rel="stylesheet">
		<link href="<?= base_url();?>css/shadow.css" rel="stylesheet">
		<style>
        .img-holder {
            position: relative;
            padding-top: 60%;
        }
            		    
	    .img-holder img {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            object-fit: contain;
            object-position: center;
        }
		.btn_lang{
		    padding: 5px 10px;
            float: right;
            position: absolute;
            top: 20px;
            right: 13px;
            color: white;
            background: #11a9cc;
		}
		.doctor-2{
            padding: 20px !important;
        }
        .sbox-3{
            padding: 15px 5px 10px !important; 
        }
        .hover-overlay img{
            transform: scale(1) !important;
            -ms-transform: scale(1) !important;
        }
        .doctor-2:hover .hover-overlay > img{
            transform: scale(0.9) !important;
            -ms-transform: scale(0.9) !important;
        }
		<?php
		if($lang != "eng")
		{
		    ?>
		    @font-face {
                font-family: ArabicBold;
                src: url(<?= base_url();?>fonts/ArabicBold.ttf);
            }
            @font-face {
                font-family: Arabicregular;
                src: url(<?= base_url();?>fonts/ArabicRegular.ttf);
            }
		    .abc{
		        float:left !important;
		    }
		    body{
		        font-family:Arabicregular !important;
		    }
		    body p{
		        font-family:Arabicregular !important;
		    }
		    body span{
		        font-family:Arabicregular !important;
		    }
		    body a{
		        font-family:Arabicregular !important;
		    }
		    body h1{
		        font-weight:100;
		        font-family:ArabicBold !important;
		    }
		    body h2{
		        font-weight:100;
		        font-family:ArabicBold !important;
		    }
		    body h3{
		        font-weight:100;
		        font-family:ArabicBold !important;
		    }
		    body h4{
		        font-weight:100;
		        font-family:ArabicBold !important;
		    }
		    body h5{
		        font-family:ArabicBold !important;
		    }
		    body h6{
		        font-family:ArabicBold !important;
		    }
		    h3.h3-md{
		            font-size: 1.925rem;
		    }
		    
		    .post-summary
		    {
	            margin-right: 20px;
		    }
		    .single-post-comments .media img
		    {
		        margin-right:0px !important;
		        margin-left:15px !important;
		    }
		    .sblog-post-txt img
		    {
		        margin:15px 0px !important;
		    }
		    <?php
		}
		else
		{
		    ?>
		    @import url('https://fonts.googleapis.com/css?family=Montserrat:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900');
            @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i');
            @import url('https://fonts.googleapis.com/css?family=Satisfy');
            
            h1, h2, h3, h4, h5, h6 {
                font-family: 'Montserrat', sans-serif !important;
            }
            h1{
                font-size: 32px !important;
                font-weight: 400 !important;
                line-height: 40px !important;
                
            }
            h3{
                    font-size: 20px !important;
                    font-weight: 400 !important;
                    line-height: 28px !important;
               
            }
            .h3-md{
                font-size:32px !important;
            }
            .breadcrumb-holder h4{
            font-size: 36px;
            font-weight: 500;
            }
            h5{
                    font-weight: 700  !important; 
                    font-size:1.25rem !important;
            }
            .h5-xs {
            font-size: 20px !important;
            font-weight: 400 !important;
            }
            .doctor-meta span{
                
            }
            .btn.btn-md{
                font-size: 14px !important;
                font-weight: 700 !important;
            }
            ol li {
                font-weight:14px !important;
            }
            body, span, a, p {
                font-family: 'Open Sans', sans-serif !important;
            }
            p{
                    font-size: 14px !important;
                    line-height: 26px !important;
                    font-weight: 400 !important;
            }
            li a{
                font-family: 'Open Sans', sans-serif !important;
                    font-size: 14px !important;
                    font-weight: 400  !important;
            }
            span{
                font-weight: 500 !important;
            }
            
		    <?php
		}
		?>
		#reviews-2 .review-author h5
		{
		    font-weight: 100 !important;
		    letter-spacing: 0px !important;
		    text-transform: capitalize  !important;
		}
		
		.insurance-holder.owl-drag .owl-item{
		    padding: 5px;
		}
		.insurance-holder .img-holder img{
		    object-fit: fill;
		}
		.sbox-3 h5{
		    text-transform:capitalize;
		}
		li a{
		    font-weight:600 !important;
		}
	    @media(max-width:767px)
	    {
	        .image-widget.sidebar-div {
                text-align: center;
                margin: 30px;
            }
	        .masonry-wrap .gallery-item {
                width: 100% !important;
                position: relative !important;
                height: auto !important;
                padding-top: 64% !important;
                top:auto !important;
            }
            .gallery-item .video-holder
            {
                position:absolute;
                top:0px;
                left:0px;
                height:100%;
                width:100%;
            }
            .gallery-item .video-holder iframe
            {
                position:absolute;
                top:0px;
                left:0px;
                height:100% !important;
                width:100% !important;
            }
            .gallery-item video
            {
                position:absolute;
                top:0px;
                left:0px;
                height:100% !important;
                width:100% !important;
                object-fit:cover;
                object-position:center;
            }
	        .reverse
	        {
                flex-direction: column-reverse;
	        }
	        .wide-40
	        {
                padding-top: 30px !important;
            }
	        .wide-100 {
                padding-top: 30px !important;
                padding-bottom: 30px !important;
            }
            .blog-post-txt div
            {
                overflow:hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
            }
	    }
	    @media (max-width: 991.99px) and (min-width: 768px)
        {
            .wide-100 {
                padding-top: 30px !important;
                padding-bottom: 30px !important;
            }

        }
        
        .text-data.video-holder
        {
            position:relative;
            padding-top:64%;
        }
        .text-data.video-holder iframe
        {
            position:absolute;
            top:0px;
            left:0px;
            height:100% !important;
            width:100% !important;
        }
        
        .wide-100{
            padding-top: 45px;
            padding-bottom: 45px;
        }
        .wide-60{
            padding-top: 60px;
            padding-bottom: 0px;
        }
        span.section-id{
            font-size: 1.5rem;
        }
        h3.h3-md{
            font-size: 1.625rem;
        }
        .wsmainwp .wsmenu{
            <?= ($lang == "eng") ? 'margin-left:auto !important' : 'margin-right:auto !important' ?>
        }
		</style>
	</head>
	<body>
		<!--<div id="loader-wrapper">-->
		<!--	<div id="loader"><div class="loader-inner"></div></div>-->
		<!--</div>-->
		<div id="page" class="page">
			<header id="header" class="header">
			    <div class="wsmobileheader clearfix">
			    	<a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
			    	<span class="smllogo"><img src="<?= file_url().$siteData['site_logo_header'];?>" width="180" height="40" alt="mobile-logo"/></span>
                    <a href="<?= $_SERVER['SCRIPT_URI'];?><?= ($lang == "eng") ? '?lang=arabic' : '?lang=eng' ;?>" class="btn_lang"><?= ($lang == "eng") ? 'عربى' : 'Eng';?></a>
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
    					<div class="desktoplogo" <?= ($lang == "eng") ? '' : 'style="float:right"' ;?>><a href="<?= base_url();?>"><img src="<?= file_url().$siteData['site_logo_header'];?>"  width="180" height="40" alt="header-logo"></a></div>
      					<nav class="wsmenu clearfix abc"  >
      					    <?php
      					    if($lang == "eng")
      					    {
      					        ?>
        					    <ul class="wsmenu-list" >
    					        	<li class="navbar-item <?= ($file_name == "home") ? 'active' : '';?>"><a href="<?= base_url();?>home"><?= ($lang == "eng") ? $lang_con[1]['lang_eng'] : $lang_con[1]['lang_arabic']; ?></a></li>
    					          	<li>
    					          	    <a class="navbar-item <?= ($file_name == "department") ? 'active' : '';?>" href="#"><?= ($lang == "eng") ? $lang_con[203]['lang_eng'] : $lang_con[203]['lang_arabic']; ?></a>
                						<div class="wsmegamenu clearfix">
                 							<div class="container">
                   								<div class="row">
                   								    <?php
                   								    $sql = query("SELECT * FROM tbl_channel where chn_active = 1");
                   								    $i = 0;
                   								    while($dptData = fetch($sql))
                   								    {
                   								        $i++;
               								            ?>
               								            <ul class="col-lg-3 col-md-12 col-xs-12 link-list">
               								                <li><a href="<?= base_url().$dptData['chn_slug']?>"><?= ($lang == "eng") ? $dptData['chn_name'] : $dptData['chn_name_arabic'] ;?></a></li>
               								            </ul>
               								            <?php
                   								    }
                   								    ?>
    							                </div>
    							            </div>
    							        </div>
    							    </li>
    					          	<li>
    					          	    <a class="navbar-item <?= ($file_name == "department") ? 'active' : '';?>" href="#"><?= ($lang == "eng") ? $lang_con[3]['lang_eng'] : $lang_con[3]['lang_arabic']; ?></a>
                						<div class="wsmegamenu clearfix">
                 							<div class="container">
                   								<div class="row">
                   								    <?php
                   								    $sql = query("SELECT * FROM tbl_department where dpt_active = 1");
                   								    $i = 0;
                   								    while($dptData = fetch($sql))
                   								    {
                   								        $i++;
               								            ?>
               								            <ul class="col-lg-3 col-md-12 col-xs-12 link-list">
               								                <li><a href="<?= base_url().$dptData['dpt_slug']?>"><?= ($lang == "eng") ? $dptData['dpt_name'] : $dptData['dpt_name_arabic'] ;?></a></li>
               								            </ul>
               								            <?php
                   								    }
                   								    ?>
    							                </div>
    							            </div>
    							        </div>
    							    </li>
    							    <li class="navbar-item <?= ($file_name == "all-clinic") ? 'active' : '';?>"><a href="<?= base_url(); ?>clinics"><?= ($lang == "eng") ? $lang_con[17]['lang_eng'] : $lang_con[17]['lang_arabic']; ?></a></a></li>
    							    <li class="navbar-item <?= ($file_name == "all-doctors") ? 'active' : '';?>"><a href="<?= base_url(); ?>doctors"><?= ($lang == "eng") ? $lang_con[4]['lang_eng'] : $lang_con[4]['lang_arabic']; ?></a></a></li>
    							    <li class="navbar-item <?= ($file_name == "cme-training") ? 'active' : '';?>"><a href="<?= base_url()."cme";?>"><?= ($lang == "eng") ? $lang_con[167]['lang_eng'] : $lang_con[167]['lang_arabic']; ?></a></a></li>
    							    <li>
    					          	    <a class="navbar-item <?= ($file_name == "Patient Resource") ? 'active' : '';?>" href="#"><?= ($lang == "eng") ? $lang_con[169]['lang_eng'] : $lang_con[169]['lang_arabic']; ?></a>
                						<div class="wsmegamenu clearfix">
                 							<div class="container">
                   								<div class="row">
                   								    <?php
                   								    $sql = query("SELECT * FROM tbl_resources where resource_active = 1");
                   								    $i = 0;
                   								    while($dptData = fetch($sql))
                   								    {
                   								        $i++;
               								            ?>
               								            <ul class="col-lg-3 col-md-12 col-xs-12 link-list">
               								                <li><a href="<?= base_url().$dptData['resource_slug']?>"><?= ($lang == "eng") ? $dptData['resource_name'] : $dptData['resource_name_arabic'] ;?></a></li>
               								            </ul>
               								            <?php
                   								    }
                   								    ?>
    							                </div>
    							            </div>
    							        </div>
    							    </li>
    					          	
                                    <li class="navbar-item <?= ($file_name == "jobs") ? 'active' : '';?>"><a href="<?= base_url()."jobs";?>"><?= ($lang == "eng") ? $lang_con[152]['lang_eng'] : $lang_con[152]['lang_arabic']; ?></a></li>
    							    <li class="navbar-item <?= ($file_name == "appointment") ? 'active' : '';?>"><a href="<?= base_url(); ?>appointment"><?= ($lang == "eng") ? $lang_con[8]['lang_eng'] : $lang_con[8]['lang_arabic']; ?></a></li>
            					</ul>
      					        <?php
      					    }
      					    else
      					    {
      					        ?>
        					    <ul class="wsmenu-list" >
    							    <li class="navbar-item <?= ($file_name == "appointment") ? 'active' : '';?>"><a href="<?= base_url(); ?>appointment"><?= ($lang == "eng") ? $lang_con[8]['lang_eng'] : $lang_con[8]['lang_arabic']; ?></a></li>
    								<li class="navbar-item <?= ($file_name == "jobs") ? 'active' : '';?>"><a href="<?= base_url()."jobs";?>"><?= ($lang == "eng") ? $lang_con[152]['lang_eng'] : $lang_con[152]['lang_arabic']; ?></a></li>
    							    <li>
    					          	    <a class="navbar-item <?= ($file_name == "Patient Resource") ? 'active' : '';?>" href="#"><?= ($lang == "eng") ? $lang_con[169]['lang_eng'] : $lang_con[169]['lang_arabic']; ?></a>
                						<div class="wsmegamenu clearfix">
                 							<div class="container">
                   								<div class="row">
                   								    <?php
                   								    $sql = query("SELECT * FROM tbl_resources where resource_active = 1");
                   								    $i = 0;
                   								    while($dptData = fetch($sql))
                   								    {
                   								        $i++;
               								            ?>
               								            <ul class="col-lg-3 col-md-12 col-xs-12 link-list">
               								                <li><a href="<?= base_url().$dptData['resource_slug']?>"><?= ($lang == "eng") ? $dptData['resource_name'] : $dptData['resource_name_arabic'] ;?></a></li>
               								            </ul>
               								            <?php
                   								    }
                   								    ?>
    							                </div>
    							            </div>
    							        </div>
    							    </li>
    							    <li class="navbar-item <?= ($file_name == "cme-training") ? 'active' : '';?>"><a href="<?= base_url()."cme";?>"><?= ($lang == "eng") ? $lang_con[167]['lang_eng'] : $lang_con[167]['lang_arabic']; ?></a></a></li>
    					          	<li class="navbar-item <?= ($file_name == "all-doctors") ? 'active' : '';?>"><a href="<?= base_url(); ?>doctors"><?= ($lang == "eng") ? $lang_con[4]['lang_eng'] : $lang_con[4]['lang_arabic']; ?></a></a></li>
    					          	<li class="navbar-item <?= ($file_name == "all-clinic") ? 'active' : '';?>"><a href="<?= base_url(); ?>clinics"><?= ($lang == "eng") ? $lang_con[17]['lang_eng'] : $lang_con[17]['lang_arabic']; ?></a></a></li>
    					          	<li>
    					          	    <a class="navbar-item <?= ($file_name == "department") ? 'active' : '';?>" href="#"><?= ($lang == "eng") ? $lang_con[3]['lang_eng'] : $lang_con[3]['lang_arabic']; ?></a>
                						<div class="wsmegamenu clearfix">
                 							<div class="container">
                   								<div class="row">
                   								    <?php
                   								    $sql = query("SELECT * FROM tbl_department where dpt_active = 1");
                   								    $i = 0;
                   								    while($dptData = fetch($sql))
                   								    {
                   								        $i++;
               								            ?>
               								            <ul class="col-lg-3 col-md-12 col-xs-12 link-list">
               								                <li><a href="<?= base_url().$dptData['dpt_slug']?>"><?= ($lang == "eng") ? $dptData['dpt_name'] : $dptData['dpt_name_arabic'] ;?></a></li>
               								            </ul>
               								            <?php
                   								    }
                   								    ?>
    							                </div>
    							            </div>
    							        </div>
    							    </li>
    					        	<li class="navbar-item <?= ($file_name == "home") ? 'active' : '';?>"><a href="<?= base_url();?>home"><?= ($lang == "eng") ? $lang_con[1]['lang_eng'] : $lang_con[1]['lang_arabic']; ?></a></li>	
            					</ul>
      					        <?php
      					    }
      					    ?>
        				</nav>
    				</div>
    			</div>
			</header>
