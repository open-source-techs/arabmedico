<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_cer']))
	{
		$data['certificate_title'] 					= post('txt_cer_name');
		$data['certificate_title_arabic'] 		    = post('arabic_cer_title');
		$image_name                 		= upload_image($_FILES,'cer_profile', '../../upload/');
		if($image_name)
		{
		    $data['cetificate_image'] 	= $image_name;
		}
		else
		{
		    $data['cetificate_image']  = '';
		}

		if(
			$data['certificate_title'] 					!= "" && $data['certificate_title'] 					!= null &&
			$data['certificate_title_arabic'] 			!= "" && $data['certificate_title_arabic'] 				!= null &&
			$data['cetificate_image'] 					!= "" && $data['cetificate_image'] 					!= null
			
		)
		{
			if(insert($data,'tbl_certificate'))
			{
				set_msg('Success','Certificate is added successfully','success');
				jump(admin_base_url()."all-certificates.php");
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
 		$cer_id 							= post('txt_cer_id');
		$data['certificate_title'] 			= post('txt_cer_name');
		$data['certificate_title_arabic'] 	= $_POST['txt_cer_title_arabic'];
		$image_name                 		= upload_image($_FILES,'txt_icon', '../../upload/');
		if($image_name)
		{
		    $data['cetificate_image'] 				= $image_name;
		}
        // echo "<pre>";
        // print_r($data);
        // die();
		if(
			$data['certificate_title'] 			!= "" && $data['certificate_title'] 	    != null &&
			$data['certificate_title_arabic'] 	!= "" && $data['certificate_title_arabic']  != null
		)
		{
			where('certificate_id ',$cer_id);
			if(update($data,'tbl_certificate'))
			{
				set_msg('Success','Certificate is updated successfully','success');
				jump(admin_base_url()."all-certificates");
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
		if(isset($_GET['certificate_id']) && $_GET['certificate_id'] != "" && $_GET['certificate_id'] != null && $_GET['certificate_id'] > 0 )
		{
			$cer_id = $_GET['certificate_id'];
			where('certificate_id',$cer_id);
			if(delete('tbl_certificate'))
			{
				set_msg('Success','Certificate is deleted successfully','success');
				jump(admin_base_url()."all-certificates");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."all-certificates");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."all-certificates");
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