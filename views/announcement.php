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

<div>
<fieldset style="width:30%"><legend>Submit Announcement</legend>
<table border="0">
<tr>
<form method="POST" action="<?php $_SERVER['PHP_SELF']?>">
<td> <textarea rows="10" cols="60" name="content"></textarea></td>
</tr>
<tr>
<td><input id="button" type="submit" name="submit" value="Submit"></td>
</tr>
</form>
</table>
</fieldset>
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
	return;
}



echo '<table>';

foreach ($announ_array as $key => $value) {
	echo '<tr>';
	echo '<td>';
	echo '------------------------------------------------';
	echo '------------------------------------------------';
	echo '<br/>';
	echo $value->get_content();
	echo '<br/>';
	$mid = $value->get_manager_id();
	$manager = new Manager($mid);
	$first_name = $manager->get_first_name();
	$last_name = $manager->get_last_name();
	echo '<br/>';
	echo '*************';
	echo '*************';
	echo '<br/>';
	echo 'Posted by '.$first_name.' '.$last_name;
	echo '<br/>';
	echo ' on '.$value->get_announcement_time();
	echo '<br/>';
	echo '*************';
	echo '*************';
	if($mid == $_SESSION['current_user']->get_manager_id()) {
		echo '<br/>';
		echo '<form method="post" action="">';
		echo '<input type="hidden" name="announ_id" value="'.$value->get_announcement_id().'">';
		echo '<input id="button" type="submit" name="delete" value="Delete">';
		echo '</form>';
	}
	echo '<br/>';
	echo '------------------------------------------------';
	echo '------------------------------------------------';
	echo '</td>';
	echo '</tr>';
}


echo '</table>';

if(isset($_POST['delete']) && isset($_POST['announ_id'])) {
	$delete_id = $_POST['announ_id'];
	delete_announcement($delete_id);
	echo "<meta http-equiv='refresh' content='0'>";
	return;
}




?>
