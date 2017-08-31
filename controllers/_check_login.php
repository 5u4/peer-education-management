<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/manager.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/authentication.php';
if (!isset($_SESSION))
	session_start();

if(!isset($_SESSION['manager_id'])) {
	header('Location: ../index.php');
} else {
	$mid = (int)$_SESSION['manager_id'];

	// ----------------------------------
	// ----------------------------------	
	// Manager object is here
	$_SESSION['current_user'] = get_manager($mid);
	// ----------------------------------
	// ----------------------------------


}

?>

