<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_candidate']))
	{
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
	    
	    $slug = $_POST['txt_slug'];
	    if(checkUniqueCol('tbl_url','url_suffex',$slug))
		{
		    $data['candidate_slug']         = post('txt_slug');
		    
    	    if(isset($_POST['txt_password']) && isset($_POST['txt_username']))
    		{
    		    $data['candidate_password']   = encrypt(post('txt_password'));
        		$username                     = post('txt_username');
        		if(checkUniqueCol('tbl_candidate','clinic_username',$username))
        		{
        		    $data['candidate_username']  = $username;
        		    
        		    $image_name = upload_image($_FILES,'txt_image', '../../upload/');
            		if($image_name)
            		{
            		    $data['candidate_image'] = $image_name;
            		}
            		else
            		{
            		    $data['candidate_image'] = '';
            		}
            		
            		$image_name1 = upload_image($_FILES,'txt_banner', '../../upload/');
            		if($image_name1)
            		{
            		    $data['candidate_banner'] = $image_name1;
            		}
            		else
            		{
            		    $data['candidate_banner'] = '';
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
            			$data['candidate_city'] 		!= "" && $data['candidate_city'] 			!= null &&
            			$data['candidate_image'] 		!= "" && $data['candidate_image'] 		    != null &&
            			$data['candidate_banner'] 		!= "" && $data['candidate_banner'] 		    != null &&
            			$data['candidate_slug'] 		!= "" && $data['candidate_slug'] 			!= null
            			
            		)
            		{
            		    if(insert2($data,'tbl_candidate'))
            			{
            			    $URLdata['url_suffex']  = $slug;
            			    $URLdata['url_type']    = 'candidate';
            			    insert($URLdata,'tbl_url');
            				set_msg('Success','Candidate is added successfully','success');
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
            		    set_msg('Missing Data','Please enter all fields data.','error');
    				    echo "<script>window.history.go(-1);</script>";
            		}
        		}
        		else
        		{
        		    set_msg('Duplication error','Username is already taken.','error');
    				echo "<script>window.history.go(-1);</script>";
        		}
    		}
    		else
    		{
    		    set_msg('Field Error','Please enter username & password.','error');
    			echo "<script>window.history.go(-1);</script>";
    		}
		}
	}
	else if(isset($_POST['btn_edit_candidate']))
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
	else if(isset($_POST['btn_save_specialty']))
	{
		$data['can_speciality_name'] 	= post('specialty_name');
		$data['can_speciality_name_ar'] = $_POST['specialty_name_ar'];
		$data['can_speciality_active'] 	= $_POST['select_status'];
		$image_name                 	= upload_image($_FILES,'specialty_icon', '../../upload/');
		if($image_name)
		{
		    $data['can_speciality_icon'] 		= $image_name;
		}
		else
		{
		    $data['can_speciality_icon']  	= '';
		}
		if(
			$data['can_speciality_name'] 	!= "" && $data['can_speciality_name'] 	    != null && 
			$data['can_speciality_name_ar'] != "" && $data['can_speciality_name_ar']    != null && 
			$data['can_speciality_icon'] 	!= "" && $data['can_speciality_icon'] 	    != null && 
    		$data['can_speciality_active'] 	!= "" && $data['can_speciality_active'] 	!= null
		)
		{
			if(insert($data,'tbl_candiate_speciality'))
			{
				set_msg('Success','Specialty is added successfully','success');
				jump(admin_base_url()."candidate-specialities");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				echo "<script>window.history.go(-1);</script>";
			}
		}
		else
		{
			set_msg('Fields validation','Please enter all fields details','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_edit_specialty']))
	{
	    $specialty_id                   = post('specialty_id');
		$data['can_speciality_name'] 	= post('specialty_name');
		$data['can_speciality_name_ar'] = $_POST['specialty_name_ar'];
		$data['can_speciality_active'] 	= $_POST['select_status'];
        $image_name                     = upload_image($_FILES,'specialty_icon', '../../upload/');
		if($image_name)
		{
		    $data['can_speciality_icon'] 		= $image_name;
		}
	    where('can_speciality_id',$specialty_id);
		if(update2($data,'tbl_candiate_speciality'))
		{
			set_msg('Success','Specialty is updated successfully','success');
			jump(admin_base_url()."candidate-specialities");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_save_country']))
	{
		$data['country_name'] 		        = post('country_name');
		$data['country_name_ar'] 	    	= $_POST['country_name_ar'];
		$data['country_active'] 		    = $_POST['select_status'];
		if(
			$data['country_name'] 				!= "" && $data['country_name'] 			    != null && 
			$data['country_name_ar'] 	    	!= "" && $data['country_name_ar'] 	        != null && 
			$data['country_active'] 		    != "" && $data['country_active'] 	        != null
		)
		{
			if(insert($data,'tbl_candidate_country'))
			{
				set_msg('Success','country is added successfully','success');
				jump(admin_base_url()."candidate-country");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				echo "<script>window.history.go(-1);</script>";
			}
		}
		else
		{
			set_msg('Fields validation','Please enter all fields details','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_edit_country']))
	{
	    $country_id                        = post('country_id');
		$data['country_name'] 		        = post('country_name');
		$data['country_name_ar'] 	    	= $_POST['country_name_ar'];
		$data['country_active'] 		    = $_POST['select_status'];
	    where('country_id',$country_id);
		if(update2($data,'tbl_candidate_country'))
		{
			set_msg('Success','country is updated successfully','success');
			jump(admin_base_url()."candidate-country");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_save_city']))
	{
		$data['city_name'] 		        = post('city_name');
		$data['city_name_ar'] 	    	= $_POST['city_name_ar'];
		$data['city_active'] 		    = $_POST['select_status'];
		$data['city_country'] 		    = $_POST['select_country'];
		if(
			$data['city_name'] 				!= "" && $data['city_name'] 			!= null && 
			$data['city_name_ar'] 	    	!= "" && $data['city_name_ar'] 	        != null &&
			$data['city_country'] 	    	!= "" && $data['city_country'] 	        != null &&
			$data['city_active'] 		    != "" && $data['city_active'] 	        != null
		)
		{
			if(insert($data,'tbl_candidate_cities'))
			{
				set_msg('Success','city is added successfully','success');
				jump(admin_base_url()."candidate-city");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				echo "<script>window.history.go(-1);</script>";
			}
		}
		else
		{
			set_msg('Fields validation','Please enter all fields details','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_edit_city']))
	{
	    $city_id                        = post('city_id');
		$data['city_name'] 		        = post('city_name');
		$data['city_name_ar'] 	    	= $_POST['city_name_ar'];
		$data['city_active'] 		    = $_POST['select_status'];
		$data['city_country'] 		    = $_POST['select_country'];
	    where('city_id',$city_id);
		if(update2($data,'tbl_candidate_cities'))
		{
			set_msg('Success','city is updated successfully','success');
			jump(admin_base_url()."candidate-city");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_save_area']))
	{
		$data['area_name'] 		        = post('area_name');
		$data['area_name_ar'] 	    	= $_POST['area_name_ar'];
		$data['area_active'] 		    = $_POST['select_status'];
		$data['area_city'] 		        = $_POST['select_city'];
		if(
			$data['area_name'] 				!= "" && $data['area_name'] 			!= null && 
			$data['area_name_ar'] 	    	!= "" && $data['area_name_ar'] 	        != null &&
			$data['area_city'] 	    	    != "" && $data['area_city'] 	        != null &&
			$data['area_active'] 		    != "" && $data['area_active'] 	        != null
		)
		{
			if(insert($data,'tbl_candidate_areas'))
			{
				set_msg('Success','area is added successfully','success');
				jump(admin_base_url()."candidate-area");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				echo "<script>window.history.go(-1);</script>";
			}
		}
		else
		{
			set_msg('Fields validation','Please enter all fields details','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_edit_area']))
	{
	    $area_id                        = post('area_id');
		$data['area_name'] 		        = post('area_name');
		$data['area_name_ar'] 	    	= $_POST['area_name_ar'];
		$data['area_active'] 		    = $_POST['select_status'];
		$data['area_city'] 		        = $_POST['select_city'];
	    where('area_id',$area_id);
		if(update2($data,'tbl_candidate_areas'))
		{
			set_msg('Success','area is updated successfully','success');
			jump(admin_base_url()."candidate-area");
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
	else if(isset($_POST['btn_save_skill']))
	{
		$data['core_name']		 = post('coreSkill_name');
		$data['core_name_ar']	 = $_POST['coreSkill_name_ar'];
		$data['core_speciality'] = post('select_specialty');
		if(
			$data['core_name'] != null && $data['core_name'] != "" &&
			$data['core_name_ar'] != null && $data['core_name_ar'] != "" && 
			$data['core_speciality'] != null && $data['core_speciality'] != ""
		)
		{
			if(insert2($data,'tbl_can_coreskill'))
			{
				set_msg('Success','Core Skill is added successfully','success');
				jump(admin_base_url()."core-skill");
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
	else if(isset($_POST['btn_edit_skill']))
	{
		$skillId 				 = post('core_id');
		$data['core_name']		 = post('coreSkill_name');
		$data['core_name_ar']	 = $_POST['coreSkill_name_ar'];
		$data['core_speciality'] = post('select_specialty');
		if(
			$data['core_name'] 			!= null && $data['core_name'] 		!= "" &&
			$data['core_name_ar'] 		!= null && $data['core_name_ar'] 	!= "" && 
			$data['core_speciality'] 	!= null && $data['core_speciality'] != ""
		)
		{
			where('core_id', $skillId);
			if(update2($data,'tbl_can_coreskill'))
			{
				set_msg('Success','Core Skill is updated successfully','success');
				jump(admin_base_url()."core-skill");
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
	else
	{
		jump(admin_base_url());
	}
}
else if($_SERVER['REQUEST_METHOD'] == "GET")
{
    if(isset($_GET['act_specialty']) && $_GET['act_specialty'] == "del")
	{
		if(isset($_GET['specialty_id']) && $_GET['specialty_id'] != "" && $_GET['specialty_id'] != null && $_GET['specialty_id'] > 0 )
		{
			$specialty = $_GET['specialty_id'];
			where('can_speciality_id',$specialty);
			if(delete('tbl_candiate_speciality'))
			{
				set_msg('Success','Specialty is deleted successfully','success');
				jump(admin_base_url()."candidate-specialities");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."candidate-specialities");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."candidate-specialities");
		}
	}
	else if(isset($_GET['act']) && $_GET['act'] == "del")
	{
		if(isset($_GET['can_id']) && $_GET['can_id'] != "" && $_GET['can_id'] != null && $_GET['can_id'] > 0 )
		{
			$candiateID = $_GET['can_id'];
			where('candidate_id',$candiateID);
			if(delete('tbl_candidate'))
			{
				set_msg('Success','Candidate is deleted successfully','success');
				jump(admin_base_url()."candidate-list");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."candidate-list");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."candidate-list");
		}
	}
	else if(isset($_GET['act_country']) && $_GET['act_country'] == "del")
	{
		if(isset($_GET['country_id']) && $_GET['country_id'] != "" && $_GET['country_id'] != null && $_GET['country_id'] > 0 )
		{
			$country = $_GET['country_id'];
			where('country_id',$country);
			if(delete('tbl_candidate_country'))
			{
				set_msg('Success','country is deleted successfully','success');
				jump(admin_base_url()."candidate-country");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."candidate-country");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."candidate-country");
		}
	}
	else if(isset($_GET['act_city']) && $_GET['act_city'] == "del")
	{
		if(isset($_GET['city_id']) && $_GET['city_id'] != "" && $_GET['city_id'] != null && $_GET['city_id'] > 0 )
		{
			$city = $_GET['city_id'];
			where('city_id',$city);
			if(delete('tbl_candidate_cities'))
			{
				set_msg('Success','city is deleted successfully','success');
				jump(admin_base_url()."candidate-city");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."candidate-city");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."candidate-city");
		}
	}
	else if(isset($_GET['act_area']) && $_GET['act_area'] == "del")
	{
		if(isset($_GET['area_id']) && $_GET['area_id'] != "" && $_GET['area_id'] != null && $_GET['area_id'] > 0 )
		{
			$area = $_GET['area_id'];
			where('area_id',$area);
			if(delete('tbl_candidate_areas'))
			{
				set_msg('Success','area is deleted successfully','success');
				jump(admin_base_url()."candidate-area");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."candidate-area");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."candidate-area");
		}
	}
	else if(isset($_GET['act_coreSkill']) && $_GET['act_coreSkill'] == "del")
	{
		if(isset($_GET['skill_id']) && $_GET['skill_id'] != "" && $_GET['skill_id'] != null && $_GET['skill_id'] > 0 )
		{
			$skill_id = $_GET['skill_id'];
			where('core_id',$skill_id);
			if(delete('tbl_can_coreskill'))
			{
				set_msg('Success','Skill is deleted successfully','success');
				jump(admin_base_url()."core-skill");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."ccore-skill");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."core-skill");
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