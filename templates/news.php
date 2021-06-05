<?php 
include 'header.php';
?>
<style>
.popular-posts img{
    height:100px;
    width:150px;
}
.blog-post-img img {
    height: 300px;
    width: 100%;
    object-fit: contain;
}
</style>
<?php
$where = '';
if(isset($_GET['slug']) && $_GET['slug'] != '' && $_GET['slug'] != null)
{
    $category = filter_this($_GET['slug']);
    $where =  "AND dpt_slug = '$category'";
}
if (isset($_GET['page']))
{
	$page = $_GET['page'];
}
else
{
	$page = 1;
}
$limit = 10;
$offset = ($page - 1 ) * $limit;

?>
<div id="breadcrumb" class="division">
	<div class="container" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
		<div class="row">						
			<div class="col">
				<div class=" breadcrumb-holder">
					<nav aria-label="breadcrumb">
					  	<ol class="breadcrumb">
					    	<li class="breadcrumb-item"><a href="<?= base_url();?>home<?= $pram;?>"><?= ($lang == "eng") ? $lang_con[1]['lang_eng'] : $lang_con[1]['lang_arabic']; ?></a></li>
					    	<li class="breadcrumb-item active" aria-current="page"><?= ($lang == "eng") ? $lang_con[12]['lang_eng'] : $lang_con[12]['lang_arabic']; ?></li>
					  	</ol>
					</nav>
					<h4 class="h4-sm steelblue-color"><?= ($lang == "eng") ? $lang_con[12]['lang_eng'] : $lang_con[12]['lang_arabic']; ?></h4>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="blog-page" class="wide-100 blog-page-section division">
    <div class="container" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
        <div class="row reverse">
			<aside id="sidebar" class="col-lg-4">
				<div class="blog-categories sidebar-div mb-50">
					<h5 class="h5-sm steelblue-color"><?= ($lang == "eng") ? $lang_con[110]['lang_eng'] : $lang_con[110]['lang_arabic']; ?></h5>
					<ul class="blog-category-list clearfix">
					    <?php
					    $sql = query("SELECT * FROM tbl_department WHERE dpt_active = 1");
					    while($dpt = fetch($sql))
					    {
					        $cSql = query("SELECT count(news_id) as count FROM tbl_news WHERE news_active = 1 AND news_category = ".$dpt['dpt_id']);
					        $count = fetch($cSql)['count'];
					        $link = $dpt["dpt_slug"];
					        ?>
					        <li><a href="<?= base_url()."news/".$link;?>"><i class="fas fa-angle-double-right blue-color"></i> <?= ($lang == "eng") ? $dpt['dpt_name'] : $dpt['dpt_name_arabic']; ?> </a> <span>(<?= $count; ?>)</span></li>
					        <?php
					    }
					    ?>
					</ul>
				</div>
				<div class="popular-posts sidebar-div mb-50">
					<h5 class="h5-sm steelblue-color"><?= ($lang == "eng") ? $lang_con[92]['lang_eng'] : $lang_con[92]['lang_arabic']; ?></h5>
					<ul class="popular-posts">
					    <?php
					    $sql = query("SELECT * FROM tbl_news n JOIN tbl_department d ON (d.dpt_id = n.news_category) WHERE n.news_active = 1 ORDER BY n.news_id DESC LIMIT 3 ");
					    while($post = fetch($sql))
					    {
					        ?>
					        <li class="clearfix d-flex align-items-center">
    							<img class="img-fluid" src="<?= file_url().$post['news_image'];?>" alt="blog-post-preview" />
    							<div class="post-summary">
    								<a href="<?= base_url();?><?= $post['news_slug']; ?>"><?= ($lang == "eng") ? $post['news_title'] : $post['news_title_arabic']; ?></a>
    							</div>
    						</li>
					        <?php
					    }
					    ?>
					</ul>
				</div>
				<div class="image-widget sidebar-div">
					<a href="#">
						<img class="img-fluid" src="<?= base_url();?>images/blog/image-widget.jpg" alt="image-widget" />
					</a>																		
				</div>
            </aside>
	 		<div class="col-lg-8">
	 			<div class="posts-holder pr-30">
	 			    <?php
	 			    $blogSql = query("SELECT * FROM tbl_news n JOIN tbl_department d ON (d.dpt_id = n.news_category) WHERE news_active = 1 $where ORDER BY news_id DESC LIMIT $offset, $limit");
	 			    while($blog = fetch($blogSql))
	 			    {
	 			        $sqlcount = query("SELECT count(*) as count FROM tbl_advertisment WHERE add_location = 'New Pages' AND add_status = 1");
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
                        				    $sql = query("SELECT * FROM tbl_advertisment WHERE add_location = 'New Pages' AND add_status = 1 ORDER BY rand()");
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
	 				    <div class="blog-post">
    			 			<div class="blog-post-img">
    							<img class="img-fluid" src="<?= file_url().$blog['news_image'];?>" alt="blog-post-image" />	
    						</div>
    						<div class="blog-post-txt">
    							<h5 class="h5-xl steelblue-color"><a href="<?= base_url();?><?= $blog['news_slug']; ?>"><?= ($lang == "eng") ? $blog['news_title'] : $blog['news_title_arabic']; ?></a></h5>
    							<p><?= ($lang == "eng") ? $blog['news_short_desc'] : $blog['news_short_desc_arabic']; ?></p>
    						</div>
    					</div>
	 			        <?php
	 			    }
	 			    ?>
					<div class="blog-page-pagination b-top">
						<nav aria-label="Page navigation">
							<ul class="pagination justify-content-center primary-theme">
							    <?php
							    $total_pages_sql = query("SELECT COUNT(news_id) as count FROM tbl_news WHERE news_active = 1 $where");
                                $total_rows = fetch($total_pages_sql)[count];
                                $total_pages = ceil($total_rows / $limit);
        						for ($i=0; $i < $total_pages; $i++)
        						{
        						    $j =  $i+1;
        						    $link1 = 'blog-listing'.$pram."/".$j;
        						    if( isset($_GET['cat']))
    					            { 
    					                $link1 .= '/'.$_GET['cat'];
    					            }
        							?>
        							<li class="page-item <?= ( ($i+1) == $page ) ? 'active disabled' : ''; ?>"><a class="page-link" href="<?= base_url().$link1;?>"><?= $i + 1;?></a></li>
        							<?php
        						}
        						?>
 							</ul>	
 						</nav>					
					</div>
	 			</div>
	 		</div>	 		
	 	</div>
    </div>
</div>
<?php
include 'footer.php';
?>