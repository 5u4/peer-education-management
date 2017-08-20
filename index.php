<?php

session_start();

if(!isset($_SESSION['current_username'])) {
	header('Location: ../views/login.php');
} else {

	echo 'Welcome ' . $_SESSION['current_username'];
	echo '<br>';
	echo 'Your id is ' . $_SESSION['manager_id'];
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
