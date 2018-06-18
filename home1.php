<?php
$logoImg="http://".$_SERVER['SERVER_NAME'].'/efs/assets/img/logo.png';
$cssPath="http://".$_SERVER['SERVER_NAME'].'/efs/assets/css/login_style.css';
$signinPath="http://".$_SERVER['SERVER_NAME'].'/efs/signup.php';
$loginpath="http://".$_SERVER['SERVER_NAME'].'/efs/login.php';
$aboutusPath="http://".$_SERVER['SERVER_NAME'].'/efs/aboutus.php';
/*$logoImg="http://".$_SERVER['SERVER_NAME'].'/efs/assets/img/logo.png';
$cssPath="http://".$_SERVER['SERVER_NAME'].'/efs/assets/css/login_style.css';
$signinPath="http://".$_SERVER['SERVER_NAME'].'/efs/signup.php';
$loginpath="http://".$_SERVER['SERVER_NAME'].'/efs/login.php';*/

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Simple Login Form Template</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

      <link rel="stylesheet" href=<?php echo "$cssPath"; ?> >

  <link rel="stylesheet" href=<?php echo "$cssPath"; ?> >
</head>

<body>
 <img src=<?php echo "$logoImg" ?> height="70px" width="70px"/>
 
<div style="margin-left: 80%;margin-top: -48px;">
	<a href=<?php echo "$aboutusPath"; ?>>About Us</a> 
  <a href=<?php echo "$signinPath"; ?>><i class=" fa fa-sign-in"></i>sign Up</a> 
  &nbsp&nbsp<a href=<?php echo "$loginpath"; ?>><i class=" fa fa-sign-in"></i>Login</a> 
 </div>


  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

</body>

</html>