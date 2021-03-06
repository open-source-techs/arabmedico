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
    .feature-wrapper{
        width: 90%;
        background: #00a3c8;
        position: absolute;
        z-index: 9;
        padding: 10px 20px;
        border-radius: 0px;
        top: -30px;
        left: 19px;
    }
    .feature-wrapper p{
        font-size: 15px !important;
        margin: 0px !important;
        color: white;
    }
    .tg-tab-widget {
        background: #f7f7f7;
        margin: 0;
    }
    .tg-widget > h3 {
        width: 100%;
        float: left;
        color: #fff;
        padding: 20px;
        font-size: 16px;
        line-height: 16px;
        background: #505050;
        text-transform: uppercase;
        background-color: #3498db;
        font-weight: bold;
    }
    .tg-tabwidet-content {
        width: 100%;
        float: left;
        padding: 30px;
        background: #fff;
    }
    .tg-widget ul {
        width: 100%;
        float: left;
        padding: 10px 0 0;
        list-style: none;
        line-height: 20px;
    }
    .tg-tab-widget .tg-tab-pane ul {
        padding: 0;
        margin: 0 0 -20px 0;
        list-style: none;
    }
    .tg-tab-widget .tg-tab-pane ul li {
        width: 100%;
        float: left;
        padding: 20px 0;
        list-style-type: none;
        line-height: 28px;
    }
    .tg-widget ul li figure {
        float: left;
        margin: 0 20px 0 0;
        border: 1px solid #ddd;
    }
    .tg-widget ul li figure a img {
        display: block;
        height: 80px;
    }
    .tg-tab-widget ul li .tg-description {
        overflow: hidden;
        float: none;
        width: auto;
        font-size: 14px;
        line-height: 17px;
        margin: 3px 0 0 0;
    }
    .tg-tab-widget .tab-content h3 {
        font-size: 14px;
        line-height: 14px;
        color: #5d5955;
        margin: 0 0 5px;
    }
    .tg-tab-widget .tab-content em {
        font-style: normal;
        font-size: 14px;
        line-height: 14px;
        display: block;
        margin: 0 0 7px;
    }
    .tg-tab-widget .tab-content .tg-stars {
        float: left;
        width: 100%;
        text-align: left;
        padding: 0;
    }
</style>
<section id="doctors-3" class="bg-lightgrey wide-60 doctors-section division">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="sidebar <?= ($lang == "eng") ? 'text-left' : 'text-right'; ?>">
                    <div class="search-widget" style="background:#bbeefb">
                        <h3 style="background-color:#3498db; font-weight:bold"><?= ($lang == "eng") ? $lang_con[201]['lang_eng'] : $lang_con[201]['lang_arabic']; ?></h3>
                        <div class="row">
                            <form class="widget-form" id="refinddoctors" action="" method="post">
                                <div class="col-md-12">
                                    <select class="form-control" id="searchType" name="searchby" onChange="searchbyType(this.value);">
                                        <option value=""><?= ($lang == "eng") ? $lang_con[198]['lang_eng'] : $lang_con[198]['lang_arabic']; ?></option>
                                        <option value="speciality"><?= ($lang == "eng") ? $lang_con[199]['lang_eng'] : $lang_con[199]['lang_arabic']; ?></option>
                                        <option value="condition"><?= ($lang == "eng") ? $lang_con[200]['lang_eng'] : $lang_con[200]['lang_arabic']; ?></option>
                                    </select>
                                </div>
                                <div class="col-md-12" id="specialityDiv" style="display:none;">
                                    <select class="form-control" id="speciality" name="speciality">
                                        <option><?= ($lang == "eng") ? $lang_con[199]['lang_eng'] : $lang_con[199]['lang_arabic']; ?></option>
                                        <option value="" disabled selected><?= ($lang == "eng") ? $lang_con[120]['lang_eng'] : $lang_con[120]['lang_arabic']; ?> <?= ($lang == "eng") ? $lang_con[206]['lang_eng'] : $lang_con[206]['lang_arabic']; ?></option>
                                        <?php
                                        $sql = query('SELECT * FROM tbl_specialty WHERE specialty_status = 1');
                                        while($spc = fetch($sql))
                                        {
                                            ?>
                                            <option value="<?= $spc['specialty_id']; ?>"><?= ($lang == "eng") ? $spc['specialty_name'] : $spc['specialty_ar_name']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-12" id="conditionDiv" style="display:none;">
                                    <select class="form-control" name="treatment" id="source">
                                        <option value="">--- <?= ($lang == "eng") ? $lang_con[200]['lang_eng'] : $lang_con[200]['lang_arabic']; ?> ---</option>
                                        <?php
                                        $get_spec = query("SELECT * FROM tbl_specialty WHERE specialty_status = 1");
                                        while($specnw = fetch($get_spec))
                                        { 
                                            ?>
                                            <optgroup label="<?= ($lang == "eng") ? $specnw['specialty_name'] : $specnw['specialty_ar_name']; ?>">
                                                <?php $get_treats = query("SELECT * FROM tbl_treatment WHERE select_speciality = ".$specnw['specialty_id']);
                                                while($treat = fetch($get_treats))
                                                {
                                                    ?>
                                                    <option value="<?= $treat['treatment_id']; ?>"><?= ($lang == "eng") ? $treat['treatment_name'] : $treat['treatment_ar_name']; ?></option>
                                                <?php 
                                                }
                                                ?>
                                            </optgroup>
                                            <?php 
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <select class="form-control" id="city" name="city">
                                        <option><?= ($lang == "eng") ? $lang_con[202]['lang_eng'] : $lang_con[202]['lang_arabic']; ?></option>
                                        <?php
                                        $sql = query("SELECT * FROM tbl_country WHERE country_active = 1");
                                        while ($row = fetch($sql))
                                        {
                                            ?>
                                            <option <?= ($row['country_id'] == $doc['doc_country']) ? 'selected' : ''; ?> value="<?= $row['country_id'];?>"><?= ($lang == "eng") ? $row['country_name'] : $row['country_name_ar']; ?></option>
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
                    <div class="tg-widget tg-tab-widget">
                        <h3 style="background-color:#3498db; font-weight:bold">Featured Doctors</h3>
                        <div class="tg-tabwidet-content" style="margin-top:-20px">
                            <div class="tab-content">
                                <div class="tg-tab-pane">
                                    <ul>
                                    <?php
                                    $currentDate = date('Y-m-d');
                                    $sql = query("SELECT * FROM tbl_feature_doctor f JOIN  tbl_doctor d ON (f.f_doctor_id = d.doc_id) WHERE f_list = 'yes' AND  f_end_date >= '$currentDate' AND f_active = 1");
                                    while($doc = fetch($sql))
                                    {
                                        ?>
                                        <li>
                                            <figure>
                                                <a href="<?= base_url().$doc['doc_slug'];?>">
                                                    <img src="<?= file_url().$doc['doc_image'];?>" alt="<?= ($lang == "eng") ? $doc['doc_name'] : $doc['doc_name_arabic']; ?>">
                                                </a>
                                            </figure>
                                            <div class="tg-description">
                                                <h3><a href="<?= base_url().$doc['doc_slug'];?>"><?= ($lang == "eng") ? $doc['doc_name'] : $doc['doc_name_arabic']; ?></a></h3>
                                                <em><?= ($lang == "eng") ? $doc['doc_job_title'] : $doc['doc_job_title_arabic']; ?></em>
                                                <span class="tg-stars">
                                                    <i class="fa fa-star" style="color:#dddddd; margin-right:3px;"></i>
                                                    <i class="fa fa-star" style="color:#dddddd; margin-right:3px;"></i>
                                                    <i class="fa fa-star" style="color:#dddddd; margin-right:3px;"></i>
                                                    <i class="fa fa-star" style="color:#dddddd; margin-right:3px;"></i>
                                                    <i class="fa fa-star" style="color:#dddddd; margin-right:3px;"></i>
                                                </span>
                                            </div>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                    </ul>
                                </div>
                            </div>
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
                        if(isset($_POST['city']))
                        {
                            $city = $_POST['city'];
                            $doc_where = " d.doc_country = ".$city;   
                        }
                        if(isset($_POST['speciality']))
                        {
                            $speciality = $_POST['speciality'];
                          //  $sqlEcho = "SELECT * FROM tbl_doc_speciality s JOIN tbl_doctor d ON (s.doc_spec_doc = d.doc_id) WHERE s.doc_speciality = ".$speciality." OR ". $doc_where;
                            $sql = query("SELECT * FROM tbl_doc_speciality s JOIN tbl_doctor d ON (s.doc_spec_doc = d.doc_id) WHERE s.doc_speciality = $speciality AND $doc_where");
                            
                        }
                        else if(isset($_POST['treatment']))
                        {
                            $treatment = $_POST['treatment'];
                          //  $sqlEcho = "SELECT * FROM tbl_doc_treatments s JOIN tbl_doctor d ON (s.treatment_doc = d.doc_id) WHERE s.treatment_condition = ".$treatment." OR ".$doc_where;
                            $sql = query("SELECT * FROM tbl_doc_treatments s JOIN tbl_doctor d ON (s.treatment_doc = d.doc_id) WHERE s.treatment_condition = $treatment AND $doc_where");
                        }
                        else
                        {
                          //  $sqlEcho = "SELECT * FROM tbl_doctor WHERE doc_active = 1 AND ".$doc_where;
                            $sql = query("SELECT * FROM tbl_doctor WHERE doc_active = 1 AND $doc_where");
                        }
                    }
                    else
                    {
                      //  $sqlEcho = "SELECT * FROM tbl_doctor WHERE doc_active = 1";
                        $sql = query("SELECT * FROM tbl_doctor WHERE doc_active = 1");
                    }
                    // echo $sqlEcho;
                    while($doc = fetch($sql))
                    {
                        // $currentDate = date('Y-m-d');
                        $doctorID = $doc['doc_id'];
                        // $fsql = query("SELECT * FROM tbl_feature_doctor WHERE f_doctor_id = $doctorID AND f_list = 'yes' AND  f_end_date >= '$currentDate' AND f_active = 1");
                        ?>
                        <div class="col-md-6 col-lg-6">
                            <div class="doctor-2">
                                <?php 
                                // if(nrows($fsql) > 0)
                                // {
                                    ?>
                                    <!-- div class="feature-wrapper">
                                        <p>FEATURED</p>
                                    </div> -->
                                    <?php
                                // }
                                ?>
                                <div class="hover-overlay img-holder"> 
                                    <img class="img-fluid" src="<?= file_url().$doc['doc_image'];?>" alt="doctor-foto"> 
                                </div>
                                <div class="doctor-meta">
                                    <h5 class="h5-xs blue-color"><?= ($lang == "eng") ? $doc['doc_name'] : $doc['doc_name_arabic']; ?></h5>
                                    <span><?= ($lang == "eng") ? $doc['doc_job_title'] : $doc['doc_job_title_arabic']; ?></span>
                                    <a class="btn btn-sm btn-blue blue-hover mt-15" href="<?= base_url().$doc['doc_slug'];?>" title=""><?= ($lang == "eng") ? $lang_con[90]['lang_eng'] : $lang_con[90]['lang_arabic']; ?></a>
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