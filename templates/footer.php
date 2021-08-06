    <?php
    $siteData = get_site_data();
    ?>
    <footer id="footer-3" class="wide-40 footer division" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
    	<div class="container">
    		<div class="row">
    			<div class="col-md-6 col-lg-3">
    				<div class="footer-info mb-40" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
    					<a href="<?= base_url();?>"><img src="<?= file_url().$siteData['site_logo_footer'];?>" width="180" height="40" alt="footer-logo"></a>
    					<p class="p-sm mt-20"><?= ($lang == "eng") ? $siteData['footer_text'] : $siteData['footer_text_arabic']; ?>
    					</p>
    					<div class="footer-socials-links mt-20">
    						<ul class="foo-socials text-center clearfix">
    							<li><a target="_blank" href="<?= $siteData['site_facebook'];?>" class="ico-facebook"><i class="fab fa-facebook-f"></i></a></li>
    							<li><a target="_blank" href="<?= $siteData['site_twitter'];?>" class="ico-twitter"><i class="fab fa-twitter"></i></a></li>	
    							<li><a target="_blank" href="<?= $siteData['site_google'];?>" class="ico-google-plus"><i class="fab fa-google-plus-g"></i></a></li>
    							<li><a target="_blank" href="<?= $siteData['site_linkedin'];?>" class="ico-linkedin-in"><i class="fab fa-linkedin-in"></i></a></li>
    						</ul>									
    					</div>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-3 offset-lg-1">
    				<div class="footer-box mb-40" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
    					<h5 class="h5-xs"><?= ($lang == "eng") ? $lang_con[13]['lang_eng'] : $lang_con[13]['lang_arabic']; ?></h5>
    					<p><?= ($lang == "eng") ? $siteData['site_address'] : $siteData['site_address_arabic']; ?></p>
    					<p class="foo-email mt-20"><?= ($lang == "eng") ? $lang_con[99]['lang_eng'] : $lang_con[99]['lang_arabic']; ?>: <a href="mailto:<?= $siteData['site_email'];?>"><?= $siteData['site_email'];?></a></p>
    					<p><?= ($lang == "eng") ? $lang_con[82]['lang_eng'] : $lang_con[82]['lang_arabic']; ?>: <?= ($lang == "eng") ? $siteData['site_phone'] : $siteData['site_phone_arabic']; ?></p>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-2">
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
    			<div class="col-md-6 col-lg-2">
    				<div class="footer-links mb-40" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
    					<h5 class="h5-xs"><?= ($lang == "eng") ? $lang_con[149]['lang_eng'] : $lang_con[149]['lang_arabic']; ?></h5>
    					<ul class="clearfix">
    					    <li><a href="<?= base_url();?>classified"> <?= ($lang == "eng") ? $lang_con[204]['lang_eng'] : $lang_con[204]['lang_arabic']; ?></a></li>
    					    <li><a href="<?= base_url();?>professionals"> <?= ($lang == "eng") ? $lang_con[207]['lang_eng'] : $lang_con[207]['lang_arabic']; ?></a></li>
    					    <li><a href="<?= base_url();?>course"> <?= ($lang == "eng") ? $lang_con[176]['lang_eng'] : $lang_con[176]['lang_arabic']; ?></a></li>
    					    <li><a href="<?= base_url();?>organizations"> <?= ($lang == "eng") ? $lang_con[225]['lang_eng'] : $lang_con[225]['lang_arabic']; ?></a></li>
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