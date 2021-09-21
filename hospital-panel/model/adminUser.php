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
				$sql = query("SELECT * FROM tbl_hospital WHERE hospital_username = '$username'");
				if(nrows($sql) == 1)
				{
					while ($row = fetch($sql))
					{
						$u_pass = $row['hospital_password'];
						if(password_verify($password,$u_pass))
						{
							set_sess('userdata',$row);
							set_sess('hospital_logged_in',1);
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
	    $cer_id 					= post('txt_hospitalID');
		$data['hospital_name'] 		= post('txt_hospital_name');
		$data['hospital_name_ar'] 	= $_POST['txt_hospital_name_ar'];
		$data['hospital_phone'] 		= post('txt_hospital_phone');
		$data['hospital_phone_ar'] 	= changeNumberToArabic(post('txt_hospital_phone'));
		$data['hospital_address'] 	= post('txt_hospital_address');
		$data['hospital_address_ar'] 	= $_POST['txt_hospital_address_ar'];
		$data['hospital_country'] 	= post('txt_country');
		$data['hospital_area'] 	    = post('txt_area');
		$data['hospital_city'] 	    = post('txt_city');
		$data['hospital_url'] 	    = post('txt_hospital_url');
		$data['hospital_facebook'] 	= post('txt_fb_url');
		$data['hospital_instagram'] 	= post('txt_insta_url');
		$data['hospital_youtube'] 	= post('txt_yt_url');
		$data['hospital_linkedin'] 	= post('txt_linked_url');
		$data['hospital_twitter'] 	= post('txt_twitter_url');
		$image_name                 = upload_image($_FILES,'txt_icon', '../../upload/');
		if($image_name)
		{
		    $data['hospital_icon'] 	= $image_name;
		}
	    where('hospital_id',$cer_id);
		if(update2($data,'tbl_hospital'))
		{
			set_msg('Success','hospital is updated successfully','success');
			jump(admin_base_url()."profile");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_welcome']))
	{
		$cer_id 						= post('txt_hospitalID');
		$data['hospital_wel_head'] 		= post('txt_welcome_head');
		$data['hospital_wel_head_ar'] 	= $_POST['txt_welcome_head_arabic'];
		$data['hospital_wel_text'] 	    = post('txt_welcome');
		$data['hospital_wel_text_arabic'] = $_POST['txt_welcome_arabic'];
		$image_name                 	= upload_image($_FILES,'txt_welcome_image', '../../upload/');
		if($image_name)
		{
		    $data['hospital_welcome_image'] 	= $image_name;
		}
	    where('hospital_id',$cer_id);
		if(update2($data,'tbl_hospital'))
		{
			set_msg('Success','hospital is updated successfully','success');
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