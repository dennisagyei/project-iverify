<?php
error_reporting(E_ALL); 
define('AJAXAGENT_ADVANCED', 1);
include_once('agent.php');
$agent->register_prefix('ajax_');
$agent->options(true, true);
$agent->agent_process();

show_test();

function ajax_return_str($str){
	return $str;
}

function ajax_return_obj($obj){
	return $obj;
}

function ajax_get_str($mode = "latin"){
	switch($mode){
		case 'latin':
			return "Test text &едц+";
			break;
		case 'utf8':
			return utf8_encode("Test text &едц+");
			break;		
	}
}

function ajax_get_obj($mode = "latin"){
	$obj = array();
	switch($mode){
		case 'latin':
			$obj[0] = "Test text";
			$obj[1] = true;
			$obj[2] = 1;
			$obj[3] = "&едц+";
			break;
		case 'utf8':
			$obj[0] = utf8_encode("Test text");
			$obj[1] = utf8_encode(true);
			$obj[2] = utf8_encode(1);
			$obj[3] = utf8_encode("&едц+");
			break;		
	}
	return $obj;
}
	
function ajax_put_obj($obj, $mode = 'latin'){
	if (count($obj) == 4){
		if($obj[0] == "Test text"
		&& $obj[1] == true
		&& $obj[2] == 1
		&& $obj[3] == "&едц+"
		&& $mode == 'latin')
			return 1;
		if($obj[0] == "Test text"
		&& $obj[1] == true
		&& $obj[2] == 1
		&& $obj[3] == utf8_encode("&едц+")
		&& $mode == 'utf8')
			return 1;
	}	
	if (count($obj) == 3){
		if($obj[0] == "Test text"
		&& $obj[1] == true
		&& $obj[2] == 1
		&& $mode == 'latin')
			return 1;
		if($obj[0] == "Test text"
		&& $obj[1] == true
		&& $obj[2] == 1
		&& $mode == 'utf8')
			return 1;
	}	
	return 0;
}

function ajax_get_snuff($mode = 'latin'){
	$text1 = 'text " text';
	$text2 = "text ' text";
	
	$res = "";
	switch ($mode){
		case 'latin':
			$res = $text1;
			break;
		case 'utf8':
			$res = utf8_encode($text1);
			break;
		case 'arr1':
			$res = array($text1, 1);
			break;
		case 'arr2':
			$res = array($text2, 1);
			break;
	}
	return $res;
}

function ajax_put_snuff($str, $mode){
	$text1 = 'text " text &едц+';
	$text2 = "text ' text &едц+";

	if (get_magic_quotes_gpc()){
		$text1 = addslashes($text1);
		$text2 = addslashes($text2);
	}
		
//	return htmlentities(print_r($str, true) . "---" . $mode);
	switch ($mode){
		case 'str1':
			if ($str == $text1)
				return 1;
			else 
				return htmlentities("-$str- != -text \" text &едц+-");
			break;
		case 'str2':
			if ($str == $text2)
				return 1;
			else 
				return htmlentities("-$str- != -text ' text &едц+-");
			break;
		case 'arr1':
			if ($str[0] == $text1 && $str[1] == 1)
				return 1;
			break;
		case 'arr2':
			if ($str[0] == $text2 && $str[1] == 1)
				return 1;
			break;
	}
	return 0;
}

function ajax_get_snuff_in_array(){
	return array(123, 'abc"d"efg');
}

function ajax_updateclock() {
	$t=gettimeofday();
	return date("H:i:s:") . sprintf("%02d", round($t['usec']/10000));
}

function ajax_get_html(){
	return "<strong>Hello World!</strong>";
}

function ajax_get_murray(){
	return "form action=\"java script:savetab1('co_')\" name='co_form' method='post' enctype='multipart/form-data'";
}

function ajax_get_murray_array(){
	return array("form action=\"java script:savetab1('co_')\" name='co_form' method='post' enctype='multipart/form-data'", 1);
}

function ajax_add_slashes($str){
	if (get_magic_quotes_gpc()) {
		if ($str == "Kalle\'")
			return 1;
	} else {
		if ($str == "Kalle'")
			return 1;
	}
	return 0;
}

function ajax_get_error(){
	mysql_query();
	return "Works!";
}

function show_test(){
	global $agent;
	echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Ajax_test</title>';
$agent->init();	
echo "<script language='javascript' type='text/javascript' src='agent_test.js'></script>";

echo "</head><body>
Running the tests.
<div id='score'></div>
<div id='test'></div>
<br><br>Test div: <div id='html_test'></div>
<div id='AjaxWorking' style='position: absolute; top: 200px; left: 300px; display: none; width: 200px; height: 80px; border: 1px solid #000; background-color: #CFC; text-align: center; padding-top: 30px;'>Contacting the server<br>for more information<br><br><b>Please hold...</b></div>
</body></html>";
	
echo "<SCRIPT language='JavaScript' type='text/javascript'>
<!--
load_app();
//-->
</SCRIPT>";	
}


?>