<?php if (isset($_POST['camera'])) {
	$selection = $_POST['camera'];
} else {
	$selection = 0;
}

$query = "SELECT serialnum, customer_short FROM device, customer WHERE device.customer_id = customer.id";
$result = mysql_query($query) or die("Query failed ($query) - " . mysql_error());

?>


<FORM NAME ="chooseCamera" METHOD ="POST" ACTION = "">
Camera: <select name="camera" id="camera" onchange="chooseCamera.submit();">
		<?php
		$i = 0;
		while($row = mysql_fetch_assoc($result)) {
			$string = "<option value=$i";
			if($selection == $i) {$string = $string . " SELECTED";}
			$string = $string . ">" . $row['serialnum'] . " - " . $row['customer_short'] . "</option>";
			echo $string;
			$i++;
		} 
		?>
</select></FORM>
