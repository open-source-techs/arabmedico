<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_grp']))
	{
		$data['group_name'] 	= post('txt_name');
		$data['group_name_ar'] 	= $_POST['txt_name_ar'];
		$data['group_type'] 	= post('txt_type');

		if(
			$data['group_name'] 	!= "" && $data['group_name'] 	!= null &&
			$data['group_name_ar'] 	!= "" && $data['group_name_ar'] != null
		)
		{
			if(insert($data, 'tbl_communication_group'))
			{
				set_msg('Success','Group is added successfully','success');
    			jump(admin_base_url()."group-list");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
    			echo "<script>window.history.go(-1);</script>";
			}
		}
	}
	else if(isset($_POST['btn_edit_grp']))
	{
		$groupID 				= post('txt_group_id');
		$data['group_name'] 	= post('txt_name');
		$data['group_name_ar'] 	= $_POST['txt_name_ar'];
		$data['group_type'] 	= post('txt_type');

		if(
			$data['group_name'] 	!= "" && $data['group_name'] 	!= null &&
			$data['group_name_ar'] 	!= "" && $data['group_name_ar'] != null
		)
		{
			where('group_id',$groupID);
			if(update($data, 'tbl_communication_group'))
			{
				set_msg('Success','Group is updated successfully','success');
    			jump(admin_base_url()."group-list");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
    			echo "<script>window.history.go(-1);</script>";
			}
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
		if(isset($_GET['group_id']) && $_GET['group_id'] != "" && $_GET['group_id'] != null && $_GET['group_id'] > 0 )
		{
			$group_id = $_GET['group_id'];
			where('group_id',$group_id);
			if(delete('tbl_communication_group'))
			{
				set_msg('Success','Group is deleted successfully','success');
				jump(admin_base_url()."group-list");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."group-list");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."group-list");
		}
	}
}
else
{
	jump(admin_base_url());
}