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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    
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
										    <li class="active" ><a href="?p=search">HOME</a></li>
											<li ><a href="?p=reports" >REPORTS</a></li>
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
                                              
                
                 <div id="search-box">
			
             
			<label for="Id_Number" style="color:black">Enter ID : </label>
			<input name="Id_Number" type="text" autofocus required id="Id_Number">
			&nbsp;
			
			<button type="submit" onClick="Process_VerifyID();" >Verify</button>
            
			
            <div id="erroMsg" style="background-color:black"></div>
            <div id="id_card">
            <div id="ErrorBox" class="alert-box error" style="visibility:hidden"><span>error: </span>Enter correct ID .</div>
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