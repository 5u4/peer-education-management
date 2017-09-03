<?php 
if (!isset($_SESSION)) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php'; 
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/authentication.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/manager.php';

if(isset($_SESSION['manager_id'])) {
	header('Location: /views/dashboard.php');

}

$con = connection();
?>

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
    <title>Login - PE Management Tool</title>
</head>
<body>
<div class="container-fluid">
<!-- LOGIN FORM -->
<div class="text-center" style="padding:50px 0">
    <div class="logo">Login</div>
    <!-- Main Form -->
    <div class="login-form-1">
        <form method="POST" class="text-left" action="<?php $_SERVER['PHP_SELF']?>">
            <div class="login-form-main-message"></div>
            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group">
                        <label for="lg_username" class="sr-only">Username</label>
                        <input type="text" id="lg_username" class="form-control" name="username" placeholder="username" required>
                    </div>
                    <div class="form-group">
                        <label for="lg_password" class="sr-only">Password</label>
                        <input type="password" id="lg_password" class="form-control" name="password" placeholder="password" required>
                    </div>
<!--                    <div class="form-group login-group-checkbox">-->
<!--                        <input type="checkbox" id="lg_remember" name="lg_remember">-->
<!--                        <label for="lg_remember">remember</label>-->
<!--                    </div>-->
                </div>
                <button type="submit" name="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
            </div>
            <div class="etc-login-form">
<!--                <p>forgot your password? <a href="#">click here</a></p>-->
                <p>New user? <a href="sign_up.php">Create new account</a></p>
            </div>
        </form>
    </div>
    <!-- end:Main Form -->
</div>

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
		echo "<meta http-equiv='refresh' content='0'>";
	} else {
//		echo 'Login failed.';
	}
}

?>
