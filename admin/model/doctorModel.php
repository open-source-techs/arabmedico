<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(isset($_POST['check_doc_head']) && $_POST['check_doc_head']=='on'){
        $head=1;
    }
    else{
        $head=0;
    }
	if(isset($_POST['btn_save_doc']))
	{
		$data['doc_name'] 					= post('txt_doc_name');
		$data['doc_name_arabic'] 			= $_POST['txt_doc_name_arabic'];
		$data['doc_degree'] 				= post('txt_doc_degree');
		$data['doc_degree_arabic'] 			= $_POST['txt_doc_degree_arabic'];
		$data['doc_job_title'] 				= post('txt_job_title');
		$data['doc_job_title_arabic'] 		= $_POST['txt_job_title_arabic'];
		$data['doc_speciality'] 			= post('txt_doc_speciality');
		$data['doc_speciality_arabic'] 		= $_POST['txt_doc_speciality_arabic'];
		$data['doc_reg_no'] 				= post('txt_doc_reg_no');
		$data['doc_reg_no_arabic'] 			= changeNumberToArabic(post('txt_doc_reg_no'));
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
		$data['doc_website_url	'] 			= post('doc_web_url');
		$data['doc_facebook_url'] 			= post('doc_facebook_url');
		$data['doc_twitter_url']			= post('doc_tiwtter_url');
		$data['doc_linkedin_url'] 			= post('doc_linkedin_url');
		$data['doc_youtube_url'] 			= post('doc_youtube_url');
		$data['doc_instagram_url'] 			= post('doc_instagram_url');
		$data['doc_country'] 				= post('txt_country');
		$data['doc_city'] 					= post('txt_city');
		$data['doc_area'] 					= post('txt_area');
		$data['doc_intro'] 					= htmlentities(htmlspecialchars($_POST['txt_short_desc']));
		$data['doc_intro_arabic'] 			= htmlentities(htmlspecialchars($_POST['txt_short_desc_arabic']));
		$data['doc_status_head']            = $head;
		$data['doc_details'] 				= htmlentities(htmlspecialchars($_POST['txt_desc']));
		$data['doc_details_arabic'] 		= htmlentities(htmlspecialchars($_POST['txt_desc_arabic']));
		$data['doctor_department'] 		    = post('txt_depart');
		$data['doc_membership']             = post('txt_membership');
		$slug 								= create_slug(strtolower($_POST['txt_slug']));
		if(checkUniqueCol('tbl_url','url_suffex',$slug))
		{
    		$data['doc_slug'] 				= $slug;
    		if(isset($_POST['txt_password']) && isset($_POST['username']))
    		{
    		    $data['password']           = encrypt(post('txt_password'));
        		$username                   = post('txt_username');
        		if(checkUniqueCol('tbl_doctor','username',$username))
        		{
        		    $data['username']       = $username;
        		}
        		else
        		{
        		    set_msg('Duplication error','Username is already taken.','error');
    				echo "<script>window.history.go(-1);</script>";
        		}
    		}
    		$image_name                 	= upload_image($_FILES,'txt_profile', '../../upload/');
    		if($image_name)
    		{
    		    $data['doc_image'] 	= $image_name;
    		}
    		else
    		{
    		    $data['doc_image']  = '';
    		}
    		$image_name1                    = upload_image($_FILES,'txt_banner', '../../upload/');
    		if($image_name1)
    		{
    		    $data['doc_banner'] 	    = $image_name1;
    		}
    		else
    		{
    		    $data['doc_banner']         = '';
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
    			$data['doc_intro_arabic'] 			!= "" && $data['doc_intro_arabic'] 				!= null &&
    			$data['doc_image'] 					!= "" && $data['doc_image'] 					!= null &&
    			$data['doc_intro_arabic'] 			!= "" && $data['doc_intro_arabic'] 				!= null
    			
    		)
    		{
    			if(insert2($data,'tbl_doctor'))
    			{
    			    $URLdata['url_suffex']  = $slug;
    			    $URLdata['url_type']    = 'Doctor';
    			    insert($URLdata,'tbl_url');
    				set_msg('Success','Doctor is added successfully','success');
    			    if(isset($_POST['txt_from']))
    			    {
    			        jump(admin_base_url()."dpt-ourteam-panel?dpt_id=".$data['doctor_department']);
    			    }
    				else
    				{
    				    jump(admin_base_url()."list-doctors");
    				}
    			}
    			else
    			{
    				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
    				echo "<script>window.history.go(-1);</script>";
    			}
    		}
    		else
    		{
    			set_msg('Fields Error','Please fill all fields with data','error');
    			echo "<script>window.history.go(-1);</script>";
    		}
		}
		else
		{
		    set_msg('Fields validation','URL already registered','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_edit_doc']))
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
		$data['doc_reg_no_arabic'] 			= changeNumberToArabic(post('txt_doc_reg_no'));
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
		$data['doc_website_url	'] 			= post('doc_web_url');
		$data['doc_facebook_url'] 			= post('doc_facebook_url');
		$data['doc_twitter_url']			= post('doc_tiwtter_url');
		$data['doc_linkedin_url'] 			= post('doc_linkedin_url');
		$data['doc_youtube_url'] 			= post('doc_youtube_url');
		$data['doc_instagram_url'] 			= post('doc_instagram_url');
		$data['doc_country'] 				= post('txt_country');
		$data['doc_city'] 					= post('txt_city');
		$data['doc_area'] 					= post('txt_area');
		$data['doc_intro'] 					= htmlentities(htmlspecialchars($_POST['txt_short_desc']));
		$data['doc_intro_arabic'] 			= htmlentities(htmlspecialchars($_POST['txt_short_desc_arabic']));
		$data['doc_status_head']            = $head;
		$data['doc_details'] 				= htmlentities(htmlspecialchars($_POST['txt_desc']));
		$data['doc_details_arabic'] 		= htmlentities(htmlspecialchars($_POST['txt_desc_arabic']));
		$data['doctor_department'] 		    = post('txt_depart');
		$data['doc_membership']             = post('txt_membership');
		$slug 								= create_slug(strtolower($_POST['txt_slug']));
		$previousSlug                       = post('txt_prev_slug');
        $currentSlug                        = post('txt_slug');
        $slugUpdate                         = false;
        if($previousSlug != $currentSlug)
        {
            $slugUpdate                     = true;
            if(checkUniqueCol('tbl_url','url_suffex',$currentSlug, true, 'url_suffex', $previousSlug ))
    		{
    		    $data['doc_slug']           = $currentSlug;
    		}
        }
		if(isset($_POST['txt_password']) && post('txt_password') != null && post('txt_password') != "")
		{
		    $data['password']               = encrypt(post('txt_password'));
		}
		if(isset($_POST['txt_username']) && post('txt_username') != null && post('txt_username') != "")
		{
    		$username                       = post('txt_username');
    		if(checkUniqueCol('tbl_doctor','username',$username, true, 'doc_id', $doctor_id ))
    		{
    		    $data['username']           = $username;
    		    $image_name                 = upload_image($_FILES,'txt_profile', '../../upload/');
        		if($image_name)
        		{
        		    $data['doc_image'] 		= $image_name;
        		}
        		$image_name1                = upload_image($_FILES,'txt_banner', '../../upload/');
        		if($image_name1)
        		{
        		    $data['doc_banner'] 	= $image_name1;
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
        			if(update2($data,'tbl_doctor'))
        			{
        			    if($slugUpdate)
        			    {
        			        $URLdata['url_suffex']  = $currentSlug;
            			    $URLdata['url_type']    = 'Doctor';
            			    where('url_suffex',$previousSlug);
            			    update($URLdata,'tbl_url');
        			    }
        				set_msg('Success','Doctor is updated successfully','success');
        			    if(isset($_POST['txt_from']))
        			    {
        			        jump(admin_base_url()."dpt-ourteam-panel?dpt_id=".$data['doctor_department']);
        			    }
        				else
        				{
        				    jump(admin_base_url()."list-doctors");
        				}
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
    		else
    		{
    		    set_msg('Duplication error','Username already taken.','error');
    		    if(isset($_POST['txt_from']))
    		    {
    		        jump(admin_base_url()."dpt-ourteam-panel?dpt_id=".$data['doctor_department']);
    		    }
    			else
    			{
    			    echo "<script>window.history.go(-1);</script>";
    			}
    		}
		}
		else
		{
			set_msg('Username Error','Username cannot be null','error');
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
	else
	{
		jump(admin_base_url());
	}
}
else
{
	jump(admin_base_url());
}