<?php
session_start();

//----------------------------------------
// for testing, make up a current user
$_SESSION['manager_id'] = '1';
//----------------------------------------

?>


<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/_check_login.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/peducator.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/section.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/page.php';

$nav = new Page($_SESSION['current_user']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php $nav->nav_head();?>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sections').DataTable( {
                "order": [[ 3, "desc" ]]
            } );
        } );
    </script>
</head>
<body>
<?php
$nav->nav_body_start();
?>
<?php
//* Constructing a section table in course page

$current_section = $_SESSION['current_user'] -> get_section_id(); 

// get seme_name by initializing a section object
$sec_obj = new Section($current_section);
$seme_name = $sec_obj->get_section_seme();

$current_week = 1;

echo '<h1>Section Schedule for Semester '.$seme_name.'</h1>';



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
   <table id="sections">
	
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

$nav->nav_body_close();

?>







</body>
</html>
