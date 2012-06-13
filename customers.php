<?php if (isset($_POST['customer'])) {
	$selection = $_POST['customer'];
} else {
	$selection = 0;
	}

$query = "SELECT customer_short FROM customer ORDER BY customer_short";
$result = mysql_query($query) or die("Query failed ($query) - " . mysql_error()); 
?>


<FORM NAME ="chooseCustomer" METHOD ="POST" ACTION = "">
Customer: <select name="customer" id="customer" onchange="chooseCustomer.submit();">
		<?php
		echo "<option value=0>All</option>";
		$i = 1;
		while($row = mysql_fetch_assoc($result)) {
			$string = "<option value=$i";
			if($selection == $i) {$string = $string . " SELECTED";}
			$string = $string . ">" . $row['customer_short'] . "</option>";
			echo $string;
			$i++;
		} 
		?>
</select></FORM>


<?php
echo "<table>";
		if ($selection == 0) {
		$query = "SELECT * FROM customer"; }
		else {
		$query = "SELECT * FROM customer WHERE id=$selection";}

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
						echo ("<td id=\"stock\"><b>$data</b></td>");
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
		echo "</table>"; 
	
?>

		
