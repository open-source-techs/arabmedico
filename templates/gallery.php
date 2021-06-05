<?php include 'header.php';?>
<style>
    .gallery-item iframe{
        width:auto;
        height:200px;
    }
    .gallery-item video{
        width:auto;
        height:200px;
    }
</style>
<div id="breadcrumb" class="division">
	<div class="container">
		<div class="row">						
			<div class="col">
				<div class=" breadcrumb-holder">
					<nav aria-label="breadcrumb">
					  	<ol class="breadcrumb">
					    	<li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
					    	<li class="breadcrumb-item active" aria-current="page">Our Gallery</li>
					  	</ol>
					</nav>
					<h4 class="h4-sm steelblue-color">Our Gallery</h4>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="gallery-3" class="gallery-section bordered division">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="gallery-filter mb-60">
                    <button data-filter="*" class="is-checked">All</button>
				    <?php
				    $sql = query("SELECT * FROM tbl_department WHERE dpt_active = 1");
				    while($dpt = fetch($sql))
				    {
				        ?>
				        <button data-filter=".<?= $dpt['dpt_id']; ?>"><?= ($lang == "eng") ? $dpt['dpt_name'] : $dpt['dpt_name_arabic']; ?></button>
				        <?php
				    }
				    ?>
                </div>
			</div>
		</div>
		<div class="row">	
			<div class="col-md-12">
			    <div class="gallery-items-list">
    				<div class="masonry-wrap grid-loaded">
    				    <?php
    				    $sql = query("SELECT * FROM tbl_gallery WHERE gallery_active = 1");
    				    while($gal = fetch($sql))
    				    {
    				        if($gal['gallery_is_video'] == 1)
                            {
                                if($gal['gallery_is_link'] == 1)
                                {
                                    ?>
                                    <div class="gallery-item <?= $gal['gallery_department'];?>">
                                        <div class="hover-overlay">
                                            <?= $gal['gallery_video']; ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <div class="gallery-item <?= $gal['gallery_department'];?>">
                                        <video controls>
                                            <source src="<?= file_url().$gal['gallery_video'];?>" type="video/mp4">
                                        </video>
                                    </div>
                                    <td>
                                        
                                    </td>
                                    <?php
                                }
                            }
                            else
                            {
        				        ?>
        				        <div class="gallery-item <?= $gal['gallery_department'];?>">
            						<div class="hover-overlay">
            							<img class="img-fluid" src="<?= file_url().$gal['gallery_image'];?>" alt="galley-image" />			
            							<div class="item-overlay"></div>
            							<div class="image-zoom">
            								<a class="image-link" href="<?= file_url().$gal['gallery_image'];?>" title=""><i class="fas fa-search-plus"></i></a>
            							</div>
            						</div>	
            					</div>
        				        <?php
                            }
    				    }
    				    ?>
    				  	
    				</div>
			    </div>
			</div>	
		</div>
 	</div>
</div>
<?php
include 'footer.php';
?>