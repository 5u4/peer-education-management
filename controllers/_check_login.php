<?php
include_once '../controllers/manager.php';
session_start();

if(!isset($_SESSION['current_username'])) {
	header('Location: ../views/login.php');
} else {

	echo 'Welcome ' . $_SESSION['current_username']->get_username();
	echo '<br>';
}

?>
