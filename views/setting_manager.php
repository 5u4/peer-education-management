<?php
if (!isset($_SESSION)) {
    session_start();
}

// include
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/page.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/_check_login.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/manager.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/section.php';

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
                $('#manager').DataTable( {} );
            } );
        </script>
        <!--  DataTable  -->

    </head>
    <body>

<?php
$page->nav_body_start();

$managers = list_all_managers();

echo '
    <h1>Manager</h1>
        <table id="manager"><thead>
        <tr>
            <th>Manager</th>
            <th>Current Section</th>
            <th>Change Section</th>
            <th>Permission</th>
        </tr>
    </thead><tbody>
    ';


foreach ($managers as $manager_key =>$manager) {
    $sec = get_section($manager->get_section_id());
    echo '
        <tr>
            <td>
                '.$manager->get_first_name().' '.$manager->get_last_name().'
            </td>
            <td>
                '.$sec->get_section_seme().' '.$sec->get_section_name().'
            </td>';

    $sections = list_all_sections();
    if (!empty($sections)) {
        echo '<td><form method="post" action="">';
        echo 'Assign to <select name="section">';
        foreach ($sections as $key => $section) {
            echo '<option value="' . $section->get_section_id() . '">' .
                $section->get_section_seme().' '. $section->get_section_name() .
                '</option>';
        }

        // Assign Section - Apply
        echo '</select>
         <input type="hidden" name="manager_key" value="'.$manager_key.'">
         <input type="submit" name="assign_section" value="Apply">
         </form></td>';

        echo '</tr>';
    }

}

// if Assign Section
if (isset($_POST['assign_section'])) {
    $section_id = $_POST['section'];
    $manager_key = $_POST['manager_key'];

    if ($managers[$manager_key]->set_section_id_to($section_id))
        echo "<meta http-equiv='refresh' content='0'>";
}

echo '<td></td></tbody></table>';


$page->nav_body_close_with_table();

?>
