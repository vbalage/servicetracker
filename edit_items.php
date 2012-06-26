<!--<!DOCTYPE html>-->
<?php
// show all errors while still developing: 
//ini_set('display_errors', 1); 
//error_reporting(E_ALL); 

if (isset($_POST['submitChanges'])) {
	include 'config.php';
	mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
	mysql_select_db("$db_name")or die("cannot select DB");
	$i = 0;
	if ($_POST['whatToEdit'] != "camera") {	
		
		foreach($_POST as $key=>$value) {
		if ($i >= (sizeof($_POST)-4) ) { break; } // -4 mert van 2 hidden es egy submit element az adatot tartalmazokon kivul
		$query = "UPDATE " . $_POST['table_id'] .
		" SET version=\"" . $value . "\" WHERE id=" . $key;
		echo $query . "\n";	
		mysql_query($query) or die("something went wrong: " . mysql_error());
		$i++;
		}
	} else {
		$query = "UPDATE " . $_POST['table_id'] . " SET ";
		$setText = "";		
		foreach($_POST as $key=>$value) {
			if ($i >= (sizeof($_POST)-4) ) { break; } // -4 mert van 2 hidden es egy submit element az adatot tartalmazokon kivul
			//echo $key . " | ";
			$setText .= $key . "=" . $value;
			$i++;
			if ($i < (sizeof($_POST)-4) ) { $setText .= ", "; }
		}
		$query .= $setText . " WHERE id=" . $_POST['idToEdit'];
		echo $query;
		//mysql_query($query) or die("something went wrong: " . mysql_error());
	}
	echo "</br>Changes saved";
}

include 'session_check.php'; 
include 'functions.php';
include 'config.php';

mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

$whatToEdit = $_GET['toedit'];
$idToEdit = $_GET['id'];

switch($whatToEdit) {
	case "camera": 
		$table_id = "device";
		$record_id = $idToEdit;
		$query = "SELECT type, serialnum, ws_serialnum from $table_id WHERE id = $record_id";	
		break;
	case "swver":
	case "fwver":
		$table_id = $idToEdit . "_ver";
		$record_id = $idToEdit;

		if(!mysql_num_rows( mysql_query("SHOW TABLES LIKE '".$table_id."'"))) {
			echo "No version table available, creating new one</br>"; 
			createVerTable($table_id); //creates new ver table for the camera if does not exists
			createVerTableFields(getCameraType($record_id), $table_id); //fills up the created version table with the appropriate values according to the camera type
			echo "Table created with $table_id name"; 
		}
		
		switch($whatToEdit) {
			case "swver":
			 	$query = "SELECT id, system, version FROM $table_id WHERE type=\"sw\"";				
				break;				
			case "fwver":
				$query = "SELECT id, system,version FROM $table_id WHERE type=\"fw\"";
				break;		
		}
		break;
	default:
		echo "Error: no valid info sent with \$toedit parameter";
}

$result = mysql_query($query);
//echo mysql_num_rows($result) . "</br>";
//echo mysql_num_fields($result);

$link = "http://localhost/servicetracker/listdb.php?what=devices&selection=". $idToEdit;
?>




<FORM NAME="editEntry" METHOD="POST" ACTION="">	

<?php 
switch($whatToEdit) {
	case "camera": 
		$row = (mysql_fetch_assoc($result));
		for ($i = 0; $i < mysql_num_fields($result); $i++) {
			$fname[$i] = mysql_field_name($result,$i);
			$nicename = mysql_query("SELECT nicename FROM nicenames WHERE uglyname = '$fname[$i]'") or die("Query failed ($query) - " . mysql_error());
			$nicename = mysql_fetch_assoc($nicename);
			$fname_nice[$i] = $nicename['nicename'];
			$value[$i] = $row[$fname[$i]];
			$meta = mysql_fetch_field($result, $i);
			$maxlengths[$i] = $meta->max_length;
		} 

		
	
		for ($i = 0; $i < mysql_num_fields($result); $i++) {
			echo $fname_nice[$i] . ": ";
			echo "<INPUT TYPE=\"TEXT\" VALUE=" . $value[$i] . " SIZE=";
			echo $maxlengths[$i] . " NAME = \"" . $fname[$i] . "\"></br>";
		} 
		
				
		break;
	case "fwver":	
	case "swver":
		$i=0;
		while($row = mysql_fetch_assoc($result)) {
			echo $row['system'] . ": ";			
			echo "<INPUT TYPE=\"TEXT\" VALUE =\"" . $row['version'] . "\" ";
			echo "NAME = \"" . $row['id'] . "\"></br>
";
			$i++;
		}
		break;
	
	default:
		echo "Error: no valid info sent with \$toedit parameter";
}
?>
<INPUT TYPE = "HIDDEN" NAME = "table_id" VALUE = "<?php print $table_id?>">
<INPUT TYPE = "HIDDEN" NAME = "whatToEdit" VALUE = "<?php print $whatToEdit?>">
<INPUT TYPE = "HIDDEN" NAME = "idToEdit" VALUE = "<?php print $idToEdit?>">
<INPUT TYPE = "SUBMIT" NAME = "submitChanges" VALUE = "Submit">
</FORM>

<a href="<?php print $link ?>">Back</a>














<?php
////////////////////////////////////////////////////////////////////////////
///////////// FUNCTIONS ////////////////////////////////////////////////////
function createVerTableFields($deviceSelector, $table_id) {
	if ($deviceSelector == "NanoPET/CT") {
		mysql_query("INSERT INTO $table_id (system, type) VALUES 
				(\"Nucline\", \"sw\"),
				(\"IAPS\", \"sw\"),
				(\"Linux kernel\", \"sw\"),
				(\"VQ/IVS\", \"sw\"),
				(\"GR\", \"fw\"),
				(\"TR\", \"fw\"),
				(\"TH\", \"fw\"),
				(\"Zoom\", \"fw\"),
				(\"X-ray I/F\", \"fw\"),
				(\"Encoder\", \"fw\"),
				(\"DCS\", \"fw\")
				") or die(mysql_error());		
	} elseif ($deviceSelector == "NanoSPECT/CT" || $deviceSelector == "NanoSPECT/CT Plus") {
		mysql_query("INSERT INTO $table_id (system, type) VALUES 
				(\"Nucline\", \"sw\"),
				(\"HiSPECT\", \"sw\"),
				(\"VQ/IVS\", \"sw\"),
				(\"GR\", \"fw\"),
				(\"TR\", \"fw\"),
				(\"TH\", \"fw\"),
				(\"X-ray I/F\", \"fw\")
				") or die(mysql_error());
	} elseif ($deviceSelector == "NSP") {
	} else {
		echo "Unknown device";	
	}
}

function createVerTable($table_id) {
	mysql_query("CREATE TABLE $table_id (
		id int(11) NOT NULL AUTO_INCREMENT,
		system varchar(20) NOT NULL,
		version varchar(30) NOT NULL,
		type enum('sw','fw') NOT NULL,
		PRIMARY KEY (id)
		)") or die(mysql_error());
}
?>
