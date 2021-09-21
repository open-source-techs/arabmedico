<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(isset($_POST['btn_save_doc']))
    {
        $data['doc_hospital']         = post('hospital_id');
	    $data['doc_name']           = post('txt_doc_name');
	    $data['doc_name_ar']        = $_POST['txt_doc_name_ar'];
	    $data['doc_degree']         = post('txt_doc_degree');
	    $data['doc_degree_ar']      = $_POST['txt_doc_degree_ar'];
	    $data['doc_regNo']          = post('txt_doc_regno');
	    $data['doc_regNo_ar']       = changeNumberToArabic($data['doc_regNo']);
	    $data['doc_designation']    = post('txt_doc_designation');
	    $data['doc_designation_ar'] = $_POST['txt_doc_designation_ar'];
	    $image_name                 = upload_image($_FILES,'doc_image', '../../upload/');
		if($image_name)
		{
		    $data['doc_image'] 	    = $image_name;
		}
		else
		{
		    $data['doc_image'] 	    = "";
		}
		
		if(
		    $data['doc_hospital']         != null && $data['doc_hospital']          != "" &&
    	    $data['doc_name']           != null && $data['doc_name']            != "" &&
    	    $data['doc_name_ar']        != null && $data['doc_name_ar']         != "" &&
    	    $data['doc_degree']         != null && $data['doc_degree']          != "" &&
    	    $data['doc_degree_ar']      != null && $data['doc_degree_ar']       != "" &&
    	    $data['doc_regNo']          != null && $data['doc_regNo']           != "" &&
    	    $data['doc_regNo_ar']       != null && $data['doc_regNo_ar']        != "" &&
    	    $data['doc_designation']    != null && $data['doc_designation']     != "" &&
    	    $data['doc_designation_ar'] != null && $data['doc_designation_ar']  != "" &&
    	    $data['doc_image']          != null && $data['doc_image']           != ""
        )
		{
		    if(insert($data, 'tbl_hospital_doc'))
    	    {
    			set_msg('Success','Doctor is added successfully','success');
    			jump(admin_base_url()."all-doctor");
    		}
    		else
    		{
    			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
    			echo "<script>window.history.go(-1);</script>";
    		}
		}
		else
		{
		    set_msg('Insertion error','Please enter all required fields','error');
    		echo "<script>window.history.go(-1);</script>";
		}
    }
    else if(isset($_POST['btn_edit_doc']))
    {
        $doc_id                     = post('doctor_id');
        $data['doc_hospital']         = post('hospital_id');
	    $data['doc_name']           = post('txt_doc_name');
	    $data['doc_name_ar']        = $_POST['txt_doc_name_ar'];
	    $data['doc_degree']         = post('txt_doc_degree');
	    $data['doc_degree_ar']      = $_POST['txt_doc_degree_ar'];
	    $data['doc_regNo']          = post('txt_doc_regno');
	    $data['doc_regNo_ar']       = changeNumberToArabic($data['doc_regNo']);
	    $data['doc_designation']    = post('txt_doc_designation');
	    $data['doc_designation_ar'] = $_POST['txt_doc_designation_ar'];
	    $image_name                 = upload_image($_FILES,'doc_image', '../../upload/');
		if($image_name)
		{
		    $data['doc_image'] 	    = $image_name;
		}
		
		if(
		    $data['doc_hospital']         != null && $data['doc_hospital']          != "" &&
    	    $data['doc_name']           != null && $data['doc_name']            != "" &&
    	    $data['doc_name_ar']        != null && $data['doc_name_ar']         != "" &&
    	    $data['doc_degree']         != null && $data['doc_degree']          != "" &&
    	    $data['doc_degree_ar']      != null && $data['doc_degree_ar']       != "" &&
    	    $data['doc_regNo']          != null && $data['doc_regNo']           != "" &&
    	    $data['doc_regNo_ar']       != null && $data['doc_regNo_ar']        != "" &&
    	    $data['doc_designation']    != null && $data['doc_designation']     != "" &&
    	    $data['doc_designation_ar'] != null && $data['doc_designation_ar']  != "" 
        )
		{
		    where('doc_id',$doc_id);
		    if(update($data, 'tbl_hospital_doc'))
    	    {
    			set_msg('Success','Doctor is updated successfully','success');
    			jump(admin_base_url()."all-doctor");
    		}
    		else
    		{
    			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
    			echo "<script>window.history.go(-1);</script>";
    		}
		}
		else
		{
		    set_msg('Insertion error','Please enter all required fields','error');
    		echo "<script>window.history.go(-1);</script>";
		}
    }
	else if(isset($_POST['btn_add_location']))
	{
	    $data['loc_hospital_id']      = post('hospital_id');
	    $data['loc_name']           = post('txt_name');
	    $data['loc_name_ar']        = $_POST['txt_name_arabic'];
	    $data['loc_building']       = post('txt_building');
	    $data['loc_building_ar']    = $_POST['txt_building_ar'];
	    $data['loc_address']        = post('txt_street_add');
	    $data['loc_address_ar']     = $_POST['txt_street_add_ar'];
	    $data['loc_zip']            = post('txt_zip');
	    $data['loc_country']        = post('txt_country');
	    $data['loc_city']           = post('txt_city');
	    $data['loc_area']           = post('txt_area');
	    $data['loc_email']          = post('txt_email');
	    $data['loc_number']         = post('txt_number');
	    $data['loc_number_ar']      = changeNumberToArabic($data['loc_number']);
	    
	    if(insert($data, 'tbl_hospital_loc'))
	    {
			set_msg('Success','Location is added successfully','success');
			jump(admin_base_url()."all-location");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}
	    
	}
	else if(isset($_POST['btn_edit_location']))
	{
	    $location                   = post('txt_loc_id');
	    $data['loc_hospital_id']      = post('hospital_id');
	    $data['loc_name']           = post('txt_name');
	    $data['loc_name_ar']        = $_POST['txt_name_arabic'];
	    $data['loc_building']       = post('txt_building');
	    $data['loc_building_ar']    = $_POST['txt_building_ar'];
	    $data['loc_address']        = post('txt_street_add');
	    $data['loc_address_ar']     = $_POST['txt_street_add_ar'];
	    $data['loc_zip']            = post('txt_zip');
	    $data['loc_country']        = post('txt_country');
	    $data['loc_city']           = post('txt_city');
	    $data['loc_area']           = post('txt_area');
	    $data['loc_email']          = post('txt_email');
	    $data['loc_number']         = post('txt_number');
	    $data['loc_number_ar']      = changeNumberToArabic($data['loc_number']);
        where('loc_id',$location);
	    if(update($data, 'tbl_hospital_loc'))
	    {
			set_msg('Success','Location is updated successfully','success');
			jump(admin_base_url()."all-location");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}
	    
	}
	else if(isset($_POST['btn_upload_logo']))
	{
	    $doctor_id 							= post('txt_doc_id');
	    $image_name                 		= upload_image($_FILES,'txt_image', '../../upload/');
		if($image_name)
		{
		    $data['doc_logo'] 				= $image_name;
		    where('doc_id ',$doctor_id);
    		if(update($data,'tbl_doctor'))
    		{
    			set_msg('Success','Logo is updated successfully','success');
    			jump(admin_base_url()."branding");
    		}
    		else
    		{
    			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
    			echo "<script>window.history.go(-1);</script>";
    		}
		}
		else
		{
		    set_msg('Upload error','Unable to upload image. Please try again later.','error');
    			echo "<script>window.history.go(-1);</script>";
		}
		
	}
	else if(isset($_POST['action']) && $_POST['action'] == "getcities")
	{
	    $countryID = post('countryID');
	    $sql = query("SELECT * FROM tbl_cities WHERE city_country = '$countryID' AND city_active = 1");
	    if(nrows($sql) > 0)
	    {
	        $res_arr = array();
	        while($val = fetch($sql))
	        {
	            $res_arr[] = $val;
	        }
	        $res = array(
	            "msg" => "success",
	            "data" => $res_arr
            );
	    }
	    else
	    {
	        $res = array(
	            "msg" => "error",
	            "data" => null
            );
	    }
	    echo json_encode($res);
	}
	else if(isset($_POST['action']) && $_POST['action'] == "getarea")
	{
	    $cityID = post('cityID');
	    $sql = query("SELECT * FROM tbl_areas WHERE area_city = '$cityID' AND area_active = 1");
	    if(nrows($sql) > 0)
	    {
	        $res_arr = array();
	        while($val = fetch($sql))
	        {
	            $res_arr[] = $val;
	        }
	        $res = array(
	            "msg" => "success",
	            "data" => $res_arr
            );
	    }
	    else
	    {
	        $res = array(
	            "msg" => "error",
	            "data" => null
            );
	    }
	    echo json_encode($res);
	}
	
	
	else if(isset($_POST['btn_upload_image']))
	{
	    $data['gall_hospital'] 	= post('txt_hospital_id');
		$image_name             = upload_image($_FILES,'txt_image', '../../upload/');
		if($image_name)
		{
		    $data['gall_img'] 	= $image_name;
		    if(insert($data,'tbl_hospital_gallery'))
    		{
    			set_msg('Success','Photo is uploaded successfully','success');
    			jump(admin_base_url()."photo-gallery");
    		}
    		else
    		{
    			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
    			echo "<script>window.history.go(-1);</script>";
    		}	
		}
		else
		{
		    set_msg('Upload error','Unable to upload photo. Please try again later.','error');
    		echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_video_image']))
	{
	    $data['video_hospital']   = post('txt_hospital_id');
	    $data['video_code']     = post('txt_video');
	    if(insert($data,'tbl_hospital_video'))
		{
			set_msg('Success','Video is uploaded successfully','success');
			jump(admin_base_url()."video-gallery");
		}
		else
		{
			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
			echo "<script>window.history.go(-1);</script>";
		}	
	}
	else if(isset($_POST['btn_upload_award']))
	{
	    $data['doc_award_doc'] 	= post('txt_doc_id');
		$image_name                 = upload_image($_FILES,'txt_award', '../../upload/');
		if($image_name)
		{
		    $data['doc_award_image'] 	= $image_name;
		    if(insert($data,'tbl_doc_awards'))
    		{
    			set_msg('Success','Award Image is uploaded successfully','success');
    			jump(admin_base_url()."branding");
    		}
    		else
    		{
    			set_msg('Insertion error','Unable to process your request. Please try again later.','error');
    			echo "<script>window.history.go(-1);</script>";
    		}	
		}
		else
		{
		    set_msg('Upload error','Unable to upload photo. Please try again later.','error');
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
	if(isset($_GET['act']) && $_GET['act'] == "del-loc")
	{
	    if(isset($_GET['loc_id']) && $_GET['loc_id'] != "" && $_GET['loc_id'] != null && $_GET['loc_id'] > 0 )
	    {
	        $loc_id = $_GET['loc_id'];
			where('loc_id',$loc_id);
			if(delete('tbl_hospital_loc'))
			{
			    set_msg('Success','Location is deleted successfully','success');
			    jump(admin_base_url()."all-location");
			}
			else
			{
			    set_msg('Query Error','Unable to process your request. Please try again later','error');
			    jump(admin_base_url()."all-location");
			}
	    }
	    else
	    {
	        set_msg('Data Error','No Record Found','error');
	        jump(admin_base_url()."all-location");
	    }
	}
	else if(isset($_GET['act']) && $_GET['act'] == "del-doc")
	{
	    if(isset($_GET['doc_id']) && $_GET['doc_id'] != "" && $_GET['doc_id'] != null && $_GET['doc_id'] > 0 )
	    {
	        $doc_id = $_GET['doc_id'];
			where('doc_id',$doc_id);
			if(delete('tbl_hospital_doc'))
			{
			    set_msg('Success','Doctor is deleted successfully','success');
			    jump(admin_base_url()."all-doctor");
			}
			else
			{
			    set_msg('Query Error','Unable to process your request. Please try again later','error');
			    jump(admin_base_url()."all-doctor");
			}
	    }
	    else
	    {
	        set_msg('Data Error','No Record Found','error');
	        jump(admin_base_url()."all-doctor");
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