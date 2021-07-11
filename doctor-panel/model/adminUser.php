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
				$sql = query("SELECT * FROM tbl_doctor WHERE username = '$username'");
				if(nrows($sql) == 1)
				{
					while ($row = fetch($sql))
					{
						$u_pass = $row['password'];
						if(password_verify($password,$u_pass))
						{
							set_sess('userdata',$row);
							set_sess('doctor_logged_in',1);
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
	else if(isset($_POST['btn_save_user']))
	{
		$data['ad_user_fname'] 		= post('txt_fname');
		$data['ad_user_lname'] 		= post('txt_lname');
		$data['ad_user_email'] 		= post('txt_email');
		$data['ad_user_phone'] 		= post('txt_phone');
		$data['ad_user_username'] 	= post('txt_username');
		$data['ad_user_usertype'] 	= post('txt_user_type');
		$data['ad_user_password'] 	= post('txt_password');
		$confirm_password 			= post('txt_cnf_passwod');

		if
		(
		    $data['ad_user_fname'] != null && $data['ad_user_fname'] != "" &&
		    $data['ad_user_lname'] != null &&$data['ad_user_lname'] != "" &&
		    $data['ad_user_email'] != null && $data['ad_user_email'] != "" &&
		    $data['ad_user_phone'] != null && $data['ad_user_phone'] != "" &&
		    $data['ad_user_username'] != null && $data['ad_user_username'] != "" &&
		    $data['ad_user_usertype'] != null && $data['ad_user_usertype'] != "" &&
		    $data['ad_user_password'] != null && $data['ad_user_password'] != ""
		    )
		{
			$flag = true;
			$emailCheck 	= checkUniqueCol('tbl_admin_user','ad_user_email',$data['ad_user_email']);
			$usernameCheck 	= checkUniqueCol('tbl_admin_user','ad_user_username',$data['ad_user_username']);
			$phoneCheck 	= checkUniqueCol('tbl_admin_user','ad_user_phone',$data['ad_user_phone']);
			$msg = '';
			if($emailCheck['count'] > 0)
			{
				$flag = false;
				$msg .= "Email is already registered<br>";

			}
			if($usernameCheck['count'] > 0)
			{
				$flag = false;
				$msg .= "Username already registered<br>";

			}
			if($phoneCheck['count'] > 0)
			{
				$flag = false;
				$msg .= "Phone number already registered<br>";

			}
			if($flag)
			{
				if($data['ad_user_password'] == $confirm_password)
				{
					$data['ad_user_password'] = encrypt($confirm_password);
                    // echo "<pre>";
                    // print_r($data);
                    // die();
					if(insert($data, 'tbl_admin_user'))
					{
						set_msg('Succes','User added successfully','success');
						jump(admin_base_url()."users");
					}
					else
					{
						set_msg('Insertion Error','Unable to process your request. Please try again.','error');
						echo "<script>window.history.go(-1);</script>";
					}
				}
				else
				{
					set_msg('Password Error','Please enter correct files in both fields','error');
					echo "<script>window.history.go(-1);</script>";
				}	
			}
			else
			{
				set_msg('Insertion Error',$msg.'Please try new data','error');
				echo "<script>window.history.go(-1);</script>";
			}
		}
		else
		{
			set_msg('Fields Error','Please enter all fields','error');
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
				$newData['contact_id'] 		= $chk_my_id;
				$newData['contact_type'] 	= $chk_my_type;
				$newData['my_id'] 			= $chk_contact_id;
				$newData['my_type'] 		= $chk_contact_type;
				if(insert2($newData,'tbl_user_contact'))
				{

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