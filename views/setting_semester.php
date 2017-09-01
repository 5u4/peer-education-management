<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['set_date'])) {
    header('Location: /views/setting_section.php');
}

// include
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/page.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/_check_login.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/manager.php';
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

</head>
<body>
<?php
// ----------------------
// Navigation
// ----------------------
$page->nav_body_start();

echo '
    <table>
    <form method="POST" action="">
        <td><p>First Day of School: </p><input type="date" name="date" required></td>
        <td><p>Semester: </p><input type="number" name="semester" required></td>
        <td><input type="submit" name="set_date" value="Set"></td>
    </form>
    </table>
    ';

if (isset($_POST['date']) && isset($_POST['set_date']) && isset($_POST['semester'])) {
    $date = $_POST['date'];
    $semester = $_POST['semester'];
    insert_date($date, $semester);
    echo "<meta http-equiv='refresh' content='0'>";
}

$page->nav_body_close();
?>


</body>
</html>
