<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_gallery']))
	{
	    $data['gallery_department']     = post('txt_depart');
	    $data['gallery_is_video']       = post('txt_is_video');
	    $data['gallery_is_link']        = post('txt_is_link');
	    if($data['gallery_is_video'] == 1)
	    {
	        if($data['gallery_is_link'] == 1)
	        {
	            $data['gallery_video'] 		= $_POST['txt_embed_code'];
	        }
	        else
	        {
	            $image_name                 = upload_image($_FILES,'txt_video', '../../upload/');
        		if($image_name)
        		{
        		    $data['gallery_video'] 	= $image_name;
        		}
        		else
        		{
        		    $data['gallery_video'] = '';
        		}
	        }
	    }
	    else
	    {
	        $image_name                 	= upload_image($_FILES,'txt_image', '../../upload/');
    		if($image_name)
    		{
    		    $data['gallery_image'] 		= $image_name;
    		}
    		else
    		{
    		    $data['gallery_image'] = '';
    		}
	    }
		if(($data['gallery_is_video'] == 1 && $data['gallery_video'] != "" ) || ($data['gallery_is_video'] == 0 &&  $data['gallery_image'] != ""))
		{
			if(insert($data,'tbl_gallery'))
			{
				set_msg('Success','Gallery item is added successfully','success');
				jump(admin_base_url()."list-gallery");
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
	else if(isset($_POST['btn_edit_gallery']))
	{
		$gall_id 						= post('txt_id'); 
		$data['gallery_department']     = post('txt_depart');
	    $data['gallery_is_video']       = post('txt_is_video');
	    $data['gallery_is_link']        = post('txt_is_link');
	    $data['gallery_active']         = post('txt_is_active');
	    if($data['gallery_is_video'] == 1)
	    {
	        if($data['gallery_is_link'] == 1)
	        {
	            $data['gallery_video'] 		= $_POST['txt_embed_code'];
	        }
	        else
	        {
	            $image_name                 = upload_image($_FILES,'txt_video', '../../upload/');
        		if($image_name)
        		{
        		    $data['gallery_video'] 	= $image_name;
        		}
	        }
	    }
	    else
	    {
	        $image_name                 	= upload_image($_FILES,'txt_image', '../../upload/');
    		if($image_name)
    		{
    		    $data['gallery_image'] 		= $image_name;
    		}
	    }
	    where('gallery_id',$gall_id);
		if(update($data,'tbl_gallery'))
		{
			set_msg('Success','Gallery item is updated successfully','success');
			jump(admin_base_url()."list-gallery");
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
		if(isset($_GET['gal_id']) && $_GET['gal_id'] != "" && $_GET['gal_id'] != null && $_GET['gal_id'] > 0 )
		{
			$gal_id = $_GET['gal_id'];
			where('gallery_id',$gal_id);
			if(delete('tbl_gallery'))
			{
				set_msg('Success','Item is deleted successfully','success');
				jump(admin_base_url()."list-gallery");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."list-gallery");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."list-gallery");
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