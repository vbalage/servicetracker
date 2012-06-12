<h4>Filter</h4>
<form action="parttracker.php" method="GET">

</form>
<?php
include 'functions.php';
// get enum values in an array
$query = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'stock' AND COLUMN_NAME = 'parentsys';";
$parentsysVal = getEnumNames($query); // extract possible enum values from the array
?>

<select name="parentsys">
		<?php for($i = 0; $i<count($parentsysVal); $i++) {	
		$string = "<option value=$i";
		if ($i == 0 ) { $string = $string . " SELECTED"; }
		$string = $string . ">" . $parentsysVal[$i] . "</option>";
		echo $string;
		} ?>		
</select>

