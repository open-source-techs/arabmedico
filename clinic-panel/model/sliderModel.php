<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_slide']))
	{
	    $data['slider_is_video']       = post('txt_is_video');
	    $data['slider_is_link']        = post('txt_is_link');
	    $data['slider_clinic']         = post('txt_clinic_id');
	    if($data['slider_is_video'] == 1)
	    {
	        if($data['slider_is_link'] == 1)
	        {
	            $data['slide_video'] 		= $_POST['txt_embed_code'];
	            $data['slide_video_ar'] 	= $_POST['txt_embed_code_ar'];
	        }
	        else
	        {
	            $image_name                 = upload_image($_FILES,'txt_video', '../../upload/');
        		if($image_name)
        		{
        		    $data['slide_video'] 	= $image_name;
        		    
        		}
        		else
        		{
        		    $data['slide_video'] = '';
        		}
        		
        		$image_name1                 = upload_image($_FILES,'txt_video_ar', '../../upload/');
        		if($image_name1)
        		{
        		    $data['slide_video_ar'] 	= $image_name1;
        		    
        		}
        		else
        		{
        		    $data['slide_video_ar'] = '';
        		}
        		
	        }
	       // echo "<pre>";
	       // print_r($data);
	       // die();
	        if(insert2($data, 'tbl_clinic_slider'))
			{
				set_msg('Success','Slide is added successfully','success');
				jump(admin_base_url()."slider");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				echo "<script>window.history.go(-1);</script>";
			}
	    }
	    else
	    {
	        $data['slider_is_link']     = 0;
    		$data['slider_text'] 		= post('txt_title');
    		$data['slider_text_arabic'] = $_POST['txt_title_arabic'];
    		$data['slider_desc'] 		= $_POST['txt_short_desc'];
    		$data['slider_desc_arabic'] = $_POST['txt_short_desc_arabic'];
    		$data['slider_clinic']      = post('txt_clinic_id');
    		$image_name          		= upload_image($_FILES,'txt_image', '../../upload/');
    		if($image_name)
    		{
    		    $data['slider_image'] 	= $image_name;
    		}
    		else
    		{
    		    $data['slider_image']  = '';
    		}
    		$image_name1          		 = upload_image($_FILES,'txt_image_ar', '../../upload/');
    		if($image_name1)
    		{
    		    $data['slider_image_ar'] = $image_name1;
    		}
    		else
    		{
    		    $data['slider_image_ar'] = '';
    		}
    		if(
    			$data['slider_image'] 		!= null && $data['slider_image'] 		!= "" && 
    			$data['slider_image_ar'] 	!= null && $data['slider_image_ar'] 	!= "" && 
    			$data['slider_text'] 		!= null && $data['slider_text'] 		!= "" && 
    			$data['slider_text_arabic'] != null && $data['slider_text_arabic'] 	!= "" && 
    			$data['slider_desc'] 		!= null && $data['slider_desc'] 		!= "" &&
    			$data['slider_desc_arabic'] != null && $data['slider_desc_arabic'] 	!= ""
    		)
    		{
    			if(insert2($data, 'tbl_clinic_slider'))
    			{
    				set_msg('Success','Slide is added successfully','success');
    				jump(admin_base_url()."slider");
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
	else if(isset($_POST['btn_edit_slide']))
	{
		$slider_id 			 		= post('txt_id');
		$data['slider_is_video']    = post('txt_is_video');
	    $data['slider_is_link']     = post('txt_is_link');
	    $data['slider_clinic']         = post('txt_clinic_id');
	    if($data['slider_is_video'] == 1)
	    {
	        if($data['slider_is_link'] == 1)
	        {
	            $data['slide_video'] 		= $_POST['txt_embed_code'];
	            $data['slide_video_ar'] 	= $_POST['txt_embed_code_ar'];
	        }
	        else
	        {
	            $image_name                 = upload_image($_FILES,'txt_video', '../../upload/');
        		if($image_name)
        		{
        		    $data['slide_video'] 	= $image_name;
        		    
        		}
        		$image_name1                 = upload_image($_FILES,'txt_video_ar', '../../upload/');
        		if($image_name1)
        		{
        		    $data['slide_video_ar'] 	= $image_name1;
        		    
        		}
	        }
	        where('slider_id',$slider_id);
    		if(update2($data, 'tbl_clinic_slider'))
			{
				set_msg('Success','Slide is added successfully','success');
				jump(admin_base_url()."slider");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				echo "<script>window.history.go(-1);</script>";
			}
	    }
	    else
	    {
    		$data['slider_text'] 		= post('txt_title');
    		$data['slider_text_arabic'] = $_POST['txt_title_arabic'];
    		$data['slider_desc'] 		= $_POST['txt_short_desc'];
    		$data['slider_desc_arabic'] = $_POST['txt_short_desc_arabic'];
    		$data['slider_clinic']      = post('txt_clinic_id');
    		$image_name                 = upload_image($_FILES,'txt_image', '../../upload/');
    		if($image_name)
    		{
    		    $data['slider_image'] 	= $image_name;
    		}
            $image_name1          		= upload_image($_FILES,'txt_image_ar', '../../upload/');
    		if($image_name1)
    		{
    		    $data['slider_image_ar'] = $image_name1;
    		}
    		
    		if(
    			$data['slider_text'] 		!= null && $data['slider_text'] 		!= "" && 
    			$data['slider_text_arabic'] != null && $data['slider_text_arabic'] 	!= "" && 
    			$data['slider_desc'] 		!= null && $data['slider_desc'] 		!= "" &&
    			$data['slider_desc_arabic'] != null && $data['slider_desc_arabic'] 	!= ""
    		)
    		{
    			where('slider_id',$slider_id);
    			if(update($data, 'tbl_clinic_slider'))
    			{
    				set_msg('Success','Slide is updated successfully','success');
    				jump(admin_base_url()."slider");
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
	else if(isset($_POST['action']) && $_POST['action'] == "change_status")
	{
	    $value = post('val');
	    $slide = post('sl_id');
	    $clinicId = post('clinic');
	    if($value == "deactive")
	    {
	        $sql = query("UPDATE tbl_clinic_slider SET slider_video_show = 0 WHERE slider_clinic = $clinicId");
	        if($sql)
	        {
	            $arr = array(
	                "status" => "done",
	                "responce" => "Successfully deactived all videos to show on home",
                );
	        }
	        {
				$arr = array(
	                "status" => "error",
	                "responce" => "Unable to process your request",
                );
			}
	    }
	    else if($value == "active")
	    {
	        $sql = query("UPDATE tbl_clinic_slider SET slider_video_show = 0 WHERE slider_clinic = $clinicId");
	        if($sql)
	        {
	            $data1['slider_video_show'] = 1;
	            where('slider_id',$slide);
	            if(update($data1, 'tbl_clinic_slider'))
    			{
    				$arr = array(
    	                "status" => "done",
    	                "responce" => "Video is successfully updated to show on home",
                    );
    			}
    			else
    			{
    				$arr = array(
    	                "status" => "error",
    	                "responce" => "Unable to process your request",
                    );
    			}
	        }
	        else
	        {
				$arr = array(
	                "status" => "error",
	                "responce" => " abc Unable to process your request",
                );
			}
	    }
	    echo json_encode($arr);
	    
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
		if(isset($_GET['sl_id']) && $_GET['sl_id'] != "" && $_GET['sl_id'] != null && $_GET['sl_id'] > 0 )
		{
			$sl_id = $_GET['sl_id'];
			where('slider_id',$sl_id);
			if(delete('tbl_clinic_slider'))
			{
				set_msg('Success','Sldier is deleted successfully','success');
				jump(admin_base_url()."slider");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."slider");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."slider");
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