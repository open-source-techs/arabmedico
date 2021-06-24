<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$candiate_id = get_sess("userdata")['candidate_id'];
	if(isset($_POST['action']) && $_POST['action'] == "getfields")
	{

		$sub_type = post('subType');
		$sql = query("SELECT * FROM tbl_job_notify_sub WHERE sub_userType = 'professional' AND sub_type = '$sub_type' AND sub_user = '$candiate_id' ");
		$num_rows = nrows($sql);
		$job_field = '';
		if($sub_type == "job_title")
		{
			if($num_rows > 0)
			{
				while ($data = fetch($sql))
				{ 
					$job_field .= '<div class="col-sm-6 form-group">
						<label>Enter Job Title</label>
		                <input type="text" name="txt_job_title['.$data['sub_id'].']" value="'.$data['sub_value'].'" class="form-control job_title" required>
					</div>';
				}
				$limit = 3 - $num_rows;
				for($i = 0; $i < $limit; $i++)
				{
					$job_field .= '<div class="col-sm-6 form-group">
						<label>Enter Job Title</label>
		                <input type="text" name="txt_job_title[0]['.$i.']" class="form-control job_title" required>
					</div>';
				}
			}
			else
			{
				for($i = 0; $i < 3; $i++)
				{
					$job_field .= '<div class="col-sm-6 form-group">
						<label>Enter Job Title</label>
		                <input type="text" name="txt_job_title[0]['.$i.']" class="form-control job_title" required>
					</div>';
				}
			}
		}
		else if($sub_type == "speciality")
		{
			if($num_rows > 0)
			{
				while ($data = fetch($sql))
				{ 
					$job_field .= '<div class="col-sm-6 form-group">
						<label>Enter Speciality</label>
		                <input type="text" name="txt_speciality['.$data['sub_id'].']" value="'.$data['sub_value'].'" class="form-control txt_speciality" required>
					</div>';
				}
				$limit = 3 - $num_rows;
				for($i = 0; $i < $limit; $i++)
				{
					$job_field .= '<div class="col-sm-6 form-group">
						<label>Enter Speciality</label>
		                <input type="text" name="txt_speciality[0]['.$i.']" class="form-control txt_speciality" required>
					</div>';
				}
			}
			else
			{
				for($i = 0; $i < 3; $i++)
				{
					$job_field .= '<div class="col-sm-6 form-group">
						<label>Enter Speciality</label>
		                <input type="text" name="txt_speciality[0]['.$i.']" class="form-control txt_speciality" required>
					</div>';
				}
			}
		}
		else if($sub_type == "location")
		{
			if($num_rows > 0)
			{
				while ($data = fetch($sql))
				{ 
					$job_field .= '<div class="col-sm-6 form-group">
						<label>Enter Location</label>
		                <input type="text" name="txt_location['.$data['sub_id'].']" value="'.$data['sub_value'].'" class="form-control txt_location" required>
					</div>';
				}
				$limit = 3 - $num_rows;
				for($i = 0; $i < $limit; $i++)
				{
					$job_field .= '<div class="col-sm-6 form-group">
						<label>Enter Location</label>
		                <input type="text" name="txt_location[0]['.$i.']" class="form-control txt_location" required>
					</div>';
				}
			}
			else
			{
				for($i = 0; $i < 3; $i++)
				{
					$job_field .= '<div class="col-sm-6 form-group">
						<label>Enter Location</label>
		                <input type="text" name="txt_location[0]['.$i.']" class="form-control txt_location" required>
					</div>';
				}
			}
		}
		echo $job_field;
	}
	else if(isset($_POST['btn_save_subscription']))
	{
		$sub_type = post('sub_type');
		if(isset($_POST['txt_job_title']))
		{
			foreach($_POST['txt_job_title'] as $key => $value)
			{
				if($key == 0)
				{
					foreach($_POST['txt_job_title'][0] as $key1 => $value1)
					{
						$data_job['sub_user'] 		= $candiate_id;
						$data_job['sub_userType'] 	= 'professional';
						$data_job['sub_type'] 		= $sub_type;
						$data_job['sub_value'] 		= $value1;
						insert($data_job, 'tbl_job_notify_sub');
					}
				}
				else
				{
					$data_job['sub_user'] 		= $candiate_id;
					$data_job['sub_userType'] 	= 'professional';
					$data_job['sub_type'] 		= $sub_type;
					$data_job['sub_value'] 		= $value;
					where('sub_id', $key);
					update($data_job, 'tbl_job_notify_sub');
				}
			}
		}
		else if(isset($_POST['txt_speciality']))
		{
			foreach($_POST['txt_speciality'] as $key => $value)
			{
				if($key == 0)
				{
					foreach($_POST['txt_speciality'][0] as $key1 => $value1)
					{
						$data_spec['sub_user'] 		= $candiate_id;
						$data_spec['sub_userType'] 	= 'professional';
						$data_spec['sub_type'] 		= $sub_type;
						$data_spec['sub_value'] 	= $value1;
						insert($data_spec, 'tbl_job_notify_sub');
					}
				}
				else
				{
					$data_spec['sub_user'] 		= $candiate_id;
					$data_spec['sub_userType'] 	= 'professional';
					$data_spec['sub_type'] 		= $sub_type;
					$data_spec['sub_value'] 		= $value;
					where('sub_id', $key);
					update($data_spec, 'tbl_job_notify_sub');
				}
			}
		}
		else if(isset($_POST['txt_location']))
		{
			foreach($_POST['txt_location'] as $key => $value)
			{
				if($key == 0)
				{
					foreach($_POST['txt_location'][0] as $key1 => $value1)
					{
						$data_loc['sub_user'] 		= $candiate_id;
						$data_loc['sub_userType'] 	= 'professional';
						$data_loc['sub_type'] 		= $sub_type;
						$data_loc['sub_value'] 		= $value1;
						insert($data_loc, 'tbl_job_notify_sub');
					}
				}
				else
				{
					$data_loc['sub_user'] 		= $candiate_id;
					$data_loc['sub_userType'] 	= 'professional';
					$data_loc['sub_type'] 		= $sub_type;
					$data_loc['sub_value'] 		= $value;
					where('sub_id', $key);
					update($data_loc, 'tbl_job_notify_sub');
				}
			}
		}
		set_msg('Success','Date updated successfully','success');
		jump(admin_base_url()."job-notification");
	}
}