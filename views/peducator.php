<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <?php include_once '../controllers/course.php' ?>
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

// Get week number and semester id
$current_week = 1; // will be change to a table # (or something else) in the future
$current_seme = '201702'; // semester name (will also be change into the table)
echo '<h1>This is week '.$current_week.' in semester '.$current_seme.'</h1>';

// Get all PEs
$peducators = list_all_pe();

// Constructing Table
echo '
    <table id="pe_list">
    <thead>
        <tr>
            <th>Preferred Name</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Student ID</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    ';

// read each PE
foreach ($peducators as $key=>$peducator) {
    echo '<tr>'; // table row
    echo '<td>'.$peducator->get_preferred_name().'</td>';
    echo '<td>'.$peducator->get_first_name().'</td>';
    echo '<td>'.$peducator->get_last_name().'</td>';
    echo '<td>'.$peducator->get_student_id().'</td>';
    echo '
    <form method="post" action="">
        <td>Assign to <input type="number" name="number"></td>
        <input type="hidden" name="key_num" value="'.$key.'">
        <td><input type="submit" value="Change" name="submit"></td>
    </form>
    ';
    echo '</tr>'; // end table row
}



?>




</body>
</html>