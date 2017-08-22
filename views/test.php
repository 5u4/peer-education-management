<h1>Hello!</h1>
<?php
include_once '../controllers/manager.php';
include_once '../controllers/section.php';
include_once '../controllers/course.php';
include_once '../controllers/announcement.php';
include_once '../controllers/note.php';
include_once '../controllers/peducator.php';


// ----------------------
// Manager testing code
// ----------------------

/* initializing a section
if ($manager = get_manager(2))
    echo 'true';
else
    echo 'false';
//*/

/* get method & set method
$manager = get_manager(1);
$manager->set_first_name_to('first');
echo $manager->get_first_name().' ';
$manager->set_last_name_to('ls');
echo $manager->get_last_name().' ';
echo $manager->get_username().' ';
//*/

/* insert manager
$username = 'un1';
$password = '123';
$first_name = 'fn1';
$last_name = 'ln1';
$section_time = 1;
insert_manager($username, $password, $first_name,
               $last_name, $section_time);
//*/

// ----------------------
// Section testing code
// ----------------------

/* initializing a section
if ($section = get_section(1))
    echo 'true';
else
    echo 'false';
//*/

/* get method & set method
$section = get_section(1);
echo $section->get_section_seme();
echo $section->get_section_name();
$section->set_section_name_to('TUESDAY 12:00-2:30');
echo $section->get_section_name();
//*/

/* insert section
$section_seme = '201702';
$section_name = 'SECTION 2';
insert_section($section_seme, $section_name);
//*/

/* list all sections
$section_seme = '201702';
foreach (list_all_sections_on($section_seme) as $value) {
    echo $value->get_section_id();
}
//*/

// ----------------------
// Course testing code
// ----------------------

/* initializing a course
$course_name = 'ECON105';
if ($course = get_course($course_name))
    echo 'true';
else
    echo 'false';
//*/

/* get method & set method
$course_name = 'ECON103';
$course = get_course($course_name);
echo $course->get_course_id();
echo $course->get_course_name();
echo $course->get_total_times_been_taught();
$course->set_course_name_to('ECON105');
echo $course->get_course_name();
// increase course count
$course->increase_total_times_been_taught_by(1);
echo $course->get_total_times_been_taught();
//*/

/* insert a course
$course_name = 'ENSC100';
insert_course($course_name);
//*/

// ----------------------
// Announcement testing code
// ----------------------

/* initializing an announcement
$announcement_id = 2;
if ($announcement = get_announcement($announcement_id))
    echo 'true';
else
    echo 'false';
//*/

/* get method & set method
$announcement_id = 1;
$announcement = get_announcement($announcement_id);
echo $announcement->get_manager_id().' ';
echo $announcement->get_content().' ';
echo $announcement->get_announcement_time().' ';
$content = 'Change again';
$announcement->set_content_to($content);
echo $announcement->get_content().' ';
//*/

/* insert an announcement
$manager_id = 1;
$content = 'new content';
insert_announcement($manager_id, $content);
//*/

// ----------------------
// Note testing code
// ----------------------

/* initializing a note
$note_id = 1;
if ($note = get_note($note_id))
    echo 'true';
else
    echo 'false';
//*/

/* get method & set method
$note_id = 2;
$note = get_note($note_id);
echo $note->get_manager_id().' ';
echo $note->get_peducator_id().' ';
echo $note->get_content().' ';
echo $note->get_note_time().' ';
$content = 'Change again';
$note->set_content_to($content);
echo $note->get_content().' ';
//*/

/* insert a note
$manager_id = 1;
$peducator_id = 1;
$content = 'new content';
insert_note($manager_id, $peducator_id, $content);
//*/

// ----------------------
// manager & announcement
// ----------------------

/*
// $manager = insert_manager('senhung', '123', 'senhung', 'wong', 1);

$manager = get_manager(2);

//$content = 'First Announcement';
//$manager->insert_announcement($content);

$announcement = get_announcement(1);
if ($manager->can_edit($announcement))
    echo 'true';
else
    echo 'false';

$content = 'Change Content';
if ($manager->can_edit($announcement))
    $manager->edit_announcement($announcement, $content);
//*/

//$pe = get_peducator(1);
//echo $pe->get_last_name();
//echo $pe->get_all_courses();







?>
