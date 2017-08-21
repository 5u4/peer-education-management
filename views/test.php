<h1>Hello!</h1>
<?php
include_once '../controllers/manager.php';
include_once '../controllers/section.php';
include_once '../controllers/course.php';


// ----------------------
// Manager testing code
// ----------------------

/* get method & set method
$manager = new Manager(1);
echo $manager->get_section_time();
$manager->set_section_time_to(3);
echo $manager->get_section_time();
echo $manager->get_username();
//*/

/* insert manager
$username = 'un1';
$password = '123';
$first_name = 'fn1';
$last_name = 'ln1';
$section_time = '5';
insert_manager($username, $password, $first_name,
               $last_name, $section_time);
//*/

// ----------------------
// Section testing code
// ----------------------

/* get method & set method
$section = new Section(1);
echo $section->get_section_seme();
echo $section->get_section_name();
$section->set_section_name_to('TUESDAY 12:00-2:30');   SET FUNCTION IS NOT WORKING
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
