<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_service']))
	{
	    $data['org_id']             = post('org_id');
		$data['org_serv_title'] 	= post('txt_cer_name');
	    $data['org_serv_title_ar']  = $_POST['arabic_cer_title'];
		$image_name                 = upload_image($_FILES,'cer_profile', '../../upload/');
		if($image_name)
		{
		    $data['org_serv_img'] 	= $image_name;
		}
		else
		{
		    $data['org_serv_img']  	= '';
		}
		$data['org_serv_desc'] 		= $_POST['txt_short_desc'];
		$data['org_serv_desc_ar']	= $_POST['txt_short_desc_arabic'];
		if(
			$data['org_serv_title'] 	!= "" && $data['org_serv_title'] 		!= null && 
			$data['org_serv_title_ar'] 	!= "" && $data['org_serv_title_ar'] 	!= null && 
			$data['org_serv_img'] 		!= "" && $data['org_serv_img'] 	        != null && 
			$data['org_serv_desc'] 		!= "" && $data['org_serv_desc'] 	    != null && 
			$data['org_serv_desc_ar'] 	!= "" && $data['org_serv_desc_ar'] 		!= null
		)
		{
		    
			if(insert2($data,'tbl_org_services'))
			{
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
	    $serviceID                 	= post('dpt_service_id');
	    $data['org_id']             = post('org_id');
		$data['org_serv_title'] 	= post('txt_cer_name');
	    $data['org_serv_title_ar']  = $_POST['arabic_cer_title'];
		$image_name                 = upload_image($_FILES,'cer_profile', '../../upload/');
		if($image_name)
		{
		    $data['org_serv_img'] 	= $image_name;
		}
		$data['org_serv_desc'] 		= $_POST['txt_short_desc'];
		$data['org_serv_desc_ar']	= $_POST['txt_short_desc_arabic'];
		if(
			$data['org_serv_title'] 	!= "" && $data['org_serv_title'] 		!= null && 
			$data['org_serv_title_ar'] 	!= "" && $data['org_serv_title_ar'] 	!= null &&  
			$data['org_serv_desc'] 		!= "" && $data['org_serv_desc'] 	    != null && 
			$data['org_serv_desc_ar'] 	!= "" && $data['org_serv_desc_ar'] 		!= null
		)
		{
		    where('org_service_id',$serviceID);
			if(update($data,'tbl_org_services'))
			{
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
			
			where('org_service_id',$serviceID);
			if(delete('tbl_org_services'))
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