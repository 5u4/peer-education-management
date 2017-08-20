<?php
include '../configs/config.php';

// ----------------------
// Course Description
// ----------------------
// initialize a Manager: new Manager(manager_id)
// get methods: get_attributes() returns attributes
// set methods: set_attributes_to(new_value) return true/false;

class Course {
    // ----------------------
    // database connection
    // ----------------------
    private $connect_to_db;

    // ----------------------
    // Course attributes
    // ----------------------
    private $course_id;
    private $course_name;
    private $total_times_been_taught; //

    // ----------------------
    // constructor
    // ----------------------
    function __construct() {
        // set connection
        $this->connect_to_db = connection();
    }

    // ----------------------
    // list function
    // ----------------------
    public function list_all_section_on($course_name, $section_seme) {
        // select database
        $sql = "SELECT *
                FROM course_sections
                WHERE course_name=$course_name;";
        $result = mysqli_query($this->connect_to_db, $sql);

    }

    // ----------------------
    // get functions
    // ----------------------
    public function get_course_id() {
        return $this->course_id;
    }

    // ----------------------
    // set functions
    // ----------------------
    public function set_user_name_to($name) {
        // update database
        $sql = "UPDATE managers
                SET user_name=$name
                WHERE manager_id=$this->manager_id;";
        $result = mysqli_query($this->connect_to_db, $sql);

        // set new result to user_name
        if ($result) {
            $this->user_name = $name;
            return true;
        }
        return false;
    }
}
?>