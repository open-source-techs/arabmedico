<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php

if(isset($_POST['create'])){
    $department_id = get_sess("userdata")['doctor_department'];
    $link=mysqli_connect('localhost','root','','arbmdco');
    if(!isset($_POST['text']) && !isset($_POST['audio']) && !isset($_POST['video'])){
        alert('please select atleast one to proceed') ;
    }else{
        $audio = null; $video = null;
        $text = isset($_POST['text']) ?  $_POST['text'] : null;
        if(isset($_POST['audio'])){
            $audio = $_FILES['audio']['name'];
            $audio_tmp = $_FILES['audio']['tmp_name'];
            move_uploaded_file($audio_tmp,"post_audio/$audio");
        }
        if(isset($_POST['video'])){
            $video = $_FILES['video']['name'];
            $video_tmp = $_FILES['video']['tmp_name'];
            move_uploaded_file($video_tmp,"post_videos/$video");
        }
    }

    $insert_c = "insert into tbl_depart_posts (department_id,text,audio,image) 
                  values ('$department_id','$text','$audio','$video')";
    $run_c = mysqli_query($link,$insert_c);
}else if(isset($_GET['getPosts'])){
    $department_id = get_sess("userdata")['doctor_department'];
    $link=mysqli_connect('localhost','root','','arbmdco');
    $get_post = "select * from products where department_id = '$department_id'";
    $run_posts = mysqli_query($link, $get_post);
    while ($run_posts= mysqli_fetch_array($run_posts)){
        $text = $run_posts['text'];
        $audio = $run_posts['audio'];
        $audio = $run_posts['audio'];
        //echo "<li> $text </li>"; // printing 
    }
}

?>
<html>
<body>
<div>
 <form action="posts.php" method="post" enctype="multipart/form-data">
                        <table align="center" width="750">
                            <tr align="center">
                                <td colspan="3"><h2>create a Post </h2></td>
                            </tr>
                            <tr>
                                <td align="right">Text: </td>
                                <td><input name="text" ></td>
                            </tr>
                            <tr>
                                <td align="right">Audio: </td>
                                <td><input type="file" name="audio" ></td>
                            </tr>
                            <tr>
                                <td align="right">Video: </td>
                                <td><input  type="file" name="video" ></td>
                            </tr>
                            <tr>
                                <td align="right">Image: </td>
                                <td><input type="file" name="c_image" required></td>
                            </tr>
                            <tr align="center">
                                <td colspan="3"><input type="submit" name="create" value="Create Post"></td>
                            </tr>
                        </table>

                    </form>
</div>
<div>

</div>
</body>
</html>