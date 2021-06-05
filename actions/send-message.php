<?php
require_once('../admin/config/db.php');
get_languages();
$lang_con = $_SESSION['language'];
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(isset($_POST['btn_apply']))
    {
        $data['contact_candidate']  = post('candiateid');
        $data['contact_employer']   = post('employerid');
        $data['contact_name']       = $_POST['name'];
        $data['contact_email']      = post('email');
        $data['contact_phone']      = $_POST['phone'];
        $data['contact_job_title']  = post('job');
        $data['contact_message']    = post('message');
        $lang                       = post('txt_lang');
        if(
            $data['contact_name']       != "" && $data['contact_name']      != null &&
            $data['contact_email']      != "" && $data['contact_email']     != null &&
            $data['contact_phone']      != "" && $data['contact_phone']     != null &&
            $data['contact_message']    != "" && $data['contact_message']   != null
        )
        {
            if(insert($data,'tbl_candidate_contact'))
            {
                $arr = array(
                    "status" => "success",
                    "message" => ($lang == "eng") ? $lang_con[216]['lang_eng'] : $lang_con[216]['lang_arabic']
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