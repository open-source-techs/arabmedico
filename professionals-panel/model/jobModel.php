<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$candiate_id = get_sess("userdata")['candidate_id'];
	if(isset($_POST['btn_save_subscription']))
	{
		if(isset($_POST['txt_job_title']))
		{
			foreach($_POST['txt_job_title'] as $key => $value)
			{
				if($key == 0)
				{
					foreach($_POST['txt_job_title'][0] as $key1 => $value1)
					{
						if($value1 != null && $value1 != "")
						{
							$data_job['sub_user'] 		= $candiate_id;
							$data_job['sub_userType'] 	= 'professional';
							$data_job['sub_type'] 		= 'job_title';
							$data_job['sub_value'] 		= $value1;
							insert($data_job, 'tbl_job_notify_sub');
						}
					}
				}
				else
				{
					if($value != null && $value != "")
					{
						$data_job['sub_user'] 		= $candiate_id;
						$data_job['sub_userType'] 	= 'professional';
						$data_job['sub_type'] 		= 'job_title';
						$data_job['sub_value'] 		= $value;
						where('sub_id', $key);
						update($data_job, 'tbl_job_notify_sub');
					}
					else
					{
						where('sub_id', $key);
						delete('tbl_job_notify_sub');
					}
				}
			}
		}
		if(isset($_POST['txt_speciality']))
		{
			foreach($_POST['txt_speciality'] as $key => $value)
			{
				if($key == 0)
				{
					foreach($_POST['txt_speciality'][0] as $key1 => $value1)
					{
						if($value1 != null && $value1 != "")
						{
							$data_spec['sub_user'] 		= $candiate_id;
							$data_spec['sub_userType'] 	= 'professional';
							$data_spec['sub_type'] 		= 'speciality';
							$data_spec['sub_value'] 	= $value1;
							insert($data_spec, 'tbl_job_notify_sub');
						}
					}
				}
				else
				{
					if($value != null && $value != "")
					{
						$data_spec['sub_user'] 		= $candiate_id;
						$data_spec['sub_userType'] 	= 'professional';
						$data_spec['sub_type'] 		= 'speciality';
						$data_spec['sub_value'] 	= $value;
						where('sub_id', $key);
						update($data_spec, 'tbl_job_notify_sub');
					}
					else
					{
						where('sub_id', $key);
						delete('tbl_job_notify_sub');
					}
				}
			}
		}
		if(isset($_POST['txt_location']))
		{
			foreach($_POST['txt_location'] as $key => $value)
			{
				if($key == 0)
				{
					foreach($_POST['txt_location'][0] as $key1 => $value1)
					{
						if($value1 != null && $value1 != "")
						{
							$data_loc['sub_user'] 		= $candiate_id;
							$data_loc['sub_userType'] 	= 'professional';
							$data_loc['sub_type'] 		= 'location';
							$data_loc['sub_value'] 		= $value1;
							insert($data_loc, 'tbl_job_notify_sub');
						}
					}
				}
				else
				{
					if($value != null && $value != "")
					{
						$data_loc['sub_user'] 		= $candiate_id;
						$data_loc['sub_userType'] 	= 'professional';
						$data_loc['sub_type'] 		= 'location';
						$data_loc['sub_value'] 		= $value;
						where('sub_id', $key);
						update($data_loc, 'tbl_job_notify_sub');
					}
					else
					{
						where('sub_id', $key);
						delete('tbl_job_notify_sub');
					}
				}
			}
		}
		set_msg('Success','Date updated successfully','success');
		jump(admin_base_url()."job-notification");
	}
}
else if($_SERVER['REQUEST_METHOD'] == "GET")
{
	$candiate_id = get_sess("userdata")['candidate_id'];
	if(isset($_GET['act']) && $_GET['act'] == 'notify')
    {
        if(isset($_GET['val']) && $_GET['val'] != '' && $_GET['val'] != null)
        {
        	$data['candidate_notifcations'] = $_GET['val'];
            where('candidate_id',$candiate_id);
		    if(update2($data,'tbl_candidate'))
            {
            	$_SESSION['userdata']['candidate_notifcations'] = $data['candidate_notifcations'];
                set_msg('Success','Notifications status updated successfully','success');
				jump(admin_base_url()."job-notification");
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
}
else
{
	jump(admin_base_url());
}