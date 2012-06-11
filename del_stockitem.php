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
$idtodel = $_GET['id'];
mysql_query("DELETE FROM stock WHERE id=$idtodel");

echo $_GET['id'];
?>

</body>
</html>
