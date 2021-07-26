<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_org']))
	{
		$data['organization_name'] 			= post('txt_org_name');
		$data['organization_name_ar'] 		= $_POST['txt_org_name_ar'];
		$data['organization_phone'] 		= post('txt_org_phone');
		$data['organization_phone_ar'] 		= changeNumberToArabic(post('txt_org_phone'));
		$data['organization_address'] 		= post('txt_org_address');
		$data['organization_address_ar'] 	= $_POST['txt_org_address_ar'];
		$data['organization_country'] 		= post('txt_country');
		$data['organization_area'] 			= post('txt_area');
		$data['organization_city'] 			= post('txt_city');
		$data['organization_meta_title'] 	= post('txt_meta_title');
		$data['organization_meta_title_ar'] = $_POST['txt_meta_title_ar'];
		$data['organization_meta_tag'] 		= post('txt_tag');
		$data['organization_meta_tag_ar'] 	= $_POST['txt_tag_ar'];
		$data['organization_meta_desc'] 	= post('txt_meta_desc');
		$data['organization_meta_desc_ar'] 	= $_POST['txt_meta_desc_ar'];
		$slug 								= post('txt_org_url');
		$username 	                		= post('txt_username');
		if(checkUniqueCol('tbl_url','url_suffex',$slug))
		{
			$data['organization_slug']    	= $slug;
			if(checkUniqueCol('tbl_organization','organization_username',$username))
        	{
        		$data['organization_username'] 	= $username;
    		    $data['organization_password'] 	= encrypt(post('txt_password'));
        		$image_name                 	= upload_image($_FILES,'txt_icon', '../../upload/');
        		if($image_name)
        		{
        		    $data['organization_icon'] 	= $image_name;
        		}
        		else
        		{
        		    $data['organization_icon']    = '';
        		}
        		if(
        			$data['organization_name'] 	    	!= "" && $data['organization_name'] 		!= null &&
        			$data['organization_name_ar']     	!= "" && $data['organization_name_ar'] 		!= null &&
        			$data['organization_phone'] 	    != "" && $data['organization_phone'] 		!= null &&
        			$data['organization_phone_ar'] 		!= "" && $data['organization_phone_ar'] 	!= null &&
        			$data['organization_address'] 		!= "" && $data['organization_address'] 		!= null &&
        			$data['organization_address_ar'] 	!= "" && $data['organization_address_ar'] 	!= null &&
        			$data['organization_country'] 		!= "" && $data['organization_country'] 		!= null &&
        			$data['organization_area'] 	    	!= "" && $data['organization_area'] 		!= null &&
        			$data['organization_city'] 	    	!= "" && $data['organization_city']       	!= null &&
        			$data['organization_username']    	!= "" && $data['organization_username'] 	!= null &&
        			$data['organization_password'] 		!= "" && $data['organization_password'] 	!= null &&
        			$data['organization_icon'] 	    	!= "" && $data['organization_icon'] 		!= null
        		)
        		{
        			if(insert2($data,'tbl_organization'))
        			{
        			    $URLdata['url_suffex']  = $slug;
        			    $URLdata['url_type']    = 'organization';
        			    insert($URLdata,'tbl_url');
        				set_msg('Success','Organization is added successfully','success');
        				jump(admin_base_url()."list-organization");
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
    			set_msg('Username Error','Username already exists','error');
    			echo "<script>window.history.go(-1);</script>";
    		}
		}
		else
		{
		    set_msg('URL Error','URL is already registered','error');
    		echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['btn_edit_org']))
	{
		$cer_id 							= post('org_id');
		$data['organization_name'] 			= post('txt_org_name');
		$data['organization_name_ar'] 		= $_POST['txt_org_name_ar'];
		$data['organization_phone'] 		= post('txt_org_phone');
		$data['organization_phone_ar'] 		= changeNumberToArabic(post('txt_org_phone'));
		$data['organization_address'] 		= post('txt_org_address');
		$data['organization_address_ar'] 	= $_POST['txt_org_address_ar'];
		$data['organization_country'] 		= post('txt_country');
		$data['organization_area'] 			= post('txt_area');
		$data['organization_city'] 			= post('txt_city');
		$data['organization_meta_title'] 	= post('txt_meta_title');
		$data['organization_meta_title_ar'] = $_POST['txt_meta_title_ar'];
		$data['organization_meta_tag'] 		= post('txt_tag');
		$data['organization_meta_tag_ar'] 	= $_POST['txt_tag_ar'];
		$data['organization_meta_desc'] 	= post('txt_meta_desc');
		$data['organization_meta_desc_ar'] 	= $_POST['txt_meta_desc_ar'];
		$data['organization_active'] 	    = post('txt_status');
		$image_name                 		= upload_image($_FILES,'txt_icon', '../../upload/');
		if($image_name)
		{
		    $data['organization_icon'] 		= $image_name;
		}
        $previousSlug               		= post('previous_slug');
        $currentSlug                		= post('txt_org_url');
        $slugUpdate                 		= false;
        if($previousSlug != $currentSlug)
        {
            $slugUpdate             		= true;
            if(checkUniqueCol('tbl_url','url_suffex',$currentSlug, true, 'url_suffex', $previousSlug ))
    		{
    		    $data['organization_slug']  = $currentSlug;
    		}
        }
        if(
			$data['organization_name'] 	    	!= "" && $data['organization_name'] 		!= null &&
			$data['organization_name_ar']     	!= "" && $data['organization_name_ar'] 		!= null &&
			$data['organization_phone'] 	    != "" && $data['organization_phone'] 		!= null &&
			$data['organization_phone_ar'] 		!= "" && $data['organization_phone_ar'] 	!= null &&
			$data['organization_address'] 		!= "" && $data['organization_address'] 		!= null &&
			$data['organization_address_ar'] 	!= "" && $data['organization_address_ar'] 	!= null &&
			$data['organization_country'] 		!= "" && $data['organization_country'] 		!= null &&
			$data['organization_area'] 	    	!= "" && $data['organization_area'] 		!= null &&
			$data['organization_city'] 	    	!= "" && $data['organization_city']       	!= null
		)
		{
			where('organization_id',$cer_id);
			if(update2($data,'tbl_organization'))
			{
				if($slugUpdate)
				{
					$URLdata['url_suffex']  = $currentSlug;
				    $URLdata['url_type']    = 'organization';
				    where('url_suffex',$previousSlug);
				    update($URLdata,'tbl_url');
				}
				set_msg('Success','Organization is added successfully','success');
				jump(admin_base_url()."list-organization");
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
	else if(isset($_POST['btn_username']))
	{
	    $organization_id	= post('org_id');
	    if(isset($_POST['txt_password']) && post('txt_password') != null && post('txt_password') != "")
		{
		    $data['organization_password'] = encrypt(post('txt_password'));
		}
		if(isset($_POST['txt_username']) && post('txt_username') != null && post('txt_username') != "")
		{
    		$username = post('txt_username');
    		if(checkUniqueCol('tbl_organization','organization_username',$username, true, 'organization_id', $organization_id ))
    		{
    		    $data['organization_username'] = $username;
    		}
		}
		if(sizeof($data) > 0)
		{
		    where('organization_id',$organization_id);
			if(update($data,'tbl_organization'))
			{
				set_msg('Success','Credentials are updated successfully','success');
				jump(admin_base_url()."list-organization");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				echo "<script>window.history.go(-1);</script>";
			}
		}
		else
		{
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
		if(isset($_GET['org_id']) && $_GET['org_id'] != "" && $_GET['org_id'] != null && $_GET['org_id'] > 0 )
		{
			$org_id = $_GET['org_id'];
			where('organization_id',$org_id);
			if(delete('tbl_organization'))
			{
				set_msg('Success','Organzation is deleted successfully','success');
				jump(admin_base_url()."list-organization");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."list-organization");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."list-organization");
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