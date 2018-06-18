<?php
include($_SERVER['DOCUMENT_ROOT'] . '/efs/session.php');
/************ FOR LOCAl******************/
include($_SERVER['DOCUMENT_ROOT'].'/efs/resources/classes/database.php');
    $data = new Databases;
$otpjspath = "http://".$_SERVER['SERVER_NAME'].'/efs/assets/js/otp_verification.js';
$imgPath="http://".$_SERVER['SERVER_NAME'].'/efs/assets/img/loadimg.gif';
$bgImg="http://".$_SERVER['SERVER_NAME'].'/efs/assets/img/banner.jpg';
$logoImg="http://".$_SERVER['SERVER_NAME'].'/efs/assets/img/logo.png';
$cssPath="http://".$_SERVER['SERVER_NAME'].'/efs/assets/css/signup_style.css';
$actionPath="http://".$_SERVER['SERVER_NAME'].'/efs/resources/api/bankdetails.php';
$userid=$_SESSION['login_user'];
$res = $data->execute("SELECT * FROM gulllak_bankdetails WHERE usergulllakid ='$userid' ");

print_r($res);
$account_number= ($res ? $res[0]['account_number'] : '');
$ifsc_code= ($res ? $res[0]['ifsc_code'] : '');
$bank_name= ($res ? $res[0]['bank_name'] : '');
$person_name= ($res ? $res[0]['person_name'] : '');
$paytm_number= ($res ? $res[0]['paytm_number'] : '');
$prefer_source= ($res ? $res[0]['prefer_source'] : '');

?>
<!DOCTYPE html>
<html lang="en" >
<head>

  <title>Signup</title>

  <link rel="stylesheet" href=<?php echo "$cssPath"; ?> >
  <script type="text/javascript" src=<?php echo "$otpjspath";  ?> ></script>
</head>

<body>
  <img src=<?php echo "$logoImg" ?> height="70px" width="70px"/>
  <div class="form-style-8" style="margin-top:-5%;">
  <h2>Payment Details</h2>
  <form method="post" id="updateform" name="signup" action=<?php echo "$actionPath";?> enctype="multipart/form-data" onsubmit="return validateForm()">
    <input type="text" name="person_name" placeholder="Name As per Bank Account" value="<?=$person_name?>" required />
    <input type="text" name="account_number" placeholder="Account Number" value="<?=$account_number?>" required />
    <input type="text" name="ifsc_code" placeholder="IFSC Code" value="<?=$ifsc_code?>" required />
    <input type="text" name="bank_name" placeholder="Bank Name" value="<?=$bank_name?>" required />
    <input type="text" id="phn" name="paytm_number" placeholder="Paytm Mobile Number" value="<?=$paytm_number?>" required/>
    <p>Choose Your Preference Payout Source:<p>
  <input type="radio" name="source" value="Paytm" checked> Paytm<br>
  <input type="radio" name="source" value="Bank Account"> Bank Account<br>
    <input type="hidden" name="usergulllakid" value=<?php echo $_SESSION["login_user"];?> /><br>
    <input type="submit" id="sub" name="sub" value="submit"> 
  </form>

</div>                     





</body>

</html>