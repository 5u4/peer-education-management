<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/page.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/course.php';
$current_user = get_manager(1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <!--  Navigation  -->
    <?php
    $page = new Page($current_user);
    $page->nav_head();
    ?>
    <!--  Navigation  -->

    <!--  DataTable  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#courses').DataTable( {
                "order": [[ 3, "desc" ]]
            } );
        } );
    </script>
    <!--  DataTable  -->

</head>
<body>

<?php
$page->nav_body_start();

//* Constructing a course table in course page
$current_week = 1; // will be change to a table # (or something else) in the future
$current_seme_id = 1; // semester id (will also be change into the table)

echo '<h1>This is week '.$current_week.' in semester id '.$current_seme_id.'</h1>';

$courses = list_all_courses(); // fetch all courses and return as object array

// table structure
echo '
    <table id="courses">
    <thead>
        <tr>
            <th>Course Name</th>
            <th># of times</th>
            <th>set to</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    ';

// read each courses
foreach ($courses as $key=>$course) {
    echo '<tr>'; // table row
    echo '<td>'.$course->get_course_name().'</td>';
    echo '<td>'.$course->get_times_been_taught_on_with_section($current_week, $current_seme_id).'</td>';
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

$page->nav_body_close_with_table();
?>







</body>
</html>