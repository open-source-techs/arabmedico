<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_test']))
	{
		$data['testimonial_name'] 		    = post('txt_title');
		$data['testimonial_name_arabic'] 	= $_POST['txt_title_arabic'];
		$data['testimonial_desc'] 		    = $_POST['txt_short_desc'];
		$data['testimonial_desc_arabic'] 	= $_POST['txt_short_desc_arabic'];
		$data['testimonial_user'] 			= post('txt_user');
		if(
			$data['testimonial_name'] 			!= "" && $data['testimonial_name'] 			!= null && 
			$data['testimonial_name_arabic'] 	!= "" && $data['testimonial_name_arabic'] 	!= null && 
			$data['testimonial_desc'] 			!= "" && $data['testimonial_desc'] 	        != null && 
			$data['testimonial_desc_arabic'] 	!= "" && $data['testimonial_desc_arabic'] 	!= null && 
			$data['testimonial_user'] 		    != "" && $data['testimonial_user'] 	        != null
		)
		{
			if(insert($data,'tbl_testimonial'))
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
		$data['testimonial_name'] 		    = post('txt_title');
		$data['testimonial_name_arabic'] 	= $_POST['txt_title_arabic'];
		$data['testimonial_desc'] 		    = $_POST['txt_short_desc'];
		$data['testimonial_desc_arabic'] 	= $_POST['txt_short_desc_arabic'];
		$data['testimonial_user'] 			= post('txt_user');
		$data['testimonial_active'] 		= post('txt_user');
		if(
			$data['testimonial_name'] 			!= "" && $data['testimonial_name'] 			!= null && 
			$data['testimonial_name_arabic'] 	!= "" && $data['testimonial_name_arabic'] 	!= null && 
			$data['testimonial_desc'] 			!= "" && $data['testimonial_desc'] 	        != null && 
			$data['testimonial_desc_arabic'] 	!= "" && $data['testimonial_desc_arabic'] 	!= null && 
			$data['testimonial_user'] 		    != "" && $data['testimonial_user'] 	        != null
		)
		{
		    where('testimonial_id',$testimonial_id);
			if(update($data,'tbl_testimonial'))
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
	else
	{
		jump(admin_base_url());
	}
}
else
{
	jump(admin_base_url());
}