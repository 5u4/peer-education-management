<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/course.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/peducator.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/section.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/page.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $current_user = get_manager(1);
    $page = new Page($current_user);
    $page->nav_head();
    ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#pe_list').DataTable( {
                "order": [[ 3, "desc" ]]
            } );
        } );
    </script>
</head>
<body>
<?php
$page->nav_body_start();

// Get week number and semester id
$current_week = 1; // will be change to a table # (or something else) in the future
$current_seme_id = 2; // semester name (will also be change into the table)
$current_section = get_section($current_seme_id);
echo '<h1>This is week '.$current_week.' in semester '.$current_seme_id.'</h1>';

// Get all PEs
$peducators = list_all_pe();
$section_seme = $current_section->get_section_seme();


// Constructing Table
echo '
    <table id="pe_list">
    <thead>
        <tr>
            <th>Name</th>
            <th>Student ID</th>
            <th>Assign Section</th>
            <th>More</th>
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

    // Assign Section - Drop Down
    echo '<td>';
    $sections = list_all_sections_on($section_seme);
    echo '<form method="post" action="">';
    echo 'Assign to <select name="section">';
    foreach ($sections as $key=>$section)
        echo '<option value="'.$section->get_section_id().'">'.
             $section->get_section_name().
             '</option>';

    // Assign Section - Apply
    echo '</select> 
         <input type="submit" name="" value="Apply">
         </td>';

    // More
    echo '<td>'.'more'.'</td>';

    // Row ID & End Table
    echo '<input type="hidden" name="key_num" value="'.$key_pe.'">';
    echo '</form>';
    echo '</tr>'; // end table row
}

// Table End
echo '</tbody></table>';

// if Assign Section
if (isset($_POST['section']) && isset($_POST['key_num'])) {
    // row #
    $key_num = $_POST['key_num'];

    // section id
    $section_id = $_POST['section'];

    // set pe to the section on week 0 with min 0
    if ($peducators[$key_num]->set_contributed_mins(0, $section_id, 0))
        echo 'Success!';
}









// Add New PE
echo '<a target="_blank" href="new_pe.php">Add A New PE</a>';



$page->nav_body_close();
?>




</body>
</html>