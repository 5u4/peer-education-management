<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/course.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/peducator.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/section.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/manager.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/note.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/page.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/_check_login.php';

$peducator = get_peducator($_GET['id']); // get PE object
$current_user = get_manager($_SESSION['manager_id']);
$section_id = $current_user->get_section_id();
$section = get_section($section_id);
$section_seme = $section->get_section_seme();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        $page = new Page($current_user);
        $page->nav_head();
    ?>
</head>
<body>

<?php
$page->nav_body_start();
// ----------------------
// Updating Table
// ----------------------

// settings
$true = 'Yes';
$false = 'No';

$current = $peducator->get_is_current();

if ($current == 1) {
    $is_current = $true;
    $opposite = $false;
}
else {
    $is_current = $false;
    $opposite = $true;
}

$pe_id = $peducator->get_peducator_id();

// Table Constructing
echo '
<table>
    <thead>
    <form method="POST" action="?id='.$pe_id.'">
        <tr>
            <td>Preferred Name</td>
            <td><input type="text" name="preferred_name" value="'.$peducator->get_preferred_name().'"></td>
        </tr>
        <tr>
            <td>First Name</td>
            <td><input type="text" name="first_name" value="'.$peducator->get_first_name().'"></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><input type="text" name="last_name" value="'.$peducator->get_last_name().'"></td>
        </tr>
        <tr>
            <td>Student ID</td>
            <td><input type="text" name="student_id" value="'.$peducator->get_student_id().'"></td>
        </tr>
        <tr>
            <td>Is Current PE?</td>
            <td>
                <select name="is_current_pe">
                    <option value="'.$current.'">'.$is_current.'</option>
                    <option value="'.$current.'">'.$opposite.'</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="update" value="Update PE"></td>
        </tr>
    </form>
    </thead>
</table>
<br/>
';

// Update Method
if(isset($_POST['update'])) {
    Peducator_update_pe($pe_id, $_POST['student_id'], $_POST['preferred_name'],
        $_POST['first_name'], $_POST['last_name'], $_POST['is_current_pe']);

    // refresh the website
    echo "<meta http-equiv='refresh' content='0'>";
}

?>

<?php
// ----------------------
// All Courses
// ----------------------

// get all courses
$courses = $peducator->get_all_courses();

echo '<table><thead><tr><th>Course Name</th><th></th></tr></thead><tbody>';
foreach ($courses as $key_course=>$course) {
    echo '<tr><td>'.$course->get_course_name().'</td></tr>';
    /*echo '
        <form><td>
            <input type="hidden" name="key_num" value="'.$key_course.'">
            <input type="submit" value="Delete" name="delete_course">
        </td></form></tr>';*/
}
echo '</tbody></table><br/>';

// ----------------------
// Add Course
// ----------------------

// by entering course name
echo 'Add a course to '.$peducator->get_preferred_name().'<br/>
    <form method="POST" action="?id='.$pe_id.'">
        <input type="text" name="course_name">
        <input type="submit" name="add_course" value="Add">
    </form><br/>
     ';

if (isset($_POST['add_course'])) {
    if ($course_id = get_course_id_by_name($_POST['course_name'])) {
        $peducator->set_courses($course_id);

        // refresh the website
        echo "<meta http-equiv='refresh' content='0'>";
    }
    else
        echo $_POST['course_name'].' is not currently in our database. '.
             'Add the course to database'; // adding
}

// by selecting courses


//// ----------------------
//// Delete Course
//// ----------------------
//if (isset($_POST['delete_course'])) {
//    $key = $_POST['key_num'];
//    $course_id = $courses[$key]->get_course_id();
//    $peducator->delete_courses($course_id);
//
//    // refresh the website
////    echo "<meta http-equiv='refresh' content='0'>";
//}

?>

<?php
// ----------------------
// All Sections
// ----------------------

// get all sections
$sections = $peducator->get_all_sections_on(0);

echo '    
    <table><thead><tr>
        <th>Semester</th>
        <th>Section Time</th>
        <th></th>
    </tr></thead><tbody>';
foreach ($sections as $key_section=>$section) {
    echo '
        <tr>
            <td>'.$section->get_section_seme().'</td>
            <td>'.$section->get_section_name().'</td>
            <form method="post" action="?id='.$pe_id.'">
                <input type="hidden" name="section_id" value="'.$section->get_section_id().'">
                <td><input type="submit" name="delete_section" value="Delete Section"></td>
            </form>
        </tr>
        ';
}
echo '</tbody></table><br/>';

if (isset($_POST['delete_section']) && isset($_POST['section_id'])) {
    $section_id = $_POST['section_id'];
    if ($peducator->delete_section($section_id))
        echo "<meta http-equiv='refresh' content='0'>";
}

// ----------------------
// Add Section
// ----------------------
// by selecting all sections in current semester

// Assign Section - Drop Down
$sections = list_all_sections_on($section_seme);
if (!empty($sections)) {
    echo '<form method="post" action="?id='.$pe_id.'">';
    echo 'Assign to <select name="section">';
    foreach ($sections as $key => $section) {
        echo '<option value="' . $section->get_section_id() . '">' .
            $section->get_section_name() .
            '</option>';
    }

    // Assign Section - Apply
    echo '</select>
         <input type="submit" name="assign_section" value="Apply">
         </td></form>';
}

// if Assign Section
if (isset($_POST['assign_section'])) {
    // section id
    $section_id = $_POST['section'];

    // set pe to the section on week 0 with min 0
    if ($peducator->set_contributed_mins(0, $section_id, 0))
        echo "<meta http-equiv='refresh' content='0'>";
}
?>

<?php
// ----------------------
// All Notes
// ----------------------

// get all notes
$notes = $peducator->get_all_notes();

echo '<table><th><tr><td>Content</td><td>By</td><td>On</td></tr></th><tbody>';
foreach ($notes as $note) {
    echo '
        <tr>
            <td>'.$note->get_content().'</td>
            <td>'.get_manager($note->get_manager_id())->get_first_name().'</td>
            <td>'.$note->get_note_time().'</td>
        </tr>
        ';
}
echo '</tbody></table><br/>';

// ----------------------
// Add Note
// ----------------------
echo 'Add a note to '.$peducator->get_preferred_name().'<br/>
    <form method="POST" action="?id='.$pe_id.'">
        <input type="text" name="note_content">
        <input type="submit" name="add_note" value="Add">
    </form><br/>
     ';

if (isset($_POST['add_note'])) {
    $current_user->insert_note($pe_id, $_POST['note_content']);

    // refresh the website
    echo "<meta http-equiv='refresh' content='0'>";
} // refactor insert note => under manager class & can_edit_note() & edit_note($note_id, $content)
?>


<?php
$page->nav_body_close();
?>

</body>
</html>
