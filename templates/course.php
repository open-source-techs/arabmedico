<?php
include 'header.php';
if(isset($_GET['limit']) && $_GET['limit'] != "" && $_GET['limit'] != null)
{
    $limit = $_GET['limit'];
}
else
{
    $limit = 10;
}
$where = '';
if(isset($_GET['s']) && $_GET['s'] != "" && $_GET['s'] != null)
{
    $query = $_GET['s'];
    $where .= " AND (course_topic LIKE '%".$query."%' OR course_ar_topic LIKE '%".$query."%' OR course_des LIKE '%".$query."%' OR course_ar_des LIKE '%".$query."%')";
}
if(isset($_GET['d']) && $_GET['d'] != "" && $_GET['d'] != null)
{
    if($_GET['d'] != "all")
    {
        $query = $_GET['d'];
        $where .= " AND (course_depart LIKE '%".$query."%' OR course_ar_depart LIKE '%".$query."%') ";
    }
}
if(isset($_GET['l']) && $_GET['l'] != "" && $_GET['l'] != null)
{
    if($_GET['l'] != "all")
    {
        $query = $_GET['l'];
        $where .= " AND (course_loc LIKE '%".$query."%' OR course_ar_loc LIKE '%".$query."%' )";
    }
}
if(isset($_GET['page']) && $_GET['page'] != "" && $_GET['page'] != null)
{
    $page = $_GET['page'];
}
else
{
    $page = 1;
}
$offset = ($page - 1 ) * $limit;

$departsql = query("SELECT DISTINCT course_depart, course_ar_depart FROM tbl_cme ORDER BY course_depart ASC ");
$locationsql = query("SELECT DISTINCT course_loc, course_ar_loc FROM tbl_cme ORDER BY course_loc ASC ");
?>
<style>
.doctor-meta h6{
    display: flex !important;
}
.doctor-meta span {
    display: contents;
    color: black;
}
.img-holder{
    padding-top:85%;
    height: 200px !important;
}
.img-holder img{
    object-fit: cover !important;
    object-position: center !important;
}
.doctor-meta{
    padding-top:1px !important;
}
#breadcrumb{
    height:150px;
}
.advertiement-div{
    margin-bottom:40px;
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
@media (max-width: 768px) {
    #breadcrumb{
        height: 300px;
        text-align: left;
        background-repeat: no-repeat;
        background-size: cover;
    }
}
</style>
<div id="breadcrumb" class="division">
    <div class="container p-4 m-auto mb-4 no-gutters">
        <form method="get">
            <div class="row ">
                <div class="col-sm-4">
                    <label class="form-label"><?= ($lang == "eng") ? $lang_con[171]['lang_eng'] : $lang_con[171]['lang_arabic']; ?>:</label>
                    <input type="text" name="s" class="form-control" value="<?= (isset($_GET['s'])) ? $_GET['s'] : '';?>" placeholder="Enter keywords...">
                </div>
                <div class="col-sm-3">
                    <label class="form-label"><?= ($lang == "eng") ? $lang_con[57]['lang_eng'] : $lang_con[57]['lang_arabic']; ?>:</label>
                    <select name="d" class="form-control select">
                        <option value="all"><?= ($lang == "eng") ? $lang_con[173]['lang_eng'] : $lang_con[173]['lang_arabic']; ?> <?= ($lang == "eng") ? $lang_con[57]['lang_eng'] : $lang_con[57]['lang_arabic']; ?></option>
                        <?php
                        while($depart = fetch($departsql))
                        {
                            ?>
                            <option <?= (isset($_GET['d']) && ($_GET['d'] == $depart['course_depart'] || $_GET['d'] == $depart['course_ar_depart'])) ? 'selected' : '';?> value="<?= ($lang == "eng") ? $depart['course_depart'] : $depart['course_ar_depart']; ?>"><?= ($lang == "eng") ? $depart['course_depart'] : $depart['course_ar_depart']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label class="form-label"><?= ($lang == "eng") ? $lang_con[172]['lang_eng'] : $lang_con[172]['lang_arabic']; ?>:</label>
                    <select name="l" class="form-control select">
                        <option value="all"><?= ($lang == "eng") ? $lang_con[173]['lang_eng'] : $lang_con[173]['lang_arabic']; ?> <?= ($lang == "eng") ? $lang_con[172]['lang_eng'] : $lang_con[172]['lang_arabic']; ?></option>
                        <?php
                        while($location = fetch($locationsql))
                        {
                            ?>
                            <option <?= (isset($_GET['l']) && ($_GET['l'] == $location['course_loc'] || $_GET['l'] == $location['course_ar_loc'])) ? 'selected' : '';?> value="<?= ($lang == "eng") ? $location['course_loc'] : $location['course_ar_loc']; ?>"><?= ($lang == "eng") ? $location['course_loc'] : $location['course_ar_loc']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <label>&nbsp;</label>
                    <button style="display: block;" type="submit" class="btn btn-blue"><?= ($lang == "eng") ? $lang_con[174]['lang_eng'] : $lang_con[174]['lang_arabic']; ?></button>
                </div>
            </div>
        </form>
    </div>
</div>
<section id="doctors-3" class="bg-lightgrey wide-60 doctors-section division">
    <div class="container">
        <div class="row">
            <?php
            $sql = query("SELECT * FROM tbl_course c LEFT JOIN tbl_organizer o on (c.course_organizer = o.org_id) WHERE 1=1 $where LIMIT $offset, $limit");
            $i=0;
            while($cme = fetch($sql))
            {
                $sqlcount = query("SELECT count(*) as count FROM tbl_advertisment WHERE add_location = 'CME Pages' AND add_status = 1");
                $countAdd = fetch($sqlcount);
                if($countAdd['count'] > 0)
                {
                    if($i == 4)
                    {
                        $i = 0;
                        ?>
                        <div class="col-md-12" id="add-1">
                            <div class="advertiement-div">
                                <div class="close-add-holder">
                                    <span>Addvertisement</span>
                                    <button class="close-button" data-add-id="add-1"><i class="fa fa-times"></i></button>
                                </div>
                                <div class="owl-carousel owl-theme advertisement-holder">
                                    <?php
                                    $sql = query("SELECT * FROM tbl_advertisment WHERE add_location = 'CME Pages' AND add_status = 1 ORDER BY rand()");
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
                        <?php
                    }
                }
                ?>
                <div class="col-md-6">
                    <div class="doctor-2">
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                if($cme['org_name'] != null && $cme['org_name'] != "")
                                {
                                    ?>
                                    <div class="emp-overlay">
                                        <div class="logo-holder" <?= ($lang == "eng") ? 'style="text-align:left"' : 'style="text-align:right;"'; ?>>
                                            <img src="<?= file_url().$cme['org_icon']?>" style="height:50px;width:auto;">
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="hover-overlay img-holder"> 
                                    <img class="img-fluid" src="<?= file_url().$cme['course_icon'];?>" alt="Job-Icon"> 
                                </div>
                            </div>
                            <div class="col-md-6" style="border:none;">
                                <div class="doctor-meta <?= ($lang == "eng") ? 'text-left' : 'text-right' ;?> " <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>

                                    <h5 class="h5-xs blue-color" style="font-size: 16px !important;"><?= ($lang == "eng") ? $cme['course_topic'] : $cme['course_ar_topic']; ?></h5>

                                    <h6><span><?= ($lang == "eng") ? $lang_con[57]['lang_eng'] : $lang_con[57]['lang_arabic']; ?></span> : <?= ($lang == "eng") ? $cme['course_depart'] : $cme['course_ar_depart']; ?></h6>

                                    <h6><span><?= ($lang == "eng") ? $lang_con[175]['lang_eng'] : $lang_con[175]['lang_arabic']; ?></span> : <?= ($lang == "eng") ? $cme['course_delivery'] : $cme['course_ar_delivery']; ?></h6>

                                    <h6><span><?= ($lang == "eng") ? $lang_con[175]['lang_eng'] : $lang_con[176]['lang_arabic']; ?> <?= ($lang == "eng") ? $lang_con[126]['lang_eng'] : $lang_con[126]['lang_arabic']; ?></span> : <?= ($lang == "eng") ? $cme['course_date'] : $cme['course_ar_date']; ?></h6>

                                    <h6><span><?= ($lang == "eng") ? $lang_con[177]['lang_eng'] : $lang_con[177]['lang_arabic']; ?> <?= ($lang == "eng") ? $lang_con[126]['lang_eng'] : $lang_con[126]['lang_arabic']; ?></span> : <?= ($lang == "eng") ? $cme['course_close_date'] : $cme['course_close_date_ar']; ?></h6>

                                    <h6><span><?= ($lang == "eng") ? $lang_con[178]['lang_eng'] : $lang_con[178]['lang_arabic']; ?></span> : <?= ($lang == "eng") ? $cme['course_time'] : $cme['course_ar_time']; ?></h6>

                                    <h6><span><?= ($lang == "eng") ? $lang_con[167]['lang_eng'] : $lang_con[167]['lang_arabic']; ?> <?= ($lang == "eng") ? $lang_con[179]['lang_eng'] : $lang_con[179]['lang_arabic']; ?></span> : <?= ($lang == "eng") ? $cme['course_credits'] : $cme['course_ar_credits']; ?></h6>
                                    
                                    <a class="btn btn-sm btn-blue blue-hover mt-15" href="<?= base_url().$cme['course_slug'];?>" title=""><?= ($lang == "eng") ? $lang_con[90]['lang_eng'] : $lang_con[90]['lang_arabic']; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $i++;
            }
            ?>
        </div>
        <!-- <div class="row d-flex justify-content-center mb-4">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php
                    $total_pages_sql = query("SELECT COUNT(*) as count FROM tbl_cme c LEFT JOIN tbl_organizer o on (c.cme_organizer = o.org_id)  WHERE 1=1 $where");
                    $total_rows = fetch($total_pages_sql)['count'];
                    $total_pages = ceil($total_rows / $limit);
                    for ($i=0; $i < $total_pages; $i++)
                    {
                        ?>
                        <li class="page-item <?= ( ($i+1) == $page ) ? 'active disabled' : ''; ?>"><a class="page-link" href="<?= base_url().'cme-training?page='. ($i + 1);?><?= (isset($_GET['s'])) ? '&s='.$_GET['s'] : '';?>"><?= $i + 1;?></a></li>
                        <?php
                    }
                    ?>
                </ul>
            </nav>
        </div> -->
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