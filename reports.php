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
<!--  Website template by freewebsitetemplates.com  -->
<html>

<head>
	<title>iVerify ID Verification System</title>
	<meta  charset="iso-8859-1" />
    
<script>


 function Process_VerifyID() 
	 {
			 
		 document.getElementById("ErrorBox").style.visibility = "hidden";
      // STEP 3: CALLING SERVER FUNCTION FROM CLIENT AGENT
	  //declare variables
	  ID_NUMBER = document.getElementById('Id_Number').value;
      	  
      agent.call('','VerifyID','callback_VerifyID',ID_NUMBER);
	  
     }
    
	
	 
	// client callback function
 function callback_VerifyID(str) {
      
	  //Animate search
	  document.getElementById("id_card").style.backgroundImage="url('images/319small.gif')";
	  
	  if(str==0)
	  {
	  	//alert('Invalid credentials. Please try again!');
		//document.getElementById("erroMsg").bgColor=black
		document.getElementById("ErrorBox").style.visibility="visible";
		document.getElementById("id_card").style.backgroundImage="url('images/Search.jpg')";
		document.getElementById('Id_Number').focus();
		
	  }
	  else
	  {
		document.getElementById("id_card").style.backgroundImage="url(images/" + str + ")";
		
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
											<li class="active"><a href="?p=reports" >REPORTS</a></li>
                                              <li ><a href="?p=accounts" >MY ACCOUNT</a></li>
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
											    <div id="report-box" >
                                                <div style="background:#E4E4E4; border-radius: 5px 5px 0px 0px; margin-bottom:20px; font-size:16px; height:35px; padding-top:8px; ">Verification Report</div>
                                                
                                              
                                                 <table width="99%" class="pure-table pure-table-bordered" cellpadding="1" >
                                                 <thead>
                                                 	<tr style="text-align: left;">
                                                       <th width="22%" scope="col">Date</th>
                                                       <th width="33%" scope="col">ID</th>
                                                       <th width="21%" scope="col"> Status</th>
                                                       <th width="24%" scope="col">Location</th>
                                                   </tr>
                                                     </thead>
                                                   <tbody>
                                                        <?php
					//Fill relevant forms
						$con=DBLogin();
						$sql="select DATE_FORMAT(audit_date,'%d-%m-%Y') NewDate,card_id,status from 
						tbl_audit_verify where user_id= $_SESSION[userID]
						order by audit_date desc limit 10  ";
						$rstPass = mysqli_query($con,$sql);
						
						
						while($row = mysqli_fetch_assoc($rstPass))
						{
							echo "<tr>";
                            echo "<td>".$row['NewDate']."</td>";
                            echo "<td>".$row['card_id']."</td>";     
							echo "<td>".$row['status']."</td>";         
							echo "<td>"."</td>";                
                            echo "</tr>";
						}
						
						mysqli_close($con); 
				?>
                                                     
                                                   
                                                   </tbody>
                                                 </table>
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