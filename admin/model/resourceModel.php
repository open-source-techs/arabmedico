<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_dpt']))
	{
		$data['resource_name_arabic'] 	= $_POST['txt_dpt_name_arabic'];
		$data['resource_author'] 		= $_POST['txt_author'];
		$data['resource_title'] 		= $_POST['txt_title'];
		$data['resource_deg'] 			= $_POST['txt_deg'];
		$data['resource_author_ar'] 	= $_POST['txt_author_ar'];
		$data['resource_title_ar'] 		= $_POST['txt_title_ar'];
		$data['resource_deg_ar'] 		= $_POST['txt_deg_ar'];
		$data['resource_name'] 			= post('txt_dpt_name');
		$data['resource_meta_title'] 	= post('txt_meta_title');
		$data['resource_meta_title_ar'] = $_POST['txt_meta_title_ar'];
		$data['resource_meta_tag'] 		= post('txt_tag');
		$data['resource_meta_tag_ar'] 	= $_POST['txt_tag_ar'];
		$data['resource_meta_desc'] 	= post('txt_meta_desc');
		$data['resource_meta_desc_ar'] 	= $_POST['txt_meta_desc_ar'];
		$image_name                 	= upload_image($_FILES,'txt_icon', '../../upload/');
		if($image_name)
		{
		    $data['resource_icon_name'] 	= $image_name;
		}
		else
		{
		    $data['resource_icon_name']  	= '';
		}
		$data['resource_short_desc'] 		= $_POST['txt_short_desc'];
		$data['resource_short_desc_arabic'] = $_POST['txt_short_desc_arabic'];
		$slug 								= strtolower(post('txt_slug'));

		if(checkUniqueCol('tbl_url','url_suffex',$slug))
		{
			$data['resource_slug'] = $slug;
			if(
				$data['resource_name'] 				!= "" && $data['resource_name'] 			!= null && 
				$data['resource_name_arabic'] 		!= "" && $data['resource_name_arabic'] 	!= null && 
				$data['resource_icon_name'] 		!= "" && $data['resource_icon_name'] 	!= null && 
				$data['resource_short_desc'] 		!= "" && $data['resource_short_desc'] 	!= null &&
				$data['resource_author'] 		    != "" && $data['resource_author'] 	!= null &&
				$data['resource_title'] 		    != "" && $data['resource_title'] 	!= null &&
				$data['resource_deg'] 		    	!= "" && $data['resource_deg'] 	!= null &&
				$data['resource_author_ar'] 		!= "" && $data['resource_author_ar'] 	!= null &&
				$data['resource_title_ar'] 		    != "" && $data['resource_title_ar'] 	!= null &&
				$data['resource_deg_ar'] 		    != "" && $data['resource_deg_ar'] 	!= null &&
				$data['resource_short_desc_arabic'] != "" && $data['resource_short_desc_arabic'] 	!= null
			)
			{
				if(insert2($data,'tbl_resources'))
				{
					$URLdata['url_suffex']  = $slug;
    			    $URLdata['url_type']    = 'Resource';
    			    insert($URLdata,'tbl_url');
					set_msg('Success','Patient Resource is added successfully','success');
					jump(admin_base_url()."list-resource");
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
		$resource_id 					= post('txt_dpt_id'); 
		$data['resource_name_arabic'] 	= $_POST['txt_dpt_name_arabic'];
		$data['resource_author'] 		= $_POST['txt_author'];
		$data['resource_title'] 		= $_POST['txt_title'];
		$data['resource_deg'] 			= $_POST['txt_deg'];
		$data['resource_author_ar'] 	= $_POST['txt_author_ar'];
		$data['resource_title_ar'] 		= $_POST['txt_title_ar'];
		$data['resource_deg_ar'] 		= $_POST['txt_deg_ar'];
		$data['resource_name'] 			= post('txt_dpt_name');
		$data['resource_meta_title'] 	= post('txt_meta_title');
		$data['resource_meta_title_ar'] = $_POST['txt_meta_title_ar'];
		$data['resource_meta_tag'] 		= post('txt_tag');
		$data['resource_meta_tag_ar'] 	= $_POST['txt_tag_ar'];
		$data['resource_meta_desc'] 	= post('txt_meta_desc');
		$data['resource_meta_desc_ar'] 	= $_POST['txt_meta_desc_ar'];
		$image_name                 	= upload_image($_FILES,'txt_icon', '../../upload/');
		if($image_name)
		{
		    $data['resource_icon_name'] 		= $image_name;
		}
		$data['resource_short_desc'] 			= $_POST['txt_short_desc'];
		$data['resource_short_desc_arabic'] 	= $_POST['txt_short_desc_arabic'];
		$previousSlug                   		= post('previous_slug');
        $currentSlug                    		= post('txt_dpt_url');
        $slugUpdate                     		= false;
        if($previousSlug != $currentSlug)
        {
            if(checkUniqueCol('tbl_url','url_suffex',$currentSlug, true, 'url_suffex', $previousSlug ))
    		{
            	$slugUpdate                 		= true;
    		    $data['resource_slug']    			= $currentSlug;
    		}
        }
		if(
			$data['resource_name'] 				!= "" && $data['resource_name'] 				!= null && 
			$data['resource_author'] 		    != "" && $data['resource_author'] 				!= null &&
			$data['resource_title'] 		    != "" && $data['resource_title'] 				!= null &&
			$data['resource_deg'] 		    	!= "" && $data['resource_deg'] 					!= null &&
			$data['resource_author_ar'] 		!= "" && $data['resource_author_ar'] 			!= null &&
			$data['resource_title_ar'] 		    != "" && $data['resource_title_ar'] 			!= null &&
			$data['resource_deg_ar'] 		    != "" && $data['resource_deg_ar'] 				!= null &&
			$data['resource_name_arabic'] 		!= "" && $data['resource_name_arabic'] 			!= null && 
			$data['resource_short_desc'] 		!= "" && $data['resource_short_desc'] 			!= null && 
			$data['resource_short_desc_arabic'] != "" && $data['resource_short_desc_arabic'] 	!= null
		)
		{
			where('resource_id',$resource_id);
			if(update2($data,'tbl_resources'))
			{
				if($slugUpdate)
			    {
			        $URLdata['url_suffex']  = $currentSlug;
    			    $URLdata['url_type']    = 'Resource';
    			    where('url_suffex',$previousSlug);
    			    update($URLdata,'tbl_url');
			    }
				set_msg('Success','Patient Resource is updated successfully','success');
				jump(admin_base_url()."list-resource");
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
	    $data['resource_gallery_depart']     = post('txt_depart');
	    $data['resource_gallery_is_video']   = post('txt_is_video');
	    $data['resource_gallery_is_link']    = post('txt_is_link');
	    if($data['resource_gallery_is_video'] == 1)
	    {
	        if($data['resource_gallery_is_link'] == 1)
	        {
	            $data['resource_gallery_video'] 		= $_POST['txt_embed_code'];
	            $data['resource_gallery_video_ar'] 		= $_POST['txt_embed_code_ar'];
	        }
	        else
	        {
	            $data['resource_gallery_is_link'] = 0;
	            $image_name                 = upload_image($_FILES,'txt_video', '../../upload/');
        		if($image_name)
        		{
        		    $data['resource_gallery_video'] 	= $image_name;
        		}
        		else
        		{
        		    $data['resource_gallery_video'] = '';
        		}
        		$image_name1                 = upload_image($_FILES,'txt_video_ar', '../../upload/');
        		if($image_name1)
        		{
        		    $data['resource_gallery_video_ar'] 	= $image_name1;
        		}
        		else
        		{
        		    $data['resource_gallery_video_ar'] = '';
        		}
	        }
	    }
	    else
	    {
	        $data['resource_gallery_is_link'] = 0;
	        $data['resource_gallery_is_video'] == 0;
	        $image_name                 	= upload_image($_FILES,'txt_image', '../../upload/');
    		if($image_name)
    		{
    		    $data['resource_gallery_image'] 		= $image_name;
    		}
    		else
    		{
    		    $data['resource_gallery_image'] = '';
    		}
    		$image_name1                 	= upload_image($_FILES,'txt_image_ar', '../../upload/');
    		if($image_name1)
    		{
    		    $data['resource_gallery_image_ar'] 		= $image_name1;
    		}
    		else
    		{
    		    $data['resource_gallery_image_ar'] = '';
    		}
	    }
		if(($data['resource_gallery_is_video'] == 1 && $data['resource_gallery_video'] != "" ) || ($data['resource_gallery_is_video'] == 0 &&  $data['resource_gallery_image'] != ""))
		{
		  //  echo "<pre>";
		  //  print_r($data);
		    
			if(insert2($data,'tbl_resource_gallery'))
			{
			 //   die();
			    $resource_id = $data['resource_gallery_depart'];
				set_msg('Success','Item is added successfully','success');
				jump(admin_base_url()."resource-video-panel?dpt_id=".$resource_id);
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
		$data['resource_gallery_depart']     = post('txt_depart');
	    $data['resource_gallery_is_video']       = post('txt_is_video');
	    $data['resource_gallery_is_link']        = post('txt_is_link');
	    $data['resource_gallery_active']         = post('txt_is_active');
	    if($data['resource_gallery_is_video'] == 1)
	    {
	        if($data['resource_gallery_is_link'] == 1)
	        {
	            $data['resource_gallery_video'] 		= $_POST['txt_embed_code'];
	            $data['resource_gallery_video_ar'] 		= $_POST['txt_embed_code'];
	        }
	        else
	        {
	            $image_name                 = upload_image($_FILES,'txt_video', '../../upload/');
        		if($image_name)
        		{
        		    $data['resource_gallery_video'] 	= $image_name;
        		}
        		
        		$image_name1                 = upload_image($_FILES,'txt_video', '../../upload/');
        		if($image_name1)
        		{
        		    $data['resource_gallery_video_ar'] 	= $image_name1;
        		}
	        }
	    }
	    else
	    {
	        $image_name                 	= upload_image($_FILES,'txt_image', '../../upload/');
    		if($image_name)
    		{
    		    $data['resource_gallery_image'] 		= $image_name;
    		}
    		$image_name1                 	= upload_image($_FILES,'txt_image', '../../upload/');
    		if($image_name1)
    		{
    		    $data['resource_gallery_image_ar'] 		= $image_name1;
    		}
	    }
	    where('resource_gallery_id',$gall_id);
		if(update($data,'tbl_resource_gallery'))
		{
			set_msg('Success','Item is updated successfully','success');
			jump(admin_base_url()."resource-video-panel?dpt_id=".$data['resource_gallery_depart']);
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_save_service']))
	{
	    $data['resource_depart_id']             = post('dpt_id');
	    query("DELETE FROM tbl_resource_service WHERE resource_depart_id = ".$data['resource_depart_id']);
	    foreach($_POST['txt_service_id'] as $key => $val)
	    {
	        $data['resource_service_title'] 		= $_POST['txt_cer_name'][$key];
    	    $data['resource_service_title_arabic']  = $_POST['arabic_cer_title'][$key];
    		$data['resource_service_desc'] 		    = htmlentities(htmlspecialchars($_POST['txt_short_desc'][$key]));
    		$data['resource_service_desc_arabic'] 	= htmlentities(htmlspecialchars($_POST['txt_short_desc_arabic'][$key]));
    	    insert($data,'tbl_resource_service');
	    }
	    $dpt_id = $data['resource_depart_id'];
		set_msg('Success','Record Updated','success');
		jump(admin_base_url()."add-resource-service?dpt_id=".$dpt_id);
	}
	else if(isset($_POST['action']) && $_POST['action'] == "change_status")
	{
	    $value = post('val');
	    $slide = post('sl_id');
	    $dptID = post('dpt_id');
	    if($value == "deactive")
	    {
	        $sql = query("UPDATE tbl_resource_gallery SET resource_gallery_video_show = 0 WHERE resource_gallery_depart = $dptID ");
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
	        $sql = query("UPDATE tbl_resource_gallery SET resource_gallery_video_show = 0 WHERE resource_gallery_depart = $dptID ");
	        if($sql)
	        {
	            $data1['resource_gallery_video_show'] = 1;
	            where('resource_gallery_id',$slide);
	            if(update($data1, 'tbl_resource_gallery'))
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
			where('resource_id',$dpt_id);
			if(delete('tbl_resources'))
			{
			    where('resource_gallery_depart',$dpt_id);
			    delete('tbl_resource_gallery');
			    
			    where('resource_depart_id',$dpt_id);
			    delete('tbl_resource_service');
			    
			    
				set_msg('Success','Resource is deleted successfully','success');
				jump(admin_base_url()."list-resource");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."list-resource");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."list-resource");
		}
	}
	else if(isset($_GET['act']) && $_GET['act'] == "del-item")
	{
	    $dpt_id = $_GET['dpt_id'];
		if(isset($_GET['gal_id']) && $_GET['gal_id'] != "" && $_GET['gal_id'] != null && $_GET['gal_id'] > 0 )
		{
			$gall_id = $_GET['gal_id'];
			
			where('resource_gallery_id',$gall_id);
			if(delete('tbl_resource_gallery'))
			{
				set_msg('Success','Gallery Item is deleted successfully','success');
				jump(admin_base_url()."resource-video-panel?dpt_id=".$dpt_id);
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."resource-video-panel?dpt_id=".$dpt_id);
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."resource-video-panel?dpt_id=".$dpt_id);
		}
	}
	else if(isset($_GET['act']) && $_GET['act'] == "del-dpt-ser")
	{
	    $dpt_id = $_GET['dpt_id'];
		if(isset($_GET['service']) && $_GET['service'] != "" && $_GET['service'] != null && $_GET['service'] > 0 )
		{
			$serviceID = $_GET['service'];
			
			where('resource_service_id',$serviceID);
			if(delete('tbl_resource_service'))
			{
				set_msg('Success','Service is deleted successfully','success');
				jump(admin_base_url()."resource-service-panel?dpt_id=".$dpt_id);
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."resource-service-panel?dpt_id=".$dpt_id);
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."resource-service-panel?dpt_id=".$dpt_id);
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