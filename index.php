<?php
require_once('admin/config/db.php');
$siteData = get_site_data();
get_languages();
$lang_con = $_SESSION['language'];

$meta_title         = $siteData['site_name'];
$meta_title_ar      = $siteData['site_name_arabic'];
$meta_keyword       = $siteData['site_meta_tag'];
$meta_keyword_ar    = $siteData['site_meta_tag_arabic'];
$meta_desc          = $siteData['site_meta_description'];
$meta_desc_ar       = $siteData['site_meta_description_arabic'];
if(isset($_SESSION['password']) && $_SESSION['password']) 
{
    $pass = true;
}
else
{
    $pass = false;
}
if(!$pass)
{
    if(isset($_POST['btn_pss']))
    {
        $password = post('txt_pass');
        if($password == "Amdco@2020uk")
        {
            $pass = true;
            $_SESSION['password'] = true;
        }
        ?>
        <script>
        if ( window.history.replaceState )
        {
            window.history.replaceState( null, null, window.location.href );
        }
        </script>
        <?php
    }
}
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
        if(isset($profisnow[1]))
        {
            $templatename = str_replace($profisnow[1], "", $profisnow[0]);
            $_GET['slug'] = $profisnow[1];
        }
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
    else if($profisnow[0] == 'cme-apply'){
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
if($pass)
{
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
            else if($pageData['url_type'] == "Course")
            {
                $_GET['slug'] = $pageData['url_suffex'];
                require 'templates/course-detail.php';
            }
        }
    }
}
else
{
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Enter Paswword to visit site</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" integrity="undefined" crossorigin="anonymous">
        </head>
        <body>
            <div class="container">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="mt-5">
                            <form method="post" action="#" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Enter password to contiune</label>
                                    <input type="password" class="form-control" name="txt_pass" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <br>
                                <div class="form-group">
                                    <button type="submit" name="btn_pss" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </body>
    </html>
    <?php
}
?>