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
    } );
</script>
</head>
<body>
<?php $page->nav_body_start(); ?>

<?php
// Section Setting
$sections = list_all_sections();

echo '
    <table id="sections"><thead>
        <tr>
            <td>Semester</td>
            <td>Time</td>
            <td></td>
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

if (isset($_POST['section_change'])) {
    $section_key = $_POST['section_key'];
    $section_name = $_POST['section_name'];
    $sections[$section_key]->set_section_name_to($section_name);

    // refresh the website
    echo "<meta http-equiv='refresh' content='0'>";
}

if (isset($_POST['section_delete'])) {

}



?>



<?php $page->nav_body_close_with_table(); ?>
</body>
