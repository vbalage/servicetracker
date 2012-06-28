<?php 
include 'session_check.php';
include 'config.php'; 

mysql_connect("localhost","$username","$password") or 
        die("DB connection failed - " . mysql_error()); 
mysql_select_db("$db_name") or die ("DB select failed - " . mysql_error());

if (isset($_POST['bUpdate'])) {
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
} else {
	
}

$mode = $_GET['mode'];
$stock_val = 1;


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


if($mode == "edit") {
	echo "<h2>Edit item</h2>";
} else {
	echo "<h2>Add item</h2>"; } 

?>

<FORM NAME ="Additem" METHOD ="POST" ACTION = "add.php">
	<table id="input_fields">
	<tr><td style="font-size:100%;">On stock: </td>
	<td><INPUT TYPE = "TEXT" VALUE = "<?php print $def_val[6]; ?>" SIZE = 1 NAME = "onstock"></td></tr>
	<tr><td>Manufacturer: </td>
	<td><INPUT TYPE = "TEXT" SIZE = 30 VALUE = "<?php print $def_val[1]; ?>" NAME = "manufacturer"></td></tr>
	<tr><td>Product: </td>
	<td><INPUT TYPE = "TEXT" SIZE = 30 VALUE = "<?php print $def_val[2]; ?>" NAME = "product"></td></tr>
	<tr><td>S/N : </td>
	<td><INPUT TYPE = "TEXT" SIZE = 30 VALUE = "<?php print $def_val[3]; ?>" NAME = "serialnum"></td></tr>
	<tr><td>Description : </td>
	<td><textarea NAME = "description" rows="10" cols="43"><?php print $def_val[4]; ?></textarea></td></tr>
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
	<?php if($mode == "edit") {
	print "<INPUT TYPE = \"HIDDEN\" Name = \"id\" VALUE = \"";
	print $idtoedit;
	print "\">";
	} ?>
</FORM>

