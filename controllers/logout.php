<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/authentication.php';

$authentication = new Authentication();
$authentication->logout();

?>
