<?php
include($_SERVER['DOCUMENT_ROOT'] . '/efs/resources/connection.php');
$redirectPath        = "http://" . $_SERVER['SERVER_NAME'] . '/efs/userdashboard.php?plan=1000';
$adminPath="http://" . $_SERVER['SERVER_NAME'] . '/efs/admin.php';
$dataPath="http://" . $_SERVER['SERVER_NAME'] . '/efs/resources/backend/data.php';
$invalidredirectPath = "http://" . $_SERVER['SERVER_NAME'] . '/efs/login.php';
$proileImg           = "http://" . $_SERVER['SERVER_NAME'] . '/efs/assets/profileimg/';
$pancardImg          = "http://" . $_SERVER['SERVER_NAME'] . '/efs/assets/pancardimg/';
/* include($_SERVER['DOCUMENT_ROOT'].'/efs/resources/connection.php');
$redirectPath = "http://".$_SERVER['SERVER_NAME'].'/efs/welcome.php';
$invalidredirectPath = "http://".$_SERVER['SERVER_NAME'].'/efs/login.php';*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $myusername = $_REQUEST['username'];
    $mypassword = $_REQUEST['password'];
    session_start();
    
    $sql   = "SELECT id,firstname,middlename,lastname,email,pancard,phone,refferid,gulllakid,profilepic,pancardpic,bankdetails_status,address,city,pincode  FROM gullak_users WHERE (email = '" . $myusername . "' OR gulllakid='" . $myusername . "') and password = '" . md5($mypassword) . "'";
    $res   = mysqli_query($conn, $sql);
    $row   = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        $_SESSION['login_user'] = $row['gulllakid'];
        $row['status']          = true;
        $row['msg']             = "login successfully";
        if ($row['profilepic']) {
            $row['profileImgPath'] = $proileImg . $row['profilepic'];
            
        } else {
            $row['profileImgPath'] = "http://" . $_SERVER['SERVER_NAME'] . '/efs/assets/img/profile.png';
            
        }
        if ($row['pancardpic']) {
            $row['pancardImgPath'] = $pancardImg . $row['pancardpic'];
        } else {
            $row['pancardImgPath'] = "";
        }

        if(($row['email']=='admin@gulllak.com'))
        {
            echo '<script type="text/javascript">';
        echo 'window.location.href = "' . $adminPath . '";';
        echo '</script>';
        }
        if(($row['email']=='data@gulllak.com'))
        {
            echo '<script type="text/javascript">';
        echo 'window.location.href = "' . $dataPath . '";';
        echo '</script>';
        }
        if(($row['email']=='approval@gulllak.com'))
        {
            echo '<script type="text/javascript">';
        echo 'window.location.href = "' . $adminPath . '";';
        echo '</script>';
        }
        else
        {
        
        echo '<script type="text/javascript">';
        echo 'window.location.href = "' . $redirectPath . '";';
        echo '</script>';
        }
    
    } else {

        echo '<script type="text/javascript">';
        echo 'alert("Invalid username or Password!!!");';
        echo 'window.location.href = "' . $invalidredirectPath . '";';
        echo '</script>';
    }
} else {
    echo "not";
}
?>