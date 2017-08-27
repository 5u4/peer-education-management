<?php
include_once '../controllers/manager.php';
include_once '../controllers/authentication.php';
session_start();

if(!isset($_SESSION['manager_id'])) {
	header('Location:' . $_SERVER['DOCUMENT_ROOT']. '/views/login.php');
} else {
	$mid = (int)$_SESSION['manager_id'];
	$_SESSION['current_user'] = get_manager($mid);
	echo 'Welcome ' . $_SESSION['current_user']->get_manager_id();
	echo '<br>';
}

?>
