<?php require_once('layout/header.php');?>
<?php require_once('layout/sidebar.php');?>
<?php
$clinicID = get_sess("userdata")['clinic_id'];
$cntctSql = query("SELECT * FROM tbl_user_contact WHERE my_id = '$clinicID' AND my_type = 'clinic'");
$mycontacts = array();
while($contacts = fetch($cntctSql))
{
    $mycontacts[] = $contacts;
}
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
                        <h3>Add Contacts</h3>
                    </div>
                    <div class="panel-body">
                        <div class="search-connection-wrapper">
                            <form class="col-md-12" method="GET" action="">
                                <div class="col-sm-3 form-group">
                                    <label>Job Title</label>
                                    <input type="text" name="jobTitle" class="form-control">
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>Speciality</label>
                                    <select class="form-control select2" name="speciality">
                                        <option value="" selected disabled>Select Speciality</option>
                                        <?php 
                                        $specSQL = query("SELECT DISTINCT doc_speciality FROM tbl_doctor");
                                        while ($spec = fetch($specSQL))
                                        {
                                            ?>
                                            <option value="<?= $spec['doc_speciality'];?>"><?= $spec['doc_speciality'];?></option>
                                            <?php
                                        }
                                        $specSQL = query("SELECT can_speciality_name FROM tbl_candiate_speciality");
                                        while ($spec = fetch($specSQL))
                                        {
                                            ?>
                                            <option value="<?= $spec['can_speciality_name'];?>"><?= $spec['can_speciality_name'];?></option>
                                            <?php
                                        }
                                        $specSQL = query("SELECT dpt_service_title FROM tbl_clinic_service");
                                        while ($spec = fetch($specSQL))
                                        {
                                            ?>
                                            <option value="<?= $spec['dpt_service_title'];?>"><?= $spec['dpt_service_title'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>Location</label>
                                    <select class="form-control select2" name="location">
                                        <option value="" selected disabled>Select Location</option>
                                        <?php 
                                        $locSql = query("SELECT t1.city_name AS city FROM tbl_candidate_cities t1, tbl_cities t2 WHERE t1.city_name != t2.city_name Union all SELECT t2.city_name as city FROM tbl_candidate_cities t1, tbl_cities t2 WHERE t1.city_name != t2.city_name");
                                        $locData = array();;
                                        while($loc = fetch($locSql))
                                        {
                                            $locData[] = $loc['city'];
                                        }
                                        $newLocData = array_unique($locData);
                                        foreach($newLocData as $dataLoc)
                                        {
                                            ?>
                                            <option value="<?= $dataLoc;?>"> <?= $dataLoc;?> </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>Action</label><br>
                                    <button type="submit" class="btn btn-sm btn-danger">search</button>
                                </div>
                            </form>
                        </div>
                        <?php 
                        if(isset($_GET['jobTitle']) || isset($_GET['speciality']) || isset($_GET['location']))
                        {
                            ?>
                            <div class="list-wrapper">
                                <?php
                                $jobTitle   = (isset($_GET['jobTitle'])) ? get('jobTitle') : '' ;
                                $speciality = (isset($_GET['speciality'])) ? get('speciality') : '' ;
                                $location   = (isset($_GET['location'])) ? get('location') : '' ;

                                $userSQl  = query("SELECT * FROM tbl_doctor d join tbl_cities c ON (c.city_id = d.doc_city) WHERE d.doc_job_title LIKE '%".$jobTitle."%' OR d.doc_speciality LIKE '%".$speciality."%' OR c.city_name LIKE '%".$location."%' ");
                                while($data = fetch($userSQl))
                                {
                                    $showContact = true;
                                    foreach($mycontacts as $contact)
                                    {
                                        if($contact['contact_id'] == $data['doc_id'] && $contact['contact_type'] == 'Doctor')
                                        {
                                            $showContact = false;
                                        }
                                    }
                                    if($showContact)
                                    {
                                        ?>
                                        <div class="user-list-wrapper">
                                            <div class="user-image">
                                                <img class="img-fluid img-responsive" src="<?= file_url().$data['doc_image'];?>">
                                            </div>
                                            <div class="user-data">
                                                <h3><?= $data['doc_name']; ?></h3>
                                                <p><?= $data['doc_job_title']; ?></p>
                                                <p><?= 'Doctor'; ?></p>
                                            </div>
                                            <div class="user-action">
                                                <a href="<?= admin_base_url();?>model/centerModel?act=addContact&contactID=<?= $data['doc_id']; ?>&type=Doctor" class="round-button">Connect</a>
                                            </div>
                                            <hr>
                                        </div>
                                        <?php
                                    }
                                }
                                $userSQl  = query("SELECT * FROM 
                                    tbl_candidate d 
                                    LEFT JOIN tbl_candidate_cities c ON (c.city_id = d.candidate_city) 
                                    LEFT JOIN tbl_candiate_speciality cs ON (cs.can_speciality_id = d.candiate_speciality ) 
                                    WHERE d.candidate_job LIKE '%".$jobTitle."%' 
                                    OR cs.can_speciality_name LIKE '%".$speciality."%' 
                                    OR c.city_name LIKE '%".$location."%' ");
                                while($data = fetch($userSQl))
                                {
                                    foreach($mycontacts as $contact)
                                    {
                                        if($contact['contact_id'] == $data['candidate_id'] && $contact['contact_type'] == 'Professional')
                                        {
                                            $showContact = false;
                                        }
                                    }
                                    if($showContact)
                                    {
                                        ?>
                                        <div class="user-list-wrapper">
                                            <div class="user-image">
                                                <img class="img-fluid img-responsive" src="<?= file_url().$data['candidate_image'];?>">
                                            </div>
                                            <div class="user-data">
                                                <h3><?= $data['candidate_name']; ?></h3>
                                                <p><?= $data['candidate_job']; ?></p>
                                                <p><?= 'Professional'; ?></p>
                                            </div>
                                            <div class="user-action">
                                                <a href="<?= admin_base_url();?>model/centerModel?act=addContact&contactID=<?= $data['candidate_id']; ?>&type=Professional" class="round-button">Connect</a>
                                            </div>
                                            <hr>
                                        </div>
                                        <?php
                                    }
                                }

                                $userSQl  = query("SELECT * FROM 
                                    tbl_clinic d 
                                    LEFT JOIN tbl_cities c ON (c.city_id = d.clinic_city) 
                                    LEFT JOIN tbl_clinic_service cs ON (cs.dpt_clinic_id = d.clinic_id ) 
                                    WHERE (d.clinic_name LIKE '%".$jobTitle."%' 
                                    OR cs.dpt_service_title LIKE '%".$speciality."%' 
                                    OR c.city_name LIKE '%".$location."%') AND clinic_id != ".$clinicID."  GROUP BY clinic_id");
                                while($data = fetch($userSQl))
                                {
                                    foreach($mycontacts as $contact)
                                    {
                                        if($contact['contact_id'] == $data['clinic_id'] && $contact['contact_type'] == 'Clinic')
                                        {
                                            $showContact = false;
                                        }
                                    }
                                    if($showContact)
                                    {
                                        ?>
                                        <div class="user-list-wrapper">
                                            <div class="user-image">
                                                <img class="img-fluid img-responsive" src="<?= file_url().$data['clinic_icon'];?>">
                                            </div>
                                            <div class="user-data">
                                                <h3><?= $data['clinic_name']; ?></h3>
                                                <p><?= $data['dpt_service_title']; ?></p>
                                                <p><?= 'Clinic'; ?></p>
                                            </div>
                                            <div class="user-action">
                                                <a href="<?= admin_base_url();?>model/centerModel?act=addContact&contactID=<?= $data['clinic_id']; ?>&type=Clinic" class="round-button">Connect</a>
                                            </div>
                                            <hr>
                                        </div>
                                        <?php
                                    }
                                }

                                $userSQl  = query("SELECT * FROM 
                                    tbl_organization d 
                                    LEFT JOIN tbl_cities c ON (c.city_id = d.organization_city) 
                                    LEFT JOIN tbl_org_services cs ON (cs.org_id = d.organization_id  ) 
                                    WHERE (d.organization_name LIKE '%".$jobTitle."%' 
                                    OR cs.org_serv_title LIKE '%".$speciality."%' 
                                    OR c.city_name LIKE '%".$location."%') AND organization_id != ".$organizationID." GROUP BY organization_id");
                                while($data = fetch($userSQl))
                                {
                                    foreach($mycontacts as $contact)
                                    {
                                        if($contact['contact_id'] == $data['organization_id'] && $contact['contact_type'] == 'Organization')
                                        {
                                            $showContact = false;
                                        }
                                    }
                                    if($showContact)
                                    {
                                        ?>
                                        <div class="user-list-wrapper">
                                            <div class="user-image">
                                                <img class="img-fluid img-responsive" src="<?= file_url().$data['organization_icon'];?>">
                                            </div>
                                            <div class="user-data">
                                                <h3><?= $data['organization_name']; ?></h3>
                                                <p><?= $data['org_serv_title']; ?></p>
                                                <p><?= 'Organization'; ?></p>
                                            </div>
                                            <div class="user-action">
                                                <a href="<?= admin_base_url();?>model/centerModel?act=addContact&contactID=<?= $data['organization_id']; ?>&type=Organization" class="round-button">Connect</a>
                                            </div>
                                            <hr>
                                        </div>
                                        <?php
                                    }
                                }

                                ?>
                            </div>
                            <?php 
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <h3>My Contacts</h3>
                    </div>
                    <div class="panel-body">
                        <div class="list-wrapper">
                            <?php
                            $cntctSql = query("SELECT * FROM tbl_user_contact WHERE my_id = '$clinicID' AND my_type = 'clinic' AND active = 1");
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
                                elseif(strtolower($contactType) == "organization")
                                {
                                    $userSQl  = query("SELECT * FROM tbl_organization WHERE organization_id = $senderID");
                                    $userData = fetch($userSQl);
                                    $img      = $userData['organization_icon'];
                                    $name     = $userData['organization_name'];
                                    $ID       = $userData['organization_id'];
                                    $type     = 'Organization';
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