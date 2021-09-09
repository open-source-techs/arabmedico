<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_save_doctor']))
	{
		$data['f_doctor_id'] 	= post('txt_doctor');
		$checkSql 				= query("SELECT * FROM tbl_feature_doctor WHERE f_doctor_id = ".$data['f_doctor_id']." AND f_active = 1");
		if(nrows($checkSql) > 0)
		{
			set_msg('Duplicate error','This doctor is already in feature list.','error');
			echo "<script>window.history.go(-1);</script>";
		}
		else
		{
			$data['f_list']  = post('txt_listingFeature');
			$data['f_home']  = post('txt_homefeature');
			if($data['f_list'] == "yes")
			{
				$data['f_tenure'] 		= post('txt_tenure');
				$data['f_start_date'] 	= post('txt_startDate');
				if($data['f_tenure'] == '' || $data['f_tenure'] == null)
				{
					$data['f_tenure'] = 'quater';
				}
				if($data['f_tenure'] == 'quater')
				{
					$data['f_end_date'] = date("Y-m-d", strtotime($data['f_start_date'] . " +3 Months"));
				}
				else if($data['f_tenure'] == 'half')
				{
					$data['f_end_date'] = date("Y-m-d", strtotime($data['f_start_date'] . " +6 Months"));
				}
				else if($data['f_tenure'] == 'full')
				{
					$data['f_end_date'] = date("Y-m-d", strtotime($data['f_start_date'] . " +12 Months"));
				}
				else if($data['f_tenure'] == 'fix')
				{
					$data['f_end_date'] = 'fix';
				}
			}
			if($data['f_home'] == "yes")
			{
				$data['f_home_start'] 	= post('txt_homeStartDate');
				$data['f_home_tenure'] 	= post('txt_homeTenure');
				if($data['f_home_tenure'] == '' || $data['f_home_tenure'] == null)
				{
					$data['f_home_tenure'] = 'quater';
				}
				if($data['f_home_tenure'] == 'quater')
				{
					$data['f_home_end'] = date("Y-m-d", strtotime($data['f_home_start'] . " +3 Months"));
				}
				else if($data['f_home_tenure'] == 'half')
				{
					$data['f_home_end'] = date("Y-m-d", strtotime($data['f_home_start'] . " +6 Months"));
				}
				else if($data['f_home_tenure'] == 'full')
				{
					$data['f_home_end'] = date("Y-m-d", strtotime($data['f_home_start'] . " +12 Months"));
				}
				else if($data['f_home_tenure'] == 'fix')
				{
					$data['f_home_end'] = 'fix';
				}
			}
			if(
				$data['f_doctor_id'] != "" && $data['f_doctor_id'] 	!= null &&
				$data['f_list'] 	 != "" && $data['f_list'] 		!= null &&
				$data['f_home'] 	 != "" && $data['f_home'] 		!= null
			)
			{
				if(insert2($data,'tbl_feature_doctor'))
				{
					set_msg('Success','Feature Doctor is added successfully','success');
				    jump(admin_base_url()."feature-doctor");
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
	}
	else if(isset($_POST['btn_edit_doctor']))
	{
		$f_Id = post('txt_fID');
		$data['f_doctor_id'] 	= post('txt_doctor');
		$checkSql 				= query("SELECT * FROM tbl_feature_doctor WHERE f_doctor_id = ".$data['f_doctor_id']." AND f_active = 1 AND f_id != $f_Id");
		if(nrows($checkSql) > 0)
		{
			set_msg('Duplicate error','This doctor is already in feature list.','error');
			echo "<script>window.history.go(-1);</script>";
		}
		else
		{
			$data['f_list']  = post('txt_listingFeature');
			$data['f_home']  = post('txt_homefeature');
			if($data['f_list'] == "yes")
			{
				$data['f_tenure'] 		= post('txt_tenure');
				$data['f_start_date'] 	= post('txt_startDate');
				if($data['f_tenure'] == '' || $data['f_tenure'] == null)
				{
					$data['f_tenure'] = 'quater';
				}
				if($data['f_tenure'] == 'quater')
				{
					$data['f_end_date'] = date("Y-m-d", strtotime($data['f_start_date'] . " +3 Months"));
				}
				else if($data['f_tenure'] == 'half')
				{
					$data['f_end_date'] = date("Y-m-d", strtotime($data['f_start_date'] . " +6 Months"));
				}
				else if($data['f_tenure'] == 'full')
				{
					$data['f_end_date'] = date("Y-m-d", strtotime($data['f_start_date'] . " +12 Months"));
				}
				else if($data['f_tenure'] == 'fix')
				{
					$data['f_end_date'] = 'fix';
				}
			}
			else
			{
				$data['f_tenure'] 		= null;
				$data['f_start_date'] 	= null;
				$data['f_end_date'] 	= null;
			}
			if($data['f_home'] == "yes")
			{
				$data['f_home_start'] 	= post('txt_homeStartDate');
				$data['f_home_tenure'] 	= post('txt_homeTenure');
				if($data['f_home_tenure'] == '' || $data['f_home_tenure'] == null)
				{
					$data['f_home_tenure'] = 'quater';
				}
				if($data['f_home_tenure'] == 'quater')
				{
					$data['f_home_end'] = date("Y-m-d", strtotime($data['f_home_start'] . " +3 Months"));
				}
				else if($data['f_home_tenure'] == 'half')
				{
					$data['f_home_end'] = date("Y-m-d", strtotime($data['f_home_start'] . " +6 Months"));
				}
				else if($data['f_home_tenure'] == 'full')
				{
					$data['f_home_end'] = date("Y-m-d", strtotime($data['f_home_start'] . " +12 Months"));
				}
				else if($data['f_home_tenure'] == 'fix')
				{
					$data['f_home_end'] = 'fix';
				}
			}
			else
			{
				$data['f_home_start'] 		= null;
				$data['f_home_tenure'] 	= null;
				$data['f_home_end'] 	= null;
			}
			if(
				$data['f_doctor_id'] != "" && $data['f_doctor_id'] 	!= null &&
				$data['f_list'] 	 != "" && $data['f_list'] 		!= null &&
				$data['f_home'] 	 != "" && $data['f_home'] 		!= null
			)
			{
				where('f_id', $f_Id);
				if(update2($data,'tbl_feature_doctor'))
				{
					set_msg('Success','Feature Doctor is updated successfully','success');
				    jump(admin_base_url()."feature-doctor");
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
	}
	else if(isset($_POST['btn_save_clinic']))
	{

		$data['f_clinic_id'] 	= post('txt_clinic');
		$checkSql 				= query("SELECT * FROM tbl_feature_clinic WHERE f_clinic_id = ".$data['f_clinic_id']." AND f_active = 1");
		if(nrows($checkSql) > 0)
		{
			set_msg('Duplicate error','This Clinic is already in feature list.','error');
			echo "<script>window.history.go(-1);</script>";
		}
		else
		{
			$data['f_list']  = post('txt_listingFeature');
			$data['f_home']  = post('txt_homefeature');
			if($data['f_list'] == "yes")
			{
				$data['f_tenure'] 		= post('txt_tenure');
				$data['f_start_date'] 	= post('txt_startDate');
				if($data['f_tenure'] == '' || $data['f_tenure'] == null)
				{
					$data['f_tenure'] = 'quater';
				}
				if($data['f_tenure'] == 'quater')
				{
					$data['f_end_date'] = date("Y-m-d", strtotime($data['f_start_date'] . " +3 Months"));
				}
				else if($data['f_tenure'] == 'half')
				{
					$data['f_end_date'] = date("Y-m-d", strtotime($data['f_start_date'] . " +6 Months"));
				}
				else if($data['f_tenure'] == 'full')
				{
					$data['f_end_date'] = date("Y-m-d", strtotime($data['f_start_date'] . " +12 Months"));
				}
				else if($data['f_tenure'] == 'fix')
				{
					$data['f_end_date'] = 'fix';
				}
			}
			if($data['f_home'] == "yes")
			{
				$data['f_home_start'] 	= post('txt_homeStartDate');
				$data['f_home_tenure'] 	= post('txt_homeTenure');
				if($data['f_home_tenure'] == '' || $data['f_home_tenure'] == null)
				{
					$data['f_home_tenure'] = 'quater';
				}
				if($data['f_home_tenure'] == 'quater')
				{
					$data['f_home_end'] = date("Y-m-d", strtotime($data['f_home_start'] . " +3 Months"));
				}
				else if($data['f_home_tenure'] == 'half')
				{
					$data['f_home_end'] = date("Y-m-d", strtotime($data['f_home_start'] . " +6 Months"));
				}
				else if($data['f_home_tenure'] == 'full')
				{
					$data['f_home_end'] = date("Y-m-d", strtotime($data['f_home_start'] . " +12 Months"));
				}
				else if($data['f_home_tenure'] == 'fix')
				{
					$data['f_home_end'] = 'fix';
				}
			}
			if(
				$data['f_clinic_id'] != "" && $data['f_clinic_id'] 	!= null &&
				$data['f_list'] 	 != "" && $data['f_list'] 		!= null &&
				$data['f_home'] 	 != "" && $data['f_home'] 		!= null
			)
			{
				if(insert2($data,'tbl_feature_clinic'))
				{
					set_msg('Success','Feature Clinic is added successfully','success');
				    jump(admin_base_url()."feature-clinic");
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
	}
	else if(isset($_POST['btn_edit_clinic']))
	{
		$f_Id = post('txt_fID');
		$data['f_clinic_id'] 	= post('txt_clinic');
		$checkSql 				= query("SELECT * FROM tbl_feature_clinic WHERE f_clinic_id = ".$data['f_clinic_id']." AND f_active = 1 AND f_id != $f_Id");
		if(nrows($checkSql) > 0)
		{
			set_msg('Duplicate error','This Clinic is already in feature list.','error');
			echo "<script>window.history.go(-1);</script>";
		}
		else
		{
			$data['f_list']  = post('txt_listingFeature');
			$data['f_home']  = post('txt_homefeature');
			if($data['f_list'] == "yes")
			{
				$data['f_tenure'] 		= post('txt_tenure');
				$data['f_start_date'] 	= post('txt_startDate');
				if($data['f_tenure'] == '' || $data['f_tenure'] == null)
				{
					$data['f_tenure'] = 'quater';
				}
				if($data['f_tenure'] == 'quater')
				{
					$data['f_end_date'] = date("Y-m-d", strtotime($data['f_start_date'] . " +3 Months"));
				}
				else if($data['f_tenure'] == 'half')
				{
					$data['f_end_date'] = date("Y-m-d", strtotime($data['f_start_date'] . " +6 Months"));
				}
				else if($data['f_tenure'] == 'full')
				{
					$data['f_end_date'] = date("Y-m-d", strtotime($data['f_start_date'] . " +12 Months"));
				}
				else if($data['f_tenure'] == 'fix')
				{
					$data['f_end_date'] = 'fix';
				}
			}
			else
			{
				$data['f_tenure'] 		= null;
				$data['f_start_date'] 	= null;
				$data['f_end_date'] 	= null;
			}
			if($data['f_home'] == "yes")
			{
				$data['f_home_start'] 	= post('txt_homeStartDate');
				$data['f_home_tenure'] 	= post('txt_homeTenure');
				if($data['f_home_tenure'] == '' || $data['f_home_tenure'] == null)
				{
					$data['f_home_tenure'] = 'quater';
				}
				if($data['f_home_tenure'] == 'quater')
				{
					$data['f_home_end'] = date("Y-m-d", strtotime($data['f_home_start'] . " +3 Months"));
				}
				else if($data['f_home_tenure'] == 'half')
				{
					$data['f_home_end'] = date("Y-m-d", strtotime($data['f_home_start'] . " +6 Months"));
				}
				else if($data['f_home_tenure'] == 'full')
				{
					$data['f_home_end'] = date("Y-m-d", strtotime($data['f_home_start'] . " +12 Months"));
				}
				else if($data['f_home_tenure'] == 'fix')
				{
					$data['f_home_end'] = 'fix';
				}
			}
			else
			{
				$data['f_home_start'] 		= null;
				$data['f_home_tenure'] 	= null;
				$data['f_home_end'] 	= null;
			}
			if(
				$data['f_clinic_id'] != "" && $data['f_clinic_id'] 	!= null &&
				$data['f_list'] 	 != "" && $data['f_list'] 		!= null &&
				$data['f_home'] 	 != "" && $data['f_home'] 		!= null
			)
			{
				where('f_id', $f_Id);
				if(update2($data,'tbl_feature_clinic'))
				{
					set_msg('Success','Feature Clinic is updated successfully','success');
				    jump(admin_base_url()."feature-clinic");
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
	}
	else
	{
		jump(admin_base_url());
	}
}
else if($_SERVER['REQUEST_METHOD'] == "GET")
{
	if(isset($_GET['act']) && $_GET['act'] == "del-doc")
	{
		if(isset($_GET['f_id']) && $_GET['f_id'] != "" && $_GET['f_id'] != null && $_GET['f_id'] > 0 )
		{
			$fID = $_GET['f_id'];
			where('f_id',$fID);
			if(delete('tbl_feature_doctor'))
			{
				set_msg('Success','Feature Doctor is deleted successfully','success');
			    jump(admin_base_url()."feature-doctor");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				jump(admin_base_url()."feature-doctor");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."feature-doctor");
		}
	}
	else if(isset($_GET['act']) && $_GET['act'] == "del-clinic")
	{
		if(isset($_GET['f_id']) && $_GET['f_id'] != "" && $_GET['f_id'] != null && $_GET['f_id'] > 0 )
		{
			$fID = $_GET['f_id'];
			where('f_id',$fID);
			if(delete('tbl_feature_clinic'))
			{
				set_msg('Success','Feature Clinic is deleted successfully','success');
			    jump(admin_base_url()."feature-clinic");
			}
			else
			{
				set_msg('Insertion error','Unable to process your request. Please try again later.','error');
				jump(admin_base_url()."feature-clinic");
			}
		}
		else
		{
			set_msg('Fields validation','Unexpected error occurs','error');
			jump(admin_base_url()."feature-clinic");
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