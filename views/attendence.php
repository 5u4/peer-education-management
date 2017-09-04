<?php
if (!isset($_SESSION)) {
    session_start();
}

?>

<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/_check_login.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/peducator.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/page.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/date.php';

$current_user = get_manager($_SESSION['manager_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $page = new Page($current_user);
    $page->nav_head();
    ?>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sections').DataTable( {} );
        } );
    </script>
</head>
<div class="container-fluid">
    <div class="page-header text-center">
        <h1>Attendance</h1>
    </div>
<?php
$page->nav_body_start();

if (!isset($_GET['week'])) {


    echo '<form method="get" action="?week='.$week.'">';
    echo 'Please select a week: <select name="week">';
    for ($week = 1; $week < 14; $week++) {
        echo '<option value="'.$week.'">'.$week.'</option>';
    }
    echo '
        </select>
        <input type="submit" value="Confirm">
        </form>
        ';

    $page->nav_body_close();
    die();
}

//* Constructing a section table in course page

$current_section = $_SESSION['current_user'] -> get_section_id(); // will be change to a table # (or something else) in the future

$current_seme_id = $current_user->get_section_id();
$date_id = get_last_date_id();
$date = get_date($date_id);
$current_week = $_GET['week'];


$pe = list_all_pe_on_with_week_number($current_section, 0); // fetch all courses and return as object array

// table structure
echo '    <div class="well text-center">
    <table class="table-hover" id="sections">
    <thead>
        <tr>
            <th>PE Name</th>
            <th>Attendence</th>
            <th>Contributed Minutes on Week '.$current_week.'</th>
            <th></th>
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
        <td><input class="form-control" type="number" name="number" placeholder="Minutes Contributed" required></td>
        <input type="hidden" name="key_num" value="'.$key.'">
        <td><input class="form-control btn btn-primary" type="submit" value="Change" name="submit"></td>
    </form>
    ';
    echo '</tr>'; // end table row
}
echo '</tbody></table></div>'; // end table structure

// if Change button is clicked call function
if (isset($_POST['number']) && isset($_POST['key_num'])) {
    $num = $_POST['number']; // the number user entered
    $key_num = $_POST['key_num']; // the row number

    // update the number
    $pe[$key_num]->set_contributed_mins($num, $current_section,$current_week);

    // refresh the website
    echo "<meta http-equiv='refresh' content='0'>";
}

$page->nav_body_close_with_table();
?>



</div>
</body>
</html>
