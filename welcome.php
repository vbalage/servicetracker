<?php
session_start();
if(!session_is_registered(myusername)){
header("location:login.php");
}?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<?php
echo "Welcome to the Service Tracker, ";
echo $_SESSION['name'];
echo "!";
?>
</body>
</html>

