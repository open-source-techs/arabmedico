<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_cer']))
	{
		$data['insurance_title'] 			= post('txt_insurance_name');
		$data['insurance_title_arabic'] 	= $_POST['arabic_insurance_title'];
		$data['insurance_hospital'] 			= post('txt_hospitalID');
		$image_name                 		= upload_image($_FILES,'insurance_profile', '../../upload/');
		if($image_name)
		{
		    $data['insurance_image'] 	= $image_name;
		}
		else
		{
		    $data['insurance_image']  = '';
		}

		if(
			$data['insurance_title'] 		!= "" && $data['insurance_title'] 		 != null &&
			$data['insurance_title_arabic'] != "" && $data['insurance_title_arabic'] != null &&
			$data['insurance_image'] 		!= "" && $data['insurance_image'] 		 != null
			
		)
		{
			if(insert($data,'tbl_hospital_insurance'))
			{
				set_msg('Success','Insurance is added successfully','success');
				jump(admin_base_url()."all-insurance.php");
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
	else if(isset($_POST['btn_edit_cer']))
	{
 		$insurancId						    = post('txt_insurance_id');
		$data['insurance_title'] 			= post('txt_insurance_name');
		$data['insurance_title_arabic'] 	= $_POST['txt_insurance_title_arabic'];
		$data['insurance_hospital'] 			= post('txt_hospitalID');
		$image_name                 		= upload_image($_FILES,'txt_icon', '../../upload/');
		if($image_name)
		{
		    $data['insurance_image'] 				= $image_name;
		}
        
		if(
			$data['insurance_title'] 		!= "" && $data['insurance_title'] 	        != null &&
			$data['insurance_title_arabic'] != "" && $data['insurance_title_arabic']    != null
		)
		{
			where('insurance_id ',$insurancId);
			if(update($data,'tbl_hospital_insurance'))
			{
				set_msg('Success','insurance is updated successfully','success');
				jump(admin_base_url()."all-insurance");
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
		if(isset($_GET['insurance_id']) && $_GET['insurance_id'] != "" && $_GET['insurance_id'] != null && $_GET['insurance_id'] > 0 )
		{
			$insurance_id = $_GET['insurance_id'];
			where('insurance_id',$insurance_id);
			if(delete('tbl_hospital_insurance'))
			{
				set_msg('Success','insurance is deleted successfully','success');
				jump(admin_base_url()."all-insurance");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."all-insurance");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."all-insurance");
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