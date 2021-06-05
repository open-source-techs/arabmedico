<?php
require_once('admin/config/db.php');
// session_destroy();
$siteData = get_site_data();
get_languages();
$lang_con = $_SESSION['language'];
if(isset($_GET['lang']))
{
    $_SESSION['lang'] = $_GET['lang'];
}
if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'arabic')
{
    $lang = "ar";
}
else
{
    $lang = "eng";
}
?>