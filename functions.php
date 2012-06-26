<?php
include 'session_check.php';

function getEnumNames($query) {

	$result = mysql_query($query);
	$enumarray = mysql_fetch_assoc($result);
	$enumarray = explode("'",$enumarray["COLUMN_TYPE"]);
	$arrsize = count($enumarray);
	for ($i = 1, $j=0 ; $i < $arrsize; $i += 2) {
		$enumvalues[$j] = $enumarray[$i];
		$j++;
	}
	return $enumvalues;
}

function getCameraType($deviceID) {
	$devtype = mysql_query("SELECT type FROM device WHERE id=$deviceID");
	$devtype = (mysql_fetch_array($devtype));
	return $devtype[0];
}

 



?>
