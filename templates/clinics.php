<?php
include 'header.php';
?>
<div id="breadcrumb" class="division">
	<div class="container" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
		<div class="row">						
			<div class="col">
				<div class=" breadcrumb-holder">
					<nav aria-label="breadcrumb">
					  	<ol class="breadcrumb">
					    	<li class="breadcrumb-item"><a href="<?= base_url();?>"><?= ($lang == "eng") ? $lang_con[1]['lang_eng'] : $lang_con[1]['lang_arabic']; ?></a></li>
					    	<li class="breadcrumb-item active" aria-current="page"><?= ($lang == "eng") ? $lang_con[89]['lang_eng'] : $lang_con[89]['lang_arabic']; ?></li>
					  	</ol>
					</nav>
					<h4 class="h4-sm steelblue-color"><?= ($lang == "eng") ? $lang_con[89]['lang_eng'] : $lang_con[89]['lang_arabic']; ?></h4>
				</div>
			</div>
		</div>
	</div>		
</div>
<style>
    .img-holder{
        padding-top:100%;
    }
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
    	position: relative;
    }
    .feature-wrapper{
    	width: 99%;
	    background: #00a3c8;
	    position: absolute;
	    z-index: 9;
	    padding: 10px 20px;
	    border-radius: 0px;
	    top: -30px;
	    left: 1px;
    }
    .feature-wrapper p{
    	font-size: 15px !important;
	    margin: 0px !important;
	    color: white;
    }
</style>
<section id="doctors-3" class="bg-lightgrey wide-60 doctors-section division">
	<div class="container">
		<div class="row">
		    <?php
		    $sql = query("SELECT * FROM tbl_clinic WHERE clinic_active = 1");
		    while($doc = fetch($sql))
		    {
		    	$currentDate = date('Y-m-d');
		    	$clinicID = $doc['clinic_id'];
		    	$fsql = query("SELECT * FROM tbl_feature_clinic WHERE f_clinic_id = $clinicID AND f_list = 'yes' AND  f_end_date >= '$currentDate' AND f_active = 1");
		        ?>
    			<div class="col-md-6 col-lg-4">
    				<div class="doctor-2">
    					<?php 
    					if(nrows($fsql) > 0)
    					{
    						?>
    						<div class="feature-wrapper">
	    						<p>FEATURED</p>
	    					</div>
    						<?php
    					}
    					?>
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
				    $sql = query("SELECT * FROM tbl_advertisment WHERE add_location = 'clinics' AND add_status = 1 ORDER BY rand()");
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
    							<div class="quote"><img src="<?= base_url();?>images/quote.png" alt="quote-img" /></div>
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
<?php include 'footer.php'; ?>
<script>
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
	$(document).ready(function(){
	    $(".close-button").click(function(e){
	        e.preventDefault();
	        var addID = $(this).attr('data-add-id');
	        $("#"+addID).hide();
	    });
	});
</script>