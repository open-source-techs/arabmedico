<?php include 'header.php'; ?>
<div id="breadcrumb" class="division">
	<div class="container" <?= ($lang == "eng") ? '' : 'style="direction:rtl !important;text-align:right"' ;?>>
		<div class="row">						
			<div class="col">
				<div class=" breadcrumb-holder">
					<nav aria-label="breadcrumb">
					  	<ol class="breadcrumb">
					    	<li class="breadcrumb-item"><a href="<?= base_url();?>"><?= ($lang == "eng") ? $lang_con[1]['lang_eng'] : $lang_con[1]['lang_arabic']; ?></a></li>
					    	<li class="breadcrumb-item active" aria-current="page"><?= ($lang == "eng") ? $lang_con[116]['lang_eng'] : $lang_con[116]['lang_arabic']; ?></li>
					  	</ol>
					</nav>
					<h4 class="h4-sm steelblue-color"><?= ($lang == "eng") ? $lang_con[116]['lang_eng'] : $lang_con[116]['lang_arabic']; ?></h4>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
.wide-100{
    padding-top: 20px !important;
    padding-bottom: 0px  !important;
}
.wide-60 {
    padding-top: 10px;
    padding-bottom: 0px;
}
</style>
<div id="appointment-page" class="wide-60 appointment-page-section division">
	<div class="container" <?= ($lang == "eng") ? 'style="padding-right:0px;padding-left:0px"' : 'style="direction:rtl !important;text-align:right;padding-right:0px;padding-left:0px"' ;?>>
	 	<div class="row">
	 		<div class="col-lg-8">
	 			<div class="txt-block pr-30">
					<h3 class="h3-md steelblue-color <?= ($lang == "eng") ? 'left-after' : 'right-after' ;?>"><?= ($lang == "eng") ? $lang_con[113]['lang_eng'] : $lang_con[113]['lang_arabic']; ?></h3>
					<p><?= ($lang == "eng") ? $lang_con[117]['lang_eng'] : $lang_con[117]['lang_arabic']; ?></p>
					<div class="messages">
					    
					</div>
					<div id="appointment-form-holder" class="text-center">
						<form name="appointmentform" class="row appointment-form">
						    <input type="hidden" value="<?= ($lang == "eng") ? 'eng' : 'arab'; ?>" name="txt_lang">
			                <div id="input-department" class="col-md-12 input-department">
			                    <select id="inlineFormCustomSelect1" name="department" class="custom-select department" required>
			                        <option value=""><?= ($lang == "eng") ? $lang_con[120]['lang_eng'] : $lang_con[120]['lang_arabic']; ?> <?= ($lang == "eng") ? $lang_con[3]['lang_eng'] : $lang_con[3]['lang_arabic']; ?></option>  
			                      	<?php
			                      	$sql = query("SELECT * FROM tbl_department WHERE dpt_active = 1");
			                      	while($dpt = fetch($sql))
			                      	{
			                      	    if($lang == "eng")
			                      	    {
			                      	        ?>
    			                      	    <option <?= (isset($_GET['dep']) && $_GET['dep'] == $dpt['dpt_id']) ? 'selected' : ''; ?> value="<?= $dpt['dpt_id'];?>"><?= $dpt['dpt_name'];?></option>
    			                      	    <?php
			                      	    }
			                      	    else
			                      	    {
			                      	        ?>
    			                      	    <option <?= (isset($_GET['dep']) && $_GET['dep'] == $dpt['dpt_id']) ? 'selected' : ''; ?> value="<?= $dpt['dpt_id'];?>"><?= $dpt['dpt_name_arabic'];?></option>
    			                      	    <?php
			                      	    }
			                      	}
			                      	?>
			                    </select>
			                </div>
			                <div id="input-doctor" class="col-md-12 input-doctor">
			                    <select id="inlineFormCustomSelect2" name="doctor" class="custom-select doctor" required>
			                        <option value=""><?= ($lang == "eng") ? $lang_con[120]['lang_eng'] : $lang_con[120]['lang_arabic']; ?> <?= ($lang == "eng") ? $lang_con[33]['lang_eng'] : $lang_con[33]['lang_arabic']; ?></option>  
			                      	<?php
			                      	$sql = query("SELECT * FROM tbl_doctor WHERE doc_active = 1");
			                      	while($doc = fetch($sql))
			                      	{
			                      	    if($lang == "eng")
			                      	    {
			                      	        ?>
    			                      	    <option <?= (isset($_GET['doc']) && $_GET['doc'] == $doc['doc_id']) ? 'selected' : ''; ?> value="<?= $doc['doc_id'];?>"><?= $doc['doc_name'] ." (" . $doc['doc_degree'] . ')';?></option>
    			                      	    <?php
			                      	    }
			                      	    else
			                      	    {
			                      	        ?>
    			                      	    <option <?= (isset($_GET['doc']) && $_GET['doc'] == $doc['doc_id']) ? 'selected' : ''; ?> value="<?= $doc['doc_id'];?>"><?= $doc['doc_name_arabic'] ." (" . $doc['doc_degree_arabic'] . ')';?></option>
    			                      	    <?php
			                      	    }
			                      	}
			                      	?>
			                    </select>
			                </div>
			                <div id="input-patient" class="col-md-12 input-patient">
			                    <select id="inlineFormCustomSelect3" name="visited_bofre" class="custom-select patient" required>
			                        <option value=""><?= ($lang == "eng") ? $lang_con[121]['lang_eng'] : $lang_con[121]['lang_arabic']; ?>?*</option>
									<option value="New Patient"><?= ($lang == "eng") ? $lang_con[123]['lang_eng'] : $lang_con[123]['lang_arabic']; ?> <?= ($lang == "eng") ? $lang_con[122]['lang_eng'] : $lang_con[122]['lang_arabic']; ?></option>
									<option value="Returning Patient"><?= ($lang == "eng") ? $lang_con[124]['lang_eng'] : $lang_con[124]['lang_arabic']; ?> <?= ($lang == "eng") ? $lang_con[122]['lang_eng'] : $lang_con[122]['lang_arabic']; ?></option>
									<option value="Other"><?= ($lang == "eng") ? $lang_con[125]['lang_eng'] : $lang_con[125]['lang_arabic']; ?></option>
			                    </select>
			                </div>
			                <div id="input-date" class="col-lg-12">
			                	<input type="text" onfocus="(this.type='date')" name="date" class="form-control app_date" placeholder="<?= ($lang == "eng") ? $lang_con[116]['lang_eng'] : $lang_con[116]['lang_arabic']; ?> <?= ($lang == "eng") ? $lang_con[126]['lang_eng'] : $lang_con[126]['lang_arabic']; ?>" required> 
			                </div>
			                <div id="input-date" class="col-lg-12">
			                    <select id="inlineFormCustomSelect3" name="time" class="custom-select app_time" required>
			                        <option value=""><?= ($lang == "eng") ? $lang_con[134]['lang_eng'] : $lang_con[134]['lang_arabic']; ?>?*</option>
			                    </select>
			                </div>
			                <div id="input-name" class="col-lg-12">
			                	<input type="text" name="name" class="form-control name" placeholder="<?= ($lang == "eng") ? $lang_con[103]['lang_eng'] : $lang_con[103]['lang_arabic']; ?>*" required> 
			                </div>
			                <div id="input-email" class="col-lg-12">
			                	<input type="text" name="email" class="form-control email" placeholder="<?= ($lang == "eng") ? $lang_con[104]['lang_eng'] : $lang_con[104]['lang_arabic']; ?>*" required> 
			                </div>
			                <div id="input-phone" class="col-lg-12">
			                	<input type="tel" name="phone" class="form-control phone" placeholder="<?= ($lang == "eng") ? $lang_con[127]['lang_eng'] : $lang_con[127]['lang_arabic']; ?>*" required> 
			                </div>
			                <div id="input-message" class="col-lg-12 input-message">
			                	<textarea class="form-control message" name="message" rows="6" placeholder="<?= ($lang == "eng") ? $lang_con[128]['lang_eng'] : $lang_con[128]['lang_arabic']; ?>..."></textarea>
			                </div>
			                <div class="col-lg-12 form-btn">  
			                	<button type="submit" name="btn_appoint" class="btn btn-blue blue-hover submit"><?= ($lang == "eng") ? $lang_con[8]['lang_eng'] : $lang_con[8]['lang_arabic']; ?></button> 
			                </div>
			                <div class="col-lg-12 appointment-form-msg text-center">
			                	<div class="sending-msg"><span class="loading"></span></div>
			                </div>                    
		                </form>
					</div>
					<p class="p-sm grey-color mb-30">* <?= ($lang == "eng") ? $lang_con[118]['lang_eng'] : $lang_con[118]['lang_arabic']; ?></p>
	 			</div>
	 		</div>
			<aside id="sidebar" class="col-lg-4">
				<div id="txt-widget" class="sidebar-div mb-50">
					<h5 class="h5-sm steelblue-color"><?= ($lang == "eng") ? $siteData['site_name'] : $siteData['site_name_arabic']; ?></h5>
					<div class="txt-widget-unit mb-15 clearfix d-flex align-items-center">
						<!--<div class="txt-widget-avatar">-->
						<!--	<img src="<?= file_url().$siteData['site_logo_header'];?>" alt="testimonial-avatar">-->
						<!--</div>-->
						<div class="txt-widget-data">
							<!--<h5 class="h5-md steelblue-color">Dr. Jonathan Barnes</h5>	-->
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
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
<script>
    $("#inlineFormCustomSelect1").change(function(e){
        e.preventDefault();
        $("body *").css("cursor","progress");
        var departement = $(this).val();
        var language = '<?= ($lang == "eng") ? 'eng' : 'arab'; ?>';
        var act = "get_depart";
        $.ajax({
            data: {action: act, dpt:departement, txt_lang:language},
            type: "post",
            url: "<?= base_url();?>actions/submit-form.php",
            success:function(data)
            {
                var res = $.parseJSON(data);
                if(res.status == "success")
                {
                    var result = res.data;
                    $("#inlineFormCustomSelect2").empty();
                    var li = '<option><?= ($lang == "eng") ? $lang_con[120]['lang_eng'] : $lang_con[120]['lang_arabic']; ?> <?= ($lang == "eng") ? $lang_con[33]['lang_eng'] : $lang_con[33]['lang_arabic']; ?></option>';
                    $("#inlineFormCustomSelect2").append(li);
                    $(".messages").empty();
                    $.each(res.data, function(index, value){
                        <?php
                        if($lang == "eng")
                        {
                            ?>
                            li = '<option value="'+value.doc_id+'">'+value.doc_name+'</option>'
                            <?php
                        }
                        else
                        {
                            ?>
                            li = '<option value="'+value.doc_id+'">'+value.doc_name_arabic+'</option>'
                            <?php
                        }
                        ?>
                        $("#inlineFormCustomSelect2").append(li);
                    });
                    $("body *").css("cursor","default");
                }
                else
                {
                    var msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
                        '<strong>Error!</strong> '+ res.message +' .'+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                            '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                    '</div>';
                    $(".messages").empty();
                    $(".messages").append(msg);
                    $("body *").css("cursor","default");
                }
                
            }
        });
    });
    $(".appointment-form").validate({
        rules: {
            select: "required",
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
			select: "This field is required",
			name: "<?= ($lang == "eng") ? $lang_con[103]['lang_eng'] : $lang_con[103]['lang_arabic']; ?>",
			email: "<?= ($lang == "eng") ? $lang_con[108]['lang_eng'] : $lang_con[108]['lang_arabic']; ?>",
			phone: "<?= ($lang == "eng") ? $lang_con[129]['lang_eng'] : $lang_con[129]['lang_arabic']; ?>",
		},
		submitHandler: function(form){
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
                        alert(res.message);
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
        }
    });
    
    $(".app_date").change(function(e){
        e.preventDefault();
        $("body *").css("cursor","progress");
        var date = $(this).val();
        var doc = $('.doctor').val();
        var act = "get_time";
        var language = '<?= ($lang == "eng") ? 'eng' : 'arab'; ?>';
        $.ajax({
            data: {action: act, doctor:doc, app_date:date, txt_lang:language},
            type: "post",
            url: "<?= base_url();?>actions/submit-form.php",
            success:function(data)
            {
                var res = $.parseJSON(data);
                if(res.status == "success")
                {
                    var result = res.data;
                    $(".app_time").empty();
                    var li = '<option><?= ($lang == "eng") ? $lang_con[134]['lang_eng'] : $lang_con[134]['lang_arabic']; ?></option>';
                    $(".app_time").append(li);
                    $(".messages").empty();
                    $.each(res.data, function(index, value){
                        <?php
                        if($lang == "eng")
                        {
                            ?>
                            li = '<option value="'+value.time_id+'">'+value.time_start+' - '+value.time_end+'</option>'
                            <?php
                        }
                        else
                        {
                            ?>
                            li = '<option value="'+value.time_id+'">'+value.time_start_arabic+' - '+value.time_end_arabic+'</option>'
                            <?php
                        }
                        ?>
                        $(".app_time").append(li);
                    });
                    $("body *").css("cursor","default");
                }
                else
                {
                    var msg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">'+
                        '<strong>Error!</strong> '+ res.message +' .'+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                            '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                    '</div>';
                    $(".messages").empty();
                    $(".messages").append(msg);
                    $("body *").css("cursor","default");
                }
                
            }
        });
    });

  </script>