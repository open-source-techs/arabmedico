<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    
	if(isset($_POST['btn_save_course']))
	{
		$data['course_topic']          	= post('txt_cme_topic');
		$data['course_ar_topic'] 	    = $_POST['ar_cme_topic'];
		$data['course_degree']          = post('txt_cme_degree');
		$data['course_degree_ar'] 	    = $_POST['ar_cme_degree'];
		$data['course_depart'] 			= post('txt_cme_depart');
		$data['course_ar_depart']      	= $_POST['txt_cme_depart_arabic'];
		$data['course_loc'] 			= post('txt_cme_loc');
		$data['course_ar_loc'] 			= $_POST['ar_cme_loc'];
		$data['course_credits'] 		= post('txt_credits');
		$data['course_ar_credits'] 		= $_POST['ar_credits'];
		$data['course_delivery']       	= post('cours_deli');
		$data['course_ar_delivery'] 	= $_POST['cours_deli_ar'];
		$data['course_time']           	= $_POST['txt_time'];
		$data['course_ar_time']        	= changeNumberToArabic($_POST['txt_time']);
		$data['course_date']           	= $_POST['txt_date'];
		$data['course_ar_date']        	= changeNumberToArabic($_POST['txt_date']);
		$data['course_close_date']      = $_POST['closing_date'];
		$data['course_close_date_ar'] 	= changeNumberToArabic($_POST['closing_date']);
		$data['course_duration']       	= post('txt_duration');
		$data['course_ar_duration']    	= $_POST['ar_duration'];
		$data['course_des']            	= $_POST['txt_desc'];
		$data['course_ar_des']         	= $_POST['ar_desc'];
		$data['course_organizer']     	= post('txt_organizer');
		$data['course_meta_title'] 		= post('txt_meta_title');
		$data['course_meta_title_ar'] 	= $_POST['txt_meta_title_ar'];
		$data['course_meta_tag'] 		= post('txt_tag');
		$data['course_meta_tag_ar'] 	= $_POST['txt_tag_ar'];
		$data['course_meta_desc'] 		= post('txt_meta_desc');
		$data['course_meta_desc_ar'] 	= $_POST['txt_meta_desc_ar'];
		$image_name                		= upload_image($_FILES,'txt_cme_icon', '../../upload/');
		if($image_name)
		{
		    $data['course_icon'] 		= $image_name;
		}
		else
		{
		    $data['course_icon']  		= '';
		}

		$slug 							= strtolower(post('txt_slug'));
		if(checkUniqueCol('tbl_url','url_suffex',$slug))
		{
			$data['course_slug'] 		= $slug;
			if(
			    $data['course_topic'] 			!= "" &&    $data['course_topic'] 		    != null &&
				$data['course_depart'] 			!= "" &&    $data['course_depart'] 			!= null &&
				$data['course_loc'] 			!= "" &&    $data['course_loc'] 	    	!= null &&
				$data['course_credits'] 	    != "" &&    $data['course_credits'] 		!= null &&
				$data['course_delivery'] 		!= "" &&    $data['course_delivery'] 		!= null &&
	 			$data['course_time'] 	        != "" &&    $data['course_time'] 	        != null &&
				$data['course_date'] 		    != "" &&    $data['course_date'] 		    != null &&
				$data['course_close_date'] 		!= "" &&    $data['course_close_date'] 		!= null &&
	 			$data['course_duration'] 		!= "" &&    $data['course_duration']       	!= null &&
	 			$data['course_des'] 		    != "" &&    $data['course_des']            	!= null &&
	 			$data['course_ar_topic'] 	    != "" &&    $data['course_ar_topic']       	!= null &&
	 			$data['course_ar_depart'] 		!= "" &&    $data['course_ar_depart'] 		!= null &&
				$data['course_ar_loc'] 			!= "" &&    $data['course_ar_loc'] 			!= null &&
				$data['course_ar_duration'] 	!= "" &&    $data['course_ar_duration']   	!= null &&
				$data['course_ar_time'] 	    != "" &&    $data['course_ar_time'] 		!= null &&
				$data['course_ar_date'] 		!= "" &&    $data['course_ar_date'] 		!= null &&
	 			$data['course_ar_duration'] 	!= "" &&    $data['course_ar_duration'] 	!= null &&
				$data['course_ar_des'] 			!= "" &&    $data['course_ar_des'] 			!= null 
			)
			{
				if(insert2($data,'tbl_course'))
				{
					$URLdata['url_suffex']  = $slug;
    			    $URLdata['url_type']    = 'Course';
    			    insert($URLdata,'tbl_url');
					set_msg('Success','Course is added successfully','success');
					jump(admin_base_url()."list-course");
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
	else if(isset($_POST['btn_edit_course']))
	{
	    $cme_id 						= $_POST['txt_cme_id'];
	   	$data['course_topic']          	= post('txt_cme_topic');
		$data['course_ar_topic'] 	    = $_POST['ar_cme_topic'];
		$data['course_degree']          = post('txt_cme_degree');
		$data['course_degree_ar'] 	    = $_POST['ar_cme_degree'];
		$data['course_depart'] 			= post('txt_cme_depart');
		$data['course_ar_depart']      	= $_POST['txt_cme_depart_arabic'];
		$data['course_loc'] 			= post('txt_cme_loc');
		$data['course_ar_loc'] 			= $_POST['ar_cme_loc'];
		$data['course_credits'] 		= post('txt_credits');
		$data['course_ar_credits'] 		= $_POST['ar_credits'];
		$data['course_delivery']       	= post('cours_deli');
		$data['course_ar_delivery'] 	= $_POST['cours_deli_ar'];
		$data['course_time']           	= $_POST['txt_time'];
		$data['course_ar_time']        	= changeNumberToArabic($_POST['txt_time']);
		$data['course_date']           	= $_POST['txt_date'];
		$data['course_ar_date']        	= changeNumberToArabic($_POST['txt_date']);
		$data['course_close_date']      = $_POST['closing_date'];
		$data['course_close_date_ar'] 	= changeNumberToArabic($_POST['closing_date']);
		$data['course_duration']       	= post('txt_duration');
		$data['course_ar_duration']    	= $_POST['ar_duration'];
		$data['course_des']            	= $_POST['txt_desc'];
		$data['course_ar_des']         	= $_POST['ar_desc'];
		$data['course_organizer']     	= post('txt_organizer');
		$data['course_meta_title'] 		= post('txt_meta_title');
		$data['course_meta_title_ar'] 	= $_POST['txt_meta_title_ar'];
		$data['course_meta_tag'] 		= post('txt_tag');
		$data['course_meta_tag_ar'] 	= $_POST['txt_tag_ar'];
		$data['course_meta_desc'] 		= post('txt_meta_desc');
		$data['course_meta_desc_ar'] 	= $_POST['txt_meta_desc_ar'];
		$image_name                		= upload_image($_FILES,'txt_cme_icon', '../../upload/');
		if($image_name)
		{
		    $data['course_icon']       	= $image_name;
		}
		$previousSlug               	= post('previous_slug');
        $currentSlug                	= post('txt_dpt_url');
        $slugUpdate                 	= false;
        if($previousSlug != $currentSlug)
        {
            if(checkUniqueCol('tbl_url','url_suffex',$currentSlug, true, 'url_suffex', $previousSlug ))
    		{
            	$slugUpdate         	= true;
    		    $data['course_slug']   	= $currentSlug;
    		}
        }
		if(
		    $data['course_topic'] 			!= "" &&    $data['course_topic'] 		    != null &&
			$data['course_depart'] 			!= "" &&    $data['course_depart'] 			!= null &&
			$data['course_loc'] 			!= "" &&    $data['course_loc'] 	    	!= null &&
			$data['course_credits'] 	    != "" &&    $data['course_credits'] 		!= null &&
			$data['course_delivery'] 		!= "" &&    $data['course_delivery'] 		!= null &&
 			$data['course_time'] 	        != "" &&    $data['course_time'] 	        != null &&
			$data['course_date'] 		    != "" &&    $data['course_date'] 		    != null &&
			$data['course_close_date'] 		!= "" &&    $data['course_close_date'] 		!= null &&
 			$data['course_duration'] 		!= "" &&    $data['course_duration']       	!= null &&
 			$data['course_des'] 		    != "" &&    $data['course_des']            	!= null &&
 			$data['course_ar_topic'] 	    != "" &&    $data['course_ar_topic']       	!= null &&
 			$data['course_ar_depart'] 		!= "" &&    $data['course_ar_depart'] 		!= null &&
			$data['course_ar_loc'] 			!= "" &&    $data['course_ar_loc'] 			!= null &&
			$data['course_ar_duration'] 	!= "" &&    $data['course_ar_duration']   	!= null &&
			$data['course_ar_time'] 	    != "" &&    $data['course_ar_time'] 		!= null &&
			$data['course_ar_date'] 		!= "" &&    $data['course_ar_date'] 		!= null &&
 			$data['course_ar_duration'] 	!= "" &&    $data['course_ar_duration'] 	!= null &&
			$data['course_ar_des'] 			!= "" &&    $data['course_ar_des'] 			!= null  
		)
		{
			where('course_id',$cme_id);
			if(update2($data,'tbl_course'))
			{
				if($slugUpdate)
			    {
			        $URLdata['url_suffex']  = $currentSlug;
    			    $URLdata['url_type']    = 'Course';
    			    where('url_suffex',$previousSlug);
    			    update($URLdata,'tbl_url');
			    }
				set_msg('Success','Course is updated successfully','success');
				jump(admin_base_url()."list-course");
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
		jump(admin_base_url());
	}
}
else if($_SERVER['REQUEST_METHOD'] == "GET")
{
	if(isset($_GET['act']) && $_GET['act'] == "del")
	{
		if(isset($_GET['course_id']) && $_GET['course_id'] != "" && $_GET['course_id'] != null && $_GET['course_id'] > 0 )
		{
			$cme_id = $_GET['course_id'];
			where('course_id',$cme_id);
			if(delete('tbl_course'))
			{
				set_msg('Success','Course is deleted successfully','success');
				jump(admin_base_url()."list-course");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."list-course");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."list-course");
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
                $data['cme_app_status'] = $value;
                where('cme_app_id',$app_id);
                if(update($data, 'tbl_cme_application'))
                {
    				set_msg('Success','Registraion Status updated successfully','success');
    				jump(admin_base_url()."cme-registrations");
    			}
    			else
    			{
    				set_msg('Data Error','Unable to process your request. Please try again later.','error');
    				jump(admin_base_url()."cme-registrations");
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