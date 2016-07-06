<?php

if (isset($_SESSION['login_user']))
{	
	session_destroy();
}


include_once('include/functions.inc.php');

sec_session_start();

include_once('include/agent.php');
 
$agent->init();

?>


<!DOCTYPE html >
<!--  Website template by freewebsitetemplates.com  -->
<html>

<head>
	<title>iVerify ID Verification System</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script>
	$(document).ready(function () {
    	$('#logo').addClass('animated fadeInDown');
    	$("input:text:visible:first").focus();
		
		$('#username').focus(function() {
			$('label[for="username"]').addClass('selected');
		});
		$('#username').blur(function() {
			$('label[for="username"]').removeClass('selected');
		});
		$('#password').focus(function() {
			$('label[for="password"]').addClass('selected');
		});
		$('#password').blur(function() {
			$('label[for="password"]').removeClass('selected');
		});
		
		
		$("#btnLogin").click(function(){
			var username=$("#username").val();
			var password=$("#password").val();
			
			//$.post(URL,data,callback);
			
			Process_login();
			
		});
	
	});

	
	
	
	 function Process_login() 
	 {
      // STEP 3: CALLING SERVER FUNCTION FROM CLIENT AGENT
	  //declare variables
	  username = document.getElementById('username').value;
      password = document.getElementById('password').value;
	  
	  
      agent.call('','CheckLogin','callback_login',username,password);
	  
     }
    
	
	 
	// client callback function
    function callback_login(str) {
      
	  
	  if(str==0)
	  {
	  	//alert('Invalid credentials. Please try again!');
		//document.getElementById("erroMsg").bgColor=black
		document.getElementById("erroMsg").innerHTML = 'Invalid credentials. Please try again!';
		document.getElementById("erroMsg").style.backgroundColor = "red";
		document.getElementById('username').focus();
		
	  }
	  else
	  {
		if(str==1)
		{
	  		document.location.href ="?p=search";
		}
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
										    <li class="active" ><a href="?p=login">HOME</a></li>
											<li></li>
											<li></li>
											<li class="last" ><a href="?p=contact">CONTACT US</a></li>
										</ul>
										
										<div class="connect">
										    <a href="#" class="facebook">&nbsp;</a>
											<a href="#" class="twitter">&nbsp;</a>
											
										</div>
										
										<div class="footenote">
										  <span>&copy; Copyright 2016.</span>
										  <span>All rights reserved</span>
										</div>
										
									</div>
									<div id="content" >
									
									    <img src="images/id_verified.jpg" width="735" height="504" alt="" title="">
										
									      
											  <div class="body">
                                              
                
                 <div class="login-box animated fadeInUp">
			<div class="box-header">
				<h2>Log In</h2>
			</div>
             
             
			<label for="username">Username</label>
			<br/>
			<input name="username" type="text" autofocus required id="username">
			<br/>
			<label for="password">Password</label>
			<br/>
			<input name="password" type="password" required id="password">
			<br/>
			<button id="btnLogin" type="submit">Login</button>
            
			<br/>
            <div id="erroMsg"></div>
            
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