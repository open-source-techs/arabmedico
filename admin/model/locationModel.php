<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_country']))
	{
		$data['country_name'] 		        = post('country_name');
		$data['country_name_ar'] 	    	= $_POST['country_name_ar'];
		$data['country_active'] 		    = $_POST['select_status'];
		if(
			$data['country_name'] 				!= "" && $data['country_name'] 			    != null && 
			$data['country_name_ar'] 	    	!= "" && $data['country_name_ar'] 	        != null && 
			$data['country_active'] 		    != "" && $data['country_active'] 	        != null
		)
		{
			if(insert($data,'tbl_country'))
			{
				set_msg('Success','country is added successfully','success');
				jump(admin_base_url()."list-country");
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
	else if(isset($_POST['btn_edit_country']))
	{
	    $country_id                        = post('country_id');
		$data['country_name'] 		        = post('country_name');
		$data['country_name_ar'] 	    	= $_POST['country_name_ar'];
		$data['country_active'] 		    = $_POST['select_status'];
// 		echo "<pre>";
// 	    print_r($data);
// 	    die();
	    where('country_id',$country_id);
		if(update2($data,'tbl_country'))
		{
			set_msg('Success','country is updated successfully','success');
			jump(admin_base_url()."list-country");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	
	//CITY MODEL
	
	else if(isset($_POST['btn_save_city']))
	{
		$data['city_name'] 		        = post('city_name');
		$data['city_name_ar'] 	    	= $_POST['city_name_ar'];
		$data['city_active'] 		    = $_POST['select_status'];
		$data['city_country'] 		    = $_POST['select_country'];
		if(
			$data['city_name'] 				!= "" && $data['city_name'] 			!= null && 
			$data['city_name_ar'] 	    	!= "" && $data['city_name_ar'] 	        != null &&
			$data['city_country'] 	    	!= "" && $data['city_country'] 	        != null &&
			$data['city_active'] 		    != "" && $data['city_active'] 	        != null
		)
		{
			if(insert($data,'tbl_cities'))
			{
				set_msg('Success','city is added successfully','success');
				jump(admin_base_url()."list-city");
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
	else if(isset($_POST['btn_edit_city']))
	{
	    $city_id                        = post('city_id');
		$data['city_name'] 		        = post('city_name');
		$data['city_name_ar'] 	    	= $_POST['city_name_ar'];
		$data['city_active'] 		    = $_POST['select_status'];
		$data['city_country'] 		    = $_POST['select_country'];
// 		echo "<pre>";
// 	    print_r($data);
// 	    die();
	    where('city_id',$city_id);
		if(update2($data,'tbl_cities'))
		{
			set_msg('Success','city is updated successfully','success');
			jump(admin_base_url()."list-city");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	
	//AREA MODEL
	
	else if(isset($_POST['btn_save_area']))
	{
		$data['area_name'] 		        = post('area_name');
		$data['area_name_ar'] 	    	= $_POST['area_name_ar'];
		$data['area_active'] 		    = $_POST['select_status'];
		$data['area_city'] 		        = $_POST['select_city'];
		if(
			$data['area_name'] 				!= "" && $data['area_name'] 			!= null && 
			$data['area_name_ar'] 	    	!= "" && $data['area_name_ar'] 	        != null &&
			$data['area_city'] 	    	    != "" && $data['area_city'] 	        != null &&
			$data['area_active'] 		    != "" && $data['area_active'] 	        != null
		)
		{
			if(insert($data,'tbl_areas'))
			{
				set_msg('Success','area is added successfully','success');
				jump(admin_base_url()."list-area");
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
	else if(isset($_POST['btn_edit_area']))
	{
	    $area_id                        = post('area_id');
		$data['area_name'] 		        = post('area_name');
		$data['area_name_ar'] 	    	= $_POST['area_name_ar'];
		$data['area_active'] 		    = $_POST['select_status'];
		$data['area_city'] 		        = $_POST['select_city'];
// 		echo "<pre>";
// 	    print_r($data);
// 	    die();
	    where('area_id',$area_id);
		if(update2($data,'tbl_areas'))
		{
			set_msg('Success','area is updated successfully','success');
			jump(admin_base_url()."list-area");
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
	if(isset($_GET['act_country']) && $_GET['act_country'] == "del")
	{
		if(isset($_GET['country_id']) && $_GET['country_id'] != "" && $_GET['country_id'] != null && $_GET['country_id'] > 0 )
		{
			$country = $_GET['country_id'];
			where('country_id',$country);
			if(delete('tbl_country'))
			{
				set_msg('Success','country is deleted successfully','success');
				jump(admin_base_url()."list-country");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."list-country");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."list-country");
		}
	}
	
	// CITY MODEL
	
	else if(isset($_GET['act_city']) && $_GET['act_city'] == "del")
	{
		if(isset($_GET['city_id']) && $_GET['city_id'] != "" && $_GET['city_id'] != null && $_GET['city_id'] > 0 )
		{
			$city = $_GET['city_id'];
			where('city_id',$city);
			if(delete('tbl_cities'))
			{
				set_msg('Success','city is deleted successfully','success');
				jump(admin_base_url()."list-city");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."list-city");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."list-city");
		}
	}
	
	// AREA MODEL
	
	else if(isset($_GET['act_area']) && $_GET['act_area'] == "del")
	{
		if(isset($_GET['area_id']) && $_GET['area_id'] != "" && $_GET['area_id'] != null && $_GET['area_id'] > 0 )
		{
			$area = $_GET['area_id'];
			where('area_id',$area);
			if(delete('tbl_areas'))
			{
				set_msg('Success','area is deleted successfully','success');
				jump(admin_base_url()."list-area");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."list-area");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."list-area");
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