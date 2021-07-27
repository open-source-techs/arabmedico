<?php 
	#Starting Session  
	session_start();
	session_regenerate_id();
	#Connection to Database
	$link=mysqli_connect('localhost','root','','db_medical');
	// $link=mysqli_connect('localhost','arbmdco_panel','OpenSourceTechs','arbmdco_panel');
	if (!$link) {
		jump('error');
	}
	set_sess('link',$link);

	#admin Base_url
	function admin_base_url()
	{
		// return "https://arabmedico.com/clinic-panel/";
		return "http://localhost/arabmedico/organization-panel/";
	}

	#Base Url Function
	function base_url()
	{
		// return "https://arabmedico.com/";
		return "http://localhost/arabmedico/";
	}
	
	function file_url()
	{
	    // return "https://arabmedico.com";
	    return "http://localhost/arabmedico";
	}
	#Query Function
	function query($q){
		return mysqli_query($_SESSION['link'],$q);
	}
	#Page Title Function
	function page_title($title)
	{
		return $title;
	}
	#Post Function
	function post($value)
	{
		return filter_this($_POST[$value]);
	}
	#Get Function
	function get($value)
	{
		return $_GET[$value];
	}
	#Number of Rows Function
	function nrows($res){
		return mysqli_num_rows($res);
	}
	#Fetch Function
	function fetch($result){
		return mysqli_fetch_assoc($result);
	}
	#Set Session Function
	function set_sess($name,$value)
	{
		$_SESSION[$name]=$value;
	}
	#Get Session Function
	function get_sess($name)
	{
		 return (isset($_SESSION[$name])) ? $_SESSION[$name] : false;
	}
	#Input Test Function
	function test_input($value)
	{
		$val=trim($value);
		$val=stripslashes($val);
		return $val;
	}
	#Single Fiter Function
	function filter_this($value)
	{
		return $filtered=filter_var(test_input($value),FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
	}
	#Validate Name
	function valid_name($name){
		$rexSafety = "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i";
		return !(preg_match($rexSafety, $name));
	}
	#Is number in string Function
	function is_contain_number($string)
	{
		if (preg_match('~[0-9]+~', $string)) {
		    return true;
		}else{
			return false;
		}
	}
	#Validate function
	function validate($value,$kind,$length=null)
	{
		if ($kind=="name") {
			if (strlen($value)<$length) {
				return "minimum length should be 3";
			}else{
				$filtered=filter_this($value);
				return "valid";
			}
		}elseif ($kind=="password") {
			if (strlen($value)<$length) {
				return "minimum length for password should be 8";
			}else{
				return "valid";
			}
		}elseif ($kind=="email") {
			if (!filter_var($value,FILTER_VALIDATE_EMAIL) || $value=="") {
				return "Enter a valid email address";
			}else{
				return "valid";
			}
		}elseif ($kind=="contact") {
			if (is_numeric($value)) {
				if (strlen($value)>=$length) {
					return "valid";
				}else{
					return "Enter a valid contact number";
				}
			}else{
				echo "Enter a valid contact number";
			}
		}
	}
	#Set Title Function
	function set_title($value)
	{
		set_sess('title',$value);
	}
	#Get Title Function
	function get_title()
	{
		if (isset($_SESSION['title'])) {
			echo get_sess('title');
			unset($_SESSION['title']);
		}
	}
	#Set Message Function
	function set_msg($title,$msg,$type)
	{
		$_SESSION['msg'] = "<script>".
		"setTimeout(function () {".
            "toastr.options = {".
                "closeButton: true,".
                "progressBar: true,".
                "showMethod: 'slideDown',".
                "timeOut: 5000".
            "};".
            "toastr.".$type."('".$title."', '".$msg."');".
        "}, 100);".
        "</script>";
        ;
	}
	#Get Message Function
	function get_msg()
	{
		if(isset($_SESSION['msg']))
		{
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
	}
	#Jump to Page Function
	function jump($location)
	{
		header("location:$location");
	}
	
	#Insert Function
	function insert2($array,$tbl,$array1=null,$tf='no',$rename=true)
	{
		$keys=array_keys($array);
		$values=array_values($array);
		$cols="";
		for ($i=0; $i < count($keys) ; $i++) { 
				$cols.=$keys[$i].",";
		}
		$cols=substr($cols,0,-1);
		$vals="";
		for ($i=0; $i < count($values) ; $i++) { 
				$vals.="'".$values[$i]."',";
		}
		$vals=substr($vals,0,-1);
		$q="";
		if ($array1!=null)
		{
			$img_keys=array_keys($array1);
			$img_cols="";
			for ($i=0; $i <= count($img_keys)-1 ; $i++) { 
					$img_cols.=$img_keys[$i].",";	
			}
			$img_vals=array_values($array1);
			$img_values="";
			$img_cols=substr($img_cols,0,-1);
			if ($tf!='no')
			{
				for ($i=0; $i < count($img_vals) ; $i++)
				{
					$name = $img_vals[$i]['name'];
					if($rename)
					{
						$file_basename = substr($name, 0, strripos($name, '.'));
						$file_ext = substr($name, strripos($name, '.'));
						$newname = uniqid().$file_ext;
					}
					else
					{
						$newname = $name;	
					}
					move_uploaded_file($img_vals[$i]['tmp_name'],$tf.$newname);
					$img_values.="'".$newname."',";
				}
				$img_values=substr($img_values,0,-1);
				$q="insert into $tbl ($cols,$img_cols) values($vals,$img_values);";
			}
			else
			{
				exit();
			}
		}
		else
		{

			$q="insert into $tbl ($cols) values($vals);";
		}
        // echo $q;
        // die();
		if (query($q))
		{
			if ($tf!='no')
			{
				return $newname;
			}
			else
			{
				return true;

			}
		}
		else
		{
			return false;
		}
	}
	
	#Insert Function
	function insert($array,$tbl,$array1=null,$tf='no',$rename=true)
	{
	   
		$keys=array_keys($array);
		$values=array_values($array);
		$cols="";
		for ($i=0; $i < count($keys) ; $i++) { 
				$cols.=$keys[$i].",";
		}
		$cols=substr($cols,0,-1);
		$vals="";
		for ($i=0; $i < count($values) ; $i++) { 
				$vals.='"'.$values[$i].'",';
		}
		$vals=substr($vals,0,-1);
		$q="";
		if ($array1!=null)
		{
			$img_keys=array_keys($array1);
			$img_cols="";
			for ($i=0; $i <= count($img_keys)-1 ; $i++) { 
					$img_cols.=$img_keys[$i].",";	
			}
			$img_vals=array_values($array1);
			$img_values="";
			$img_cols=substr($img_cols,0,-1);
			
			if ($tf!='no')
			{
				for ($i=0; $i < count($img_vals) ; $i++)
				{
					$name = $img_vals[$i]['name'];
					if($rename)
					{
						$file_basename = substr($name, 0, strripos($name, '.'));
						$file_ext = substr($name, strripos($name, '.'));
						$newname = uniqid().$file_ext;
					}
					else
					{
						$newname = $name;	
					}
					move_uploaded_file($img_vals[$i]['tmp_name'],$tf.$newname);
					$img_values.='"'.$newname.'",';
				}
				$img_values=substr($img_values,0,-1);
				$q="insert into $tbl ($cols,$img_cols) values($vals,$img_values);";
			}
			else
			{
				exit();
			}
		}
		else
		{
			$q="insert into $tbl ($cols) values($vals);";
			
		}
// 		echo $q;
// 		die();
		if (query($q))
		{
			if ($tf!='no')
			{
				return $newname;
			}
			else
			{
				return true;

			}
		}
		else
		{
			return false;
		}
	}
	#Password Enceypt Function
	function encrypt($pass){
		return password_hash($pass,PASSWORD_DEFAULT);
	}
	#Where Function
	function where($col,$val){
		$whr=' where '.$col.'="'.$val.'"';
		set_sess('where',$whr);
	}
	#Update Function
	function update($array,$tn,$files=null,$tf='no'){
		if (isset($_SESSION['where'])) {
			$cols=array_keys($array);
			$vals=array_values($array);
			$q="update $tn set ";
			for ($i=0; $i < count($cols) ; $i++) { 
				$q.=''.$cols[$i].'="'.$vals[$i].'",';
			}
			$q=substr($q, 0,-1);
			if ($files!=null) {
				$img_cols=array_keys($files);
				$img_vals=array_values($files);
				for ($i=0; $i < count($img_cols); $i++) { 
					if ($img_vals[$i]['name']!="") {
						$q.=','.$img_cols[$i].'="'.$img_vals[$i]['name'].'"';
						move_uploaded_file($img_vals[$i]['tmp_name'],$tf.$img_vals[$i]['name']);
					}
				}
				// $q=substr($q, 0,-1);
			}
			$q=$q.get_sess('where');
 		//	echo $q;
 		//	die();
			if (query($q)) {
				return true;
			}else{
				return false;
			}
		}else{
			echo "where is not set";
		}
	}
	
	#Update Function
	function update2($array,$tn,$files=null,$tf='no'){
		if (isset($_SESSION['where'])) {
			$cols=array_keys($array);
			$vals=array_values($array);
			$q="update $tn set ";
			for ($i=0; $i < count($cols) ; $i++) { 
				$q.= $cols[$i] . "= '". $vals[$i] . "',";
			}
			$q=substr($q, 0,-1);
			if ($files!=null) {
				$img_cols=array_keys($files);
				$img_vals=array_values($files);
				for ($i=0; $i < count($img_cols); $i++) { 
					if ($img_vals[$i]['name']!="") {
					    
						$q.=','.$img_cols[$i]."='".$img_vals[$i]['name']."'";
						
						move_uploaded_file($img_vals[$i]['tmp_name'],$tf.$img_vals[$i]['name']);
					}
				}
				// $q=substr($q, 0,-1);
			}
			$q=$q.get_sess('where');
// 			echo $q;
// 			die();
			if (query($q)) {
				return true;
			}else{
				return false;
			}
		}else{
			echo "where is not set";
		}
	}
	
	#delete Function
	function delete($table_name)
	{
		if (isset($_SESSION['where'])) {
			$q = "delete from $table_name".get_sess("where");
			if (query($q)) {
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	#Random String
	function random_string($length)
	{
		$permitted_chars = 'ABCDEFGHI687654346WXYZshflajshdfjadahdfah203847128934712908347sdfuihawraaksdhkajshda rhweoiruisvnx31783471289374987OUASFHNEORUYAFOASYF7643218798641316884YAOSUmnzroiwuaeoius12384712847312937840192783489127012983562147856lkjklsdflkjPQRSlkjZ923748923498';
  		$random_string = '';
	    for($i = 1; $i <= $length; $i++) {
	        $random_string .= $permitted_chars[rand(0, strlen($permitted_chars) -1)];
	    }
	    return $random_string;
	}
	#Send Email Function
	function sendmail($to,$subject,$msg,$link=null,$linktext=null)
	{
		$if_link="";
		if ($link!=null) {
			$if_link='<a href="'.$link.'" style="color: white;text-decoration: underline;font-family: calibri;font-size: 20px;">'.$linktext.'</a>';
		}
		require 'PHPMailerAutoload.php';
		$mail = new PHPMailer;
		// $mail->SMTPDebug = 4;                               		// Enable verbose debug output
		$mail->isSMTP();                                      		// Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  							// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               		// Enable SMTP authentication
		$mail->Username = 'mzeeshauna@gmail.com';                 	// SMTP username
		$mail->Password = 'Mzeeshauna123';                          // SMTP password
		$mail->SMTPSecure = 'tls';                            		// Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    		// TCP port to connect to

		$mail->setFrom('mzeeshauna@gmail.com', 'YouBlood');
		$mail->addAddress($to);     								// Add a recipient
		$mail->addReplyTo('mzeeshauna@gmail.com');
		$mail->isHTML(true);                                		// Set email format to HTML

		$mail->Subject = $subject;
		$mail->Body    = '<br>
        <div style="width: 850px;position: absolute;left: 0;right: 0;margin:auto;">
          <div style="background-color: rgba(153, 3, 13,1);padding: 20px;border-radius: 5px">
            <p>
              <span style="color: white;font-family: calibri;font-size: 80px;text-align: justify;">Hello!</span>
              <br>
              <span style="color: white;font-family: calibri;font-size: 20px;text-align: justify;">'.$msg.'</span>
            </p>
            '.$if_link.'
            <br>
            <br>
            <hr style="opacity: 0.5">
            <p style="color: white;font-family: calibri;font-size: 20px;"><strong>Yours Truly</strong><br>YouBlood Team</p>
          </div>  
        </div>';
		if(!$mail->send()) {
		    return false;
		} else {
		    return true;
		}
	}
	# Encryption Function
	function encryptIt( $q ) {
	    return base64_encode($q);
	}
	# Decryption Function
	function decryptIt( $q ) {
	 	$dec = base64_decode($q);
	    return $dec;   
	}
	# Options Function
	function options($query,$name,$id,$selected=0){
		$q=query($query);
		$all="";
		while ($data=fetch($q)) {
			if ($data[$id]==$selected) {
				$all.="<option value='".$data[$id]."' selected='selected'>".$data[$name]."</option>";
			}else{
				$all.="<option value='".$data[$id]."'>".$data[$name]."</option>";
			}
		}
		return $all;
	}
	# Safe String
	function safeString($url)
	{
		return mysqli_real_escape_string($_SESSION['link'], $url);
	}
	#Limited number of words
	function get_words( $str, $wordCount ) {
	  return implode( 
	    '', 
	    array_slice( 
	      preg_split(
	        '/([\s,\.;\?\!]+)/', 
	        $str, 
	        $wordCount*2+1, 
	        PREG_SPLIT_DELIM_CAPTURE
	      ),
	      0,
	      $wordCount*2-1
	    )
	  );
	}
	#Pagination Function
	function pagination($result_query, $result_per_page, $result_page_link,$cur_page)
	{
		$total_result=nrows(query($result_query));
		$no_pages=ceil($total_result/$result_per_page);
		$prev=$cur_page-1;
		$nxt=$cur_page+1;
		$check_request='?';
		if (substr_count($result_page_link, '?')==1) {
			$check_request='&';
		}
		$page_links='<div class="pagination"><a href="'.$result_page_link.$check_request.'page=1" class="prevposts-link"><i class="fa fa-caret-left"></i><i class="fa fa-caret-left"></i></a>';
		if ($cur_page>1) {
			$page_links.='<a href="'.$result_page_link.$check_request.'page='.$prev.'" class="prevposts-link"><i class="fa fa-caret-left"></i></a>';
		}
		for ($i=1; $i <= $no_pages ; $i++) { 
			if ($i==$cur_page) {
				$page_links.='<a href="'.$result_page_link.$check_request.'page='.$i.'" class="blog-page current-page transition">'.$i.'</a>';
			}else{
				$page_links.='<a href="'.$result_page_link.$check_request.'page='.$i.'" class="blog-page transition">'.$i.'</a>';
			}
		}
		if ($no_pages!=$cur_page) {
			$page_links.='<a href="'.$result_page_link.$check_request.'page='.$nxt.'" class="nextposts-link"><i class="fa fa-caret-right"></i></a>';
		}
		$page_links.='<a href="'.$result_page_link.$check_request.'page='.$no_pages.'" class="nextposts-link"><i class="fa fa-caret-right"></i><i class="fa fa-caret-right"></i></a></div>';
		echo $page_links;
	}
	#Get File Name for active links
	function active_page($page_name)
	{
		if ($page_name==basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING'])) {
			echo "menu-open";
		}else{
			echo "";
		}
	}
	#Get Next ID from table
	function get_next_table_id($table_name)
	{
		$tb = query("SHOW TABLE STATUS LIKE '$table_name'");
		$res = fetch($tb);
		return $res['Auto_increment'];
	}
	#Create URL sug
	function create_slug($string)
	{
        $string = str_replace("&", "", $string);
        $string = str_replace("'", "", $string);
        $string = str_replace("?", "", $string);
        $string = str_replace("/", "", $string);
        $string = str_replace("\ ", "", $string);
        $string = str_replace(".", "", $string);
        $string = str_replace(",", "", $string);
        $string = str_replace("-", " ", $string);
        $string = str_replace("--", " ", $string);
		$string = str_replace(" ", "-", $string);
        return $string;
	}
	function un_slugify($string)
	{
	    $string = str_replace("-", " ", $string);
        return $string;
	}
	function validate_image($imgfile){
		// get the image extension
        $extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
        // allowed extensions
        $allowed_extensions = array(".jpg","jpeg",".png",".gif");
        // Validation for allowed extensions .in_array() function searches an array for a specific value.
        if(!in_array($extension,$allowed_extensions)){
            return "invalid_file";
        }else{
            $imgnewfile=random_string(10).$extension;
            return $imgnewfile;
        }
	}

	function check_column($table, $check_col, $check_col_val, $where_col = null, $where_col_val = null)
	{
		if ($where_col == null)
		{
			$sql = query("SELECT * from ".$table." WHERE ".$check_col." LIKE '%".$check_col_val."%' ");
			$count = nrows($sql);
			if($count > 0)
			{
				return $check_col_val.'-'.($count);
			}
			else
			{
				return $check_col_val;
			}
		}
		else
		{
			$sql = query("SELECT * from ".$table." WHERE ".$check_col." LIKE '%".$check_col_val."%'  AND ".$where_col." != '".$where_col_val."''  ");
			$count = nrows($sql);
			if($count > 0)
			{
			    $sql1 = query("SELECT * from ".$table." WHERE ".$check_col." LIKE '%".$check_col_val."%' ");
			    $count = nrows($sql1);
				return $check_col_val.'-'.($count);
			}
			else
			{
				return $check_col_val;
			}
		}
	}
	function checkUniqueCol($table,$col,$value,$where=false,$emailCol='',$email='')
	{
		if($where)
		{
			$q = 'select count("'.$col.'") as count from '.$table.' where '.$col.' = "'.$value.'" AND '.$emailCol.' !=  "'.$email.'"';
		}
		else
		{
			$q = 'select count("'.$col.'") as count from '.$table.' where '.$col.' = "'.$value.'"';
		}
		// echo $q;
		// die();
		$res = mysqli_query($_SESSION['link'],$q);
		return mysqli_fetch_array($res);
	}

	function time_ago($ptime)
	{
		$ptime = strtotime($ptime);
		$etime = time() - $ptime;
	    if ($etime < 1) {
	        return '0 Seconds';
	    }
	    $a = array(
	        365 * 24 * 60 * 60 	=> 'Year',
	        30 * 24 * 60 * 60 	=> 'Month',
	        24 * 60 * 60 		=> 'Day',
	        60 * 60 			=> 'Hour',
	        60 					=> 'Minute',
	        1 					=> 'Second'
	    );
	    $a_plural = array(
	        'Year' 		=> 'Years',
	        'Month' 	=> 'Months',
	       	'Day' 		=> 'Days',
	       	'Hour' 	    => 'Hours',
	        'Minute' 	=> 'Minutes',
	        'Second' 	=> 'Seconds'
	    );
	    foreach ($a as $secs => $str)
	    {
	        $d = $etime / $secs;
	        if ($d >= 1)
	        {
	            $r = round($d);
	            $time_ago = $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ' . 'ago' ;
	            return $time_ago;
	        }
	    }
	}
	
	function checkFile($files,$index)
    {
        $allowedExts = array("docx","docm","dotx","dotm","docb","pdf");
        $img_name = $files[$index]['name'];
        $temp = explode(".", $img_name);
        $extension = end($temp);
        
        if($img_name != '')
        {
            if (in_array(strtolower($extension), $allowedExts))
            {
                
                return true;
            }
            else
            {
                
                return false;
            }
        }
        else
        {
            return false;
        }
    }
	
	function upload_image($files,$index,$target_dir,$rename=true, $jobApp=false)
	{
	    $name = $files[$index]['name'];
    	if($rename)
    	{
    		$file_basename = substr($name, 0, strripos($name, '.'));
    		$file_ext = substr($name, strripos($name, '.'));
    		$newname = uniqid().$file_ext;
    	}
    	else
    	{
    		$newname = strtolower($name);
    	}
    	if(move_uploaded_file($files[$index]['tmp_name'], $target_dir.$newname))
    	{
    	    if($jobApp)
    	    {
    	        return "/jobApp/".$newname;
    	    }
    	    else
    	    {
    	        return "/upload/".$newname;
    	    }
    	}
    	else
    	{
    	    return false;
    	}

	}
	
	function get_site_data()
	{
	    $sql = query("SELECT * FROM tbl_settings");
	    return fetch($sql);
	}
	
	function get_languages()
	{
        $sql = query("SELECT * FROM tbl_language");
        $arr = array();
        $i = 0;
        while($cnt = fetch($sql))
	    {
	       $i++;
	       $arr[$cnt['lang_id']] = $cnt;
	    }
	    $_SESSION['lang'] = $arr;
	}
	
	function SplitTime($StartTime, $EndTime, $Duration="15"){
        $ReturnArray = array ();// Define output
        $StartTime    = strtotime ($StartTime); //Get Timestamp
        $EndTime      = strtotime ($EndTime); //Get Timestamp
    
        $AddMins  = $Duration * 60;
    
        while ($StartTime <= $EndTime) //Run loop
        {
            $ReturnArray[] = date ("G:i", $StartTime);
            $StartTime += $AddMins; //Endtime check
        }
        return $ReturnArray;
    }
    
    function changeNumberToArabic($number)
    {
        $retNum = str_replace('0','٠',$number);
        $retNum = str_replace('1','١',$retNum);
        $retNum = str_replace('2','٢',$retNum);
        $retNum = str_replace('3','٣',$retNum);
        $retNum = str_replace('4','٤',$retNum);
        $retNum = str_replace('5','٥',$retNum);
        $retNum = str_replace('6','٦',$retNum);
        $retNum = str_replace('7','٧',$retNum);
        $retNum = str_replace('8','٨',$retNum);
        $retNum = str_replace('9','٩',$retNum);
        return $retNum;
    }
?>