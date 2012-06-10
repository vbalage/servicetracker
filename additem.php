<?php session_start();
if(!session_is_registered(myusername)){
header("location:login.php"); } 

$query = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'stock' AND COLUMN_NAME = 'parentsys';";
$result = mysql_query($query);
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>

<body>
<h3>Add item</h3>

<FORM NAME ="Additem" METHOD ="POST" ACTION = "additem.php">
	<table><tr><td>	On stock: </td>
	<td><INPUT TYPE = "TEXT" VALUE ="0" SIZE = 1 NAME = "onstock"></td></tr>
	<tr><td>Manufacturer: </td>
	<td><INPUT TYPE = "TEXT" SIZE = 30 NAME = "manufacturer"></td></tr>
	<tr><td>Product: </td>
	<td><INPUT TYPE = "TEXT" SIZE = 30 NAME = "product"></td></tr>
	<tr><td>S/N : </td>
	<td><INPUT TYPE = "TEXT" SIZE = 30 NAME = "serialnum"></td></tr>
	<tr><td>Description : </td>
	<td><textarea rows="10" cols="30"></textarea></td></tr>
	<tr><td>Parent system: </td>
	<td><select name="parentsys">
		<option value=1>NanoSPECT/CT</option>
		<option value=2>NanoSPECT/CT Plus</option>
		<option value=3 selected="selected">NanoPET/CT</option>
		<option value=4">Workstation PC</option>
		<option value=5">Acquisition PC</option>
	</select></td></tr>
	</table>
	<INPUT TYPE = "Submit" Name = "bUpdate" VALUE = "Update">
	
</FORM>

</body>
</html>
