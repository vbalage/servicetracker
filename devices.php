<?php 
include 'session_check.php';
include 'functions.php';

if (isset($_POST['camera'])) {
	$selection = $_POST['camera'];
} elseif (isset($_GET['selection'])) {
	$selection = $_GET['selection'];
} else {
	$selection = 1;
}

$query = "SELECT device.id, serialnum, customer_short FROM device, customer WHERE device.customer_id = customer.id";
$result = mysql_query($query) or die("Query failed ($query) - " . mysql_error());
?>

<FORM NAME ="chooseCamera" METHOD ="POST" ACTION = "">
<p>Select camera: <select name="camera" id="camera" onchange="chooseCamera.submit();">
		<?php
		$i = 0;
		while($row = mysql_fetch_assoc($result)) {
			$string = "<option value=" . $row['id'];
			if($selection == $row['id']) {$string = $string . " SELECTED"; $selected_id = $row['id'];}
			$string = $string . ">" . $row['customer_short'] . " - " . $row['serialnum'] . "</option>
";
			echo $string;
			$i++;
		} 
		?>
</select></FORM> </p>


<div style="background-color: #90CCCC; margin-right:20px;">
	<p><b>Database info</b>
	<?php
	$result = mysql_query("SELECT * FROM device, customer WHERE device.id= $selected_id AND device.customer_id = customer.id") or die("Query failed ($query) - " . mysql_error() );
	$result = mysql_fetch_assoc($result);
	$customer_id = $result['customer_id'];
	echo "Selected camera ID: " . $selected_id . " | ";
	echo "Selected version table ID: " . $selected_id . "_ver". " | ";
	echo "Selected customer table ID: " . $customer_id . "</br></p>"; ?>
</div>
<div id="tile">
	<h3 class="centered">Camera</h3>
	<?php
	echo "<p>";
	echo "Type: " . $result['type'] . "</br>";
	echo "Camera S/N: " . $result['serialnum'] . "</br>";
	echo "Workstation S/N: " . $result['ws_serialnum'] . "</br>";
	echo "</p>";
	addEditIcon($selected_id, "camera");?>
</div>

<div id="tile">
	<h3 class="centered">Customer</h3>
	<?php
	echo "<p>";
	echo $result['customer_long'] . "</br>";
	echo $result['addr1'] . "</br>";
	echo $result['city'] . ", " . $result['state'] . ", " . $result['zip'] . "</br></br>";
	echo $result['contact_person'] . " (" . $result['phone'] . ")";
	echo "</p>";
	?>
</div>
<div id="tile">
	<h3 class="centered">Software versions</h3>
	<?php
	$ver_table = $selected_id . "_ver";
	if( mysql_num_rows( mysql_query("SHOW TABLES LIKE '".$ver_table."'"))) {

		// Read records
		$result2 = mysql_query("SELECT * FROM $ver_table;") or die(mysql_error());	   
		// Put them in array
		for($i = 0; $array[$i] = mysql_fetch_assoc($result2); $i++) ;
		// Delete last empty one
		array_pop($array);

		if(getCameraType($selected_id) == "NanoPET/CT") {$sw_iter = 4;} 
		else {$sw_iter = 3;} 

		echo "<table id=\"tile\">";
		for ($i = 0; $i < $sw_iter; $i++) {
			echo "<tr>";	
			echo "<td>" . $array[$i]['system'] . "</td><td>" . $array[$i]['version'] . "</td>";
		}
		echo "</table>";
	} 
	else { echo "<p>No software version information is available";}
	addEditIcon($selected_id, "swver");?>
</div>
<div id="tile">
	<h3 class="centered">Firmware versions</h3>
	<?php
	if( mysql_num_rows( mysql_query("SHOW TABLES LIKE '".$ver_table."'"))) {

		echo "<table id=\"tile\">";
		for ($i = $sw_iter; $i < sizeof($array); $i++) {
			echo "<tr>";
			echo "<td>" . $array[$i]['system'] . "</td><td>" . $array[$i]['version'] . "</td>";
			echo "</tr>";		
		}
		echo "</table>";
	}	
	else { echo "<p>No firmware version information is available";}
	addEditIcon($selected_id, "fwver");	
	?>
</div>


<?php
////////// FUNCTIONS /////////////////////////////////////////////////
function addEditIcon($selected_id, $editstring) {
	echo "<div style=\"text-align:right; margin-right:20px;\">";
	//echo "	</br>";		
	$link = "<a href=\"edit_page.php?id=$selected_id&toedit=$editstring\"><img src=\"img/editico.gif\"></a>"; 
	echo $link;
	echo "</div>";
}
?>
