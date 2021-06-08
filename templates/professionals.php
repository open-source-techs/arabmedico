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
					    	<li class="breadcrumb-item active" aria-current="page"><?= ($lang == "eng") ? $lang_con[207]['lang_eng'] : $lang_con[207]['lang_arabic']; ?></li>
					  	</ol>
					</nav>
					<h4 class="h4-sm steelblue-color"><?= ($lang == "eng") ? $lang_con[207]['lang_eng'] : $lang_con[207]['lang_arabic']; ?></h4>
				</div>
			</div>
		</div>
	</div>		
</div>
<style>
    .img-holder{
        padding-top:100%;
    }
    .select-boxes{
        margin:10px;
    }
    .search-widget{
        width: 100%;
        float: left;
        margin: 0 0 30px;
    }
    .search-widget h3{
        width: 100%;
        float: left;
        margin: 0;
        color: #fff;
        padding: 20px;
        font-size: 16px;
        line-height: 16px;
        background: #505050;
        text-transform: uppercase;
    }
    .widget-form{
        padding:15px;
        width: 100%;
        float: left;
    }
    .widget-form .form-control{
        width: 100%;
        display: block;
        position: relative;
        height: 60px;
        outline: none;
        background: #fff;
        padding: 18px;
        box-shadow: none;
        border-radius: 0;
        display: inline-block;
        vertical-align: middle;
        border: 1px solid #ddd;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        margin-bottom: 15px;
    }
    .widget-form button{
        background: none !important;
        font-size:24px;
        padding:0px;
        width:100% !important;
        border-color: #3498db;
        border: 2px solid;
        color: #5d5955;
        padding: 0 35px;
        text-align: center;
        display: inline-block;
        vertical-align: middle;
        text-transform: uppercase;
        z-index: 2;
        position: relative;
        overflow: hidden;
        font-family:'Montserrat', Arial, Helvetica, sans-serif;
    }
</style>
<section id="doctors-3" class="bg-lightgrey wide-60 doctors-section division">
	<div class="container">
		<div class="row">
		    <div class="col-md-4">
		        <div class="sidebar <?= ($lang == "eng") ? 'text-left' : 'text-right'; ?>">
		            <div class="search-widget" style="background:#bbeefb">
		                <h3 style="background-color:#3498db; font-weight:bold"><?= ($lang == "eng") ? $lang_con[213]['lang_eng'] : $lang_con[213]['lang_arabic']; ?></h3>
		                <div class="row">
                            <form class="widget-form" id="refinddoctors" action="" method="post">
                                <div class="col-md-12" id="specialityDiv">
                                    <select class="form-control" id="speciality" name="speciality">
                                        <option value="" disabled selected><?= ($lang == "eng") ? $lang_con[120]['lang_eng'] : $lang_con[120]['lang_arabic']; ?> <?= ($lang == "eng") ? $lang_con[206]['lang_eng'] : $lang_con[206]['lang_arabic']; ?></option>
                                        <?php
                                        $sql = query('SELECT * FROM tbl_candiate_speciality WHERE can_speciality_active = 1');
                                        while($spc = fetch($sql))
                                        {
                                            ?>
                                            <option <?= (isset($_POST['speciality']) && $_POST['speciality'] != "" && $_POST['speciality'] == $spc['can_speciality_id']) ? 'selected' : ''; ?> value="<?= $spc['can_speciality_id']; ?>"><?= ($lang == "eng") ? $spc['can_speciality_name'] : $spc['can_speciality_name_ar']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <select class="form-control" id="city" name="city">
                                        <option value="" disabled selected><?= ($lang == "eng") ? $lang_con[202]['lang_eng'] : $lang_con[202]['lang_arabic']; ?></option>
                                        <?php
                                        $sql = query("SELECT * FROM tbl_candidate_country WHERE country_active = 1");
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <option <?= (isset($_POST['city']) && $_POST['city'] != "" && $_POST['city'] == $row['country_id']) ? 'selected' : ''; ?> value="<?= $row['country_id'];?>"><?= ($lang == "eng") ? $row['country_name'] : $row['country_name_ar']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-xs-12">
									<button type="submit" name="btn_search" class="tg-btn"><?= ($lang == "eng") ? $lang_con[174]['lang_eng'] : $lang_con[174]['lang_arabic']; ?></button>
								</div>
                            </form>
                        </div>
		            </div>
		        </div>
		    </div>
		    <div class="col-md-8">
		        <div class="row">
		            <?php
		            $doc_where = "";
		            if($_SERVER['REQUEST_METHOD'] == "POST")
		            {
		                if(isset($_POST['city']) && $_POST['city'] != "")
		                {
		                    $city = $_POST['city'];
		                    $doc_where = "AND c.candidate_country = ".$city;   
		                }
		                if(isset($_POST['speciality']) && $_POST['speciality'] != "")
		                {
		                    $speciality = $_POST['speciality'];
		                    $sql = query("SELECT * FROM tbl_candidate c JOIN tbl_candiate_speciality cs ON (cs.can_speciality_id = c.candidate_department) WHERE c.candidate_department = $speciality $doc_where");
		                    
		                }
		                else
		                {
		                    $sql = query("SELECT * FROM tbl_candidate WHERE candidate_active = 1 $doc_where");
		                }
		            }
		            else
		            {
		                $sql = query("SELECT * FROM tbl_candidate WHERE candidate_active = 1");
		            }
		            // echo $sqlEcho;
        		    while($doc = fetch($sql))
        		    {
        		        ?>
            			<div class="col-md-6 col-lg-6">
            				<div class="doctor-2">
            					<div class="hover-overlay img-holder"> 
            						<img class="img-fluid" src="<?= file_url().$doc['candidate_image'];?>" alt="candidate-image">	
            					</div>
            					<div class="doctor-meta">
            						<h5 class="h5-xs blue-color"><?= ($lang == "eng") ? $doc['candidate_name'] : $doc['candidate_name_ar']; ?></h5>
            						<span><?= ($lang == "eng") ? $doc['candidate_job'] : $doc['candidate_job_ar']; ?></span>
            						<a class="btn btn-sm btn-blue blue-hover mt-15" href="<?= base_url().$doc['candidate_slug'];?>" title=""><?= ($lang == "eng") ? $lang_con[90]['lang_eng'] : $lang_con[90]['lang_arabic']; ?></a>
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
    function searchbyType(type)
    {
        if(type == 'speciality')
        {
            $("#specialityDiv").show();
            $("#conditionDiv").hide();
        }
        else if(type == 'condition')
        {
            $("#specialityDiv").hide();
            $("#conditionDiv").show();
        }
    }
</script>