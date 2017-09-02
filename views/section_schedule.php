<?php
if (!isset($_SESSION)) {
    session_start();
}
?>


<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/_check_login.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/peducator.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/section.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/page.php';

$page = new Page($_SESSION['current_user']);

$current_section = $_SESSION['current_user'] -> get_section_id();

// get seme_name by initializing a section object
$sec_obj = new Section($current_section);
$seme_name = $sec_obj->get_section_seme();

$current_week = 1;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php $page->nav_head();?>
    <meta charset="utf-8">
</head>
<body>
<div class="container-fluid">
    <div class="page-header text-center">
        <h1>Schedule of <?php echo $seme_name; ?></h1>
    </div>
<?php
$page->nav_body_start();
?>
<?php
//* Constructing a section table in course page

// To get section name
$con_sec_name = connection();
$sql_sec_name = "SELECT section_name FROM sections WHERE section_seme = '$seme_name'";
$result_sec_name = mysqli_query($con_sec_name, $sql_sec_name);
$all_sec_id_array = list_all_sections_on($seme_name);
/*while ($row_sec_name = mysqli_fetch_array($result_sec_name)) {
	echo "<th>".$row_sec_name['section_name']."</th>";
	list_all_pe_on($all_sec_id_array[])
	
}*/
echo '
   <table class="table-hover" id="sections">
	
';

foreach ($all_sec_id_array as $key_section => $value_sec) {
	echo '<td style="color:red;">'.$value_sec->get_section_name().'</td>';
}


echo '<tr>';
foreach ($all_sec_id_array as $key_section => $value_sec) {

		$pe_array = list_all_pe_on($value_sec->get_section_id());

		echo '<td>';
		echo '<table>';

		foreach ($pe_array as $key_pe => $value_pe) {
			echo '<tr><td><a href="'.'/views/pe_detail.php?id='.$value_pe->get_peducator_id().'">'.$value_pe->get_preferred_name().' '.$value_pe->get_last_name().'</a></td></tr>';
		}
	//views/pe_detail.php?id=
		echo '</table>';
		echo '</td>';
}
echo '</tr>';


echo         '
	</table>
    ';


// table structure


/*
// read each courses
foreach ($pe as $key=>$pe_obj) {
    echo '<tr>'; // table row
    echo '<td>'.$pe_obj->get_first_name().' '.$pe_obj->get_last_name().' ('. 
	$pe_obj->get_preferred_name().')'.'</td>';
    echo '<td>'.$pe_obj->get_contributed_mins($current_section, $current_week).'</td>';
    echo '
    <form method="post" action="">
        <td><input type="number" name="number"></td>
        <input type="hidden" name="key_num" value="'.$key.'">
        <td><input type="submit" value="Change" name="submit"></td>
    </form>
    ';
    echo '</tr>'; // end table row
}
*/


// if Change button is clicked call function
if (isset($_POST['number']) && isset($_POST['key_num'])) {
    $num = $_POST['number']; // the number user entered
    $key_num = $_POST['key_num']; // the row number

    // update the number
    $pe[$key_num]->set_contributed_mins($num, $current_section,$current_week);

    // refresh the website
    echo "<meta http-equiv='refresh' content='0'>";
}

$page->nav_body_close();

?>







</body>
</html>
