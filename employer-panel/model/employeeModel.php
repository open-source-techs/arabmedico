<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_edit_emp']))
	{
 		$emp_id 					= post('txt_emp_id');
		$data['emp_name'] 			= post('txt_emp_name');
		$data['emp_name_ar'] 		= $_POST['txt_emp_name_ar'];
		$data['emp_number'] 		= post('txt_emp_number');
		$data['emp_number_ar'] 		= changeNumberToArabic($data['emp_number']);
		$data['emp_url'] 			= post('txt_emp_url');
		$image_name                 = upload_image($_FILES,'txt_icon', '../../upload/');
		if($image_name)
		{
		    $data['emp_logo'] 	= $image_name;
		}

		if(
			$data['emp_name'] 		!= "" && $data['emp_name'] 		!= null &&
			$data['emp_name_ar'] 	!= "" && $data['emp_name_ar'] 	!= null &&
			$data['emp_number'] 	!= "" && $data['emp_number'] 	!= null &&
			$data['emp_number_ar'] 	!= "" && $data['emp_number_ar'] != null &&
			$data['emp_url'] 	    != "" && $data['emp_url'] 	    != null
		)
		{
		    where('emp_id',$emp_id);
			if(update($data,'tbl_employer'))
			{
				set_msg('Success','Employeer is updated successfully','success');
				jump(admin_base_url()."myprofile");
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
	    $emp_id     = post('txt_emp_id');
	    $username   = post('txt_username');
	    $c_password = post('txt_c_password');
	    $n_password = post('txt_n_password');
	    $r_password = post('txt_r_password');
	    
		if(checkUniqueCol('tbl_employer','emp_username',$username, true, 'emp_id', $emp_id ))
		{
		    $data['emp_username'] = $username;
		    if($c_password != null && $c_password != "")
		    {
		        if($n_password == $r_password)
		        {
		            $userpassword = get_sess("userdata")['emp_password'];
					if(password_verify($c_password,$userpassword))
					{
		                $data['emp_password'] = encrypt(post('txt_n_password'));
					}
					else
					{
					    set_msg('Password Error','Current Password is not correct. Please try again later.','error');
				        echo "<script>window.history.go(-1);</script>";
					}
		        }
		        else
		        {
		            set_msg('Password Error','Password is not same. Please try again later.','error');
				    echo "<script>window.history.go(-1);</script>";
		        }
		    }
		    where('emp_id',$emp_id);
			if(update($data,'tbl_employer'))
			{
				set_msg('Success','Employeer is updated successfully','success');
				jump(admin_base_url()."myprofile");
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
else
{
	jump(admin_base_url());
}