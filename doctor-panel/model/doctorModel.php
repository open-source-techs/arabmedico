<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(isset($_POST['btn_edit_doc']))
	{
		$doctor_id 							= post('txt_doc_id');
		$data['doc_name'] 					= post('txt_doc_name');
		$data['doc_name_arabic'] 			= $_POST['txt_doc_name_arabic'];
		$data['doc_degree'] 				= post('txt_doc_degree');
		$data['doc_degree_arabic'] 			= $_POST['txt_doc_degree_arabic'];
		$data['doc_job_title'] 				= post('txt_job_title');
		$data['doc_job_title_arabic'] 		= $_POST['txt_job_title_arabic'];
		$data['doc_speciality'] 			= post('txt_doc_speciality');
		$data['doc_speciality_arabic'] 		= $_POST['txt_doc_speciality_arabic'];
		$data['doc_reg_no'] 				= post('txt_doc_reg_no');
		$data['doc_reg_no_arabic'] 			= $_POST['txt_doc_reg_no_arabic'];
		$data['doc_area_of_experty'] 		= post('txt_doc_experty');
		$data['doc_area_of_experty_arabic'] = $_POST['txt_doc_experty_arabic'];
		$data['doc_lang1'] 					= post('txt_doc_lang1');
		$data['doc_lang1_arabic'] 			= $_POST['txt_doc_lang1_arabic'];
		$data['doc_lang2'] 					= post('txt_doc_lang2');
		$data['doc_lang2_arabic'] 			= $_POST['txt_doc_lang2_arabic'];
		$data['doc_lang3_arabic'] 			= $_POST['txt_doc_lang3_arabic'];
		$data['doc_lang4'] 					= post('txt_doc_lang4');
		$data['doc_lang4_arabic'] 			= $_POST['txt_doc_lang4_arabic'];
		$data['doc_lang5'] 					= post('txt_doc_lang5');
		$data['doc_lang5_arabic'] 			= $_POST['txt_doc_lang5_arabic'];
		$data['doc_website_url	'] 			= post('doc_web_url');
		$data['doc_facebook_url'] 			= post('doc_facebook_url');
		$data['doc_twitter_url']			= post('doc_tiwtter_url');
		$data['doc_linkedin_url'] 			= post('doc_linkedin_url');
		$data['doc_youtube_url'] 			= post('doc_youtube_url');
		$data['doc_instagram_url'] 			= post('doc_instagram_url');
		$data['doc_status_head']            = 0;
		$data['doc_intro'] 					= htmlentities(htmlspecialchars($_POST['txt_short_desc']));
		$data['doc_intro_arabic'] 			= htmlentities(htmlspecialchars($_POST['txt_short_desc_arabic']));
		$data['doc_details'] 				= htmlentities(htmlspecialchars($_POST['txt_desc']));
		$data['doc_details_arabic'] 		= htmlentities(htmlspecialchars($_POST['txt_desc_arabic']));
		$data['doctor_department'] 		    = post('txt_depart');
		$image_name                 		= upload_image($_FILES,'txt_profile', '../../upload/');
		if($image_name)
		{
		    $data['doc_image'] 				= $image_name;
		}
		$image_name1                 		= upload_image($_FILES,'txt_banner', '../../upload/');
		if($image_name1)
		{
		    $data['doc_banner'] 			= $image_name1;
		}

		if(
			$data['doc_name'] 					!= "" && $data['doc_name'] 						!= null &&
			$data['doc_name_arabic'] 			!= "" && $data['doc_name_arabic'] 				!= null &&
			$data['doc_degree'] 				!= "" && $data['doc_degree'] 					!= null &&
			$data['doc_degree_arabic'] 			!= "" && $data['doc_degree_arabic'] 			!= null &&
			$data['doc_job_title'] 				!= "" && $data['doc_job_title'] 				!= null &&
			$data['doc_job_title_arabic'] 		!= "" && $data['doc_job_title_arabic'] 			!= null &&
			$data['doc_speciality'] 			!= "" && $data['doc_speciality'] 				!= null &&
			$data['doc_speciality_arabic'] 		!= "" && $data['doc_speciality_arabic'] 		!= null &&
			$data['doc_reg_no'] 				!= "" && $data['doc_reg_no'] 					!= null &&
			$data['doc_area_of_experty'] 		!= "" && $data['doc_area_of_experty'] 			!= null &&
			$data['doc_area_of_experty_arabic'] != "" && $data['doc_area_of_experty_arabic'] 	!= null &&
			$data['doc_intro'] 					!= "" && $data['doc_intro'] 					!= null &&
			$data['doc_intro_arabic'] 			!= "" && $data['doc_intro_arabic'] 				!= null
		)
		{
			where('doc_id ',$doctor_id);
			if(update($data,'tbl_doctor'))
			{
				set_msg('Success','Profile is updated successfully','success');
				jump(admin_base_url()."profile");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				echo "<script>window.history.go(-1);</script>";
			}
		}
		else
		{
			set_msg('Fields Error','Please fill required fields with data','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_update_profile']))
	{
	    $doctor_id 							= post('txt_doc_id');
		$data['doc_name'] 					= post('txt_doc_name');
		$data['doc_name_arabic'] 			= $_POST['txt_doc_name_arabic'];
		$data['doc_email'] 					= post('txt_doc_email');
		$data['doc_slug'] 					= post('txt_doc_slug');
		$data['doc_degree'] 				= post('txt_doc_degree');
		$data['doc_degree_arabic'] 			= $_POST['txt_doc_degree_arabic'];
		$data['doc_job_title'] 				= post('txt_job_title');
		$data['doc_job_title_arabic'] 		= $_POST['txt_job_title_arabic'];
		$data['doc_speciality'] 			= post('txt_doc_speciality');
		$data['doc_speciality_arabic'] 		= $_POST['txt_doc_speciality_arabic'];
		$data['doc_reg_no'] 				= post('txt_doc_reg_no');
		$data['doc_reg_no_arabic'] 			= changeNumberToArabic($data['doc_reg_no']);
		$data['doc_area_of_experty'] 		= post('txt_doc_experty');
		$data['doc_area_of_experty_arabic'] = $_POST['txt_doc_experty_arabic'];
		$data['doc_lang1'] 					= post('txt_doc_lang1');
		$data['doc_lang1_arabic'] 			= $_POST['txt_doc_lang1_arabic'];
		$data['doc_lang2'] 					= post('txt_doc_lang2');
		$data['doc_lang2_arabic'] 			= $_POST['txt_doc_lang2_arabic'];
		$data['doc_lang3'] 					= post('txt_doc_lang3');
		$data['doc_lang3_arabic'] 			= $_POST['txt_doc_lang3_arabic'];
		$data['doc_lang4'] 					= post('txt_doc_lang4');
		$data['doc_lang4_arabic'] 			= $_POST['txt_doc_lang4_arabic'];
		$data['doc_lang5'] 					= post('txt_doc_lang5');
		$data['doc_lang5_arabic'] 			= $_POST['txt_doc_lang5_arabic'];
		$data['doc_intro'] 					= safeString($_POST['txt_short_desc']);
		$data['doc_intro_arabic'] 			= safeString($_POST['txt_short_desc_arabic']);
		$data['doc_country'] 				= post('txt_country');
		$data['doc_city'] 					= post('txt_city');
		$data['doc_area'] 					= post('txt_area');
		$data['doc_phone_no'] 				= post('txt_doc_number');
		$data['doc_phone_no_ar'] 			= changeNumberToArabic($data['doc_phone_no']);
		$image_name                 		= upload_image($_FILES,'txt_profile', '../../upload/');
		if($image_name)
		{
		    $data['doc_image'] 				= $image_name;
		}
		$image_name1                 		= upload_image($_FILES,'txt_banner', '../../upload/');
		if($image_name1)
		{
		    $data['doc_banner'] 			= $image_name1;
		}
		
		where('doc_id ',$doctor_id);
		if(update($data,'tbl_doctor'))
		{
			set_msg('Success','Profile is updated successfully','success');
			jump(admin_base_url()."account");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}	
	}
	else if(isset($_POST['btn_myprofile']))
	{
	    $doctor_id 							= post('txt_doc_id');
		$data['doc_details'] 				= htmlentities(htmlspecialchars($_POST['txt_desc']));
		$data['doc_details_arabic'] 		= htmlentities(htmlspecialchars($_POST['txt_desc_arabic']));
		where('doc_id ',$doctor_id);
		if(update($data,'tbl_doctor'))
		{
			set_msg('Success','Profile is updated successfully','success');
			jump(admin_base_url()."myprofile");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}
		
	}
	else if(isset($_POST['btn_add_location']))
	{
	    $data['loc_doc_id']         = post('txt_doc_id');
	    $data['loc_name']           = post('txt_name');
	    $data['loc_name_ar']        = $_POST['txt_name_arabic'];
	    $data['loc_building']       = post('txt_building');
	    $data['loc_building_ar']    = $_POST['txt_building_ar'];
	    $data['loc_address']        = post('txt_street_add');
	    $data['loc_address_ar']     = $_POST['txt_street_add_ar'];
	    $data['loc_zip']            = post('txt_zip');
	    $data['loc_country']        = post('txt_country');
	    $data['loc_city']           = post('txt_city');
	    $data['loc_area']           = post('txt_area');
	    $data['loc_email']          = post('txt_email');
	    $data['loc_number']         = post('txt_number');
	    $data['loc_number_ar']      = changeNumberToArabic($data['loc_number']);
	    
	    if(insert($data, 'tbl_doc_practice_loc'))
	    {
			set_msg('Success','Location is added successfully','success');
			jump(admin_base_url()."account");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}
	    
	}
	else if(isset($_POST['btn_upload_logo']))
	{
	    $doctor_id 							= post('txt_doc_id');
	    $image_name                 		= upload_image($_FILES,'txt_image', '../../upload/');
		if($image_name)
		{
		    $data['doc_logo'] 				= $image_name;
		    where('doc_id ',$doctor_id);
    		if(update($data,'tbl_doctor'))
    		{
    			set_msg('Success','Logo is updated successfully','success');
    			jump(admin_base_url()."branding");
    		}
    		else
    		{
    			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
    			echo "<script>window.history.go(-1);</script>";
    		}
		}
		else
		{
		    set_msg('Upload error','Unable to upload image. Please try again later.','error');
    			echo "<script>window.history.go(-1);</script>";
		}
		
	}
	else if(isset($_POST['action']) && $_POST['action'] == "getcities")
	{
	    $countryID = post('countryID');
	    $sql = query("SELECT * FROM tbl_cities WHERE city_country = '$countryID' AND city_active = 1");
	    if(nrows($sql) > 0)
	    {
	        $res_arr = array();
	        while($val = fetch($sql))
	        {
	            $res_arr[] = $val;
	        }
	        $res = array(
	            "msg" => "success",
	            "data" => $res_arr
            );
	    }
	    else
	    {
	        $res = array(
	            "msg" => "error",
	            "data" => null
            );
	    }
	    echo json_encode($res);
	}
	else if(isset($_POST['action']) && $_POST['action'] == "getarea")
	{
	    $cityID = post('cityID');
	    $sql = query("SELECT * FROM tbl_areas WHERE area_city = '$cityID' AND area_active = 1");
	    if(nrows($sql) > 0)
	    {
	        $res_arr = array();
	        while($val = fetch($sql))
	        {
	            $res_arr[] = $val;
	        }
	        $res = array(
	            "msg" => "success",
	            "data" => $res_arr
            );
	    }
	    else
	    {
	        $res = array(
	            "msg" => "error",
	            "data" => null
            );
	    }
	    echo json_encode($res);
	}
	else if(isset($_POST['action']) && $_POST['action'] == "getCondition")
	{
	    $specialityID = post('speciality');
	    $sql = query("SELECT * FROM tbl_treatment WHERE select_speciality = '$specialityID' AND treatment_status = 1");
	    if(nrows($sql) > 0)
	    {
	        $res_arr = array();
	        while($val = fetch($sql))
	        {
	            $res_arr[] = $val;
	        }
	        $res = array(
	            "msg" => "success",
	            "data" => $res_arr
            );
	    }
	    else
	    {
	        $res = array(
	            "msg" => "error",
	            "data" => null
            );
	    }
	    echo json_encode($res);
	}
	else if(isset($_POST['action']) && $_POST['action'] == "checkslug")
	{
	    $slug = post('slug');
	    $sql = query("SELECT * FROM tbl_doctor WHERE doc_slug = '$slug' AND doc_id != ".get_sess("userdata")['doc_id']);
	    if(nrows($sql) > 0)
	    {
	        echo "exist";
	    }
	    else
	    {
	        echo "available";
	    }
	}
	else if(isset($_POST['btn_upload_image']))
	{
	    $data['doc_gall_docID'] 	= post('txt_doc_id');
		$image_name                 = upload_image($_FILES,'txt_image', '../../upload/');
		if($image_name)
		{
		    $data['doc_gall_img'] 	= $image_name;
		    if(insert($data,'tbl_doctor_gallery'))
    		{
    			set_msg('Success','photo is uploaded successfully','success');
    			jump(admin_base_url()."photo-gallery");
    		}
    		else
    		{
    			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
    			echo "<script>window.history.go(-1);</script>";
    		}	
		}
		else
		{
		    set_msg('Upload error','Unable to upload photo. Please try again later.','error');
    		echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_video_image']))
	{
	    $data['doc_video_doc']  = post('txt_doc_id');
	    $data['doc_video_code'] = post('txt_video');
	    if(insert($data,'tbl_doc_video'))
		{
			set_msg('Success','Video is uploaded successfully','success');
			jump(admin_base_url()."video-gallery");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}	
	}
	else if(isset($_POST['btn_upload_slide']))
	{
	    $data['doc_slider_doc'] 	    = post('txt_doc_id');
	    $data['doc_slider_title']       = post('doc_slider_title');
	    $data['doc_silder_title_ar']    = $_POST['doc_slider_title_ar'];
		$image_name                     = upload_image($_FILES,'txt_image', '../../upload/');
		if($image_name)
		{
		    $data['doc_slider_image'] 	= $image_name;
		    if(insert($data,'tbl_doc_slider'))
    		{
    			set_msg('Success','Slide is uploaded successfully','success');
    			jump(admin_base_url()."branding");
    		}
    		else
    		{
    			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
    			echo "<script>window.history.go(-1);</script>";
    		}	
		}
		else
		{
		    set_msg('Upload error','Unable to upload photo. Please try again later.','error');
    		echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_upload_award']))
	{
	    $data['doc_award_doc'] 	= post('txt_doc_id');
		$image_name                 = upload_image($_FILES,'txt_award', '../../upload/');
		if($image_name)
		{
		    $data['doc_award_image'] 	= $image_name;
		    if(insert($data,'tbl_doc_awards'))
    		{
    			set_msg('Success','Award Image is uploaded successfully','success');
    			jump(admin_base_url()."branding");
    		}
    		else
    		{
    			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
    			echo "<script>window.history.go(-1);</script>";
    		}	
		}
		else
		{
		    set_msg('Upload error','Unable to upload photo. Please try again later.','error');
    		echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_doc_service']))
	{
	    $data['service_desc'] 	    = post('txt_service');
	    $data['service_desc_ar'] 	= $_POST['txt_service_arabic'];
	    $data['service_amount'] 	= post('txt_charges');
	    $data['service_doc'] 	    = post('txt_doc_id');
	    
	    if(insert($data,'tbl_doc_services'))
		{
			set_msg('Success','Service is added successfully','success');
			jump(admin_base_url()."account");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_doc_appoint']))
	{
	    $data['doc_appoint_title'] 	    = post('txt_appoint');
	    $data['doc_appoint_title_ar'] 	= $_POST['txt_appoint_arabic'];
	    $data['app_hospName'] 	        = post('txt_hospName');
	    $data['app_hospName_ar'] 	    = $_POST['txt_hospName_ar'];
	    $data['app_hospCity'] 	        = post('txt_city');
	    $data['app_hospCountry'] 	    = post('txt_country');
	    $data['app_hospStartDate'] 	    = post('txt_start_date');
	    $data['app_hospStartDate_ar'] 	= changeNumberToArabic($data['app_hospStartDate']);
	    
	    if($_POST['txt_end_cont'] == "cont")
	    {
	        $data['app_hospEndDate'] 	    = 'Present';
	        $data['app_hospEndDate_ar']     = 'هدايا';
	    }
	    else
	    {
	        $data['app_hospEndDate'] 	    = post('txt_end_arabic');
	        $data['app_hospEndDate_ar']     = changeNumberToArabic($data['app_hospEndDate']);
	    }
	    $data['doc_appoint_doc'] 	        = post('txt_doc_id');
	    $image_name                         = upload_image($_FILES,'txt_logo', '../../upload/');
		if($image_name)
		{
		    $data['app_hospLogo'] = $image_name;
		}
		else
		{
		    $data['app_hospLogo'] = '';
		}
	    if(insert($data,'tbl_doc_appoint'))
		{
			set_msg('Success','Appoint is added successfully','success');
			jump(admin_base_url()."account");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_doc_intrest']))
	{
	    $data['intrest_name'] 	    = post('txt_intrest');
	    $data['intrest_name_ar'] 	= $_POST['txt_intrest_arabic'];
	    $data['intrest_doc'] 	    = post('txt_doc_id');
	    
	    if(insert($data,'tbl_special_intrest'))
		{
			set_msg('Success','Intrest is added successfully','success');
			jump(admin_base_url()."account");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_doc_membership']))
	{
	    $data['prof_doc'] 	        = post('txt_doc_id');
	    $data['prof_name'] 	        = post('txt_intrest');
	    $data['prof_name_ar'] 	    = $_POST['txt_intrest_arabic'];
	    $data['prof_bodyname'] 	    = post('txt_prof_body');
	    $data['prof_bodyname_ar'] 	= $_POST['txt_prof_body_ar'];
	    $data['prof_city'] 	        = post('txt_country');
	    $data['prof_country'] 	    = post('txt_city');
	    $data['prof_yearfrom'] 	    = post('txt_from_year');
	    $data['prof_yearto'] 	    = post('txt_to_year');
	    $image_name                 = upload_image($_FILES,'mem_profile', '../../upload/');
		if($image_name)
		{
		    $data['prof_logo'] = $image_name;
		}
		else
		{
		    $data['prof_logo'] = '';
		}
	    if(insert($data,'tbl_prof_mem'))
		{
			set_msg('Success','Professional Member is added successfully','success');
			jump(admin_base_url()."account");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_doc_edu']))
	{
	    $data['edu_doc'] 	        = post('txt_doc_id');
	    $data['edu_institute'] 	    = post('txt_institute');
	    $data['edu_institute_ar']   = $_POST['txt_institute_ar'];
	    $data['edu_degree'] 	    = post('txt_degree');
	    $data['edu_degree_ar'] 	    = $_POST['txt_degree_ar'];
	    $data['edu_country'] 	    = post('txt_country');
	    $data['edu_city']           = post('txt_city');
	    $data['edu_year'] 	        = post('txt_from_year');
	    $image_name                 = upload_image($_FILES,'edu_profile', '../../upload/');
		if($image_name)
		{
		    $data['edu_logo'] = $image_name;
		}
		else
		{
		    $data['edu_logo'] = '';
		}
	    if(insert($data,'tbl_doc_education'))
		{
			set_msg('Success','Educational Institute is added successfully','success');
			jump(admin_base_url()."account");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_doc_institute']))
	{
	    $data['institute_doc'] 	    = post('txt_doc_id');
	    $data['institute_name']     = post('txt_institute');
	    $data['institute_name_ar'] 	    = $_POST['txt_institute_arabic'];
	    
	    if(insert($data,'tbl_doc_institue'))
		{
			set_msg('Success','Institute Member is added successfully','success');
			jump(admin_base_url()."account");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_speciality']))
	{
	    $data['doc_speciality'] = post('txt_speciality');
	    $data['doc_spec_doc'] 	= post('txt_doc_id');
	    
	    if(insert($data,'tbl_doc_speciality'))
		{
			set_msg('Success','Date is added successfully','success');
			jump(admin_base_url()."account");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_treatment']))
	{
	    $data['treatment_speciality']   = post('txt_speciality');
	    $data['treatment_doc'] 	        = post('txt_doc_id');
	    $data['treatment_condition']    = post('txt_treatment');
	    
	    if(insert($data,'tbl_doc_treatments'))
		{
			set_msg('Success','Date is added successfully','success');
			jump(admin_base_url()."account");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else
	{
		jump(admin_base_url());
	}
}
else if($_SERVER['REQUEST_METHOD'] == "GET")
{
	if(isset($_GET['act']) && $_GET['act'] == "del")
	{
		if(isset($_GET['doc_id']) && $_GET['doc_id'] != "" && $_GET['doc_id'] != null && $_GET['doc_id'] > 0 )
		{
			$doc_id = $_GET['doc_id'];
			where('doc_id',$doc_id);
			if(delete('tbl_doctor'))
			{
				set_msg('Success','Doctor is deleted successfully','success');
				if(isset($_GET['dpt_id']))
				{
				    jump(admin_base_url()."dpt-ourteam-panel?dpt_id=".$_GET['dpt_id']);
				}
				else
				{
				    jump(admin_base_url()."list-doctors");
				}
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				if(isset($_GET['dpt_id']))
				{
				    jump(admin_base_url()."dpt-ourteam-panel?dpt_id=".$_GET['dpt_id']);
				}
				else
				{
				    jump(admin_base_url()."list-doctors");
				}
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			if(isset($_GET['dpt_id']))
			{
			    jump(admin_base_url()."dpt-ourteam-panel?dpt_id=".$_GET['dpt_id']);
			}
			else
			{
			    jump(admin_base_url()."list-doctors");
			}
		}
	}
	else if(isset($_GET['act']) && $_GET['act'] == "del-img")
	{
	    if(isset($_GET['gall_id']) && $_GET['gall_id'] != "" && $_GET['gall_id'] != null && $_GET['gall_id'] > 0 )
	    {
	        $gall_id = $_GET['gall_id'];
			where('doc_gall_id',$gall_id);
			if(delete('tbl_doctor_gallery'))
			{
			    set_msg('Success','Photo is deleted successfully','success');
			    jump(admin_base_url()."photo-gallery");
			}
			else
			{
			    set_msg('Query Error','Unable to process your request. Please try again later','error');
			    jump(admin_base_url()."photo-gallery");
			}
	    }
	    else
	    {
	        set_msg('Data Error','No Record Found','error');
	        jump(admin_base_url()."photo-gallery");
	    }
	}
	else if(isset($_GET['act']) && $_GET['act'] == "del-video")
	{
	    if(isset($_GET['vid_id']) && $_GET['vid_id'] != "" && $_GET['vid_id'] != null && $_GET['vid_id'] > 0 )
	    {
	        $vid_id = $_GET['vid_id'];
			where('doc_video_id',$vid_id);
			if(delete('tbl_doc_video'))
			{
			    set_msg('Success','Video is deleted successfully','success');
			    jump(admin_base_url()."video-gallery");
			}
			else
			{
			    set_msg('Query Error','Unable to process your request. Please try again later','error');
			    jump(admin_base_url()."video-gallery");
			}
	    }
	    else
	    {
	        set_msg('Data Error','No Record Found','error');
	        jump(admin_base_url()."video-gallery");
	    }
	}
	else if(isset($_GET['act']) && $_GET['act'] == "del-slide")
	{
	    if(isset($_GET['sld_id']) && $_GET['sld_id'] != "" && $_GET['sld_id'] != null && $_GET['sld_id'] > 0 )
	    {
	        $sld_id = $_GET['sld_id'];
			where('doc_slider_id',$sld_id);
			if(delete('tbl_doc_slider'))
			{
			    set_msg('Success','slide is deleted successfully','success');
			    jump(admin_base_url()."branding");
			}
			else
			{
			    set_msg('Query Error','Unable to process your request. Please try again later','error');
			    jump(admin_base_url()."branding");
			}
	    }
	    else
	    {
	        set_msg('Data Error','No Record Found','error');
	        jump(admin_base_url()."branding");
	    }
	}
	else if(isset($_GET['act']) && $_GET['act'] == "del-award")
	{
	    if(isset($_GET['award_id']) && $_GET['award_id'] != "" && $_GET['award_id'] != null && $_GET['award_id'] > 0 )
	    {
	        $award_id = $_GET['award_id'];
			where('can_award_id',$award_id);
			if(delete('tbl_can_awards'))
			{
			    set_msg('Success','Award Image is deleted successfully','success');
			    jump(admin_base_url()."branding");
			}
			else
			{
			    set_msg('Query Error','Unable to process your request. Please try again later','error');
			    jump(admin_base_url()."branding");
			}
	    }
	    else
	    {
	        set_msg('Data Error','No Record Found','error');
	        jump(admin_base_url()."branding");
	    }
	}
	else if(isset($_GET['act']) && $_GET['act'] == "del-loc")
	{
	    if(isset($_GET['loc_id']) && $_GET['loc_id'] != "" && $_GET['loc_id'] != null && $_GET['loc_id'] > 0 )
	    {
	        $loc_id = $_GET['loc_id'];
			where('loc_id',$loc_id);
			if(delete('tbl_doc_practice_loc'))
			{
			    set_msg('Success','Location is deleted successfully','success');
			    jump(admin_base_url()."account");
			}
			else
			{
			    set_msg('Query Error','Unable to process your request. Please try again later','error');
			    jump(admin_base_url()."account");
			}
	    }
	    else
	    {
	        set_msg('Data Error','No Record Found','error');
	        jump(admin_base_url()."account");
	    }
	}
	else if(isset($_GET['act']) && $_GET['act'] == "del-service")
	{
	    if(isset($_GET['serv_id']) && $_GET['serv_id'] != "" && $_GET['serv_id'] != null && $_GET['serv_id'] > 0 )
	    {
	        $serv_id = $_GET['serv_id'];
			where('doc_service_id',$serv_id);
			if(delete('tbl_doc_services'))
			{
			    set_msg('Success','Service is deleted successfully','success');
			    jump(admin_base_url()."account");
			}
			else
			{
			    set_msg('Query Error','Unable to process your request. Please try again later','error');
			    jump(admin_base_url()."account");
			}
	    }
	    else
	    {
	        set_msg('Data Error','No Record Found','error');
	        jump(admin_base_url()."account");
	    }
	}
	else if(isset($_GET['act']) && $_GET['act'] == "del-appoint")
	{
	    if(isset($_GET['appoint_id']) && $_GET['appoint_id'] != "" && $_GET['appoint_id'] != null && $_GET['appoint_id'] > 0 )
	    {
	        $appoint_id = $_GET['appoint_id'];
			where('doc_appoint_id',$appoint_id);
			if(delete('tbl_doc_appoint'))
			{
			    set_msg('Success','Appoint is deleted successfully','success');
			    jump(admin_base_url()."account");
			}
			else
			{
			    set_msg('Query Error','Unable to process your request. Please try again later','error');
			    jump(admin_base_url()."account");
			}
	    }
	    else
	    {
	        set_msg('Data Error','No Record Found','error');
	        jump(admin_base_url()."account");
	    }
	}
	else if(isset($_GET['act']) && $_GET['act'] == "del-intrest")
	{
	    if(isset($_GET['intrs_id']) && $_GET['intrs_id'] != "" && $_GET['intrs_id'] != null && $_GET['intrs_id'] > 0 )
	    {
	        $intrs_id = $_GET['intrs_id'];
			where('intrest_id',$intrs_id);
			if(delete('tbl_special_intrest'))
			{
			    set_msg('Success','Intrest is deleted successfully','success');
			    jump(admin_base_url()."account");
			}
			else
			{
			    set_msg('Query Error','Unable to process your request. Please try again later','error');
			    jump(admin_base_url()."account");
			}
	    }
	    else
	    {
	        set_msg('Data Error','No Record Found','error');
	        jump(admin_base_url()."account");
	    }
	}
	else if(isset($_GET['act']) && $_GET['act'] == "del-member")
	{
	    if(isset($_GET['member_id']) && $_GET['member_id'] != "" && $_GET['member_id'] != null && $_GET['member_id'] > 0 )
	    {
	        $member_id = $_GET['member_id'];
			where('prof_id',$member_id);
			if(delete('tbl_prof_mem'))
			{
			    set_msg('Success','Data is deleted successfully','success');
			    jump(admin_base_url()."account");
			}
			else
			{
			    set_msg('Query Error','Unable to process your request. Please try again later','error');
			    jump(admin_base_url()."account");
			}
	    }
	    else
	    {
	        set_msg('Data Error','No Record Found','error');
	        jump(admin_base_url()."account");
	    }
	}
	else if(isset($_GET['act']) && $_GET['act'] == "del-institute")
	{
	    if(isset($_GET['institute_id']) && $_GET['institute_id'] != "" && $_GET['institute_id'] != null && $_GET['institute_id'] > 0 )
	    {
	        $institute_id = $_GET['institute_id'];
			where('institute_id',$institute_id);
			if(delete('tbl_doc_institue'))
			{
			    set_msg('Success','Institute is deleted successfully','success');
			    jump(admin_base_url()."account");
			}
			else
			{
			    set_msg('Query Error','Unable to process your request. Please try again later','error');
			    jump(admin_base_url()."account");
			}
	    }
	    else
	    {
	        set_msg('Data Error','No Record Found','error');
	        jump(admin_base_url()."account");
	    }
	}
	else if(isset($_GET['act']) && $_GET['act'] == "del-speciality")
	{
	    if(isset($_GET['speciality']) && $_GET['speciality'] != "" && $_GET['speciality'] != null && $_GET['speciality'] > 0 )
	    {
	        $speciality = $_GET['speciality'];
			where('doc_speciality_id',$speciality);
			if(delete('tbl_doc_speciality'))
			{
			    set_msg('Success','Data is deleted successfully','success');
			    jump(admin_base_url()."account");
			}
			else
			{
			    set_msg('Query Error','Unable to process your request. Please try again later','error');
			    jump(admin_base_url()."account");
			}
	    }
	    else
	    {
	        set_msg('Data Error','No Record Found','error');
	        jump(admin_base_url()."account");
	    }
	}
	else if(isset($_GET['act']) && $_GET['act'] == "del-treatemnt")
	{
	    if(isset($_GET['treatemnt']) && $_GET['treatemnt'] != "" && $_GET['treatemnt'] != null && $_GET['treatemnt'] > 0 )
	    {
	        $treatemnt = $_GET['treatemnt'];
			where('doc_treatment_id',$treatemnt);
			if(delete('tbl_doc_treatments'))
			{
			    set_msg('Success','Data is deleted successfully','success');
			    jump(admin_base_url()."account");
			}
			else
			{
			    set_msg('Query Error','Unable to process your request. Please try again later','error');
			    jump(admin_base_url()."account");
			}
	    }
	    else
	    {
	        set_msg('Data Error','No Record Found','error');
	        jump(admin_base_url()."account");
	    }
	}
	else if(isset($_GET['act']) && $_GET['act'] == "del-edu")
	{
	    if(isset($_GET['edu_id']) && $_GET['edu_id'] != "" && $_GET['edu_id'] != null && $_GET['edu_id'] > 0 )
	    {
	        $edu_id = $_GET['edu_id'];
			where('edu_id',$edu_id);
			if(delete('tbl_doc_education'))
			{
			    set_msg('Success','Data is deleted successfully','success');
			    jump(admin_base_url()."account");
			}
			else
			{
			    set_msg('Query Error','Unable to process your request. Please try again later','error');
			    jump(admin_base_url()."account");
			}
	    }
	    else
	    {
	        set_msg('Data Error','No Record Found','error');
	        jump(admin_base_url()."account");
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