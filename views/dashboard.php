<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/announcement.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/manager.php';
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
<div class="container-fluid">
    <div class="page-header text-center">
        <h1>Dashboard</h1>
    </div>
<?php
$page->nav_body_start();
?>
<?php
// -----------------------
// To display announcement
// -----------------------

$announ_array = list_all_announcements_desc();

if (!empty($announ_array)) {

$content = $announ_array[0]->get_content();

echo '<div>';
echo '    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title text-center"><a class="" href="announcement.php">Announcement</a></h3>
        </div>
        <div class="panel-body"><p><div class="text-left">';
echo $content;
	$mid = $announ_array[0]->get_manager_id();
	$manager = new Manager($mid);
	$first_name = $manager->get_first_name();
	$last_name = $manager->get_last_name();
	echo '</div><br/><div class="text-right"> '.$first_name.' '.$last_name;
	echo '<br/>'.$announ_array[0]->get_announcement_time();
echo '</div></p></div></div>';

}

?>






<?php
$page->nav_body_close();
?>
</div>
</body>

</html>
