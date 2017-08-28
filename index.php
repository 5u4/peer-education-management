<div>
<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/_check_login.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/manager.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/authentication.php';
if($_SESSION['registration_status'] == 'success') {
	echo 'Your registration is completed.';
}

?>


</div>
