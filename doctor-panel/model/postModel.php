<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_post_submit']))
	{
		$data['post_text'] 			= $_POST['status'];
		$data['post_userType'] 		= 'doctor';
		$data['post_group']			= post('txt_group_id');
		$data['post_user'] 			= get_sess("userdata")['doc_id'];;
		$postImage              	= upload_image($_FILES,'post_image', '../../upload/');
		if($postImage)
		{
		    $data['post_image'] 	= $postImage;
		}
		$postVideo              	= upload_image($_FILES,'post_video', '../../upload/');
		if($postVideo)
		{
		    $data['post_video'] 	= $postVideo;
		}
		if(insert($data,'tbl_post'))
		{
			set_msg('Success','Post is uploaded successfully','success');
			jump(admin_base_url()."?grpID=".$data['post_group']);
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else
	{
		set_msg('Unexpected Error','Unexpected error occurs. Please try again later','error');
		jumnp(admin_base_url());
	}
}
else if($_SERVER['REQUEST_METHOD'] == "GET")
{
	if(isset($_GET['act']) && $_GET['act'] == 'joinGroup')
	{
		if(isset($_GET['grpID']) && $_GET['grpID'] != '' && $_GET['grpID'] != null && $_GET['grpID'] > 0)
		{
			$data['grp_user_id'] 	= get_sess("userdata")['doc_id'];
			$data['grp_group_id'] 	= $_GET['grpID'];
			$data['grp_user_type'] 	= 'doctor';
			if(insert($data,'tbl_group_users'))
			{
				set_msg('Success','Your request is submitted successfully','success');
				jump(admin_base_url());
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				jumnp(admin_base_url());
			}
		}
		else
		{
			set_msg('Record Not Found','Group does not found','error');
			jumnp(admin_base_url());
		}
	}
	else
	{
		set_msg('Unexpected Error','Unexpected error occurs. Please try again later','error');
		jumnp(admin_base_url());
	}
}
else
{
	jumnp(admin_base_url());
}