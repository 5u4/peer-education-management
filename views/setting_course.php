<?php
if (!isset($_SESSION)) {
    session_start();
}

// include
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/page.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/_check_login.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/manager.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/course.php';

$current_user = get_manager($_SESSION['manager_id']);
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
                $('#course').DataTable( {
                    "order": [[ 3, "desc" ]]
                } );
            } );
        </script>
        <!--  DataTable  -->

    </head>
    <body>

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