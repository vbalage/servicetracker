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
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>


<?php
$onstock = $_POST['onstock'];
$manufacturer = $_POST['manufacturer'];
$product = $_POST['product'];
$serialnum = $_POST['serialnum'];
$description = $_POST['description'];
$parentsys = $_POST['parentsys'];

$stat = mysql_query("INSERT INTO stock (onstock, manufacturer, product, serialnum, description, parentsys ) VALUES ($onstock, '$manufacturer', '$product', '$serialnum', '$description', '$parentsys') ");
echo $onstock;
?>

<p>Data inserted!<p>


</body>
</html>

