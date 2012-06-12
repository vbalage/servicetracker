<?php
session_start();
if(!session_is_registered(myusername)){
header("location:login.php");
}

// show all errors while still developing: 
ini_set('display_errors', 1); 
error_reporting(E_ALL); 
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>

<body>

<p>
<a href="listdb.php?what=all" style="text-decoration:none;" title="Show items on stock" target="contents">Device database</a><br>
<a href="listdb.php?what=customer" style="text-decoration:none;" title="Show customer info" target="contents">Customers</a><br>
<a href="listdb.php?what=sw" style="text-decoration:none;" title="Show camera software versions" target="contents">Software versions</a><br>
<a href="parttracker.php" style="text-decoration:none;" title="Show items on stock" target="contents">Inventory</a><br>
<a href='additem.php' style="text-decoration:none;" target="contents">Add item</a>
</p>


Logged in as <b>
<?php 
echo $_SESSION['name'];
?>
</b>
</br>
<span class="logout">
<a href="logout.php" class="logout">Logout</a>
</span>

</body>
</html>
