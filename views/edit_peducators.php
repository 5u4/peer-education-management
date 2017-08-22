<?php
include_once '../configs/config.php';

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
	
	$con = connection();

	$peducator_id = $_POST['peducator_id'];
	$student_id = $_POST['student_id'];
	$preferred_name = $_POST['preferred_name'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];

	if(empty($_POST['peducator_id'])) {
		echo 'You must provide a peer educator ID.';
		return false;
	}

	$check_sql = "SELECT * FROM peducators 
	WHERE peducator_id = '$peducator_id' OR student_id = '$student_id'";
	$check_result = mysqli_query($con, $check_sql);
	
	if(mysqli_num_rows($check_result) != 0) {
		echo 'This peer educator already exists.';
		return false;
	} else {
		if(!empty($_POST['peducator_id']) && !empty($_POST['student_id']) && !empty($_POST['preferred_name']) && !empty($_POST['first_name']) && !empty($_POST['last_name'])) {
			
			$sql = "INSERT INTO peducators 
			(peducator_id,student_id,preferred_name,first_name,last_name) 
			VALUES ('$peducator_id','$student_id',
			'$preferred_name','$first_name', 
			'$last_name')";

			$result = mysqli_query($con, $sql);

			if($result) {
				echo 'New peer educator has been created.';
				return true;
			} else {
				echo 'Failed.';
				return false;
			}
		} else {
			echo 'Please fill out all the boxes.';
			return false;
		}
	}

}


// ---------------------
// [Update]
// ---------------------

if(isset($_POST['Update'])) {
	

}


// ---------------------
// [Delete]
// ---------------------

if(isset($_POST['Delete'])) {
	

}



?>
