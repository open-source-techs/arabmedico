<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    
	if(isset($_POST['btn_save_job']))
	{
		$data['job_title']          = post('txt_job_title');
		$data['job_title_ar'] 		= $_POST['ar_job_title'];
		$data['job_desc'] 			= $_POST['txt_desc'];
		$data['job_desc_ar'] 		= $_POST['ar_desc'];
		$data['job_location']       = post('txt_job_loc');
		$data['job_location_ar']    = $_POST['ar_job_loc'];
		$data['job_section']        = post('txt_job_section');
		$data['job_section_ar']     = $_POST['txt_job_section_arabic'];
		$data['job_close_date']     = $_POST['txt_closing_time'];
		$data['job_close_date_ar'] 	= changeNumberToArabic($data['job_close_date']);
		$data['job_posted_by']      = post('txt_posted_by');
		$data['job_posted_by_ar']   = $_POST['txt_postedby_ar'];
		$data['job_meta_title'] 	= post('txt_meta_title');
		$data['job_meta_title_ar'] 	= $_POST['txt_meta_title_ar'];
		$data['job_meta_tag'] 		= post('txt_tag');
		$data['job_meta_tag_ar'] 	= $_POST['txt_tag_ar'];
		$data['job_meta_desc'] 		= post('txt_meta_desc');
		$data['job_meta_desc_ar'] 	= $_POST['txt_meta_desc_ar'];
		$slug 						= strtolower(post('txt_slug'));
		if(checkUniqueCol('tbl_url','url_suffex',$slug))
		{
		    $data['job_slug'] = $slug;
    		$image_name                	= upload_image($_FILES,'txt_job_icon', '../../upload/');
    		if($image_name)
    		{
    		    $data['job_icon'] 	= $image_name;
    		}
    		else
    		{
    		    $data['job_icon']  = '';
    		}
    		
    		if(
    		    $data['job_title'] 			!= "" && $data['job_title'] 		!= null &&
    			$data['job_title_ar'] 		!= "" && $data['job_title_ar'] 		!= null &&
    			$data['job_desc'] 			!= "" && $data['job_desc'] 	    	!= null &&
    			$data['job_desc_ar'] 	    != "" && $data['job_desc_ar'] 		!= null &&
    			$data['job_location'] 		!= "" && $data['job_location'] 		!= null &&
     			$data['job_location_ar'] 	!= "" && $data['job_location_ar'] 	!= null &&
    			$data['job_section'] 		!= "" && $data['job_section'] 		!= null &&
     			$data['job_section_ar'] 	!= "" && $data['job_section_ar']     != null &&
     			$data['job_icon'] 		    != "" && $data['job_icon']          != null &&
     			$data['job_close_date'] 	!= "" && $data['job_close_date']    != null
    		)
    		{
    		  //  echo "<pre>";
    		  //  print_r($data);
    		  //  die();
    		    
    			if(insert2($data,'tbl_classified_job'))
    			{
    			    
    			    $URLdata['url_suffex']  = $slug;
    			    $URLdata['url_type']    = 'classified';
    			    insert($URLdata,'tbl_url');
    			    
    				set_msg('Success','Job is added successfully','success');
    				jump(admin_base_url()."classified-list");
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
	}
	else if(isset($_POST['btn_edit_job']))
	{
	    $job_id 					 = post('txt_job_id');
	    $data['job_title']          = post('txt_job_title');
		$data['job_title_ar'] 		= $_POST['ar_job_title'];
		$data['job_desc'] 			= $_POST['txt_desc'];
		$data['job_desc_ar'] 		= $_POST['ar_desc'];
		$data['job_location']       = post('txt_job_loc');
		$data['job_location_ar']    = $_POST['ar_job_loc'];
		$data['job_section']        = post('txt_job_section');
		$data['job_section_ar']     = $_POST['txt_job_section_arabic'];
		$data['job_close_date']     = $_POST['txt_closing_time'];
		$data['job_close_date_ar'] 	= changeNumberToArabic($data['job_close_date']);
		$data['job_posted_by']      = post('txt_posted_by');
		$data['job_posted_by_ar']   = $_POST['txt_postedby_ar'];
		$data['job_meta_title'] 	= post('txt_meta_title');
		$data['job_meta_title_ar'] 	= $_POST['txt_meta_title_ar'];
		$data['job_meta_tag'] 		= post('txt_tag');
		$data['job_meta_tag_ar'] 	= $_POST['txt_tag_ar'];
		$data['job_meta_desc'] 		= post('txt_meta_desc');
		$data['job_meta_desc_ar'] 	= $_POST['txt_meta_desc_ar'];
		
		$previousSlug                   = post('previous_slug');
        $currentSlug                    = strtolower(post('txt_slug'));
        $slugUpdate                     = false;
        if($previousSlug != $currentSlug)
        {
            $slugUpdate                 = true;
            if(checkUniqueCol('tbl_url','url_suffex',$currentSlug, true, 'url_suffex', $previousSlug ))
    		{
    		    $data['job_slug']    = $currentSlug;
    		}
        }
		
		$image_name                	  = upload_image($_FILES,'txt_job_icon', '../../upload/');
		if($image_name)
		{
		    $data['job_icon']         = $image_name;
		}
		if(
		    
			$data['job_title'] 			!= "" && $data['job_title'] 		!= null &&
			$data['job_title_ar'] 		!= "" && $data['job_title_ar'] 		!= null &&
			$data['job_desc'] 			!= "" && $data['job_desc'] 	    	!= null &&
			$data['job_desc_ar'] 	    != "" && $data['job_desc_ar'] 		!= null &&
			$data['job_location'] 		!= "" && $data['job_location'] 		!= null &&
 			$data['job_location_ar'] 	!= "" && $data['job_location_ar'] 	!= null &&
			$data['job_section'] 		!= "" && $data['job_section'] 		!= null &&
			$data['job_section_ar'] 	!= "" && $data['job_section_ar'] 	!= null &&
 			$data['job_close_date'] 	!= "" && $data['job_close_date'] 	!= null &&
			$data['job_close_date_ar'] 	!= "" && $data['job_close_date_ar'] != null
		)
		{
			where('job_id',$job_id);
			if(update2($data,'tbl_classified_job'))
			{
			    
			    if($slugUpdate)
			    {
			        $URLdata['url_suffex']  = $currentSlug;
    			    $URLdata['url_type']    = 'classified';
    			    where('url_suffex',$previousSlug);
    			    update($URLdata,'tbl_url');
			    }
			    
				set_msg('Success','Job is updated successfully','success');
				jump(admin_base_url()."classified-list");
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
	else if(isset($_POST['action']) && $_POST['action'] == "update-message")
	{
	    $jobId 		                = $_POST['jobID'];
		$data['job_app_message'] 	= $_POST['msg'];
		where('job_app_id',$jobId);
		if(update($data,'tbl_classified_job_application'))
		{
		    echo "done";
		}
		else
		{
			echo "error";
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
		if(isset($_GET['job_id']) && $_GET['job_id'] != "" && $_GET['job_id'] != null && $_GET['job_id'] > 0 )
		{
			$job_id = $_GET['job_id'];
			where('job_id',$job_id);
			if(delete('tbl_classified_job'))
			{
				set_msg('Success','Job is deleted successfully','success');
				jump(admin_base_url()."classified-list");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."classified-list");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."classified-list");
		}
	}
	else if(isset($_GET['act']) && $_GET['act'] == "appr")
	{
		if(isset($_GET['job_id']) && $_GET['job_id'] != "" && $_GET['job_id'] != null && $_GET['job_id'] > 0 )
		{
			$job_id = $_GET['job_id'];
			$data2['job_status'] = 1;
			where('job_id',$job_id);
			if(update($data2,'tbl_classified_job'))
			{
				set_msg('Success','Job is approved successfully','success');
				jump(admin_base_url()."pending-job-list");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."pending-job-list");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."pending-job-list");
		}
	}
	else if(isset($_GET['act']) && $_GET['act'] == 'app_stat')
    {
        if(isset($_GET['app']) && $_GET['app'] != null && $_GET['app'] != '')
        {
            if(isset($_GET['val']) && $_GET['val'] != null && $_GET['val'] != '')
            {
                $value  = filter_this($_GET['val']);
                $app_id = filter_this($_GET['app']);
                $data['job_app_status'] = $value;
                where('job_app_id',$app_id);
                if(update($data, 'tbl_classified_job_application'))
                {
    				set_msg('Success','Application Status updated successfully','success');
    				jump(admin_base_url()."job-applications");
    			}
    			else
    			{
    				set_msg('Data Error','Unable to process your request. Please try again later.','error');
    				jump(admin_base_url()."job-applications");
    			}
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