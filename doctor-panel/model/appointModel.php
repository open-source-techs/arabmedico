<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_app']))
	{
		$data['appointment_user_name'] 		= $_POST['txt_f_name'];
		$data['appointment_user_email'] 	= $_POST['txt_email'];
		$data['appointment_user_number'] 	= $_POST['txt_number'];
		$data['appointment_user_message'] 	= $_POST['txt_notes'];
		$data['appointment_date'] 		    = $_POST['txt_date'];
		$data['appointment_time'] 		    = $_POST['txt_time'];
		$data['appointment_depart'] 		= $_POST['txt_depart'];
		$data['appointment_doctor'] 		= $_POST['txt_doctor'];
		$data['appointment_visted_before'] 	= $_POST['txt_visit'];
		if(
		    $data['appointment_user_name'] != null && $data['appointment_user_name'] != "" &&
		    $data['appointment_user_email'] != null && $data['appointment_user_email'] != "" &&
		    $data['appointment_user_number'] != null && $data['appointment_user_number'] != "" &&
		    $data['appointment_date'] != null && $data['appointment_date'] != "" &&
		    $data['appointment_time'] != null && $data['appointment_time'] != "" &&
		    $data['appointment_depart'] != null && $data['appointment_depart'] != "" &&
		    $data['appointment_doctor'] != null && $data['appointment_doctor'] != "" &&
		    $data['appointment_visted_before'] != null && $data['appointment_visted_before'] != ""
		)
		{
		   if(insert($data,'tbl_appointment'))
		   {
		        set_msg('Success','Appointment added successfully','success');
    		    jump(admin_base_url()."appointments");
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
	else if($_POST['btn_edit_app'])
	{
	    $appoint_id                         = $_POST['app_id'];
	    $data['appointment_user_name'] 		= $_POST['txt_f_name'];
		$data['appointment_user_email'] 	= $_POST['txt_email'];
		$data['appointment_user_number'] 	= $_POST['txt_number'];
		$data['appointment_user_message'] 	= $_POST['txt_notes'];
		$data['appointment_date'] 		    = $_POST['txt_date'];
		$data['appointment_time'] 		    = $_POST['txt_time'];
		$data['appointment_depart'] 		= $_POST['txt_depart'];
		$data['appointment_doctor'] 		= $_POST['txt_doctor'];
		$data['appointment_visted_before'] 	= $_POST['txt_visit'];
		$reschedule = post('reschedule');
		if(
		    $data['appointment_user_name'] != null && $data['appointment_user_name'] != "" &&
		    $data['appointment_user_email'] != null && $data['appointment_user_email'] != "" &&
		    $data['appointment_user_number'] != null && $data['appointment_user_number'] != "" &&
		    $data['appointment_date'] != null && $data['appointment_date'] != "" &&
		    $data['appointment_time'] != null && $data['appointment_time'] != "" &&
		    $data['appointment_depart'] != null && $data['appointment_depart'] != "" &&
		    $data['appointment_doctor'] != null && $data['appointment_doctor'] != "" &&
		    $data['appointment_visted_before'] != null && $data['appointment_visted_before'] != ""
		)
		{
		    if($reschedule == 1)
		    {
		        $res_data['appointment_reschedule'] = 1;
		        $res_data['appointment_read'] = 4;
		        where('appointment_id',$appoint_id);
		        if(update($res_data,'tbl_appointment'))
		        {
    		        if(insert($data,'tbl_appointment'))
        		    {
        		        set_msg('Success','Appointment added successfully','success');
            		    jump(admin_base_url()."appointments");
        		    }
        		    else
        		    {
        		       set_msg('Insertion Error','Unable to process your request. Please try again later.','error');
        		       echo "<script>window.history.go(-1);</script>";
        		    }
		        }
		        else
    		    {
    		       set_msg('Update error','Unable to process your request. Please try again later.','error');
    		       echo "<script>window.history.go(-1);</script>";
    		    }
		    }
		    else
		    {
		        where('appointment_id',$appoint_id);
    		    if(update($data,'tbl_appointment'))
    		    {
    		        set_msg('Success','Appointment added successfully','success');
        		    jump(admin_base_url()."appointments");
    		    }
    		    else
    		    {
    		       set_msg('Updation Error','Unable to process your request. Please try again later.','error');
    		       echo "<script>window.history.go(-1);</script>";
    		    }
		    }
		}
		else
		{
		    set_msg('Fields Error','Please fill all required fields.','error');
		    echo "<script>window.history.go(-1);</script>";
		}
	}
	else if(isset($_POST['action']) && $_POST['action'] == "get_time")
    {
        $doct       = post('doctor');
        $date       = post('app_date');
        $dateName   = date('l', strtotime($date));
        
        $sql = query("SELECT * FROM tbl_schedule_head WHERE schedule_doctor = '$doct' AND schedule_date = '$dateName' ");
        $res = array();
        if(nrows($sql) > 0)
        {
            while($head = fetch($sql))
            {
                $headID = $head['schedule_id'];
                $sql1 = query("SELECT * FROM tbl_schedule_time WHERE time_head = '$headID' ");
                while($res1 = fetch($sql1))
                {
                    $res[] = $res1;
                }
                $arr = array(
                    "status" => "success",
                    "data" => $res
                );
            }
        }
        else
        {
            $arr = array(
                "status" => "error",
                "message" => "No Time slot found"
            );
        }
        echo json_encode($arr);
    }
    else if(isset($_POST['action']) && $_POST['action'] == "delTime")
	{
	    $id = post('txt_time');
        where('time_id',$id);
	    if(delete('tbl_schedule_time'))
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
    if(isset($_GET['act']) && $_GET['act'] == 'app_stat')
    {
        if(isset($_GET['appoint']) && $_GET['appoint'] != null && $_GET['appoint'] != '')
        {
            if(isset($_GET['val']) && $_GET['val'] != null && $_GET['val'] != '')
            {
                $value  = filter_this($_GET['val']);
                $app_id = filter_this($_GET['appoint']);
                // echo $value; echo "<br>"; echo $app_id; die();
                $data['appointment_read'] = $value;
                where('appointment_id',$app_id);
                if(update($data, 'tbl_appointment'))
                {
    				set_msg('Success','Appointment Status updated successfully','success');
    				jump(admin_base_url()."appointments");
    			}
    			else
    			{
    				set_msg('Data Error','Unable to process your request. Please try again later.','error');
    				jump(admin_base_url()."appointments");
    			}
            }
        }
    }
}
else
{
    jump(admin_base_url());
}
?>