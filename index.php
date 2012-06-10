<!DOCTYPE html>

<?php
session_start();
if(!session_is_registered(myusername)){
header("location:login.php");
}?>

<html>
<head>

</head>
<body>

<div id="main">
<div id="header" style="text-align:center;">
<h1 style="margin-bottom:5px; color:#62C2C2; font-size:1.4em;">Service Tracker</h1></div>

<div id="menu" style="width:150px;float:left;">
<?php
include('menu.php')
?></div>

<div id="content" style="background-color:#E5E5E5; margin-left:155px; height:100%">
<iframe src="welcome.php" frameborder="0" name="contents" style="width:100%; height:100%;"></iframe></div

</div>

</body>

</html>
