<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/peducator.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/_check_login.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/page.php';

$current_user = get_manager($_SESSION['manager_id']);

$page = new Page($_SESSION['current_user']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php $page->nav_head();?>
</head>
<body>
<?php
$page->nav_body_start();
?>
<table>
    <thead>
        <form method="POST" action="">
            <tr>
                <td>Preferred Name</td>
                <td><input type="text" name="preferred_name" required></td>
            </tr>
            <tr>
                <td>First Name</td>
                <td><input type="text" name="first_name" required></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td><input type="text" name="last_name" required></td>
            </tr>
            <tr>
                <td>Student ID</td>
                <td><input type="text" name="student_id" required></td>
            </tr>
            <tr>
                <td>Is Current PE?</td>
                <td><input type="checkbox" name="is_current" checked></td>
            </tr>
            <tr>
                <td><input type="submit" name="add" value="Add PE"></td>
            </tr>
        </form>
    </thead>
</table>

<?php
// ---------------------
// [Add]
// ---------------------

if(isset($_POST['add'])) {
    Peducator_add_pe($_POST['peducator_id'], $_POST['student_id'], $_POST['preferred_name'],
        $_POST['first_name'], $_POST['last_name'], $_POST['is_current'] ? 1 : 0);
}

$page->nav_body_close();

?>

</body>
</html>
