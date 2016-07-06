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

?>



<!DOCTYPE html >

<html>

<head>
	<title>iVerify ID Verification System</title>
	<meta  charset="iso-8859-1" />
    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script>

$(document).ready(function(){
   
        $("#editUserContainer").load('add_user.php');
		//$(".user_setup_menu_ul").append(("<li><a href='#' onClick='openAddUser();'>Add New User... </a></li>");
		
		$("#SearchUser").keyup(function(){
			var SearchItem=$(this).val();
		
		});
		
		$("#btnAddCompany").click(function(){
			alert("Company added");
		});
    
});

function Process_SearchUser()
{
	  var username= $("#SearchUser").val();
	  agent.call('','SearchUser','callback_SearchUser',username);
}

function callback_SearchUser(strUserlist)
{	
	var x=JSON.parse(strUserlist);
	

	$("#UserList").empty();
	
	for (x in strUserlist) {
   		 
		 $("#UserList").append("<li><a href='#' onClick='openEditUser("+strUserlist[x].UserID+")';>"+ strUserlist[x].Username+"</a></li>");
	
		 console.log(strUserlist[x].UserID+ '-'+strUserlist[x].Username);
	}
	
	$("#UserList").append("<li><a href='#' onClick='openAddUser();'>Add New User... </a></li>");
}

function Process_SearchCompany()
{
	  var companyname= $("#SearchCompany").val();
	  agent.call('','SearchCompany','callback_SearchCompany',companyname);
}

function callback_SearchCompany(objCompanylist)
{	
	var x=JSON.parse(objCompanylist);
	

	$("#CompanyList").empty();
	
	for (x in objCompanylist) {
   		 
		 $("#CompanyList").append("<li><a href='#' onClick='openEditCompany("+objCompanylist[x].CompanyID+")';>"+ objCompanylist[x].CompanyName+"</a></li>");
	
		 console.log(objCompanylist[x].CompanyID+ '-'+objCompanylist[x].CompanyName);
	}
	
	$("#CompanyList").append("<li><a href='#' onClick='openAddCompany();'>Add New Company... </a></li>");

}

function openTabPage(evt,TabPage) {
    var i;
    var x = document.getElementsByClassName("tab");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
	
	var tablinks = document.getElementsByClassName("tablink");
  	for (i = 0; i < x.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
  	}
	

    document.getElementById(TabPage).style.display = "block";  
	evt.currentTarget.className +=" w3-red";
}


function openEditCompany(strSrc) 
{
	   strSrc="edit_company.php?edit_id="+strSrc;
	   $('#editContainer').load(strSrc);
      //document.getElementById("editContainer").innerHTML="<iframe width=400 height=320 frameborder=0 src="+strSrc+">   </iframe>";	  
}

function openAddCompany() 
{
	   strSrc="add_company.php";
	   
	   $('#editContainer').load(strSrc);
	   //alert(strSrc);
      //document.getElementById("editContainer").innerHTML="<iframe width=400 height=320 frameborder=0 src="+strSrc+">   </iframe>";	  
}

function openEditUser(strSrc) 
 {
	   strSrc="edit_user.php?edit_id="+strSrc;
	   $('#editUserContainer').load(strSrc);
      //document.getElementById("editUserContainer").innerHTML="<iframe width=440 height=320 frameborder=0 src="+strSrc+">   </iframe>";	  
}

function openAddUser() 
 {
	   strSrc="add_user.php";
	   $('#editUserContainer').load(strSrc);
	   //alert(strSrc);
      //document.getElementById("editUserContainer").innerHTML="<iframe width=440 height=320 frameborder=0 src="+strSrc+">   </iframe>";	  
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
                                              <li  ><a href="?p=accounts" >MY ACCOUNT</a></li>
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
										<a href="#" class="twitter">&nbsp;</a></div>
										
										<div class="footenote">
										  <span>&copy; Copyright 2016.</span>
										  <span>All rights reserved</span>
										</div>
										
									</div>
									<div id="content" >
									
									    <img src="images/id_verified.jpg" width="735" height="504" alt="" title="">
										
									      
											  <div class="body">
      <div class="tabs">
    <ul class="navbar_ul" >
        <li><a href="#" class="tablink w3-red" onClick="openTabPage(event,'tab2');openAddUser(); ">User Setup</a></li>
         <?php 
			if ($_SESSION['Role']=='Admin')
			{
				//echo "<li ><a href='?p=setup' >ADMIN SETUP</a></li>";
		echo "<li><a href='#' class='tablink' onClick="."openTabPage(event,'tab1');openAddCompany()".">Company Setup</a></li>";
        echo "<li><a href='#' class='tablink' onClick="."openTabPage(event,'tab3')".">Branch Setup</a></li>	";							   
											  
		   }
		?>
        
    
        </ul>
 
    <div class="tab-content">
        <div id="tab1" class="tab">
            <div id="editContainer" style="float:right;border-radius: 5px; border:2px solid #f1f1f1;color:black; padding-right:20px "> 
        	  <table width="400px" border="0" style="font-size:14px">
        	    <tbody>
        	      <tr style="color:black;">
        	        <td width="32">&nbsp;</td>
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
        	        <td colspan="2"><input name="textfield3" type="text" size="30" ></td>
        	        </tr>
        	      <tr style="color:black;">
        	        <td height="34" colspan="2" align="right"><label for="textfield2">Contact Person:</label></td>
        	        <td colspan="2"><input type="text" name="textfield2" size="30"></td>
        	        </tr>
        	      <tr style="color:black;">
        	        <td height="35">&nbsp;</td>
        	        <td width="106" align="right"><label for="email">Phone No:</label></td>
        	        <td colspan="2"><input type="email" name="email" id="email"></td>
        	        </tr>
        	      <tr style="color:black;">
        	        <td height="34">&nbsp;</td>
        	        <td align="right"><label for="password">Address:</label></td>
        	        <td colspan="2"><textarea rows="5" cols="30">

</textarea></td>
      	        </tr>
        	      <tr style="color:black;">
        	        <td>&nbsp;</td>
        	        <td>&nbsp;</td>
        	        <td width="181">&nbsp;</td>
        	        <td>&nbsp;</td>
      	        </tr>
        	      <tr style="color:black;">
        	        <td>&nbsp;</td>
        	        <td>&nbsp;</td>
        	        <td><input type="submit" name="submit"  value="Update ..."></td>
        	        <td>&nbsp;</td>
      	        </tr>
      	        </tbody>
      	    </table>
        	</div>
          <div>
            
            <div style="background:#E4E4E4; border-radius: 5px 5px 0px 0px; margin-bottom:2px; font-size:14px; height:25px; padding-top:2px; width:180px;font-weight:600; text-align:center">Company List</div>
            <div style="height:220px; width:180px">
            <ul id="CompanyList" class="user_setup_menu_ul">
            	<?php
					
					    $companylist=SearchCompany('');
						
						
						foreach($companylist as $row)
						{
							echo "<li><a href='#' onClick='openEditCompany($row[CompanyID]);'>$row[CompanyName]</a></li>";
						}

				?>
              
        	          
             	<li><a href="#" onClick="openAddCompany();">Add New Company...</a></li> 
             
            </ul>
            </div>
            <div style="background:#E4E4E4; border-radius: 5px 5px 5px 5px; margin-bottom:2px; font-size:14px; height:25px; padding-top:2px; width:180px;">
              <input type="search" name="textfield" id="SearchCompany" placeholder="Search..." onKeyUp="Process_SearchCompany();";>
            </div>
          </div>
          
          <p>&nbsp;  </p>
        </div>
 
        <div id="tab2" class="tab active" style="color:black">
        	<div id="editUserContainer" style="float:right;border-radius: 5px; border:2px solid #f1f1f1;color:black "> 
            <!--<iframe width=440 height=320 frameborder=0 src="add_user.php">   </iframe>-->
        	  
        	</div>
          <div>
            
            <div style="background:#E4E4E4; border-radius: 5px 5px 0px 0px; margin-bottom:2px; font-size:14px; height:25px; padding-top:2px; width:180px;font-weight:600">RECENT USERS</div>
            <div id="UserSearchList" style="height:220px; width:180px">
            <ul id="UserList" class="user_setup_menu_ul">
            
             
            <?php
					
					    $userlist=SearchUser('');
						
						
						foreach($userlist as $row)
						{
							echo "<li><a href='#' onClick='openEditUser($row[UserID])';>$row[Username]</a></li>";
						}

				?>
             			
             		<li><a href="#" onClick="openAddUser();">Add New User... </a></li>
              
            </ul>
            </div>
            <div style="background:#E4E4E4; border-radius: 5px 5px 5px 5px; margin-bottom:2px; font-size:14px; height:25px; padding-top:2px; width:180px;">
              <input type="search" name="textfield" id="SearchUser" placeholder="Search..." onKeyUp="Process_SearchUser();">
            </div>
          </div>
          
          <p>&nbsp;  </p>
          
        </div>
 
        <div id="tab3" class="" style="color:black;">
      	
        	<div id="BranchContainer1" style="border-radius: 5px; border:2px solid #f1f1f1;color:black; width=100px;height:200px;float:left; position:relative "> 
           <ul id="BranchList" class="user_setup_menu_ul">
            
             
            <?php
					
					    $list=SearchCompany('');
						
						
						foreach($list as $row)
						{
							echo "<li><a href='#' onClick='';>$row[CompanyName]</a></li>";
						}

				?>
             			
             		<!--<li><a href="#" onClick="openAddUser();">Add New User... </a></li>-->
              
            </ul>
  
        	</div>
            
            <div id="BranchContainer2" style="border-radius: 5px; border:2px solid #f1f1f1;color:black; width=100px;height:200px;float:left; position:relative "> 
          <div>
          
          <div id="BranchContainer3" style="border-radius: 5px; border:2px solid #f1f1f1;color:black; width=100px;height:200px;float:left; position:relative "> 
          <div>
            
            
            
          </div>
      

        </div>
 
 
    </div>
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