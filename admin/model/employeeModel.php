<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_emp']))
	{
		$data['emp_name'] 			= post('txt_emp_name');
		$data['emp_name_ar'] 		= $_POST['txt_emp_name_ar'];
		$data['emp_number'] 		= post('txt_emp_number');
		$data['emp_number_ar'] 		= changeNumberToArabic($data['emp_number']);
		$data['emp_url'] 			= post('txt_emp_url');
		$data['emp_copEmail'] 		= post('txt_corporate_email');
		$data['emp_location'] 		= post('txt_location');
		$data['emp_location_ar'] 	= $_POST['txt_location'];
		$data['emp_serviceType'] 	= post('txt_serviceType');
		$data['emp_serviceType_ar'] = $_POST['txt_serviceType'];
		$data['emp_personName'] 	= post('txt_c_person');
		$data['emp_cellNum'] 		= post('txt_c_number');
		$data['emp_perEmail'] 		= post('txt_c_email');
		$data['emp_comPos'] 		= post('txt_c_position');
		$data['emp_username'] 		= post('txt_emp_username');
		$data['emp_password'] 		= encrypt(post('txt_emp_password'));
		$usernameCheck 	            = checkUniqueCol('tbl_employer','emp_username',$data['emp_username']);
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
    		    $data['emp_logo'] 	= $image_name;
    		}
    		else
    		{
    		    $data['emp_logo']  = '';
    		}
    
    		if(
    			$data['emp_name'] 		!= "" && $data['emp_name'] 		!= null &&
    			$data['emp_name_ar'] 	!= "" && $data['emp_name_ar'] 	!= null &&
    			$data['emp_number'] 	!= "" && $data['emp_number'] 	!= null &&
    			$data['emp_number_ar'] 	!= "" && $data['emp_number_ar'] != null &&
    			$data['emp_url'] 	    != "" && $data['emp_url'] 	    != null &&
    			$data['emp_username'] 	!= "" && $data['emp_username'] 	!= null &&
    			$data['emp_password'] 	!= "" && $data['emp_password'] 	!= null
    		)
    		{
    			if(insert($data,'tbl_employer'))
    			{
    				set_msg('Success','Employeer is added successfully','success');
    				jump(admin_base_url()."list-employer");
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
	else if(isset($_POST['btn_edit_emp']))
	{
 		$emp_id 					= post('txt_emp_id');
		$data['emp_name'] 			= post('txt_emp_name');
		$data['emp_name_ar'] 		= $_POST['txt_emp_name_ar'];
		$data['emp_number'] 		= post('txt_emp_number');
		$data['emp_number_ar'] 		= changeNumberToArabic($data['emp_number']);
		$data['emp_url'] 			= post('txt_emp_url');
		$data['emp_copEmail'] 		= post('txt_corporate_email');
		$data['emp_location'] 		= post('txt_location');
		$data['emp_location_ar'] 	= $_POST['txt_location'];
		$data['emp_serviceType'] 	= post('txt_serviceType');
		$data['emp_serviceType_ar'] = $_POST['txt_serviceType'];
		$data['emp_personName'] 	= post('txt_c_person');
		$data['emp_cellNum'] 		= post('txt_c_number');
		$data['emp_perEmail'] 		= post('txt_c_email');
		$data['emp_comPos'] 		= post('txt_c_position');
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
				jump(admin_base_url()."list-employer");
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
	    $username   = post('txt_emp_username');
		if(checkUniqueCol('tbl_employer','emp_username',$username, true, 'emp_id', $emp_id ))
		{
		    $data['emp_username'] = $username;
		    if(post('txt_emp_password') != null && post('txt_emp_password') != "")
		    {
		        $data['emp_password'] = encrypt(post('txt_emp_password'));
		    }
		    where('emp_id',$emp_id);
			if(update($data,'tbl_employer'))
			{
				set_msg('Success','Employeer is updated successfully','success');
				jump(admin_base_url()."list-employer");
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
	if(isset($_GET['act_employee']) && $_GET['act_employee'] == "del")
	{
		if(isset($_GET['employee_id']) && $_GET['employee_id'] != "" && $_GET['employee_id'] != null && $_GET['employee_id'] > 0 )
		{
			$cer_id = $_GET['employee_id'];
			where('emp_id',$cer_id);
			if(delete('tbl_employer'))
			{
				set_msg('Success','Employer is deleted successfully','success');
				jump(admin_base_url()."list-employer");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."list-employer");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."list-employer");
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