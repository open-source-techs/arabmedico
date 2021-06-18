<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_dpt']))
	{
		$slug 							= strtolower(post('txt_dpt_url'));
		$data['dpt_name_arabic'] 		= $_POST['txt_dpt_name_arabic'];
		$data['dpt_name'] 				= post('txt_dpt_name');
		$image_name                 	= upload_image($_FILES,'txt_icon', '../../upload/');
		if($image_name)
		{
		    $data['dpt_icon_name'] 		= $image_name;
		}
		else
		{
		    $data['dpt_icon_name']  	= '';
		}
		$data['dpt_short_desc'] 		= $_POST['txt_short_desc'];
		$data['dpt_description'] 		= $_POST['txt_desc'];
		$data['dpt_short_desc_arabic'] 	= $_POST['txt_short_desc_arabic'];
		$data['dpt_description_arabic'] = $_POST['txt_desc_arabic'];
		$data['dpt_meta_title'] 		= post('txt_meta_title');
		$data['dpt_meta_title_ar'] 		= $_POST['txt_meta_title_ar'];
		$data['dpt_meta_tag'] 			= post('txt_tag');
		$data['dpt_meta_tag_ar'] 		= $_POST['txt_tag_ar'];
		$data['dpt_meta_desc'] 			= post('txt_meta_desc');
		$data['dpt_meta_desc_ar'] 		= $_POST['txt_meta_desc_ar'];


		if(checkUniqueCol('tbl_url','url_suffex',$slug))
		{
		    $data['dpt_slug'] = $slug;
    		if(
    			$data['dpt_name'] 				!= "" && $data['dpt_name'] 			!= null && 
    			$data['dpt_name_arabic'] 		!= "" && $data['dpt_name_arabic'] 	!= null && 
    			$data['dpt_icon_name'] 			!= "" && $data['dpt_icon_name'] 	!= null && 
    			$data['dpt_short_desc'] 		!= "" && $data['dpt_short_desc'] 	!= null && 
    			$data['dpt_short_desc_arabic'] 	!= "" && $data['dpt_short_desc_arabic'] 	!= null
    		)
    		{
    			if(insert2($data,'tbl_department'))
    			{
    			    $URLdata['url_suffex']  = $slug;
    			    $URLdata['url_type']    = 'Department';
    			    insert($URLdata,'tbl_url');
    				set_msg('Success','Department is added successfully','success');
    				jump(admin_base_url()."list-department");
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
	else if(isset($_POST['btn_edit_dpt']))
	{
		$dpt_id 						= post('txt_dpt_id'); 
		$data['dpt_name_arabic'] 		= $_POST['txt_dpt_name_arabic'];
		$data['dpt_name'] 				= post('txt_dpt_name');
		$image_name                 	= upload_image($_FILES,'txt_icon', '../../upload/');
		if($image_name)
		{
		    $data['dpt_icon_name'] 		= $image_name;
		}
		$data['dpt_short_desc'] 		= $_POST['txt_short_desc'];
		$data['dpt_description'] 		= $_POST['txt_desc'];
		$data['dpt_short_desc_arabic'] 	= $_POST['txt_short_desc_arabic'];
		$data['dpt_description_arabic'] = $_POST['txt_desc_arabic'];
		$data['dpt_meta_title'] 		= post('txt_meta_title');
		$data['dpt_meta_title_ar'] 		= $_POST['txt_meta_title_ar'];
		$data['dpt_meta_tag'] 			= post('txt_tag');
		$data['dpt_meta_tag_ar'] 		= $_POST['txt_tag_ar'];
		$data['dpt_meta_desc'] 			= post('txt_meta_desc');
		$data['dpt_meta_desc_ar'] 		= $_POST['txt_meta_desc_ar'];
		$previousSlug                   = post('previous_slug');
        $currentSlug                    = post('txt_dpt_url');
        $slugUpdate                     = false;
        if($previousSlug != $currentSlug)
        {
            if(checkUniqueCol('tbl_url','url_suffex',$currentSlug, true, 'url_suffex', $previousSlug ))
    		{
            	$slugUpdate                 = true;
    		    $data['dpt_slug']    		= $currentSlug;
    		}
        }
		if(
			$data['dpt_name'] 				!= "" && $data['dpt_name'] 					!= null && 
			$data['dpt_name_arabic'] 		!= "" && $data['dpt_name_arabic'] 			!= null && 
			$data['dpt_short_desc'] 		!= "" && $data['dpt_short_desc'] 			!= null && 
			$data['dpt_short_desc_arabic'] 	!= "" && $data['dpt_short_desc_arabic'] 	!= null
		)
		{
			where('dpt_id',$dpt_id);
			if(update2($data,'tbl_department'))
			{
			    if($slugUpdate)
			    {
			        $URLdata['url_suffex']  = $currentSlug;
    			    $URLdata['url_type']    = 'Department';
    			    where('url_suffex',$previousSlug);
    			    update($URLdata,'tbl_url');
			    }
			    
				set_msg('Success','Department is updated successfully','success');
				jump(admin_base_url()."list-department");
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
	else if(isset($_POST['btn_save_dpt_video']))
	{
	    $data['dpt_gallery_depart']     = post('txt_depart');
	    $data['dpt_gallery_is_video']   = post('txt_is_video');
	    $data['dpt_gallery_is_link']    = post('txt_is_link');
	    if($data['dpt_gallery_is_video'] == 1)
	    {
	        if($data['dpt_gallery_is_link'] == 1)
	        {
	            $data['dpt_gallery_video'] 		= $_POST['txt_embed_code'];
	            $data['dpt_gallery_video_ar'] 	= $_POST['txt_embed_code_ar'];
	        }
	        else
	        {
	            $data['dpt_gallery_is_link'] = 0;
	            $image_name                 = upload_image($_FILES,'txt_video', '../../upload/');
        		if($image_name)
        		{
        		    $data['dpt_gallery_video'] 	= $image_name;
        		}
        		else
        		{
        		    $data['dpt_gallery_video'] = '';
        		}
        		
        		$image_name1                 = upload_image($_FILES,'txt_video_ar', '../../upload/');
        		if($image_name1)
        		{
        		    $data['dpt_gallery_video_ar'] 	= $image_name1;
        		}
        		else
        		{
        		    $data['dpt_gallery_video_ar'] = '';
        		}
	        }
	    }
	    else
	    {
	        $data['dpt_gallery_is_link'] = 0;
	        $data['dpt_gallery_is_video'] == 0;
	        $image_name                 	= upload_image($_FILES,'txt_image', '../../upload/');
    		if($image_name)
    		{
    		    $data['dpt_gallery_image'] 		= $image_name;
    		}
    		else
    		{
    		    $data['dpt_gallery_image'] = '';
    		}
    		$image_name1                 	= upload_image($_FILES,'txt_image_ar', '../../upload/');
    		if($image_name1)
    		{
    		    $data['dpt_gallery_image_ar'] 		= $image_name1;
    		}
    		else
    		{
    		    $data['dpt_gallery_image_ar'] = '';
    		}
	    }
		if(($data['dpt_gallery_is_video'] == 1 && $data['dpt_gallery_video'] != "" ) || ($data['dpt_gallery_is_video'] == 0 &&  $data['dpt_gallery_image'] != ""))
		{
			if(insert2($data,'tbl_dpt_gallery'))
			{
			    $dpt_id = $data['dpt_gallery_depart'];
				set_msg('Success','Item is added successfully','success');
				jump(admin_base_url()."dpt-video-panel?dpt_id=".$dpt_id);
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
	else if(isset($_POST['btn_save_service']))
	{
	    $data['dpt_depart_id']              = post('dpt_id');
		$data['dpt_service_title'] 			= post('txt_cer_name');
	    $data['dpt_service_title_arabic']   = $_POST['arabic_cer_title'];
		$image_name                 	    = upload_image($_FILES,'cer_profile', '../../upload/');
		if($image_name)
		{
		    $data['dpt_service_img'] 		= $image_name;
		}
		else
		{
		    $data['dpt_service_img']  	    = '';
		}
		$data['dpt_service_desc'] 		    = $_POST['txt_short_desc'];
		$data['dpt_service_desc_arabic'] 	= $_POST['txt_short_desc_arabic'];
		if(
			$data['dpt_service_title'] 			!= "" && $data['dpt_service_title'] 		!= null && 
			$data['dpt_service_title_arabic'] 	!= "" && $data['dpt_service_title_arabic'] 	!= null && 
			$data['dpt_service_img'] 			!= "" && $data['dpt_service_img'] 	        != null && 
			$data['dpt_service_desc'] 		    != "" && $data['dpt_service_desc'] 	        != null && 
			$data['dpt_service_desc_arabic'] 	!= "" && $data['dpt_service_desc_arabic'] 	!= null
		)
		{
		    
			if(insert($data,'tbl_dpt_service'))
			{
			 //   echo "<pre>";
		  //  print_r($data);
		  //  die();
			    $dpt_id = $data['dpt_depart_id'];
				set_msg('Success','Service is added successfully','success');
				jump(admin_base_url()."dpt-service-panel?dpt_id=".$dpt_id);
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
	else if(isset($_POST['btn_edit_service']))
	{
	    $service_id                         = post('dpt_service_id');
	    $data['dpt_depart_id']              = $_POST['dpt_id'];
		$data['dpt_service_title'] 			= post('txt_cer_name');
	    $data['dpt_service_title_arabic']   = $_POST['arabic_cer_title'];
		$image_name                 	    = upload_image($_FILES,'cer_profile', '../../upload/');
		if($image_name)
		{
		    $data['dpt_service_img'] 		= $image_name;
		}
		$data['dpt_service_desc'] 		    = $_POST['txt_short_desc'];
		$data['dpt_service_desc_arabic'] 	= $_POST['txt_short_desc_arabic'];
		if(
			$data['dpt_service_title'] 			!= "" && $data['dpt_service_title'] 		!= null && 
			$data['dpt_service_title_arabic'] 	!= "" && $data['dpt_service_title_arabic'] 	!= null && 
			$data['dpt_service_desc'] 		    != "" && $data['dpt_service_desc'] 	        != null && 
			$data['dpt_service_desc_arabic'] 	!= "" && $data['dpt_service_desc_arabic'] 	!= null
		)
		{
		  //  echo "<pre>";
		  //  print_r($data);
		  //  die();
		    where('dpt_service_id',$service_id);
			if(update($data,'tbl_dpt_service'))
			{
			    $dpt_id = $data['dpt_depart_id'];
				set_msg('Success','Service is updated successfully','success');
				jump(admin_base_url()."dpt-service-panel?dpt_id=".$dpt_id);
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
	else if(isset($_POST['btn_edit_dpt_video']))
	{
	    $gall_id 						= post('txt_id'); 
		$data['dpt_gallery_depart']     = post('txt_depart');
	    $data['dpt_gallery_is_video']       = post('txt_is_video');
	    $data['dpt_gallery_is_link']        = post('txt_is_link');
	    $data['dpt_gallery_active']         = post('txt_is_active');
	    if($data['dpt_gallery_is_video'] == 1)
	    {
	        if($data['dpt_gallery_is_link'] == 1)
	        {
	            $data['dpt_gallery_video'] 		= $_POST['txt_embed_code'];
	            $data['dpt_gallery_video_ar'] 		= $_POST['txt_embed_code_ar'];
	        }
	        else
	        {
	            $image_name                 = upload_image($_FILES,'txt_video', '../../upload/');
        		if($image_name)
        		{
        		    $data['dpt_gallery_video'] 	= $image_name;
        		}
        		$image_name1                 = upload_image($_FILES,'txt_video_ar', '../../upload/');
        		if($image_name1)
        		{
        		    $data['dpt_gallery_video_ar'] 	= $image_name1;
        		}
	        }
	    }
	    else
	    {
	        $image_name                 	= upload_image($_FILES,'txt_image', '../../upload/');
    		if($image_name)
    		{
    		    $data['dpt_gallery_image'] 		= $image_name;
    		}
    		$image_name1                 	= upload_image($_FILES,'txt_image_ar', '../../upload/');
    		if($image_name1)
    		{
    		    $data['dpt_gallery_image_ar'] 		= $image_name1;
    		}
	    }
	    where('dpt_gallery_id',$gall_id);
		if(update($data,'tbl_dpt_gallery'))
		{
			set_msg('Success','Item is updated successfully','success');
			jump(admin_base_url()."dpt-video-panel?dpt_id=".$data['dpt_gallery_depart']);
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['action']) && $_POST['action'] == "change_status")
	{
	    $value = post('val');
	    $slide = post('sl_id');
	    $dptID = post('dpt_id');
	    if($value == "deactive")
	    {
	        $sql = query("UPDATE tbl_dpt_gallery SET dpt_gallery_video_show = 0 WHERE dpt_gallery_depart = $dptID ");
	        if($sql)
	        {
	            $arr = array(
	                "status" => "done",
	                "responce" => "Successfully deactived all videos to show on page",
                );
	        }
	        {
				$arr = array(
	                "status" => "error",
	                "responce" => "Unable to process your request",
                );
			}
	    }
	    else if($value == "active")
	    {
	        $sql = query("UPDATE tbl_dpt_gallery SET dpt_gallery_video_show = 0 WHERE dpt_gallery_depart = $dptID ");
	        if($sql)
	        {
	            $data1['dpt_gallery_video_show'] = 1;
	            where('dpt_gallery_id',$slide);
	            if(update($data1, 'tbl_dpt_gallery'))
    			{
    				$arr = array(
    	                "status" => "done",
    	                "responce" => "Video is successfully updated to show on home",
                    );
    			}
    			else
    			{
    				$arr = array(
    	                "status" => "error",
    	                "responce" => "Unable to process your request",
                    );
    			}
	        }
	        else
	        {
				$arr = array(
	                "status" => "error",
	                "responce" => " abc Unable to process your request",
                );
			}
	    }
	    echo json_encode($arr);
	    
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
		if(isset($_GET['dpt_id']) && $_GET['dpt_id'] != "" && $_GET['dpt_id'] != null && $_GET['dpt_id'] > 0 )
		{
			$dpt_id = $_GET['dpt_id'];
			where('dpt_id',$dpt_id);
			if(delete('tbl_department'))
			{
				set_msg('Success','Department is deleted successfully','success');
				jump(admin_base_url()."list-department");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."list-department");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."list-department");
		}
	}
	else if(isset($_GET['act']) && $_GET['act'] == "del-item")
	{
	    $dpt_id = $_GET['dpt_id'];
		if(isset($_GET['gal_id']) && $_GET['gal_id'] != "" && $_GET['gal_id'] != null && $_GET['gal_id'] > 0 )
		{
			$gall_id = $_GET['gal_id'];
			
			where('dpt_gallery_id',$gall_id);
			if(delete('tbl_dpt_gallery'))
			{
				set_msg('Success','Gallery Item is deleted successfully','success');
				jump(admin_base_url()."dpt-video-panel?dpt_id=".$dpt_id);
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."dpt-video-panel?dpt_id=".$dpt_id);
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."dpt-video-panel?dpt_id=".$dpt_id);
		}
	}
	else if(isset($_GET['act']) && $_GET['act'] == "del-dpt-ser")
	{
	    $dpt_id = $_GET['dpt_id'];
		if(isset($_GET['service']) && $_GET['service'] != "" && $_GET['service'] != null && $_GET['service'] > 0 )
		{
			$serviceID = $_GET['service'];
			
			where('dpt_service_id',$serviceID);
			if(delete('tbl_dpt_service'))
			{
				set_msg('Success','Service is deleted successfully','success');
				jump(admin_base_url()."dpt-service-panel?dpt_id=".$dpt_id);
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."dpt-service-panel?dpt_id=".$dpt_id);
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."dpt-service-panel?dpt_id=".$dpt_id);
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