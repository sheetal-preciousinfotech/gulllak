<?php
   session_start();
   $redirectPath = "http://".$_SERVER['SERVER_NAME'].'/efs/login.php';
   //for server
   /*$redirectPath = "http://".$_SERVER['SERVER_NAME'].'/efs/login.php';*/
   if(session_destroy())  
      header("Location:".$redirectPath);
  
?>