<?php
if(isset($_GET['slug']) && $_GET['slug'] != "" && $_GET['slug'] != null)
{
    $slug = $_GET['slug'];
    include 'header.php';
    $sql = query("SELECT * FROM tbl_candidate WHERE candidate_active = 1 AND candidate_slug = '$slug'");
    if(nrows($sql) > 0)
    {
        $candidate = fetch($sql);
        $candidateID = $candidate['candidate_id'];
        ?>
        <style>
            #doctor-breadcrumbs{
                background-image : url('<?= base_url().$candidate['candidate_banner']?>');
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
         					<img class="img-fluid" src="<?= file_url().$candidate['candidate_image'];?>" alt="doctor-profile">
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
        							            <h5 class="h2-xs text-center"><?= ($lang == "eng") ? $candidate['candidate_name'] : $candidate['candidate_name_ar'];?></h5>
        							            <p><?= ($lang == "eng") ? $candidate['candidate_degree'] : $candidate['candidate_degree_ar'];?></p>
        							        </td>
        							    </tr>
        							    <tr>
        							        <td><?= ($lang == "eng") ? $lang_con[206]['lang_eng'] : $lang_con[206]['lang_arabic']; ?>: </td>
        							        <td><p>
                                                <?php
                                                $specSql = query("SELECT * FROM tbl_can_speciality cs JOIN tbl_candiate_speciality s ON (cs.can_speciality = s.can_speciality_id) WHERE can_spec_can = $candidateID");
                                                while($spec = fetch($specSql))
                                                {
                                                    echo ($lang == "eng") ? $spec['can_speciality_name'] : $spec['can_speciality_name_ar'];
                                                    echo ",";
                                                }
                                                ?>
                                                </p>
                                            </td>
        							    </tr>
        							    <tr>
        							        <td><?= ($lang == "eng") ? $lang_con[208]['lang_eng'] : $lang_con[208]['lang_arabic']; ?>: </td>
        							        <td><p><?= ($lang == "eng") ? $candidate['candidate_job'] : $candidate['candidate_job_ar'];?></p></td>
        							    </tr>
        							    <tr>
        							        <td><?= ($lang == "eng") ? $lang_con[209]['lang_eng'] : $lang_con[209]['lang_arabic']; ?>: </td>
        							        <td><p><?= ($lang == "eng") ? $candidate['candidate_industry'] : $candidate['candidate_industry_ar'];?></p></td>
        							    </tr>
        							    <tr>
        							        <td><?= ($lang == "eng") ? $lang_con[99]['lang_eng'] : $lang_con[99]['lang_arabic']; ?>: </td>
        							        <td><p><?= ($lang == "eng") ? $candidate['candidate_email'] : $candidate['candidate_email'];?></p></td>
        							    </tr>
        							    <tr>
        							        <td><?= ($lang == "eng") ? $lang_con[82]['lang_eng'] : $lang_con[82]['lang_arabic']; ?>: </td>
        							        <td><p><?= ($lang == "eng") ? $candidate['candidate_phone'] : $candidate['candidate_phone_ar'];?></p></td>
        							    </tr>
        							    <tr>
        							        <td><?= ($lang == "eng") ? $lang_con[210]['lang_eng'] : $lang_con[210]['lang_arabic']; ?>: </td>
        							        <td><p><?= ($lang == "eng") ? $candidate['candiate_nationality'] : $candidate['candiate_nationality_ar'];?></p></td>
        							    </tr>
        							    <tr>
        							        <td><?= ($lang == "eng") ? $lang_con[211]['lang_eng'] : $lang_con[211]['lang_arabic']; ?>: </td>
        							        <td><p><?= ($lang == "eng") ? $candidate['candidate_gender'] : $candidate['candidate_gender_ar'];?></p></td>
        							    </tr>
        							    <tr>
        							        <td><?= ($lang == "eng") ? $lang_con[212]['lang_eng'] : $lang_con[212]['lang_arabic']; ?>: </td>
        							        <td><p><?= ($lang == "eng") ? $candidate['candidate_visa'] : $candidate['candidate_visa_ar'];?></p></td>
        							    </tr>
        							</tbody>
        						</table>
        					</div>
        					<!--<div class="doctor-photo-btn text-center">-->
        					<!--	<a href="<?= base_url()."appointment";?>&dep=<?= $candidate['doctor_department']; ?>&doc=<?= $candidate['doc_id'];?>" class="btn btn-md btn-blue blue-hover"><?= ($lang == "eng") ? $lang_con[113]['lang_eng'] : $lang_con[113]['lang_arabic']; ?></a>-->
        					<!--</div>-->
         				</div>
         			</div>
        			<div class="col-md-7">
        				<div class="doctor-bio">
         					<?= ($lang == "eng") ? htmlspecialchars_decode(html_entity_decode($candidate['candiadate_resume'])) : htmlspecialchars_decode(html_entity_decode($candidate['candiadate_resume_ar'])); ?>
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