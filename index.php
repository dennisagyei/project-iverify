<?php
$default_url = 'login.php'; //sets the default_url variable 
$page='';

$allowed_url = array( //this is our array of allowed requests 
'home', 
'reports', 
'search', 
'setup',
'contact',
'accounts' 
); 

//$page = $_GET['page']; sets the page variable from http request 
if( isset( $_POST["p"] ) || isset( $_GET["p"] ))
{
	$page = isset($_GET["p"]) ? $_GET["p"] : $_POST["p"];
}

if (in_array( $page, $allowed_url)) { //check to see if request is in the allowed url list 

    $file = $page.".php"; //setup the full path to page if request is ok 

    if(file_exists($file)) { //make sure file exists 
        include($file); 
		
    } else { //if it doesnt exist, the default is used 
        include($default_url); 
    } 
}else{ //if the request is not in the allowed url list, show default 
    include($default_url); 
}  
?>