<?php
// show all errors while still developing: 
ini_set('display_errors', 1); 
error_reporting(E_ALL); 
?>

<!--<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>-->

<body>

<a href="listdb.php?what=devices" title="Show items on stock">Device database</a><br>
<a href="listdb.php?what=customers" title="Show customer info">Customers</a><br>
<a href="listdb.php?what=sw" title="Show camera software versions">Software versions</a><br>
<a href="stock.php" title="Show items on stock">Inventory</a><br>
<a href='add.php?mode=add'>Add item</a>
</br>
<span class="logout">
	<a href="logout.php" class="logout">Logout</a>
</span>
<!--
</body>
</html>-->
