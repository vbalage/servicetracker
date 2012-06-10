<?php 
// show all errors while still developing: 
ini_set('display_errors', 1); 
error_reporting(E_ALL); 

include 'config.php';
session_start();
?>


<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css" />
<meta HTTP-EQUIV="REFRESH" content="2; url=login.php">
</head>
<body>

<?php
$con = mysql_connect($host,$username,$password);
mysql_select_db("parttracker", $con);
$tmp = $_SESSION['name'];
mysql_query("INSERT INTO log (direction, who, success) VALUES (2, '$tmp', 1)");
mysql_close($con);
session_destroy();
?>

Successfully logged out
</body>
</html>
