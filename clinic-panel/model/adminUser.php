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
				$sql = query("SELECT * FROM tbl_clinic WHERE clinic_username = '$username'");
				if(nrows($sql) == 1)
				{
					while ($row = fetch($sql))
					{
						$u_pass = $row['clinic_password'];
						if(password_verify($password,$u_pass))
						{
							set_sess('userdata',$row);
							set_sess('clinic_logged_in',1);
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
	    $cer_id 					= post('txt_clinicID');
		$data['clinic_name'] 		= post('txt_clinic_name');
		$data['clinic_name_ar'] 	= $_POST['txt_clinic_name_ar'];
		$data['clinic_phone'] 		= post('txt_clinic_phone');
		$data['clinic_phone_ar'] 	= changeNumberToArabic(post('txt_clinic_phone'));
		$data['clinic_address'] 	= post('txt_clinic_address');
		$data['clinic_address_ar'] 	= $_POST['txt_clinic_address_ar'];
		$data['clinic_country'] 	= post('txt_country');
		$data['clinic_area'] 	    = post('txt_area');
		$data['clinic_city'] 	    = post('txt_city');
		$data['clinic_url'] 	    = post('txt_clinic_url');
		$data['clinic_facebook'] 	= post('txt_fb_url');
		$data['clinic_instagram'] 	= post('txt_insta_url');
		$data['clinic_youtube'] 	= post('txt_yt_url');
		$data['clinic_linkedin'] 	= post('txt_linked_url');
		$data['clinic_twitter'] 	= post('txt_twitter_url');
		$image_name                 = upload_image($_FILES,'txt_icon', '../../upload/');
		if($image_name)
		{
		    $data['clinic_icon'] 	= $image_name;
		}
	    where('clinic_id',$cer_id);
		if(update($data,'tbl_clinic'))
		{
			set_msg('Success','Clinic is updated successfully','success');
			jump(admin_base_url()."all-clinic");
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
	else
	{
		jump(admin_base_ur());
	}
}
else
{
	jump(admin_base_ur());
}
?>