<?php
session_start();

//----------------------------------------
// for testing, make up a current user
$_SESSION['manager_id'] = '1';
//----------------------------------------

?>

<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/page.php';
$nav = new Page($_SESSION['current_user']);


?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $nav->nav_head();?>