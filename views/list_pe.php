<?php
include_once '../controllers/peducator.php';
include_once '../configs/config.php';


//* Constructing a PE table

$all_pe = list_all_pe(); // fetch all courses and return as object array

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

// read each PE
foreach ($all_pe as $key=>$pe) {
    echo '<tr>'; // table row
    echo '<td>'.$pe->get_peducator_id().'</td>';
    echo '<td>'.$pe->get_student_id().'</td>';
    echo '<td>'.$pe->get_preferred_name().'</td>';
    echo '<td>'.$pe->get_first_name().'</td>';
    echo '<td>'.$pe->get_last_name().'</td>';
    echo '<td>'.$pe->get_is_current().'</td>';
    echo '</tr>'; // end table row
}
echo '</table>'; // end table structure


?>
