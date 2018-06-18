
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/efs/session.php');
    include($_SERVER['DOCUMENT_ROOT'].'/efs/resources/classes/database.php');
    $data = new Databases; 
    //print_r($_POST);
    $usergukid          = $_SESSION['login_user'];
/************ FOR LOCAl******************/
$otpjspath = "http://".$_SERVER['SERVER_NAME'].'/efs/assets/js/otp_verification.js';
$logoImg="http://".$_SERVER['SERVER_NAME'].'/efs/assets/img/logo.png';
$cssPath="http://".$_SERVER['SERVER_NAME'].'/efs/assets/css/signup_style.css';
$actionPath="http://".$_SERVER['SERVER_NAME'].'/efs/resources/api/txnsub.php';
 
  $jqueryPath = "http://".$_SERVER['SERVER_NAME'].'/efs/assets/js/jquery-ui.min.js';
  $jquerycssPath= "http://".$_SERVER['SERVER_NAME'].'/efs/assets/css/jquery-ui.min.css';

//echo "<pre>";
$user1000  = $data->execute("SELECT *
FROM gulllak_transactions where gulllakid =$usergukid AND amount='1000' ORDER BY `time` DESC LIMIT 1");
$user5000  = $data->execute("SELECT *
FROM gulllak_transactions where gulllakid =$usergukid AND amount='5000' ORDER BY `time` DESC LIMIT 1");
$user10000  = $data->execute("SELECT *
FROM gulllak_transactions where gulllakid =$usergukid AND amount='10000' ORDER BY `time` DESC LIMIT 1");

if($user1000)
{
 
  $payment_status1000=$user1000[0]['payment_status'] ? $user1000[0]['payment_status'] : '';
  $aprvstatus1000=$user1000[0]['approvestatus'] ? $user1000[0]['approvestatus'] : '';
  $stockboxstatus1000=$user1000[0]['stockboxstatus'] ? $user1000[0]['stockboxstatus'] : '';
}


if($user5000)
{
  $payment_status5000=$user5000[0]['payment_status'] ? $user5000[0]['payment_status'] : '';
  $aprvstatus5000=$user5000[0]['approvestatus'] ? $user5000[0]['approvestatus'] : '';
  $stockboxstatus5000=$user5000[0]['stockboxstatus'] ? $user5000[0]['stockboxstatus'] : '';
}

if($user10000)
{
  $payment_status10000=$user10000[0]['payment_status'] ? $user10000[0]['payment_status'] : '';
  $aprvstatus10000=$user10000[0]['approvestatus'] ? $user10000[0]['approvestatus'] : '';
  $stockboxstatus10000=$user10000[0]['stockboxstatus'] ? $user10000[0]['stockboxstatus'] : '';
}

if((isset($payment_status1000)&&($stockboxstatus1000!='closed'))&&(isset($payment_status5000)&&($stockboxstatus5000!='closed'))&&(isset($payment_status10000)&&($stockboxstatus10000!='closed')))
{
  echo "All plans are running wait till payout";
}
else
{


?>
<!DOCTYPE html>
<html lang="en" >
<head>

  <title>Signup</title>
  <!-- CORE CSS-->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <link rel="stylesheet" href=<?php echo "$cssPath"; ?> >
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript" src=<?php echo "$otpjspath";  ?> ></script>
</head>

<body>
  <img src=<?php echo "$logoImg" ?> height="70px" width="70px"/>
<div class="form-style-8" style="margin-top:-5%;">
  <h2>Add Transaction</h2>
  <form method="post" name="signup" action=<?php echo "$actionPath";?> onsubmit="return validateForm()">
   <input type="text" name="gulllakid" value=<?php echo $_SESSION["login_user"];?>&nbsp(userid) readonly/><br>
   <!-- <input type="text" name="amount" value="1000 (amount)" readonly/> <br> -->

   <?php

if((isset($payment_status1000)&&($stockboxstatus1000!='closed'))&&(isset($payment_status5000)&&($stockboxstatus5000!='closed'))){

  echo '
        <select name="amount" placeholder="Amount" required>
    <option disabled selected value> -- Choose Plan -- </option>

    <option>10000</option>
    </select><br> 
    
    ';

}

else if((isset($payment_status1000)&&($stockboxstatus1000!='closed'))&&(isset($payment_status10000)&&($stockboxstatus10000!='closed'))){

  echo '
        <select name="amount" placeholder="Amount" required>
    <option disabled selected value> -- Choose Plan -- </option>

    <option>5000</option>
    </select><br> 
    
    ';

}

else if((isset($payment_status5000)&&($stockboxstatus5000!='closed'))&&(isset($payment_status10000)&&($stockboxstatus10000!='closed'))){

  echo '
        <select name="amount" placeholder="Amount" required>
    <option disabled selected value> -- Choose Plan -- </option>

    <option>1000</option>
    </select><br> 
    
    ';

}

else if(isset($payment_status1000)&&($stockboxstatus1000!='closed'))
{
  echo '
        <select name="amount" placeholder="Amount" required>
    <option disabled selected value> -- Choose Plan -- </option>
   
    <option>5000</option>
    <option>10000</option>
    </select><br> 
    
    ';
}
else if(isset($payment_status5000)&&($stockboxstatus5000!='closed'))
{
   echo '
        <select name="amount" placeholder="Amount" required>
    <option disabled selected value> -- Choose Plan -- </option>
    <option>1000</option>
    <option>10000</option>
  
    </select><br> 
    
    ';
}
else if(isset($payment_status10000)&&($stockboxstatus10000!='closed'))
{
   echo '
        <select name="amount" placeholder="Amount" required>
    <option disabled selected value> -- Choose Plan -- </option>
    <option>1000</option>
    <option>5000</option>
  
    </select><br> 
    
    ';
}
else
{
  echo '
        <select name="amount" placeholder="Amount" required>
    <option disabled selected value> -- Choose Plan -- </option>
    <option>1000</option>
    <option>5000</option>
    <option>10000</option>
    </select><br>     
    ';
}

      ?>
   <select name="source" placeholder="source" required>
    <option disabled selected value> -- select payment mode -- </option>
    <option>Paytm To Paytm</option>
    <option>Paytm To Bank Account</option>
    <option>Bank Account To Bank Account </option>
    <option>Other Apps To Bank Account</option>
    </select><br>
  
   <input type="text" name="transactionid" placeholder="transaction id" required/><br>
   <input type="hidden" name="hiduserid" value=<?php echo $_SESSION["login_user"];?> /><br>
   <div class='container'>
   <input type='text' id="datepicker" name="transaction_date" placeholder="Transaction Date" readonly='true' required/> 
   </div><br>
   <input type="submit" name="sub" value="Submit" >
  </form>     

</div>  
</body> 
</html>
<?php }
?>