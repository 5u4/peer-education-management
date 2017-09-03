<?php
if (!isset($_SESSION)) {
    session_start();
}

// include database information and connection
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php'; 
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/authentication.php';

if(isset($_SESSION['manager_id'])) {
	header('Location: /views/dashboard.php');

}

$con = connection();

?>


<!DOCTYPE HTML>
<html>
<head>
    <!-- All the files that are required -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href='/assets/css/login.css' rel='stylesheet' type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/login.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Sign Up - PE Management Tool</title>
</head>
<body>
<!--<td>First Name</td><td> <input type="text" ></td>-->
<!--<td>Last Name</td><td> <input type="text" ></td>-->
<!--<td>Username</td><td> <input type="text" ></td>-->
<!--<td>Password</td><td> <input type="password" ></td>-->
<!--<td>Confirm Password </td><td><input type="password" ></td>-->
<!--<td><input id="button" type="submit"  value="Sign-Up"></td>-->

<!-- REGISTRATION FORM -->
<div class="text-center" style="padding:50px 0">
    <div class="logo">Register</div>
    <!-- Main Form -->
    <div class="login-form-1">
        <form id="register-form" class="text-left" method="POST" action="">
            <div class="login-form-main-message"></div>
            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group">
                        <label for="reg_firstname" class="sr-only">First Name</label>
                        <input type="text" class="form-control" id="reg_firstname" name="first_name" placeholder="first name" required>
                    </div>

                    <div class="form-group">
                        <label for="reg_lastname" class="sr-only">Last Name</label>
                        <input type="text" class="form-control" id="reg_lastname" name="last_name" placeholder="last name" required>
                    </div>

                    <div class="form-group">
                        <label for="reg_username" class="sr-only">Username</label>
                        <input type="text" class="form-control" id="reg_username" name="username" placeholder="username" required>
                    </div>
                    <div class="form-group">
                        <label for="reg_password" class="sr-only">Password</label>
                        <input type="password" class="form-control" id="reg_password" name="password" placeholder="password" required>
                    </div>
                    <div class="form-group">
                        <label for="reg_password_confirm" class="sr-only">Password Confirm</label>
                        <input type="password" class="form-control" id="reg_password_confirm" name="cpassword" placeholder="confirm password" required>
                    </div>

<!--                    <div class="form-group">-->
<!--                        <label for="reg_email" class="sr-only">Email</label>-->
<!--                        <input type="text" class="form-control" id="reg_email" name="reg_email" placeholder="email">-->
<!--                    </div>-->


<!--                    <div class="form-group login-group-checkbox">-->
<!--                        <input type="radio" class="" name="reg_gender" id="male" placeholder="username">-->
<!--                        <label for="male">male</label>-->
<!---->
<!--                        <input type="radio" class="" name="reg_gender" id="female" placeholder="username">-->
<!--                        <label for="female">female</label>-->
<!--                    </div>-->

<!--                    <div class="form-group login-group-checkbox">-->
<!--                        <input type="checkbox" class="" id="reg_agree" name="reg_agree">-->
<!--                        <label for="reg_agree">i agree with <a href="#">terms</a></label>-->
<!--                    </div>-->
                </div>
                <button type="submit" class="login-button" name="submit"><i class="fa fa-chevron-right"></i></button>
            </div>
            <div class="etc-login-form">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </form>
    </div>
    <!-- end:Main Form -->
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
		echo "<meta http-equiv='refresh' content='0'>";

	} else {
		echo 'Sign up failed.';
	}


}


?>


