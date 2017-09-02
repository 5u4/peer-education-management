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

$nav = new Page($_SESSION['current_user']);

/*
// get manager
$manager = get_manager(2);

// manager post announcement
$content = 'First Announcement';
$manager->insert_announcement($content);

// get announcement
$announcement = get_announcement(1);

// test if manager can edit the announcement
if ($manager->can_edit($announcement))
    echo 'true';
else
    echo 'false';

// change announcement
$content = 'Change Content';
if ($manager->can_edit($announcement))
    $manager->edit_announcement($announcement, $content);
//*/


?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php $nav->nav_head();?>
</head>

<body>
<div class="container-fluid">
    <div class="page-header text-center">
        <h1>Announcement</h1>
    </div>
<?php
$nav->nav_body_start();
?>
<div class="well">
<form method="POST" action="<?php $_SERVER['PHP_SELF']?>">
<textarea class="form-group form-control" rows="3" name="content" placeholder="Insert an announcement..."></textarea>

<input class="form-group form-control btn btn-primary" id="button" type="submit" name="submit" value="Submit">
</form>
</div>

<?php
// -----------------------------------
// This is to submit announcement.
// -----------------------------------
if(isset($_POST['submit'])) {
	// Stop empty content being submitted
	if(empty($_POST['content'])) {
		$alert = "You cannot submit an empty announcement.";
		echo "<script type='text/javascript'>alert('$alert');</script>";
	}
	$_SESSION['current_user']->insert_announcement($_POST['content']);
	echo "<meta http-equiv='refresh' content='0'>";
	return;
}



// -----------------------------------
// This is to display announcements.
// -----------------------------------

// Get announcements from database
$announ_array = list_all_announcements_desc();

// If there is no announcement, then
if(empty($announ_array)) {
	echo '<h1> There is no announcement now. </h1>';
//	return;
}



//echo '<table class="table-hover">';
echo '<div class="container-fluid well">';
foreach ($announ_array as $key => $value) {

    echo '<div class="panel panel-primary"><div class="panel-body">'; //


    echo '<h4 class="text-left">';
    echo $value->get_content();
    echo '</h4>';

    $mid = $value->get_manager_id();
	$manager = new Manager($mid);
	$first_name = $manager->get_first_name();
	$last_name = $manager->get_last_name();

    echo '</div>'; //

	echo '<div class="panel-footer">';

    echo '<p class="text-right">';
	echo $first_name.' '.$last_name.'<br>';
	echo $value->get_announcement_time();
    echo '</p>';

	if($same_auth = $mid == $_SESSION['current_user']->get_manager_id()) {
		echo '<form method="post" action="">';
		echo '<input type="hidden" name="announ_id" value="'.$value->get_announcement_id().'">';


		echo '<input class="btn btn-group-justified btn-danger" id="button" type="submit" name="delete" value="Delete">';


		echo '</form>';
	}

	echo '</div>'; //
	echo '</div>'; //
}

echo '</div>';
//echo '</table>';

if(isset($_POST['delete']) && isset($_POST['announ_id'])) {
	$delete_id = $_POST['announ_id'];
	delete_announcement($delete_id);
	echo "<meta http-equiv='refresh' content='0'>";
	return;
}


$nav->nav_body_close();
?>

</body>
</html>
