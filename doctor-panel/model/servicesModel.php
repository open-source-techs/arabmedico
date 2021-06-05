<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_service']))
	{
	    $data['c_doc_id']   = post('txt_doc_id');
	    $data['c_name']     = post('txt_cer_name');
	    $data['c_name_ar']  = $_POST['arabic_cer_title'];
	    $data['c_desc']     = post('txt_short_desc');
	    $data['c_desc_ar']  = $_POST['txt_short_desc_arabic'];
	    $image_name         = upload_image($_FILES,'cer_profile', '../../upload/');
	    if($image_name)
	    {
	        $data['c_image'] = $image_name;
	    }
	    else
	    {
	        $data['c_image'] = "";
	    }
	    
	    if(
	        $data['c_name']     != null && $data['c_name']     != "" &&
	        $data['c_name_ar']  != null && $data['c_name_ar']  != "" &&
	        $data['c_desc']     != null && $data['c_desc']     != "" &&
	        $data['c_desc_ar']  != null && $data['c_desc_ar']  != "" &&
	        $data['c_image']    != null && $data['c_image']    != ""
	        )
	    {
	        if(insert2($data,'tbl_doc_clinicalServices'))
			{
				set_msg('Success','Service is added successfully','success');
				jump(admin_base_url()."account");
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
	else if(isset($_POST['btn_edit_service']))
	{
	    $servID             = post('txt_serv_id');
	    $data['c_doc_id']   = post('txt_doc_id');
	    $data['c_name']     = post('txt_cer_name');
	    $data['c_name_ar']  = $_POST['arabic_cer_title'];
	    $data['c_desc']     = post('txt_short_desc');
	    $data['c_desc_ar']  = $_POST['txt_short_desc_arabic'];
	    $image_name         = upload_image($_FILES,'cer_profile', '../../upload/');
	    if($image_name)
	    {
	        $data['c_image'] = $image_name;
	    }
	    
	    if(
	        $data['c_name']     != null && $data['c_name']     != "" &&
	        $data['c_name_ar']  != null && $data['c_name_ar']  != "" &&
	        $data['c_desc']     != null && $data['c_desc']     != "" &&
	        $data['c_desc_ar']  != null && $data['c_desc_ar']  != ""
	        )
	    {
	        where('c_id',$servID);
	        if(update2($data,'tbl_doc_clinicalServices'))
			{
				set_msg('Success','Service is updated successfully','success');
				jump(admin_base_url()."account");
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
}
else if($_SERVER['REQUEST_METHOD'] == "GET")
{
    if(isset($_GET['act']) && $_GET['act'] == 'del-serv')
    {
        if(isset($_GET['serv_id']) && $_GET['serv_id'] != '' && $_GET['serv_id'] != null && $_GET['serv_id'] > 0)
        {
            $serviceID = $_GET['serv_id'];
            where('c_id', $serviceID);
            if(delete('tbl_doc_clinicalServices'))
            {
                set_msg('Success','Service is delted successfully','success');
				jump(admin_base_url()."account");
            }
            else
            {
                set_msg('Deletion error','Unable to process your request. Please try again later.','error');
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
else
{
    jump(admin_base_url());
}
?>