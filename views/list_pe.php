<html>
<head>
<title>PE List</title>
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
<td>Is current? (y/n)</td><td> <input type="text" size="1" name="is_current"></td>
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
include_once '../configs/config.php';
include_once '../controllers/peducator.php';

// ---------------------
// [Add]
// ---------------------

if(isset($_POST['Add'])) {

	if($_POST['is_current'] == 'y' || $_POST['is_current'] == 'Y') {
		$is_cur = 1;

	} elseif($_POST['is_current'] == 'n' || $_POST['is_current'] == 'N') {
		$is_cur = 0;

	} elseif($_POST['is_current'] == 0 || $_POST['is_current'] == 1) {
		
		$is_cur = $_POST['is_current'];
	}

	echo $is_cur;
	Peducator_add_pe($_POST['peducator_id'], $_POST['student_id'], $_POST['preferred_name'], 
	$_POST['first_name'], $_POST['last_name'], $is_cur);
}


// ---------------------
// [Update]
// ---------------------

if(isset($_POST['Update'])) {

	if($_POST['is_current'] == 'y' || $_POST['is_current'] == 'Y') {
		$is_cur = 1;
	} elseif($_POST['is_current'] == 'n' || $_POST['is_current'] == 'N') {
		$is_cur = 0;
	} elseif($_POST['is_current'] == 0 || $_POST['is_current'] == 1) {
		
		$is_cur = $_POST['is_current'];

	} elseif(empty($_POST['is_current'])) {
		// ------------------------------------------
		// If user does not specify is_current, then we set it to 2,
		// so that the function will take this argument do nothing.
		// ------------------------------------------
		$is_cur = 2;
	}

	Peducator_update_pe($_POST['peducator_id'], $_POST['student_id'], $_POST['preferred_name'], 
	$_POST['first_name'], $_POST['last_name'], $is_cur);
}


// ---------------------
// [Delete]
// ---------------------

if(isset($_POST['Delete'])) {
	
	Peducator_delete_pe($_POST['peducator_id'], $_POST['student_id']);
	
}


//* Constructing a PE table

$all_current_pe = list_all_current_pe(); 
$all_not_current_pe = list_all_not_current_pe();

// table structure
echo '
	<table border="1">
	<tr>
		<th>PE ID</th>
		<th>Student ID</th>
		<th>Preferred Name</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Is current PE?</th>
	</tr>
    ';

// Write all current PE
foreach ($all_current_pe as $key=>$pe) {
	echo '<tr>'; // table row
	echo '<td>'.$pe->get_peducator_id().'</td>';
	echo '<td>'.$pe->get_student_id().'</td>';
	echo '<td>'.$pe->get_preferred_name().'</td>';
	echo '<td>'.$pe->get_first_name().'</td>';
	echo '<td>'.$pe->get_last_name().'</td>';
	echo '<td>';

	if($pe->get_is_current() == 1) {
		echo 'YES';
	} else {
		echo 'NO';
	}

	echo '</td>';
	echo '</tr>'; // end table row
}


// Write all not current PE
foreach ($all_not_current_pe as $key=>$pe) {
	echo '<tr>'; // table row
	echo '<td>'.$pe->get_peducator_id().'</td>';
	echo '<td>'.$pe->get_student_id().'</td>';
	echo '<td>'.$pe->get_preferred_name().'</td>';
	echo '<td>'.$pe->get_first_name().'</td>';
	echo '<td>'.$pe->get_last_name().'</td>';
	echo '<td>';

	if($pe->get_is_current() == 1) {
		echo 'YES';
	} else {
		echo 'NO';
	}

	echo '</td>';
	echo '</tr>'; // end table row
}

echo '</table>'; // end table structure


?>

