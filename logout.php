<?php 
// show all errors while still developing: 
ini_set('display_errors', 1); 
error_reporting(E_ALL); 

// forward to login page if session expired
include 'session_check.php';

include 'config.php';

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
unset($_SESSION['name']);
?>

Successfully logged out
</body>
</html>
