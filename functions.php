<?php

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

?>
