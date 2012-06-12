<?php 
//$query = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'stock' AND COLUMN_NAME = 'parentsys';";
//$result = mysql_query($query);

include 'config.php'; 
mysql_connect("localhost","$username","$password") or 
        die("DB connection failed - " . mysql_error()); 
mysql_select_db("$db_name") or die ("DB select failed - " . mysql_error());


$stock_val = 1;

$mode = $_GET['mode'];

if($mode == "edit") {
	$idtoedit = $_GET['id'];	
	
	$query = "SELECT * FROM stock WHERE id=$idtoedit"; 
	$result = mysql_query($query) or die("Query failed ($query) - " . mysql_error());
	
	$numoffields = mysql_num_fields($result);
	$row = mysql_fetch_assoc($result);
	
	for( $i = 1; $i < $numoffields; $i++) {
		$fname[$i] = mysql_field_name($result,$i);		
		$def_val[$i] = $row[$fname[$i]];
	}	

} else {
	for($i = 1; $i<10; $i++) {
		$def_val[$i] = "";
	}
} 
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="styles.css" />
	</head>

	<body>
		<?php 
		// Page title
		if($mode == "edit") {
		echo "<h2>Edit item</h2>";
		} else {
		echo "<h2>Add item</h2>"; } 
		?>

		<FORM NAME ="Additem" METHOD ="POST" ACTION = "additem_action.php">
			<table><tr><td>	On stock: </td>
			<td><INPUT TYPE = "TEXT" VALUE = "<?php print $def_val[6]; ?>" SIZE = 1 NAME = "onstock"></td></tr>
			<tr><td>Manufacturer: </td>
			<td><INPUT TYPE = "TEXT" SIZE = 30 VALUE = "<?php print $def_val[1]; ?>" NAME = "manufacturer"></td></tr>
			<tr><td>Product: </td>
			<td><INPUT TYPE = "TEXT" SIZE = 30 VALUE = "<?php print $def_val[2]; ?>" NAME = "product"></td></tr>
			<tr><td>S/N : </td>
			<td><INPUT TYPE = "TEXT" SIZE = 30 VALUE = "<?php print $def_val[3]; ?>" NAME = "serialnum"></td></tr>
			<tr><td>Description : </td>
			<td><textarea NAME = "description" rows="10" cols="30"><?php print $def_val[4]; ?></textarea></td></tr>
			<tr><td>Parent system: </td>
			<td><select name="parentsys">
				<?php for($i = 1; $i<=5; $i++) {	
				$string = "<option value=$i";
				if ($parentSystems[$i] == $def_val[5] ) { $string = $string . " SELECTED"; }
				$string = $string . ">" . $parentSystems[$i] . "</option>";
				echo $string;
				} ?>		
			</select></td></tr>
			</table>
			<INPUT TYPE = "SUBMIT" Name = "bUpdate" VALUE = "Submit">
			<INPUT TYPE = "HIDDEN" Name = "mode" VALUE = "<?php print $mode ?>">
			<INPUT TYPE = "HIDDEN" Name = "id" VALUE = "<?php print $idtoedit ?>">
		</FORM>
	</body>
</html>
