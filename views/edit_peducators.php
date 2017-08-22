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
	
	$con = connection();
	
	$peducator_id = $_POST['peducator_id'];
	$student_id = $_POST['student_id'];
	$preferred_name = $_POST['preferred_name'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	
	if(empty($_POST['peducator_id']) && empty($_POST['student_id'])) {
		echo 'You must provide either a peer educator ID or a student ID to do update.';
		return false;
	}

	$check_sql = "SELECT * FROM peducators 
	WHERE peducator_id = '$peducator_id' OR student_id = '$student_id'";
	$check_result = mysqli_query($con, $check_sql);
	
	if(mysqli_num_rows($check_result) == 0) {
		echo 'This peer educator does not exist.';
		return false;
	}

	// ------------------------------------
	// Check if PE ID matches Student ID
	// ------------------------------------
	if(!empty($_POST['peducator_id']) && !empty($_POST['student_id'])) {	
		$row = mysqli_fetch_array($check_result);
		if($row['peducator_id'] != $peducator_id || $row['student_id'] != $student_id) {
			echo 'The PE ID does not match Student ID.';
			return false;
		}
	}

	// Get PE ID for instant object
	$row = mysqli_fetch_array($check_result);
	$peducator_id = $row['peducator_id'];

	// ------------------------------------
	// Start to update PE information
	// ------------------------------------
	$pe = new Peducator($peducator_id);

	if(!empty($_POST['preferred_name'])) {
		$result_code = $pe->set_preferred_name($_POST['preferred_name']);
		if($result_code == false) {
			echo 'Update preferred name failed.';
			return false;
		}
	}

	if(!empty($_POST['first_name'])) {
		$result_code = $pe->set_first_name($_POST['first_name']);
		if($result_code == false) {
			echo 'Update first name failed.';
			return false;
		}
	}

	if(!empty($_POST['last_name'])) {
		$result_code = $pe->set_last_name($_POST['last_name']);
		if($result_code == false) {
			echo 'Update last name failed.';
			return false;
		}
	}
	
	echo 'Update success.';
	return true;

}


// ---------------------
// [Delete]
// ---------------------

if(isset($_POST['Delete'])) {
	
	$con = connection();

	$peducator_id = $_POST['peducator_id'];
	$student_id = $_POST['student_id'];

	if(empty($_POST['peducator_id']) && empty($_POST['student_id'])) {
		echo 'You must provide either a peer educator ID or a student ID to do delete.';
		return false;
	}

	$check_sql = "SELECT * FROM peducators 
	WHERE peducator_id = '$peducator_id' OR student_id = '$student_id'";
	$check_result = mysqli_query($con, $check_sql);
	
	if(mysqli_num_rows($check_result) == 0) {
		echo 'This peer educator does not exist.';
		return false;
	}

	// ------------------------------------
	// Check if PE ID matches Student ID
	// ------------------------------------
	if(!empty($_POST['peducator_id']) && !empty($_POST['student_id'])) {	
		$row = mysqli_fetch_array($check_result);
		if($row['peducator_id'] != $peducator_id || $row['student_id'] != $student_id) {
			echo 'The PE ID does not match Student ID.';
			return false;
		}
	}

	// ------------------------------------
	// Start to delete PE 
	// ------------------------------------

	$sql = "DELETE FROM peducators WHERE peducator_id='$peducator_id' OR student_id='$student_id'";

	$result = mysqli_query($con, $sql);

	if($result) {
		echo 'The PE has been deleted.';
		return true;
	} else {
		echo 'Delete failed.';
		return false;
	}
	
}



?>
