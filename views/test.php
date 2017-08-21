<h1>Hello!</h1>
<?php
include_once '../controllers/manager.php';
include_once '../controllers/section.php';
include_once '../controllers/course.php';


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
$section->set_section_name_to('TUESDAY 12:00-2:30'); // SET FUNCTION IS NOT WORKING
echo $section->get_section_name();
//*/

/* insert section
$section_seme = '201702';
$section_name = 'TUESDAY 12:00-2:30';
insert_section($section_seme, $section_name);
//*/

// ----------------------
// Course testing code
// ----------------------

/* get method & set method
$course = new_course('ECON103');
echo $course->get_course_id();
echo $course->get_course_name();
echo $course->get_total_times_been_taught();
$course->set_course_name_to('ECON103');
echo $course->get_course_name();
// increase course count
$course->increase_total_times_been_taught_by(1);
echo $course->get_total_times_been_taught();
//*/

?>
