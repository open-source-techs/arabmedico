<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    
	if(isset($_POST['btn_save_cme']))
	{
		$data['cme_topic']          = $_POST['txt_cme_topic'];
		$data['cme_depart'] 		= $_POST['txt_cme_depart'];
		$data['cme_loc'] 			= $_POST['txt_cme_loc'];
		$data['cme_credits'] 		= $_POST['txt_credits'];
		$data['cme_delivery']       = post('cours_deli');
		$data['cme_time']           = $_POST['txt_time'];
		$data['cme_date']           = $_POST['txt_date'];
		$data['close_date']         = $_POST['closing_date'];
		$data['cme_duration']       = $_POST['txt_duration'];
		$data['cme_des']            = $_POST['txt_desc'];
		$data['cme_ar_topic'] 	    = $_POST['ar_cme_topic'];
		$data['cme_ar_depart']      = $_POST['txt_cme_depart_arabic'];
		$data['cme_ar_loc'] 		= $_POST['ar_cme_loc'];
		$data['cme_ar_credits'] 	= $_POST['ar_credits'];
		$data['cme_ar_delivery'] 	= $_POST['cours_deli_ar'];
		$data['cme_ar_time']        = $_POST['ar_time'];
		$data['cme_ar_date']        = $_POST['ar_date'];
		$data['cme_ar_duration']    = $_POST['ar_duration'];
		$data['cme_ar_des']         = $_POST['ar_desc'];
		$data['cme_organizer']     = post('txt_organizer');
		$image_name                	= upload_image($_FILES,'txt_cme_icon', '../../upload/');
		if($image_name)
		{
		    $data['cme_icon'] 	= $image_name;
		}
		else
		{
		    $data['cme_icon']  = '';
		}
		if(
		    $data['cme_topic'] 			!= "" &&    $data['cme_topic'] 		    != null &&
			$data['cme_depart'] 		!= "" &&    $data['cme_depart'] 		!= null &&
			$data['cme_loc'] 			!= "" &&    $data['cme_loc'] 	    	!= null &&
			$data['cme_credits'] 	    != "" &&    $data['cme_credits'] 		!= null &&
			$data['cme_delivery'] 		!= "" &&    $data['cme_delivery'] 		!= null &&
 			$data['cme_time'] 	        != "" &&    $data['cme_time'] 	        != null &&
			$data['cme_date'] 		    != "" &&    $data['cme_date'] 		    != null &&
			$data['close_date'] 		!= "" &&    $data['close_date'] 		!= null &&
 			$data['cme_duration'] 		!= "" &&    $data['cme_duration']       != null &&
 			$data['cme_des'] 		    != "" &&    $data['cme_des']            != null &&
 			$data['cme_ar_topic'] 	    != "" &&    $data['cme_ar_topic']       != null &&
 			$data['cme_ar_depart'] 		!= "" &&    $data['cme_ar_depart'] 		!= null &&
			$data['cme_ar_loc'] 		!= "" &&    $data['cme_ar_loc'] 		!= null &&
			$data['cme_ar_delivery'] 	!= "" &&    $data['cme_ar_delivery']   	!= null &&
			$data['cme_ar_time'] 	    != "" &&    $data['cme_ar_time'] 		!= null &&
			$data['cme_ar_date'] 		!= "" &&    $data['cme_ar_date'] 		!= null &&
 			$data['cme_ar_duration'] 	!= "" &&    $data['cme_ar_duration'] 	!= null &&
			$data['cme_ar_des'] 		!= "" &&    $data['cme_ar_des'] 		!= null 
		)
		{
		    
			if(insert($data,'tbl_cme'))
			{
				set_msg('Success','CME is added successfully','success');
				jump(admin_base_url()."my-cme");
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
	else if(isset($_POST['btn_edit_cme']))
	{
	    $cme_id 					= $_POST['txt_cme_id'];
	   	$data['cme_topic']          = $_POST['txt_cme_topic'];
		$data['cme_depart'] 		= $_POST['txt_cme_depart'];
		$data['cme_loc'] 			= $_POST['txt_cme_loc'];
		$data['cme_credits'] 		= $_POST['txt_credits'];
		$data['cme_delivery']       = post('cours_deli');
		$data['cme_time']           = $_POST['txt_time'];
		$data['cme_date']           = $_POST['txt_date'];
		$data['close_date']         = $_POST['closing_date'];
		$data['cme_duration']       = $_POST['txt_duration'];
		$data['cme_des']            = $_POST['txt_desc'];
		$data['cme_ar_topic'] 	    = $_POST['ar_cme_topic'];
		$data['cme_ar_depart']      = $_POST['txt_cme_depart_arabic'];
		$data['cme_ar_loc'] 		= $_POST['ar_cme_loc'];
		$data['cme_ar_credits'] 	= $_POST['ar_credits'];
		$data['cme_ar_delivery'] 	= $_POST['cours_deli_ar'];
		$data['cme_ar_time']        = $_POST['ar_time'];
		$data['cme_ar_date']        = $_POST['ar_date'];
		$data['cme_ar_duration']    = $_POST['ar_duration'];
		$data['cme_ar_des']         = $_POST['ar_desc'];
		$data['cme_organizer']     = post('txt_organizer');
		$image_name                	= upload_image($_FILES,'txt_cme_icon', '../../upload/');
		if($image_name)
		{
		    $data['cme_icon']         = $image_name;
		}
		if(
		    
		    $data['cme_topic'] 			!= "" &&    $data['cme_topic'] 		    != null &&
			$data['cme_depart'] 		!= "" &&    $data['cme_depart'] 		!= null &&
			$data['cme_loc'] 			!= "" &&    $data['cme_loc'] 	    	!= null &&
			$data['cme_credits'] 	    != "" &&    $data['cme_credits'] 		!= null &&
			$data['cme_delivery'] 		!= "" &&    $data['cme_delivery'] 		!= null &&
 			$data['cme_time'] 	        != "" &&    $data['cme_time'] 	        != null &&
			$data['cme_date'] 		    != "" &&    $data['cme_date'] 		    != null &&
			$data['close_date'] 		!= "" &&    $data['close_date'] 		!= null &&
 			$data['cme_duration'] 		!= "" &&    $data['cme_duration']       != null &&
 			$data['cme_des'] 		    != "" &&    $data['cme_des']            != null &&
 			$data['cme_ar_topic'] 	    != "" &&    $data['cme_ar_topic']       != null &&
 			$data['cme_ar_depart'] 		!= "" &&    $data['cme_ar_depart'] 		!= null &&
			$data['cme_ar_loc'] 		!= "" &&    $data['cme_ar_loc'] 		!= null &&
			$data['cme_ar_delivery'] 	!= "" &&    $data['cme_ar_delivery']   	!= null &&
			$data['cme_ar_time'] 	    != "" &&    $data['cme_ar_time'] 		!= null &&
			$data['cme_ar_date'] 		!= "" &&    $data['cme_ar_date'] 		!= null &&
 			$data['cme_ar_duration'] 	!= "" &&    $data['cme_ar_duration'] 	!= null &&
			$data['cme_ar_des'] 		!= "" &&    $data['cme_ar_des'] 		!= null 
		)
		{
			where('id',$cme_id);
			if(update($data,'tbl_cme'))
			{
				set_msg('Success','CME is updated successfully','success');
				jump(admin_base_url()."my-cme");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				echo "<script>window.history.go(-1);</script>";
			}
		}
		else
		{
			set_msg('Fields Error','Please fill required fields with data','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['action']) && $_POST['action'] == "update_message")
	{
	    $cmeId 		                = $_POST['jobID'];
		$data['cme_app_massage'] 	= $_POST['msg'];
		where('cme_app_id',$cmeId);
		if(update($data,'tbl_cme_application'))
		{
		    echo "done";
		}
		else
		{
			echo "error";
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
		if(isset($_GET['cme_id']) && $_GET['cme_id'] != "" && $_GET['cme_id'] != null && $_GET['cme_id'] > 0 )
		{
			$cme_id = $_GET['cme_id'];
			where('Id',$cme_id);
			if(delete('tbl_cme'))
			{
				set_msg('Success','Job is deleted successfully','success');
				jump(admin_base_url()."my-cme");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."my-cme");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."my-cme");
		}
	}
	else if(isset($_GET['act']) && $_GET['act'] == 'app_stat')
    {
        if(isset($_GET['app']) && $_GET['app'] != null && $_GET['app'] != '')
        {
            if(isset($_GET['val']) && $_GET['val'] != null && $_GET['val'] != '')
            {
                $value  = filter_this($_GET['val']);
                $app_id = filter_this($_GET['app']);
                $data['cme_app_status'] = $value;
                where('cme_app_id',$app_id);
                if(update($data, 'tbl_cme_application'))
                {
    				set_msg('Success','Registraion Status updated successfully','success');
    				jump(admin_base_url()."cme-registrations");
    			}
    			else
    			{
    				set_msg('Data Error','Unable to process your request. Please try again later.','error');
    				jump(admin_base_url()."cme-registrations");
    			}
            }
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