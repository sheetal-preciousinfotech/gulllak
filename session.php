<?php
   include($_SERVER['DOCUMENT_ROOT'].'/efs/resources/connection.php');
   $redirectPath = "http://".$_SERVER['SERVER_NAME'].'/efs/login.php';

   //for server
/*	   include($_SERVER['DOCUMENT_ROOT'].'/efs/resources/connection.php');
	   $redirectPath = "http://".$_SERVER['SERVER_NAME'].'/efs/login.php';*/
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($conn,"select * from gullak_users where pancard = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['firstname']." ".$row['lastname'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:".$redirectPath."");
   }
?>