<?php
require_once('admin/config/db.php');
$siteData = get_site_data();
get_languages();
$lang_con = $_SESSION['language'];

if(isset($_GET['lang']))
{
    $_SESSION['lang'] = $_GET['lang'];
}
if(isset($_GET['temp']))
{
    $templatename = $_GET['temp'];
    $profisnow = explode("/", $templatename);
    if(strpos($profisnow[0], 'lang=eng')) {
        $templatename = str_replace("lang=eng", "", $profisnow[0]);
        $_SESSION['lang'] = 'eng';
    }else if(strpos($profisnow[0], 'lang=arabic')) {
        $templatename = str_replace("lang=arabic", "", $profisnow[0]);
        $_SESSION['lang'] = 'arabic';
    }else if($profisnow[0] == 'news'){
        $templatename = str_replace($profisnow[1], "", $profisnow[0]);
        $_GET['slug'] = $profisnow[1];
    }
    else if(strpos($profisnow[0], 'video=')){
        $templatename1  = explode('video=', $templatename);
        $templatename   = $templatename1[0];
        $_GET['video']  = $templatename1[1];
    }
    else if($profisnow[0] == 'job-apply'){
        $templatename  = $profisnow[0];
        $_GET['slug']  = $profisnow[1];
    }
    else if($profisnow[0] == 'contact-professional'){
        $templatename  = $profisnow[0];
        if(strpos($profisnow[1], 'lang=eng'))
        {
            $_GET['slug'] = str_replace("lang=eng", "", $profisnow[1]);
            $_SESSION['lang'] = 'eng';
        }
        else if(strpos($profisnow[1], 'lang=arabic'))
        {
            $_GET['slug'] = str_replace("lang=arabic", "", $profisnow[1]);
            $_SESSION['lang'] = 'arabic';
        }
        else
        {
            $_GET['slug']  = $profisnow[1];
        }
    }
    else if(isset($_GET['doc']) && $_GET['doc'] != null)
    {
        if(strpos($_GET['doc'], 'lang=eng'))
        {
            $_GET['doc'] = str_replace("lang=eng", "", $_GET['doc']);
            $_SESSION['lang'] = 'eng';
        }else if(strpos($_GET['doc'], 'lang=arabic')) {
            $_GET['doc'] = str_replace("lang=arabic", "", $_GET['doc']);
            $_SESSION['lang'] = 'arabic';
        }
    }
    
}
else{
    $templatename = 'home';
}

$file_name = $templatename;

if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'arabic')
{
    $lang = "ar";
}
else
{
    $lang = "eng";
}
if(file_exists('templates/'.$templatename.".php"))
{
    require 'templates/'.$templatename.".php";
}
else
{
    $sql = query("SELECT * FROM tbl_url WHERE  url_suffex = '$templatename' ");
    if(nrows($sql) > 0)
    {
        $pageData = fetch($sql);
        if($pageData['url_type'] == "Page")
        {
            $_GET['slug'] = $pageData['url_suffex'];
            require 'templates/page.php';
        }
        else if($pageData['url_type'] == "Department")
        {
            $_GET['slug'] = $pageData['url_suffex'];
            require 'templates/department.php';
        }
        else if($pageData['url_type'] == "Clinic")
        {
            $_GET['slug'] = $pageData['url_suffex'];
            require 'templates/clinic.php';
        }
        else if($pageData['url_type'] == "Doctor")
        {
            $_GET['slug'] = $pageData['url_suffex'];
            require 'templates/dr.php';
        }
        else if($pageData['url_type'] == "Resource")
        {
            $_GET['slug'] = $pageData['url_suffex'];
            require 'templates/resource.php';
        }
        else if($pageData['url_type'] == "Job")
        {
            $_GET['slug'] = $pageData['url_suffex'];
            require 'templates/job-detail.php';
        }
        else if($pageData['url_type'] == "Post")
        {
            $_GET['slug'] = $pageData['url_suffex'];
            require 'templates/single-post.php';
        }
        else if($pageData['url_type'] == "CME")
        {
            $_GET['slug'] = $pageData['url_suffex'];
            require 'templates/cme-detail.php';
        }
        else if($pageData['url_type'] == "Channel")
        {
            $_GET['slug'] = $pageData['url_suffex'];
            require 'templates/channel.php';
        }
        else if($pageData['url_type'] == "classified")
        {
            $_GET['slug'] = $pageData['url_suffex'];
            require 'templates/classified-details.php';
        }
        else if($pageData['url_type'] == "candidate")
        {
            $_GET['slug'] = $pageData['url_suffex'];
            require 'templates/professionals-details.php';
        }
    }
}
?>