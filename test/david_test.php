<?php

include_once '../controllers/peducator.php';
include_once '../controllers/course.php';
include_once '../configs/config.php';
include_once '../controllers/section.php';

$pe = get_peducator(1);

if($pe->set_contributed_mins(999,99,99)) {
	echo'Mins updated';
}


?>
