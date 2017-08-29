<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/course.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/peducator.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/section.php';

$peducator = get_peducator($_GET['id']); // get PE object
?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>

<?php
// settings
$true = 'Yes';
$false = 'No';

$current = $peducator->get_is_current();

if ($current == 1) {
    $is_current = $true;
    $opposite = $false;
}
else {
    $is_current = $false;
    $opposite = $true;
}

$pe_id = $peducator->get_peducator_id();

// Table Constructing
echo '
<table>
    <thead>
    <form method="POST" action="?id='.$pe_id.'">
        <tr>
            <td>Preferred Name</td>
            <td><input type="text" name="preferred_name" value="'.$peducator->get_preferred_name().'"></td>
        </tr>
        <tr>
            <td>First Name</td>
            <td><input type="text" name="first_name" value="'.$peducator->get_first_name().'"></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><input type="text" name="last_name" value="'.$peducator->get_last_name().'"></td>
        </tr>
        <tr>
            <td>Student ID</td>
            <td><input type="text" name="student_id" value="'.$peducator->get_student_id().'"></td>
        </tr>
        <tr>
            <td>Is Current PE?</td>
            <td>
                <select name="is_current_pe">
                    <option value="'.$current.'">'.$is_current.'</option>
                    <option value="'.$current.'">'.$opposite.'</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="update" value="Update PE"></td>
        </tr>
    </form>
    </thead>
</table>
';

// Update Method
if(isset($_POST['update'])) {
    Peducator_update_pe($pe_id, $_POST['student_id'], $_POST['preferred_name'],
        $_POST['first_name'], $_POST['last_name'], $_POST['is_current_pe']);

    // refresh the website
    echo "<meta http-equiv='refresh' content='0'>";
}

?>







</body>
</html>