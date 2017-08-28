<?php
session_start();

//----------------------------------------
// for testing, make up a current user
$_SESSION['manager_id'] = '1';
//----------------------------------------

?>

<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/_check_login.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/peducator.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sections').DataTable( {
                "order": [[ 3, "desc" ]]
            } );
        } );
    </script>
</head>
<body>

<?php
//* Constructing a section table in course page

$current_section = $_SESSION['current_user'] -> get_section_id(); // will be change to a table # (or something else) in the future
$current_week = 1;

echo '<h1>Your section ID is '.$current_section.'.</h1>';

$pe = list_all_pe_on($current_section); // fetch all courses and return as object array

// table structure
echo '
    <table id="sections">
    <thead>
        <tr>
            <th>PE Name</th>
            <th>Attendence</th>
            <th>set to</th>
            <th>on week</th>
        </tr>
    </thead>
    <tbody>
    ';

// read each courses
foreach ($pe as $key=>$pe_obj) {
    echo '<tr>'; // table row
    echo '<td>'.$pe_obj->get_first_name().' '.$pe_obj->get_last_name().' ('. 
	$pe_obj->get_preferred_name().')'.'</td>';
    echo '<td>'.$pe_obj->get_contributed_mins($current_section, $current_week).'</td>';
    echo '
    <form method="post" action="">
        <td><input type="number" name="number"></td>
        <input type="hidden" name="key_num" value="'.$key.'">
        <td><input type="submit" value="Change" name="submit"></td>
    </form>
    ';
    echo '</tr>'; // end table row
}
echo '</tbody></table>'; // end table structure

// if Change button is clicked call function
if (isset($_POST['number']) && isset($_POST['key_num'])) {
    $num = $_POST['number']; // the number user entered
    $key_num = $_POST['key_num']; // the row number

    // update the number
    $courses[$key_num]->set_times_been_taught_by($num, 1,1);

    // update the total number
    $courses[$key_num]->refresh_total_times_been_taught();

    // refresh the website
    echo "<meta http-equiv='refresh' content='0'>";
}

// insert a course
echo '
    Add a new course into the list: 
    <form method="post" action="">
        <td><input type="text" name="course_name"></td>
        <td><input type="submit" value="Add" name="submit"></td>
    </form>';

if (isset($_POST['course_name'])) {
    $course_name = $_POST['course_name'];

    // insert the course
    insert_course($course_name);

    // refresh the website
    echo "<meta http-equiv='refresh' content='0'>";
}


?>







</body>
</html>
