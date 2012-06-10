<?php
include 'config.php';
$tbl_name="users"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword']; 

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
session_register("myusername");
session_register("mypassword"); 

$_SESSION['name'] = $myusername;

mysql_query("INSERT INTO log (direction, who, success) VALUES (1, '$myusername', 1)");

header("location:index.php");
}
else {
echo "Wrong Username or Password";
mysql_query("INSERT INTO log (direction, who, success) VALUES (1, '$myusername', 0)");
}
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css" />
<meta HTTP-EQUIV="REFRESH" content="1; url=login.php">
</head>
</html>
