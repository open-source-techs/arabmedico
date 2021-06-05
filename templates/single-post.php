<?php
if(isset($_GET['slug']) && $_GET['slug'] != "" && $_GET['slug'] != null)
{
    include 'header.php';
    $slug = filter_this($_GET['slug']);
    $sql = query("SELECT * FROM tbl_news where news_slug = '$slug'");
    if(nrows($sql) > 0)
    {
        $data = fetch($sql);
        ?>
        <style>
            .popular-posts img{
                height:100px;
                width:150px;
            }
            .sblog-post-txt img{
                width:100%;
                height:auto;
            }
            .video-holder{
                position:relative;
                padding-top:54%;
            }
            .video-holder iframe
            {
                position:absolute;
                top:0;
                left:0;
                height:100%;
                width:100%;
            }
        </style>
        <div id="breadcrumb" class="division">
        	<div class="container" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
        		<div class="row">						
        			<div class="col">
        				<div class="breadcrumb-holder">
        					<nav aria-label="breadcrumb">
        					  	<ol class="breadcrumb">
        					    	<li class="breadcrumb-item"><a href="<?= base_url();?>home<?= $pram;?>"><?= ($lang == "eng") ? $lang_con[1]['lang_eng'] : $lang_con[1]['lang_arabic']; ?></a></li>
        					    	<li class="breadcrumb-item"><a href="<?= base_url(); ?>blog-listing<?= $pram;?>"><?= ($lang == "eng") ? $lang_con[6]['lang_eng'] : $lang_con[6]['lang_arabic']; ?></a></li>
        					    	<li class="breadcrumb-item active" aria-current="page"><?= ($lang == "eng") ? $lang_con[91]['lang_eng'] : $lang_con[91]['lang_arabic']; ?></li>
        					  	</ol>
        					</nav>
        					<h4 class="h4-sm steelblue-color"><?= ($lang == "eng") ? $data['news_title'] : $data['news_title_arabic']; ?></h4>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
    	<div id="single-blog-page" class="wide-100 blog-page-section division">
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
        					        $link = 'news/'.$dpt["dpt_slug"];
        					        ?>
        					        <li><a href="<?= base_url().$link;?>"><i class="fas fa-angle-double-right blue-color"></i> <?= ($lang == "eng") ? $dpt['dpt_name'] : $dpt['dpt_name_arabic']; ?> </a> <span>(<?= $count; ?>)</span></li>
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
            								<a href="<?= base_url();?>single-post<?= $pram;?>/<?= $post['news_slug']; ?>"><?= ($lang == "eng") ? $post['news_title'] : $post['news_title_arabic']; ?></a>
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
    			 		<div class="single-blog-post pr-30">
    			 			<div class="blog-post-img mb-40">
    							<img class="img-fluid" src="<?= file_url().$data['news_image'];?>" alt="blog-post-image" />		
    						</div>
    						<div class="sblog-post-txt">
    							<h4 class="h4-lg steelblue-color"><?= ($lang == "eng") ? $data['news_title'] : $data['news_title_arabic']; ?></h4>
    							<span>Posted <?= date('d M, Y', strtotime($data['news_created_at']));?></span>
    							<?= ($lang == "eng") ? $data['news_detail'] : $data['news_detail_arabic']; ?>
    						</div>
    
    						<?php
    						$sql = query("SELECT * FROM tbl_news WHERE news_active = 1 news_id != '".$data['news_id']."' AND news_category = ".$data['news_category']);
    						if(nrows($sql) > 0)
    						{
    						    ?>
    							<div class="related-posts">
    								<h5 class="h5-md steelblue-color"><?= ($lang == "eng") ? $lang_con[93]['lang_eng'] : $lang_con[93]['lang_arabic']; ?></h5>
    								<div class="row">
    								    <?php
    								    while($rel = fetch($sql))
    								    {
    								        ?>
    								        <div class="col-md-6">
    								 			<div class="blog-post">
    									 			<div class="blog-post-img">
    													<img class="img-fluid" src="<?= file_url().$rel['news_image'];?>" alt="blog-post-image" />	
    												</div>
    												<div class="blog-post-txt">
    													<h5 class="h5-sm steelblue-color"><a href="<?= base_url();?>single-post<?= $pram;?>/<?= $rel['news_slug']; ?>"><?= ($lang == "eng") ? $rel['news_title'] : $rel['news_title_arabic']; ?></a></h5>
    													<p><?= ($lang == "eng") ? $rel['news_short_desc'] : $rel['news_short_desc_arabic']; ?></p>
    												</div>
    											</div>
    								 		</div>
    								        <?php
    								    }
    								    ?>
    								</div>
    							</div>
    						    <?php
    						}
    						?>
    						<?php
    						$sql = query("SELECT * FROM tbl_news_comments WHERE comment_approved = 1 AND commented_news = ".$data['news_id']);
    						$comment_count = nrows($sql);
    						if($comment_count > 0)
    						{
    						    ?>
    						    <div class="single-post-comments">
        							<h5 class="h5-md steelblue-color"><?= $comment_count; ?><?= ($lang == "eng") ? $lang_con[94]['lang_eng'] : $lang_con[94]['lang_arabic']; ?></h5>
        							<?php
        							while($comment = fetch($sql))
        							{
        							    ?>
        							    
        							    <div class="media mt-40">
            							  	<img class="mr-3" src="<?= base_url();?>images/post-author-3.jpg" alt="comment-avatar">
            							 	<div class="media-body">
            							 		<div class="comment-meta">
            								   		<h5 class="h5-xs mt-0 steelblue-color"><?= ($comment['comment_private'] == 0) ? $comment['comment_name'] : 'Anonymous' ;?></h5>
            								   		<span class="comment-date"><?= date('d M, Y H:i A', strtotime($comment['commented_at']));?> </span>
            									</div>
            							   		<p><?= $comment['comment_text']; ?></p>
            							   </div>
            							</div>
            							<hr />
        							    <?php
        							}
        							?>
        						</div>
        						
    						    <?php
    						}
    						?>
    						<?php
    						if($comment_count <= 0)
    						{
    						    ?>
    						    <hr />
    						    <?php
    						}
    						?>
    						<div id="leave-comment">
    							<h5 class="h5-md steelblue-color"><?= ($lang == "eng") ? $lang_con[95]['lang_eng'] : $lang_con[95]['lang_arabic']; ?></h5>
    							<p class="grey-color"><?= ($lang == "eng") ? $lang_con[96]['lang_eng'] : $lang_con[96]['lang_arabic']; ?>*</p>
    							<form method="post" class="row comment-form">
    							    <input type="hidden" value="<?= ($lang == "eng") ? 'eng' : 'arab'; ?>" name="txt_lang">
    								<div id="input-message" class="col-md-12 input-message">
    				                	<p><?= ($lang == "eng") ? $lang_con[97]['lang_eng'] : $lang_con[97]['lang_arabic']; ?>*</p>
    				                	<textarea class="form-control message" name="message" rows="6" placeholder="<?= ($lang == "eng") ? $lang_con[102]['lang_eng'] : $lang_con[102]['lang_arabic']; ?>* ..." required></textarea>
    				                </div> 
    				                <div id="input-name" class="col-md-12">
    				                	<p><?= ($lang == "eng") ? $lang_con[98]['lang_eng'] : $lang_con[98]['lang_arabic']; ?>*</p>
    				                	<input type="text" name="name" class="form-control name" placeholder="<?= ($lang == "eng") ? $lang_con[103]['lang_eng'] : $lang_con[103]['lang_arabic']; ?>*" required> 
    				                </div>
    				                <div id="input-email" class="col-md-12">
    				                	<p><?= ($lang == "eng") ? $lang_con[99]['lang_eng'] : $lang_con[99]['lang_arabic']; ?>*</p>
    				                	<input type="hidden" name="txt_news_id" value="<?= $data['news_id'];?>">
    				                	<input type="text" name="email" class="form-control email" placeholder="<?= ($lang == "eng") ? $lang_con[104]['lang_eng'] : $lang_con[104]['lang_arabic']; ?>*" required> 
    				                </div>
    				                <div id="input-name" class="col-md-12">
    				                	<p><?= ($lang == "eng") ? $lang_con[100]['lang_eng'] : $lang_con[100]['lang_arabic']; ?></p>
    				                	<label for="chk_private"><?= ($lang == "eng") ? $lang_con[101]['lang_eng'] : $lang_con[101]['lang_arabic']; ?></label>
    				                	<input type="checkbox" id="chk_private" name="chk_private" value="1"> 
    				                </div>
    				                <div class="col-lg-12 mt-15 form-btn"> 						                 
    				                	<button type="submit" name="btn_submit" class="btn btn-blue blue-hover submit"><?= ($lang == "eng") ? $lang_con[105]['lang_eng'] : $lang_con[105]['lang_arabic']; ?></button> 
    				                </div>
    				                <div class="col-md-12 comment-form-msg text-center">
    				                	<div class="sending-msg"><span class="loading"></span></div>
    				                </div>
    			                </form>
    						</div>
    		 			</div>
    		 		</div>
    		 	</div>
            </div>
        </div>
    	<?php
        include 'footer.php';
        ?>
        <script>
        $(document).ready(function(){
            $(".comment-form").validate({
    			rules: {				
    				name: "required",
    				email: {
    					required: true,
    					email: true
    				},
    				phone:{
    					required: true,
    					digits: true,
    				},
    				message: "required",
    			},
    			messages: {
    				name: "<?= ($lang == "eng") ? $lang_con[103]['lang_eng'] : $lang_con[103]['lang_arabic']; ?>",
    				email: "<?= ($lang == "eng") ? $lang_con[108]['lang_eng'] : $lang_con[108]['lang_arabic']; ?>",
    				message: "<?= ($lang == "eng") ? $lang_con[109]['lang_eng'] : $lang_con[109]['lang_arabic']; ?>",
    			},
    			submitHandler: function(form)
    			{
    			    
    			    $.ajax({
                        type:'POST',
                        url: "<?= base_url();?>actions/submit-form.php",
                        data: $(form).serialize(),
                        beforeSend: function () {
                            $('.loading').text('<?= ($lang == "eng") ? $lang_con[107]['lang_eng'] : $lang_con[107]['lang_arabic']; ?>...!!!');
                        },
                        success:function(data){
                            var res = $.parseJSON(data);
                            if(res.status == "success")
                            {
                                window.location.reload();
                            }
                            else
                            {
                                $('.loading').text(res.message);
                            }
                        },
                        error: function(e){
                            $('.loading').text('<?= ($lang == "eng") ? $lang_con[106]['lang_eng'] : $lang_con[106]['lang_arabic']; ?>');
                        }
                    });
                    $form.submit();
                }
    		});
    		
        });
        </script>
        <?php
    }
    else
    {
        ?>
        <script>
            window.history.go(-1);
        </script>
        <?php
    }
}
else
{
    ?>
    <script>
        window.history.go(-1);
    </script>
    <?php
}
    