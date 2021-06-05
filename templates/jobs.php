<?php
include 'header.php';
if(isset($_POST['limit']) && $_POST['limit'] != "" && $_POST['limit'] != null)
{
    $limit = $_POST['limit'];
}
else
{
    $limit = 10;
}
$where = '';
if(isset($_POST['s']) && $_POST['s'] != "" && $_POST['s'] != null)
{
    $query = $_POST['s'];
    $where .= " AND (job_title LIKE '%".$query."%' OR job_title_ar LIKE '%".$query."%' OR job_desc LIKE '%".$query."%' OR job_desc_ar LIKE '%".$query."%')";
}
if(isset($_POST['d']) && $_POST['d'] != "" && $_POST['d'] != null)
{
    if($_POST['d'] != "all")
    {
        $query = $_POST['d'];
        $where .= " AND (job_depart LIKE '%".$query."%' OR job_depart_ar LIKE '%".$query."%') ";
    }
}
if(isset($_POST['l']) && $_POST['l'] != "" && $_POST['l'] != null)
{
    if($_POST['l'] != "all")
    {
        $query = $_POST['l'];
        $where .= " AND (job_location LIKE '%".$query."%' OR job_location_ar LIKE '%".$query."%' )";
    }
}
if(isset($_POST['page']) && $_POST['page'] != "" && $_POST['page'] != null)
{
    $page = $_POST['page'];
}
else
{
    $page = 1;
}
$offset = ($page - 1 ) * $limit;

$departsql = query("SELECT DISTINCT job_depart, job_depart_ar FROM tbl_job ORDER BY job_depart ASC ");
$locationsql = query("SELECT DISTINCT job_location, job_location_ar FROM tbl_job ORDER BY job_location ASC ");
?>
<style>
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
        <form method="post">
            <div class="row ">
                <div class="col-sm-4">
    				<label class="form-label"><?= ($lang == "eng") ? $lang_con[171]['lang_eng'] : $lang_con[171]['lang_arabic']; ?>:</label>
    				<input type="text" name="s" class="form-control" value="<?= $_POST['s'];?>" placeholder="Enter keywords...">
    			</div>
    			<div class="col-sm-3">
    				<label class="form-label"><?= ($lang == "eng") ? $lang_con[57]['lang_eng'] : $lang_con[57]['lang_arabic']; ?>:</label>
    				<select name="d" class="form-control select">
                    	<option value="all"><?= ($lang == "eng") ? $lang_con[173]['lang_eng'] : $lang_con[173]['lang_arabic']; ?> <?= ($lang == "eng") ? $lang_con[57]['lang_eng'] : $lang_con[57]['lang_arabic']; ?></option>
                    	<?php
                    	while($depart = fetch($departsql))
                        {
                            ?>
                            <option <?= (isset($_POST['d']) && ($_POST['d'] == $depart['job_depart'] || $_POST['d'] == $depart['job_depart_ar'])) ? 'selected' : '';?> value="<?= ($lang == "eng") ? $depart['job_depart'] : $depart['job_depart_ar']; ?>"><?= ($lang == "eng") ? $depart['job_depart'] : $depart['job_depart_ar']; ?></option>
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
                            <option <?= (isset($_POST['l']) && ($_POST['l'] == $location['job_location'] || $_POST['l'] == $location['job_location_ar'])) ? 'selected' : '';?> value="<?= ($lang == "eng") ? $location['job_location'] : $location['job_location_ar']; ?>"><?= ($lang == "eng") ? $location['job_location'] : $location['job_location_ar']; ?></option>
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
	<!--<div class="container" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>-->
	<!--	<div class="row">						-->
	<!--		<div class="col">-->
	<!--			<div class=" breadcrumb-holder">-->
	<!--				<nav aria-label="breadcrumb">-->
	<!--				  	<ol class="breadcrumb">-->
	<!--				    	<li class="breadcrumb-item"><a href="<?= base_url();?>"><?= ($lang == "eng") ? $lang_con[1]['lang_eng'] : $lang_con[1]['lang_arabic']; ?></a></li>-->
	<!--				    	<li class="breadcrumb-item active" aria-current="page"><?= ($lang == "eng") ? $lang_con[152]['lang_eng'] : $lang_con[152]['lang_arabic']; ?></li>-->
	<!--				  	</ol>-->
	<!--				</nav>-->
	<!--				<h4 class="h4-sm steelblue-color"><?= ($lang == "eng") ? $lang_con[152]['lang_eng'] : $lang_con[152]['lang_arabic']; ?></h4>-->
	<!--			</div>-->
	<!--		</div>-->
	<!--	</div>-->
	<!--</div>		-->
</div>
<style>
    /*.logo-holder{*/
    /*    position: absolute;*/
    /*}*/
    /*.hover-overlay{*/
    /*    position: relative;*/
    /*}*/
</style>
<section id="doctors-3" class="bg-lightgrey wide-60 doctors-section division">
	<div class="container">
	    <div class="row">
            <?php
		    $sql = query("SELECT * FROM tbl_job j LEFT JOIN tbl_employer e on (j.job_employeer = e.emp_id) WHERE 1=1 $where LIMIT $offset, $limit");
		    $i=0;
		    while($doc = fetch($sql))
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
            				    $sql = query("SELECT * FROM tbl_advertisment WHERE add_location = 'Job Pages' AND add_status = 1 ORDER BY rand()");
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
		        ?>
		        <div class="col-md-6">
    				<div class="doctor-2">
    				    <div class="row">
        			        <div class="col-md-6">
        			            <?php
            				    if($doc['emp_name'] != null && $doc['emp_name'] != "")
            				    {
            				        ?>
            				        <div class="emp-overlay">
            				            <div class="logo-holder" <?= ($lang == "eng") ? 'style="text-align:left"' : 'style="text-align:right;"'; ?>>
            				                <img src="<?= file_url().$doc['emp_logo']?>" style="height:50px;width:auto;">
            				            </div>
                				    </div>
            				        <?php
            				    }
            				    ?>
            					<div class="hover-overlay img-holder"> 
                				    <img class="img-fluid" src="<?= file_url().$doc['job_icon'];?>" alt="Job-Icon">	
            					</div>
        					</div>
        					<div class="col-md-6" style="border:none;">
        					    <div class="doctor-meta <?= ($lang == "eng") ? 'text-left' : 'text-right' ;?> " <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
                					<h5 class="h5-xs blue-color"><?= ($lang == "eng") ? $doc['job_title'] : $doc['job_title_ar']; ?></h5>
            						<h6><?= ($lang == "eng") ? $doc['job_depart'] : $doc['job_depart_ar']; ?></h6>
            						<span><?= ($lang == "eng") ? $doc['job_location'] : $doc['job_location_ar']; ?></span>
            						<a class="btn btn-sm btn-blue blue-hover mt-15" href="<?= base_url().$doc['job_slug'];?>" title=""><?= ($lang == "eng") ? $lang_con[90]['lang_eng'] : $lang_con[90]['lang_arabic']; ?></a>
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
        <div class="row d-flex justify-content-center mb-4">
            
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php
				    $total_pages_sql = query("SELECT COUNT(*) as count FROM tbl_job WHERE 1=1 $where");
                    $total_rows = fetch($total_pages_sql)[count];
                    $total_pages = ceil($total_rows / $limit);
					for ($i=0; $i < $total_pages; $i++)
					{
						?>
						<li class="page-item <?= ( ($i+1) == $page ) ? 'active disabled' : ''; ?>"><a class="page-link" href="<?= base_url().'career?page='. ($i + 1);?><?= (isset($_POST['s'])) ? '&s='.$_POST['s'] : '';?>"><?= $i + 1;?></a></li>
						<?php
					}
					?>
                </ul>
            </nav>
        </div>
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