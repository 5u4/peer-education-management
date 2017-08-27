<div>
<?php
include_once 'controllers/_check_login.php';
include_once 'controllers/manager.php';
include_once 'controllers/authentication.php';
if($_SESSION['registration_status'] == 'success') {
	echo 'Your registration is completed.';
}

?>
</div>

<div class='logout'>

<a href='/controllers/logout.php'>Logout</a>

</div>



</div>
