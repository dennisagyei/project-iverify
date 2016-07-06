<?php
$mysql_hostname = "localhost";
$mysql_user = "iverify_user";
$mysql_password = "SjfMWJf3ByCsQtt9";
$mysql_database = "iVerifyDB";

/**
 * These are the database login details
 */  
define("HOST", "localhost");     // The host you want to connect to.
define("USER", "iverify_user");    // The database username. 
define("PASSWORD", "SjfMWJf3ByCsQtt9");    // The database password. 
define("DATABASE", "iVerifyDB");    // The database name.
 
define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
 
define("SECURE", FALSE);    // FOR DEVELOPMENT ONLY!!!!

function DBLogin()
{
	//global $mysql_hostname,$mysql_user,$mysql_password,$mysql_database;
	
	$con = mysqli_connect(HOST, USER, PASSWORD,DATABASE);
	
	/* check connection */
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		//exit();
	}
	else
	{
		return $con;
	}
}
?>