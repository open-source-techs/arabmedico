<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_edit_org']))
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
				set_msg('Success','Profile is updated successfully','success');
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
	    $org_id     = post('txt_org_id');
	    $username   = post('txt_username');
	    $c_password = post('txt_c_password');
	    $n_password = post('txt_n_password');
	    $r_password = post('txt_r_password');
	    
		if(checkUniqueCol('tbl_organizer','org_username',$username, true, 'org_id', $org_id ))
		{
		    $data['org_username'] = $username;
		    if($c_password != null && $c_password != "")
		    {
		        if($n_password == $r_password)
		        {
		            $userpassword = get_sess("userdata")['org_password'];
					if(password_verify($c_password,$userpassword))
					{
		                $data['org_password'] = encrypt(post('txt_n_password'));
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
		    where('org_id',$org_id);
			if(update($data,'tbl_organizer'))
			{
				set_msg('Success','Credentials is updated successfully','success');
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