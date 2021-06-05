<?php
require_once('../admin/config/db.php');
get_languages();
$lang_con = $_SESSION['language'];
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(isset($_POST['btn_submit']))
    {
        $data['commented_news'] = post('txt_news_id');
        $data['comment_text']   = post('message');
        $data['comment_email']  = post('email');
        $data['comment_name']   = post('name');
        $lang                   = post('txt_lang');
        if(isset($_POST['chk_private']))
        {
            $data['comment_private'] = 1;
        }
        if(
            $data['commented_news'] != "" && $data['commented_news'] != null &&
            $data['comment_text']   != "" && $data['comment_text']   != null &&
            $data['comment_email']  != "" && $data['comment_email']  != null &&
            $data['comment_name']   != "" && $data['comment_name']   != null
        )
        {
            if(insert($data,'tbl_news_comments'))
            {
                $arr = array(
                    "status" => "success",
                    "message" => ($lang == "eng") ? $lang_con[133]['lang_eng'] : $lang_con[133]['lang_arabic'] . " " . ($lang == "eng") ? $lang_con[132]['lang_eng'] : $lang_con[132]['lang_arabic']
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
        else
        {
            $arr = array(
                "status" => "error",
                "message" => ($lang == "eng") ? $lang_con[131]['lang_eng'] : $lang_con[131]['lang_arabic']
            );
        }
        echo json_encode($arr);
    }
    else if(isset($_POST['btn_appoint']))
    {
        $data['appointment_user_name']      = $_POST['name'];
        $data['appointment_user_email']     = $_POST['email'];
        $data['appointment_user_number']    = $_POST['phone'];
        $data['appointment_user_message']   = $_POST['message'];
        $data['appointment_date']           = $_POST['date'];
        $data['appointment_time']           = $_POST['time'];
        $data['appointment_depart']         = $_POST['department'];
        $data['appointment_doctor']         = $_POST['doctor'];
        $data['appointment_visted_before']  = $_POST['visited_bofre'];
        $lang                               = post('txt_lang');
        if(
            $data['appointment_user_name'] != "" && $data['appointment_user_name'] != null &&
            $data['appointment_user_email']   != "" && $data['appointment_user_email']   != null &&
            $data['appointment_user_number']  != "" && $data['appointment_user_number']  != null &&
            $data['appointment_user_message']   != "" && $data['appointment_user_message']   != null &&
            $data['appointment_date']   != "" && $data['appointment_date']   != null &&
            $data['appointment_time']   != "" && $data['appointment_time']   != null &&
            $data['appointment_depart']  != "" && $data['appointment_depart']  != null &&
            $data['appointment_doctor']   != "" && $data['appointment_doctor']   != null &&
            $data['appointment_visted_before'] != "" && $data['appointment_visted_before'] != null
        )
        {
            if(insert($data,'tbl_appointment'))
            {
                $arr = array(
                    "status" => "success",
                    "message" => ($lang == "eng") ? $lang_con[116]['lang_eng'] : $lang_con[116]['lang_arabic'] . " " . ($lang == "eng") ? $lang_con[132]['lang_eng'] : $lang_con[132]['lang_arabic']
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
        else
        {
            $arr = array(
                "status" => "error",
                "message" => ($lang == "eng") ? $lang_con[131]['lang_eng'] : $lang_con[131]['lang_arabic']
            );
        }
        echo json_encode($arr);
    }
    else if(isset($_POST['action']) && $_POST['action'] == "get_depart")
    {
        $department = post('dpt');
        $lang                   = post('txt_lang');
        $sql = query("SELECT * FROM tbl_doctor WHERE doctor_department = '$department' ");
        $res = array();
        if(nrows($sql) > 0)
        {
            while($row = fetch($sql))
            {
                $res[] = $row;
            }
            $arr = array(
                "status" => "success",
                "data" => $res
            );
        }
        else
        {
            $arr = array(
                "status" => "error",
                "message" => "<?= ($lang == 'eng') ? $lang_con[137]['lang_eng'] : $lang_con[137]['lang_arabic'] ?>"
            );
        }
        echo json_encode($arr);
    }
    else if(isset($_POST['action']) && $_POST['action'] == "get_time")
    {
        $doct       = post('doctor');
        $date       = post('app_date');
        $dateName   = date('l', strtotime($date));
        $lang       = post('txt_lang');
        
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
                "message" => "<?= ($lang == 'eng') ? $lang_con[137]['lang_eng'] : $lang_con[137]['lang_arabic'] ?>"
            );
        }
        echo json_encode($arr);
    }
    else
    {
        echo "<script>window.history.go(-1);</script>";
    }
}
else
{
    echo "<script>window.history.go(-1);</script>";
}
?>