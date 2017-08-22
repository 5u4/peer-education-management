<?php
echo 'Test';

include_once '../controllers/peducator.php';
include_once '../controllers/course.php';
include_once '../configs/config.php';
include_once '../controllers/section.php';

$pe = get_peducator(1);

foreach ($pe->get_all_sections() as $value) {
	echo $value->get_section_id();
}


?>
