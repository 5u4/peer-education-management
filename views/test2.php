<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/page.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/manager.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        $current_user = get_manager(1);
        $page = new Page($current_user);
        $page->nav_head();
    ?>
</head>
<body>
<?php
echo 'Hello';
?>
</body>
</html>