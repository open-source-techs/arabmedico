<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_add_news']))
	{
		$data['news_title'] 	= post('txt_title');
		$data['news_title_ar'] 	= $_POST['txt_title_ar'];
		$data['news_for'] 		= post('txt_news_for');
		$data['news_text'] 		= post('txt_desc');
		$data['news_text_ar'] 	= $_POST['txt_desc_ar'];

		if(
			$data['news_title'] 	!= null && $data['news_title'] 		!= "" &&
			$data['news_title_ar'] 	!= null && $data['news_title_ar'] 	!= "" &&
			$data['news_for'] 		!= null && $data['news_for'] 		!= ""
		)
		{
			if(insert($data,'tbl_internal_news'))
			{
				set_msg('Success','News is added successfully','success');
				jump(admin_base_url()."all-internal-news");
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
	else if(isset($_POST['btn_edit_news']))
	{
		$newsId 				= post('txt_news_id');
		$data['news_title'] 	= post('txt_title');
		$data['news_title_ar'] 	= $_POST['txt_title_ar'];
		$data['news_for'] 		= post('txt_news_for');
		$data['news_text'] 		= post('txt_desc');
		$data['news_text_ar'] 	= $_POST['txt_desc_ar'];

		if(
			$data['news_title'] 	!= null && $data['news_title'] 		!= "" &&
			$data['news_title_ar'] 	!= null && $data['news_title_ar'] 	!= "" &&
			$data['news_for'] 		!= null && $data['news_for'] 		!= ""
		)
		{
			where('news_id',$newsId);
			if(update($data,'tbl_internal_news'))
			{
				set_msg('Success','News is added successfully','success');
				jump(admin_base_url()."all-internal-news");
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
	else
	{
		jump(admin_base_url());
	}
}
else if($_SERVER['REQUEST_METHOD'] == "GET")
{
	if(isset($_GET['act']) && $_GET['act'] == "del")
	{
		if(isset($_GET['news_id']) && $_GET['news_id'] != "" && $_GET['news_id'] != null && $_GET['news_id'] > 0 )
		{
			$news_id = $_GET['news_id'];
			where('news_id',$news_id);
			if(delete('tbl_internal_news'))
			{
				set_msg('Success','News is deleted successfully','success');
				jump(admin_base_url()."all-internal-news");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."all-internal-news");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."all-internal-news");
		}
	}
}
else
{
	jump(admin_base_url());
}