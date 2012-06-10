<?php session_start();
if(!session_is_registered(myusername)){
header("location:login.php"); } ?>

<html>
<head>
<?PHP
if (isset($_POST['bUpdate'])) {
	$id = $_POST['idSelect'];
} else {
$id = 0; }
?>
<link rel="stylesheet" type="text/css" href="styles.css" />
<style type="text/css">
table
{
border-collapse:collapse;
width:100%;
}
table,th,td
{
border:1px solid black;
}
td
{
padding:3px;
text-align:center;
}
</style>
</head>


<body>
<h3>Inventory</h3>
<?php 
// show all errors while still developing: 
ini_set('display_errors', 1); 
error_reporting(E_ALL); 

// use require instead of include since rest of script depends on this: 
include 'config.php'; 

mysql_connect("localhost","$username","$password") or 
        die("DB connection failed - " . mysql_error()); 
mysql_select_db("servicetracker") or die ("DB select failed - " . mysql_error()); 
     
?><table><?php

if ($id == 0) {
$query = "SELECT * FROM stock"; }
else {
$query = "SELECT * FROM stock WHERE id=$id"; }

$result = mysql_query($query) or die("Query failed ($query) - " . mysql_error()); 
if(mysql_num_rows($result)) 
{ 
   	while($row = mysql_fetch_assoc($result)) 
   	{ 
		$data = $row["onstock"] ; 
        	echo ("<tr><td>$data</td>");
        	$data = $row["serialnum"] ; 
        	echo ("<td>$data</td>"); 
		$data = $row["product"] ; 
        	echo ("<td>$data</td>");
		$data = $row["manufacturer"] ; 
        	echo ("<td>$data</td>"); 
 		$data = $row["desc"] ; 
        	echo ("<td>$data</td>");
		$data = $row["parentsys"] ; 
        	echo ("<td>$data</td>");
   	} 
}
else 
{ 
   echo "<p>No matches were found in the database for your query.</p>\n"; 
} 
?></table>

<br />

<FORM NAME ="IDfilter" METHOD ="POST" ACTION = "parttracker.php">
	<INPUT TYPE = "TEXT" VALUE ="0" SIZE = 1 NAME = "idSelect">
	<INPUT TYPE = "Submit" Name = "bUpdate" VALUE = "Update">
</FORM>

</body>
</html>
