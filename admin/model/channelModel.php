<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_chn']))
	{
		$slug 						    = strtolower(post('txt_chan_url'));
		$data['chn_name'] 			    = post('txt_name');
		$data['chn_name_arabic'] 	    = $_POST['txt_name_arabic'];
		$data['channel_user_name'] 		= post('txt_user_name');
		$data['channel_username_ar'] 	= $_POST['txt_user_name_arabic'];
		$data['chn_degree'] 		    = post('txt_degree');
		$data['chn_degree_ar'] 		    = $_POST['txt_degree_arabic'];
		$data['chn_job_title'] 		    = post('txt_job');
		$data['chn_job_title_ar'] 	    = $_POST['txt_job_arabic'];
		$data['chn_department'] 	    = post('txt_depart');
		$data['chn_institue'] 		    = post('txt_institue');
		$data['chn_institue_ar'] 	    = $_POST['txt_institute_arabic'];
		$data['chn_location'] 		    = post('txt_area');
		$data['chn_city'] 			    = post('txt_city');
		$data['chn_country'] 		    = post('txt_country');
		$data['chn_meta_title'] 		= post('txt_meta_title');
		$data['chn_meta_title_ar'] 		= $_POST['txt_meta_title_ar'];
		$data['chn_meta_tag'] 			= post('txt_tag');
		$data['chn_meta_tag_ar'] 		= $_POST['txt_tag_ar'];
		$data['chn_meta_desc'] 			= post('txt_meta_desc');
		$data['chn_meta_desc_ar'] 		= $_POST['txt_meta_desc_ar'];
		$image_name                     = upload_image($_FILES,'txt_icon', '../../upload/');
		if($image_name)
		{
		    $data['chn_icon_name'] 	    = $image_name;
		}
		else
		{
		    $data['chn_icon_name']      = '';
		}
		$image_name1                     = upload_image($_FILES,'txt_handler', '../../upload/');
		if($image_name1)
		{
		    $data['chn_handler_img'] 	    = $image_name1;
		}
		else
		{
		    $data['chn_handler_img']      = '';
		}
		$data['chn_short_desc'] 		= $_POST['txt_short_desc'];
		$data['chn_description'] 		= $_POST['txt_desc'];
		$data['chn_short_desc_arabic'] 	= $_POST['txt_short_desc_arabic'];
		$data['chn_description_arabic'] = $_POST['txt_desc_arabic'];
		if(checkUniqueCol('tbl_url','url_suffex',$slug))
		{
		    $data['chn_slug'] = $slug;
    		if(
    			$data['chn_name'] 				!= "" && $data['chn_name'] 			!= null && 
    			$data['chn_name_arabic'] 		!= "" && $data['chn_name_arabic'] 	!= null && 
    			$data['chn_icon_name'] 			!= "" && $data['chn_icon_name'] 	!= null && 
    			$data['chn_handler_img'] 		!= "" && $data['chn_handler_img'] 	!= null && 
    			$data['chn_short_desc'] 		!= "" && $data['chn_short_desc'] 	!= null && 
    			$data['chn_short_desc_arabic'] 	!= "" && $data['chn_short_desc_arabic'] 	!= null
    		)
    		{
    			if(insert2($data,'tbl_channel'))
    			{
    			    $URLdata['url_suffex']  = $slug;
    			    $URLdata['url_type']    = 'Channel';
    			    insert($URLdata,'tbl_url');
    				set_msg('Success','Channel is added successfully','success');
    				jump(admin_base_url()."all-channel");
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
		else
		{
			set_msg('Fields validation','URL already registered','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_edit_chn']))
	{
		$chn_id 					    = post('txt_chn_id'); 
		$data['chn_name'] 			    = post('txt_name');
		$data['chn_name_arabic'] 	    = $_POST['txt_name_arabic'];
		$data['channel_user_name'] 		= post('txt_user_name');
		$data['channel_username_ar'] 	= $_POST['txt_user_name_arabic'];
		$data['chn_degree'] 		    = post('txt_degree');
		$data['chn_degree_ar'] 		    = $_POST['txt_degree_arabic'];
		$data['chn_job_title'] 		    = post('txt_job');
		$data['chn_job_title_ar'] 	    = $_POST['txt_job_arabic'];
		$data['chn_department'] 	    = post('txt_depart');
		$data['chn_institue'] 		    = post('txt_institue');
		$data['chn_institue_ar'] 	    = $_POST['txt_institute_arabic'];
		$data['chn_location'] 		    = post('txt_area');
		$data['chn_city'] 			    = post('txt_city');
		$data['chn_country'] 		    = post('txt_country');
		$data['chn_meta_title'] 		= post('txt_meta_title');
		$data['chn_meta_title_ar'] 		= $_POST['txt_meta_title_ar'];
		$data['chn_meta_tag'] 			= post('txt_tag');
		$data['chn_meta_tag_ar'] 		= $_POST['txt_tag_ar'];
		$data['chn_meta_desc'] 			= post('txt_meta_desc');
		$data['chn_meta_desc_ar'] 		= $_POST['txt_meta_desc_ar'];
		$image_name                     = upload_image($_FILES,'txt_icon', '../../upload/');
		if($image_name)
		{
		    $data['chn_icon_name'] 		= $image_name;
		}
		$image_name1                     = upload_image($_FILES,'txt_handler', '../../upload/');
		if($image_name1)
		{
		    $data['chn_handler_img'] 	= $image_name1;
		}
		$data['chn_short_desc'] 		= $_POST['txt_short_desc'];
		$data['chn_short_desc_arabic'] 	= $_POST['txt_short_desc_arabic'];
		$data['chn_description'] 		= $_POST['txt_desc'];
		$data['chn_description_arabic'] = $_POST['txt_desc_arabic'];
		$previousSlug                   = post('previous_slug');
        $currentSlug                    = post('txt_chan_url');
        $slugUpdate                     = false;
        if($previousSlug != $currentSlug)
        {
            if(checkUniqueCol('tbl_url','url_suffex',$currentSlug, true, 'url_suffex', $previousSlug ))
    		{
    		    $slugUpdate             = true;
    		    $data['chn_slug']       = $currentSlug;
    		}
    		else
    		{
    		    set_msg('Slug Duplication','Sorry this slug is already registered. Please try again another','error');
				echo "<script>window.history.go(-1);</script>";
    		}
        }
        
		if(
			$data['chn_name'] 				!= "" && $data['chn_name'] 			!= null && 
			$data['chn_name_arabic'] 		!= "" && $data['chn_name_arabic'] 	!= null && 
			$data['chn_short_desc'] 		!= "" && $data['chn_short_desc'] 	!= null && 
			$data['chn_short_desc_arabic'] 	!= "" && $data['chn_short_desc_arabic'] 	!= null
		)
		{
			where('chn_id',$chn_id);
			if(update2($data,'tbl_channel'))
			{
			    if($slugUpdate)
			    {
			        $URLdata['url_suffex']  = $currentSlug;
    			    $URLdata['url_type']    = 'Channel';
    			    where('url_suffex',$previousSlug);
    			    update($URLdata,'tbl_url');
			    }
				set_msg('Success','Channel is updated successfully','success');
				jump(admin_base_url()."all-channel");
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
	else if(isset($_POST['btn_save_chn_video']))
	{
	    $data['chn_video_parent']       = post('txt_channel');
	    $data['chn_video_title']        = post('txt_video_title');
	    $data['chn_video_title_ar']     = $_POST['txt_video_title_ar'];
	    $data['chn_is_link']            = post('txt_is_link');
	    if($data['chn_is_link'] == 0)
	    {
	        $image_name1                 	= upload_image($_FILES,'txt_video', '../../upload/');
    		if($image_name1)
    		{
    		    $data['chn_video_media']        = $image_name1;
    		}
    		else
    		{
    		    $data['chn_video_media']  	= '';
    		}
    		$image_name2                 	= upload_image($_FILES,'txt_video_ar', '../../upload/');
    		if($image_name2)
    		{
    		    $data['chn_video_media_ar']        = $image_name2;
    		}
    		else
    		{
    		    $data['chn_video_media_ar']  	= '';
    		}
    		
    		$image_name3                 	= upload_image($_FILES,'txt_image', '../../upload/');
    		if($image_name3)
    		{
    		    $data['chn_video_thumbnail']        = $image_name3;
    		}
    		else
    		{
    		    $data['chn_video_thumbnail']  	= '';
    		}
    		$image_name4                 	= upload_image($_FILES,'txt_image_ar', '../../upload/');
    		if($image_name4)
    		{
    		    $data['chn_video_thumbnail_ar']        = $image_name4;
    		}
    		else
    		{
    		    $data['chn_video_thumbnail_ar']  	= '';
    		}
	    }
	    else if($data['chn_is_link'] == 1)
	    {
	        $data['chn_video_media']     = $_POST['txt_video_link'];
	        $data['chn_video_media_ar']  = $_POST['txt_video_link_ar'];
	    }
		if(
			$data['chn_video_title'] 	    != "" && $data['chn_video_title'] 		    != null && 
			$data['chn_video_title_ar']     != "" && $data['chn_video_title_ar'] 	    != null && 
			$data['chn_video_media'] 	    != "" && $data['chn_video_media'] 	        != null && 
			$data['chn_video_media_ar']     != "" && $data['chn_video_media_ar'] 	    != null
		)
		{
		    if(insert2($data,'tbl_chn_gallery'))
			{
			    set_msg('Success','Video is added successfully','success');
    			jump(admin_base_url()."chn-video-panel?chn_id=".$data['chn_video_parent']);
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
}
if($_SERVER['REQUEST_METHOD'] == "GET")
{
    if(isset($_GET['act']) && $_GET['act'] == "del")
	{
		if(isset($_GET['chn_id']) && $_GET['chn_id'] != "" && $_GET['chn_id'] != null && $_GET['chn_id'] > 0 )
		{
			$chn_id = $_GET['chn_id'];
			where('chn_id',$chn_id);
			if(delete('tbl_channel'))
			{
				set_msg('Success','Channel is deleted successfully','success');
				jump(admin_base_url()."all-channel");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."all-channel");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."all-channel");
		}
	}
	else if(isset($_GET['act']) && $_GET['act'] == "del-item")
	{
	    if(isset($_GET['chn_id']) && $_GET['chn_id'] != "" && $_GET['chn_id'] != null && $_GET['chn_id'] > 0 )
	    {
	        $parent_id = $_GET['parent_id'];
	        $chn_id = $_GET['chn_id'];
			where('chn_video_id',$chn_id);
			if(delete('tbl_chn_gallery'))
			{
				set_msg('Success','Video is deleted successfully','success');
    			jump(admin_base_url()."chn-video-panel?chn_id=".$parent_id);
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."chn-video-panel?chn_id=".$parent_id);
			}
	    }
	}
}
?>