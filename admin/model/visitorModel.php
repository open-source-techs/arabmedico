<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_user']))
	{
		$data['user_name'] 		= post('txt_full_name');
		$data['user_name_arabic'] = $_POST['txt_full_name_arabic'];
		$data['user_email'] 	= post('txt_email');
		$data['user_phone'] 	= post('txt_phone');
		$data['user_phone_arabic'] = $_POST['txt_phone_arabic'];
		$data['user_password'] 	= post('txt_pass');
		$data['user_added_by'] 	= 1;
		$confirm_password 		= post('txt_cnf_pass');
		$image_name             = upload_image($_FILES,'txt_icon', '../../upload/');
		if($image_name)
		{
		    $data['user_image'] = $image_name;
		}
		else
		{
		    $data['user_image'] = '';
		}
		if
		(
		    $data['user_name']      != null && $data['user_name']       != "" &&
		    $data['user_name_arabic'] != null && $data['user_name_arabic'] != "" &&
		    $data['user_email']     != null && $data['user_email']       != "" &&
		    $data['user_phone']     != null && $data['user_phone']      != "" &&
		    $data['user_password']  != null && $data['user_password']   != "" &&
		    $data['user_image']     != null && $data['user_image']      != ""
        )
		{
			$flag = true;
			$emailCheck 	= checkUniqueCol('tbl_users','user_email',$data['user_email']);
			$phoneCheck 	= checkUniqueCol('tbl_users','user_phone',$data['user_phone']);
			$msg = '';
			if($emailCheck['count'] > 0)
			{
				$flag = false;
				$msg .= "Email is already registered<br>";

			}
			if($phoneCheck['count'] > 0)
			{
				$flag = false;
				$msg .= "Phone number already registered<br>";

			}
			if($flag)
			{
				if($data['user_password'] == $confirm_password)
				{
					$data['user_password'] = encrypt($confirm_password);

					if(insert($data, 'tbl_users'))
					{
						set_msg('Succes','User added successfully','success');
						jump(admin_base_url()."all-visitor");
					}
					else
					{
						set_msg('Insertion Error','Unable to process your request. Please try again.','error');
						echo "<script>window.history.go(-1);</script>";
					}
				}
				else
				{
					set_msg('Password Error','Please enter correct password in both fields','error');
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
	else if(isset($_POST['btn_edit_user']))
	{
	    $user_id                = post('txt_user_id');
		$data['user_name'] 		= post('txt_full_name');
		$data['user_name_arabic'] = $_POST['txt_full_name_arabic'];
		$data['user_email'] 	= post('txt_email');
		$data['user_phone'] 	= post('txt_phone');
		$data['user_phone_arabic'] = $_POST['txt_phone_arabic'];
		$data['user_verified'] 	= post('txt_is_veirfied');
		$data['user_status'] 	= post('txt_is_active');
		$image_name             = upload_image($_FILES,'txt_icon', '../../upload/');
		if($image_name)
		{
		    $data['user_image'] = $image_name;
		}
		if
		(
		    $data['user_name']      != null && $data['user_name']       != "" &&
		    $data['user_name_arabic']      != null && $data['user_name_arabic']       != "" &&
		    $data['user_email']     != null &&$data['user_email']       != "" &&
		    $data['user_phone']     != null && $data['user_phone']      != ""
        )
		{
			$flag = true;
			$emailCheck 	= checkUniqueCol('tbl_users','user_email',$data['user_email'],true,'user_id',$user_id);
			$phoneCheck 	= checkUniqueCol('tbl_users','user_phone',$data['user_phone'],true,'user_id',$user_id);
			$msg = '';
			if($emailCheck['count'] > 0)
			{
				$flag = false;
				$msg .= "Email is already registered<br>";

			}
			if($phoneCheck['count'] > 0)
			{
				$flag = false;
				$msg .= "Phone number already registered<br>";

			}
			if($flag)
			{
    		  //  echo "<pre>";
    		  //  print_r($data);
    		  //  die();
			    where('user_id',$user_id);
				if(update($data, 'tbl_users'))
				{
					set_msg('Succes','User updated successfully','success');
					jump(admin_base_url()."all-visitor");
				}
				else
				{
					set_msg('Insertion Error','Unable to process your request. Please try again.','error');
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
	else if(isset($_POST['btn_edit_user_password']))
	{
	    $user_id                = post('txt_user_id');
	    $data['user_password']  = post('txt_pass');
	    $confirm_password 	    = post('txt_cnf_pass');
	    if($data['user_password'] == $confirm_password)
		{
			$data['user_password'] = encrypt($confirm_password);
			where('user_id',$user_id);
			if(update($data, 'tbl_users'))
			{
				set_msg('Succes','User password updated successfully','success');
				jump(admin_base_url()."all-visitor");
			}
			else
			{
				set_msg('Insertion Error','Unable to process your request. Please try again.','error');
				echo "<script>window.history.go(-1);</script>";
			}
	    }
	    else
		{
			set_msg('Password Error','Please enter correct password in both fields','error');
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
		if(isset($_GET['uid']) && $_GET['uid'] != "" && $_GET['uid'] != null && $_GET['uid'] > 0 )
		{
			$user_id = $_GET['uid'];
			where('user_id',$user_id);
			if(delete('tbl_users'))
			{
				set_msg('Success','User is deleted successfully','success');
				jump(admin_base_url()."all-visitor");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."all-visitor");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."all-visitor");
		}
	}
	else
	{
		jump(admin_base_url());
	}
}
else
{
	jump(admin_base_ur());
}
?>