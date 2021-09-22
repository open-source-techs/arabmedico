<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_specialty']))
	{
		$data['specialty_name'] 		= post('specialty_name');
		$data['specialty_ar_name'] 	    = $_POST['specialty_name_ar'];
		$data['specialty_status'] 		= $_POST['select_status'];
		$data['speciality_hospital'] 	= get_sess("userdata")['hospital_id'];
		$image_name                 	= upload_image($_FILES,'specialty_icon', '../../upload/');
		if($image_name)
		{
		    $data['speciality_icon'] 		= $image_name;
		}
		else
		{
		    $data['speciality_icon']  	= '';
		}
		if(
			$data['specialty_name'] 	!= "" && $data['specialty_name'] 	!= null && 
			$data['specialty_ar_name'] 	!= "" && $data['specialty_ar_name'] != null && 
			$data['speciality_icon'] 	!= "" && $data['speciality_icon'] 	!= null && 
    		$data['specialty_status'] 	!= "" && $data['specialty_status'] 	!= null
		)
		{
			if(insert($data,'tbl_hostpital_specialty'))
			{
				set_msg('Success','Specialty is added successfully','success');
				jump(admin_base_url()."specialties");
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
	else if(isset($_POST['btn_edit_specialty']))
	{
	    $specialty_id               = post('specialty_id');
		$data['specialty_name'] 	= post('specialty_name');
		$data['specialty_ar_name'] 	= $_POST['specialty_name_ar'];
		$data['speciality_hospital'] 	= get_sess("userdata")['hospital_id'];
		$data['specialty_status'] 	= $_POST['select_status'];
        $image_name                 = upload_image($_FILES,'specialty_icon', '../../upload/');
		if($image_name)
		{
		    $data['speciality_icon'] 		= $image_name;
		}
	    where('specialty_id',$specialty_id);
		if(update2($data,'tbl_hostpital_specialty'))
		{
			set_msg('Success','Specialty is updated successfully','success');
			jump(admin_base_url()."specialties");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
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
	if(isset($_GET['act_specialty']) && $_GET['act_specialty'] == "del")
	{
		if(isset($_GET['specialty_id']) && $_GET['specialty_id'] != "" && $_GET['specialty_id'] != null && $_GET['specialty_id'] > 0 )
		{
			$specialty = $_GET['specialty_id'];
			where('specialty_id',$specialty);
			if(delete('tbl_hostpital_specialty'))
			{
				set_msg('Success','specialty is deleted successfully','success');
				jump(admin_base_url()."specialties");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."specialties");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."specialties");
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