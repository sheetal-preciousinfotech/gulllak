<?php
    include($_SERVER['DOCUMENT_ROOT'].'/efs/resources/classes/database.php');
    $data = new Databases; 	
	$p = $_GET['id'];
	$mainjs = "http://".$_SERVER['SERVER_NAME'].'/efs/assets/js/adminmain.js';

	?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    
    <script type="text/javascript" src=<?php echo "$mainjs"; ?>></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script type="text/javascript">
  		$(document).ready(function() {
    $('#example').DataTable();
} );
  </script>
  <?php
	switch($p) {
		case "1":
		//echo '<h2>Google</h2>Content goes here !<br style="clear:both;" />';
		?>
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
<?php
		break;
					  
		case "2":
		echo 'Yahoo content ?<br style="clear:both;" />';
		break;

		case "3": 
		echo 'My hotmail content goes here...<br style="clear:both;" />';
		break;

		case "4": default:
		echo 'Twitter status update :)<br style="clear:both;" />';
		break;
	}
?>x