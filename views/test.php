<h1>Hello!</h1>
<?php
include_once '../controllers/manager.php';

$output = new Manager();
$output->get_section_time(1);
?>
