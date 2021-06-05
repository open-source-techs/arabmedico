<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_package']))
	{
	    $data['offer_clinic']           = post('txt_clinicID');
		$data['offer_name'] 			= post('txt_title');
		$data['offer_name_ar'] 			= $_POST['txt_title_ar'];
		$data['offer_price'] 			= post('txt_price');
		$data['offer_price_ar'] 		= changeNumberToArabic($data['offer_price']);
		$data['offer_hightlight1'] 		= post('txt_hightlight_one');
		$data['offer_highlight1_ar'] 	= $_POST['txt_hightlight_one_arabic'];
		$data['offer_hightlight2'] 		= post('txt_hightlight_two');
		$data['offer_hightlight2_ar'] 	= $_POST['txt_hightlight_two_arabic'];
		$data['offer_hightlight3'] 		= post('txt_hightlight_three');
		$data['offer_hightlight3_ar']   = $_POST['txt_hightlight_three_arabic'];
		$data['offer_hightlight4'] 		= post('txt_hightlight_four');
		$data['offer_hightlight4_ar'] 	= $_POST['txt_hightlight_four_arabic'];
		$data['offer_hightlight5'] 		= post('txt_hightlight_five');
		$data['offer_hightlight5_ar'] 	= $_POST['txt_hightlight_five_arabic'];
		$data['offer_hightlight6'] 		= post('txt_hightlight_six');
		$data['offer_hightlight6_ar'] 	= $_POST['txt_hightlight_six_arabic'];
		$data['offer_hightlight7'] 		= post('txt_hightlight_seven');
		$data['offer_hightlight7_ar']   = $_POST['txt_hightlight_seven_arabic'];
		$data['offer_hightlight8'] 		= post('txt_hightlight_eight');
		$data['offer_hightlight8_ar']   = $_POST['txt_hightlight_eight_arabic'];
		$data['offer_hightlight9'] 		= post('txt_hightlight_nine');
		$data['offer_hightlight9_ar']   = $_POST['txt_hightlight_nine_arabic'];
		$data['offer_hightlight10']     = post('txt_hightlight_ten');
		$data['offer_hightlight10_ar']  = $_POST['txt_hightlight_ten_arabic'];
		$image_name                 	= upload_image($_FILES,'txt_image', '../../upload/');
		if($image_name)
		{
		    $data['offer_media'] 		= $image_name;
		}
		else
		{
		    $data['offer_media']  		= '';
		}
		
		$image_name1                 	= upload_image($_FILES,'txt_image_ar', '../../upload/');
		if($image_name1)
		{
		    $data['offer_media_ar'] 	= $image_name1;
		}
		else
		{
		    $data['offer_media_ar']  	= '';
		}
// 		echo "<pre>";
// 		print_r($data);
// 		die();
		if(
			$data['offer_name'] 	!= "" && $data['offer_name'] 	    != null && 
			$data['offer_name_ar'] 	!= "" && $data['offer_name_ar']     != null && 
			$data['offer_price'] 	!= "" && $data['offer_price'] 	    != null && 
			$data['offer_price_ar'] != "" && $data['offer_price_ar']    != null && 
			$data['offer_media'] 	!= "" && $data['offer_media'] 		!= null &&
			$data['offer_media_ar'] != "" && $data['offer_media_ar'] 	!= null
		)
		{
			if(insert($data, 'tbl_clinic_offers'))
			{
				set_msg('Success','Offer is added successfully','success');
				jump(admin_base_url()."all-package");
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
	else if(isset($_POST['btn_edit_package']))
	{
		$package_id 					= post('txt_pkg_id');
		$data['offer_clinic']           = post('txt_clinicID');
		$data['offer_name'] 			= post('txt_title');
		$data['offer_name_ar'] 			= $_POST['txt_title_ar'];
		$data['offer_price'] 			= post('txt_price');
		$data['offer_price_ar'] 		= changeNumberToArabic($data['offer_price']);
		$data['offer_hightlight1'] 		= post('txt_hightlight_one');
		$data['offer_highlight1_ar'] 	= $_POST['txt_hightlight_one_arabic'];
		$data['offer_hightlight2'] 		= post('txt_hightlight_two');
		$data['offer_hightlight2_ar'] 	= $_POST['txt_hightlight_two_arabic'];
		$data['offer_hightlight3'] 		= post('txt_hightlight_three');
		$data['offer_hightlight3_ar']   = $_POST['txt_hightlight_three_arabic'];
		$data['offer_hightlight4'] 		= post('txt_hightlight_four');
		$data['offer_hightlight4_ar'] 	= $_POST['txt_hightlight_four_arabic'];
		$data['offer_hightlight5'] 		= post('txt_hightlight_five');
		$data['offer_hightlight5_ar'] 	= $_POST['txt_hightlight_five_arabic'];
		$data['offer_hightlight6'] 		= post('txt_hightlight_six');
		$data['offer_hightlight6_ar'] 	= $_POST['txt_hightlight_six_arabic'];
		$data['offer_hightlight7'] 		= post('txt_hightlight_seven');
		$data['offer_hightlight7_ar']   = $_POST['txt_hightlight_seven_arabic'];
		$data['offer_hightlight8'] 		= post('txt_hightlight_eight');
		$data['offer_hightlight8_ar']   = $_POST['txt_hightlight_eight_arabic'];
		$data['offer_hightlight9'] 		= post('txt_hightlight_nine');
		$data['offer_hightlight9_ar']   = $_POST['txt_hightlight_nine_arabic'];
		$data['offer_hightlight10']     = post('txt_hightlight_ten');
		$data['offer_hightlight10_ar']  = $_POST['txt_hightlight_ten_arabic'];
		$image_name                 	= upload_image($_FILES,'txt_image', '../../upload/');
		if($image_name)
		{
		    $data['offer_media'] 		= $image_name;
		}
		$image_name1                 	= upload_image($_FILES,'txt_image_ar', '../../upload/');
		if($image_name1)
		{
		    $data['offer_media_ar'] 	= $image_name1;
		}

		if(
			$data['offer_name'] 	!= "" && $data['offer_name'] 	    != null && 
			$data['offer_name_ar'] 	!= "" && $data['offer_name_ar']     != null && 
			$data['offer_price'] 	!= "" && $data['offer_price'] 	    != null && 
			$data['offer_price_ar'] != "" && $data['offer_price_ar']    != null
		)
		{
			where('offer_id',$package_id);
			if(update($data, 'tbl_clinic_offers'))
			{
				set_msg('Success','Offer is updated successfully','success');
				jump(admin_base_url()."all-package");
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
	else
	{
		jump(admin_base_url());
	}
}
else if($_SERVER['REQUEST_METHOD'] == "GET")
{
	if(isset($_GET['act']) && $_GET['act'] == "del")
	{
		if(isset($_GET['pkg_id']) && $_GET['pkg_id'] != "" && $_GET['pkg_id'] != null && $_GET['pkg_id'] > 0 )
		{
			$pkg_id = $_GET['pkg_id'];
			where('offer_id',$pkg_id);
			if(delete('tbl_clinic_offers'))
			{
				set_msg('Success','Offer is deleted successfully','success');
				jump(admin_base_url()."all-package");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."all-package");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."list-department");
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