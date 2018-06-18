<?php
$cssPath="http://".$_SERVER['SERVER_NAME'].'/efs/assets/css/admin.css';
$jsPath = "http://".$_SERVER['SERVER_NAME'].'/efs/assets/js/adminjquery.js';
$mainjs = "http://".$_SERVER['SERVER_NAME'].'/efs/assets/js/adminmain.js';

?>
<html>
	<head>
		<title>jQuery: AJAX Tabs</title>	
       <link rel="stylesheet" href=<?php echo "$cssPath"; ?> > 
		<script type="text/javascript" src=<?php echo "$jsPath"; ?>></script>
		<script type="text/javascript" src=<?php echo "$mainjs"; ?>></script>

	</head>
	<body>
		
		<div class="container">
		
			<div class="navcontainer">
				<ul>
					<li><a id="tab1" href="tabs.php?id=1">Users</a></li>
					<li><a id="tab2" href="tabs.php?id=2">Transactions</a></li>
					<li><a id="tab3" href="tabs.php?id=3">Payout</a></li>
					<li><a id="tab4" href="tabs.php?id=4">Released</a></li>
				</ul>
			</div>

			<div id="preloader">
				<img src="https://gulllak.com/efs/assets/img/loadimg.gif" align="absmiddle"> Loading...				
			</div>
			
			<div id="tabcontent">
			Simple AJAX Tabs
			</div>
					
		</div>
	</body>
</html>