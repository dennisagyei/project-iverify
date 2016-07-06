<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script>
//openCity("London")
function openCity(cityName) {
    var i;
    var x = document.getElementsByClassName("city");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    document.getElementById(cityName).style.display = "block";  
	
	
}

$(document).ready(function(){
	$("#btn").click(function(){
	$("#container").load("loaddata.txt",function(responseTxt, statusTxt, xhr){
		if(statusTxt == "success")
            alert("External content loaded successfully!");
        if(statusTxt == "error")
            alert("Error: " + xhr.status + ": " + xhr.statusText);
	});		
	});
	
	$.ajax(
   
   $("li").click(function(){
	   $(this).css({"background-color":"black","text-align":"left"});
   });

});
</script>
<style type="text/css">
.menu_div {
	position: absolute;
	width: 757px;
	height: 46px;
	border:1px solid black;
	margin: 5px 5px 5px 5px;
	text-align:center;
	border-radius:5px;
	background-color: white;
}

.menu_item{
	border:1px solid black;
	margin: 5px 5px 5px 5px;
	padding: 5px 5px 5px 5px;
	
	text-align:center;
	border-radius:5px;
	float:left;
	position:relative;
}

.menu_item a {
    display: block;
    color: black;
    text-align: center;
	text-decoration: none;
}

/* Change the link color to #111 (black) on hover */
.menu_item:hover {
    background-color: blue;
}

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

.w3-navbar {
	list-style-type:none;
	margin:0;padding:0;
	overflow:hidden
	}
.w3-navbar li {
	float:left
	}

.w3-navbar li a { 
display:block;
padding:8px 16px
}
.w3-navbar li a:hover {
	color:#000;
	background-color:#ccc
	}

.w3-container:after,.w3-row:after,.w3-row-padding:after,.w3-topnav:after,.w3-clear:after,.w3-btn-group:before,.w3-btn-group:after
{content:"";display:table;clear:both}
       
</style>
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="menu_div">
<a class="myButton" href="#">Home</a>
<a class="myButton" href="#">Download</a>
<a class="myButton" href="#">Reports</a>
<a class="myButton" href="#">Contacts</a>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="100%" border="1">
  <tbody>
    <tr>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
<p>
  <input type="submit" name="btn" id="btn" value="Submit">
</p>
<p>&nbsp;</p>
<div id="container">
</div>
<ul class="w3-navbar">
  <li><a href="#" onclick="openCity('London')">London</a></li>
  <li><a href="#" onclick="openCity('Paris')">Paris</a></li>
  <li><a href="#" onclick="openCity('Tokyo')">Tokyo</a></li>
</ul>
<div id="London" class="city">
  <h2>London</h2>
  <p>London is the capital city of England.</p>
</div>

<div id="Paris" class="city">
  <h2>Paris</h2>
  <p>Paris is the capital of France.</p> 
</div>

<div id="Tokyo" class="city">
  <h2>Tokyo</h2>
  <p>Tokyo is the capital of Japan.</p>
</div>
</body>
</html>
