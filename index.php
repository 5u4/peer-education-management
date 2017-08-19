<?php

session_start();

if(!isset($_SESSION['current_user'])) {
	header('Location: ../views/login.php');
} else {

	echo 'Welcome ' . $_SESSION['current_user'];
}

?>

<div>
<?php

if($_SESSION['registration_status'] == 'success') {
	echo 'Your registration is completed.';
}

?>
</div>

<div class='logout'>

<a href='/controllers/logout.php'>Logout</a>

</div>



</div>
