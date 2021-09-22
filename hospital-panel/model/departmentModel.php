<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_service']))
	{
	    $data['dpt_hospital_id']              = post('hospital_id');
		$data['dpt_service_title'] 			= post('txt_cer_name');
	    $data['dpt_service_title_arabic']   = $_POST['arabic_cer_title'];
		$image_name                 	    = upload_image($_FILES,'cer_profile', '../../upload/');
		if($image_name)
		{
		    $data['dpt_service_img'] 		= $image_name;
		}
		else
		{
		    $data['dpt_service_img']  	    = '';
		}
		$data['dpt_service_desc'] 		    = $_POST['txt_short_desc'];
		$data['dpt_service_desc_arabic'] 	= $_POST['txt_short_desc_arabic'];
		if(
			$data['dpt_service_title'] 			!= "" && $data['dpt_service_title'] 		!= null && 
			$data['dpt_service_title_arabic'] 	!= "" && $data['dpt_service_title_arabic'] 	!= null && 
			$data['dpt_service_img'] 			!= "" && $data['dpt_service_img'] 	        != null && 
			$data['dpt_service_desc'] 		    != "" && $data['dpt_service_desc'] 	        != null && 
			$data['dpt_service_desc_arabic'] 	!= "" && $data['dpt_service_desc_arabic'] 	!= null
		)
		{
		    
			if(insert2($data,'tbl_hospital_service'))
			{
			 //   echo "<pre>";
		  //  print_r($data);
		  //  die();
			    $dpt_id = $data['dpt_depart_id'];
				set_msg('Success','Service is added successfully','success');
				jump(admin_base_url()."service-panel");
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
	else if(isset($_POST['btn_edit_service']))
	{
	    $service_id                         = post('dpt_service_id');
	    $data['dpt_hospital_id']              = post('hospital_id');
		$data['dpt_service_title'] 			= post('txt_cer_name');
	    $data['dpt_service_title_arabic']   = $_POST['arabic_cer_title'];
		$image_name                 	    = upload_image($_FILES,'cer_profile', '../../upload/');
		if($image_name)
		{
		    $data['dpt_service_img'] 		= $image_name;
		}
		$data['dpt_service_desc'] 		    = $_POST['txt_short_desc'];
		$data['dpt_service_desc_arabic'] 	= $_POST['txt_short_desc_arabic'];
		if(
			$data['dpt_service_title'] 			!= "" && $data['dpt_service_title'] 		!= null && 
			$data['dpt_service_title_arabic'] 	!= "" && $data['dpt_service_title_arabic'] 	!= null && 
			$data['dpt_service_desc'] 		    != "" && $data['dpt_service_desc'] 	        != null && 
			$data['dpt_service_desc_arabic'] 	!= "" && $data['dpt_service_desc_arabic'] 	!= null
		)
		{
		    where('dpt_service_id',$service_id);
			if(update2($data,'tbl_hospital_service'))
			{
			    $dpt_id = $data['dpt_depart_id'];
				set_msg('Success','Service is updated successfully','success');
				jump(admin_base_url()."service-panel");
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
	if(isset($_GET['act']) && $_GET['act'] == "del-dpt-ser")
	{
		if(isset($_GET['service']) && $_GET['service'] != "" && $_GET['service'] != null && $_GET['service'] > 0 )
		{
			$serviceID = $_GET['service'];
			
			where('dpt_service_id',$serviceID);
			if(delete('tbl_hospital_service'))
			{
				set_msg('Success','Service is deleted successfully','success');
				jump(admin_base_url()."service-panel");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."service-panel");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."service-panel");
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