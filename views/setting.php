<?php
session_start();

//----------------------------------------
// for testing, make up a current user
$_SESSION['manager_id'] = '1';
//----------------------------------------

?>

<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/page.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/section.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/course.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/peducator.php';
$page = new Page(get_manager(1));


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
<?php $page->nav_head(); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#sections').DataTable( {} );
        $('#courses').DataTable( {} );
        $('#peducators').DataTable( {} );
    } );
</script>
</head>
<body>
<?php $page->nav_body_start(); ?>

<?php
// Section Setting
$sections = list_all_sections();

echo '
    <h1 id="section">Sections</h1>
    <table id="sections"><thead>
        <tr>
            <th>Semester</th>
            <th>Time</th>
            <th></th>
        </tr>
    </thead><tbody>';
foreach ($sections as $key_section=>$section) {
    echo '
        <tr>
            <form method="post" action="">
            <input type="hidden" name="section_key" value="'.$key_section.'">
            <td>'.$section->get_section_seme().'</td>
            <td>
                <input type="text" name="section_name" value="'.$section->get_section_name().'" required>
                <input type="submit" name="section_change" value="Change">
            </td>
            <td><input type="submit" value="Delete" name="section_delete"></td>
            </form>
        </tr>
    ';
}
echo '</tbody></table>';

if (isset($_POST['section_change']) && isset($_POST['section_name'])) {
    $section_key = $_POST['section_key'];
    $section_name = $_POST['section_name'];
    $sections[$section_key]->set_section_name_to($section_name);

    // refresh the website
    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['section_delete'])) {
    $section_key = $_POST['section_key'];
    $sections[$section_key]->delete_section();

    // refresh the website
    echo "<meta http-equiv='refresh' content='0'>";
}

// insert a section
echo '
    Add a new section into the list: 
    <form method="post" action="">
        <td>Section Semester: <input type="text" name="section_seme"></td>
        <td>Section Name: <input type="text" name="section_name"></td>
        <td><input type="submit" value="Add" name="section_insert"></td>
    </form>';

if (isset($_POST['section_insert'])) {
    $section_seme = $_POST['section_seme'];
    $section_name = $_POST['section_name'];

    // insert the course
    insert_section($section_seme, $section_name);

    // refresh the website
    echo "<meta http-equiv='refresh' content='0'>";
}
?>

<?php
// Course setting
$courses = list_all_courses();

echo '
    <h1 id="course">Courses</h1>
        <table id="courses"><thead>
        <tr>
            <th>Course Name</th>
            <th>Total Counts</th>
            <th>Delete</th>
        </tr>
    </thead><tbody>
    ';

foreach ($courses as $key_course=>$course) {
    echo '
        <tr>
            <form method="post" action="">
            <input type="hidden" name="course_key" value="'.$key_course.'">
            <td>
                <input type="text" name="course_name" value="'.$course->get_course_name().'" required>
                <input type="submit" name="course_change" value="Change">
            </td>
            <td>'.$course->get_total_times_been_taught().'</td>
            <td><input type="submit" value="Delete" name="course_delete"></td>
            </form>
        </tr>
        ';
}

echo '</tbody></table>';

if (isset($_POST['course_change']) && isset($_POST['course_name'])) {
    $course_key = $_POST['course_key'];
    $course_name = $_POST['course_name'];
    $courses[$course_key]->set_course_name_to($course_name);

    // refresh the website
    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['course_delete'])) {
    $course_key = $_POST['course_key'];
    $courses[$course_key]->delete_course();

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


<?php
// peducator
$peducators = list_all_pe();

// Constructing Table
echo '
    <h1 id="peducator">Peer Educators</h1>
    <table id="peducators">
    <thead>
        <tr>
            <th>Name</th>
            <th>Student ID</th>
            <th>More</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    ';

// Read Each PE
foreach ($peducators as $key_pe=>$peducator) {
    echo '<tr>'; // Table Row

    // Name
    echo '<td>'.$peducator->get_first_name().' '.
        $peducator->get_last_name().' ('.
        $peducator->get_preferred_name().')'.'</td>';

    // Student ID
    echo '<td>'.$peducator->get_student_id().'</td>';

    // More
    echo '<td><a href="pe_detail.php?id='.$peducator->get_peducator_id().'">'.
        'more'.'</td>';

    // Delete
    echo '<td><input type="submit" value="Delete" name="peducator_delete"></td>';


    // Row ID & End Table
    echo '<input type="hidden" name="key_num" value="'.$key_pe.'">';
    echo '</form>';
    echo '</tr>'; // end table row
}

// Table End
echo '</tbody></table>';

// Delete PE
if (isset($_POST['peducator_delete'])) {
    $key_num = $_POST['key_num'];
    $peducators[$key_num]->delete_peducator();
}

// Add New PE
echo '<a target="_blank" href="new_pe.php">Add A New PE</a>';
?>



<?php $page->nav_body_close_with_table(); ?>
</body>
