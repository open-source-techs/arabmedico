<?php
require_once('../admin/config/db.php');
get_languages();
$lang_con = $_SESSION['language'];
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(isset($_POST['btn_apply']))
    {
        $data['cme_app_no']     = $_POST['cmeid'];
        $data['cme_app_name']   = $_POST['name'];
        $data['cme_app_email']  = $_POST['email'];
        $data['cme_app_number'] = $_POST['phone'];
        $lang                   = $_POST['txt_lang'];
            if(
                $data['cme_app_no']     != "" && $data['cme_app_no']     != null &&
                $data['cme_app_name']   != "" && $data['cme_app_name']   != null &&
                $data['cme_app_email']  != "" && $data['cme_app_email']  != null &&
                $data['cme_app_number'] != "" && $data['cme_app_number'] != null
            )
            {
                $checksql = query("SELECT * FROM tbl_cme_application WHERE cme_app_number = '". $data['cme_app_number'] ."' AND cme_app_email = '". $data['cme_app_email'] ."' AND cme_app_no = '". $data['cme_app_no'] ."' ");
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
                    if(insert($data,'tbl_cme_application'))
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