<h1>Hello!</h1>
<?php
include_once '../controllers/manager.php';

$output = new Manager(1);
echo $output->get_section_time();
$output->set_section_time_to(5);
echo $output->get_section_time();
?>
