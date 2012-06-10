<html>
<head>
<link rel="stylesheet" type="text/css" href="style3.css" />
</head>

<table width="300" border="0" bgcolor="##0C8CD2" align="center" cellpadding="0" cellspacing="1">
<tr>
<form name="form1" method="post" action="checklogin.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td align="center" bgcolor="#2CACF2" colspan="3"><strong>Login</strong></td>
</tr>
<tr>
<td width="78">Username</td>
<td width="6">:</td>
<td width="294"><input name="myusername" type="text" id="myusername"></td>
</tr>
<tr>
<td>Password</td>
<td>:</td>
<td><input name="mypassword" type="password" id="mypassword"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Login"></td>
</tr>
</table>
</td>
</form>
</tr>
<tr><td bgcolor="#2CACF2" align="center">
Current time:
<?php
echo date("Y.m.d H:i:s");
?>
</td></tr>
</table>
</html>
