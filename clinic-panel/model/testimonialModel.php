<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_test']))
	{
		$data['testimonial_title'] 		    = post('txt_title');
		$data['testimonial_title_arabic'] 	= $_POST['txt_title_ar'];
		$data['testimonial_username'] 		= post('txt_username');
		$data['testimonial_username_ar'] 	= $_POST['txt_username_ar'];
		$data['testimonial_desc'] 		    = $_POST['txt_short_desc'];
		$data['testimonial_desc_arabic'] 	= $_POST['txt_short_desc_arabic'];
		$data['testimonial_clinic'] 	    = post('txt_clinicID');
		$image_name                 		= upload_image($_FILES,'patient_img', '../../upload/');
		if($image_name)
		{
		    $data['testimonial_image'] 	= $image_name;
		}
		else
		{
		    $data['testimonial_image']  = '';
		}
		if(
			$data['testimonial_title'] 			!= "" && $data['testimonial_title'] 		!= null && 
			$data['testimonial_title_arabic'] 	!= "" && $data['testimonial_title_arabic'] 	!= null && 
			$data['testimonial_username'] 		!= "" && $data['testimonial_username'] 	    != null && 
			$data['testimonial_username_ar'] 	!= "" && $data['testimonial_username_ar'] 	!= null && 
			$data['testimonial_desc'] 			!= "" && $data['testimonial_desc'] 	        != null && 
			$data['testimonial_desc_arabic'] 	!= "" && $data['testimonial_desc_arabic'] 	!= null && 
			$data['testimonial_image'] 			!= "" && $data['testimonial_image'] 	    != null
		)
		{
			if(insert($data,'tbl_clinic_testimonial'))
			{
				set_msg('Success','Testimonial is added successfully','success');
				jump(admin_base_url()."all-testimonial");
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
	else if(isset($_POST['btn_edit_test']))
	{
		$testimonial_id 					= post('txt_test_id'); 
		$data['testimonial_title'] 		    = post('txt_title');
		$data['testimonial_title_arabic'] 	= $_POST['txt_title_ar'];
		$data['testimonial_username'] 		= post('txt_username');
		$data['testimonial_username_ar'] 	= $_POST['txt_username_ar'];
		$data['testimonial_desc'] 		    = $_POST['txt_short_desc'];
		$data['testimonial_desc_arabic'] 	= $_POST['txt_short_desc_arabic'];
		$data['testimonial_clinic'] 	    = post('txt_clinicID');
		if(
			$data['testimonial_title'] 			!= "" && $data['testimonial_title'] 			!= null && 
			$data['testimonial_title_arabic'] 	!= "" && $data['testimonial_title_arabic'] 	!= null && 
			$data['testimonial_desc'] 			!= "" && $data['testimonial_desc'] 	        != null && 
			$data['testimonial_desc_arabic'] 	!= "" && $data['testimonial_desc_arabic'] 	!= null && 
			$data['testimonial_clinic'] 		!= "" && $data['testimonial_clinic'] 	        != null
		)
		{
		    where('testimonial_id',$testimonial_id);
			if(update($data,'tbl_clinic_testimonial'))
			{
				set_msg('Success','Testimonial is added successfully','success');
				jump(admin_base_url()."all-testimonial");
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
		jump(admin_base_url());
	}
}
else if($_SERVER['REQUEST_METHOD'] == "GET")
{
	if(isset($_GET['act']) && $_GET['act'] == "del")
	{
		if(isset($_GET['tid']) && $_GET['tid'] != "" && $_GET['tid'] != null && $_GET['tid'] > 0 )
		{
			$tid = $_GET['tid'];
			where('testimonial_id',$tid);
			if(delete('tbl_clinic_testimonial'))
			{
				set_msg('Success','Department is deleted successfully','success');
				jump(admin_base_url()."all-testimonial");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."all-testimonial");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."all-testimonial");
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