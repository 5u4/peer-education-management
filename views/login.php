<?php 
include_once '../configs/config.php'; 
include_once '../controllers/authentication.php';
include_once '../controllers/manager.php';
$con = connection();
?>

<html>
<head>
<title>Login</title>
</head>
<body id="body-color">
<div id="Sign-Up">
<fieldset style="width:30%"><legend>Login</legend>
<table border="0">
<tr>
<form method="POST" action="<?php $_SERVER['PHP_SELF']?>">
<td>Username</td><td> <input type="text" name="username"></td>
</tr>
<tr>
<td>Password</td><td> <input type="password" name="password"></td>
</tr>
<tr>
<td><input id="button" type="submit" name="submit" value="Login"></td>
</tr>
</form>
</table>
</fieldset>
</div>

<div>
Don't have account? <a href='sign_up.php'> Create account. </a>
</div>

</body>
</html>

<?php

if(isset($_POST['submit'])) {
	$myusername = mysqli_real_escape_string($con,$_POST['username']);
        $mypassword = mysqli_real_escape_string($con,$_POST['password']); 
	$authentication = new Authentication();
	$result_code = $authentication->login($myusername, $mypassword, $con);

	if($result_code == 0) {
		header('Location: /index.php');
	} else {
		echo 'Login failed.';
	}
}

?>
