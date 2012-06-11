<?php session_start();
if(!session_is_registered(myusername)){
header("location:login.php"); } 

// show all errors while still developing: 
ini_set('display_errors', 1); 
error_reporting(E_ALL); 

if (isset($_POST['bUpdate'])) {
	$id = $_POST['idSelect'];
} else {
	$id = 0; }
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css" />
<style type="text/css">
table
{
	border-collapse:collapse;
	width:100%;
	font-size:125%;
}
table,th,td
{
	border:1px solid gray;
}
td
{
	padding:3px;
	text-align:left;
}
</style>
</head>

<body>

<h2>Inventory</h2>

<?php 
// show all errors while still developing: 
ini_set('display_errors', 1); 
error_reporting(E_ALL); 
// use require instead of include since rest of script depends on this: 
include 'config.php'; 
mysql_connect("localhost","$username","$password") or 
        die("DB connection failed - " . mysql_error()); 
mysql_select_db("$db_name") or die ("DB select failed - " . mysql_error()); 

include 'filter.php'; ?>


<?php echo "<table>";
if ($id == 0) {
$query = "SELECT * FROM stock ORDER BY parentsys"; }
else {
$query = "SELECT * FROM stock WHERE id=$id"; }

$result = mysql_query($query) or die("Query failed ($query) - " . mysql_error()); 
if(mysql_num_rows($result)) 
{ 	
	echo ("<tr>");
	$numoffields = mysql_num_fields($result);
	
	for( $i = 1; $i < $numoffields; $i++) {
		$fname[$i] = mysql_field_name($result,$i);		
		echo ("<td><b>$fname[$i]</b></td>");
	}
	echo ("</tr>");
   while($row = mysql_fetch_assoc($result)) 
   { 
		echo "<tr>";
		for($i=1; $i <= $numoffields+1; $i++) {
			if($i < $numoffields) {
				$data = $row[$fname[$i]];
				echo ("<td>$data</td>");		
			} elseif($i == ($numoffields) )  {
				$rowid = $row['id'];
				$dellink = "<a href=\"del_stockitem.php?id=$rowid\"><img src=\"img/delico2.gif\"></a>";
  				echo ("<td>$dellink</td>");
			}	elseif($i == ($numoffields+1)) {
				$rowid = $row['id'];
				$editlink = "<a href=\"additem.php?id=$rowid&mode=edit\"><img src=\"img/editico.gif\"></a>";
				echo ("<td>$editlink</td>");
			}
		}
		echo "<tr>";
   } 
}
else 
{ 
   echo "<p>No matches were found in the database for your query.</p>\n"; 
}
echo "</table>"; ?>

<br />

<FORM NAME ="IDfilter" METHOD ="POST" ACTION = "parttracker.php">
	<INPUT TYPE = "TEXT" VALUE ="0" SIZE = 1 NAME = "idSelect">
	<INPUT TYPE = "Submit" Name = "bUpdate" VALUE = "Update">
</FORM>

</body>
</html>
