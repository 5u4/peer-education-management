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
<body>

<?php
$page->nav_body_start();

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
    $pe[$key_num]->set_contributed_mins($num, $current_section,$current_week);

    // refresh the website
    echo "<meta http-equiv='refresh' content='0'>";
}

$page->nav_body_close_with_table();
?>







</body>
</html>
