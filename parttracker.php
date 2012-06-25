<?php 
// show all errors while still developing: 
ini_set('display_errors', 1); 
error_reporting(E_ALL); 

include 'session_check.php';

if (isset($_POST['bUpdate'])) {
	$id = $_POST['idSelect'];
} else {
	$id = 0; }
?>

<h2>Inventory</h2>

<?php require 'config.php'; 
mysql_connect("localhost","$username","$password") or 
	die("DB connection failed - " . mysql_error()); 
mysql_select_db("$db_name") or die ("DB select failed - " . mysql_error()); 

echo "<table>";

if ($id == 0) {	$query = "SELECT id, onstock, manufacturer, serialnum, description, parentsys FROM stock ORDER BY parentsys"; }
else { $query = "SELECT * FROM stock WHERE id=$id"; }
$result = mysql_query($query) or die("Query failed ($query) - " . mysql_error()); 
	
if(mysql_num_rows($result)) 
{ 	
	echo ("<tr>");
	$numoffields = mysql_num_fields($result);

	for( $i = 1; $i < $numoffields; $i++) {
	
		$fname[$i] = mysql_field_name($result,$i);
		$query2 = "SELECT nicename FROM nicenames WHERE uglyname = '$fname[$i]'";
		$nicename = mysql_query($query2) or die("Query failed ($query) - " . mysql_error());	
		$nicename = mysql_fetch_assoc($nicename);
		$nicename = $nicename['nicename'];
		echo ("<th>$nicename</th>");
		
		//$fname[$i] = mysql_field_name($result,$i);		
		//echo ("<th>$fname[$i]</th>");
	}
	echo ("</tr>");
	
   	while($row = mysql_fetch_assoc($result)) 
   	{ 
		echo "<tr>";
		for($i=1; $i <= $numoffields+1; $i++) {
			if($i < $numoffields) {
				$data = $row[$fname[$i]];
				if($fname[$i] == "onstock") {
				echo ("<td class=\"stock\"><b>$data</b></td>");
				} else {						
				echo ("<td>$data</td>");
				}		
			} elseif($i == ($numoffields) )  {
				$rowid = $row['id'];
				$dellink = "<a href=\"del_stockitem.php?id=$rowid\"><img src=\"img/delico2.gif\"></a>";
  				echo ("<td>$dellink</td>");
			}	elseif($i == ($numoffields+1)) {
				$rowid = $row['id'];
				$editlink = "<a href=\"add.php?id=$rowid&mode=edit\"><img src=\"img/editico.gif\"></a>";
				echo ("<td>$editlink</td>");
			}
		}
		echo "</tr>";
 	} 
}
else 
{ 
   echo "<p>No matches were found in the database for your query.</p>\n"; 
}
echo "</table>"; ?>

<br />
