<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_cer']))
	{
	    $data['award_org']       = post('txt_orgID');
		$data['award_title'] 	 = post('txt_title');
		$data['award_title_ar']  = $_POST['txt_title_ar'];
		$image_name              = upload_image($_FILES,'txt_image', '../../upload/');
		if($image_name)
		{
		    $data['award_image'] = $image_name;
		}
		else
		{
		    $data['award_image'] = '';
		}
		if(
			$data['award_title'] 	!= "" && $data['award_title'] 	 != null &&
			$data['award_title_ar'] != "" && $data['award_title_ar'] != null &&
			$data['award_image'] 	!= "" && $data['award_image'] 	 != null
			
		)
		{
			if(insert2($data,'tbl_org_awards'))
			{
				set_msg('Success','Award is added successfully','success');
				jump(admin_base_url()."all-award");
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
 		$awardID 				 = post('txt_id');
 		$data['award_org']       = post('txt_orgID');
		$data['award_title'] 	 = post('txt_title');
		$data['award_title_ar']  = $_POST['txt_title_ar'];
		$image_name              = upload_image($_FILES,'txt_image', '../../upload/');
		if($image_name)
		{
		    $data['award_image'] 				= $image_name;
		}
		if(
			$data['award_title'] 	!= "" && $data['award_title'] 	  != null &&
			$data['award_title_ar'] != "" && $data['award_title_ar']  != null
		)
		{
			where('award_id ',$awardID);
			if(update2($data,'tbl_org_awards'))
			{
				set_msg('Success','Award is updated successfully','success');
				jump(admin_base_url()."all-award");
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
		if(isset($_GET['award_id']) && $_GET['award_id'] != "" && $_GET['award_id'] != null && $_GET['award_id'] > 0 )
		{
			$awardID = $_GET['award_id'];
			where('award_id ',$awardID);
			if(delete('tbl_org_awards'))
			{
				set_msg('Success','Certificate is deleted successfully','success');
				jump(admin_base_url()."all-award");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."all-award");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."all-award");
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