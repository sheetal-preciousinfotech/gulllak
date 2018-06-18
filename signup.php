<?php
error_reporting(~E_ALL);
/************ FOR LOCAl******************/
$otpjspath = "http://".$_SERVER['SERVER_NAME'].'/efs/assets/js/otp_verification.js';
$imgPath="http://".$_SERVER['SERVER_NAME'].'/efs/assets/img/loadimg.gif';
$bgImg="http://".$_SERVER['SERVER_NAME'].'/efs/assets/img/banner.jpg';
$logoImg="http://".$_SERVER['SERVER_NAME'].'/efs/assets/img/logo.png';
$cssPath="http://".$_SERVER['SERVER_NAME'].'/efs/assets/css/style.css';
$cssPath="http://".$_SERVER['SERVER_NAME'].'/efs/assets/css/signup_style.css';
$actionPath="http://".$_SERVER['SERVER_NAME'].'/efs/register.php';
$termsPath="http://".$_SERVER['SERVER_NAME'].'/terms.html';
$userGulkId=$_REQUEST['id'];
if($userGulkId)
{
  $actionPath="http://".$_SERVER['SERVER_NAME'].'/efs/register.php?referid='.$userGulkId;
}


//for server 

/*$otpjspath = "http://".$_SERVER['SERVER_NAME'].'/efs/assets/js/otp_verification.js';
$imgPath="http://".$_SERVER['SERVER_NAME'].'/efs/assets/img/loadimg.gif';
$logoImg="http://".$_SERVER['SERVER_NAME'].'/efs/assets/img/logo.png';
$cssPath="http://".$_SERVER['SERVER_NAME'].'/efs/assets/css/signup_style.css';
$actionPath="http://".$_SERVER['SERVER_NAME'].'/efs/register.php';*/

?>
<!DOCTYPE html>
<html lang="en" >
<head>

  <title>Signup</title>
  <!-- CORE CSS-->
  <link rel="stylesheet" href=<?php echo "$cssPath"; ?> >
  <script type="text/javascript" src=<?php echo "$otpjspath";  ?> ></script>
</head>

<body>
  <img src=<?php echo "$logoImg" ?> height="70px" width="70px"/>
<div class="form-style-8" style="margin-top:-5%;">
  <h2>Registration</h2>
  <form method="post" name="signup" action=<?php echo "$actionPath";?> onsubmit="return validateForm()">
    <input type="text" name="fname" placeholder="First Name" required />
    <input type="text" name="mname" placeholder="Middle Name" />
    <input type="text" name="lname" placeholder="Last Name" required/>
    <input type="email" name="email" placeholder="Email" required/>
    <input type="password" id="pswd" name="pswd" placeholder="Password" required/>
    <input type="password" name="cpswd" id="cpswd" placeholder="Confirm Password" onblur="return vaidatePassword(this.value)" required/>
    <input type="text" id="pancard" name="pancard" placeholder="Pan Card Number" required/>
    <input type="text" id="refId" name="refcode" placeholder="Refference Id" value=<?php echo ($userGulkId)  ? $userGulkId : "Self";?> readonly>
    <input type="text" id="phn" name="phone" value="" placeholder="mobile number" required />
    <div id="LoadingImage" style="display: none; margin-left: 30%" >
    <img src=<?php echo "$imgPath" ?> height="50px" width="50px"/>
    </div>    
    <input type="text" name="otp" id="otp" placeholder="enter otp" style="display:none;margin-left:0%" />
    <p><input type="checkbox" required name="terms"> I accept the <a href="<?=$termsPath?>"><u>Terms and Conditions</u></a></p>
    <input type="submit" id="sub" name="sub" value="submit" disabled> 
  </form>
  <input type="button"  id="sendotp" value="GET OTP" onclick="otpVerification()" style="    display: block;margin-left: 58%;margin-top: -127px;">
   <input type="button"  id="verify" value="Verify OTP" onclick="otpVerificationcode()" style="    display: none;margin-left: 58%;margin-top: -127px;">

</div>  
</body>
</html>