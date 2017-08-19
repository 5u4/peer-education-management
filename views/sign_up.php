<!DOCTYPE HTML>

<?php 

// include database information and connection
include_once '../configs/config.php'; 
include_once '../controllers/authentication.php';
$con = connection();

?>

<html>
<head>
<title>Sign-Up</title>
</head>
<body id="body-color">
<div id="Sign-Up">
<fieldset style="width:30%"><legend>Registration Form</legend>
<table border="0">
<tr>
<form method="POST" action="<?php $_SERVER['PHP_SELF']?>">
<td>First Name</td><td> <input type="text" name="first_name"></td>
</tr>
<tr>
<td>Last Name</td><td> <input type="text" name="last_name"></td>
</tr>
<tr>
<td>Username</td><td> <input type="text" name="username"></td>
</tr>
<tr>
<td>Password</td><td> <input type="password" name="password"></td>
</tr>
<tr>
<td>Confirm Password </td><td><input type="password" name="cpassword"></td>
</tr>
<tr>
<td><input id="button" type="submit" name="submit" value="Sign-Up"></td>
</tr>
</form>
</table>
</fieldset>
</div>
</body>
</html>

<?php

if(isset($_POST['submit'])) {
	
	$authentication = new Authentication();
	$authentication -> SignUp($con);

}


?>


