<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save']))
	{
	    $data['membership_name'] 	= post('txt_name');
		$data['membership_price'] 	= post('txt_price');
		$data['allow_branding'] 	= post('txt_branding');
		$data['super_consultant'] 	= post('txt_consultant');
		if(
			$data['membership_name']  != "" && $data['membership_name'] 	!= null && 
			$data['membership_price'] != "" && $data['membership_price'] 	!= null
		)
		{
		   
			if(insert($data,'tbl_membership'))
			{
				set_msg('Success','Membership Package is added successfully','success');
				jump(admin_base_url()."member-packages");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				echo "<script>window.history.go(-1);</script>";
			}
		}
		else
		{
			set_msg('Fields validation','Please enter all fields details','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_edit']))
	{
	    $pkgID = post('txt_id');
	    $data['membership_name'] 	= post('txt_name');
		$data['membership_price'] 	= post('txt_price');
		$data['allow_branding'] 	= post('txt_branding');
		$data['super_consultant'] 	= post('txt_consultant');
		if(
			$data['membership_name']  != "" && $data['membership_name'] 	!= null && 
			$data['membership_price'] != "" && $data['membership_price'] 	!= null
		)
		{
		    where('membership_id',$pkgID);
			if(update($data,'tbl_membership'))
			{
				set_msg('Success','Membership Package is updated successfully','success');
				jump(admin_base_url()."member-packages");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				echo "<script>window.history.go(-1);</script>";
			}
		}
		else
		{
			set_msg('Fields validation','Please enter all fields details','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
}
else
{
    
}
?>