<?php
require_once('../config/db.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['action']) && $_POST['action'] == "getUserList")
	{
		$type = post('value');
		if($type == "doctor")
		{
			$data = array();
			$sql = query("SELECT * FROM tbl_doctor");
			if(nrows($sql) > 0)
			{
				$i = 0;
				while($sqlData = fetch($sql))
				{
					$data[$i]['id'] = $sqlData['doc_id'];
					$data[$i]['name'] = $sqlData['doc_name'];
					$i++;
				}
				$result = array("status" => "success", "data" => $data);
			}
			else
			{
				$result = array("status" => "error", "data" => null);
			}
			echo json_encode($result);
		}
		else if($type == "clinic")
		{
			$data = array();
			$sql = query("SELECT * FROM tbl_clinic WHERE clinic_id != ".get_sess("userdata")['clinic_id']);
			if(nrows($sql) > 0)
			{
				$i = 0;
				while($sqlData = fetch($sql))
				{
					$data[$i]['id'] = $sqlData['clinic_id'];
					$data[$i]['name'] = $sqlData['clinic_name'];
					$i++;
				}
				$result = array("status" => "success", "data" => $data);
			}
			else
			{
				$result = array("status" => "error", "data" => null);
			}
			echo json_encode($result);
		}
		else if($type == "employer")
		{
			$data = array();
			$sql = query("SELECT * FROM tbl_employer");
			if(nrows($sql) > 0)
			{
				$i = 0;
				while($sqlData = fetch($sql))
				{
					$data[$i]['id'] = $sqlData['emp_id'];
					$data[$i]['name'] = $sqlData['emp_name'];
					$i++;
				}
				$result = array("status" => "success", "data" => $data);
			}
			else
			{
				$result = array("status" => "error", "data" => null);
			}
			echo json_encode($result);
		}
		else if($type == "organizer")
		{
			$data = array();
			$sql = query("SELECT * FROM tbl_organizer");
			if(nrows($sql) > 0)
			{
				$i = 0;
				while($sqlData = fetch($sql))
				{
					$data[$i]['id'] = $sqlData['org_id'];
					$data[$i]['name'] = $sqlData['org_name'];
					$i++;
				}
				$result = array("status" => "success", "data" => $data);
			}
			else
			{
				$result = array("status" => "error", "data" => null);
			}
			echo json_encode($result);
		}
		else if($type == "professional")
		{
			$data = array();
			$sql = query("SELECT * FROM tbl_candidate");
			if(nrows($sql) > 0)
			{
				$i = 0;
				while($sqlData = fetch($sql))
				{
					$data[$i]['id'] = $sqlData['candidate_id'];
					$data[$i]['name'] = $sqlData['candidate_name'];
					$i++;
				}
				$result = array("status" => "success", "data" => $data);
			}
			else
			{
				$result = array("status" => "error", "data" => null);
			}
			echo json_encode($result);
		}
		else
		{
			$result = array("status" => "error", "data" => null);
			echo json_encode($result);
		}
	}
	else if(isset($_POST['txt_action']))
    {
        $data['chat_message'] 	= post('txt_message');
        $data['sender']       	= get_sess("userdata")['clinic_id'];
        $data['sender_type']  	= "clinic";
        $data['receiver']     	= post('txt_receiver');
        $data['receiver_type']	= post('txt_receiverType');
        if(isset($_FILES["chat_media"]) && $_FILES["chat_media"]["name"]!=null)
        {
            $data['chat_media'] = upload_image($_FILES,'chat_media', '../../upload/');
        }
        else
        {
            $data['chat_media'] = null;
        }
        if(insert2($data,"tbl_chat"))
        {
            $rs['msg']   = $data['chat_message'];
            $rs['date']  = date('m/d/Y h:i a');
            if(isset($_FILES["chat_media"]))
            {
                $rs['media'] = $data['chat_media'];
            }
            else
            {
                $rs['media'] = null;
            }
            echo json_encode($rs);
        }
        else
        {
          echo "error";
        }
    }
    else if(isset($_POST['newmessage']))
    {
        $data['chat_message'] 	= post('txt_message');
        $data['sender']       	= get_sess("userdata")['clinic_id'];
        $data['sender_type']  	= "clinic";
        $data['receiver']     	= post('txt_receiver');
        $data['receiver_type']	= post('txt_receiverType');
        
        if(isset($_FILES["chat_media"]) && $_FILES["chat_media"]["name"]!=null)
        {
            $data['chat_media'] = upload_image($_FILES,'chat_media', '../../upload/');
        }
        else
        {
            $data['chat_media'] = null;
        }
        if(insert2($data,"tbl_chat"))
        {
            set_msg("Success", "Message sent",'success');
            jump(admin_base_url()."inbox?IdChat=".$data['receiver']."&Utype=".$data['receiver_type']);
        }
        else
        {
            set_msg("Error", "Unable to send the message",'error');
            jump(admin_base_url()."inbox");
        }
    }
    else if(isset($_POST['fetch_list']))
    {
        $list = (isset($_POST['sender_list'])) ? $_POST['sender_list'] : array() ;
        // print_r($list);
        // die();
        $doctor_id = get_sess("userdata")['clinic_id'];
        if(isset($list) && sizeof($list) > 0)
        {
            $list 	= array_filter($list);
            $list 	= array_unique($list);
            $list 	= join(",",$list);
            $sql 	= query("SELECT DISTINCT(c.sender), c.sender_type FROM tbl_chat c WHERE c.receiver = $doctor_id AND sender NOT IN ($list) ");
        }
        else
        {
            $sql = query("SELECT DISTINCT(c.sender), c.sender_type FROM tbl_chat c WHERE c.receiver = $doctor_id ");
        }
        if(nrows($sql) > 0)
        {
            $res = array();
            while($data = fetch($sql))
            {
            	$senderID = $data['sender'];
            	if($data['sender_type'] == "doctor")
	        	{
	        		$docSQl 		= query("SELECT * FROM tbl_doctor WHERE doc_id = $senderID");
	        		$docData 		= fetch($docSQl);
	        		$data['id']		= $docData['doc_id'];
	        		$data['name'] 	= $docData['doc_name'];
	        		$data['img'] 	= $docData['doc_image'];
	        		$data['type'] 	= 'doctor';
	        	}
	        	if($data['sender_type'] == "clinic")
	        	{
	        		$docSQl 		= query("SELECT * FROM tbl_clinic WHERE clinic_id = $senderID");
    	            $docData 		= fetch($docSQl);
    	            $data['id']		= $docData['clinic_id'];
    	            $data['name'] 	= $docData['clinic_name'];
    	            $data['img'] 	= $docData['clinic_icon'];
    	            $data['type'] 	= 'clinic';
	        	}
	        	if($data['sender_type'] == "employer")
	        	{
	        		$docSQl 		= query("SELECT * FROM tbl_employer WHERE emp_id = $senderID");
					$docData 		= fetch($docSQl);
					$data['id']		= $docData['emp_id'];
	        		$data['name'] 	= $docData['emp_name'];
	        		$data['img'] 	= $docData['emp_logo'];
	        		$data['type'] 	= 'employer';
	        	}
	        	if($data['sender_type'] == "organizer")
	        	{
	        		$docSQl 		= query("SELECT * FROM tbl_organizer WHERE org_id = $senderID");
					$docData 		= fetch($docSQl);
					$data['id']		= $docData['org_id'];
	        		$data['name'] 	= $docData['org_name'];
	        		$data['img'] 	= $docData['org_icon'];
	        		$data['type'] 	= 'organizer';
	        	}
	        	if($data['sender_type'] == "professional")
	        	{
	        		$docSQl 		= query("SELECT * FROM tbl_candidate WHERE candidate_id = $senderID");
					$docData 		= fetch($docSQl);
					$data['id']		= $docData['candidate_id'];
	        		$data['name'] 	= $docData['candidate_name'];
	        		$data['img'] 	= $docData['candidate_image'];
	        		$data['type'] 	= 'professional';
	        	}
                $res[] = $data;
            }
            echo json_encode($res);
            die();
        }
        else
        {
            echo "not found";
            die();
        }
    }
    else if(isset($_POST['fetch_count']))
    {
    	$receiver = get_sess("userdata")['clinic_id'];
        $sender_id = post('sender_emp');
        $sql = query("SELECT COUNT(chat_id) as count FROM tbl_chat WHERE sender = $sender_id AND receiver = $receiver AND chat_read = 0");
        $count = fetch($sql)['count'];
        if($count > 0)
        {
            echo $count;
        }
        else
        {
            echo 0;
        }
    }
    else if(isset($_POST['act']) && $_POST['act'] == "fetch")
    {
        $sender = post('sender_emp');
        $receiver = get_sess("userdata")['clinic_id'];
        $chatsql = query("SELECT * FROM tbl_chat c WHERE sender = $sender AND receiver = $receiver AND chat_read = 0");
        if(nrows($chatsql) > 0)
        {
        	$res = fetch($chatsql);
        	if($res['sender_type'] == "doctor")
        	{
        		$docSQl 		= query("SELECT * FROM tbl_doctor WHERE doc_id = $sender");
        		$docData 		= fetch($docSQl);
        		$res['id']		= $docData['doc_id'];
        		$res['name'] 	= $docData['doc_name'];
        		$res['img'] 	= $docData['doc_image'];
        		$res['type'] 	= 'doctor';
        	}
        	if($res['sender_type'] == "clinic")
        	{
        		$docSQl 		= query("SELECT * FROM tbl_clinic WHERE clinic_id = $sender");
	            $docData 		= fetch($docSQl);
	            $res['id']		= $docData['clinic_id'];
	            $res['name'] 	= $docData['clinic_name'];
	            $res['img'] 	= $docData['clinic_icon'];
	            $res['type'] 	= 'clinic';
        	}
        	if($res['sender_type'] == "employer")
        	{
        		$docSQl 		= query("SELECT * FROM tbl_employer WHERE emp_id = $sender");
				$docData 		= fetch($docSQl);
				$res['id']		= $docData['emp_id'];
        		$res['name'] 	= $docData['emp_name'];
        		$res['img'] 	= $docData['emp_logo'];
        		$res['type'] 	= 'employer';
        	}
        	if($res['sender_type'] == "organizer")
        	{
        		$docSQl 		= query("SELECT * FROM tbl_organizer WHERE org_id = $sender");
				$docData 		= fetch($docSQl);
				$res['id']		= $docData['org_id'];
        		$res['name'] 	= $docData['org_name'];
        		$res['img'] 	= $docData['org_icon'];
        		$res['type'] 	= 'organizer';
        	}
        	if($res['sender_type'] == "professional")
        	{
        		$docSQl 		= query("SELECT * FROM tbl_candidate WHERE candidate_id = $sender");
				$docData 		= fetch($docSQl);
				$res['id']		= $docData['candidate_id'];
        		$res['name'] 	= $docData['candidate_name'];
        		$res['img'] 	= $docData['candidate_image'];
        		$res['type'] 	= 'professional';
        	}
            $res['date'] = date('d/m/Y h:i a', strtotime($res['date']));
            query("UPDATE tbl_chat SET chat_read = 1 WHERE chat_id = ".$res['chat_id']);
            echo json_encode($res);
        }
        else
        {
            echo 0;
        }
    }
	else
	{
		jump(admin_base_url());
	}
}
else if($_SERVER['REQUEST_METHOD'] == "GET")
{
	if(isset($_GET['act']) && $_GET['act'] == 'addContact')
	{
		$data['my_id'] 			= get_sess("userdata")['clinic_id'];
		$data['my_type'] 		= 'clinic';
		$data['contact_id'] 	= $_GET['contactID'];
		$data['contact_type'] 	= $_GET['type'];
		if(insert($data,'tbl_user_contact'))
		{
			set_msg("Success", "Contact added successfully",'success');
			echo "<script>window.history.go(-1);</script>";
		}
		else
		{
			set_msg("Error", "Unable to add contact, please try again later",'error');
			echo "<script>window.history.go(-1);</script>";
		}
	}
	else
	{
		jump(admin_base_url());
	}
}
else
{
	jump(admin_base_url());
}