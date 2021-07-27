<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_login']))
	{
		$username = post('username');
		$password = post('password');
		if($username != null && $username != "")
		{
			if($password != null && $password != "")
			{
				$sql = query("SELECT * FROM tbl_organization WHERE organization_username = '$username'");
				if(nrows($sql) == 1)
				{
					while ($row = fetch($sql))
					{
						$u_pass = $row['organization_password'];
						if(password_verify($password,$u_pass))
						{
							set_sess('userdata',$row);
							set_sess('organization_logged_in',1);
							jump(admin_base_url());
						}
						else
						{
							set_msg('Login Error','Invalid password','error');
							jump(admin_base_url()."login");
						}
					}
				}
				else
				{
					set_msg('Login Error','Invalid username or email','error');
					jump(admin_base_url()."login");
				}
			}
			else
			{
				set_msg('Login Error','Please enter your password','error');
				jump(admin_base_url()."login");
			}
		}
		else
		{
			set_msg('Login Error','Please enter username / email','error');
			jump(admin_base_url()."login");
		}
	}
	else if(isset($_POST['btn_profile']))
	{
	    $cer_id 							= post('org_id');
		$data['organization_name'] 			= post('txt_org_name');
		$data['organization_name_ar'] 		= $_POST['txt_org_name_ar'];
		$data['organization_phone'] 		= post('txt_org_phone');
		$data['organization_phone_ar'] 		= changeNumberToArabic(post('txt_org_phone'));
		$data['organization_address'] 		= post('txt_org_address');
		$data['organization_address_ar'] 	= $_POST['txt_org_address_ar'];
		$data['organization_country'] 		= post('txt_country');
		$data['organization_area'] 			= post('txt_area');
		$data['organization_city'] 			= post('txt_city');
		$data['organization_meta_title'] 	= post('txt_meta_title');
		$data['organization_meta_title_ar'] = $_POST['txt_meta_title_ar'];
		$data['organization_meta_tag'] 		= post('txt_tag');
		$data['organization_meta_tag_ar'] 	= $_POST['txt_tag_ar'];
		$data['organization_meta_desc'] 	= post('txt_meta_desc');
		$data['organization_meta_desc_ar'] 	= $_POST['txt_meta_desc_ar'];
		$data['organization_active'] 	    = post('txt_status');
		$image_name                 		= upload_image($_FILES,'txt_icon', '../../upload/');
		if($image_name)
		{
		    $data['organization_icon'] 		= $image_name;
		}
        $previousSlug               		= post('previous_slug');
        $currentSlug                		= post('txt_org_url');
        $slugUpdate                 		= false;
        if($previousSlug != $currentSlug)
        {
            $slugUpdate             		= true;
            if(checkUniqueCol('tbl_url','url_suffex',$currentSlug, true, 'url_suffex', $previousSlug ))
    		{
    		    $data['organization_slug']  = $currentSlug;
    		}
        }
        if(
			$data['organization_name'] 	    	!= "" && $data['organization_name'] 		!= null &&
			$data['organization_name_ar']     	!= "" && $data['organization_name_ar'] 		!= null &&
			$data['organization_phone'] 	    != "" && $data['organization_phone'] 		!= null &&
			$data['organization_phone_ar'] 		!= "" && $data['organization_phone_ar'] 	!= null &&
			$data['organization_address'] 		!= "" && $data['organization_address'] 		!= null &&
			$data['organization_address_ar'] 	!= "" && $data['organization_address_ar'] 	!= null &&
			$data['organization_country'] 		!= "" && $data['organization_country'] 		!= null &&
			$data['organization_area'] 	    	!= "" && $data['organization_area'] 		!= null &&
			$data['organization_city'] 	    	!= "" && $data['organization_city']       	!= null
		)
		{
			where('organization_id',$cer_id);
			if(update2($data,'tbl_organization'))
			{
				if($slugUpdate)
				{
					$URLdata['url_suffex']  = $currentSlug;
				    $URLdata['url_type']    = 'organization';
				    where('url_suffex',$previousSlug);
				    update($URLdata,'tbl_url');
				}
				set_msg('Success','Organization is added successfully','success');
				jump(admin_base_url()."list-organization");
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
	else if(isset($_POST['btn_welcome']))
	{
		$org_id 						= post('txt_orgID');
		$data['clinic_wel_head'] 		= post('txt_welcome_head');
		$data['clinic_wel_head_ar'] 	= $_POST['txt_welcome_head_arabic'];
		$data['clinic_wel_text'] 	    = post('txt_welcome');
		$data['clinic_wel_text_arabic'] = $_POST['txt_welcome_arabic'];
		$image_name                 	= upload_image($_FILES,'txt_welcome_image', '../../upload/');
		if($image_name)
		{
		    $data['clinic_welcome_image'] 	= $image_name;
		}
	    where('organization_id',$org_id);
			if(update2($data,'tbl_organization'))
		{
			set_msg('Success','Organization is updated successfully','success');
			jump(admin_base_url()."page-welcome");
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
	if(isset($_GET['act']) && $_GET['act'] == "logout")
	{
		session_destroy();
		jump(admin_base_url()."login");
	}
	else if(isset($_GET['act']) && $_GET['act'] == "acceptRequest")
	{
		if(isset($_GET['contactID']) && $_GET['contactID'] != "" && $_GET['contactID'] != null && $_GET['contactID'] > 0)
		{
			$notificationId 	= $_GET['notifyID'];
			$tableID 			= $_GET['contactID'];
			$contactQuery 		= query("SELECT * FROM tbl_user_contact WHERE u_contact_id = $tableID");
			$contactData		= fetch($contactQuery);
			$chk_my_id 			= $contactData['contact_id'];
			$chk_my_type 		= strtolower($contactData['contact_type']);
			$chk_contact_id 	= $contactData['my_id'];
			$chk_contact_type 	= ucfirst($contactData['my_type']);
			$chkQuery 			= query("SELECT * FROM tbl_user_contact WHERE contact_id = '$chk_contact_id' AND contact_type = '$chk_contact_type' AND my_id = '$chk_my_id' AND my_type = '$chk_my_type'");

			if(nrows($chkQuery) > 0)
			{
				$chkData = fetch($chkQuery);
				$update['active'] = 1;
				where('u_contact_id',$chkData['u_contact_id']);
				if(update2($update,'tbl_user_contact'))
				{
					where('u_contact_id',$tableID);
					update2($update,'tbl_user_contact');

					where('notify_id',$notificationId);
					delete('tbl_notification');

					set_msg('Success','Your request is processed successfully','success');
					echo "<script>window.history.go(-1);</script>";
				}
				else
				{
					set_msg('Error','Unable to process your request. Please try again later.','error');
					echo "<script>window.history.go(-1);</script>";
				}
			}
			else
			{
				$newData['contact_id'] 		= $chk_contact_id;
				$newData['contact_type'] 	= ucfirst($chk_contact_type);
				$newData['my_id'] 			= $chk_my_id;
				$newData['my_type'] 		= strtolower($chk_my_type);
				$newData['active'] 			= 1;
				if(insert2($newData,'tbl_user_contact'))
				{
					$updateData['active'] = 1;
					where('u_contact_id',$tableID);
					update2($updateData,'tbl_user_contact');


					where('notify_id',$notificationId);
					delete('tbl_notification');

					set_msg('Success','Your request is processed successfully','success');
					echo "<script>window.history.go(-1);</script>";
				}
				else
				{
					set_msg('Error','Unable to process your request. Please try again later.','error');
					echo "<script>window.history.go(-1);</script>";
				}
			}
		}
		else
		{
			jump(admin_base_url());
		}
	}
	else if(isset($_GET['act']) && $_GET['act'] == "rejectRequest")
	{
		if(isset($_GET['contactID']) && $_GET['contactID'] != "" && $_GET['contactID'] != null && $_GET['contactID'] > 0)
		{
			$notificationId 	= $_GET['notifyID'];
			$tableID 			= $_GET['contactID'];

			where('notify_id',$notificationId);
			delete('tbl_notification');

			where('u_contact_id',$tableID);
			delete('tbl_user_contact');

			set_msg('Success','Request is rejected successfully','success');
			echo "<script>window.history.go(-1);</script>";
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
?>