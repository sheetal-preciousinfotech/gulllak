<?php
session_start();
//for local

/*include($_SERVER['DOCUMENT_ROOT'].'/efs/resources/connection.php');
$redirectPath = "http://".$_SERVER['SERVER_NAME'].'/efs/welcome.php';
$invalidredirectPath = "http://".$_SERVER['SERVER_NAME'].'/efs/login.php';*/

//for server

include($_SERVER['DOCUMENT_ROOT'].'test/resources/connection.php');
$redirectPath = "http://".$_SERVER['SERVER_NAME'].'/efs/welcome.php';
$invalidredirectPath = "http://".$_SERVER['SERVER_NAME'].'/efs/login.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
	      $myusername = $_REQUEST['username'];
	      $mypassword = $_REQUEST['password']; 
	      $sql = "SELECT *  FROM gullak_users WHERE (email = '".$myusername."' OR pancard='".$myusername."' OR phone='".$myusername."') and password = '".md5($mypassword)."'";
	      echo $sql;
	     // echo "<pre>";

	      $result = mysqli_query($conn,$sql);
	      print_r($result);
	      if($result)
	      {

	      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	      $count = mysqli_num_rows($result);
	      print_r($count);die;
	  }
	  else
	  {
	  	echo mysqli_error($conn);die;
	  }
	      // If result matched $myusername and $mypassword, table row must be 1 row

			echo $count;die;
	      if($count == 1) {
	         $_SESSION['login_user'] = $row['pancard'];
	         $row['msg']="login successfully";
	         $abc=json_encode($row);
	         echo $abc;die;
			  echo '<script type="text/javascript">';  
		      echo 'window.location.href = "'.$redirectPath.'";';
		      echo '</script>';
	      }else {
	         $error = "Your Login Name or Password is invalid";
	         $row['msg']="Your Login Name or Password is invalid";
	         $abc=json_encode($row);
	          echo $abc;
	    echo '<script type="text/javascript">'; 
      echo 'alert("Invalid username or Password!!!");'; 
      echo 'window.location.href = "'.$invalidredirectPath.'";';
      echo '</script>';
	      }
 	}
 	else
 	{
 		echo "not";
 	}
?>