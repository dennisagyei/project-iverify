<?php
		
		require('config.php');
		include ("ChromePhp.php");
		
	function SearchUser($username)
	{
		  $SearchResults=array();
		  
		  $con=DBLogin();
		  $sql="select * from tbl_user_account where Role<>'Admin' and Username like '%$username%' limit 7 ";
		  
		  $rstPass = mysqli_query($con,$sql);
		  
		  
		  while($row = mysqli_fetch_assoc($rstPass))
		  {
			  $SearchResults[]=$row;
		  }
		  
		  mysqli_close($con); // Closing Connection
		  
		  return $SearchResults;
	}
	
	function CheckLogin($username,$password)
	{
		
		
		if (isset($username)  && isset($password))
		{
			$username = stripslashes($username);
			$password = stripslashes($password);
			//$username = mysqli_real_escape_string($username);
			$password = do_encrypt($password);


			// SQL query to fetch information of registerd users and finds user match.
			
			$con=DBLogin();
			$sql="select UserID,Username,Password,Role,tbl_user_account.BranchID,tbl_branch_setup.CompanyID from tbl_user_account inner join tbl_branch_setup on tbl_user_account.BranchID=tbl_branch_setup.branchID where password='$password' AND username='$username'";
			//die($sql);
			ChromePhp::log($sql);
	
			$rstPassCheck = mysqli_query($con,$sql);
			$rows = mysqli_num_rows($rstPassCheck);
			$row = mysqli_fetch_assoc($rstPassCheck);
			if ($rows == 1) 
			{
				$_SESSION['login_user']=$username; // Initializing Session
				$_SESSION['userID']=$row['UserID'];
				$_SESSION['Role']=$row['Role'];
				$_SESSION['CompanyID']=$row['CompanyID'];
				$_SESSION['BranchID']=$row['BranchID'];
			//header("location: profile.php"); // Redirecting To Other Page
				return 1;
			} else {
				return 0;
			}
			mysqli_close($con); // Closing Connection
		}
		else {
			return 0;}
	}
	
	function CheckPassword($userid,$password)
	{
		
			$password = stripslashes($password);
			//$username = mysqli_real_escape_string($username);
			$password = do_encrypt($password);

			$con=DBLogin();
			
			$rstPassCheck = mysqli_query($con,"select * from tbl_user_account where password='$password' AND UserID='$userid'");
			$rows = mysqli_num_rows($rstPassCheck);
			$row = mysqli_fetch_assoc($rstPassCheck);
			if ($rows >= 1) 
			{
				return 1;
			} else 
			{
				return 0;
			}
			mysqli_close($con); // Closing Connection
		
	}
		
	function VerifyID($IdNumber)
	{
				
		if (isset($IdNumber)  && ($IdNumber!=''))
		{
			
					
			$con=DBLogin();
			
			$rstIDinfo = mysqli_query($con,"select * from tbl_idcards where IDNumber='$IdNumber' ");
			$rows = mysqli_num_rows($rstIDinfo);
			$row = mysqli_fetch_assoc($rstIDinfo);
			
			if ($rows == 1) 
			{
				VerifyAudit($_SESSION['userID'],$IdNumber,'Success');
				return $row['IDimage'];;
			} else {
				VerifyAudit($_SESSION['userID'],$IdNumber,'Failure');
				return 0;
			}
			mysqli_close($con); // Closing Connection
		}
		else {
			return 0;}
	}
	
	function VerifyAudit($username,$cardID,$status)
	{	
	
		$sql="Insert into tbl_audit_verify(user_id,card_id,status) values('$username','$cardID','$status')";
		ChromePhp::log($sql);
		
		$con=DBLogin();
		
		mysqli_query($con, $sql);
		
		mysqli_commit($con);
		mysqli_close($con);
	}
	
	function AccountUpdate($fullname,$email)
	{
		$sql =" Update tbl_user_account set Fullname='$fullname', Email='$email' where userid=$_SESSION[userID] ";
		ChromePhp::log($sql);
		
		$con=DBLogin();
		
		if (mysqli_query($con, $sql))
		 {
    			//echo "Record updated successfully";
				return 0;
		 } 
		 else 
		 {
    		return 1;//echo "Error updating record: " . mysqli_error($conn);
		 }

		mysqli_close($con);
	
	}
	
	function UpdateUser($userID,$username,$password,$fullname,$email,$role,$BranchID)
	{
		if($password=='')
		{
		$sql ="Update tbl_user_account set Username='$username',Fullname='$fullname', Email='$email',Role='$role',BranchID=$BranchID where userid=$userID ";
		}
		else{
			$sql ="Update tbl_user_account set Username='$username',Password='$password',Fullname='$fullname', Email='$email',Role='$role',BranchID=$BranchID where userid=$userID ";
		}
		
		ChromePhp::log($sql);
		
		$con=DBLogin();
		
		if (mysqli_query($con, $sql))
		 {
    			//echo "Record updated successfully";
				return 0;
		 } 
		 else 
		 {
    		return 1;//echo "Error updating record: " . mysqli_error($conn);
		 }

		mysqli_close($con);
	
	}
	
	function AddUser($username,$password,$fullname,$email,$role,$BranchID)
	{
		$password=do_encrypt($password);
		$sql ="Insert into tbl_user_account (Username,Password,Fullname,Email,Role,BranchID) values('$username','$password','$fullname', '$email','$role',$BranchID) ";
		
		ChromePhp::log($sql);
		
		$con=DBLogin();
		
		if (mysqli_query($con, $sql))
		 {
    			//echo "Record updated successfully";
				return 0;
		 } 
		 else 
		 {
    		return 1;//echo "Error updating record: " . mysqli_error($conn);
		 }

		mysqli_close($con);
	
	}
	
	function SearchCompany($CompanyName)
	{
		  $SearchResults=array();
		  
		  $con=DBLogin();
		  $sql="select * from tbl_company_setup where CompanyName like '%$CompanyName%' limit 7 ";
		  
		  $rstPass = mysqli_query($con,$sql);
		  
		  
		  while($row = mysqli_fetch_assoc($rstPass))
		  {
			  $SearchResults[]=$row;
		  }
		  
		  mysqli_close($con); // Closing Connection
		  
		  return $SearchResults;
	}
	
	function UpdateCompany($CompanyID,$CompanyName,$ContactName,$ContactPhone,$Address)
	{
		$sql =" Update tbl_company_setup set CompanyName='$CompanyName',ContactName='$ContactName', ContactPhone='$ContactPhone',Address='$Address' where CompanyID=$CompanyID ";
		
		ChromePhp::log($sql);
		
		$con=DBLogin();
		
		if (mysqli_query($con, $sql))
		 {
    			//echo "Record updated successfully";
				return 0;
		 } 
		 else 
		 {
    		return 1;//echo "Error updating record: " . mysqli_error($conn);
		 }

		mysqli_close($con);
	
	}
	
	function AddCompany($CompanyName,$ContactName,$ContactPhone,$Address)
	{
		$sql ="Insert into tbl_company_setup (CompanyName,ContactName,ContactPhone,Address) values ('$CompanyName','$ContactName', '$ContactPhone','$Address')";
		
		ChromePhp::log($sql);
		
		$con=DBLogin();
		
		if (mysqli_query($con, $sql))
		 {
    			//echo "Record updated successfully";
				return 0;
		 } 
		 else 
		 {
    		return 1;//echo "Error updating record: " . mysqli_error($conn);
		 }

		mysqli_close($con);
	
	}
	
	function PasswordChange($newPassword,$oldPassword)
	{
		if (CheckPassword($userid,$oldPassword)==1) 
		{
			
		$sql =" Update tbl_user_account set Password='$newPassword' where userid=$_SESSION[userID] ";
		ChromePhp::log($sql);
		
		$con=DBLogin();
		
		if (mysqli_query($con, $sql))
		 {
    			//echo "Record updated successfully";
				return 0;
		 } 
		 else 
		 {
    		return 1;//echo "Error updating record: " . mysqli_error($conn);
		 }

		mysqli_close($con);
		}
		else
		{ return 3;}
		
	}
	
	
	function do_encrypt($password)
	{
		return crypt($password,"CRYPT_BLOWFISH");
	}
	
	function show_page($src) 
	{
    	$str .= "<br/>";
    	$str .= "<iframe frameborder=0 width=100% height=400 marginheight=0 marginwidth=0 src=$src></iframe>";
    	return $str;
  	}
  	
  	function user_verified($user_id,$passwd)
	{
	
			
		$passwd=do_encrypt($passwd);
		
		
		$sql = "Select u.recid, b.grp from usrs u, belongsto b where u.username = '$user_id' and u.passwd = '$passwd' and b.usr = u.recid and u.active = 'Y'";
		
	
		$result = do_query($sql);
		
		while( $rst = oci_fetch_array($result,OCI_BOTH) )
		{
			$_SESSION["UID"] = $rst['RECID'];
			$_SESSION["GID"] = $rst['GRP'];
			$_SESSION["USER"] = $user_id;
			
			
			return $rst['GRP'];
			//return true;
		}
		
		if (empty($rst)){
			return  false;
		}
			
		
		
	}
	
	function change_user_pass($oldpasswd,$passwd,$fullname)
	{
	
			
		$oldpasswd=do_encrypt($oldpasswd);
		
		
		$sql = "Select u.recid, b.grp from usrs u, belongsto b where u.username = '$_SESSION[USER]' and u.passwd = '$oldpasswd' and b.usr = u.recid and u.active = 'Y'";
		
		$result = do_query($sql);
		
		while( $rst = oci_fetch_array($result,OCI_BOTH) )
		{
			
			$oldpass_exist=true;
		
		}
		
		if (!$oldpass_exist){
			return  3;
		}else{
		
			$sql = "Update usrs Set passwd='".do_encrypt($passwd)."' , full_name='$fullname' where RECID='$_SESSION[UID]'";
	     	$rst = do_query($sql);
	
			if(!$rst){
				$e = oci_error($sql);
				//gv_error(htmlentities($e['message']));
				return false;
			}
			return true;
		}
			
		
		
	}
	
	

function create_user($user_id,$passwd,$fullname,$access,$unit)
{
	$sql = "Insert into usrs (username, passwd, full_name) values ('$user_id', '".do_encrypt($passwd)."', '$fullname' )";
	
	$results = do_query($sql);
	
	if(!$results){
		//$e = oci_error($sql);
		die('Unable to create new user');
	    //gv_error(htmlentities($e['message']));
		return false;
	}
	else{
		//Register user's group
		$userid = db_insert_id();
		$sql = "Insert into belongsto(usr, grp) values ('$userid', '$access')";
		do_query($sql);
		
		//Finally, register user's unit
		$sql = "Insert into worksin(usr, unit, status) values ('$userid', '$unit', 1)";
		do_query($sql);
		
		//gv_print("An account has been succesfully created for '$_POST[USERNAME]'");
		
		return true;
	}
}

function update_user($user_id,$passwd,$fullname,$access,$rec_id)
{
	$sql = "Update usrs Set username='$user_id', passwd='".do_encrypt($passwd)."', full_name='$fullname' where RECID='$rec_id'";
	
	//die($sql);
	
	$rst = do_query($sql);
	
	if(!$rst){
		$e = oci_error($sql);
	    //gv_error(htmlentities($e['message']));
		return false;
	}
	
	//Register user's group
	$sql = "Update belongsto set grp='$access' where usr='$rec_id'";
	do_query($sql);
	
	//Finally, register user's unit
	//$sql = "Update worksin set unit='$unit',status=1 where usr='$userid'";
	//do_query($sql);
	
		
	return true;
}

function disable_user($user_id){

	$sql = "UPDATE usrs SET ACTIVE='N' WHERE RECID=$user_id";
	$results=do_query($sql);
	
	if($results){
		return "User Account successfully disabled";
	}else{
		return "Unable to disable user account";
	}
}

function enable_user($user_id){

	$sql = "UPDATE usrs SET ACTIVE='Y' WHERE RECID=$user_id";
	$results=do_query($sql);
	
	if($results){
		return "User Account successfully enabled";
	}else{
		return "Unable to enable user account";
	}
}

function delete_user($user_id){

	$sql = "Delete from usrs WHERE RECID=$user_id";
	$results=do_query($sql);
	
	if($results){
		return "User Account successfully deleted";
	}else{
		return "Unable to delete user account";
	}
}

function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name 
    $secure = SECURE;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session 
    session_regenerate_id();    // regenerated the session, delete the old one. 
}


function login($email, $password, $mysqli) {
    // Using prepared statements means that SQL injection is not possible. 
    if ($stmt = $mysqli->prepare("SELECT id, username, password, salt 
				  FROM members 
                                  WHERE email = ? LIMIT 1")) {
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
        // get variables from result.
        $stmt->bind_result($user_id, $username, $db_password, $salt);
        $stmt->fetch();
        // hash the password with the unique salt.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts 
            if (checkbrute($user_id, $mysqli) == true) {
                // Account is locked 
                // Send an email to user saying their account is locked 
                return false;
            } else {
                // Check if the password in the database matches 
                // the password the user submitted.
                if ($db_password == $password) {
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    // XSS protection as we might print this value
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                    // Login successful. 
                    return true;
                } else {
                    // Password is not correct 
                    // We record this attempt in the database 
                    $now = time();
                    if (!$mysqli->query("INSERT INTO login_attempts(user_id, time) 
                                    VALUES ('$user_id', '$now')")) {
                        header("Location: ../error.php?err=Database error: login_attempts");
                        exit();
                    }
                    return false;
                }
            }
        } else {
            // No user exists. 
            return false;
        }
    } else {
        // Could not create a prepared statement
        header("Location: ../error.php?err=Database error: cannot prepare statement");
        exit();
    }
}
function checkbrute($user_id, $mysqli) {
    // Get timestamp of current time 
    $now = time();
    // All login attempts are counted from the past 2 hours. 
    $valid_attempts = $now - (2 * 60 * 60);
    if ($stmt = $mysqli->prepare("SELECT time 
                                  FROM login_attempts 
                                  WHERE user_id = ? AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);
        // Execute the prepared query. 
        $stmt->execute();
        $stmt->store_result();
        // If there have been more than 5 failed logins 
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    } else {
        // Could not create a prepared statement
        header("Location: ../error.php?err=Database error: cannot prepare statement");
        exit();
    }
}
function login_check($mysqli) {
    // Check if all session variables are set 
    if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
        if ($stmt = $mysqli->prepare("SELECT password 
				      FROM members 
				      WHERE id = ? LIMIT 1")) {
            // Bind "$user_id" to parameter. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
                if ($login_check == $login_string) {
                    // Logged In!!!! 
                    return true;
                } else {
                    // Not logged in 
                    return false;
                }
            } else {
                // Not logged in 
                return false;
            }
        } else {
            // Could not prepare statement
            header("Location: ../error.php?err=Database error: cannot prepare statement");
            exit();
        }
    } else {
        // Not logged in 
        return false;
    }
}
function esc_url($url) {
    if ('' == $url) {
        return $url;
    }
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
    
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
    
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
    
    $url = str_replace(';//', '://', $url);
    $url = htmlentities($url);
    
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}


?>
