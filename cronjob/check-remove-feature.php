<?php
require_once('admin/config.php');
$todayDate 	= date('Y-m-d');
$docsql 	= query("SELECT * FROM tbl_feature_doctor WHERE f_tenure != fix AND f_active = 1 AND f_end_date = '$todayDate'");
if(nrows($docsql) > 0)
{
	While($doc = fetch($docsql))
	{
		$upd['f_active'] = 0;
		$f_id 			 = $doc['f_id'];
		where('f_id', $f_id);
		update($upd, 'tbl_feature_doctor');
	}
}

$clinic_sql 	= query("SELECT * FROM tbl_feature_clinic WHERE f_tenure != fix AND f_active = 1 AND f_end_date = '$todayDate'");
if(nrows($clinic_sql) > 0)
{
	While($clinic = fetch($clinic_sql))
	{
		$upd['f_active'] = 0;
		$f_id 			 = $clinic['f_id'];
		where('f_id', $f_id);
		update($upd, 'tbl_feature_clinic');
	}
}
?>