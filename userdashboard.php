<?php
include($_SERVER['DOCUMENT_ROOT'] . '/efs/session.php');
include($_SERVER['DOCUMENT_ROOT'] . '/efs/resources/classes/database.php');
$data               = new Databases;
$plan=$_GET['plan'];
$dashboardPath       = "http://" . $_SERVER['SERVER_NAME'] . '/efs/';
$redirectPath       = "http://" . $_SERVER['SERVER_NAME'] . '/efs/welcome.php?plan=1000';
$jsPath             = "http://" . $_SERVER['SERVER_NAME'] . '/efs/assets/js/user_dashboard.js';
$viewstrPath        = "http://" . $_SERVER['SERVER_NAME'] . '/efs/resources/user/viewstars.php';
$updateprofilePath  = "http://" . $_SERVER['SERVER_NAME'] . '/efs/resources/user/updateprofile.php';
$addPaymentPath     = "http://" . $_SERVER['SERVER_NAME'] . '/efs/resources/user/paymentdetails.php';
$changePasswordPath = "http://" . $_SERVER['SERVER_NAME'] . '/efs/resources/user/changepassword.php';
$cssPath            = "http://" . $_SERVER['SERVER_NAME'] . '/efs/assets/css/dashboard_style.css';
$logoImg            = "http://" . $_SERVER['SERVER_NAME'] . '/efs/assets/img/logo.png';
$usergukid          = $_SESSION['login_user'];
//echo $usergukid;

$bankdetails        = $data->execute("SELECT bankdetails_status,profilepic
FROM gullak_users where gulllakid=$usergukid");
$bankdetails_status = $bankdetails[0]['bankdetails_status'];
//echo $bankdetails_status;
if ($bankdetails[0]['profilepic']) {
    $proileImg = "http://" . $_SERVER['SERVER_NAME'] . '/efs/assets/profileimg/' . $bankdetails[0]['profilepic'];
} else {
    $proileImg = "http://" . $_SERVER['SERVER_NAME'] . '/efs/assets/img/profile.png';
}

date_default_timezone_set('Asia/Calcutta');
$time = date("Y-m-d H:i:s", time());
$time1=strtotime($time);

   $user  = $data->execute("SELECT *
    FROM gulllak_transactions where gulllakid =$usergukid AND amount='$plan' ORDER BY `time` DESC LIMIT 1");
//echo "<pre>";  

//print_r($user);die;

$payment_status=$user[0]['payment_status'];
$approvestatus=$user[0]['approvestatus'];
$stockboxstatus=$user[0]['stockboxstatus'];

if($user[0]['stockboxstatus']=='open')
{
  switch($plan)
{
  case '1000':
 $results            = $data->execute("SELECT *
FROM gulllak_stockbox where usergulllakid=$usergukid ORDER BY time DESC LIMIT 1");
 $gulllak_status    = $results[0]['status'];
$gulllak_aprvtime  = $results[0]['time'];
$gulllak_aprvtime1 = strtotime($gulllak_aprvtime);
$expiretime = date('Y-m-d H:i:s', strtotime('+72 hour', strtotime($gulllak_aprvtime)));
    break;
    case '5000':
 $results            = $data->execute("SELECT *
FROM gulllak_stockboxfive where usergulllakid=$usergukid ORDER BY time DESC LIMIT 1");
  $gulllak_status    = $results[0]['status'];
$gulllak_aprvtime  = $results[0]['time'];
$gulllak_aprvtime1 = strtotime($gulllak_aprvtime);
$expiretime = date('Y-m-d H:i:s', strtotime('+1200 hour', strtotime($gulllak_aprvtime)));
    break;
    case '10000':
 $results            = $data->execute("SELECT *
FROM gulllak_stockboxten where usergulllakid=$usergukid ORDER BY time DESC LIMIT 1");
  $gulllak_status    = $results[0]['status'];
$gulllak_aprvtime  = $results[0]['time'];
$gulllak_aprvtime1 = strtotime($gulllak_aprvtime);
$expiretime = date('Y-m-d H:i:s', strtotime('+240 hour', strtotime($gulllak_aprvtime)));
    break;    
  }



$expiretime1 = strtotime($expiretime);
$secdiff = round((strtotime($expiretime) - strtotime($gulllak_aprvtime)));
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href=<?php
echo "$cssPath";
?> >
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script type="text/javascript" src=<?php
echo "$jsPath";
?> ></script>
<script>
  var gulllak_status = "<?php
echo $gulllak_status;
?>";  
var gulllak_aprvtime = "<?php
echo $gulllak_aprvtime1;
?>";
var nowTime = "<?php
echo $time1;
?>";
var expiretime = "<?php
echo $expiretime1;
?>";
if(gulllak_status=='open')
{
var expiretime=Math.floor(expiretime*1000);
var now = Math.floor(nowTime*1000);
var x = setInterval(function() {
now = now + 1000;

var distance = expiretime - now;
var days = Math.floor(distance / (1000 * 60 * 60 * 24));
var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("timer").style.color="green";
  document.getElementById("timer").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("timer").style.color="green";
    document.getElementById("timer").innerHTML = "Payout Awaited";
  }
}, 1000);
}
else
{
   
        
}

</script>
<style type="text/css">
  .button {
    background-color: #f08238; /* Green */
    border: none;
    color: white;
    padding: 15px 91px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
  .button1 {
    background-color: #FAE9DE; /* Green */
    border: none;
    color: white;
    padding: 15px 91px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
</style>

</head>
<body>
<div><img src=<?php
echo "$logoImg";
?> height="70px" width="70px"/></div>
 <div style="margin-left: 18%;">
<button  id='btn1' class="button1" onclick="window.location.href='<?=$dashboardPath?>userdashboard.php?plan=1000'">1000</button>&nbsp&nbsp&nbsp<button id='btn5' class="button1" onclick="window.location.href='<?=$dashboardPath?>userdashboard.php?plan=5000'">5000</button>&nbsp&nbsp&nbsp
<button id='btn10' class="button1" onclick="window.location.href='<?=$dashboardPath?>userdashboard.php?plan=10000'">10000</button>
</div>
<div class="user" style='background-image:url("<?= $proileImg ?>")'></div>
<div class="gulkstatus1">
<div class="dropdown">
<button onclick="myFunction()" class="dropbtn">Profile Menu</button>
  <div id="myDropdown" class="dropdown-content">
                    <?php
if ($bankdetails_status == 0) {
    $dashbordImg = "http://" . $_SERVER['SERVER_NAME'] . '/efs/assets/img/member_count.png';
    echo "<a href='#' title='kindly add payment details first' style='color:red;cursor:no-drop'>Add Transaction</a>";
}
else
{
  if($approvestatus=='0')
  {
    $dashbordImg = "http://" . $_SERVER['SERVER_NAME'] . '/efs/assets/img/Waiting.png';
  }
  else if($stockboxstatus=='open'){
   $dashbordImg = "http://" . $_SERVER['SERVER_NAME'] . '/efs/assets/img/member_count3.png';
  }
  else
  {
     $dashbordImg = "http://" . $_SERVER['SERVER_NAME'] . '/efs/assets/img/member_count.png';
  }
  
  echo "<a href='welcome.php'>Add Transaction</a>";
}
?>
   <a href="<?= $updateprofilePath ?>">Update Profile</a>
    <a href="invite.php">Invite A Friend</a>
    <a href="<?= $viewstrPath ?>">View Stars</a>
    <a href="<?= $addPaymentPath ?>">Bank/Paytm Details</a>
    <a href="<?= $changePasswordPath ?>">Change Password</a>
    <a href="logout.php">Logout</a>
  </div>
</div>
</div>
<div class="gulkstatus">


<img src=<?php
echo "$dashbordImg";
?> height="400px" width="400px"/>
  </div>
 <div  id="payouttime" style="margin-left: 33%;margin-top:3%"><div ></div>
  <h2>Estimated Payout Time:<span id="timer" style="color:red"></span></h2>

</div>

<script type="text/javascript">
    var plan = "<?php
echo $plan;
?>";
if(plan=='1000')
{
  var btn1=document.getElementById('btn1');
  btn1.setAttribute("class", "button");
  
/*  $(document).ready(function(){
    $("#btn1").click(function(){
        $("#btn1").addClass("button");
       // $("#btn5").removeClass("button");
    });
});*/
}
else if(plan=='5000'){
  var btn5=document.getElementById('btn5');
  btn5.setAttribute("class", "button");
 
}
else{
  var btn10=document.getElementById('btn10');
  btn10.setAttribute("class", "button");
 
}
  
</script>
</body>
</html>