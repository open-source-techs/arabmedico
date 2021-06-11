<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_edit_candidate']))
	{
	    $candidateID                        = post('txt_candidate_id');
	    $data['candidate_name']             = post('txt_candidate_name');
	    $data['candidate_name_ar']          = $_POST['txt_candidate_name_ar'];
	    $data['candidate_degree']           = post('txt_candidate_degree');
	    $data['candidate_degree_ar']        = $_POST['txt_candidate_degree_ar'];
	    $data['candidate_job']              = post('txt_job_title');
	    $data['candidate_job_ar']           = $_POST['txt_job_title_ar'];
	    $data['candidate_industry']         = post('txt_industry');
	    $data['candidate_industry_ar']      = $_POST['txt_industry_ar'];
	    $data['candidate_company']          = post('txt_company');
	    $data['candidate_company_ar']       = $_POST['txt_company_ar'];
	    $data['candidate_email']            = post('txt_email');
	    $data['candidate_phone']            = post('txt_phone');
	    $data['candidate_phone_ar']         = changeNumberToArabic($data['candidate_phone']);
	    $data['candidate_department']       = post('txt_depart');
	    $data['candidate_country']          = post('txt_country');
	    $data['candidate_city']             = post('txt_city');
	    $data['candiadate_resume']          = $_POST['txt_desc'];
	    $data['candiadate_resume_ar']       = $_POST['txt_desc_ar'];
	    $data['candiate_nationality']       = post('txt_nationality');
	    $data['candiate_nationality_ar']    = $_POST['txt_nationality_ar'];
	    $data['candidate_gender']           = post('txt_gender');
	    $data['candidate_gender_ar']        = $_POST['txt_gender_ar'];
	    $data['candidate_visa']             = post('txt_visa_status');
	    $data['candidate_visa_ar']          = $_POST['txt_visa_status_ar'];
        $previousSlug                       = post('txt_pre_slug');
        $currentSlug                        = post('txt_slug');
        $slugUpdate                         = false;	        
	    if($previousSlug != $currentSlug)
        {
            if(checkUniqueCol('tbl_url','url_suffex',$currentSlug, true, 'url_suffex', $previousSlug ))
    		{
                $slugUpdate                     = true;
    		    $data['candidate_slug']     = $currentSlug;
    		}
    		else
    		{
    		    set_msg('Slug Duplication','Sorry this slug is already registered. Please try again another','error');
				echo "<script>window.history.go(-1);</script>";
    		}
        }
	    $image_name = upload_image($_FILES,'txt_image', '../../upload/');
		if($image_name)
		{
		    $data['candidate_image'] = $image_name;
		}		
		$image_name1 = upload_image($_FILES,'txt_banner', '../../upload/');
		if($image_name1)
		{
		    $data['candidate_banner'] = $image_name1;
		}
		if(
			$data['candidate_name'] 		!= "" && $data['candidate_name'] 			!= null &&
			$data['candidate_name_ar'] 		!= "" && $data['candidate_name_ar'] 		!= null &&
			$data['candidate_job'] 			!= "" && $data['candidate_job'] 			!= null &&
			$data['candidate_job_ar'] 		!= "" && $data['candidate_job_ar'] 			!= null &&
			$data['candidate_industry'] 	!= "" && $data['candidate_industry'] 		!= null &&
			$data['candidate_industry_ar'] 	!= "" && $data['candidate_industry_ar'] 	!= null &&
			$data['candidate_company'] 		!= "" && $data['candidate_company'] 		!= null &&
			$data['candidate_company_ar'] 	!= "" && $data['candidate_company_ar'] 		!= null &&
			$data['candidate_email'] 		!= "" && $data['candidate_email'] 			!= null &&
			$data['candidate_department'] 	!= "" && $data['candidate_department'] 		!= null &&
			$data['candidate_country']      != "" && $data['candidate_country'] 	    != null &&
			$data['candidate_city'] 		!= "" && $data['candidate_city'] 			!= null
			
		)
		{
		    where('candidate_id',$candidateID);
		    if(update2($data,'tbl_candidate'))
			{
			    
			    if($slugUpdate)
			    {
			        $URLdata['url_suffex']  = $currentSlug;
    			    $URLdata['url_type']    = 'candidate';
    			    where('url_suffex',$previousSlug);
    			    update($URLdata,'tbl_url');
			    }
			    
				set_msg('Success','Candidate is updated successfully','success');
				jump(admin_base_url()."myprofile");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				echo "<script>window.history.go(-1);</script>";
			}
		}
		else
		{
		    set_msg('Missing Data','Please enter all fields data.','error');
		    echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_edit_username']))
	{
	    $candidateID = post('txt_candidate_id');
	    if(isset($_POST['txt_password']) && post('txt_password') != null && post('txt_password') != "")
		{
		    $data['candidate_password'] = encrypt(post('txt_password'));
		}
		if(isset($_POST['txt_username']) && post('txt_username') != null && post('txt_username') != "")
		{
    		$username = post('txt_username');
    		if(checkUniqueCol('tbl_candidate','candidate_username',$username, true, 'candidate_id', $candidateID ))
    		{
    		    $data['candidate_username'] = $username;
    		}
		}
		if(sizeof($data) > 0)
		{
		    where('candidate_id',$candidateID);
		    if(update2($data,'tbl_candidate'))
			{
				set_msg('Success','Candidate credentials updated successfully','success');
				jump(admin_base_url()."candidate-list");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				echo "<script>window.history.go(-1);</script>";
			}
		}
		else
		{
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_upload_image']))
	{
	    $data['can_gall_canID'] 	= post('txt_doc_id');
		$image_name                 = upload_image($_FILES,'txt_image', '../../upload/');
		if($image_name)
		{
		    $data['can_gall_img'] 	= $image_name;
		    if(insert($data,'tbl_can_gallery'))
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
	    $data['can_video_doc']  = post('txt_doc_id');
	    $data['can_video_code'] = post('txt_video');
	    if(insert($data,'tbl_can_video'))
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
	else if(isset($_POST['action']) && $_POST['action'] == "getcities")
	{
	    $countryID = post('countryID');
	    $sql = query("SELECT * FROM tbl_candidate_cities WHERE city_country = '$countryID' AND city_active = 1");
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
	    $sql = query("SELECT * FROM tbl_candidate_areas WHERE area_city = '$cityID' AND area_active = 1");
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
	else if(isset($_POST['btn_upload_logo']))
	{
	    $doctor_id 							= post('txt_doc_id');
	    $image_name                 		= upload_image($_FILES,'txt_image', '../../upload/');
		if($image_name)
		{
		    $data['candidate_logo'] 		= $image_name;
		    where('candidate_id ',$doctor_id);
    		if(update($data,'tbl_candidate'))
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
	else if(isset($_POST['btn_upload_slide']))
	{
	    $data['can_slider_doc'] 	    = post('txt_doc_id');
	    $data['can_slider_title']       = post('doc_slider_title');
	    $data['can_silder_title_ar']    = $_POST['doc_slider_title_ar'];
		$image_name                     = upload_image($_FILES,'txt_image', '../../upload/');
		if($image_name)
		{
		    $data['can_slider_image'] 	= $image_name;
		    if(insert($data,'tbl_can_slider'))
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
	    $data['can_award_can'] 	= post('txt_doc_id');
		$image_name             = upload_image($_FILES,'txt_award', '../../upload/');
		if($image_name)
		{
		    $data['can_award_image'] 	= $image_name;
		    if(insert($data,'tbl_can_awards'))
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
	else if(isset($_POST['btn_add_location']))
	{
	    $data['loc_can_id']         = post('txt_doc_id');
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
	    
	    if(insert($data, 'tbl_can_practice_loc'))
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
	else if(isset($_POST['btn_speciality']))
	{
	    $data['can_speciality'] = post('txt_speciality');
	    $data['can_spec_can'] 	= post('txt_doc_id');
	    
	    if(insert($data,'tbl_can_speciality'))
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
	else if(isset($_POST['btn_doc_institute']))
	{
	    $data['institute_can'] 	    = post('txt_doc_id');
	    $data['institute_name']     = post('txt_institute');
	    $data['institute_name_ar'] 	    = $_POST['txt_institute_arabic'];
	    
	    if(insert($data,'tbl_can_institue'))
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
	else if(isset($_POST['btn_can_lang']))
	{
	    $data['lang_can'] 	   = post('txt_doc_id');
	    $data['lang_name']     = post('txt_lang_name');
	    $data['lang_name_ar']  = $_POST['txt_lang_name_arabic'];
	    
	    if(insert($data,'tbl_can_language'))
		{
			set_msg('Success','Language is added successfully','success');
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
	    $data['app_appoint_title'] 	    = post('txt_appoint');
	    $data['app_appoint_title_ar'] 	= $_POST['txt_appoint_arabic'];
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
	    $data['app_appoint_can'] 	        = post('txt_doc_id');
	    $image_name                         = upload_image($_FILES,'txt_logo', '../../upload/');
		if($image_name)
		{
		    $data['app_hospLogo'] = $image_name;
		}
		else
		{
		    $data['app_hospLogo'] = '';
		}
	    if(insert($data,'tbl_can_appoint'))
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
	else if(isset($_POST['btn_save_service']))
	{
	    $data['c_can_id']   = post('txt_doc_id');
	    $data['c_name']     = post('txt_cer_name');
	    $data['c_name_ar']  = $_POST['arabic_cer_title'];
	    $data['c_desc']     = post('txt_short_desc');
	    $data['c_desc_ar']  = $_POST['txt_short_desc_arabic'];
	    $image_name         = upload_image($_FILES,'cer_profile', '../../upload/');
	    if($image_name)
	    {
	        $data['c_image'] = $image_name;
	    }
	    else
	    {
	        $data['c_image'] = "";
	    }
	    
	    if(
	        $data['c_name']     != null && $data['c_name']     != "" &&
	        $data['c_name_ar']  != null && $data['c_name_ar']  != "" &&
	        $data['c_image']    != null && $data['c_image']    != ""
	        )
	    {
	        if(insert2($data,'tbl_can_services'))
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
	    else
	    {
	        set_msg('Fields Error','Please fill required fields with data','error');
			echo "<script>window.history.go(-1);</script>";
	    }
	}
	else if(isset($_POST['btn_edit_service']))
	{
	    $servID             = post('txt_serv_id');
	    $data['c_can_id']   = post('txt_doc_id');
	    $data['c_name']     = post('txt_cer_name');
	    $data['c_name_ar']  = $_POST['arabic_cer_title'];
	    $data['c_desc']     = post('txt_short_desc');
	    $data['c_desc_ar']  = $_POST['txt_short_desc_arabic'];
	    $image_name         = upload_image($_FILES,'cer_profile', '../../upload/');
	    if($image_name)
	    {
	        $data['c_image'] = $image_name;
	    }
	    
	    if(
	        $data['c_name']     != null && $data['c_name']     != "" &&
	        $data['c_name_ar']  != null && $data['c_name_ar']  != ""
	        )
	    {
	        where('c_id',$servID);
	        if(update2($data,'tbl_can_services'))
			{
				set_msg('Success','Service is updated successfully','success');
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
	        set_msg('Fields Error','Please fill required fields with data','error');
			echo "<script>window.history.go(-1);</script>";
	    }
	}
	else if(isset($_POST['btn_doc_membership']))
	{
	    $data['prof_can'] 	        = post('txt_doc_id');
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
	    if(insert($data,'tbl_can_prof_mem'))
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
	    $data['edu_can'] 	        = post('txt_doc_id');
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
	    if(insert($data,'tbl_can_education'))
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
	else if(isset($_POST['action']) && $_POST['action'] == "getCondition")
	{
	    $specialityID = post('speciality');
	    $sql = query("SELECT * FROM tbl_candidate_coreskill WHERE core_speciality = '$specialityID' AND core_active = 1");
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
	else if(isset($_POST['btn_skill']))
	{
	    $data['can_skill_speciality']   = post('txt_speciality');
	    $data['can_skill_can'] 	        = post('txt_can_id');
	    $data['can_skill']    			= post('txt_coreskill');
	    
	    if(insert($data,'tbl_can_coreskill'))
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
    if(isset($_GET['act']) && $_GET['act'] == "del-img")
	{
	    if(isset($_GET['gall_id']) && $_GET['gall_id'] != "" && $_GET['gall_id'] != null && $_GET['gall_id'] > 0 )
	    {
	        $gall_id = $_GET['gall_id'];
			where('can_gall_id ',$gall_id);
			if(delete('tbl_can_gallery'))
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
			where('can_video_id',$vid_id);
			if(delete('tbl_can_video'))
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
			where('can_slider_id',$sld_id);
			if(delete('tbl_can_slider'))
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
	else if(isset($_GET['act']) && $_GET['act'] == "del-loc")
	{
	    if(isset($_GET['loc_id']) && $_GET['loc_id'] != "" && $_GET['loc_id'] != null && $_GET['loc_id'] > 0 )
	    {
	        $loc_id = $_GET['loc_id'];
			where('loc_id',$loc_id);
			if(delete('tbl_can_practice_loc'))
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
	else if(isset($_GET['act']) && $_GET['act'] == "del-speciality")
	{
	    if(isset($_GET['speciality']) && $_GET['speciality'] != "" && $_GET['speciality'] != null && $_GET['speciality'] > 0 )
	    {
	        $speciality = $_GET['speciality'];
			where('can_spec_id',$speciality);
			if(delete('tbl_can_speciality'))
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
	else if(isset($_GET['act']) && $_GET['act'] == "del-appoint")
	{
	    if(isset($_GET['appoint_id']) && $_GET['appoint_id'] != "" && $_GET['appoint_id'] != null && $_GET['appoint_id'] > 0 )
	    {
	        $appoint_id = $_GET['appoint_id'];
			where('app_appoint_id',$appoint_id);
			if(delete('tbl_can_appoint'))
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
	else if(isset($_GET['act']) && $_GET['act'] == 'del-serv')
    {
        if(isset($_GET['serv_id']) && $_GET['serv_id'] != '' && $_GET['serv_id'] != null && $_GET['serv_id'] > 0)
        {
            $serviceID = $_GET['serv_id'];
            where('c_id', $serviceID);
            if(delete('tbl_can_services'))
            {
                set_msg('Success','Service is delted successfully','success');
				jump(admin_base_url()."account");
            }
            else
            {
                set_msg('Deletion error','Unable to process your request. Please try again later.','error');
				echo "<script>window.history.go(-1);</script>";
            }
        }
        else
        {
            echo "<script>window.history.go(-1);</script>";
        }
    }
    else if(isset($_GET['act']) && $_GET['act'] == "del-member")
	{
	    if(isset($_GET['member_id']) && $_GET['member_id'] != "" && $_GET['member_id'] != null && $_GET['member_id'] > 0 )
	    {
	        $member_id = $_GET['member_id'];
			where('prof_id',$member_id);
			if(delete('tbl_can_prof_mem'))
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
	else if(isset($_GET['act']) && $_GET['act'] == "del-lang")
	{
	    if(isset($_GET['langID']) && $_GET['langID'] != "" && $_GET['langID'] != null && $_GET['langID'] > 0 )
	    {
	        $langID = $_GET['langID'];
			where('lang_id',$langID);
			if(delete('tbl_can_language'))
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
			if(delete('tbl_can_education'))
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
	else if(isset($_GET['act']) && $_GET['act'] == "del-core")
	{
	    if(isset($_GET['core_id']) && $_GET['core_id'] != "" && $_GET['core_id'] != null && $_GET['core_id'] > 0 )
	    {
	        $core_id = $_GET['core_id'];
			where('can_skill_id',$core_id);
			if(delete('tbl_can_coreskill'))
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