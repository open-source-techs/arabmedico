<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(isset($_POST['btn_save_date']))
	{
	    $data['schedule_doctor']    = post('txt_doctor_id');
	    $data['schedule_date']      = post('txt_working_day');
	    $data['schedule_date_ar']   = $_POST['txt_working_day_arabic'];
	    if(
	        $data['schedule_doctor']     != "" && $data['schedule_doctor']   != null && 
	        $data['schedule_date']       != "" && $data['schedule_date']     != null && 
	        $data['schedule_date_ar']    != "" && $data['schedule_date_ar']  != null
        )
	    {
	        if(insert($data,'tbl_schedule_head'))
		    {
		        set_msg('Success','Date added successfully','success');
    		    jump(admin_base_url()."schedule");
		    }
		    else
    	    {
    		    set_msg('Insertion Error','Unable to process your request. Please try again later.','error');
    		    echo "<script>window.history.go(-1);</script>";
    	    }
	    }
	    else
	    {
		    set_msg('Fields Error','Please fill all required fields.','error');
		    echo "<script>window.history.go(-1);</script>";
	    }
	}
	else if(isset($_POST['btn_save_time']))
	{
	    $data['time_head']             = post('time_head');
	    foreach($_POST['txt_start_time'] as $key => $val)
	    {
	        if($_POST['txt_time_id'][$key] != 0)
	        {
	            $data['time_start']         = $_POST['txt_start_time'][$key];
	            $data['time_end']           = $_POST['txt_end_time'][$key];
	            $data['time_start_arabic']  = changeNumberToArabic($data['time_start']);
	            $data['time_end_arabic']    = changeNumberToArabic($data['time_end']);
	            where('time_id',$_POST['txt_time_id'][$key]);
	            update($data, 'tbl_schedule_time');
	            
	        }
	        else
	        {
	            $time_start = $_POST['txt_start_time'][$key];
        	    $time_end 	= $_POST['txt_end_time'][$key];
        	    $startTime = date('G:i',strtotime("+15 minutes", strtotime($time_start)));
                $endTime = date('G:i',strtotime("+15 minutes", strtotime($time_end)));
                
        	    $split_time_start = SplitTime($time_start,$time_end);
        	    $split_time_end = SplitTime($startTime,$endTime);
        	    
        	    for ($i = 0; $i < sizeof($split_time_start); $i++)
        	    {
        	        $data['time_start']         = $split_time_start[$i];
    	            $data['time_end']           = $split_time_end[$i];
    	            $data['time_start_arabic']  = changeNumberToArabic($split_time_start[$i]);
    	            $data['time_end_arabic']    = changeNumberToArabic($split_time_end[$i]);
    	           // print_r($data);
    	            insert($data,'tbl_schedule_time');
        	    }
	        }
	    }
	    $sch = $data['time_head'];
		set_msg('Success','Record Updated','success');
		jump(admin_base_url()."schedule-time?sch=".$sch);
	}
	else
	{
	    jump(admin_base_url());
	}
}
else if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if(isset($_GET['act']) && $_GET['act'] == "del")
	{
		if(isset($_GET['sch']) && $_GET['sch'] != "" && $_GET['sch'] != null && $_GET['sch'] > 0 )
		{
			$sch = $_GET['sch'];
			where('schedule_id',$sch);
			if(delete('tbl_schedule_head'))
			{
			    where('time_head',$sch);
			    delete('tbl_schedule_time');
			    
				set_msg('Success','Date and time is deleted successfully','success');
				jump(admin_base_url()."schedule");
			}
			else
			{
				set_msg('Query Error','Unable to process your request. Please try again later','error');
				jump(admin_base_url()."schedule");
			}
		}
		else
		{
			set_msg('Validation','Unexpected error occurs','error');
			jump(admin_base_url()."schedule");
		}
	}
}
else
{
    jump(admin_base_url());
}
?>