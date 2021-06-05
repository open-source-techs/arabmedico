<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_add_new']))
	{
		$data['add_location'] 		= post('txt_displayLocation');
		$data['add_activationDate'] = post('txt_activeDate');
		$data['add_displayTime'] 	= post('txt_durationDays');
		$data['add_media'] 		    = post('txt_type');
		$data['add_clickLink'] 	    = $_POST['txt_link'];
		$data['add_is_horizontal'] 	= post('txt_is_horizontal');
		if($data['add_media'] == "poster")
		{
		    $image_name             = upload_image($_FILES,'txt_poster', '../../upload/');
    		if($image_name)
    		{
    		    $data['add_image'] 	= $image_name;
    		}
    		else
    		{
    		    $data['add_image']  = '';
    		}
    		$image_name1             = upload_image($_FILES,'txt_poster_ar', '../../upload/');
    		if($image_name1)
    		{
    		    $data['add_image_ar'] 	= $image_name1;
    		}
    		else
    		{
    		    $data['add_image_ar']  = '';
    		}
		}
		else
		{
		    $data['add_is_link'] 		= post('txt_emp_number');
		    if($data['add_is_link'] == 0)
		    {
		        $data['add_video'] 		= $_POST['txt_video_link'];
		        $data['add_video_ar'] 	= $_POST['txt_video_link_ar'];
		    }
		    else
		    {
		        $image_name             = upload_image($_FILES,'add_video_ar', '../../upload/');
        		if($image_name)
        		{
        		    $data['add_video'] 	= $image_name;
        		}
        		else
        		{
        		    $data['add_video']  = '';
        		}
        		$image_name1             = upload_image($_FILES,'txt_video_ar', '../../upload/');
        		if($image_name1)
        		{
        		    $data['add_video_ar'] 	= $image_name1;
        		}
        		else
        		{
        		    $data['add_video_ar']  = '';
        		}
		    }
		}
		if(
			$data['add_location'] 		!= "" && $data['add_location'] 		    != null &&
			$data['add_activationDate'] != "" && $data['add_activationDate'] 	!= null &&
			$data['add_displayTime'] 	!= "" && $data['add_displayTime'] 	    != null &&
			$data['add_media'] 	        != "" && $data['add_media']             != null
		)
		{
			if(insert2($data,'tbl_advertisment'))
			{
				set_msg('Success','Advertisement is added successfully','success');
				jump(admin_base_url()."all-advertisement");
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
	else if(isset($_POST['btn_edit_emp']))
	{
 		$emp_id 					= post('txt_emp_id');
		$data['emp_name'] 			= post('txt_emp_name');
		$data['emp_name_ar'] 		= $_POST['txt_emp_name_ar'];
		$data['emp_number'] 		= post('txt_emp_number');
		$data['emp_number_ar'] 		= changeNumberToArabic($data['emp_number']);
		$data['emp_url'] 			= post('txt_emp_url');
		$data['emp_copEmail'] 		= post('txt_corporate_email');
		$data['emp_location'] 		= post('txt_location');
		$data['emp_location_ar'] 	= $_POST['txt_location'];
		$data['emp_serviceType'] 	= post('txt_serviceType');
		$data['emp_serviceType_ar'] = $_POST['txt_serviceType'];
		$data['emp_personName'] 	= post('txt_c_person');
		$data['emp_cellNum'] 		= post('txt_c_number');
		$data['emp_perEmail'] 		= post('txt_c_email');
		$data['emp_comPos'] 		= post('txt_c_position');
		$image_name                 = upload_image($_FILES,'txt_icon', '../../upload/');
		if($image_name)
		{
		    $data['emp_logo'] 	= $image_name;
		}

		if(
			$data['emp_name'] 		!= "" && $data['emp_name'] 		!= null &&
			$data['emp_name_ar'] 	!= "" && $data['emp_name_ar'] 	!= null &&
			$data['emp_number'] 	!= "" && $data['emp_number'] 	!= null &&
			$data['emp_number_ar'] 	!= "" && $data['emp_number_ar'] != null &&
			$data['emp_url'] 	    != "" && $data['emp_url'] 	    != null
		)
		{
		    where('emp_id',$emp_id);
			if(update($data,'tbl_employer'))
			{
				set_msg('Success','Employeer is updated successfully','success');
				jump(admin_base_url()."all-advertisement");
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
		jump(admin_base_url());
	}
}
else if($_SERVER['REQUEST_METHOD'] == "GET")
{
	if(isset($_GET['act_employee']) && $_GET['act_employee'] == "del")
	{
		if(isset($_GET['add_id']) && $_GET['add_id'] != "" && $_GET['add_id'] != null && $_GET['add_id'] > 0 )
		{
			$add_id = $_GET['add_id'];
			where('add_id',$add_id);
			if(delete('tbl_advertisment'))
			{
				set_msg('Success','Advertisement is deleted successfully','success');
				jump(admin_base_url()."all-advertisement");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."all-advertisement");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."all-advertisement");
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