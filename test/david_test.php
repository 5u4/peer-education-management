<?php
echo 'Test';

include_once '../controllers/peducator.php';
include_once '../controllers/course.php';
include_once '../configs/config.php';

$pe = get_peducator(1);

echo $pe->get_peducator_id();

foreach ($pe->get_all_courses() as $value) {
	echo $value->get_course_id();
}


?>
