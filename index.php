<!DOCTYPE html>
<?php
// show all errors while still developing: 
ini_set('display_errors', 1); 
error_reporting(E_ALL); 

include 'session_check.php'; ?>

<html>
<head>
	<title>Service tracker</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" type="text/css" href="styles.css" />
</head>

<body>
<div id="container">
	<div id="header">
		<?php include 'header.php'; ?>
	</div>
	
	<div id="wrapper">
		<div id="content">
			<!--<iframe src="welcome.php" frameborder="0" name="contents" style="width:100%; height:100%;"></iframe>-->
		<?php include 'welcome.php'; ?>
		</div>
	</div>
		
	<div id="menu">
		<?php include 'menu.php'; ?>
	</div>
	
	<div id="extra">
	</div>
	
	<div id="footer">
		<?php include 'footer.php' ?>
	</div>
		
	</div>
</div>

</body>

</html>
