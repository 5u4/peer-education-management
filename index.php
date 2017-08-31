<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/_check_login.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/manager.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/authentication.php';
if($_SESSION['registration_status'] == 'success') {

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
    <a href="" class="typewrite" data-period="2000" data-type='[
    "Hi! This is Alex...",
    "This is Peer Education Management Tool...",
    "An Application for Managers"
    ]'>
        <span class="wrap"></span>
    </a>
</h1>

<script src="../assets/js/landing.js"></script>

</body>
</html>