<?php
// Start the session
include_once('include/functions.inc.php');

sec_session_start();


if (!isset($_SESSION['login_user']) || $_SESSION['login_user']=='') 
{	
	header("Location: /?p=home");
}

include_once('include/agent.php');
 
$agent->init();

//Fill relevant forms
$con=DBLogin();
$sql="select * from tbl_user_account where UserID=$_SESSION[userID]";
$rstPass = mysqli_query($con,$sql);
//$rows = mysqli_num_rows($rstPassCheck);
$row = mysqli_fetch_assoc($rstPass);


mysqli_close($con); // Closing Connection


?>



<!DOCTYPE html >
<!--  Website template by freewebsitetemplates.com  -->
<html>

<head>
	<title>iVerify ID Verification System</title>
	<meta  charset="iso-8859-1" />
    
<script>

function showMessage(strMessage,MessageType)
{
	if (MessageType==0)
	{
	document.getElementById("ChangePwdMessageBox").style.display = "block";
	document.getElementById("ChangePwdMessageBox").innerHTML =strMessage;
	document.getElementById("ChangePwdMessageBox").className ="alert-box success";
	}
	else if(MessageType==1)
	{
	document.getElementById("ChangePwdMessageBox").style.display = "block";
	document.getElementById("ChangePwdMessageBox").innerHTML =strMessage;
	document.getElementById("ChangePwdMessageBox").className ="alert-box error";
	}
}

 function Process_VerifyID() 
 {
		 
	 document.getElementById("ErrorBox").style.visibility = "hidden";
  // STEP 3: CALLING SERVER FUNCTION FROM CLIENT AGENT
  //declare variables
  old_pwd = txtOldpassword.value//document.getElementById('Id_Number').value;
	  
  agent.call('','VerifyID','callback_VerifyID',ID_NUMBER);
  
 }
 
 function Process_AccountUpdate() 
 {
	document.getElementById("AccountMessageBox").style.display = "none";
	
  //declare variables
  strFullname=document.getElementById('Fullname').value;
  strEmail=document.getElementById('email').value;
  

  
  agent.call('','AccountUpdate','callback_AccountUpdate',strFullname,strEmail);
 }
  
  function callback_AccountUpdate(str) {
      
	document.getElementById("AccountMessageBox").style.display = "none";
	  
	  if(str==0)
	  {
	  	//alert('Invalid credentials. Please try again!');
		document.getElementById("AccountMessageBox").style.display = "block";
		document.getElementById("AccountMessageBox").innerHTML ="Account details successfully updated!";
		document.getElementById("AccountMessageBox").className ="alert-box success";
		
	  }
	  else 
	  {
		document.getElementById("AccountMessageBox").style.display = "block";
		document.getElementById("AccountMessageBox").innerHTML ="Update was unsuccessful!";
		document.getElementById("AccountMessageBox").className ="alert-box error";
		
	  }
  }

function Process_PasswordChange()
{
	document.getElementById("ChangePwdMessageBox").style.display = "none";
	var old_pass = document.getElementById('old_password').value;
	var new_pass = document.getElementById('new_password').value;
	var conf_pass = document.getElementById('conf_password').value;
	
  if (old_pass==''){
	showMessage('Enter old password.',1);
	document.getElementById("old_password").focus();
	return;
  }
  
  if (new_pass==''){
	showMessage('Enter new password.',1);
	document.getElementById("new_password").focus();
	return;
  }
  
  if (new_pass!=conf_pass){
	showMessage('Passwords do not match.',1);
	document.getElementById("conf_password").focus();
	return;
  }
  agent.call('','PasswordChange','callback_PasswordChange',new_pass,old_pass);
}
	 
	// client callback function
 function callback_PasswordChange(str) {
      
	document.getElementById("ChangePwdMessageBox").style.display = "none";
	  
	  if(str==0)
	  {
	  	//alert('Invalid credentials. Please try again!');
		document.getElementById("ChangePwdMessageBox").style.display = "block";
		document.getElementById("ChangePwdMessageBox").innerHTML ="Password successfully updated!";
		document.getElementById("ChangePwdMessageBox").className ="alert-box success";
		
	  }
	  else if(str==3)
	  {
		document.getElementById("ChangePwdMessageBox").style.display = "block";
		document.getElementById("ChangePwdMessageBox").innerHTML ="Old password is incorrect!";
		document.getElementById("ChangePwdMessageBox").className ="alert-box error";
		
	  }
	    else 
	  {
		document.getElementById("ChangePwdMessageBox").style.display = "block";
		document.getElementById("ChangePwdMessageBox").innerHTML ="Password change failed.";
		document.getElementById("ChangePwdMessageBox").className ="alert-box error";
		
	  }
	  
}
</script>

	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<!--[if IE 6]>
		<link href="css/ie6.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	<!--[if IE 7]>
        <link href="css/ie7.css" rel="stylesheet" type="text/css" />  
	<![endif]-->
    	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/animate.css">
	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="css/style.css">
    
    <link rel="stylesheet" href="css/menu.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    
    <style>
	.myButton {
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ffffff), color-stop(1, #f6f6f6));
	background:-moz-linear-gradient(top, #ffffff 5%, #f6f6f6 100%);
	background:-webkit-linear-gradient(top, #ffffff 5%, #f6f6f6 100%);
	background:-o-linear-gradient(top, #ffffff 5%, #f6f6f6 100%);
	background:-ms-linear-gradient(top, #ffffff 5%, #f6f6f6 100%);
	background:linear-gradient(to bottom, #ffffff 5%, #f6f6f6 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#f6f6f6',GradientType=0);
	background-color:#ffffff;
	-moz-border-radius:6px;
	-webkit-border-radius:6px;
	border-radius:6px;
	border:1px solid #dcdcdc;
	display:inline-block;
	cursor:pointer;
	color:#666666;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:0px 1px 0px #ffffff;
}
.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #f6f6f6), color-stop(1, #ffffff));
	background:-moz-linear-gradient(top, #f6f6f6 5%, #ffffff 100%);
	background:-webkit-linear-gradient(top, #f6f6f6 5%, #ffffff 100%);
	background:-o-linear-gradient(top, #f6f6f6 5%, #ffffff 100%);
	background:-ms-linear-gradient(top, #f6f6f6 5%, #ffffff 100%);
	background:linear-gradient(to bottom, #f6f6f6 5%, #ffffff 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f6f6f6', endColorstr='#ffffff',GradientType=0);
	background-color:#f6f6f6;
}
.myButton:active {
	position:relative;
	top:1px;
}

       </style>
    
</head>

<body>
	  <div id="background">
			  <div id="page">
			
					 <div class="header">
						<div class="footer">
							<div class="body">
							  
									<div id="sidebar">
									    <a href="?p=login"><img id="logo" src="images/logo.png" with="154" height="41" alt="" title=""/></a>
									
										
										<ul class="navigation">
										    <li ><a href="?p=search">HOME</a></li>
											<li ><a href="?p=reports" >REPORTS</a></li>
                                            
                                              <li class="active"><a href="?p=accounts" >MY ACCOUNT</a></li>
											 
                                             <?php 
											   if ($_SESSION['Role']=='Admin')
											   {
												   echo "<li ><a href='?p=setup' >ADMIN SETUP</a></li>";
											   } elseif ($_SESSION['Role']=='Supervisor'){
												   echo "<li ><a href='?p=setup' >ADMIN SETUP</a></li>";
											   }
											  ?>
											<li ><a href="logout.php" >LOG OUT</a></li>
											<li class="last" ><a href="?p=contact">CONTACT US</a></li>
										</ul>
										
										<div class="connect">
										    <a href="#" class="facebook">&nbsp;</a>
											<a href="#" class="twitter">&nbsp;</a>
											<a href="#" class="vimeo">&nbsp;</a>
										</div>
										
										<div class="footenote">
										  <span>&copy; Copyright 2016.</span>
										  <span>All rights reserved</span>
										</div>
										
									</div>
									<div id="content" >
									
									    <img src="images/id_verified.jpg" width="735" height="504" alt="" title="">
										
									      
											  <div class="body">
                                              
                
                 <div id="account-box">
                 <div style="background:#E4E4E4; border-radius: 5px 5px 0px 0px; margin-bottom:20px; font-size:16px; height:35px; padding-top:8px">Account Details</div>
                 <table style="margin-left:20px" width="600" border="0">
                   <tbody>
                     <tr style="color:black;">
                       <td colspan="2">Account Information</td>
                       <td width="42">&nbsp;</td>
                       <td colspan="2">Change Your Password</td>
                     </tr>
                     <tr>
                       <td colspan="2"><hr></td>
                       <td>&nbsp;</td>
                       <td colspan="2"><hr></td>
                     </tr>
                     <tr style="color:black;  font-size:12px">
                       <td width="65" height="42"><label for="textfield">Username:</label></td>
                       <td width="195"><input name="txtUsername" type="text" id="Username" value=" <?php echo $row['Username']; ?>" size="25" readonly></td>
                       <td>&nbsp;</td>
                       <td width="98">Old Password:</td>
                       <td width="178">
                       <input type="password" name="txtOldpassword" id="old_password"></td>
                     </tr>
                     <tr style="color:black; font-size:12px">
                       <td height="41"><label for="textfield2">Name  :</label></td>
                       <td><input name="txtfullname" type="text" id="Fullname" value="<?php echo $row['Fullname']; ?>" size="25"></td>
                       <td>&nbsp;</td>
                       <td>New Password:</td>
                       <td>
                       <input type="password" name="txtNewPassword" id="new_password"></td>
                     </tr>
                     <tr style="color:black; font-size:12px">
                       <td><label for="email">Email:</label></td>
                       <td><input name="txtEmail" type="email" id="email" value="<?php echo $row['Email']; ?>" size="25"></td>
                       <td>&nbsp;</td>
                       <td>Confirm Password:</td>
                       <td><input type="password" name="txtConfirmPassword" id="conf_password"></td>
                     </tr>
                     <tr>
                       <td colspan="2"><div id="AccountMessageBox" class="alert-box success" style="display:none">Account successfully updated.</div></td>
                       <td>&nbsp;</td>
                       <td colspan="2"><div id="ChangePwdMessageBox" class="alert-box error" style="display:none"></div></td>
                     </tr>
                     <tr>
                       <td>&nbsp;</td>
                       <td><input type="submit" name="submit" id="submit" value="Save Changes" onClick="Process_AccountUpdate() ;"></td>
                       <td>&nbsp;</td>
                       <td>&nbsp;</td>
                       <td><input type="button" name="button" id="button" value="Update Password" onClick="Process_PasswordChange();"></td>
                     </tr>
                     <tr>
                       <td>&nbsp;</td>
                       <td colspan="4">&nbsp;</td>
                     </tr>
                   </tbody>
                 </table>
                 <p>&nbsp;</p>
                 </div>
											    											
												
									  </div>
									</div>
						</div>
					 </div>
					 <div class="shadow">&nbsp;</div>
			  </div>    
	  </div>    
	
</body>
</html>