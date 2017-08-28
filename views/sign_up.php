<!DOCTYPE HTML>

<?php 

// include database information and connection
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php'; 
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/authentication.php';
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
	
	// check the forms
	if(!empty($_POST['username']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['password']) && !empty($_POST['cpassword'])) {

		// check if confirm password is correct
		if($_POST['password'] != $_POST['cpassword']) {
			echo 'Please confirm your password.';
			return 1;

		} 
	}
	else // if the form was not filled properly
	{
		echo "Please fill out the form properly.";
		return 1;
	}


	// get values from form
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$username = $_POST['username'];
	$password =  $_POST['password'];


	$authentication = new Authentication();
	$result_code = $authentication -> signup($first_name, $last_name, $username, $password);
	if($result_code == 0) {
		session_start();
		$_SESSION['registration_status'] = 'success';
		header('Location: ../index.php');
	} else {
		echo 'Sign up failed.';
	}


}


?>


