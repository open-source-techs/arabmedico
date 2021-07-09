<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php 
$org_id = get_sess("userdata")['org_id'];
$cntctSql = query("SELECT * FROM tbl_user_contact WHERE my_id = '$org_id' AND my_type = 'organizer'");
$mycontacts = array();
while($contacts = fetch($cntctSql))
{
    $mycontacts[] = $contacts;
}
?>
<script src="<?= admin_base_url();?>assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="<?= admin_base_url();?>assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
<style>
    .card{
        background: #fff;
    }
    .chat_list {
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
        width: 250px;
        position: absolute;
        left: 0;
        top: 0;
        padding: 20px 20px 20px 0;
        z-index: 1
    }

    @media only screen and (max-width: 767px) {
        .chat_list {
            -webkit-box-shadow: 0 0 10px rgba(41, 42, 51, 0.1);
            -moz-box-shadow: 0 0 10px rgba(41, 42, 51, 0.1);
            -ms-box-shadow: 0 0 10px rgba(41, 42, 51, 0.1);
            box-shadow: 0 0 10px rgba(41, 42, 51, 0.1);
            overflow-x: auto;
            background: #fff;
            padding: 15px;
            height: 100vh;
            width: 280px;
            position: fixed;
            top: 0;
            left: -400px
        }
        .chat_list.open {
            left: 0
        }
    }

    .chat_list .nav-tabs {
        padding: 0
    }

    .chat_list .user_list li {
        display: flex;
        padding: 10px 0
    }

    .chat_list .user_list li a {
        -moz-transition: all 0.5s;
        -o-transition: all 0.5s;
        -webkit-transition: all 0.5s;
        transition: all 0.5s;
        display: block;
        width: 100%;
        border-right: 2px solid transparent
    }

    .chat_list .user_list li a:hover {
        border-color: #999
    }

    .chat_list .user_list .name {
        font-size: 14px;
        color: #222
    }

    .chat_list .user_list img {
        -webkit-border-radius: 35px;
        -moz-border-radius: 35px;
        -ms-border-radius: 35px;
        border-radius: 35px;
        width: 35px;
        float: left
    }

    .chat_list .user_list .about {
        float: left;
        padding-left: 8px
    }

    .chat_window {
        margin-left: 250px
    }

    @media only screen and (max-width: 767px) {
        .chat_window {
            margin: 0
        }
    }

    .chat_window .chat-header {
        display: flex;
        justify-content: space-between
    }

    .chat_window .chat-header img {
        -webkit-border-radius: 40px;
        -moz-border-radius: 40px;
        -ms-border-radius: 40px;
        border-radius: 40px;
        float: left;
        width: 40px;
        height: 40px
    }

    .chat_window .chat-header .chat-about {
        float: left;
        padding-left: 10px
    }

    .chat_window .chat-header .chat-with {
        font-weight: 700;
        font-size: 16px
    }

    .chat_window .chat-header .chat-num-messages {
        color: #444
    }

    .chat_window .chat-history {
        padding: 20px;
        border-bottom: 2px solid #fff
    }

    @media only screen and (max-width: 1024px) {
        .chat_window .chat-history {
            height: calc(100vh - 340px);
            overflow-x: auto
        }
    }

    @media only screen and (max-width: 992px) {
        .chat_window .chat-history {
            height: calc(100vh - 320px);
            overflow-x: auto
        }
    }

    @media only screen and (max-width: 767px) {
        .chat_window .chat-history {
            height: calc(100vh - 280px);
            overflow-x: auto
        }
    }

    .chat_window .chat-history li {
        list-style: none
    }

    .chat_window .chat-history .message-data {
        margin-bottom: 15px
    }

    .chat_window .chat-history .message {
        -webkit-border-radius: 7px;
        -moz-border-radius: 7px;
        -ms-border-radius: 7px;
        border-radius: 7px;
        color: #444;
        font-size: 15px;
        padding: 18px 20px;
        line-height: 26px;
        margin-bottom: 30px;
        width: 90%;
        position: relative
    }

    .chat_window .chat-history .message:after {
        bottom: 100%;
        left: 7%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-bottom-color: #f0f0f0;
        border-width: 10px;
        margin-left: -10px
    }

    .chat_window .chat-history .message .attachment {
        display: flex
    }

    .chat_window .chat-history .my-message {
        background: #f0f0f0
    }

    .chat_window .chat-history .my-message:after {
        bottom: 100%;
        left: 7%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-bottom-color: #f0f0f0;
        border-width: 10px;
        margin-left: -10px
    }

    .chat_window .chat-history .other-message {
        background: #eceff1
    }

    .chat_window .chat-history .other-message:after {
        border-bottom-color: #eceff1;
        left: 93%
    }

    .chat_window .list_btn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
        padding: 0;
        width: 40px;
        height: 40px;
        text-align: center;
        line-height: 40px;
        display: none
    }

    @media only screen and (max-width: 767px) {
        .chat_window .list_btn {
            display: block
        }
    }

    .status {
        font-size: 12px;
        color: #999
    }

    .status i {
        font-size: 10px
    }

    .status.online i {
        color: #04BE5B
    }

    .status.offline i {
        color: #FF9948
    }

    .status.me i {
        color: #292a33
    }

    .status .name {
        color: #444;
        font-size: 16px;
        font-weight: 700
    }

    .status .time {
        color: #999;
        font-size: 12px;
        padding: 0 5px
    }

    @media only screen and (min-width: 768px) and (max-width: 992px) {
        .chat_list {
            height: 650px;
            overflow-x: auto
        }
        .chat-history {
            height: 600px;
            overflow-x: auto
        }
    }

    .contact .c_list .c_name {
        font-weight: 600
    }

    .contact .c_list address i {
        font-size: 15px;
        width: 15px
    }
    .chat_list{
        padding: 0px 15px 15px 0 !important;
    }
    .myclass{
        background: #fff;
        margin-top: 0px !important;
        border: 1px solid #eee;
            height: 830px;
        overflow-y:hidden;  
    }
    .chat_window{
            height: 830px;
    }
    .chat-history{
        overflow-y: scroll;
        height: 540px;
    }
    .chat-history::-webkit-scrollbar-track {
        background-color: transparent;
    }

    .chat-history::-webkit-scrollbar-thumb {
        background-color: #999;
        border-radius: 10px;
    }
    .chat-history::-webkit-scrollbar {
        width: 5px;
        background-color: transparent;
        position: absolute;
    }
    .myclass:hover
    {
        overflow-y: scroll !important; 
    }
    .myclass li{
        border-bottom: 1px solid #eee;  
    }
    .myclass li:last-child
    {
        border-bottom:none !important;
    }
    .myclass li.active{
        background: #e5f5ff;

    }
    .chat_list .myclass li a{
        padding: 0px 10px !important;
        border-right: none !important;
        border-left:3px solid transparent !important;
    }
    .chat_list .myclass li.active a
    {
        border-color: #11c2de !important;
    } 
    .chat_list .myclass li:hover a
    {
        border-color: #999 !important;
    } 
    .myclass::-webkit-scrollbar-track {
        background-color: transparent;
    }

    .myclass::-webkit-scrollbar-thumb {
        background-color: #999;
        border-radius: 10px;
    }
    .myclass::-webkit-scrollbar {
        width: 5px;
        background-color: transparent;
        position: absolute;
    }
    .count_class{
        margin-left: 5px;
        padding: 1px 4px;
        background: #fb9898;
        color: white;
        font-weight: bold;
    }
    .attachment img{
        max-height:300px;
        width:auto;
    }
    .chat-header .user{
        padding-top: 15px;
    }
    video{
        width: 100%;
    }
    .addToContact{
        padding: 24px 20px 0px 0px;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Inbox</h1>
            <small>All your Messages</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= admin_base_url();?>"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Inbox</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-success btn-icon float-right" data-toggle="modal" data-target="#send_message_box">New Message</button>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="chat_list">
                            <ul class="user_list list-unstyled mb-0 mt-3 myclass">
                                <script>var sender = Array();</script>
                                <?php
                                $org_id = get_sess("userdata")['org_id'];
                                $senderlist =array();
                                $sendersql = query("SELECT DISTINCT(c.sender), c.sender_type FROM tbl_chat c WHERE c.receiver = $org_id AND receiver_type = 'organizer'");
                                while ($senders = fetch($sendersql))
                                {
                                    // echo "acb";
                                    $senderID = $senders['sender'];
                                    echo "<script> if(sender.length == 0){sender [sender.length]= ".$senderID."} else {sender [sender.length + 1]= ".$senderID."} </script>";
                                    $senderlist[] = $senderID;
                                    $active = false;
                                    if(isset($_GET['IdChat']))
                                    {
                                        if($senderID == $_GET['IdChat'])
                                        {
                                            $active = true;
                                        }
                                        else
                                        {
                                            $active = false;
                                        }
                                    }
                                    else
                                    {
                                        $active = false;
                                    }
                                    ?>
                                    <li <?= ($active) ? 'class="active"' : ''; ?> id="div<?= $senderID;?>">
                                        <a href="<?= admin_base_url();?>inbox?IdChat=<?= $senderID;?>&Utype=<?= $senders['sender_type'];?>">
                                            <div class="d-flex">
                                                <?php
                                                if($senders['sender_type'] == "doctor")
                                                {
                                                    $docSQl     = query("SELECT * FROM tbl_doctor WHERE doc_id = $senderID");
                                                    $docData    = fetch($docSQl);
                                                    $userImage  = $docData['doc_image'];
                                                    $userName   = $docData['doc_name'];
                                                    $userType   = 'Doctor';
                                                }
                                                elseif($senders['sender_type'] == "clinic")
                                                {
                                                    $docSQl     = query("SELECT * FROM tbl_clinic WHERE clinic_id = $senderID");
                                                    $docData    = fetch($docSQl);
                                                    $userImage  = $docData['clinic_icon'];
                                                    $userName   = $docData['clinic_name'];
                                                    $userType   = 'Clinic';
                                                }
                                                elseif($senders['sender_type'] == "employer")
                                                {
                                                    $docSQl     = query("SELECT * FROM tbl_employer WHERE emp_id = $senderID");
                                                    $docData    = fetch($docSQl);
                                                    $userImage  = $docData['emp_logo'];
                                                    $userName   = $docData['emp_name'];
                                                    $userType   = 'Employer';
                                                }
                                                elseif($senders['sender_type'] == "organizer")
                                                {
                                                    $docSQl     = query("SELECT * FROM tbl_organizer WHERE org_id = $senderID");
                                                    $docData    = fetch($docSQl);
                                                    $userImage  = $docData['org_icon'];
                                                    $userName   = $docData['org_name'];
                                                    $userType   = 'Organizer';
                                                }
                                                elseif($senders['sender_type'] == "professional")
                                                {
                                                    $docSQl     = query("SELECT * FROM tbl_candidate WHERE candidate_id = $senderID");
                                                    $docData    = fetch($docSQl);
                                                    $userImage  = $docData['candidate_image'];
                                                    $userName   = $docData['candidate_name'];
                                                    $userType   = 'Professional';
                                                }
                                                ?>
                                                <img style="width: 50px;height: 50px;" style="width: 50px; height: 50px;" src="<?= file_url().$userImage;?>" alt="<?= $userType; ?>-image" />
                                                <div class="about">
                                                    <div class="name"><?= $userName;?></div>
                                                    <div class="status online">
                                                        <i class="zmdi zmdi-circle"></i> <?= $userType;?>
                                                        <span style="display: none" class="div_count_<?= $senderID; ?> count_class"></span>
                                                    </div>
                                                    <script>
                                                        $(document).ready(function(){
                                                            get_message_count('div_count_<?= $senderID; ?>','<?= $senderID; ?>');
                                                            setInterval( function() { get_message_count('div_count_<?= $senderID; ?>','<?= $senderID; ?>'); } , 3000);
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <?php
                                }
                                if(isset($senderlist[0]))
                                {
                                    $send_list = join(",",$senderlist);
                                    $sendersql = query("SELECT DISTINCT(c.receiver), c.receiver_type FROM tbl_chat c WHERE c.sender_type = 'organizer' AND c.sender = $org_id AND c.receiver NOT IN ($send_list) ");
                                }
                                else
                                {
                                    $sendersql = query("SELECT DISTINCT(c.receiver), c.receiver_type FROM tbl_chat c WHERE c.sender_type = 'organizer' AND c.sender = $org_id");
                                }
                                while ($sender = fetch($sendersql))
                                {
                                    $senderID = $sender['receiver'];
                                    echo "<script> if(sender.length == 0){sender [sender.length]= ".$senderID."} else {sender [sender.length + 1]= ".$senderID."} </script>";
                                    $senderlist[] = $senderID;
                                    $active = false;
                                    if(isset($_GET['IdChat']))
                                    {
                                        if($senderID == $_GET['IdChat'])
                                        {
                                            $active = true;
                                        }
                                        else
                                        {
                                            $active = false;
                                        }
                                    }
                                    else
                                    {
                                        $active = false;
                                    }
                                    ?>
                                    <li <?php if($active){echo 'class="active"';}?> id="div<?= $senderID;?>">
                                        <a href="<?= admin_base_url();?>inbox?IdChat=<?= $senderID;?>&Utype=<?= $sender['receiver_type'];?>">
                                            <div class="d-flex">
                                                <?php
                                                if($senders['receiver_type'] == "doctor")
                                                {
                                                    $docSQl     = query("SELECT * FROM tbl_doctor WHERE doc_id = $senderID");
                                                    $docData    = fetch($docSQl);
                                                    $userImage  = $docData['doc_image'];
                                                    $userName   = $docData['doc_name'];
                                                    $userType   = 'Doctor';
                                                }
                                                elseif($senders['receiver_type'] == "clinic")
                                                {
                                                    $docSQl     = query("SELECT * FROM tbl_clinic WHERE clinic_id = $senderID");
                                                    $docData    = fetch($docSQl);
                                                    $userImage  = $docData['clinic_icon'];
                                                    $userName   = $docData['clinic_name'];
                                                    $userType   = 'Clinic';
                                                }
                                                elseif($senders['receiver_type'] == "employer")
                                                {
                                                    $docSQl     = query("SELECT * FROM tbl_employer WHERE emp_id = $senderID");
                                                    $docData    = fetch($docSQl);
                                                    $userImage  = $docData['emp_logo'];
                                                    $userName   = $docData['emp_name'];
                                                    $userType   = 'Employer';
                                                }
                                                elseif($senders['receiver_type'] == "organizer")
                                                {
                                                    $docSQl     = query("SELECT * FROM tbl_organizer WHERE org_id = $senderID");
                                                    $docData    = fetch($docSQl);
                                                    $userImage  = $docData['org_icon'];
                                                    $userName   = $docData['org_name'];
                                                    $userType   = 'Organizer';
                                                }
                                                elseif($senders['receiver_type'] == "professional")
                                                {
                                                    $docSQl     = query("SELECT * FROM tbl_candidate WHERE candidate_id = $senderID");
                                                    $docData    = fetch($docSQl);
                                                    $userImage  = $docData['candidate_image'];
                                                    $userName   = $docData['candidate_name'];
                                                    $userType   = 'Professional';
                                                }
                                                ?>
                                                <img style="width: 50px;height: 50px;" style="width: 50px; height: 50px;" src="<?= file_url().$userImage;?>" alt="<?= $userType; ?>-image" />
                                                <div class="about">
                                                    <div class="name"><?= $userName;?></div>
                                                    <div class="status online">
                                                        <i class="zmdi zmdi-circle"></i> <?= $userType;?>
                                                        <span style="display: none" class="div_count_<?= $senderID; ?> count_class"></span>
                                                    </div>
                                                    <script>
                                                        $(document).ready(function(){
                                                            get_message_count('div_count_<?= $senderID; ?>','<?= $senderID; ?>');
                                                            setInterval( function() { get_message_count('div_count_<?= $senderID; ?>','<?= $senderID; ?>'); } , 3000);
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                                <script>
                                    $(document).ready(function(){
                                        get_new_sender();
                                        setInterval( get_new_sender , 10000);
                                    });
                                </script>
                            </ul>
                        </div>
                        <div class="chat_window body" id="chat_window">
                            <?php
                            if(isset($_GET['IdChat']))
                            {
                                $senderID       = $_GET['IdChat'];
                                $sender_type    = $_GET['Utype'];
                                if($sender_type == "doctor")
                                {
                                    $docSQl     = query("SELECT * FROM tbl_doctor WHERE doc_id = $senderID");
                                    $docData    = fetch($docSQl);
                                    $userType   = 'Doctor';
                                    $userID     = $docData['doc_id'];
                                    $userImage  = $docData['doc_image'];
                                    $userName   = $docData['doc_name'];
                                }
                                else if($sender_type == "clinic")
                                {
                                    $docSQl     = query("SELECT * FROM tbl_clinic WHERE clinic_id = $senderID");
                                    $docData    = fetch($docSQl);
                                    $userType   = 'Clinic';
                                    $userID     = $docData['clinic_id'];
                                    $userImage  = $docData['clinic_icon'];
                                    $userName   = $docData['clinic_name'];
                                }
                                else if($sender_type == "employer")
                                {
                                    $docSQl     = query("SELECT * FROM tbl_employer WHERE emp_id = $senderID");
                                    $docData    = fetch($docSQl);
                                    $userType   = 'Employer';
                                    $userID     = $docData['emp_id'];
                                    $userImage  = $docData['emp_logo'];
                                    $userName   = $docData['emp_name'];
                                }
                                else if($sender_type == "organizer")
                                {
                                    $docSQl     = query("SELECT * FROM tbl_organizer WHERE org_id = $senderID");
                                    $docData    = fetch($docSQl);
                                    $userType   = 'Organizer';
                                    $userID     = $docData['org_id'];
                                    $userImage  = $docData['org_icon'];
                                    $userName   = $docData['org_name'];
                                }
                                else if($sender_type == "professional")
                                {
                                    $docSQl     = query("SELECT * FROM tbl_candidate WHERE candidate_id = $senderID");
                                    $docData    = fetch($docSQl);
                                    $userType   = 'Professional';
                                    $userID     = $docData['candidate_id'];
                                    $userImage  = $docData['candidate_image'];
                                    $userName   = $docData['candidate_name'];
                                }
                                ?>
                                <div class="chat-header">
                                    <div class="user">
                                        <img src="<?= file_url().$userImage; ?>" alt="doctor-image" />
                                        <div class="chat-about">
                                            <div class="chat-with"><?= $userName;?></div>
                                            <div class="chat-num-messages"><?= $userType; ?></div>
                                        </div>
                                    </div>
                                    <div class="addToContact">
                                        <?php
                                        $showContact = true;
                                        foreach($mycontacts as $contact)
                                        {
                                            if($contact['contact_id'] == $userID && $contact['contact_type'] == $userType)
                                            {
                                                $showContact = false;
                                            }
                                        }
                                        if($showContact)
                                        {
                                            ?>
                                            <a href="<?= admin_base_url();?>model/centerModel?act=addContact&contactID=<?= $userID; ?>&type=<?= $userType;?>" class="btn btn-md btn-warning">Add to contact</a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                <ul class="chat-history">
                                    <?php
                                    $msgsql = query("SELECT * FROM tbl_chat WHERE (sender = $senderID AND receiver = $org_id AND receiver_type = 'organizer' AND sender_type = '$sender_type') OR (sender = $org_id AND receiver = $senderID AND receiver_type = '$sender_type' AND sender_type = 'organizer') ORDER BY chat_id ASC");
                                    while ($msg = fetch($msgsql))
                                    {
                                        if($msg['sender_type'] == "organizer")
                                        {
                                            $receiverId = $msg['receiver'];
                                            ?>
                                            <li class="clearfix">
                                                <div class="status online message-data text-right">
                                                    <span class="name">You</span>
                                                    <span class="time"> <?= date('d/m/Y h:i a', strtotime($msg['date']));?></span>
                                                </div>
                                                <div class="message other-message float-right">
                                                    <?php
                                                    if($msg['chat_media'] != null)
                                                    {
                                                        $msg['file_extension'] = substr($msg['chat_media'], strripos($msg['chat_media'], '.'));
                                                        if(strtolower($msg['file_extension']) == '.jpg' || strtolower($msg['file_extension']) == '.png' || strtolower($msg['file_extension']) == '.jpeg')
                                                        {
                                                            ?>
                                                            <div class="attachment">
                                                                <a href="<?= file_url().$msg['chat_media'];?>" target="_blank"><img src="<?= file_url().$msg['chat_media'];?>" alt="" class="img-fluid img-thumbnail"></a>
                                                            </div>
                                                            <?php
                                                        }
                                                        else if(strtolower($msg['file_extension']) == ".docx")
                                                        {
                                                            ?>
                                                            <div class="attachment">
                                                                <a href="<?= file_url().$msg['chat_media'];?>" target="_blank">
                                                                    <img src="<?= file_url().'/upload/docx.png';?>" alt="" class="img-fluid img-thumbnail" style="max-height: 80px;width: auto;">
                                                                </a>
                                                            </div>
                                                            <?php
                                                        }
                                                        else if(strtolower($msg['file_extension']) == ".xlsx")
                                                        {
                                                            ?>
                                                            <div class="attachment">
                                                                <a href="<?= file_url().$msg['chat_media'];?>" target="_blank">
                                                                    <img src="<?= file_url().'/upload/excel.png';?>" alt="" class="img-fluid img-thumbnail" style="max-height: 80px;width: auto;">
                                                                </a>
                                                            </div>
                                                            <?php
                                                        }
                                                        else if(strtolower($msg['file_extension']) == ".3gp" || strtolower($msg['file_extension']) == ".mp4" || strtolower($msg['file_extension']) == ".mkv"  || strtolower($msg['file_extension']) == ".avi")
                                                        {
                                                            $file_basename = substr($msg['chat_media'], 0, strripos($msg['chat_media'], '.'));
                                                            $ext = explode('.', $msg['file_extension']);
                                                            ?>
                                                            <div class="attachment">
                                                                <a href="<?= file_url().$msg['chat_media'];?>" target="_blank">
                                                                    <video class="img-fluid" controls >
                                                                        <source src="<?= file_url().$msg['chat_media'];?>" type="video/<?= $ext[1];?>">
                                                                        <source src="<?= file_url().$file_basename;?>.ogg" type="video/ogg">
                                                                    </video>
                                                                </a>
                                                            </div>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <div class="attachment">
                                                                <a href="<?= file_url().$msg['chat_media'];?>" target="_blank">
                                                                    <img src="<?= file_url().'uploads/file.png';?>" alt="" class="img-fluid img-thumbnail" style="max-height: 80px;width: auto;">
                                                                </a>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <p><?= $msg['chat_message'];?></p>
                                                </div>
                                            </li>
                                            <?php
                                            query("UPDATE `tbl_chat` SET chat_read = 1 WHERE sender = $org_id AND receiver = $senderID AND receiver_type = '$sender_type' AND sender_type = 'organizer'");
                                        }
                                        else
                                        {
                                            $receiverId = $msg['receiver'];
                                            if($msg['sender'] == $senderID)
                                            {
                                                $sender_type = $msg['sender_type'];
                                                ?>
                                                <li>
                                                    <?php
                                                    if($sender_type == "doctor")
                                                    {
                                                        $docSQl   = query("SELECT * FROM tbl_doctor WHERE doc_id = $senderID");
                                                        $docData  = fetch($docSQl);
                                                        $userName = $docData['doc_name'];
                                                        $userDate = $msg['date'];
                                                    }
                                                    elseif($sender_type == "clinic")
                                                    {
                                                        $docSQl   = query("SELECT * FROM tbl_clinic WHERE clinic_id = $senderID");
                                                        $docData  = fetch($docSQl);
                                                        $userName = $docData['clinic_name'];
                                                        $userDate = $msg['date'];
                                                    }
                                                    elseif($sender_type == "employer")
                                                    {
                                                        $docSQl   = query("SELECT * FROM tbl_employer WHERE emp_id = $senderID");
                                                        $docData  = fetch($docSQl);
                                                        $userName = $docData['emp_name'];
                                                        $userDate = $msg['date'];
                                                    }
                                                    elseif($sender_type == "organizer")
                                                    {
                                                        $docSQl   = query("SELECT * FROM tbl_organizer WHERE org_id = $senderID");
                                                        $docData  = fetch($docSQl);
                                                        $userName = $docData['org_name'];
                                                        $userDate = $msg['date'];
                                                    }
                                                    elseif($sender_type == "professional")
                                                    {
                                                        $userSQl  = query("SELECT * FROM tbl_candidate WHERE candidate_id = $senderID");
                                                        $userData = fetch($userSQl);
                                                        $userName = $userData['candidate_name'];
                                                        $userDate = $msg['date'];
                                                    }
                                                    ?>
                                                    <div class="status message-data">
                                                        <span class="name"><?= $userName; ?></span>
                                                        <?= date('d/m/Y h:i a', strtotime($userDate));?>
                                                    </div>
                                                    <div class="message my-message">
                                                       <?php
                                                        if($msg['chat_media'] != null)
                                                        {
                                                            $msg['file_extension'] = substr($msg['chat_media'], strripos($msg['chat_media'], '.'));
                                                            if(strtolower($msg['file_extension']) == '.jpg' || strtolower($msg['file_extension']) == '.png' || strtolower($msg['file_extension']) == '.jpeg')
                                                            {
                                                                ?>
                                                                <div class="attachment">
                                                                    <a href="<?= file_url().$msg['chat_media'];?>" target="_blank"><img src="<?= file_url().$msg['chat_media'];?>" alt="" class="img-fluid img-thumbnail"></a>
                                                                </div>
                                                                <?php
                                                            }
                                                            else if(strtolower($msg['file_extension']) == ".docx")
                                                            {
                                                                ?>
                                                                <div class="attachment">
                                                                    <a href="<?= file_url().$msg['chat_media'];?>" target="_blank">
                                                                        <img src="<?= file_url().'/upload/docx.png';?>" alt="" class="img-fluid img-thumbnail" style="max-height: 80px;width: auto;">
                                                                    </a>
                                                                </div>
                                                                <?php
                                                            }
                                                            else if(strtolower($msg['file_extension']) == ".xlsx")
                                                            {
                                                                ?>
                                                                <div class="attachment">
                                                                    <a href="<?= file_url().$msg['chat_media'];?>" target="_blank">
                                                                        <img src="<?= file_url().'/upload/excel.png';?>" alt="" class="img-fluid img-thumbnail" style="max-height: 80px;width: auto;">
                                                                    </a>
                                                                </div>
                                                                <?php
                                                            }
                                                            else if(strtolower($msg['file_extension']) == ".3gp" || strtolower($msg['file_extension']) == ".mp4" || strtolower($msg['file_extension']) == ".mkv"  || strtolower($msg['file_extension']) == ".avi")
                                                            {
                                                                $file_basename = substr($msg['chat_media'], 0, strripos($msg['chat_media'], '.'));
                                                                $ext = explode('.', $msg['file_extension']);
                                                                ?>
                                                                <div class="attachment">
                                                                    <a href="<?= file_url().$msg['chat_media'];?>" target="_blank">
                                                                        <video class="img-fluid" controls >
                                                                            <source src="<?= file_url().$msg['chat_media'];?>" type="video/<?= $ext[1];?>">
                                                                            <source src="<?= file_url().$file_basename;?>.ogg" type="video/ogg">
                                                                        </video>
                                                                    </a>
                                                                </div>
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                ?>
                                                                <div class="attachment">
                                                                    <a href="<?= file_url().$msg['chat_media'];?>" target="_blank">
                                                                        <img src="<?= file_url().'/upload/file.png';?>" alt="" class="img-fluid img-thumbnail" style="max-height: 80px;width: auto;">
                                                                    </a>
                                                                </div>
                                                                <?php
                                                            }
                                                            }
                                                        ?>
                                                        <p><?= $msg['chat_message'];?></p>
                                                    </div>
                                                </li> 
                                                <?php
                                            }
                                            query("UPDATE `tbl_chat` SET chat_read = 1 WHERE sender = $senderID AND receiver = $org_id AND receiver_type = 'organizer' AND sender_type = '$sender_type'");
                                        }
                                    }
                                    $msgsql = query("SELECT * FROM tbl_chat WHERE  ORDER BY chat_id ASC");
                                    while ($msg = fetch($msgsql))
                                    {
                                        
                                    }
                                    ?>
                                </ul>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="hidden" name="txt_action" id="txt_action" value="send_message">
                                        <textarea rows="3" class="form-control" placeholder="Enter text here..." name="txt_message" id="txt_message" ></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" class="dropify" name="txt_file" id="txt_file">
                                    </div>
                                    <div class="form-group text-right">
                                        <input type="hidden" name="txt_receiver" id="txt_receiver" value="<?= $senderID;?>">
                                        <input type="hidden" name="txt_receiverType" id="txt_receiverType" value="<?= $sender_type;?>">
                                        <button class="btn btn-primary btn-md" type="button" id="send_message">Send</button>
                                    </div>
                                </div>
                                <?php
                            }
                            else
                            {
                                ?>
                                <h4>Please select user to view message</h4>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="send_message_box" tabindex="-1" role="dialog" aria-labelledby="send_message_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Select User to send message</h4>
            </div>
            <form action="<?= admin_base_url();?>model/centerModel" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group col-sm-12">
                        <select class="form-control show-tick ms select2" name="txt_receiverType" id="txt_receiverType">
                            <option>Select Reciver Type</option>
                            <option value="doctor">Doctor</option>
                            <option value="clinic">Clinic</option>
                            <option value="employer">Employer</option>
                            <option value="organizer">Organizer</option>
                            <option value="professional">Professional</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-12">
                        <select class="form-control show-tick ms select2" name="txt_receiver" id="txt_receiver">
                            
                        </select>
                    </div>
                    <div class="form-group col-sm-12">
                        <input type="text" class="form-control" placeholder="Enter text here..." name="txt_message" id="txt_message" >
                    </div>
                    <div class="form-group col-sm-12">
                        <input type="file" class="form-control" name="chat_media" id="txt_file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="newmessage" class="btn btn-success">Send Message</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
<?php 
require_once('layout/footer.php');
get_msg('msg');
?>
<script>
    function get_new_sender()
    {
        var action = "fetch_list";
        $.ajax({
            data: {fetch_list:action,sender_list:sender},
            url: "<?= admin_base_url();?>model/centerModel",
            type: "post",
            success:function(responce)
            {
                // alert(responce);
                if(responce != "not found")
                {
                    var res = $.parseJSON(responce);
                    $.each(res,function(index,value){
                        if(sender.length == 0){sender [sender.length]= value.id;} else {sender [sender.length + 1]= value.id;}
                        var online = value.name;
                        var li = '<li id="div'+value.id+'">'+
                            '<a href="<?= admin_base_url();?>inbox?IdChat='+value.id+'&Utype='+value.type+'">'+
                                '<img src="<?= file_url();?>'+ value.img +'" alt="avatar" />'+
                                '<div class="about">'+
                                    '<div class="name">'+value.name+'</div>'+
                                    '<script>'+
                                        '$(document).ready(function(){'+
                                            'get_message_count(\'div_count_'+value.id+'\',\''+value.id+'\');'+
                                            'setInterval( function() { get_message_count(\'div_count_'+value.id+'\',\''+value.id+'\'); } , 3000);'+
                                        '});'+
                                    '<\/script>'+
                                '</div>'+
                            '</a>'+
                        '</li>';
                        $(".myclass").append(li);
                    });
                }
            }
        });
    }
    function get_message()
    {
        var action = "fetch";
        var sender = $("#txt_receiver").val();
        if(sender != null && sender != "")
        {
            $.ajax({
                data: {act:action,sender_emp:sender},
                url: "<?= admin_base_url();?>model/centerModel",
                type: "post",
                success:function(responce)
                {
                    if(responce != 0)
                    {
                        var res = $.parseJSON(responce);
                        var li = '<li>'+
                            '<div class="status message-data">'+
                                '<span class="name">'+res.name+'</span>'+
                                ' '+res.date+
                            '</div>'+
                            '<div class="message my-message">';
                            if(res.chat_media != null && res.chat_media != '')
                            {
                                var extension = res.chat_media.split('.').pop();
                                if(extension.toLowerCase() == 'jpg' || extension.toLowerCase() == 'png' || extension.toLowerCase() == 'jpeg')
                                {
                                li+='<div class="attachment">'+
                                        '<a href="<?= file_url();?>'+res.chat_media+'" target="_blank">'+
                                            '<img src="<?= file_url();?>'+res.chat_media+'" alt="" class="img-fluid img-thumbnail">'+
                                        '</a>'+
                                    '</div>';
                                }
                                else if(extension.toLowerCase() == "docx")
                                {
                                li+='<div class="attachment">'+
                                        '<a href="<?= file_url();?>'+res.chat_media+'" target="_blank">'+
                                            '<img src="<?= file_url().'/upload/docx.png';?>" alt="" class="img-fluid img-thumbnail" style="max-height: 80px;width: auto;">'+
                                        '</a>'+
                                    '</div>';
                                }
                                else if(extension.toLowerCase() == "xlsx")
                                {
                                li+='<div class="attachment">'+
                                        '<a href="<?= file_url();?>'+res.chat_media+'" target="_blank">'+
                                            '<img src="<?= file_url().'/upload/excel.png';?>" alt="" class="img-fluid img-thumbnail" style="max-height: 80px;width: auto;">'+
                                        '</a>'+
                                    '</div>';
                                }
                                else if(extension.toLowerCase() == "3gp" || extension.toLowerCase() == "mp4" || extension.toLowerCase() == "mkv"  || extension.toLowerCase() == "avi")
                                {
                                    var filename = res.chat_media.split('.')[0];
                                li+= '<div class="attachment">'+
                                        '<a href="<?= file_url();?>'+res.chat_media+'" target="_blank">'+
                                            '<video class="img-fluid" controls >'+
                                                '<source src="<?= file_url();?>'+res.chat_media+'" type="video/'+extension+'">'+
                                                '<source src="<?= file_url();?>'+res.filename+'.ogg" type="video/ogg">'+
                                            '</video>'+
                                        '</a>'+
                                    '</div>';
                                }
                                else
                                {
                                    li+='<div class="attachment">'+
                                        '<a href="<?= file_url();?>'+res.chat_media+'" target="_blank">'+
                                            '<img src="<?= file_url().'/upload/file.png';?>" alt="" class="img-fluid img-thumbnail" style="max-height: 80px;width: auto;">'+
                                        '</a>'+
                                    '</div>';
                                }
                            }
                            li += '<p>'+res.chat_message+'</p></div></li> ';
                        $(".chat-history").append(li);
                        $('.chat-history').scrollTop($('.chat-history')[0].scrollHeight);
                    }
                }
            });
        }
    }

    function get_message_count(dom,sender_id)
    {
        // return;
        var action = "fetch_count";
        if(sender_id != null && sender_id != "")
        {
            $.ajax({
                data: {fetch_count:action,sender_emp:sender_id},
                url: "<?= admin_base_url();?>model/centerModel",
                type: "post",
                success:function(responce)
                {
                    // alert(responce);
                    if(responce == 0)
                    {
                        $("."+dom).hide();
                    }
                    else
                    {
                        $("."+dom).show();
                        $("."+dom).html(responce);
                    }
                    // return responce;
                }
            });
        }
    }

    
    $(document).ready(function(){
        // $('.dropify').dropify();
        $("#txt_message").keyup(function(e){
            e.preventDefault();
            var code = e.keycode | e.which;
            if(code == 13)
            {
                $("#send_message").click();
            }
        });

        setInterval(get_message,3000);
        <?php
        if(isset($_GET['IdChat']))
        {
            ?>
            $('.chat-history').animate({
                scrollTop: $(".chat-history li:last-child").offset().top
            }, 900);
            <?php
        }
        ?>
        $("#send_message").click(function(e){
            e.preventDefault();
            
            if($("#txt_message").val() != null || $("#txt_message").val() != "" || $('#txt_file').val() != null || $('#txt_file').val() != "")
            {
                var img = document.getElementById('txt_file').files[0];
                var form_data = new FormData();
                form_data.append('chat_media',img);
                form_data.append('txt_action',$("#txt_action").val());
                form_data.append('txt_message',$("#txt_message").val());
                form_data.append('txt_receiver',$("#txt_receiver").val());
                form_data.append('txt_receiverType',$("#txt_receiverType").val());
                $(".page-loader-wrapper").show();
                $.ajax({
                    data: form_data,
                    url: "<?= admin_base_url();?>model/centerModel",
                    type: "post",
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(responce)
                    {
                        if(responce != "error")
                        {
                            var res = $.parseJSON(responce);
                            var li = '<li class="clearfix">'+
                            '<div class="status online message-data text-right">'+
                                '<span class="name">You</span>'+' '+res.date+
                            '</div>'+
                            '<div class="message other-message float-right">';
                            if(res.media != null)
                            {
                                var extension = res.media.split('.').pop();
                                if(extension.toLowerCase() == 'jpg' || extension.toLowerCase() == 'png' || extension.toLowerCase() == 'jpeg')
                                {
                                li+='<div class="attachment">'+
                                        '<a href="<?= file_url();?>'+res.media+'" target="_blank">'+
                                            '<img src="<?= file_url();?>'+res.media+'" alt="" class="img-fluid img-thumbnail">'+
                                        '</a>'+
                                    '</div>';
                                }
                                else if(extension.toLowerCase() == "docx")
                                {
                                li+='<div class="attachment">'+
                                        '<a href="<?= file_url();?>'+res.media+'" target="_blank">'+
                                            '<img src="<?= file_url().'/upload/docx.png';?>" alt="" class="img-fluid img-thumbnail" style="max-height: 80px;width: auto;">'+
                                        '</a>'+
                                    '</div>';
                                }
                                else if(extension.toLowerCase() == "xlsx")
                                {
                                li+='<div class="attachment">'+
                                        '<a href="<?= file_url();?>'+res.media+'" target="_blank">'+
                                            '<img src="<?= file_url().'/upload/excel.png';?>" alt="" class="img-fluid img-thumbnail" style="max-height: 80px;width: auto;">'+
                                        '</a>'+
                                    '</div>';
                                }
                                else if(extension.toLowerCase() == "3gp" || extension.toLowerCase() == "mp4" || extension.toLowerCase() == "mkv"  || extension.toLowerCase() == "avi")
                                {
                                    var filename = res.media.split('.')[0];
                                li+= '<div class="attachment">'+
                                        '<a href="<?= file_url();?>'+res.media+'" target="_blank">'+
                                            '<video class="img-fluid" controls >'+
                                                '<source src="<?= file_url();?>'+res.media+'" type="video/'+extension+'">'+
                                                '<source src="<?= file_url();?>'+res.filename+'.ogg" type="video/ogg">'+
                                            '</video>'+
                                        '</a>'+
                                    '</div>';
                                }
                                else
                                {
                                    li+='<div class="attachment">'+
                                        '<a href="<?= file_url();?>'+res.media+'" target="_blank">'+
                                            '<img src="<?= file_url().'/upload/file.png';?>" alt="" class="img-fluid img-thumbnail" style="max-height: 80px;width: auto;">'+
                                        '</a>'+
                                    '</div>';
                                }
                            }
                            li += '<p>'+res.msg+'</p></div></li> ';
                        $(".chat-history").append(li);
                        $('.chat-history').scrollTop($('.chat-history')[0].scrollHeight);
                        $("#txt_message").val('');
                        $("#txt_file").val('');
                        // $('.dropify').dropify();
                        
                        }
                    }
                });
                $(".page-loader-wrapper").hide();
            }
        });
    });
    $(document).ready(function(){{
        $("#txt_receiverType").change(function(){
            var val = $(this).val();
            var act = "getUserList";
            $.ajax({
                data: {action:act, value:val},
                url: "<?= admin_base_url()?>model/centerModel",
                type: 'post',
                success: function(responce){
                    var res = $.parseJSON(responce);
                    if(res.status == "success")
                    {
                        $("#txt_receiver").empty();
                        $("#txt_receiver").append('<option>Select User</option>');
                        var data = res.data;
                        $.each(data, function(index, value)
                        {
                            li = '<option value="'+value.id+'" >'+value.name+'</option>';
                            $("#txt_receiver").append(li);
                        });
                    }
                    else
                    {
                        alert("No User found");
                    }
                }
            });
        });
    }});
</script>