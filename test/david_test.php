<?php
echo 'Test';

include_once '../controllers/peducator.php';
include_once '../configs/config.php';

$pe = get_peducator(1);

echo $pe->get_peducator_id();

echo $pe->get_all_courses();



?>
