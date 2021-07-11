<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$doc_id = get_sess("userdata")['doc_id'];
?>
<style>
    .list-wrapper{
        padding: 0px 20px 0px 20px;
    }
    .user-list-wrapper{
        display: flex;
        justify-content: flex-start;
        padding: 10px 10px;
        background: #f3f3f3;
    }
    .user-image{
        width: 7%;
    }
    .user-image img{
        width: 50px;
        border-radius: 50%;
    }
    .user-data{
        width: 74%;
    }
    .user-data h3{
        margin: 0px !important;
    }
    .user-data p{
        margin: 0px !important;
    }
    .user-list-wrapper hr{
        height: 1px;
        margin: 5px 0px;
    }
    .user-action{
        margin-top: 20px;
    }
    .user-action .round-button{
        color: #00a3c8;
        padding: 5px 20px;
        background: none;
        border-radius: 50px;
        border: 2px solid #00a3c8;
    }
    .user-action .round-button-red{
        color: #E5343D;
        padding: 5px 20px;
        background: none;
        border-radius: 50px;
        border: 2px solid #E5343D;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            <h1>Contacts</h1>
            <small>My Contacts</small>
            <ol class="breadcrumb hidden-xs">
                <li>
                    <a href="<?= admin_base_url();?>">
                        <i class="pe-7s-home"></i> Home
                    </a>
                </li>
                <li class="active">Contacts</li>
            </ol>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        
                    </div>
                    <div class="panel-body">
                        <div class="list-wrapper">
                            <?php
                            $cntctSql = query("SELECT * FROM tbl_user_contact WHERE my_id = '$doc_id' AND my_type = 'doctor' AND active = 1");
                            while ($row = fetch($cntctSql))
                            {
                                $tableID      = $row['u_contact_id'];
                                $contactID    = $row['contact_id'];
                                $contactType  = $row['contact_type'];
                                if(strtolower($contactType) == 'doctor')
                                {
                                    $userSQl  = query("SELECT * FROM tbl_doctor WHERE doc_id = $contactID");
                                    $userData = fetch($userSQl);
                                    $img      = $userData['doc_image'];
                                    $name     = $userData['doc_name'];
                                    $ID       = $userData['doc_id'];
                                    $type     = 'Doctor';
                                }
                                else if(strtolower($contactType) == 'clinic')
                                {
                                    $userSQl  = query("SELECT * FROM tbl_clinic WHERE clinic_id = $contactID");
                                    $userData = fetch($userSQl);
                                    $img      = $userData['clinic_icon'];
                                    $name     = $userData['clinic_name'];
                                    $ID       = $userData['clinic_id'];
                                    $type     = 'Clinic';
                                }
                                else if(strtolower($contactType) == 'employer')
                                {
                                    $userSQl  = query("SELECT * FROM tbl_employer WHERE emp_id = $contactID");
                                    $userData = fetch($userSQl);
                                    $img      = $userData['emp_logo'];
                                    $name     = $userData['emp_name'];
                                    $ID       = $userData['emp_id'];
                                    $type     = 'Employer';
                                }
                                else if(strtolower($contactType) == 'organizer')
                                {
                                    $userSQl  = query("SELECT * FROM tbl_organizer WHERE org_id = $contactID");
                                    $userData = fetch($userSQl);
                                    $img      = $userData['org_icon'];
                                    $name     = $userData['org_name'];
                                    $ID       = $userData['org_id'];
                                    $type     = 'Organizer';
                                }
                                else if(strtolower($contactType) == 'professional')
                                {
                                    $userSQl  = query("SELECT * FROM tbl_candidate WHERE candidate_id = $contactID");
                                    $userData = fetch($userSQl);
                                    $img      = $userData['candidate_image'];
                                    $name     = $userData['candidate_name'];
                                    $ID       = $userData['candidate_id'];
                                    $type     = 'Professional';
                                }
                                ?>
                                <div class="user-list-wrapper">
                                    <div class="user-image">
                                        <img class="img-fluid img-responsive" src="<?= file_url().$img;?>">
                                    </div>
                                    <div class="user-data">
                                        <h3><?= $name; ?></h3>
                                        <p><?= $type; ?></p>
                                        <p><?= "Connected " . time_ago($row['created_at']);?></p>
                                    </div>
                                    <div class="user-action">
                                        <button class="round-button btnSendMsg" data-id="<?= $ID; ?>" data-type="<?= strtolower($type);?>">Message</button>
                                        <a class="round-button-red btnBlockUser" href="<?= admin_base_url();?>model/centerModel?act=removeUser&contactID=<?= $tableID;?>">Remove</a>
                                    </div>
                                    <hr>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="send_message_box" tabindex="-1" role="dialog" aria-labelledby="send_message_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Enter Message</h4>
            </div>
            <form action="<?= admin_base_url();?>model/centerModel" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="txt_receiver" id="txt_receiver">
                    <input type="hidden" name="txt_receiverType" id="txt_receiverType">
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
<?php require_once('layout/footer.php');?>
<?php
get_msg('msg');
?>
<script>
    $(document).ready(function(){
        $(".btnSendMsg").click(function(){
            $("#txt_receiver").val($(this).attr("data-id"));
            $("#txt_receiverType").val($(this).attr("data-type"));
            $("#send_message_box").modal();
        });
    });
</script>