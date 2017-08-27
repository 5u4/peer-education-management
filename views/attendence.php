<?php
session_start();

//----------------------------------------
// for testing, make up a current user
$_SESSION['current_username'] = 'David';
$_SESSION['manager_id'] = '1';
//----------------------------------------

if(!isset($_SESSION['current_username'])) {
	header('Location: ../views/login.php');
} else {

	echo 'Welcome ' . $_SESSION['current_username'];
	echo '<br>';
	echo 'Your id is ' . $_SESSION['manager_id'];
}

?>


