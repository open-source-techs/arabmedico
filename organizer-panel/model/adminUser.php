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
				$sql = query("SELECT * FROM tbl_organizer WHERE org_username = '$username'");
				if(nrows($sql) == 1)
				{
					while ($row = fetch($sql))
					{
						$u_pass = $row['org_password'];
						if(password_verify($password,$u_pass))
						{
							set_sess('userdata',$row);
							set_sess('organizer_logged_in',1);
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