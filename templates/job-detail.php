<?php
if(isset($_GET['slug']) && $_GET['slug'] != "" && $_GET['slug'] != null)
{
    $slug = $_GET['slug'];
    $sql = query("SELECT * FROM tbl_job WHERE job_slug = '$slug'");
    if(nrows($sql) > 0)
    {
        $doc                = fetch($sql);
        $meta_title         = $doc['job_meta_title'];
        $meta_title_ar      = $doc['job_meta_title_ar'];
        $meta_keyword       = $doc['job_meta_tag'];
        $meta_keyword_ar    = $doc['job_meta_tag_ar'];
        $meta_desc          = $doc['job_meta_desc'];
        $meta_desc_ar       = $doc['job_meta_desc_ar'];
        include 'header.php';
        ?>
        <style>
            .doctor-info{
                margin-top:0px;
            }
            .doctor-photo-btn{
                padding-top:10px;
            }
        </style>
        <div id="breadcrumb" class="division">
        	<div class="container" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
        		<div class="row">						
        			<div class="col">
        				<div class=" breadcrumb-holder">
        					<nav aria-label="breadcrumb">
        					  	<ol class="breadcrumb">
        					    	<li class="breadcrumb-item"><a href="<?= base_url();?>"><?= ($lang == "eng") ? $lang_con[1]['lang_eng'] : $lang_con[1]['lang_arabic']; ?></a></li>
        					    	<li class="breadcrumb-item active" aria-current="page"><?= ($lang == "eng") ? $lang_con[152]['lang_eng'] : $lang_con[152]['lang_arabic']; ?></li>
        					  	</ol>
        					</nav>
        					<h4 class="h4-sm steelblue-color"><?= ($lang == "eng") ? $doc['job_title'] : $doc['job_title_ar'];?></h4>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
        <section id="doctor-1-details" class="doctor-details-section division">	
        	<div class="container" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
        		<div class="row">
        			<div class="col-md-5">
        			    <br><br><br><br><br><br><br><br><br>
         				<div class="doctor-photo mb-40">
         					<img class="img-fluid" src="<?= file_url().$doc['job_icon'];?>" alt="doctor-profile">
         					<div class="doctor-info">
        						<table class="table table-striped">
        							<tbody>
        							    <tr>
        							        <td colspan="2" class="text-center">
        							            <h5 class="h2-xs text-center"><?= ($lang == "eng") ? $doc['job_title'] : $doc['job_title_ar'];?></h5>
        							            <p><?= ($lang == "eng") ? $doc['job_depart'] : $doc['job_depart_ar'];?></p>
        							            <p><?= ($lang == "eng") ? $doc['job_location'] : $doc['job_location_ar'];?></p>
        							        </td>
        							    </tr>
        							</tbody>
        						</table>
        					</div>
        					<div class="doctor-photo-btn text-center">
        						<a href="<?= base_url()."job-apply/".$slug;?>" class="btn btn-md btn-blue blue-hover"><?= ($lang == "eng") ? $lang_con[153]['lang_eng'] : $lang_con[153]['lang_arabic']; ?></a>
        					</div>
         				</div>
         			</div>
        			<div class="col-md-7">
        				<div class="doctor-bio">
         					<?= ($lang == "eng") ? $doc['job_desc'] : $doc['job_desc_ar']; ?>
        				</div>
        			</div>
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