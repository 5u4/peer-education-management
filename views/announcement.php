<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/announcement.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/manager.php';

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


//---------------------------------------

// Get announcements from database
$announ_array = list_all_announcements_desc();

// If there is no announcement, then
if(empty($announ_array)) {
	echo '<h1> There is no announcement now. </h1>';
	return;
}


// -----------------------------------
// This is to display announcements.
// -----------------------------------
echo '<table>';

foreach ($announ_array as $key => $value) {
	echo '<tr>';
	echo '<td>';
	echo $value->get_content();
	echo '<br/>';
	$mid = $value->get_manager_id();
	$manager = new Manager($mid);
	$first_name = $manager->get_first_name();
	$last_name = $manager->get_last_name();
	echo 'Posted by '.$first_name.' '.$last_name;
	echo ' on '.$value->get_announcement_time();
	echo '</td>';
	echo '</tr>';
}








echo '</table>';




?>
