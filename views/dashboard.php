<?php
session_start();

//----------------------------------------
// for testing, make up a current user
$_SESSION['manager_id'] = '1';
//----------------------------------------

?>

<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/announcement.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/manager.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/_check_login.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/page.php';

$nav = new Page($_SESSION['current_user']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php $nav->nav_head();?>
</head>

<body>
<?php
$nav->nav_body_start();
?>

<?php
// -----------------------
// To display announcement
// -----------------------

$announ_array = list_all_announcements_desc();
$content = $announ_array[0]->get_content();

echo '<a href="/views/announcement.php">';
echo '<div>';
echo '<h1>Latest Announcemet</h1>';
echo $content;
	$mid = $announ_array[0]->get_manager_id();
	$manager = new Manager($mid);
	$first_name = $manager->get_first_name();
	$last_name = $manager->get_last_name();
	echo '<br/>';
	echo '*************';
	echo '*************';
	echo '<br/>';
	echo 'Posted by '.$first_name.' '.$last_name;
	echo '<br/>';
	echo ' on '.$announ_array[0]->get_announcement_time();
	echo '<br/>';
	echo '*************';
	echo '*************';
echo '</div>';
echo '</a>';

?>




<?php
$nav->nav_body_close();
?>
</body>

</html>
