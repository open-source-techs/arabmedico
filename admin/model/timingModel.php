<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save']))
	{
	    $data['timing_day']     = $_POST['days'];
	    $data['timing_open']    = $_POST['time_open'];
	    $data['timing_close']   = $_POST['time_closs'];
	    
	    $data['timing_day_arabic']     = $_POST['days_arabic'];
	    $data['timing_open_arabic']    = $_POST['time_open_arabic'];
	    $data['timing_close_arabic']   = $_POST['time_closs_arabic'];
	    
    	if(
    	    $data['timing_day'] 		            != null && $data['timing_day'] 	             != "" &&
    	    $data['timing_close'] 		            != null && $data['timing_close'] 	         != "" &&
    	    $data['timing_open'] 		            != null && $data['timing_open'] 		     != ""
	    )
	    {
	        if(insert($data,'tbl_timings'))
		    {
				set_msg('Success','Site Data successfully','success');
				jump(admin_base_url()."timings.php");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				jump(admin_base_url()."timings.php");
			}
        }
	    else
		{
			set_msg('Fields validation','Please enter all fields details','error');
			jump(admin_base_url()."timings.php");
		}
	}
    else if(isset($_POST['btn_edit_time']))
	{
	    $timeId                        = $_POST['timeID'];
 		$data['timing_day']            = $_POST['days'];
	    $data['timing_close']          = $_POST['time_close'];
	    $data['timing_open']           = $_POST['time_open'];
	    $data['timing_day_arabic']     = $_POST['days_arabic'];
	    $data['timing_open_arabic']    = $_POST['time_open_arabic'];
	    $data['timing_close_arabic']   = $_POST['time_closs_arabic'];
	   // echo"<pre>";
    //         print_r($data);
    //         die();
		if(
			$data['timing_day'] 			!= "" && $data['timing_day'] 	    != null &&
			$data['timing_open'] 			!= "" && $data['timing_open'] 	    != null &&
			$data['timing_close'] 	        != "" && $data['timing_close']       != null
		)
		{
		    
			where('timing_id',$timeId);
			if(update($data,'tbl_timings'))
			{
				set_msg('Success','Timing is updated successfully','success');
				jump(admin_base_url()."timings");
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
	else
	{
		jump(admin_base_url());
	}
}
    else if($_SERVER['REQUEST_METHOD'] == "GET")
    {
	if(isset($_GET['act']) && $_GET['act'] == "del")
	{
		if(isset($_GET['tid']) && $_GET['tid'] != "" && $_GET['tid'] != null && $_GET['tid'] > 0 )
		{
			$time_id = $_GET['tid'];
			where('timing_id',$time_id);
			if(delete('tbl_timings'))
			{
				set_msg('Success','User is deleted successfully','success');
				jump(admin_base_url()."timings.php");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."timings.php");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."timings.php");
		}
	}
	else
	{
		jump(admin_base_url());
	}
}
else
{
	jump(admin_base_ur());
}