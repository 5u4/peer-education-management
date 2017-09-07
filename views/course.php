<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/page.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/course.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/date.php';
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
            $('#courses').DataTable( {} );
        } );
    </script>
    <!--  DataTable  -->

</head>
<body>
<div class="container-fluid">
    <div class="page-header text-center">
        <h1>Course</h1>
    </div>
<?php
$page->nav_body_start();

if (!isset($_GET['week'])) {

    $week = 1;
    echo '<div class="panel panel-default"><form method="get" action="?week='.$week.'">';
    echo '<div class="panel-heading"><h3 class="panel-title">Please select a week</h3></div><div class="panel-body"><div class="col-md-10"><select class="form-control" name="week">';
    for ($week = 1; $week < 14; $week++) {
        echo '<option value="'.$week.'">'.$week.'</option>';
    }
    echo '
        </select></div>
        <input class="btn btn-default col-md-2" type="submit" value="Go!">
        </form></div></div>
        ';

    $page->nav_body_close();
    die();
}

$current_seme_id = $current_user->get_section_id();
//$date_id = get_last_date_id();
//$date = get_date($date_id);
$current_week = $_GET['week'];
$week = $_GET['week'];

echo '<div class="panel panel-default"><form method="get" action="?week='.$week.'">';
echo '<div class="panel-heading"><h3 class="panel-title">Week Number</h3></div><div class="panel-body"><div class="col-md-10"><select class="form-control" name="week">';
for ($week = 1; $week < 14; $week++) {
    echo '<option value="'.$week.'"';
    if ($_GET['week'] == $week)
        echo ' selected';
    echo '>'.$week.'</option>';
}
echo '
        </select></div>
        <input class="btn btn-default col-md-2" type="submit" value="Go!">
        </form></div></div>
        ';



$courses = list_all_courses(); // fetch all courses and return as object array

// table structure
echo '
    <div class="well text-center">
    <table class="table-hover" id="courses">
    <thead>
        <tr>
            <th>Course Name</th>
            <th># of times</th>
            <th>set to</th>
            <th></th>
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
        <td><input class="form-control" type="number" name="number" placeholder="times been taught"></td>
        <input type="hidden" name="key_num" value="'.$key.'">
        <td><input class="form-control btn btn-default" type="submit" value="Change" name="submit"></td>
    </form>
    
    <form method="post" action="">
       <input type="hidden" name="key_num_inc" value="'.$key.'">
       <td><input class="form-control btn btn-primary" type="submit" value="+" name="inc"></td>
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
    $courses[$key_num]->set_times_been_taught_by($num, $current_week, $current_seme_id);

    // update the total number
    $courses[$key_num]->refresh_total_times_been_taught();

    // refresh the website
//    echo "<meta http-equiv='refresh' content='0'>";
}




// insert a course
echo '<br/>
    <form method="post" action="">
        <div class="form-group"><input class="form-control-static" type="text" name="course_name" placeholder="Add a new course" required>
        <input class="form-control-static btn btn-warning" type="submit" value="Add" name="submit"></div>
    </form></div>';

if (isset($_POST['course_name'])) {
    $course_name = $_POST['course_name'];

    // insert the course
    insert_course($course_name);

    // refresh the website
    echo "<meta http-equiv='refresh' content='0'>";
}

// if increment button is clicked
if (isset($_POST['inc']) && isset($_POST['key_num_inc'])) {
    $key_num = $_POST['key_num_inc']; // the row number
    $courses[$key_num]->set_times_been_taught_by_inc($current_week, $current_seme_id);

    // refresh the website
    echo "<meta http-equiv='refresh' content='0'>";
}

$page->nav_body_close_with_table();
?>






</div>
</body>
</html>
