<?php
// Start the session
include_once('include/functions.inc.php');

sec_session_start();

include_once('include/agent.php');
 
$agent->init();


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    
    <style>
	 body { 
            margin:0;
			padding:0;
			font-family: Arial, Verdana, Helvetica, sans-serif; 
			font-size: 12px; 
			line-height: 25px; 
			/*color:#fff; */
			text-align: justify; 

	}
	
		.alert-box {
		color:#555;
		border-radius:10px;
		font-family:Tahoma,Geneva,Arial,sans-serif;font-size:11px;
		padding:10px 10px 10px 36px;
		margin:10px;
	}
	.alert-box span {
		font-weight:bold;
		text-transform:uppercase;
	}
	
	.error {
		background:#ffecec url('images/error.png') no-repeat 10px 50%;
		border:1px solid #f5aca6;
	}
	.success {
		background:#e9ffd9 url('images/success.png') no-repeat 10px 50%;
		border:1px solid #a6ca8a;
	}
	.warning {
		background:#fff8c4 url('images/warning.png') no-repeat 10px 50%;
		border:1px solid #f2c779;
	}
	.notice {
		background:#e3f7fc url('images/notice.png') no-repeat 10px 50%;
		border:1px solid #8ed9f6;
	}


	</style>
    
    <script>
	function showMessage(strMessage,MessageType)
{
	if (MessageType==0)
	{
	document.getElementById("AccountMessageBox").style.display = "block";
	document.getElementById("AccountMessageBox").innerHTML =strMessage;
	document.getElementById("AccountMessageBox").className ="alert-box success";
	}
	else if(MessageType==1)
	{
	document.getElementById("AccountMessageBox").style.display = "block";
	document.getElementById("AccountMessageBox").innerHTML =strMessage;
	document.getElementById("AccountMessageBox").className ="alert-box error";
	}
}

function Process_AccountUpdate() 
 {
	document.getElementById("AccountMessageBox").style.display = "none";
	
  //declare variables
  //strUserID=document.getElementById("UserID").value;
  strUsername=document.getElementById("Username").value;
  strPassword=document.getElementById("Password").value;
  strFullname=document.getElementById("Fullname").value;
  strEmail=document.getElementById("Email").value;
  strRole=document.getElementById("Role").value;
  strBranchID=document.getElementById("BranchID").value;
  
   if (strUsername==''){
	showMessage('Company Name is required.',1);
	document.getElementById("Username").focus();
	return;
  }
 
   if (strPassword==''){
	showMessage('Password is required.',1);
	document.getElementById("Password").focus();
	return;
  }
  
  agent.call('','AddUser','callback_AccountUpdate',strUsername,strPassword,strFullname,strEmail,strRole,strBranchID);
 }
  
  function callback_AccountUpdate(str) {
      
	document.getElementById("AccountMessageBox").style.display = "none";
	  
	  if(str==0)
	  {
	  	//alert('Invalid credentials. Please try again!');
		document.getElementById("AccountMessageBox").style.display = "block";
		document.getElementById("AccountMessageBox").innerHTML ="User details  updated.";
		document.getElementById("AccountMessageBox").className ="alert-box success";
		
	  }
	  else 
	  {
		document.getElementById("AccountMessageBox").style.display = "block";
		document.getElementById("AccountMessageBox").innerHTML ="Update was unsuccessful!";
		document.getElementById("AccountMessageBox").className ="alert-box error";
		
	  }
  }

	</script>
</head>

<body>

<table width="440px" border="0" style="font-size:14px">
        	    <tbody>
        	      <tr style="color:black;">
        	        <td width="32">&nbsp;</td>
        	        <td colspan="2">Manage Users....</td>
        	        <td width="23">&nbsp;</td>
      	        </tr>
        	      <tr style="color:black;">
        	        <td>&nbsp;</td>
        	        <td colspan="2"><hr></td>
        	        <td>&nbsp;</td>
      	        </tr>
        	      <tr style="color:black;">
        	        <td height="34">&nbsp;</td>
        	        <td width="106"><label for="textfield">Username:</label></td>
        	        <td width="181"><input name="txtUsername" type="text" required id="Username"></td>
        	        <td>&nbsp;</td>
      	        </tr>
        	      <tr style="color:black;">
        	        <td height="34">&nbsp;</td>
        	        <td><label for="textfield2">Fullname:</label></td>
        	        <td><input name="txtFullname" type="text" id="Fullname"></td>
        	        <td>&nbsp;</td>
      	        </tr>
        	      <tr style="color:black;">
        	        <td height="35">&nbsp;</td>
        	        <td><label for="email">Email:</label></td>
        	        <td><input name="txtEmail" type="email" id="Email"></td>
        	        <td>&nbsp;</td>
      	        </tr>
        	      <tr style="color:black;">
        	        <td height="34">&nbsp;</td>
        	        <td><label for="password">Password:</label></td>
        	        <td><input name="txtPassword" type="password" required id="Password"></td>
        	        <td>&nbsp;</td>
      	        </tr>
        	      <tr style="color:black;">
        	        <td height="31">&nbsp;</td>
        	        <td>Role:</td>
        	        <td><select name="txtRole" id="Role" >
        	          <option value="Standard">Standard</option>
        	          <option value="Supervisor">Supervisor</option>
      	          </select></td>
        	        <td>&nbsp;</td>
      	        </tr>
        	      <tr style="color:black;">
        	        <td>&nbsp;</td>
        	        <td>Company:</td>
        	        <td><select name="txtBranchID" id="BranchID" >
                    <?php
					//Fill relevant forms
						$con=DBLogin();
						
						If ($_SESSION['Role']=='Admin'){
						$sql="SELECT BranchID,CONCAT(CompanyName ,'-',BranchName) BranchName FROM `tbl_branch_setup` inner Join tbl_company_setup on tbl_branch_setup.CompanyID=tbl_company_setup.CompanyID";
						}else{
							$sql="SELECT BranchID,CONCAT(CompanyName ,'-',BranchName) BranchName FROM `tbl_branch_setup` inner Join tbl_company_setup on tbl_branch_setup.CompanyID=tbl_company_setup.CompanyID where BranchID=$_SESSION[BranchID] ";
						}
						$rstPass = mysqli_query($con,$sql);
						while($row = mysqli_fetch_assoc($rstPass))
						{
							
							echo "<option value=".$row['BranchID'].">".$row['BranchName']."</option>";
						}
						
						mysqli_close($con); // Closing Connection
					?>
        	          
        	          
      	          </select></td>
        	        <td>&nbsp;</td>
      	        </tr>
        	      <tr style="color:black;">
        	        <td>&nbsp;</td>
        	        <td colspan="2"><div id="AccountMessageBox" class="alert-box success" style="display:none">Account successfully updated.</div></td>
        	        <td>&nbsp;</td>
      	        </tr>
        	      <tr style="color:black;">
        	        <td>&nbsp;</td>
        	        <td>&nbsp;</td>
        	        <td><input type="submit" name="submit2" value="Save New" onClick="Process_AccountUpdate();"></td>
        	        <td>&nbsp;</td>
      	        </tr>
      	        </tbody>
      	    </table>
</body>
</html>