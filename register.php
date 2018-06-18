<?php 
//for local
error_reporting(~E_ALL);
$refId=$_REQUEST['referid'];
 include($_SERVER['DOCUMENT_ROOT'].'/efs/resources/classes/database.php');
    $data = new Databases; 
  include($_SERVER['DOCUMENT_ROOT'].'/efs/resources/connection.php');
  $redirectPath = "http://".$_SERVER['SERVER_NAME'].'/efs/signup.php';
  if($refId){
    $redirectPath = "http://".$_SERVER['SERVER_NAME'].'/efs/signup.php?id='.$refId;
  }
  $homeredirect="http://".$_SERVER['SERVER_NAME'].'/efs/home.php';

  //for server
/*  include($_SERVER['DOCUMENT_ROOT'].'/efs/resources/connection.php');
  $redirectPath = "http://".$_SERVER['SERVER_NAME'].'/efs/signup.php';*/

  $fname=$_REQUEST['fname'];
  $mname=$_REQUEST['mname'];
  $lname=$_REQUEST['lname'];
  $email=$_REQUEST['email'];
  $pswd=$_REQUEST['pswd'];
  $pancard=$_REQUEST['pancard'];
  $phone=$_REQUEST['phone'];
  $refcode=$_REQUEST['refcode'];
  


$result1 = $data->count_tuple("SELECT * FROM gullak_users WHERE pancard ='$pancard' ");
$result2 = $data->count_tuple("SELECT * FROM gullak_users WHERE email ='$email' ");
$result3 = $data->count_tuple("SELECT * FROM gullak_users WHERE phone ='$phone' ");

            if ($result1 > 0)  {
       $msg=array('status'=>0, 'msg'=>"Pancard Already exists!!!");
/*        $response=json_encode($msg);
        echo $response; */ 
      


      echo '<script type="text/javascript">'; 
      echo 'alert("Pancard Already exists!!!");'; 
      echo 'window.location.href = "'.$redirectPath.'";';
      echo '</script>';
      
       
    }
    
            else if ($result2 > 0) {
       $msg=array('status'=>0,'msg'=>"email Already exists!!!");
      echo '<script type="text/javascript">'; 
      echo 'alert("email Already exists!!!");'; 
      echo 'window.location.href = "'.$redirectPath.'";';
      echo '</script>';
      
       
    }
            
            else if ($result3 > 0) {
       $msg=array('status'=>0,'msg'=>"phone Already exists!!!");

      


      echo '<script type="text/javascript">'; 
      echo 'alert("phone Already exists!!!");'; 
      echo 'window.location.href = "'.$redirectPath.'";';
      echo '</script>';
      
       
    }



  else
  {
    
    do {
$gulkId = rand(10000000,99999999);
$result = $data->count_tuple("SELECT * FROM gullak_users WHERE gulllakid ='$gulkId' ");
} while ($result > 0);
    date_default_timezone_set('Asia/Calcutta'); 
  
//test

    
    $time = date("Y-m-d H:i:s",time());

      $insert_data = array(  
           'firstname'     =>     mysqli_real_escape_string($data->con, $fname),  
           'middlename'          =>     mysqli_real_escape_string($data->con, $mname),
           'lastname'     =>     mysqli_real_escape_string($data->con, $lname),
           'email'     =>     mysqli_real_escape_string($data->con, $email),
           'password'     =>     mysqli_real_escape_string($data->con, md5($pswd)),
           'pancard'     =>     mysqli_real_escape_string($data->con, $pancard),
           'phone'     =>     mysqli_real_escape_string($data->con, $phone),
           'refferid'     =>     mysqli_real_escape_string($data->con, $refcode),
           'gulllakid'     =>     mysqli_real_escape_string($data->con, $gulkId),
           'registertime'     =>     mysqli_real_escape_string($data->con, $time),


      );  
      
  if($fname!="" AND $lname!="" )
  {
  if($data->insert('gullak_users', $insert_data)) 
  {
    $msg=array('status'=>1,'msg'=>"registered successfully");

    $authKey = "178956AHQFoRlbO65ac341a2";
    $senderId="GULLAK";
    
    $message = trim("Congratulations! You have registered successfully and your Gulllak Id is ".$gulkId." .Now Update Your Account Details to make transaction.Download App From https://play.google.com/store/apps/details?id=com.ebglobalventures.gulllak");

//Define route
$route = "4";
//Prepare you post parameters
$postData = array(
    'authkey' => $authKey,
    'mobiles' => $phone,
    'message' => $message,
    'sender' => $senderId,
    'route' => $route,
    'country'=>'0'
);

//API URL
$url="http://api.msg91.com/api/sendhttp.php";

// init the resource
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    //,CURLOPT_FOLLOWLOCATION => true
));


//Ignore SSL certificate verification
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


//get response
$output = curl_exec($ch);

//Print error if any
if(curl_errno($ch))
{
    echo 'error:' . curl_error($ch); 
}

curl_close($ch);

//echo $output;
  echo '<script type="text/javascript">'; 
  echo 'alert("Registered successfully!!!");'; 
  echo 'window.location.href = "'.$homeredirect.'";';
  echo '</script>';


 /*echo "<SCRIPT> //not showing me this
        alert('$message');
        window.location.replace(".$redirectPath.");
    </SCRIPT>";*/
  }
}
    else
  {
    echo mysqli_error($conn);
  } 
}



 ?>