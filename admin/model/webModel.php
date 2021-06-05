<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_setting']))
	{
	    $data['timing_day']                     =post('days');
	    $data['timing_type']                    =post('time-type');
	    $data['timing_time']                    =post('timing_time');
		$data['site_name'] 		                = post('txt_site_name');
		$data['site_name_arabic'] 		        = $_POST['txt_site_name_ar'];
		$data['site_email'] 		            = post('txt_email');
		$data['site_phone'] 		            = post('txt_phone');
		$data['site_phone_arabic'] 		        = $_POST['txt_phone_arabic'];
		$data['site_meta_title'] 		        = post('txt_meta_title');
		$data['site_meta_title_arabic'] 		= $_POST['txt_meta_title_ar'];
		$data['site_facebook'] 		            = post('txt_fb');
		$data['site_twitter'] 		            = post('txt_twitter');
		$data['site_google'] 		            = post('txt_google');
		$data['site_linkedin'] 		            = post('txt_linkedin');
		$data['site_instagram'] 		        = post('txt_instagram');
		$data['welcome_heading'] 		        = post('txt_welcome_head');
		$data['welcome_heading_arabic'] 	    = $_POST['txt_welcome_head_arabic'];
		$data['site_welcome_text'] 		        = post('txt_welcome');
		$data['site_welcome_text_arabic'] 	    = $_POST['txt_welcome_arabic'];
		$data['footer_text'] 		            = post('txt_footer');
		$data['footer_text_arabic'] 		    = $_POST['txt_footer_arabic'];
		$data['site_meta_description'] 		    = post('txt_meta_desc');
		$data['site_meta_description_arabic'] 	= $_POST['txt_meta_desc_arabic'];
		$data['site_meta_tag'] 		            = $_POST['txt_meta_tag'];
		$data['site_meta_tag_arabic'] 		    = $_POST['txt_meta_tag_arabic'];
		$data['site_address'] 		            = post('txt_address');
		$data['site_address_arabic'] 		    = $_POST['txt_address_arabic'];
		$image_name                 	        = upload_image($_FILES,'txt_welcome_image', '../../upload/');
		if($image_name)
		{
		    $data['site_welcome_image'] 		= $image_name;
		}
		else
		{
		    $data['site_welcome_image']  	= '';
		}
		$image_name                 	        = upload_image($_FILES,'txt_thumb_image', '../../upload/');
		if($image_name)
		{
		    $data['static_background_image'] 		= $image_name;
		}
		else
		{
		    $data['static_background_image']  	= '';
		}
		$image_name                 	        = upload_image($_FILES,'txt_news_add', '../../upload/');
		if($image_name)
		{
		    $data['site_news_section_add'] 		= $image_name;
		}
		else
		{
		    $data['site_news_section_add']  	= '';
		}
		$image_name                 	        = upload_image($_FILES,'txt_detail_add', '../../upload/');
		if($image_name)
		{
		    $data['site_news_detail_add'] 		= $image_name;
		}
		else
		{
		    $data['site_news_detail_add']  	= '';
		}
		$image_name                 	        = upload_image($_FILES,'txt_head_logo', '../../upload/');
		if($image_name)
		{
		    $data['site_logo_header'] 		= $image_name;
		}
		else
		{
		    $data['site_logo_header']  	= '';
		}
		$image_name                 	        = upload_image($_FILES,'txt_footer_logo', '../../upload/');
		if($image_name)
		{
		    $data['site_logo_footer'] 		= $image_name;
		}
		else
		{
		    $data['site_logo_footer']  	= '';
		}
		$image_name                 	        = upload_image($_FILES,'txt_favicon', '../../upload/');
		if($image_name)
		{
		    $data['site_favicon'] 		= $image_name;
		}
		else
		{
		    $data['site_favicon']  	= '';
		}
		
		
		if(
		    $data['timing_day'] 		            != null && $data['timing_day'] 	             != "" &&
		    $data['timing_type'] 		            != null && $data['timing_type'] 	         != "" &&
		    $data['timing_time'] 		            != null && $data['timing_time'] 		     != "" &&
			$data['site_name'] 		                != null && $data['site_name'] 		             != "" &&
    		$data['site_name_arabic'] 		        != null && $data['site_name_arabic'] 		     != "" &&
    		$data['site_email'] 		            != null && $data['site_email'] 		             != "" &&
    		$data['site_phone'] 		            != null && $data['site_phone'] 		             != "" &&
    		$data['site_meta_title'] 		        != null && $data['site_meta_title'] 		     != "" &&
    		$data['site_meta_title_arabic'] 		!= null && $data['site_meta_title_arabic'] 		 != "" &&
    		$data['site_facebook'] 		            != null && $data['site_facebook'] 		         != "" &&
    		$data['site_twitter'] 		            != null && $data['site_twitter'] 		         != "" &&
    		$data['site_google'] 		            != null && $data['site_google'] 		         != "" &&
    		$data['site_linkedin'] 		            != null && $data['site_linkedin'] 		         != "" &&
    		$data['site_instagram'] 		        != null && $data['site_instagram'] 		         != "" &&
    		$data['welcome_heading'] 		        != null && $data['welcome_heading'] 		     != "" &&
    		$data['welcome_heading_arabic'] 	    != null && $data['welcome_heading_arabic'] 	     != "" &&
    		$data['site_welcome_text'] 		        != null && $data['site_welcome_text'] 		     != "" &&
    		$data['site_welcome_text_arabic'] 	    != null && $data['site_welcome_text_arabic'] 	 != "" &&
    		$data['footer_text'] 		            != null && $data['footer_text'] 		         != "" &&
    		$data['footer_text_arabic'] 		    != null && $data['footer_text_arabic'] 		     != "" &&
    		$data['site_meta_description'] 		    != null && $data['site_meta_description'] 		 != "" &&
    		$data['site_meta_description_arabic'] 	!= null && $data['site_meta_description_arabic'] != "" &&
    		$data['site_meta_tag'] 		            != null && $data['site_meta_tag'] 		         != "" &&
    		$data['site_meta_tag_arabic'] 		    != null && $data['site_meta_tag_arabic'] 		 != "" &&
    		$data['site_address'] 		            != null && $data['site_address'] 		         != "" &&
    		$data['site_welcome_image'] 		    != null && $data['site_welcome_image'] 		     != "" &&
    		$data['static_background_image'] 		!= null && $data['static_background_image'] 	 != "" &&
    		$data['site_news_section_add'] 		    != null && $data['site_news_section_add'] 		 != "" &&
    		$data['site_news_detail_add'] 		    != null && $data['site_news_detail_add'] 		 != "" &&
    		$data['site_logo_header'] 		        != null && $data['site_logo_header'] 		     != "" &&
    		$data['site_logo_footer'] 		        != null && $data['site_logo_footer'] 		     != "" &&
    		$data['site_favicon'] 		            != null && $data['site_favicon'] 		         != "" 
		)
		{
			if(insert($data,'tbl_settings'))
			{
				set_msg('Success','Site Data successfully','success');
				jump(admin_base_url()."web-setting");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				jump(admin_base_url()."web-setting");
			}
		}
		else
		{
			set_msg('Fields validation','Please enter all fields details','error');
			jump(admin_base_url()."web-setting");
		}
	}
	else if(isset($_POST['btn_edit_setting']))
	{
		$setting_id 						    = post('txt_site_id');
		$data['site_name'] 		                = post('txt_site_name');
		$data['site_name_arabic'] 		        = $_POST['txt_site_name_ar'];
		$data['site_email'] 		            = post('txt_email');
		$data['site_phone'] 		            = post('txt_phone');
		$data['site_phone_arabic'] 		        = $_POST['txt_phone_arabic'];
		$data['site_meta_title'] 		        = post('txt_meta_title');
		$data['site_meta_title_arabic'] 		= $_POST['txt_meta_title_ar'];
		$data['site_facebook'] 		            = post('txt_fb');
		$data['site_twitter'] 		            = post('txt_twitter');
		$data['site_google'] 		            = post('txt_google');
		$data['site_linkedin'] 		            = post('txt_linkedin');
		$data['site_instagram'] 		        = post('txt_instagram');
		$data['welcome_heading'] 		        = post('txt_welcome_head');
		$data['welcome_heading_arabic'] 	    = $_POST['txt_welcome_head_arabic'];
		$data['site_welcome_text'] 		        = post('txt_welcome');
		$data['site_welcome_text_arabic'] 	    = $_POST['txt_welcome_arabic'];
		$data['footer_text'] 		            = post('txt_footer');
		$data['footer_text_arabic'] 		    = $_POST['txt_footer_arabic'];
		$data['site_meta_description'] 		    = post('txt_meta_desc');
		$data['site_meta_description_arabic'] 	= $_POST['txt_meta_desc_arabic'];
		$data['site_meta_tag'] 		            = $_POST['txt_meta_tag'];
		$data['site_meta_tag_arabic'] 		    = $_POST['txt_meta_tag_arabic'];
		$data['site_address'] 		            = post('txt_address');
		$data['site_address_arabic'] 		    = $_POST['txt_address_arabic'];
		$image_name                 	        = upload_image($_FILES,'txt_welcome_image', '../../upload/');
		if($image_name)
		{
		    $data['site_welcome_image'] 		= $image_name;
		}
		$image_name                 	        = upload_image($_FILES,'txt_thumb_image', '../../upload/');
		if($image_name)
		{
		    $data['static_background_image'] 	= $image_name;
		}
		$image_name                 	        = upload_image($_FILES,'txt_news_add', '../../upload/');
		if($image_name)
		{
		    $data['site_news_section_add'] 		= $image_name;
		}
		$image_name                 	        = upload_image($_FILES,'txt_detail_add', '../../upload/');
		if($image_name)
		{
		    $data['site_news_detail_add'] 		= $image_name;
		}
		$image_name                 	        = upload_image($_FILES,'txt_head_logo', '../../upload/');
		if($image_name)
		{
		    $data['site_logo_header'] 		    = $image_name;
		}
		$image_name                 	        = upload_image($_FILES,'txt_footer_logo', '../../upload/');
		if($image_name)
		{
		    $data['site_logo_footer'] 		    = $image_name;
		}
		$image_name                 	        = upload_image($_FILES,'txt_favicon', '../../upload/');
		if($image_name)
		{
		    $data['site_favicon'] 		= $image_name;
		}
// 		echo "<pre>";
// 		print_r($data);
// 		die();
		if(
			$data['site_name'] 		                != null && $data['site_name'] 		             != "" &&
    		$data['site_name_arabic'] 		        != null && $data['site_name_arabic'] 		     != "" &&
    		$data['site_email'] 		            != null && $data['site_email'] 		             != "" &&
    		$data['site_phone'] 		            != null && $data['site_phone'] 		             != "" &&
    		$data['site_meta_title'] 		        != null && $data['site_meta_title'] 		     != "" &&
    		$data['site_meta_title_arabic'] 		!= null && $data['site_meta_title_arabic'] 		 != "" &&
    		$data['site_facebook'] 		            != null && $data['site_facebook'] 		         != "" &&
    		$data['site_twitter'] 		            != null && $data['site_twitter'] 		         != "" &&
    		$data['site_google'] 		            != null && $data['site_google'] 		         != "" &&
    		$data['site_linkedin'] 		            != null && $data['site_linkedin'] 		         != "" &&
    		$data['site_instagram'] 		        != null && $data['site_instagram'] 		         != "" &&
    		$data['welcome_heading'] 		        != null && $data['welcome_heading'] 		     != "" &&
    		$data['welcome_heading_arabic'] 	    != null && $data['welcome_heading_arabic'] 	     != "" &&
    		$data['site_welcome_text'] 		        != null && $data['site_welcome_text'] 		     != "" &&
    		$data['site_welcome_text_arabic'] 	    != null && $data['site_welcome_text_arabic'] 	 != "" &&
    		$data['footer_text'] 		            != null && $data['footer_text'] 		         != "" &&
    		$data['footer_text_arabic'] 		    != null && $data['footer_text_arabic'] 		     != "" &&
    		$data['site_meta_description'] 		    != null && $data['site_meta_description'] 		 != "" &&
    		$data['site_meta_description_arabic'] 	!= null && $data['site_meta_description_arabic'] != "" &&
    		$data['site_meta_tag'] 		            != null && $data['site_meta_tag'] 		         != "" &&
    		$data['site_meta_tag_arabic'] 		    != null && $data['site_meta_tag_arabic'] 		 != "" &&
    		$data['site_address'] 		            != null && $data['site_address'] 		         != ""
		)
		{
		    where('setting_id',$setting_id);
			if(update($data,'tbl_settings'))
			{
				set_msg('Success','Site data updated successfully','success');
				jump(admin_base_url()."web-setting");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				jump(admin_base_url()."web-setting");
			}
		}
		else
		{
			set_msg('Fields validation','Please enter all fields details','error');
			jump(admin_base_url()."web-setting");
		}
	}
	else if(isset($_POST['btn_save_language']))
	{
	    $data['lang_eng']    = post('txt_eng_lang');
	    $data['lang_arabic'] = $_POST['txt_ar_lang'];
	    if($data['lang_eng'] != "" && $data['lang_eng'] != null && $data['lang_arabic'] != null && $data['lang_arabic'] != "")
	    {
	        if(insert($data,'tbl_language'))
			{
				set_msg('Success','Language is added successfully','success');
				jump(admin_base_url()."list-language");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				jump(admin_base_url()."add-language");
			}
	    }
	    else
	    {
	        set_msg('Fields validation','Please enter all fields details','error');
			jump(admin_base_url()."add-language");
	    }
	}else if(isset($_POST['btn_edit_language']))
	{
	    $language_id         = post('txt_lang_id');
	    $data['lang_eng']    = post('txt_eng_lang');
	    $data['lang_arabic'] = $_POST['txt_ar_lang'];
	    if($data['lang_eng'] != "" && $data['lang_eng'] != null && $data['lang_arabic'] != null && $data['lang_arabic'] != "")
	    {
	        where('lang_id',$language_id);
	        if(update($data,'tbl_language'))
			{
				set_msg('Success','Language is added successfully','success');
				jump(admin_base_url()."list-language");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				jump(admin_base_url()."add-language");
			}
	    }
	    else
	    {
	        set_msg('Fields validation','Please enter all fields details','error');
			jump(admin_base_url()."add-language");
	    }
	}
	else if(isset($_POST['btn_save_aboutus']))
	{
	    $setting_id         = post('txt_site_id');
	    $about_us           = $_POST['txt_desc'];
	    $about_us_arabic    = $_POST['txt_desc_arabic'];
	    if($about_us != "" && $about_us != null && $about_us_arabic != "" && $about_us_arabic != null)
	    {
	        $res = query("UPDATE tbl_settings SET about_us = '".htmlspecialchars(htmlentities($about_us))."', about_us_arabic = '".$about_us_arabic."' WHERE setting_id = '".$setting_id."' ");
	        
	        if($res)
	        {
				set_msg('Success','About us page is successfully updated','success');
				jump(admin_base_url()."about-us");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				jump(admin_base_url()."about-us");
			}
	    }
	    else
	    {
	        set_msg('Fields validation','Please enter all fields details','error');
			jump(admin_base_url()."about-us");
	    }
	}
	else if($_POST['btn_save_timing'])
	{
	    $data['monday_start_time']      = post('monday_start_time');
	    $data['monday_end_time']        = post('monday_end_time');
	    $data['tuesday_start_time']     = post('tuesday_start_time');
	    $data['tuesday_end_time']       = post('tuesday_end_time');
	    $data['wednesday_start_time']   = post('wednesday_start_time');
	    $data['wednesday_end_time']     = post('wednesday_end_time');
	    $data['thursday_start_time']    = post('thursday_start_time');
	    $data['thursday_end_time']      = post('thursday_end_time');
	    $data['friday_start_time']      = post('friday_start_time');
	    $data['friday_end_time']        = post('friday_end_time');
	    $data['saturday_start_time']    = post('saturday_start_time');
	    $data['saturday_end_time']      = post('saturday_end_time');
	    $data['sunday_start_time']      = post('sunday_start_time');
	    $data['sunday_end_time']        = post('sunday_end_time');
	    if(insert($data,'tbl_timings'))
		{
			set_msg('Success','Timings is added successfully','success');
			jump(admin_base_url()."timings");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			jump(admin_base_url()."timings");
		}
	}
	else if($_POST['btn_edit_timing'])
	{
	    $timing_id = post('txt_time_id');
	    $data['monday_start_time']      = post('monday_start_time');
	    $data['monday_end_time']        = post('monday_end_time');
	    $data['tuesday_start_time']     = post('tuesday_start_time');
	    $data['tuesday_end_time']       = post('tuesday_end_time');
	    $data['wednesday_start_time']   = post('wednesday_start_time');
	    $data['wednesday_end_time']     = post('wednesday_end_time');
	    $data['thursday_start_time']    = post('thursday_start_time');
	    $data['thursday_end_time']      = post('thursday_end_time');
	    $data['friday_start_time']      = post('friday_start_time');
	    $data['friday_end_time']        = post('friday_end_time');
	    $data['saturday_start_time']    = post('saturday_start_time');
	    $data['saturday_end_time']      = post('saturday_end_time');
	    $data['sunday_start_time']      = post('sunday_start_time');
	    $data['sunday_end_time']        = post('sunday_end_time');
	    where('timing_id',$timing_id);
	    if(update($data,'tbl_timings'))
		{
			set_msg('Success','Timings is added successfully','success');
			jump(admin_base_url()."timings");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			jump(admin_base_url()."timings");
		}
	}
	else
	{
		jump(admin_base_url());
	}
}
else
{
	jump(admin_base_url());
}