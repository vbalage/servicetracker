

<?php session_start();
if(!session_is_registered(myusername)){
header("location:login.php"); }

// show all errors while still developing: 
ini_set('display_errors', 1); 
error_reporting(E_ALL); 

include 'config.php';
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
?>

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
			<?php 
			include 'parttracker.php';
			?>
		</div>
	</div>
		
	<div id="menu">
		<?php
		include('menu.php');
		?>
	</div>
	
	<div id="extra">
		<?php include 'filter.php'; ?>
	</div>
	
	<div id="footer">
		<?php include 'footer.php' ?>
	</div>
		
	</div>
</div>

</body>

</html>




