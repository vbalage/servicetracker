<?php 
// show all errors while still developing: 
ini_set('display_errors', 1); 
error_reporting(E_ALL); 

include 'session_check.php';
include 'config.php';

mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles.css" />
		<meta HTTP-EQUIV="REFRESH" content="2; url=add.php?mode=add">
	</head>
	<body>
		<?php
		$mode = $_POST['mode'];
		$onstock = $_POST['onstock'];
		$manufacturer = $_POST['manufacturer'];
		$product = $_POST['product'];
		$serialnum = $_POST['serialnum'];
		$description = $_POST['description'];
		$parentsys = $_POST['parentsys'];
		$idtoedit = $_POST['id'];

		if($mode == "edit") {
			$stat = mysql_query("UPDATE stock SET onstock = $onstock, manufacturer = '$manufacturer', product = '$product', serialnum = '$serialnum', description = '$description', parentsys = '$parentsys' WHERE id=$idtoedit ");	
		} else {
			$stat = mysql_query("INSERT INTO stock (onstock, manufacturer, product, serialnum, description, parentsys ) VALUES ($onstock, '$manufacturer', '$product', '$serialnum', '$description', '$parentsys') ");
		}
		
		if($mode == "edit")  {
			echo "Record modified";
		} else {
			echo "Record added";
			
		}
		?>

	</body>
</html>

