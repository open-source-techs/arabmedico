<?php
require_once('../admin/config/db.php');
get_languages();
$lang_con = $_SESSION['language'];
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(isset($_POST['btn_apply']))
    {
        $data['job_app_no']     = post('jobid');
        $data['job_app_name']   = $_POST['name'];
        $data['job_app_email']  = post('email');
        $data['job_app_number'] = post('phone');
        $lang                   = post('txt_lang');
        if(checkFile($_FILES,'resume'))
        {
            $image_name             = upload_image($_FILES,'resume', '../jobApp/',true,true);
    		if($image_name)
    		{
    		    $data['job_app_resume'] = $image_name;
    		}
            if(
                $data['job_app_no']     != "" && $data['job_app_no']     != null &&
                $data['job_app_name']   != "" && $data['job_app_name']   != null &&
                $data['job_app_email']  != "" && $data['job_app_email']  != null &&
                $data['job_app_resume'] != "" && $data['job_app_resume'] != null &&
                $data['job_app_number'] != "" && $data['job_app_number'] != null
            )
            {
                $checksql = query("SELECT * FROM tbl_job_application WHERE job_app_number = '". $data['job_app_number'] ."' AND job_app_email = '". $data['job_app_email'] ."' AND job_app_no = '". $data['job_app_no'] ."' ");
                if(nrows($checksql) > 0)
                {
                    $arr = array(
                        "status" => "error",
                        "message" => ($lang == "eng") ? $lang_con[163]['lang_eng'] : $lang_con[163]['lang_arabic']
                    );
                }
                else
                {
                    // print_r($data);
                    // die();
                    if(insert($data,'tbl_job_application'))
                    {
                        $arr = array(
                            "status" => "success",
                            "message" => ($lang == "eng") ? $lang_con[161]['lang_eng'] : $lang_con[161]['lang_arabic']
                        );
                    }
                    else
                    {
                        $arr = array(
                            "status" => "error",
                            "message" => ($lang == "eng") ? $lang_con[130]['lang_eng'] : $lang_con[130]['lang_arabic']
                        );
                    }
                }
            }
            else
            {
                $arr = array(
                    "status" => "error",
                    "message" => ($lang == "eng") ? $lang_con[131]['lang_eng'] : $lang_con[131]['lang_arabic']
                );
            }
        }
        else
        {
            $arr = array(
                "status" => "error",
                "message" => ($lang == "eng") ? $lang_con[164]['lang_eng'] : $lang_con[164]['lang_arabic']
            );
        }
        echo json_encode($arr);
    }
    else
    {
        echo "abc";
        // echo "<script>window.history.go(-1);</script>";
    }
}
else
{
    echo "def";
    // echo "<script>window.history.go(-1);</script>";
}
?>