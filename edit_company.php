<?php
// Start the session
include_once('include/functions.inc.php');

sec_session_start();

include_once('include/agent.php');
 
$agent->init();


if(isset($_GET['edit_id']))
{
 //$sql_query="SELECT * FROM users WHERE user_id=".$_GET['edit_id'];

 
//Fill relevant forms
$con=DBLogin();
$sql="select * from tbl_company_setup where CompanyID=$_GET[edit_id]";

$rstPass = mysqli_query($con,$sql);
//$rows = mysqli_num_rows($rstPassCheck);
$row = mysqli_fetch_assoc($rstPass);


mysqli_close($con); // Closing Connection
}

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

function Process_CompanyUpdate() 
 {
	document.getElementById("AccountMessageBox").style.display = "none";
	
  //declare variables
  strCompanyID=document.getElementById("CompanyID").value;
  strCompanyname=document.getElementById("CompanyName").value;
  strContactName=document.getElementById("ContactName").value;
  strContactPhone=document.getElementById("ContactPhone").value;
  strAddress=document.getElementById("Address").value;

   //Perform input validations
  
  if (strCompanyname==''){
	showMessage('Company Name is required.',0);
	document.getElementById("CompanyName").focus();
	return;
  }
  
  agent.call('','UpdateCompany','callback_CompanyUpdate',strCompanyID,strCompanyname,strContactName,strContactPhone,strAddress);
 }
  
  function callback_CompanyUpdate(str) {
      
	document.getElementById("AccountMessageBox").style.display = "none";
	  
	  if(str==0)
	  {
	  	//alert('Invalid credentials. Please try again!');
		document.getElementById("AccountMessageBox").style.display = "block";
		document.getElementById("AccountMessageBox").innerHTML ="Company details updated!";
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


<table width="400px" border="0" style="font-size:14px">
        	    <tbody>
        	      <tr style="color:black;">
        	        <td width="1">&nbsp;</td>
        	        <td colspan="2">Manage Company....</td>
        	        <td width="23">&nbsp;</td>
      	        </tr>
        	      <tr style="color:black;">
        	        <td>&nbsp;</td>
        	        <td colspan="2"><hr></td>
        	        <td>&nbsp;</td>
      	        </tr>
        	      <tr style="color:black;">
        	        <td height="34" colspan="2" align="right"><label for="textfield">Company Name:</label></td>
        	        <td colspan="2"><input id="CompanyName" type="text" value="<?php echo $row['CompanyName']; ?>" size="30" required></td>
       	          </tr>
        	      <tr style="color:black;">
        	        <td height="34" colspan="2" align="right"><label for="textfield2">Contact Person:</label></td>
        	        <td colspan="2"><input id="ContactName" type="text" value="<?php echo $row['ContactName']; ?>" size="30"></td>
       	          </tr>
        	      <tr style="color:black;">
        	        <td height="35">&nbsp;</td>
        	        <td width="113" align="right"><label for="email">Phone No:</label></td>
        	        <td colspan="2"><input name="txtPhone" type="text" id="ContactPhone" value="<?php echo $row['ContactPhone']; ?>"></td>
       	          </tr>
        	      <tr style="color:black;">
        	        <td height="34">&nbsp;</td>
        	        <td align="right"><label for="password">Address:</label></td>
        	        <td colspan="2">
                    <textarea name="txtAddress" cols="30" rows="5" id="Address"><?php echo $row['Address']; ?>

                    </textarea></td>
      	        </tr>
        	      <tr style="color:black;">
        	        <td>&nbsp;</td>
        	        <td colspan="2"><div id="AccountMessageBox" class="alert-box success" style="display:none">Account successfully updated.</div></td>
        	        <td><input name="hiddenField" type="hidden" id="CompanyID" value="<?php echo $_GET['edit_id']; ?>"></td>
      	        </tr>
        	      <tr style="color:black;">
        	        <td>&nbsp;</td>
        	        <td>&nbsp;</td>
        	        <td width="205"><input onClick="Process_CompanyUpdate();" type="submit" name="submit"  value="Save Changes"></td>
        	        <td>&nbsp;</td>
      	        </tr>
      	        </tbody>
      	    </table>
            
</body>
</html>