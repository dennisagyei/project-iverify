<?php
// Start the session
include_once('include/functions.inc.php');

sec_session_start();
	

				
    if (isset($_POST['submit'] ) && $_POST['captcha']==$_SESSION['code']) 
	{			
		//&& $_POST['captcha']==$_SESSION['code']
		
		//echo ($_POST['captcha']);
	    $name = $_POST['contact_name'];
		$email = $_POST['contact_email'];
		$message = $_POST['contact_message'];
		$from = 'From: iVerify System'; 
		$to = 'info@techinovatesghana.com'; 
		$subject = 'Hello';
		$results = '';		
		$body = "From: $name\n E-Mail: $email\n Message:\n $message";
	 
        if (mail ($to, $subject, $body, $from)) 
		{ 
	    	$results=1;//echo '<p>Your message has been sent!</p>';
		} else 
		{ 
	    	$results=0;//echo '<p>Something went wrong, go back and try again!</p>'; 
		} 
	}

?>
<!DOCTYPE html >

<html>

<head>
	<title>iVerify ID Verification System</title>
	<meta  charset="iso-8859-1" />
    
    <script>
	
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
										    <li ><a href="?p=search">SEARCH ID</a></li>
											<li ><?php 
											if (isset($_SESSION['login_user']))
												{	
													echo ("<a href='?p=reports' >REPORTS</a>");
												}  ?></li>
                                            <li ><?php 
											if (isset($_SESSION['login_user']))
												{	
													echo ("<a href='#' >ADMIN SETUP</a>");
												}  ?></li>
                                                
											<li ><?php 
											if (isset($_SESSION['login_user']))
												{	
													echo ("<a href='logout.php' >LOG OUT</a>");
												}  ?></li>
											<li class="active"><a href="?p=contact">CONTACT US</a></li>
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
                                              
                
                 <div id="contact-box">
                 <div style="background-color:#D4D3D3" align="center">
                   <h2>General Enquiries? Leave us a message</h2></div>
                   <?php
                   if (isset($results) && $results==1)
				   {
					   echo "<div id='ErrorBox' style='padding-top:0px; padding-bottom:0px' class='alert-box success'><span>success: </span>Your message has been sent.</div>";
				   }
				   else if(isset($results) && $results==0)
				   {
					   echo "<div id='ErrorBox' style='padding-top:0px; padding-bottom:0px' class='alert-box error'><span>error: </span>Please try again.</div>";
				   }
				   
				   ?>
                   <form action="<?php echo esc_url($_SERVER['PHP_SELF']) ?>" method="post"> 
                   <label for="contact_name" style="color:black">Name: </label>
            <br/>
			<input name="contact_name" type="text" required id="contact_name" size="50">
            <br/>
            
            <label for="contact_email" style="color:black">Email: </label>
               <br/>
            <input name="contact_email" type="email" required id="contact_email" size="50">
            
             <br/>
             
             <label for="contact_message" style="color:black">Message: </label>
             
                 <br/>
			
			<textarea name="contact_message" cols="50" rows="5" required>

</textarea>
            <br/> <label for="captcha" style="color:black">Enter Image Text: </label><br>
<input name="captcha" type="text" required size="15">
<img src="captcha.php" /><br/>
			<input id="submit" name="submit" type="submit" value="Send">
            </form>
			<br/>
            
            
            
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