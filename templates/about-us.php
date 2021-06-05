<?php
include 'header.php';
?>
<div id="breadcrumb" class="division">
	<div class="container"  <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
		<div class="row">						
			<div class="col">
				<div class=" breadcrumb-holder">
					<nav aria-label="breadcrumb">
					  	<ol class="breadcrumb">
					    	<li class="breadcrumb-item"><a href="<?= base_url()."home".$pram;?>"><?= ($lang == "eng") ? $lang_con[1]['lang_eng'] : $lang_con[1]['lang_arabic']; ?></a></li>
					    	<li class="breadcrumb-item active" aria-current="page"><?= ($lang == "eng") ? $lang_con[2]['lang_eng'] : $lang_con[2]['lang_arabic']; ?></li>
					  	</ol>
					</nav>
					<h4 class="h4-sm steelblue-color"><?= ($lang == "eng") ? $lang_con[2]['lang_eng'] : $lang_con[2]['lang_arabic']; ?></h4>
				</div>
			</div>
		</div>
	</div>
</div>
<section id="info-4" class="wide-100 info-section division">
	<div class="container" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important";text-align:right' ;?>>
	    <?= ($lang == "eng") ? html_entity_decode(htmlspecialchars_decode($siteData['about_us'])) : $siteData['about_us_arabic']; ?>
	</div>
</section>
<?php
include 'footer.php';
?>