<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_package']))
	{
		$data['pkg_name'] 					= post('txt_title');
		$slug 								= create_slug(strtolower($data['pkg_name']));
		$data['pkg_slug'] 					= check_column('tbl_packages','pkg_slug',$slug);
		$data['pkg_name_arabic'] 			= $_POST['txt_title_arabic'];
		$data['pkg_description'] 			= $_POST['txt_short_desc'];
		$data['pkg_description_arabic'] 	= $_POST['txt_short_desc_arabic'];
		$data['pkg_highlight_one'] 			= post('txt_hightlight_one');
		$data['pkg_highlight_one_arabic'] 	= $_POST['txt_hightlight_one_arabic'];
		$data['pkg_highlight_two'] 			= post('txt_hightlight_two');
		$data['pkg_highlight_two_arabic'] 	= $_POST['txt_hightlight_two_arabic'];
		$data['pkg_highlight_three'] 		= post('txt_hightlight_three');
		$data['pkg_highlight_three_arabic'] = $_POST['txt_hightlight_three_arabic'];
		$data['pkg_highlight_four'] 		= post('txt_hightlight_four');
		$data['pkg_highlight_four_arabic'] 	= $_POST['txt_hightlight_four_arabic'];
		$data['pkg_highlight_five'] 		= post('txt_hightlight_five');
		$data['pkg_highlight_five_arabic'] 	= $_POST['txt_hightlight_five_arabic'];
		$data['pkg_highlight_six'] 			= post('txt_hightlight_six');
		$data['pkg_highlight_six_arabic'] 	= $_POST['txt_hightlight_six_arabic'];
		$data['pkg_highlight_seven'] 		= post('txt_hightlight_seven');
		$data['pkg_highlight_seven_arabic'] = $_POST['txt_hightlight_seven_arabic'];
		$data['pkg_highlight_eight'] 		= post('txt_hightlight_eight');
		$data['pkg_highlight_eight_arabic'] = $_POST['txt_hightlight_eight_arabic'];
		$data['pkg_details'] 				= $_POST['txt_pkg_detail'];
		$data['pkg_details_arabic'] 		= $_POST['txt_pkg_detail_arabic'];
		$image_name                 	    = upload_image($_FILES,'txt_image', '../../upload/');
		if($image_name)
		{
		    $data['pkg_image'] 			    = $image_name;
		}
		else
		{
		    $data['pkg_image']  		    = '';
		}
    //     echo "<pre>";
	   // print_r($data);
	   // die();
		if(
			$data['pkg_name'] 					!= "" && $data['pkg_name'] 						!= null && 
			$data['pkg_slug'] 					!= "" && $data['pkg_slug'] 						!= null && 
			$data['pkg_name_arabic'] 			!= "" && $data['pkg_name_arabic'] 				!= null && 
			$data['pkg_description'] 			!= "" && $data['pkg_description'] 				!= null && 
			$data['pkg_description_arabic'] 	!= "" && $data['pkg_description_arabic'] 		!= null && 
			$data['pkg_highlight_one'] 			!= "" && $data['pkg_highlight_one'] 			!= null && 
			$data['pkg_highlight_one_arabic'] 	!= "" && $data['pkg_highlight_one_arabic'] 		!= null &&
			$data['pkg_highlight_two'] 			!= "" && $data['pkg_highlight_two'] 			!= null && 
			$data['pkg_highlight_two_arabic'] 	!= "" && $data['pkg_highlight_two_arabic'] 		!= null &&
			$data['pkg_highlight_three'] 		!= "" && $data['pkg_highlight_three'] 			!= null && 
			$data['pkg_highlight_three_arabic'] != "" && $data['pkg_highlight_three_arabic'] 	!= null &&
			$data['pkg_highlight_four'] 		!= "" && $data['pkg_highlight_four'] 			!= null && 
			$data['pkg_highlight_four_arabic'] 	!= "" && $data['pkg_highlight_four_arabic'] 	!= null &&
			$data['pkg_highlight_five'] 		!= "" && $data['pkg_highlight_five'] 			!= null && 
			$data['pkg_highlight_five_arabic'] 	!= "" && $data['pkg_highlight_five_arabic'] 	!= null &&
			$data['pkg_highlight_six'] 			!= "" && $data['pkg_highlight_six'] 			!= null && 
			$data['pkg_highlight_six_arabic'] 	!= "" && $data['pkg_highlight_six_arabic'] 		!= null &&
			$data['pkg_highlight_seven'] 		!= "" && $data['pkg_highlight_seven'] 			!= null && 
			$data['pkg_highlight_seven_arabic'] != "" && $data['pkg_highlight_seven_arabic'] 	!= null &&
			$data['pkg_highlight_eight'] 		!= "" && $data['pkg_highlight_eight'] 			!= null && 
			$data['pkg_highlight_eight_arabic'] != "" && $data['pkg_highlight_eight_arabic'] 	!= null &&
			$data['pkg_details'] 				!= "" && $data['pkg_details'] 					!= null && 
			$data['pkg_details_arabic'] 		!= "" && $data['pkg_details_arabic'] 			!= null &&
			$data['pkg_image'] 					!= "" && $data['pkg_image'] 					!= null
		)
		{
			if(insert($data, 'tbl_packages'))
			{
				set_msg('Success','Package is added successfully','success');
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
		$package_id 						= post('txt_pkg_id');
		$data['pkg_name'] 					= post('txt_title');
		$data['pkg_name_arabic'] 			= $_POST['txt_title_arabic'];
		$data['pkg_description'] 			= $_POST['txt_short_desc'];
		$data['pkg_description_arabic'] 	= $_POST['txt_short_desc_arabic'];
		$data['pkg_highlight_one'] 			= post('txt_hightlight_one');
		$data['pkg_highlight_one_arabic'] 	= $_POST['txt_hightlight_one_arabic'];
		$data['pkg_highlight_two'] 			= post('txt_hightlight_two');
		$data['pkg_highlight_two_arabic'] 	= $_POST['txt_hightlight_two_arabic'];
		$data['pkg_highlight_three'] 		= post('txt_hightlight_three');
		$data['pkg_highlight_three_arabic'] = $_POST['txt_hightlight_three_arabic'];
		$data['pkg_highlight_four'] 		= post('txt_hightlight_four');
		$data['pkg_highlight_four_arabic'] 	= $_POST['txt_hightlight_four_arabic'];
		$data['pkg_highlight_five'] 		= post('txt_hightlight_five');
		$data['pkg_highlight_five_arabic'] 	= $_POST['txt_hightlight_five_arabic'];
		$data['pkg_highlight_six'] 			= post('txt_hightlight_six');
		$data['pkg_highlight_six_arabic'] 	= $_POST['txt_hightlight_six_arabic'];
		$data['pkg_highlight_seven'] 		= post('txt_hightlight_seven');
		$data['pkg_highlight_seven_arabic'] = $_POST['txt_hightlight_seven_arabic'];
		$data['pkg_highlight_eight'] 		= post('txt_hightlight_eight');
		$data['pkg_highlight_eight_arabic'] = $_POST['txt_hightlight_eight_arabic'];
		$data['pkg_details'] 				= $_POST['txt_pkg_detail'];
		$data['pkg_details_arabic'] 		= $_POST['txt_pkg_detail_arabic'];
		$image_name                 		= upload_image($_FILES,'txt_image', '../../upload/');
		if($image_name)
		{
		    $data['pkg_image'] 				= $image_name;
		}

		if(
			$data['pkg_name'] 					!= "" && $data['pkg_name'] 						!= null && 
			$data['pkg_name_arabic'] 			!= "" && $data['pkg_name_arabic'] 				!= null && 
			$data['pkg_description'] 			!= "" && $data['pkg_description'] 				!= null && 
			$data['pkg_description_arabic'] 	!= "" && $data['pkg_description_arabic'] 		!= null && 
			$data['pkg_highlight_one'] 			!= "" && $data['pkg_highlight_one'] 			!= null && 
			$data['pkg_highlight_one_arabic'] 	!= "" && $data['pkg_highlight_one_arabic'] 		!= null &&
			$data['pkg_highlight_two'] 			!= "" && $data['pkg_highlight_two'] 			!= null && 
			$data['pkg_highlight_two_arabic'] 	!= "" && $data['pkg_highlight_two_arabic'] 		!= null &&
			$data['pkg_highlight_three'] 		!= "" && $data['pkg_highlight_three'] 			!= null && 
			$data['pkg_highlight_three_arabic'] != "" && $data['pkg_highlight_three_arabic'] 	!= null &&
			$data['pkg_highlight_four'] 		!= "" && $data['pkg_highlight_four'] 			!= null && 
			$data['pkg_highlight_four_arabic'] 	!= "" && $data['pkg_highlight_four_arabic'] 	!= null &&
			$data['pkg_highlight_five'] 		!= "" && $data['pkg_highlight_five'] 			!= null && 
			$data['pkg_highlight_five_arabic'] 	!= "" && $data['pkg_highlight_five_arabic'] 	!= null &&
			$data['pkg_highlight_six'] 			!= "" && $data['pkg_highlight_six'] 			!= null && 
			$data['pkg_highlight_six_arabic'] 	!= "" && $data['pkg_highlight_six_arabic'] 		!= null &&
			$data['pkg_highlight_seven'] 		!= "" && $data['pkg_highlight_seven'] 			!= null && 
			$data['pkg_highlight_seven_arabic'] != "" && $data['pkg_highlight_seven_arabic'] 	!= null &&
			$data['pkg_highlight_eight'] 		!= "" && $data['pkg_highlight_eight'] 			!= null && 
			$data['pkg_highlight_eight_arabic'] != "" && $data['pkg_highlight_eight_arabic'] 	!= null &&
			$data['pkg_details'] 				!= "" && $data['pkg_details'] 					!= null && 
			$data['pkg_details_arabic'] 		!= "" && $data['pkg_details_arabic'] 			!= null
		)
		{
			where('pkg_id',$package_id);
			if(update($data, 'tbl_packages'))
			{
				set_msg('Success','Package is updated successfully','success');
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
			where('pkg_id',$pkg_id);
			if(delete('tbl_packages'))
			{
				set_msg('Success','Package is deleted successfully','success');
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