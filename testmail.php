<?php
$to = "sheetalprasad95@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: noreply@gulllak.com" . "\r\n" .
"CC: coolbit95@gmail.com";

mail($to,$subject,$txt,$headers);
?>