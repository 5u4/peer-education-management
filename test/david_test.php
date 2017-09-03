<?php

include_once '../controllers/peducator.php';
include_once '../controllers/course.php';
include_once '../configs/config.php';
include_once '../controllers/section.php';

$pe = get_peducator(1);

echo $pe->get_sum_over_mins();



?>


