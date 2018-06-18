<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/efs/session.php');
    include($_SERVER['DOCUMENT_ROOT'].'/efs/resources/classes/database.php');
    $data = new Databases; 
    $imgPath="http://".$_SERVER['SERVER_NAME'].'/efs/assets/img/loadimg.gif';
    $cssPath="http://".$_SERVER['SERVER_NAME'].'/efs/assets/css/table_style.css';
    $dialogCssPath="http://".$_SERVER['SERVER_NAME'].'/efs/assets/css/dialog.css';
    $jsPath = "http://".$_SERVER['SERVER_NAME'].'/efs/assets/js/otp_verification.js';
     $dialogjsPath = "http://".$_SERVER['SERVER_NAME'].'/efs/assets/js/dialog.js';
    $aprvPath="http://".$_SERVER['SERVER_NAME'].'/efs/resources/admin/approve.php?id=';
    $releasePayoutPath="http://".$_SERVER['SERVER_NAME'].'/efs/resources/admin/releasepayout.php';
$releaseclaimPayoutPath="http://".$_SERVER['SERVER_NAME'].'/efs/resources/admin/starclaim.php';
    //for server
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Tabs - Default functionality</title>
  <link rel="stylesheet" href=<?php echo "$dialogCssPath"; ?> > 
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/ui-darkness/jquery-ui.css" rel="stylesheet">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src=<?php echo "$dialogjsPath";  ?> ></script>
   <script type="text/javascript" src=<?php echo "$jsPath";  ?> ></script>

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<!-- <script src="js/dialog.js" type="text/javascript"></script> -->
   <!-- //end test -->
  <script>
  $( function() {
    $( "#tabs" ).tabs();
    $(document).ready(function() {
    $('#newpay').DataTable();
    $('#relcalim').DataTable();
    $('#payoutfive').DataTable();
    $('#relpayoutfive').DataTable();
        $('#payoutten').DataTable();
    $('#relpayoutten').DataTable();
    
    
     });
  } );
  </script>
<link rel="stylesheet" href=<?php echo "$cssPath"; ?> > 
</head>
<body>
     <div id="LoadingImage" style="display: none; margin-left: 30%" >
    <img src=<?php echo "$imgPath" ?> height="50px" width="50px"/>
    </div>   
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Users</a></li>
    <li><a href="#tabs-2">transactions</a></li>
    <li><a href="#tabs-3">Payouts</a></li>
    <li><a href="#tabs-4">Released Payouts</a></li>
     <li><a href="#tabs-5">Claim Payouts</a></li>
     <li><a href="#tabs-6">New Payouts</a></li>
     <li><a href="#tabs-7">Release Claim Payouts</a></li>
     <li><a href="#tabs-8">Payouts 5000</a></li>
     <li><a href="#tabs-9">Released Payouts 5000</a></li>
     <li><a href="#tabs-10">Payouts 10000</a></li>
     <li><a href="#tabs-11">Released Payouts 10000</a></li>
  </ul>
  <div id="tabs-1">
   <table border="1 px solid black" class="data-table" id="example">
    <thead>
        <tr>
          <th>S.No</th>
            <th>gulllak id</th>
            <th>Name</th>
            <th>Reference</th>
            <th>email</th>
            <th>Pan Card</th>
            <th>phone</th>
        </tr>
       
    </thead>
    <tbody>
      <?php
      $i=0;
     $results = $data->select('gullak_users');
    foreach($results as $row):?> 




            <tr>
                <td><?=++$i;?></td>
                <td><?=$row['gulllakid'];?></td>
                <td><?=$row['firstname']." ".$row['lastname'];?></td>
                <td><?=$row['refferid'];?></td>
                <td><?=$row['email'];?></td>
                <td><?=$row['pancard'];?></td>
                <td><?=$row['phone'];?></td>                
            </tr>
    <?php endforeach;?>
             
    </tbody>
</table>


  </div>



  <div id="tabs-2">
   <table border="1 px solid black" class="data-table" id="example1">
    <thead>
        <tr>
          <th>S.No</th>
            <th>gulllak id</th>
            <th>Name</th>
            <th>amount</th>
            <th>source</th>
            <th>role</th>
            <th>Transaction Id</th>
            <th>Transaction Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
      <?php
      $from= '2018-06-01 23:59:59';
       $to= '2018-06-08 23:59:59';
      $i=0;
     $results = $data->execute("SELECT gullak_users.firstname,gullak_users.gulllakid,gullak_users.lastname, gulllak_transactions.amount,gulllak_transactions.source,gulllak_transactions.transactionid,gulllak_transactions.role,gulllak_transactions.transaction_date,gulllak_transactions.approvestatus
FROM gulllak_transactions
INNER JOIN gullak_users ON gulllak_transactions.gulllakid = gullak_users.gulllakid where gulllak_transactions.time >= '$from'  order by gulllak_transactions.time ASC");  
    //echo "<pre>";
    // print_r($results);
     if($results ){
    foreach($results as $row): ?>
          



            <tr> 
                <td><?=++$i;?></td> 
                <td><?=$row['gulllakid'];?></td>
                <td><?=$row['firstname']." ".$row['lastname'];?></td>
                <td id='planamount_<?=$row['gulllakid'];?>'><?=$row['amount'];?></td>
                <td><?=$row['source'];?></td> 
                <td><?="By ".$row['role'];?></td>
                <td><?=$row['transactionid'];?></td>   
                <td><?=$row['transaction_date'];?></td> 
                <?php 
                if($row['approvestatus']==0) 
                  { 
                    echo "<td style ='width: 13%;'  id='staus'><span><input type='button' value='Approve' id='del_".$row['gulllakid']."_".$row['amount']."' class='delete'/>&nbsp&nbsp<input type='button' value='Delete' id='deltxn_".$row['gulllakid']."_".$row['amount']."' class='deletetxn' style='
    margin-top: 10% ;background-color: #e8b9b9;color:#9a1111;
'/></span>
                          </td>  " ;
                }
                else
                { 
                  echo "<td id='staus'><span>Approved</span></td> ";}
                ?>
                                
            </tr>
    <?php endforeach;}?>
             
    </tbody>
</table>
  </div>
  <div id="tabs-3">
    <table border="1 px solid black" class="data-table" id="payout" style="width: 146%;">
    <thead>
        <tr>
            <th>S.No</th>
            <th>gulllakid</th>
            <th>Name</th>
            <th>phone</th>
            <th colspan="3">Bank Details</th>
            <th>Preference</th>
            <th>Paytm Number</th>
            <th>pancard</th>
            <th>Approve Time</th>
            <th>Action</th>

        </tr>
            <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Bank Name</td>
            <td>Account Number</td>
            <td>IFSC Code</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
           
        </tr>
 </thead>   
    <tbody>
 <?php
       $i=0;
        date_default_timezone_set('Asia/Calcutta');
        $the_time =date("Y-m-d H:i:s",time());
        $results =$data->execute("SELECT gullak_users.firstname,gullak_users.pancard,gullak_users.gulllakid,gullak_users.lastname,gullak_users.phone,gullak_users.email,gulllak_stockbox.membercount,gulllak_stockbox.time,gulllak_bankdetails.account_number,gulllak_bankdetails.ifsc_code,gulllak_bankdetails.bank_name,gulllak_bankdetails.paytm_number,gulllak_bankdetails.prefer_source
FROM gulllak_stockbox
LEFT JOIN gullak_users ON gulllak_stockbox.usergulllakid = gullak_users.gulllakid

LEFT JOIN gulllak_bankdetails ON gulllak_stockbox.usergulllakid = gulllak_bankdetails.usergulllakid

 WHERE gulllak_stockbox.status='open' ORDER BY gulllak_stockbox.position ASC  ");
/*        echo "<pre>";
print_r($results);die;*/
        if($results ){
 foreach($results as $row):
     $new_time=$row['time'];
     //echo "$new_time <br>";
     $hourdiff = round((strtotime($the_time) - strtotime($new_time))/3600, 1);
   if($hourdiff>=60){
  ?> 
 



            <tr>
              <td><?=++$i;?></td>
                <td><?=$row['gulllakid'];?></td>
                <td><?=$row['firstname']." ".$row['lastname'];?></td>
                <td><?=$row['phone'];?></td>
                <td><?=$row['bank_name'];?></td> 
                <td><?=$row['account_number'];?></td>  
                <td><?=$row['ifsc_code'];?></td>
                <td><?=$row['prefer_source'];?></td>   
                <td><?=$row['paytm_number'];?></td>
                <td><?=$row['pancard'];?></td>
                <td><?=$row['time'];?></td>
                
                
  <td id='staus'><input type='button' value='Release Payout' id="del_<?=$row['gulllakid'] ?>" class='relpay'/>
                          </td>
                             
            </tr>
            <?php  }?>
    <?php endforeach;}?>
             
    </tbody>
</table>


<!-- test dialog -->
 <div class="container">
<div id="dialog" title="Release Payout">
<form action=<?=$releasePayoutPath;?> method="post">
<input id="name" name="transactionid" placeholder="transaction id" type="text" required>
<input type="text" name="amount" value="1425" readonly/> <br> 
<input id="text" name="usergulllakid" type="text" value="<?=$row['gulllakid'];?>" readonly>  
   <select name="source" placeholder="source" required>
    <option disabled selected value> -- select payment mode -- </option>
    <option>Paytm</option>
    <option>Bank Account</option>
    </select>
<input type='text' id="datepicker" name="transaction_date" placeholder="Transaction Date" required/> 
<input id="submit" type="submit" value="Submit">

</form>
</div>
</div>


  </div>
 <!--  start test tab 4 -->
   <div id="tabs-4">
    <table border="1 px solid black" class="data-table" id="relpayout">
    <thead>
        <tr>
            <th>S.No</th>
            <th>gulllakid</th>
            <th>Name</th>
            <th>phone</th>
            <th>Release Date</th>
            <th>pancard</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
 <?php
       $i=0;
        $results =$data->execute("SELECT gullak_users.firstname,gullak_users.pancard,gullak_users.gulllakid,gullak_users.lastname,gullak_users.phone,gullak_users.email,gulllak_stockbox.membercount,gulllak_stockbox.time
FROM gulllak_stockbox
INNER JOIN gullak_users ON gulllak_stockbox.usergulllakid = gullak_users.gulllakid WHERE gulllak_stockbox.membercount = 3 AND  gulllak_stockbox.status='closed' "); 
        if($results ){
 foreach($results as $row):?> 
 



            <tr>
              <td><?=++$i;?></td>
                <td><?=$row['gulllakid'];?></td>
                <td><?=$row['firstname']." ".$row['lastname'];?></td>
                <td><?=$row['phone'];?></td>  
                <td><?=$row['time'];?></td>
                <td><?=$row['pancard'];?></td>
                
  <td id='staus'><input type='button' value='Released' id="del_<?=$row['gulllakid'] ?>" class='relpay' disabled/>
                          </td>
                             
            </tr>
    <?php endforeach;}?>  
             
    </tbody>
</table>


  </div>
  <!-- start test -->
     <div id="tabs-5">
    <table border="1 px solid black" class="data-table" id="claimpayout">
    <thead>
        <tr>
            <th>S.No</th>
            <th>gulllakid</th>
            <th>Name</th>
            <th>phone</th>
            <th>email</th>
            <th>claim stars</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
 <?php
       $i=0;
        $results =$data->execute("SELECT gullak_users.firstname,gullak_users.pancard,gullak_users.gulllakid,gullak_users.lastname,gullak_users.phone,gullak_users.email,gulllak_stars.currentclaimed
FROM gulllak_stars
INNER JOIN gullak_users ON gulllak_stars.usergulllakid = gullak_users.gulllakid WHERE  gulllak_stars.claimedstatus='open' "); 
        if($results ){
 foreach($results as $row):?> 
 



            <tr>
              <td><?=++$i;?></td>
                <td><?=$row['gulllakid'];?></td>
                <td><?=$row['firstname']." ".$row['lastname'];?></td>
                <td><?=$row['phone'];?></td>  
                <td><?=$row['email'];?></td>
                <td><?=$row['currentclaimed'];?></td>
                
  <td id='staus'><input type='button' value='Release Payout' id="del_<?=$row['gulllakid'] ?>" class='starclaim'>
                          
                          </td>
                             
            </tr> 
    <?php endforeach;}?>
             
    </tbody>
</table>
<!-- test dialog -->
 <div class="container">
<div id="claimdialog" title="Release claim Payout">
<form action=<?=$releaseclaimPayoutPath;?> method="post">
<input id="name" name="transactionid" placeholder="transaction id" type="text" required>
<input type="text" name="amount" placeholder="amount" required /> <br> 
<input type="text" id="gulllakid" name="usergulllakid"  value="<?=$row['gulllakid'];?>" readonly>  
   <select name="source" placeholder="source" required>
    <option disabled selected value> -- select payment mode -- </option>
    <option>Paytm</option>
    <option>Bank Account</option>
    </select>
<input type='text' id="datepicker1" name="transaction_date" placeholder="Transaction Date" required/> 
<input id="submit" type="submit" value="Submit">

</form>
</div>
</div>


  </div>



<div id="tabs-6">
    <table border="1 px solid black" class="data-table" id="newpay" style="width: 146%;">
    <thead>
        <tr>
            <th>S.No</th>
            <th>gulllakid</th>
            <th>Name</th>
            <th>phone</th>
            <th colspan="3">Bank Details</th>
            <th>Preference</th>
            <th>Paytm Number</th>
            <th>pancard</th>
            <th>Approve Time</th>
            <th>Action</th>

        </tr>
            <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Bank Name</td>
            <td>Account Number</td>
            <td>IFSC Code</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
           
        </tr>
 </thead>   
    <tbody>
 <?php
       $i=0;
        date_default_timezone_set('Asia/Calcutta');
        $the_time =date("Y-m-d H:i:s",time());
        $results =$data->execute("SELECT gullak_users.firstname,gullak_users.pancard,gullak_users.gulllakid,gullak_users.lastname,gullak_users.phone,gullak_users.email,gulllak_stockbox.membercount,gulllak_stockbox.time,gulllak_bankdetails.account_number,gulllak_bankdetails.ifsc_code,gulllak_bankdetails.bank_name,gulllak_bankdetails.paytm_number,gulllak_bankdetails.prefer_source
FROM gulllak_stockbox
LEFT JOIN gullak_users ON gulllak_stockbox.usergulllakid = gullak_users.gulllakid

LEFT JOIN gulllak_bankdetails ON gulllak_stockbox.usergulllakid = gulllak_bankdetails.usergulllakid

 WHERE gulllak_stockbox.status='open' AND gulllak_stockbox.time >='2018-05-18' ORDER BY gulllak_stockbox.position ASC  ");
/*        echo "<pre>";
print_r($results);die;*/
        if($results ){
 foreach($results as $row):
     $new_time=$row['time'];
     //echo "$new_time <br>";
     $hourdiff = round((strtotime($the_time) - strtotime($new_time))/3600, 1);
   if($hourdiff>=60){
  ?> 
 



            <tr>
              <td><?=++$i;?></td>
                <td><?=$row['gulllakid'];?></td>
                <td><?=$row['firstname']." ".$row['lastname'];?></td>
                <td><?=$row['phone'];?></td>
                <td><?=$row['bank_name'];?></td> 
                <td><?=$row['account_number'];?></td>  
                <td><?=$row['ifsc_code'];?></td>
                <td><?=$row['prefer_source'];?></td>   
                <td><?=$row['paytm_number'];?></td>
                <td><?=$row['pancard'];?></td>
                <td><?=$row['time'];?></td>
                
                
  <td id='staus'><input type='button' value='Release Payout' id="del_<?=$row['gulllakid'] ?>" class='relpay'/>
                          </td>
                             
            </tr>
            <?php  }?>
    <?php endforeach;}?>
             
    </tbody>
</table>


<!-- test dialog -->
<!-- test dialog -->
 <div class="container">
<div id="dialognew" title="Release Payout">
<form action=<?=$releasePayoutPath;?> method="post">
<input id="name" name="transactionid" placeholder="transaction id" type="text" required>
<input type="text" name="amount" value="1425" readonly/> <br> 
<input id="textnew" name="usergulllakid" type="text" value="" readonly>  
   <select name="source" placeholder="source" required>
    <option disabled selected value> -- select payment mode -- </option>
    <option>Paytm</option>
    <option>Bank Account</option>
    </select>
<input type='text' id="datepickernew" name="transaction_date" placeholder="Transaction Date" required/> 
<input id="submit" type="submit" value="Submit">

</form>
</div>
</div>


  </div>


<div id="tabs-7">
   <table border="1 px solid black" class="data-table" id="relcalim" >
   <thead>
        <tr>
            <th>S.No</th>
            <th>gulllakid</th>
            <th>Name</th>
            <th>phone</th>
            <th>Claimed Star</th>
            <th>Release Date</th>
            <th>pancard</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
 <?php
       $i=0;
        $results =$data->execute("SELECT gullak_users.firstname,gullak_users.pancard,gullak_users.gulllakid,gullak_users.lastname,gullak_users.phone,gullak_users.email,gulllak_stars.claimedstar,gulllak_stars.releaseclaimdate
FROM gulllak_stars
INNER JOIN gullak_users ON gulllak_stars.usergulllakid = gullak_users.gulllakid WHERE gulllak_stars.claimedstatus='closed' "); 
        if($results ){
 foreach($results as $row):?> 
 



            <tr>
              <td><?=++$i;?></td>
                <td><?=$row['gulllakid'];?></td>
                <td><?=$row['firstname']." ".$row['lastname'];?></td>
                <td><?=$row['phone'];?></td>  
                <td><?=$row['claimedstar'];?></td>    
                <td><?=$row['releaseclaimdate'];?></td>
                <td><?=$row['pancard'];?></td>
                
  <td id='staus'><input type='button' value='Released' id="del_<?=$row['gulllakid'] ?>" class='relpay' disabled/>
                          </td>
                             
            </tr>
    <?php endforeach;}?>  
             
    </tbody>
</table>


  </div>



  <div id="tabs-8">
    <table border="1 px solid black" class="data-table" id="payoutfive" style="width: 146%;">
    <thead>
        <tr>
            <th>S.No</th>
            <th>gulllakid</th>
            <th>Name</th>
            <th>phone</th>
            <th colspan="3">Bank Details</th>
            <th>Preference</th>
            <th>Paytm Number</th>
            <th>pancard</th>
            <th>Approve Time</th>
            <th>Action</th>

        </tr>
            <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Bank Name</td>
            <td>Account Number</td>
            <td>IFSC Code</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
           
        </tr>
 </thead>   
    <tbody>
 <?php
       $i=0;
        date_default_timezone_set('Asia/Calcutta');
        $the_time =date("Y-m-d H:i:s",time());
        $results =$data->execute("SELECT gullak_users.firstname,gullak_users.pancard,gullak_users.gulllakid,gullak_users.lastname,gullak_users.phone,gullak_users.email,gulllak_stockboxfive.membercount,gulllak_stockboxfive.time,gulllak_bankdetails.account_number,gulllak_bankdetails.ifsc_code,gulllak_bankdetails.bank_name,gulllak_bankdetails.paytm_number,gulllak_bankdetails.prefer_source
FROM gulllak_stockboxfive
LEFT JOIN gullak_users ON gulllak_stockboxfive.usergulllakid = gullak_users.gulllakid

LEFT JOIN gulllak_bankdetails ON gulllak_stockboxfive.usergulllakid = gulllak_bankdetails.usergulllakid

 WHERE gulllak_stockboxfive.status='open' ORDER BY gulllak_stockboxfive.position ASC  ");
/*        echo "<pre>";
print_r($results);die;*/
        if($results ){
 foreach($results as $row):
     $new_time=$row['time'];
     //echo "$new_time <br>";
     $hourdiff = round((strtotime($the_time) - strtotime($new_time))/3600, 1);
   if($hourdiff>=100){
  ?> 
 



            <tr>
              <td><?=++$i;?></td>
                <td><?=$row['gulllakid'];?></td>
                <td><?=$row['firstname']." ".$row['lastname'];?></td>
                <td><?=$row['phone'];?></td>
                <td><?=$row['bank_name'];?></td> 
                <td><?=$row['account_number'];?></td>  
                <td><?=$row['ifsc_code'];?></td>
                <td><?=$row['prefer_source'];?></td>   
                <td><?=$row['paytm_number'];?></td>
                <td><?=$row['pancard'];?></td>
                <td><?=$row['time'];?></td>
                
                
  <td id='staus'><input type='button' value='Release Payout' id="del_<?=$row['gulllakid'] ?>" class='relpay'/>
                          </td>
                             
            </tr>
            <?php  }?>
    <?php endforeach;}?>
             
    </tbody>
</table>


<!-- test dialog -->
 <div class="container">
<div id="dialogfive" title="Release Payout">
<form action=<?=$releasePayoutPath;?> method="post">
<input id="name" name="transactionid" placeholder="transaction id" type="text" required>
<input type="text" name="amount" value="7625" readonly/> <br> 
<input id="textfive" name="usergulllakid" type="text" value="" readonly>  
   <select name="source" placeholder="source" required>
    <option disabled selected value> -- select payment mode -- </option>
    <option>Paytm</option>
    <option>Bank Account</option>
    </select>
<input type='text' id="datepickerfive" name="transaction_date" placeholder="Transaction Date" required/> 
<input id="submit" type="submit" value="Submit">

</form>
</div>
</div>


  </div>



 <div id="tabs-9">
    <table border="1 px solid black" class="data-table" id="relpayoutfive">
    <thead>
        <tr>
            <th>S.No</th>
            <th>gulllakid</th>
            <th>Name</th>
            <th>phone</th>
            <th>Release Date</th>
            <th>pancard</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
 <?php
       $i=0;
        $results =$data->execute("SELECT gullak_users.firstname,gullak_users.pancard,gullak_users.gulllakid,gullak_users.lastname,gullak_users.phone,gullak_users.email,gulllak_stockboxfive.membercount,gulllak_stockboxfive.time
FROM gulllak_stockboxfive
INNER JOIN gullak_users ON gulllak_stockboxfive.usergulllakid = gullak_users.gulllakid WHERE gulllak_stockboxfive.membercount = 3 AND  gulllak_stockboxfive.status='closed'"); 
        if($results ){
 foreach($results as $row):?> 
 



            <tr>
              <td><?=++$i;?></td>
                <td><?=$row['gulllakid'];?></td>
                <td><?=$row['firstname']." ".$row['lastname'];?></td>
                <td><?=$row['phone'];?></td>  
                <td><?=$row['time'];?></td>
                <td><?=$row['pancard'];?></td>
                
  <td id='staus'><input type='button' value='Released' id="del_<?=$row['gulllakid'] ?>" class='relpay' disabled/>
                          </td>
                             
            </tr>
    <?php endforeach;}?>  
             
    </tbody>
</table>


  </div>

<!-- //test 10000 -->
  <div id="tabs-10">
    <table border="1 px solid black" class="data-table" id="payoutten" style="width: 146%;">
    <thead>
        <tr>
            <th>S.No</th>
            <th>gulllakid</th>
            <th>Name</th>
            <th>phone</th>
            <th colspan="3">Bank Details</th>
            <th>Preference</th>
            <th>Paytm Number</th>
            <th>pancard</th>
            <th>Approve Time</th>
            <th>Action</th>

        </tr>
            <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Bank Name</td>
            <td>Account Number</td>
            <td>IFSC Code</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
           
        </tr>
 </thead>   
    <tbody>
 <?php
       $i=0;
        date_default_timezone_set('Asia/Calcutta');
        $the_time =date("Y-m-d H:i:s",time());
        $results =$data->execute("SELECT gullak_users.firstname,gullak_users.pancard,gullak_users.gulllakid,gullak_users.lastname,gullak_users.phone,gullak_users.email,gulllak_stockboxten.membercount,gulllak_stockboxten.time,gulllak_bankdetails.account_number,gulllak_bankdetails.ifsc_code,gulllak_bankdetails.bank_name,gulllak_bankdetails.paytm_number,gulllak_bankdetails.prefer_source
FROM gulllak_stockboxten
LEFT JOIN gullak_users ON gulllak_stockboxten.usergulllakid = gullak_users.gulllakid

LEFT JOIN gulllak_bankdetails ON gulllak_stockboxten.usergulllakid = gulllak_bankdetails.usergulllakid

 WHERE gulllak_stockboxten.status='open' ORDER BY gulllak_stockboxten.position ASC  ");
/*        echo "<pre>";
print_r($results);die;*/
        if($results ){
 foreach($results as $row):
     $new_time=$row['time'];
     //echo "$new_time <br>";
     $hourdiff = round((strtotime($the_time) - strtotime($new_time))/3600, 1);
   if($hourdiff>=204){
  ?> 
 



            <tr>
              <td><?=++$i;?></td>
                <td><?=$row['gulllakid'];?></td>
                <td><?=$row['firstname']." ".$row['lastname'];?></td>
                <td><?=$row['phone'];?></td>
                <td><?=$row['bank_name'];?></td> 
                <td><?=$row['account_number'];?></td>  
                <td><?=$row['ifsc_code'];?></td>
                <td><?=$row['prefer_source'];?></td>   
                <td><?=$row['paytm_number'];?></td>
                <td><?=$row['pancard'];?></td>
                <td><?=$row['time'];?></td>
                
                
  <td id='staus'><input type='button' value='Release Payout' id="del_<?=$row['gulllakid'] ?>" class='relpay'/>
                          </td>
                             
            </tr>
            <?php  }?>
    <?php endforeach;}?>
             
    </tbody>
</table>


<!-- test dialog -->
 <div class="container">
<div id="dialogten" title="Release Payout">
<form action=<?=$releasePayoutPath;?> method="post">
<input id="name" name="transactionid" placeholder="transaction id" type="text" required>
<input type="text" name="amount" value="14250" readonly/> <br> 
<input id="textten" name="usergulllakid" type="text" value="" readonly>  
   <select name="source" placeholder="source" required>
    <option disabled selected value> -- select payment mode -- </option>
    <option>Paytm</option>
    <option>Bank Account</option>
    </select>
<input type='text' id="datepickerten" name="transaction_date" placeholder="Transaction Date" required/> 
<input id="submit" type="submit" value="Submit">

</form>
</div>
</div>


  </div>



 <div id="tabs-11">
    <table border="1 px solid black" class="data-table" id="relpayoutten">
    <thead>
        <tr>
            <th>S.No</th>
            <th>gulllakid</th>
            <th>Name</th>
            <th>phone</th>
            <th>Release Date</th>
            <th>pancard</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
 <?php
       $i=0;
        $results =$data->execute("SELECT gullak_users.firstname,gullak_users.pancard,gullak_users.gulllakid,gullak_users.lastname,gullak_users.phone,gullak_users.email,gulllak_stockboxten.membercount,gulllak_stockboxten.time
FROM gulllak_stockboxten
INNER JOIN gullak_users ON gulllak_stockboxten.usergulllakid = gullak_users.gulllakid WHERE gulllak_stockboxten.membercount = 3 AND  gulllak_stockboxten.status='closed'"); 
        if($results ){
 foreach($results as $row):?> 
 



            <tr>
              <td><?=++$i;?></td>
                <td><?=$row['gulllakid'];?></td>
                <td><?=$row['firstname']." ".$row['lastname'];?></td>
                <td><?=$row['phone'];?></td>  
                <td><?=$row['time'];?></td>
                <td><?=$row['pancard'];?></td>
                
  <td id='staus'><input type='button' value='Released' id="del_<?=$row['gulllakid'] ?>" class='relpay' disabled/>
                          </td>
                             
            </tr>
    <?php endforeach;}?>  
             
    </tbody>
</table>


  </div>
<!-- //test end 10000 -->


  <!--claim end -->
  </div>
 <a href="logout.php">Logout</a>

</body>
</html>