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
		$data['job_depart']         = post('txt_job_depart');
		$data['job_depart_ar']      = $_POST['txt_job_depart_arabic'];
		$data['job_close_date']     = post('txt_closing_time');
		$data['job_close_date_ar'] 	= changeNumberToArabic($data['job_close_date']);
		$data['job_employeer']      = post('txt_employeer');
		$data['job_meta_title'] 	= post('txt_meta_title');
		$data['job_meta_title_ar'] 	= $_POST['txt_meta_title_ar'];
		$data['job_meta_tag'] 		= post('txt_tag');
		$data['job_meta_tag_ar'] 	= $_POST['txt_tag_ar'];
		$data['job_meta_desc'] 		= post('txt_meta_desc');
		$data['job_meta_desc_ar'] 	= $_POST['txt_meta_desc_ar'];
		$image_name                	= upload_image($_FILES,'txt_job_icon', '../../upload/');
		if($image_name)
		{
		    $data['job_icon'] 	= $image_name;
		}
		else
		{
		    $data['job_icon']  = '';
		}
 		$slug 						= strtolower(post('txt_slug'));
 		if(checkUniqueCol('tbl_url','url_suffex',$slug))
		{
			$data['job_slug'] = $slug;
			if(
			    $data['job_title'] 			!= "" && $data['job_title'] 		!= null &&
				$data['job_title_ar'] 		!= "" && $data['job_title_ar'] 		!= null &&
				$data['job_desc'] 			!= "" && $data['job_desc'] 	    	!= null &&
				$data['job_desc_ar'] 	    != "" && $data['job_desc_ar'] 		!= null &&
				$data['job_location'] 		!= "" && $data['job_location'] 		!= null &&
	 			$data['job_location_ar'] 	!= "" && $data['job_location_ar'] 	!= null &&
				$data['job_depart'] 		!= "" && $data['job_depart'] 		!= null &&
	 			$data['job_depart_ar'] 		!= "" && $data['job_depart_ar']     != null &&
	 			$data['job_icon'] 		    != "" && $data['job_icon']          != null &&
	 			$data['job_close_date'] 	!= "" && $data['job_close_date']    != null
			)
			{
				$jobId = get_next_table_id('tbl_job');
				if(insert2($data,'tbl_job'))
				{
					$URLdata['url_suffex']  = $slug;
    			    $URLdata['url_type']    = 'Job';
    			    insert($URLdata,'tbl_url');

    			    $jobTitle 		= $data['job_title'];
    			    $jobLocation 	= $data['job_location'];
    			    $jobdep_spec 	= $data['job_depart'];
    			    $sqlprofessional = query("SELECT sub_user FROM tbl_job_notify_sub ns JOIN tbl_candidate c ON (ns.sub_user = c.candidate_id) WHERE sub_userType = 'professional' AND (sub_type = 'job_title' OR sub_type = 'speciality' OR sub_type = 'location') AND (sub_value LIKE '%".$jobTitle."%' OR sub_value LIKE '%".$jobLocation."%' OR sub_value LIKE '%".$jobLocation."%') AND c.candidate_notifcations = 1 GROUP BY sub_user");
    			    While($notifyData = fetch($sqlprofessional))
    			    {
    			    	$notify['notify_job_id'] 		= $jobId;
    			    	$notify['notify_speciality'] 	= $jobdep_spec;
    			    	$notify['notify_job_location'] 	= $jobLocation;
    			    	$notify['notify_job_title'] 	= $jobTitle;
    			    	$notify['notify_user'] 			= $notifyData['sub_user'];
    			    	$notify['notify_user_type'] 	= 'professional';
    			    	insert2($notify,'tbl_job_notifications');
    			    }

    			    $sqlprofessional = query("SELECT sub_user FROM tbl_job_notify_sub ns JOIN tbl_doctor d ON (ns.sub_user = d.doc_id) WHERE sub_userType = 'doctor' AND (sub_type = 'job_title' OR sub_type = 'speciality' OR sub_type = 'location') AND (sub_value LIKE '%".$jobTitle."%' OR sub_value LIKE '%".$jobLocation."%' OR sub_value LIKE '%".$jobLocation."%') AND d.doctor_notification = 1 GROUP BY sub_user");
    			    While($notifyData = fetch($sqlprofessional))
    			    {
    			    	$notify['notify_job_id'] 		= $jobId;
    			    	$notify['notify_speciality'] 	= $jobdep_spec;
    			    	$notify['notify_job_location'] 	= $jobLocation;
    			    	$notify['notify_job_title'] 	= $jobTitle;
    			    	$notify['notify_user'] 			= $notifyData['sub_user'];
    			    	$notify['notify_user_type'] 	= 'doctor';
    			    	insert2($notify,'tbl_job_notifications');
    			    }
					set_msg('Success','Job is added successfully','success');
					jump(admin_base_url()."job-list");
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
	else if(isset($_POST['btn_edit_job']))
	{
	    $job_id 					= post('txt_job_id');
	    $data['job_title']          = post('txt_job_title');
		$data['job_title_ar'] 		= $_POST['ar_job_title'];
		$data['job_desc'] 			= $_POST['txt_desc'];
		$data['job_desc_ar'] 		= $_POST['ar_desc'];
		$data['job_location']       = post('txt_job_loc');
		$data['job_location_ar']    = $_POST['ar_job_loc'];
		$data['job_depart']         = post('txt_job_depart');
		$data['job_depart_ar']      = $_POST['txt_job_depart_arabic'];
		$data['job_close_date']     = post('txt_closing_time');
		$data['job_close_date_ar'] 	= changeNumberToArabic($data['job_close_date']);
		$data['job_employeer']      = post('txt_employeer');
		$data['job_meta_title'] 	= post('txt_meta_title');
		$data['job_meta_title_ar'] 	= $_POST['txt_meta_title_ar'];
		$data['job_meta_tag'] 		= post('txt_tag');
		$data['job_meta_tag_ar'] 	= $_POST['txt_tag_ar'];
		$data['job_meta_desc'] 		= post('txt_meta_desc');
		$data['job_meta_desc_ar'] 	= $_POST['txt_meta_desc_ar'];
		$image_name                	= upload_image($_FILES,'txt_job_icon', '../../upload/');
		if($image_name)
		{
		    $data['job_icon']         = $image_name;
		}
		$previousSlug                   		= post('previous_slug');
        $currentSlug                    		= post('txt_dpt_url');
        $slugUpdate                     		= false;
        if($previousSlug != $currentSlug)
        {
            if(checkUniqueCol('tbl_url','url_suffex',$currentSlug, true, 'url_suffex', $previousSlug ))
    		{
            	$slugUpdate                 	= true;
    		    $data['job_slug']    			= $currentSlug;
    		}
        }
		if(
		    
			$data['job_title'] 			!= "" && $data['job_title'] 		!= null &&
			$data['job_title_ar'] 		!= "" && $data['job_title_ar'] 		!= null &&
			$data['job_desc'] 			!= "" && $data['job_desc'] 	    	!= null &&
			$data['job_desc_ar'] 	    != "" && $data['job_desc_ar'] 		!= null &&
			$data['job_location'] 		!= "" && $data['job_location'] 		!= null &&
 			$data['job_location_ar'] 	!= "" && $data['job_location_ar'] 	!= null &&
			$data['job_depart'] 		!= "" && $data['job_depart'] 		!= null &&
			$data['job_depart_ar'] 		!= "" && $data['job_depart_ar'] 	!= null &&
 			$data['job_close_date'] 	!= "" && $data['job_close_date'] 	!= null &&
			$data['job_close_date_ar'] 	!= "" && $data['job_close_date_ar'] != null
		)
		{
			where('job_id',$job_id);
			if(update2($data,'tbl_job'))
			{
				if($slugUpdate)
			    {
			        $URLdata['url_suffex']  = $currentSlug;
    			    $URLdata['url_type']    = 'Job';
    			    where('url_suffex',$previousSlug);
    			    update($URLdata,'tbl_url');
			    }
				set_msg('Success','Job is updated successfully','success');
				jump(admin_base_url()."job-list");
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
		if(update($data,'tbl_job_application'))
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
			if(delete('tbl_job'))
			{
				set_msg('Success','Job is deleted successfully','success');
				jump(admin_base_url()."job-list");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."job-list");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."job-list");
		}
	}
	else if(isset($_GET['act']) && $_GET['act'] == "appr")
	{
		if(isset($_GET['job_id']) && $_GET['job_id'] != "" && $_GET['job_id'] != null && $_GET['job_id'] > 0 )
		{
			$job_id = $_GET['job_id'];
			$data2['job_status'] = 1;
			where('job_id',$job_id);
			if(update($data2,'tbl_job'))
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
                if(update($data, 'tbl_job_application'))
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