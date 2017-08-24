<?php
include_once '../configs/config.php';
include_once '../controllers/peducator.php';

?>

<html>
<head>
<title>Add/Delete/Update Peer Educators</title>
</head>

<body id="body-color">
<div id="Sign-Up">
<fieldset style="width:30%"><legend>Add/Delete/Update Peer Educators</legend>
<table border="0">
<tr>
<form method="POST" action="<?php $_SERVER['PHP_SELF']?>">
<td>Peer Educator ID</td><td> <input type="text" size="5" name="peducator_id"></td>
</tr>
<tr>
<td>Student ID</td><td> <input type="text" size="5" name="student_id"></td>
</tr>
<tr>
<td>Preferred Name</td><td> <input type="text" name="preferred_name"></td>
</tr>
<tr>
<td>First Name</td><td> <input type="text" name="first_name"></td>
</tr>
<tr>
<td>Last Name</td><td> <input type="text" name="last_name"></td>
</tr>
<tr>
<td><input id="button" type="submit" name="Add" value="Add"></td>
<td><input id="button" type="submit" name="Update" value="Update"></td>
<td><input id="button" type="submit" name="Delete" value="Delete"></td>
</tr>
</form>
</table>
</fieldset>
</div>

</body>
</html>


<?php

// ---------------------
// [Add]
// ---------------------

if(isset($_POST['Add'])) {

	Peducator_add_pe($_POST['peducator_id'], $_POST['student_id'], $_POST['preferred_name'], 
	$_POST['first_name'], $_POST['last_name']);
}


// ---------------------
// [Update]
// ---------------------

if(isset($_POST['Update'])) {

	Peducator_update_pe($_POST['peducator_id'], $_POST['student_id'], $_POST['preferred_name'], 
	$_POST['first_name'], $_POST['last_name']);
}


// ---------------------
// [Delete]
// ---------------------

if(isset($_POST['Delete'])) {
	
	Peducator_delete_pe($_POST['peducator_id'], $_POST['student_id'], $_POST['preferred_name'], 
	$_POST['first_name'], $_POST['last_name']);
	
}



?>
