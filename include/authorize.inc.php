<?php
	/*
		Article name: 			Creating and deploying PHP front-end applications with data security in mind
		Application name:		Transaction Report Example
		File name:				authorize.inc.php
		Purpose:		 		To check for required session variables and redirect to the login page if needed
		Author:					Mikhail Seliverstov - mikhail.seliverstov@mcgill.ca
		Date:					April 27, 2005
	*/
	
//default variables
	$strProtocol = "https://"; //http or https depending on the configuration of your server
	$strReturnURL = urlencode($strProtocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	$strErrorMessage = "Please login.<br />";
//enable sessions
	session_start();
//validate session data
	if (!strlen($_SESSION["SESSION_TOKEN"]) > 0) {
	/*
		For simplicity, there is no real validation in this code, since the only thing the session token
		contains is a user id.
		You might want to create a standalone token class that performs the validations and exposes
		public data from token's payload.
		Also not that filtering the content of "SESSION_TOKEN" before evaluating it is highly recommended.
	*/
	
	//redirect to the login page if session is invalid
		header("Location: login_form.php?return_url=".$strReturnURL."&error_msg=".urlencode($strErrorMessage));
		exit;
	}
?>