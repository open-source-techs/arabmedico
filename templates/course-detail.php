<?php
if(isset($_GET['slug']) && $_GET['slug'] != "" && $_GET['slug'] != null)
{
    $slug = $_GET['slug'];
    
    $sql = query("SELECT * FROM tbl_course WHERE course_slug = '$slug'");
    if(nrows($sql) > 0)
    {
        $cme                = fetch($sql);
        $meta_title         = $cme['course_meta_title'];
        $meta_title_ar      = $cme['course_meta_title_ar'];
        $meta_keyword       = $cme['course_meta_tag'];
        $meta_keyword_ar    = $cme['course_meta_tag_ar'];
        $meta_desc          = $cme['course_meta_desc'];
        $meta_desc_ar       = $cme['course_meta_desc_ar'];
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
        					    	<li class="breadcrumb-item active" aria-current="page"><?= ($lang == "eng") ? $lang_con[167]['lang_eng'] : $lang_con[167]['lang_arabic']; ?></li>
        					  	</ol>
        					</nav>
        					<h4 class="h4-sm steelblue-color"><?= ($lang == "eng") ? $cme['course_topic'] : $cme['course_ar_topic'];?></h4>
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
         					<img class="img-fluid" src="<?= file_url().$cme['course_icon'];?>" alt="doctor-profile">
         					<div class="doctor-info">
        						<table class="table table-striped">
        							<tbody>
        							    <tr>
        							        <td colspan="2" class="text-center">
        							            <h5 class="h2-xs text-center"><?= ($lang == "eng") ? $cme['course_topic'] : $cme['course_ar_topic'];?></h5>
        							            <p><?= ($lang == "eng") ? $cme['course_depart'] : $cme['course_ar_depart'];?></p>
        							            <p><?= ($lang == "eng") ? $cme['course_loc'] : $cme['course_ar_loc'];?></p>
        							        </td>
        							    </tr>
        							</tbody>
        						</table>
        					</div>
        					<div class="doctor-photo-btn text-center">
        						<a href="<?= base_url()."course-apply/".$slug;?>" class="btn btn-md btn-blue blue-hover"><?= ($lang == "eng") ? $lang_con[153]['lang_eng'] : $lang_con[153]['lang_arabic']; ?></a>
        					</div>
         				</div>
         			</div>
        			<div class="col-md-7">
        				<div class="doctor-bio">
         					<?= ($lang == "eng") ? $cme['course_des'] : $cme['course_ar_des']; ?>
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