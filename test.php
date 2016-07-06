<?php 
//require('login.php');

//echo crypt('test123',"CRYPT_BLOWFISH");
 include ("include/functions.inc.php");
 
 //echo CheckLogin('dennisagyei','doreen123');
 //echo VerifyID('BRAI-210187-01-01');
 //echo VerifyAudit(1,'BRAI-210187-01-01','Susus');
 
 
  $userlist=SearchUser('');
               
 foreach ($userlist as $value) {
    echo $value['Username'];
}

 echo $_SERVER['HTTP_HOST'];
 echo $_SERVER['REQUEST_URI'];
?>