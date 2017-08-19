<h1>hello!</h1>
<?php
// include_once '../controllers/member.php';
include_once '../configs/config.php';


function get_section_time($con, $sql) {
	$sql = "SELECT * FROM managers WHERE manager_id=1;";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	echo $row;
}
/*
$sql = "SELECT * FROM managers WHERE manager_id=1;";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
echo $row['username'];
*/
//$output = new Member();
get_section_time($con, $sql);
?>
