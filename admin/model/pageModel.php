<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_page']))
	{
		$data['page_name'] 		        = post('txt_name');
		$data['page_name_arabic'] 		= $_POST['txt_name_arabic'];
		$slug 							= create_slug(strtolower($data['page_name']));
		$data['page_slug'] 				= check_column('tbl_pages','page_slug',$slug);
		$image_name                 	= upload_image($_FILES,'txt_banner', '../../upload/');
		if($image_name)
		{
		    $data['page_banner'] 		= $image_name;
		}
		else
		{
		    $data['page_banner']  	    = '';
		}
		$data['page_title'] 		    = $_POST['txt_title'];
		$data['page_title_arabic'] 		= $_POST['txt_title_arabic'];
		$data['page_meta_desc'] 	    = $_POST['txt_meta_desc'];
		$data['page_meta_desc_arabic']  = $_POST['txt_desc_arabic'];
		$data['page_meta_tag'] 	        = $_POST['txt_tags'];
		$data['page_meta_tag_arabic']   = $_POST['txt_tags_arabic'];
		$data['page_data'] 		        = $_POST['txt_data'];
		$data['page_data_arabic'] 		= $_POST['txt_data_arabic'];
		$data['page_position'] 	        = post('txt_position');
		if(
			$data['page_name'] 				!= "" && $data['page_name'] 			    != null && 
			$data['page_name_arabic'] 		!= "" && $data['page_name_arabic'] 	        != null && 
			$data['page_banner'] 		    != "" && $data['page_banner'] 	            != null && 
			$data['page_title'] 		    != "" && $data['page_title'] 	            != null && 
			$data['page_title_arabic'] 	    != "" && $data['page_title_arabic'] 	    != null && 
			$data['page_meta_desc']         != "" && $data['page_meta_desc'] 	        != null &&
			$data['page_meta_desc_arabic'] 	!= "" && $data['page_meta_desc_arabic'] 	!= null && 
			$data['page_meta_tag']          != "" && $data['page_meta_tag'] 	        != null && 
			$data['page_meta_tag_arabic'] 	!= "" && $data['page_meta_tag_arabic'] 	    != null && 
			$data['page_data']              != "" && $data['page_data'] 	            != null && 
			$data['page_data_arabic']       != "" && $data['page_data_arabic'] 	        != null
		)
		{
			if(insert($data,'tbl_pages'))
			{
				set_msg('Success','Page is added successfully','success');
				jump(admin_base_url()."all-page");
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
	else if(isset($_POST['btn_edit_page']))
	{
	    $page_id                        = post('txt_page_id');
		$data['page_name'] 		        = post('txt_name');
		$data['page_name_arabic'] 		= $_POST['txt_name_arabic'];
		$image_name                 	= upload_image($_FILES,'txt_banner', '../../upload/');
		if($image_name)
		{
		    $data['page_banner'] 		= $image_name;
		}
		$data['page_title'] 		    = $_POST['txt_title'];
		$data['page_title_arabic'] 		= $_POST['txt_title_arabic'];
		$data['page_meta_desc'] 	    = $_POST['txt_meta_desc'];
		$data['page_meta_desc_arabic']  = $_POST['txt_desc_arabic'];
		$data['page_meta_tag'] 	        = $_POST['txt_tags'];
		$data['page_meta_tag_arabic']   = $_POST['txt_tags_arabic'];
		$data['page_data'] 		        = htmlentities($_POST['txt_data']);
		$data['page_data_arabic'] 		= $_POST['txt_data_arabic'];
		$data['page_position'] 	        = post('txt_position');
		$data['page_active'] 	        = post('txt_status');
// 		echo "<pre>";
// 	    print_r($data);
// 	    die();
	    where('page_id',$page_id);
		if(update2($data,'tbl_pages'))
		{
			set_msg('Success','Page is updated successfully','success');
			jump(admin_base_url()."all-page");
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
	if(isset($_GET['act']) && $_GET['act'] == "del")
	{
		if(isset($_GET['page_id']) && $_GET['page_id'] != "" && $_GET['page_id'] != null && $_GET['page_id'] > 0 )
		{
			$page = $_GET['page_id'];
			where('page_id',$page);
			if(delete('tbl_pages'))
			{
				set_msg('Success','Page is deleted successfully','success');
				jump(admin_base_url()."all-page");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."all-page");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."all-page");
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