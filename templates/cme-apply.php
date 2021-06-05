<?php
if(isset($_GET['slug']) && $_GET['slug'] != "" && $_GET['slug'] != null)
{
    $slug = $_GET['slug'];
    include 'header.php';
    $sql = query("SELECT * FROM tbl_cme WHERE id = '$slug'");
    if(nrows($sql) > 0)
    {
        $cme = fetch($sql);
        ?>
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
        					<h4 class="h4-sm steelblue-color"><?= ($lang == "eng") ? $lang_con[165]['lang_eng'] : $lang_con[165]['lang_arabic']; ?></h4>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
        <div id="appointment-page" class="wide-60 appointment-page-section division">
        	<div class="container" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
        	 	<div class="row">
        	 		<div class="col-lg-8">
        	 			<div class="txt-block pr-30">
        					<h3 class="h3-md steelblue-color <?= ($lang == "eng") ? 'left-after' : 'right-after' ;?>"><?= ($lang == "eng") ? $lang_con[166]['lang_eng'] : $lang_con[166]['lang_arabic']; ?></h3>
        					<p><?= ($lang == "eng") ? $lang_con[156]['lang_eng'] : $lang_con[156]['lang_arabic']; ?></p>
        					<div class="messages">
        					    
        					</div>
        					<div id="appointment-form-holder" class="text-center">
        					    <h5 class="h5-sm steelblue-color <?= ($lang == "eng") ? 'text-left' : 'text-right'; ?>"><?= ($lang == "eng") ? $lang_con[161]['lang_eng'] : $lang_con[161]['lang_arabic']; ?>: <span class="text-default"><?= ($lang == "eng") ? $cme['cme_topic'] : $cme['cme_ar_topic'];?></span></h5>
        					    <h5 class="h5-sm steelblue-color <?= ($lang == "eng") ? 'text-left' : 'text-right'; ?>"><?= ($lang == "eng") ? $lang_con[160]['lang_eng'] : $lang_con[160]['lang_arabic']; ?>: <span class="text-default"><?= ($lang == "eng") ? $cme['cme_depart'] : $cme['cme_ar_depart'];?></span></h5>
        						<form class="row cme-form">
        			                <div id="input-name" class="col-lg-12 form-group m-2">
        			                    <input type="hidden" name="cmeid" value="<?= $cme['id'];?>">
        			                    <input type="hidden" value="<?= ($lang == "eng") ? 'eng' : 'arab'; ?>" name="txt_lang">
        			                	<input type="text" name="name" class="form-control name" placeholder="<?= ($lang == "eng") ? $lang_con[103]['lang_eng'] : $lang_con[103]['lang_arabic']; ?>*" required> 
        			                </div>
        			                <div id="input-email" class="col-lg-12 form-group m-2">
        			                	<input type="text" name="email" class="form-control email" placeholder="<?= ($lang == "eng") ? $lang_con[104]['lang_eng'] : $lang_con[104]['lang_arabic']; ?>*" required> 
        			                </div>
        			                <div id="input-phone" class="col-lg-12 form-group m-2">
        			                	<input type="tel" name="phone" class="form-control phone" placeholder="<?= ($lang == "eng") ? $lang_con[127]['lang_eng'] : $lang_con[127]['lang_arabic']; ?>*" required> 
        			                </div>
        			                <div class="col-lg-12 form-btn">  
        			                	<button type="submit" name="btn_apply" class="btn btn-blue blue-hover submit"><?= ($lang == "eng") ? $lang_con[168]['lang_eng'] : $lang_con[168]['lang_arabic']; ?></button> 
        			                </div>
        			                <div class="col-lg-12 appointment-form-msg text-center">
        			                	<div class="sending-msg"><span class="loading"></span></div>
        			                </div>                    
        		                </form>
        					</div>
        	 			</div>
        	 		</div>
        			<aside id="sidebar" class="col-lg-4">
        				<div id="txt-widget" class="sidebar-div mb-50">
        					<h5 class="h5-sm steelblue-color"><?= ($lang == "eng") ? $siteData['site_name'] : $siteData['site_name_arabic']; ?></h5>
        					<div class="txt-widget-unit mb-15 clearfix d-flex align-items-center">
        						<div class="txt-widget-data">
        							<span><?= ($lang == "eng") ? $siteData['site_address'] : $siteData['site_address_arabic']; ?></span>	
        							<p class="blue-color"><?= $siteData['site_phone'];?></p>	
        						</div>
        					</div>
        					<p class="p-sm"><?= ($lang == "eng") ? $siteData['footer_text'] : $siteData['footer_text_arabic']; ?>	</p>
        				</div>
        				<div class="sidebar-table blue-table sidebar-div mb-50">
        					<h5 class="h5-md"><?= ($lang == "eng") ? $lang_con[147]['lang_eng'] : $lang_con[147]['lang_arabic']; ?></h5>
        					<table class="table">
        						<tbody>
        						    <?php
        						    $sql0 = query("SELECT * FROM tbl_timings WHERE timing_day = 'Monday' ");
        						    $sql1 = query("SELECT * FROM tbl_timings WHERE timing_day = 'Tuesday' ");
        						    $sql2 = query("SELECT * FROM tbl_timings WHERE timing_day = 'Wednesday' ");
        						    $sql3 = query("SELECT * FROM tbl_timings WHERE timing_day = 'Thursday' ");
        						    $sql4 = query("SELECT * FROM tbl_timings WHERE timing_day = 'Friday' ");
        						    $sql5 = query("SELECT * FROM tbl_timings WHERE timing_day = 'Saturday' ");
        						    $sql6 = query("SELECT * FROM tbl_timings WHERE timing_day = 'Sunday' ");
        						    
        						    ?>
        						    <?php
        						    $monday = array();
        						    $m=0;
        					      	while($timing0 = fetch($sql0))
        						    {
        						        $m++;
        						        if($lang == "eng")
        						        {
        						            $monday[$m]['time'] =  $timing0['timing_open'] . " - " . $timing0['timing_close'];
        						        }
        						        else
        						        {
        						            $monday[$m]['time'] =  $timing0['timing_open_arabic'] . " - " . $timing0['timing_close_arabic'];
        						        }
        						    }
        						    $tuesday = array();
        						    $m=0;
        					      	while($timing1 = fetch($sql1))
        						    {
        						        $m++;
        						        if($lang == "eng")
        						        {
        						            $tuesday[$m]['time'] =  $timing1['timing_open'] . " - " . $timing1['timing_close'];
        						        }
        						        else
        						        {
        						            $tuesday[$m]['time'] =  $timing1['timing_open_arabic'] . " - " . $timing1['timing_close_arabic'];
        						        }
        						    }
        						    $wednesday = array();
        						    $m=0;
        					      	while($timing2 = fetch($sql2))
        						    {
        						        $m++;
        						        if($lang == "eng")
        						        {
        						            $wednesday[$m]['time'] =  $timing2['timing_open'] . " - " . $timing2['timing_close'];
        						        }
        						        else
        						        {
        						            $wednesday[$m]['time'] =  $timing2['timing_open_arabic'] . " - " . $timing2['timing_close_arabic'];
        						        }
        						    }
        						    $thursday = array();
        						    $m=0;
        					      	while($timing3 = fetch($sql3))
        						    {
        						        $m++;
        						        if($lang == "eng")
        						        {
        						            $thursday[$m]['time'] =  $timing3['timing_open'] . " - " . $timing3['timing_close'];
        						        }
        						        else
        						        {
        						            $thursday[$m]['time'] =  $timing3['timing_open_arabic'] . " - " . $timing3['timing_close_arabic'];
        						        }
        						        
        						    }
        						    $friday = array();
        						    $m=0;
        					      	while($timing4 = fetch($sql4))
        						    {
        						        $m++;
        						        if($lang == "eng")
        						        {
        						            $friday[$m]['time'] =  $timing4['timing_open'] . " - " . $timing4['timing_close'];
        						        }
        						        else
        						        {
        						            $friday[$m]['time'] =  $timing4['timing_open_arabic'] . " - " . $timing4['timing_close_arabic'];
        						        }
        						        
        						    }
        						    $saturday = array();
        						    $m=0;
        					      	while($timing5 = fetch($sql5))
        						    {
        						        $m++;
        						        if($lang == "eng")
        						        {
        						            $saturday[$m]['time'] =  $timing5['timing_open'] . " - " . $timing5['timing_close'];
        						        }
        						        else
        						        {
        						            $saturday[$m]['time'] =  $timing5['timing_open_arabic'] . " - " . $timing5['timing_close_arabic'];
        						        }
        						        
        						    }
        						    $sunday = array();
        						    $m=0;
        					      	while($timing6 = fetch($sql6))
        						    {
        						        $m++;
        						        if($lang == "eng")
        						        {
        						            $sunday[$m]['time'] = $timing6['timing_open'] . " - " . $timing6['timing_close'];
        						        }
        						        else
        						        {
        						            $sunday[$m]['time'] = $timing6['timing_open_arabic'] . " - " . $timing6['timing_close_arabic'];
        						        }
        						    }
        						    if(sizeof($monday) > 0)
        						    {
        						        for($i = 1; $i <= sizeof($monday); $i++ )
        						        {
        						            if($i == 1)
        						            {
        						                ?>
        						                <tr>
        						                    <td><?= ($lang == "eng") ? $lang_con[140]['lang_eng'] : $lang_con[140]['lang_arabic']; ?></td>
        						                    <td> - </td>
        						                    <td class="text-right"><?= $monday[$i]['time'];?></td>
        						                </tr>
        						                <?php
        						            }
        						            else
        						            {
        						                ?>
        						                <tr>
        						                    <td></td>
        						                    <td></td>
        						                    <td class="text-right"><?= $monday[$i]['time'];?></td>
        						                </tr>
        						                <?php
        						            }
        						        }
        						    }
        						    else
        						    {
        						        ?>
        				                <tr>
        				                    <td><?= ($lang == "eng") ? $lang_con[140]['lang_eng'] : $lang_con[140]['lang_arabic']; ?></td>
        				                    <td></td>
        				                    <td class="text-right"><?= ($lang == "eng") ? $lang_con[148]['lang_eng'] : $lang_con[148]['lang_arabic']; ?></td>
        				                </tr>
        				                <?php
        						    }
        						    
        						    if(sizeof($tuesday) > 0)
        						    {
        						        for($i = 1; $i <= sizeof($tuesday); $i++ )
        						        {
        						            if($i == 1)
        						            {
        						                ?>
        						                <tr>
        						                    <td><?= ($lang == "eng") ? $lang_con[141]['lang_eng'] : $lang_con[141]['lang_arabic']; ?></td>
        						                    <td> - </td>
        						                    <td class="text-right"><?= $tuesday[$i]['time'];?></td>
        						                </tr>
        						                <?php
        						            }
        						            else
        						            {
        						                ?>
        						                <tr>
        						                    <td></td>
        						                    <td></td>
        						                    <td class="text-right"><?= $tuesday[$i]['time'];?></td>
        						                </tr>
        						                <?php
        						            }
        						        }
        						    }
        						    else
        						    {
        						        ?>
        				                <tr>
        				                    <td><?= ($lang == "eng") ? $lang_con[141]['lang_eng'] : $lang_con[141]['lang_arabic']; ?></td>
        				                    <td></td>
        				                    <td class="text-right"><?= ($lang == "eng") ? $lang_con[148]['lang_eng'] : $lang_con[148]['lang_arabic']; ?></td>
        				                </tr>
        				                <?php
        						    }
        						    
        						    if(sizeof($wednesday) > 0)
        						    {
        						        for($i = 1; $i <= sizeof($wednesday); $i++ )
        						        {
        						            if($i == 1)
        						            {
        						                ?>
        						                <tr>
        						                    <td><?= ($lang == "eng") ? $lang_con[142]['lang_eng'] : $lang_con[142]['lang_arabic']; ?></td>
        						                    <td> - </td>
        						                    <td class="text-right"><?= $wednesday[$i]['time'];?></td>
        						                </tr>
        						                <?php
        						            }
        						            else
        						            {
        						                ?>
        						                <tr>
        						                    <td></td>
        						                    <td></td>
        						                    <td class="text-right"><?= $wednesday[$i]['time'];?></td>
        						                </tr>
        						                <?php
        						            }
        						        }
        						    }
        						    else
        						    {
        						        ?>
        				                <tr>
        				                    <td><?= ($lang == "eng") ? $lang_con[142]['lang_eng'] : $lang_con[142]['lang_arabic']; ?></td>
        				                    <td></td>
        				                    <td class="text-right"><?= ($lang == "eng") ? $lang_con[148]['lang_eng'] : $lang_con[148]['lang_arabic']; ?></td>
        				                </tr>
        				                <?php
        						    }
        						    
        						    if(sizeof($thursday) > 0)
        						    {
        						        for($i = 1; $i <= sizeof($thursday); $i++ )
        						        {
        						            if($i == 1)
        						            {
        						                ?>
        						                <tr>
        						                    <td><?= ($lang == "eng") ? $lang_con[143]['lang_eng'] : $lang_con[143]['lang_arabic']; ?></td>
        						                    <td> - </td>
        						                    <td class="text-right"><?= $thursday[$i]['time'];?></td>
        						                </tr>
        						                <?php
        						            }
        						            else
        						            {
        						                ?>
        						                <tr>
        						                    <td></td>
        						                    <td></td>
        						                    <td class="text-right"><?= $thursday[$i]['time'];?></td>
        						                </tr>
        						                <?php
        						            }
        						        }
        						    }
        						    else
        						    {
        						        ?>
        				                <tr>
        				                    <td><?= ($lang == "eng") ? $lang_con[143]['lang_eng'] : $lang_con[143]['lang_arabic']; ?></td>
        				                    <td></td>
        				                    <td class="text-right"><?= ($lang == "eng") ? $lang_con[148]['lang_eng'] : $lang_con[148]['lang_arabic']; ?></td>
        				                </tr>
        				                <?php
        						    }
        						    
        						    if(sizeof($friday) > 0)
        						    {
        						        for($i = 1; $i <= sizeof($friday); $i++ )
        						        {
        						            if($i == 1)
        						            {
        						                ?>
        						                <tr>
        						                    <td><?= ($lang == "eng") ? $lang_con[144]['lang_eng'] : $lang_con[144]['lang_arabic']; ?></td>
        						                    <td> - </td>
        						                    <td class="text-right"><?= $friday[$i]['time'];?></td>
        						                </tr>
        						                <?php
        						            }
        						            else
        						            {
        						                ?>
        						                <tr>
        						                    <td></td>
        						                    <td></td>
        						                    <td class="text-right"><?= $friday[$i]['time'];?></td>
        						                </tr>
        						                <?php
        						            }
        						        }
        						    }
        						    else
        						    {
        						        ?>
        				                <tr>
        				                    <td><?= ($lang == "eng") ? $lang_con[144]['lang_eng'] : $lang_con[144]['lang_arabic']; ?></td>
        				                    <td></td>
        				                    <td class="text-right"><?= ($lang == "eng") ? $lang_con[148]['lang_eng'] : $lang_con[148]['lang_arabic']; ?></td>
        				                </tr>
        				                <?php
        						    }
        						    
        						    if(sizeof($saturday) > 0)
        						    {
        						        for($i = 1; $i <= sizeof($saturday); $i++ )
        						        {
        						            if($i == 1)
        						            {
        						                ?>
        						                <tr>
        						                    <td><?= ($lang == "eng") ? $lang_con[145]['lang_eng'] : $lang_con[145]['lang_arabic']; ?></td>
        						                    <td> - </td>
        						                    <td class="text-right"><?= $saturday[$i]['time'];?></td>
        						                </tr>
        						                <?php
        						            }
        						            else
        						            {
        						                ?>
        						                <tr>
        						                    <td></td>
        						                    <td></td>
        						                    <td class="text-right"><?= $saturday[$i]['time'];?></td>
        						                </tr>
        						                <?php
        						            }
        						        }
        						    }
        						    else
        						    {
        						        ?>
        				                <tr>
        				                    <td><?= ($lang == "eng") ? $lang_con[145]['lang_eng'] : $lang_con[145]['lang_arabic']; ?></td>
        				                    <td></td>
        				                    <td class="text-right"><?= ($lang == "eng") ? $lang_con[148]['lang_eng'] : $lang_con[148]['lang_arabic']; ?></td>
        				                </tr>
        				                <?php
        						    }
        						    
        						    if(sizeof($sunday) > 0)
        						    {
        						        for($i = 1; $i <= sizeof($sunday); $i++ )
        						        {
        						            if($i == 1)
        						            {
        						                ?>
        						                <tr>
        						                    <td><?= ($lang == "eng") ? $lang_con[146]['lang_eng'] : $lang_con[146]['lang_arabic']; ?></td>
        						                    <td> - </td>
        						                    <td class="text-right"><?= $sunday[$i]['time'];?></td>
        						                </tr>
        						                <?php
        						            }
        						            else
        						            {
        						                ?>
        						                <tr>
        						                    <td></td>
        						                    <td></td>
        						                    <td class="text-right"><?= $sunday[$i]['time'];?></td>
        						                </tr>
        						                <?php
        						            }
        						        }
        						    }
        						    else
        						    {
        						        ?>
        				                <tr>
        				                    <td><?= ($lang == "eng") ? $lang_con[146]['lang_eng'] : $lang_con[146]['lang_arabic']; ?></td>
        				                    <td></td>
        				                    <td class="text-right"><?= ($lang == "eng") ? $lang_con[148]['lang_eng'] : $lang_con[148]['lang_arabic']; ?></td>
        				                </tr>
        				                <?php
        						    }
        						    ?>
        						  </tbody>
        					</table>
        
        				</div>
        			</aside>
        		</div>
        	</div>
        </div>
        <?php
        include 'footer.php';
        ?>
        <script>
            $(".cme-form").validate({
                rules: {
    			    name: "required",
    			    email: {
    				    required: true,
    				    email: true
    			    },
    			    phone:{
    				    required: true,
    				    digits: true,
    			    }
    		    },
    		    messages: {
    			    name: "<?= ($lang == "eng") ? $lang_con[103]['lang_eng'] : $lang_con[103]['lang_arabic']; ?>",
    			    email: "<?= ($lang == "eng") ? $lang_con[108]['lang_eng'] : $lang_con[108]['lang_arabic']; ?>",
    			    phone: "<?= ($lang == "eng") ? $lang_con[129]['lang_eng'] : $lang_con[129]['lang_arabic']; ?>",
    		    },
    		    submitHandler: function(form){
    		        var formData = new FormData(form);
    		        $.ajax({
                        type:'POST',
                        url: "<?= base_url();?>actions/submit-cme-application.php",
                        data: formData,
                        cache:false,
                        contentType: false,
                        processData: false,
                        beforeSend: function ()
                        {
                            $('.loading').text('<?= ($lang == "eng") ? $lang_con[107]['lang_eng'] : $lang_con[107]['lang_arabic']; ?>...!!!');
                        },
                        success:function(data)
                        {
                            var res = $.parseJSON(data);
                            if(res.status == "success")
                            {
                                alert(res.message);
                                window.location.reload();
                            }
                            else
                            {
                                $('.loading').text(res.message);
                            }
                        },
                        error: function(e)
                        {
                            $('.loading').text('<?= ($lang == "eng") ? $lang_con[106]['lang_eng'] : $lang_con[106]['lang_arabic']; ?>');
                        }
                    });
                }
            });
        </script>
        <?php
    }
}
?>