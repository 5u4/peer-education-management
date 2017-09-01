<?php
if (!isset($_SESSION)) {
    session_start();
}

// include
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/page.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/_check_login.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/manager.php';

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
            $('#section').DataTable( {
                "order": [[ 3, "desc" ]]
            } );
        } );
    </script>
    <!--  DataTable  -->

</head>
<body>
<?php
// ----------------------
// Navigation
// ----------------------
$page->nav_body_start();

// ----------------------
// Section
// ----------------------



// get all sections
$sections = list_all_sections();

// construct section table header
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
            <input type="hidden" name="section_key" value="' . $key_section . '">
            <td>' . $section->get_section_seme() . '</td>
            <td>
                <input type="text" name="section_name" value="' . $section->get_section_name() . '" required>
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


</body>
</html>
