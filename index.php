<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/manager.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/authentication.php';


if(isset($_SESSION['manager_id'])) {
	header('Location: /views/dashboard.php');

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="../assets/css/landing.css" rel="stylesheet">
</head>
<body>

<!--made by vipul mirajkar thevipulm.appspot.com-->
<h1>
    <a href="" class="typewrite" data-period="1000" data-type='[
    "Hi! This is Peer Education Management Tool...",
    "An Application for Managers...",
    "Made by David Chou & Alex Wong."
    ]'>
        <span class="wrap"></span>
    </a>
</h1>
<br/>
<br/>
<br/>
<br/>
<br/>
<h4><a href="views/login.php">LOGIN</a> | <a href="views/sign_up.php">SIGN UP</a></h4>

<script src="../assets/js/landing.js"></script>

</body>
</html>
