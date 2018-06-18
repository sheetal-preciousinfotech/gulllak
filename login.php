<?php
/************ FOR LOCAl******************/
session_start();
$redirectPath = "http://".$_SERVER['SERVER_NAME'].'/efs/userdashboard.php?plan=1000';
$logoImg="http://".$_SERVER['SERVER_NAME'].'/efs/assets/img/logo.png';
$cssPath="http://".$_SERVER['SERVER_NAME'].'/efs/assets/css/login_style.css';
$actionPath="http://".$_SERVER['SERVER_NAME'].'/efs/authanticatelogin.php';
 if(isset($_SESSION['login_user'])){
      header("location:".$redirectPath."");
   }
   $forgotpswdPath = "http://" . $_SERVER['SERVER_NAME'] . '/efs/resources/user/forgotpassword.php';

/************ FOR SERVER******************/
/*$logoImg="http://".$_SERVER['SERVER_NAME'].'/efs/assets/img/logo.png';
$cssPath="http://".$_SERVER['SERVER_NAME'].'/efs/assets/css/login_style.css';
$actionPath="http://".$_SERVER['SERVER_NAME'].'/efs/authanticatelogin.php';*/
?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Simple Login Form Template</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href=<?php echo "$cssPath"; ?> >

  
</head>

<body>
 <img src=<?php echo "$logoImg" ?> height="70px" width="70px"/>
  <div class="log-form">
  <h2>Login to your account</h2>
  <form method="post" action=<?php echo "$actionPath";?>>
    <input type="text" name = "username" placeholder="email or gulllakid" required/>
    <input type="password" name = "password" placeholder="password" required/>
    <input  type="submit" name= "sub" class="btn" value="Login">
    <a class="forgot" href="<?=$forgotpswdPath
?>" style="margin-top: -10%;">Forgot Password?</a>
  </form>
</div><!--end log form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

</body>

</html>