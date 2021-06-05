<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_org']))
	{
		$data['org_name'] 			= post('txt_org_name');
		$data['org_name_ar'] 		= $_POST['txt_org_name_ar'];
		$data['org_contactNo'] 		= post('txt_org_number');
		$data['org_contactNo_ar'] 	= changeNumberToArabic($data['org_contactNo']);
		$data['org_email'] 			= post('txt_org_email');
		$data['org_username'] 		= post('txt_org_username');
		$data['org_password'] 		= encrypt(post('txt_org_password'));
		$usernameCheck 	            = checkUniqueCol('tbl_organizer','org_username',$data['org_username']);
		if($usernameCheck['count'] > 0)
		{
			set_msg('Insertion error','Username already exist. Please try another.','error');
    		echo "<script>window.history.go(-1);</script>";
		}
		else
		{
		    $image_name                 = upload_image($_FILES,'txt_icon', '../../upload/');
    		if($image_name)
    		{
    		    $data['org_icon'] 	= $image_name;
    		}
    		else
    		{
    		    $data['org_icon']  = '';
    		}
    
    		if(
    			$data['org_name'] 		    != "" && $data['org_name'] 		    != null &&
    			$data['org_name_ar'] 	    != "" && $data['org_name_ar'] 	    != null &&
    			$data['org_contactNo'] 	    != "" && $data['org_contactNo'] 	!= null &&
    			$data['org_contactNo_ar'] 	!= "" && $data['org_contactNo_ar']  != null &&
    			$data['org_email'] 	        != "" && $data['org_email'] 	    != null &&
    			$data['org_username'] 	    != "" && $data['org_username'] 	    != null &&
    			$data['org_password'] 	    != "" && $data['org_password'] 	    != null
    		)
    		{
    			if(insert($data,'tbl_organizer'))
    			{
    				set_msg('Success','Organizer is added successfully','success');
    				jump(admin_base_url()."list-organizer");
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
	}
	else if(isset($_POST['btn_edit_org']))
	{
	    $orgID                      = post('txt_org_id');
 		$data['org_name'] 			= post('txt_org_name');
		$data['org_name_ar'] 		= $_POST['txt_org_name_ar'];
		$data['org_contactNo'] 		= post('txt_org_number');
		$data['org_contactNo_ar'] 	= changeNumberToArabic($data['org_contactNo']);
		$data['org_email'] 			= post('txt_org_email');
		$data['org_username'] 		= post('txt_org_username');
		$data['org_status'] 		= post('txt_status');
		$image_name                 = upload_image($_FILES,'txt_icon', '../../upload/');
		if($image_name)
		{
		    $data['org_icon'] 	= $image_name;
		}

		if(
			$data['org_name'] 		    != "" && $data['org_name'] 		    != null &&
			$data['org_name_ar'] 	    != "" && $data['org_name_ar'] 	    != null &&
			$data['org_contactNo'] 	    != "" && $data['org_contactNo'] 	!= null &&
			$data['org_contactNo_ar'] 	!= "" && $data['org_contactNo_ar']  != null &&
			$data['org_email'] 	        != "" && $data['org_email'] 	    != null
		)
		{
		    where('org_id',$orgID);
			if(update($data,'tbl_organizer'))
			{
				set_msg('Success','Organizer is updated successfully','success');
				jump(admin_base_url()."list-organizer");
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
	else if(isset($_POST['btn_edit_credentail']))
	{
	    $org_id     = post('txt_org_id');
	    $username   = post('txt_org_username');
		if(checkUniqueCol('tbl_organizer','org_username',$username, true, 'org_id', $org_id ))
		{
		    $data['org_username'] = $username;
		    if(post('txt_org_password') != null && post('txt_org_password') != "")
		    {
		        $data['org_password'] = encrypt(post('txt_org_password'));
		    }
		    where('org_id',$org_id);
			if(update($data,'tbl_organizer'))
			{
				set_msg('Success','Organizer is updated successfully','success');
				jump(admin_base_url()."list-organizer");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				echo "<script>window.history.go(-1);</script>";
			}
		}
		else
		{
		    set_msg('Duplication error','Username already taken.','error');
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
	if(isset($_GET['act_organizer']) && $_GET['act_organizer'] == "del")
	{
		if(isset($_GET['organizer_id']) && $_GET['organizer_id'] != "" && $_GET['organizer_id'] != null && $_GET['organizer_id'] > 0 )
		{
			$cer_id = $_GET['organizer_id'];
			where('org_id',$cer_id);
			if(delete('tbl_organizer'))
			{
				set_msg('Success','Organizer is deleted successfully','success');
				jump(admin_base_url()."list-organizer");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."list-organizer");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."list-organizer");
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