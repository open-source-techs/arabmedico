<?php
if(isset($_GET['slug']) && $_GET['slug'] != "" && $_GET['slug'] != null)
{
    $slug = $_GET['slug'];
    include 'header.php';
    $sql = query("SELECT * FROM tbl_candidate c JOIN tbl_candiate_speciality cs ON (c.candidate_department = cs.can_speciality_id) WHERE candidate_active = 1 AND candidate_slug = '$slug'");
    if(nrows($sql) > 0)
    {
        $doc = fetch($sql);
        $docID = $doc['candidate_id'];
        ?>
        <style>
            #doctor-breadcrumbs{
                background-image : url('<?= base_url().$doc['candidate_banner']?>');
            }
            .doctor-photo-btn{
                padding-top:10px;
            }
            .doctor-info{
                margin-top: 20px;
            }
        </style>
        <section id="doctor-breadcrumbs" class="bg-fixed doctor-details-section division">	
        	<div class="container">
        		<div class="row">
        			<div class="col-md-7 offset-md-5">
         				<div class="doctor-data white-color">
         					
        				</div>
        			</div>
        		</div>
        	</div>
        </section>
        <section id="doctor-1-details" class="doctor-details-section division">	
        	<div class="container" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
        		<div class="row">
        			<div class="col-md-5">
        			    <br><br><br><br><br><br><br><br><br>
         				<div class="doctor-photo mb-40">
         					<img class="img-fluid" src="<?= file_url().$doc['candidate_image'];?>" alt="doctor-profile">
         					<div class="doctor-info mt-2 mb-2 p-1">
                                <div style="font-size:18px; text-align:center; padding:5px;">
                                    <span style="font-size:18px; color:#148c82"> 0 View(s)</span>
                                </div>
                                <div class="doctor-photo-btn text-center">
            						<a href="<?= base_url()."contact-professional/".$slug;?>" class="btn btn-md btn-blue blue-hover"><?= ($lang == "eng") ? $lang_con[183]['lang_eng'] : $lang_con[183]['lang_arabic']; ?> <?= ($lang == "eng") ? $lang_con[207]['lang_eng'] : $lang_con[207]['lang_arabic']; ?></a>
            					</div>
            				</div>
         					<div class="doctor-info">
        						<table class="table table-striped">
        							<tbody>
        							    <tr>
        							        <td colspan="2" class="text-center">
        							            <h5 class="h2-xs text-center"><?= ($lang == "eng") ? $doc['candidate_name'] : $doc['candidate_name_ar'];?></h5>
        							            <p><?= ($lang == "eng") ? $doc['candidate_degree'] : $doc['candidate_degree_ar'];?></p>
        							        </td>
        							    </tr>
        							    <tr>
        							        <td><?= ($lang == "eng") ? $lang_con[206]['lang_eng'] : $lang_con[206]['lang_arabic']; ?>: </td>
        							        <td><p><?= ($lang == "eng") ? $doc['can_speciality_name'] : $doc['can_speciality_name_ar'];?></p></td>
        							    </tr>
        							    <tr>
        							        <td><?= ($lang == "eng") ? $lang_con[208]['lang_eng'] : $lang_con[208]['lang_arabic']; ?>: </td>
        							        <td><p><?= ($lang == "eng") ? $doc['candidate_job'] : $doc['candidate_job_ar'];?></p></td>
        							    </tr>
        							    <tr>
        							        <td><?= ($lang == "eng") ? $lang_con[209]['lang_eng'] : $lang_con[209]['lang_arabic']; ?>: </td>
        							        <td><p><?= ($lang == "eng") ? $doc['candidate_industry'] : $doc['candidate_industry_ar'];?></p></td>
        							    </tr>
        							    <tr>
        							        <td><?= ($lang == "eng") ? $lang_con[99]['lang_eng'] : $lang_con[99]['lang_arabic']; ?>: </td>
        							        <td><p><?= ($lang == "eng") ? $doc['candidate_email'] : $doc['candidate_email'];?></p></td>
        							    </tr>
        							    <tr>
        							        <td><?= ($lang == "eng") ? $lang_con[82]['lang_eng'] : $lang_con[82]['lang_arabic']; ?>: </td>
        							        <td><p><?= ($lang == "eng") ? $doc['candidate_phone'] : $doc['candidate_phone_ar'];?></p></td>
        							    </tr>
        							    <tr>
        							        <td><?= ($lang == "eng") ? $lang_con[210]['lang_eng'] : $lang_con[210]['lang_arabic']; ?>: </td>
        							        <td><p><?= ($lang == "eng") ? $doc['candiate_nationality'] : $doc['candiate_nationality_ar'];?></p></td>
        							    </tr>
        							    <tr>
        							        <td><?= ($lang == "eng") ? $lang_con[211]['lang_eng'] : $lang_con[211]['lang_arabic']; ?>: </td>
        							        <td><p><?= ($lang == "eng") ? $doc['candidate_gender'] : $doc['candidate_gender_ar'];?></p></td>
        							    </tr>
        							    <tr>
        							        <td><?= ($lang == "eng") ? $lang_con[212]['lang_eng'] : $lang_con[212]['lang_arabic']; ?>: </td>
        							        <td><p><?= ($lang == "eng") ? $doc['candidate_visa'] : $doc['candidate_visa_ar'];?></p></td>
        							    </tr>
        							</tbody>
        						</table>
        					</div>
        					<!--<div class="doctor-photo-btn text-center">-->
        					<!--	<a href="<?= base_url()."appointment";?>&dep=<?= $doc['doctor_department']; ?>&doc=<?= $doc['doc_id'];?>" class="btn btn-md btn-blue blue-hover"><?= ($lang == "eng") ? $lang_con[113]['lang_eng'] : $lang_con[113]['lang_arabic']; ?></a>-->
        					<!--</div>-->
         				</div>
         			</div>
        			<div class="col-md-7">
        				<div class="doctor-bio">
         					<?= ($lang == "eng") ? htmlspecialchars_decode(html_entity_decode($doc['candiadate_resume'])) : htmlspecialchars_decode(html_entity_decode($doc['candiadate_resume_ar'])); ?>
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