<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_hospital']))
	{
		$slug 							= post('txt_hospital_url');
		$data['hospital_name'] 			= post('txt_hospital_name');
		$data['hospital_name_ar'] 		= $_POST['txt_hospital_name_ar'];
		$data['hospital_phone'] 			= post('txt_hospital_phone');
		$data['hospital_phone_ar'] 		= changeNumberToArabic(post('txt_hospital_phone'));
		$data['hospital_address'] 		= post('txt_hospital_address');
		$data['hospital_address_ar'] 		= $_POST['txt_hospital_address_ar'];
		$data['hospital_country'] 		= post('txt_country');
		$data['hospital_area'] 	    	= post('txt_area');
		$data['hospital_city'] 	    	= post('txt_city');
		$data['hospital_url'] 	    	= post('txt_hospital_url');
		$data['hospital_facebook'] 		= post('txt_fb_url');
		$data['hospital_instagram'] 		= post('txt_insta_url');
		$data['hospital_youtube'] 		= post('txt_yt_url');
		$data['hospital_linkedin'] 		= post('txt_linked_url');
		$data['hospital_twitter'] 		= post('txt_twitter_url');
		$data['hospital_meta_title'] 		= post('txt_meta_title');
		$data['hospital_meta_title_ar'] 	= $_POST['txt_meta_title_ar'];
		$data['hospital_meta_tag'] 		= post('txt_tag');
		$data['hospital_meta_tag_ar'] 	= $_POST['txt_tag_ar'];
		$data['hospital_meta_desc'] 		= post('txt_meta_desc');
		$data['hospital_meta_desc_ar'] 	= $_POST['txt_meta_desc_ar'];
		$username 	                	= post('txt_username');

		if(checkUniqueCol('tbl_url','url_suffex',$slug))
		{
		    $data['hospital_slug']    = $slug;
		    if(checkUniqueCol('tbl_hospital','hospital_username',$username))
        	{
    		    $data['hospital_username'] 	= $username;
    		    $data['hospital_password'] 	= encrypt(post('txt_password'));
        		$image_name                 = upload_image($_FILES,'txt_icon', '../../upload/');
        		if($image_name)
        		{
        		    $data['hospital_icon'] 	= $image_name;
        		}
        		else
        		{
        		    $data['hospital_icon']    = '';
        		}
        
        		if(
        			$data['hospital_name'] 	    != "" && $data['hospital_name'] 		!= null &&
        			$data['hospital_name_ar']     != "" && $data['hospital_name_ar'] 	!= null &&
        			$data['hospital_phone'] 	    != "" && $data['hospital_phone'] 		!= null &&
        			$data['hospital_phone_ar'] 	!= "" && $data['hospital_phone_ar'] 	!= null &&
        			$data['hospital_address'] 	!= "" && $data['hospital_address'] 	!= null &&
        			$data['hospital_address_ar'] 	!= "" && $data['hospital_address_ar'] != null &&
        			$data['hospital_country'] 	!= "" && $data['hospital_country'] 	!= null &&
        			$data['hospital_area'] 	    != "" && $data['hospital_area'] 		!= null &&
        			$data['hospital_city'] 	    != "" && $data['hospital_city']       != null &&
        			$data['hospital_username']    != "" && $data['hospital_username'] 	!= null &&
        			$data['hospital_password'] 	!= "" && $data['hospital_password'] 	!= null &&
        			$data['hospital_icon'] 	    != "" && $data['hospital_icon'] 		!= null
        		)
        		{
        			if(insert($data,'tbl_hospital'))
        			{
        			    $URLdata['url_suffex']  = $slug;
        			    $URLdata['url_type']    = 'hospital';
        			    insert($URLdata,'tbl_url');
        				set_msg('Success','Hospital is added successfully','success');
        				jump(admin_base_url()."all-hospital");
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
	else if(isset($_POST['btn_edit_hospital']))
	{
 		$cer_id 					= post('hospital_id');
		$data['hospital_name'] 		= post('txt_hospital_name');
		$data['hospital_name_ar'] 	= $_POST['txt_hospital_name_ar'];
		$data['hospital_phone'] 		= post('txt_hospital_phone');
		$data['hospital_phone_ar'] 	= changeNumberToArabic(post('txt_hospital_phone'));
		$data['hospital_address'] 	= post('txt_hospital_address');
		$data['hospital_address_ar'] 	= $_POST['txt_hospital_address_ar'];
		$data['hospital_country'] 	= post('txt_country');
		$data['hospital_area'] 	    = post('txt_area');
		$data['hospital_city'] 	    = post('txt_city');
		$data['hospital_url'] 	    = post('txt_hospital_url');
		$data['hospital_facebook'] 	= post('txt_fb_url');
		$data['hospital_instagram'] 	= post('txt_insta_url');
		$data['hospital_youtube'] 	= post('txt_yt_url');
		$data['hospital_linkedin'] 	= post('txt_linked_url');
		$data['hospital_twitter'] 	= post('txt_twitter_url');
		$data['hospital_meta_title'] 		= post('txt_meta_title');
		$data['hospital_meta_title_ar'] 	= $_POST['txt_meta_title_ar'];
		$data['hospital_meta_tag'] 		= post('txt_tag');
		$data['hospital_meta_tag_ar'] 	= $_POST['txt_tag_ar'];
		$data['hospital_meta_desc'] 		= post('txt_meta_desc');
		$data['hospital_meta_desc_ar'] 	= $_POST['txt_meta_desc_ar'];
		$data['hospital_active'] 	    = post('txt_status');
		$image_name                 = upload_image($_FILES,'txt_icon', '../../upload/');
		if($image_name)
		{
		    $data['hospital_icon'] 	= $image_name;
		}
        $previousSlug               = post('previous_slug');
        $currentSlug                = post('txt_hospital_url');
        $slugUpdate                 = false;
        if($previousSlug != $currentSlug)
        {
            $slugUpdate             = true;
            if(checkUniqueCol('tbl_url','url_suffex',$currentSlug, true, 'url_suffex', $previousSlug ))
    		{
    		    $data['hospital_slug']    = $currentSlug;
    		}
        }
		if(
			$data['hospital_name'] 	    != "" && $data['hospital_name'] 		!= null &&
			$data['hospital_name_ar']     != "" && $data['hospital_name_ar'] 	!= null &&
			$data['hospital_phone'] 	    != "" && $data['hospital_phone'] 		!= null &&
			$data['hospital_phone_ar'] 	!= "" && $data['hospital_phone_ar'] 	!= null &&
			$data['hospital_address'] 	!= "" && $data['hospital_address'] 	!= null &&
			$data['hospital_address_ar'] 	!= "" && $data['hospital_address_ar'] != null &&
			$data['hospital_country'] 	!= "" && $data['hospital_country'] 	!= null &&
			$data['hospital_area'] 	    != "" && $data['hospital_area'] 		!= null &&
			$data['hospital_city'] 	    != "" && $data['hospital_city']       != null
		)
		{
		    where('hospital_id',$cer_id);
			if(update($data,'tbl_hospital'))
			{
				if($slugUpdate)
				{
				    $URLdata['url_suffex']  = $currentSlug;
				    $URLdata['url_type']    = 'hospital';
				    where('url_suffex',$previousSlug);
				    update($URLdata,'tbl_url');
				}
				set_msg('Success','Hospital is updated successfully','success');
				jump(admin_base_url()."all-hospital");
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
	    $cer_id	= post('hospital_id');
	    if(isset($_POST['txt_password']) && post('txt_password') != null && post('txt_password') != "")
		{
		    $data['hospital_password'] = encrypt(post('txt_password'));
		}
		if(isset($_POST['txt_username']) && post('txt_username') != null && post('txt_username') != "")
		{
    		$username = post('txt_username');
    		if(checkUniqueCol('tbl_hospital','hospital_username',$username, true, 'hospital_id', $cer_id ))
    		{
    		    $data['hospital_username'] = $username;
    		}
		}
		if(sizeof($data) > 0)
		{
		    where('hospital_id',$cer_id);
			if(update($data,'tbl_hospital'))
			{
				set_msg('Success','Credentials are updated successfully','success');
				jump(admin_base_url()."all-hospital");
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
		if(isset($_GET['hospital_id']) && $_GET['hospital_id'] != "" && $_GET['hospital_id'] != null && $_GET['hospital_id'] > 0 )
		{
			$cer_id = $_GET['hospital_id'];
			where('hospital_id',$cer_id);
			if(delete('tbl_hospital'))
			{
				set_msg('Success','Hospital is deleted successfully','success');
				jump(admin_base_url()."all-hospital");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."all-hospital");
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