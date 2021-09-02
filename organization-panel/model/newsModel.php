<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_news']))
	{
	    $data['news_title']             = post('txt_news_name');
	    $data['news_category']          = post('txt_depart');
	    $data['news_title_arabic']      = $_POST['txt_news_name_arabic'];
	    $data['news_short_desc']        = $_POST['txt_short_desc'];
	    $data['news_short_desc_arabic'] = $_POST['txt_short_desc_arabic'];
	    $data['news_detail']            = $_POST['txt_desc'];
	    $data['news_detail_arabic']     = $_POST['txt_desc_arabic'];
	    $data['news_meta_title'] 		= post('txt_meta_title');
		$data['news_meta_title_ar'] 	= $_POST['txt_meta_title_ar'];
		$data['news_meta_tag'] 			= post('txt_tag');
		$data['news_meta_tag_ar'] 		= $_POST['txt_tag_ar'];
		$data['news_meta_desc'] 		= post('txt_meta_desc');
		$data['news_meta_desc_ar'] 		= $_POST['txt_meta_desc_ar'];
		$data['news_user_type'] 		= 'organizations';
		$data['news_user_id'] 			= get_sess("userdata")['organization_id'];
		$image_name                 	= upload_image($_FILES,'txt_image', '../../upload/');
		if($image_name)
		{
		    $data['news_image'] 		= $image_name;
		}
		else
		{
		    $data['news_image']  		= '';
		}


		$slug 							= strtolower(post('txt_slug'));

		if(checkUniqueCol('tbl_url','url_suffex',$slug))
		{
			$data['news_slug'] 			= $slug;
			if(
				$data['news_title'] 			!= "" && $data['news_title'] 			    != null && 
				$data['news_title_arabic'] 		!= "" && $data['news_title_arabic'] 	    != null && 
				$data['news_short_desc'] 		!= "" && $data['news_short_desc'] 	        != null && 
				$data['news_short_desc_arabic'] != "" && $data['news_short_desc_arabic'] 	!= null && 
				$data['news_detail'] 		    != "" && $data['news_detail'] 	            != null && 
				$data['news_detail_arabic'] 	!= "" && $data['news_detail_arabic'] 	    != null && 
				$data['news_image']             != "" && $data['news_image'] 	            != null
			)
			{
				if(insert2($data,'tbl_news'))
				{
					$URLdata['url_suffex']  = $slug;
    			    $URLdata['url_type']    = 'Post';
    			    insert($URLdata,'tbl_url');
					set_msg('Success','News is added successfully','success');
					jump(admin_base_url()."news");
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
			set_msg('Fields validation','URL already registered','error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_edit_news']))
	{
		$news_id 						= post('txt_id'); 
		$data['news_title']             = post('txt_news_name');
		$data['news_category']          = post('txt_depart');
	    $data['news_title_arabic']      = $_POST['txt_news_name_arabic'];
	    $data['news_short_desc']        = $_POST['txt_short_desc'];
	    $data['news_short_desc_arabic'] = $_POST['txt_short_desc_arabic'];
	    $data['news_detail']            = $_POST['txt_desc'];
	    $data['news_detail_arabic']     = $_POST['txt_desc_arabic'];
	    $data['news_active']            = $_POST['txt_is_active'];
	    $data['news_meta_title'] 		= post('txt_meta_title');
		$data['news_meta_title_ar'] 	= $_POST['txt_meta_title_ar'];
		$data['news_meta_tag'] 			= post('txt_tag');
		$data['news_meta_tag_ar'] 		= $_POST['txt_tag_ar'];
		$data['news_meta_desc'] 		= post('txt_meta_desc');
		$data['news_meta_desc_ar'] 		= $_POST['txt_meta_desc_ar'];
		$image_name                 	= upload_image($_FILES,'txt_image', '../../upload/');
		if($image_name)
		{
		    $data['news_image'] 		= $image_name;
		}
		$previousSlug                   = post('previous_slug');
        $currentSlug                    = post('txt_dpt_url');
        $slugUpdate                     = false;
        if($previousSlug != $currentSlug)
        {
            if(checkUniqueCol('tbl_url','url_suffex',$currentSlug, true, 'url_suffex', $previousSlug ))
    		{
            	$slugUpdate             = true;
    		    $data['news_slug']    	= $currentSlug;
    		}
        }
		if(
			$data['news_title'] 			!= "" && $data['news_title'] 			    != null && 
			$data['news_title_arabic'] 		!= "" && $data['news_title_arabic'] 	    != null && 
			$data['news_short_desc'] 		!= "" && $data['news_short_desc'] 	        != null && 
			$data['news_short_desc_arabic'] != "" && $data['news_short_desc_arabic'] 	!= null && 
			$data['news_detail'] 		    != "" && $data['news_detail'] 	            != null && 
			$data['news_detail_arabic'] 	!= "" && $data['news_detail_arabic'] 	    != null
		)
		{
			where('news_id',$news_id);
			if(update2($data,'tbl_news'))
			{
				if($slugUpdate)
			    {
			        $URLdata['url_suffex']  = $currentSlug;
    			    $URLdata['url_type']    = 'Post';
    			    where('url_suffex',$previousSlug);
    			    update($URLdata,'tbl_url');
			    }
				set_msg('Success','News is updated successfully','success');
				jump(admin_base_url()."news");
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
		if(isset($_GET['news_id']) && $_GET['news_id'] != "" && $_GET['news_id'] != null && $_GET['news_id'] > 0 )
		{
			$news_id = $_GET['news_id'];
			where('news_id',$news_id);
			if(delete('tbl_news'))
			{
				set_msg('Success','News is deleted successfully','success');
				jump(admin_base_url()."news");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."news");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."news");
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