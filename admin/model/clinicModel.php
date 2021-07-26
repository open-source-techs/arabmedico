<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_clinic']))
	{
		$slug 							= post('txt_clinic_url');
		$data['clinic_name'] 			= post('txt_clinic_name');
		$data['clinic_name_ar'] 		= $_POST['txt_clinic_name_ar'];
		$data['clinic_phone'] 			= post('txt_clinic_phone');
		$data['clinic_phone_ar'] 		= changeNumberToArabic(post('txt_clinic_phone'));
		$data['clinic_address'] 		= post('txt_clinic_address');
		$data['clinic_address_ar'] 		= $_POST['txt_clinic_address_ar'];
		$data['clinic_country'] 		= post('txt_country');
		$data['clinic_area'] 	    	= post('txt_area');
		$data['clinic_city'] 	    	= post('txt_city');
		$data['clinic_url'] 	    	= post('txt_clinic_url');
		$data['clinic_facebook'] 		= post('txt_fb_url');
		$data['clinic_instagram'] 		= post('txt_insta_url');
		$data['clinic_youtube'] 		= post('txt_yt_url');
		$data['clinic_linkedin'] 		= post('txt_linked_url');
		$data['clinic_twitter'] 		= post('txt_twitter_url');
		$data['clinic_meta_title'] 		= post('txt_meta_title');
		$data['clinic_meta_title_ar'] 	= $_POST['txt_meta_title_ar'];
		$data['clinic_meta_tag'] 		= post('txt_tag');
		$data['clinic_meta_tag_ar'] 	= $_POST['txt_tag_ar'];
		$data['clinic_meta_desc'] 		= post('txt_meta_desc');
		$data['clinic_meta_desc_ar'] 	= $_POST['txt_meta_desc_ar'];
		$username 	                	= post('txt_username');

		if(checkUniqueCol('tbl_url','url_suffex',$slug))
		{
		    $data['clinic_slug']    = $slug;
		    if(checkUniqueCol('tbl_clinic','clinic_username',$username))
        	{
    		    $data['clinic_username'] 	= $username;
    		    $data['clinic_password'] 	= encrypt(post('txt_password'));
        		$image_name                 = upload_image($_FILES,'txt_icon', '../../upload/');
        		if($image_name)
        		{
        		    $data['clinic_icon'] 	= $image_name;
        		}
        		else
        		{
        		    $data['clinic_icon']    = '';
        		}
        
        		if(
        			$data['clinic_name'] 	    != "" && $data['clinic_name'] 		!= null &&
        			$data['clinic_name_ar']     != "" && $data['clinic_name_ar'] 	!= null &&
        			$data['clinic_phone'] 	    != "" && $data['clinic_phone'] 		!= null &&
        			$data['clinic_phone_ar'] 	!= "" && $data['clinic_phone_ar'] 	!= null &&
        			$data['clinic_address'] 	!= "" && $data['clinic_address'] 	!= null &&
        			$data['clinic_address_ar'] 	!= "" && $data['clinic_address_ar'] != null &&
        			$data['clinic_country'] 	!= "" && $data['clinic_country'] 	!= null &&
        			$data['clinic_area'] 	    != "" && $data['clinic_area'] 		!= null &&
        			$data['clinic_city'] 	    != "" && $data['clinic_city']       != null &&
        			$data['clinic_username']    != "" && $data['clinic_username'] 	!= null &&
        			$data['clinic_password'] 	!= "" && $data['clinic_password'] 	!= null &&
        			$data['clinic_icon'] 	    != "" && $data['clinic_icon'] 		!= null
        		)
        		{
        			if(insert($data,'tbl_clinic'))
        			{
        			    $URLdata['url_suffex']  = $slug;
        			    $URLdata['url_type']    = 'Clinic';
        			    insert($URLdata,'tbl_url');
        				set_msg('Success','Clinic is added successfully','success');
        				jump(admin_base_url()."all-clinic");
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
    			set_msg('Fields Error','Username already exists','error');
    			echo "<script>window.history.go(-1);</script>";
    		}
		}
		else
		{
		    set_msg('Fields Error','URL is already registered','error');
    		echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_edit_clinic']))
	{
 		$cer_id 					= post('clinic_id');
		$data['clinic_name'] 		= post('txt_clinic_name');
		$data['clinic_name_ar'] 	= $_POST['txt_clinic_name_ar'];
		$data['clinic_phone'] 		= post('txt_clinic_phone');
		$data['clinic_phone_ar'] 	= changeNumberToArabic(post('txt_clinic_phone'));
		$data['clinic_address'] 	= post('txt_clinic_address');
		$data['clinic_address_ar'] 	= $_POST['txt_clinic_address_ar'];
		$data['clinic_country'] 	= post('txt_country');
		$data['clinic_area'] 	    = post('txt_area');
		$data['clinic_city'] 	    = post('txt_city');
		$data['clinic_url'] 	    = post('txt_clinic_url');
		$data['clinic_facebook'] 	= post('txt_fb_url');
		$data['clinic_instagram'] 	= post('txt_insta_url');
		$data['clinic_youtube'] 	= post('txt_yt_url');
		$data['clinic_linkedin'] 	= post('txt_linked_url');
		$data['clinic_twitter'] 	= post('txt_twitter_url');
		$data['clinic_meta_title'] 		= post('txt_meta_title');
		$data['clinic_meta_title_ar'] 	= $_POST['txt_meta_title_ar'];
		$data['clinic_meta_tag'] 		= post('txt_tag');
		$data['clinic_meta_tag_ar'] 	= $_POST['txt_tag_ar'];
		$data['clinic_meta_desc'] 		= post('txt_meta_desc');
		$data['clinic_meta_desc_ar'] 	= $_POST['txt_meta_desc_ar'];
		$data['clinic_active'] 	    = post('txt_status');
		$image_name                 = upload_image($_FILES,'txt_icon', '../../upload/');
		if($image_name)
		{
		    $data['clinic_icon'] 	= $image_name;
		}
        $previousSlug               = post('previous_slug');
        $currentSlug                = post('txt_clinic_url');
        $slugUpdate                 = false;
        if($previousSlug != $currentSlug)
        {
            $slugUpdate             = true;
            if(checkUniqueCol('tbl_url','url_suffex',$currentSlug, true, 'url_suffex', $previousSlug ))
    		{
    		    $data['clinic_slug']    = $currentSlug;
    		}
        }
		if(
			$data['clinic_name'] 	    != "" && $data['clinic_name'] 		!= null &&
			$data['clinic_name_ar']     != "" && $data['clinic_name_ar'] 	!= null &&
			$data['clinic_phone'] 	    != "" && $data['clinic_phone'] 		!= null &&
			$data['clinic_phone_ar'] 	!= "" && $data['clinic_phone_ar'] 	!= null &&
			$data['clinic_address'] 	!= "" && $data['clinic_address'] 	!= null &&
			$data['clinic_address_ar'] 	!= "" && $data['clinic_address_ar'] != null &&
			$data['clinic_country'] 	!= "" && $data['clinic_country'] 	!= null &&
			$data['clinic_area'] 	    != "" && $data['clinic_area'] 		!= null &&
			$data['clinic_city'] 	    != "" && $data['clinic_city']       != null
		)
		{
		    where('clinic_id',$cer_id);
			if(update($data,'tbl_clinic'))
			{
				if($slugUpdate)
				{
				    $URLdata['url_suffex']  = $currentSlug;
				    $URLdata['url_type']    = 'Clinic';
				    where('url_suffex',$previousSlug);
				    update($URLdata,'tbl_url');
				}
				set_msg('Success','Clinic is updated successfully','success');
				jump(admin_base_url()."all-clinic");
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
	else if(isset($_POST['btn_username']))
	{
	    $cer_id	= post('clinic_id');
	    if(isset($_POST['txt_password']) && post('txt_password') != null && post('txt_password') != "")
		{
		    $data['clinic_password'] = encrypt(post('txt_password'));
		}
		if(isset($_POST['txt_username']) && post('txt_username') != null && post('txt_username') != "")
		{
    		$username = post('txt_username');
    		if(checkUniqueCol('tbl_clinic','clinic_username',$username, true, 'clinic_id', $cer_id ))
    		{
    		    $data['clinic_username'] = $username;
    		}
		}
		if(sizeof($data) > 0)
		{
		    where('clinic_id',$cer_id);
			if(update($data,'tbl_clinic'))
			{
				set_msg('Success','Credentials are updated successfully','success');
				jump(admin_base_url()."all-clinic");
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
	else
	{
		jump(admin_base_url());
	}
}
else if($_SERVER['REQUEST_METHOD'] == "GET")
{
	if(isset($_GET['act']) && $_GET['act'] == "del")
	{
		if(isset($_GET['clinic_id']) && $_GET['clinic_id'] != "" && $_GET['clinic_id'] != null && $_GET['clinic_id'] > 0 )
		{
			$cer_id = $_GET['clinic_id'];
			where('clinic_id',$cer_id);
			if(delete('tbl_clinic'))
			{
				set_msg('Success','Clinic is deleted successfully','success');
				jump(admin_base_url()."all-clinic");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."all-clinic");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."all-certificates");
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