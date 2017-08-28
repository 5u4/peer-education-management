<?php
session_start();

//----------------------------------------
// for testing, make up a current user
$_SESSION['current_username'] = 'David';
$_SESSION['manager_id'] = '1';
//----------------------------------------

?>

<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/_check_login.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php';





?>
