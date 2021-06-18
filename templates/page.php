<?php
if(isset($_GET['slug']) && $_GET['slug'] != "" && $_GET['slug'] != null)
{
    $slug = $_GET['slug'];
    $sql = query("SELECT * FROM tbl_pages WHERE page_active = 1 AND page_slug = '$slug'");
    if(nrows($sql) > 0)
    {
        $page = fetch($sql);
        $meta_title         = $page['page_title'];
        $meta_title_ar      = $page['page_title_arabic'];
        $meta_keyword       = $page['page_meta_tag'];
        $meta_keyword_ar    = $page['page_meta_tag_arabic'];
        $meta_desc          = $page['page_meta_desc'];
        $meta_desc_ar       = $page['page_meta_desc_arabic'];
        include 'header.php';
        ?>
        <div id="breadcrumb" class="division">
        	<div class="container" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
        		<div class="row">						
        			<div class="col">
        				<div class=" breadcrumb-holder">
        					<nav aria-label="breadcrumb">
        					  	<ol class="breadcrumb">
        					    	<li class="breadcrumb-item"><a href="<?= base_url()."home".$pram;?>"><?= ($lang == "eng") ? $lang_con[1]['lang_eng'] : $lang_con[1]['lang_arabic']; ?></a></li>
        					    	<li class="breadcrumb-item active" aria-current="page"><?= ($lang == "eng") ? $lang_con[37]['lang_eng'] : $lang_con[37]['lang_arabic']; ?></li>
        					  	</ol>
        					</nav>
        					<h4 class="h4-sm steelblue-color"><?= ($lang == "eng") ? $page['page_name'] : $page['page_name_arabic']; ?></h4>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
        <section id="info-4" class="wide-100 info-section division">
        	<div class="container">
        	    <div class="text-data">
            	    <?= ($lang == "eng") ? html_entity_decode($page['page_data']) : html_entity_decode($page['page_data_arabic']); ?>
        	    </div>
        	</div>
        </section>
        <?php
        include 'footer.php';
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