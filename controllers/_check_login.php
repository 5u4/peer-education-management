<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/manager.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/authentication.php';
session_start();

if(!isset($_SESSION['manager_id'])) {
	header('Location: /views/login.php');
} else {
	$mid = (int)$_SESSION['manager_id'];
	$_SESSION['current_user'] = get_manager($mid);
	echo 'Welcome ' . $_SESSION['current_user']->get_first_name() . ' ' . $_SESSION['current_user']->get_last_name();
	echo '<br>';
}

?>

<div class='logout'>

<a href='/controllers/logout.php'>Logout</a>

</div>
