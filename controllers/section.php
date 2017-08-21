<?php
include_once '../configs/config.php';

// ----------------------
// Section description
// ----------------------
// initialize a Section (should not be used explicitly): new Section($section_id)
// get methods: get_attributes() returns attributes
// set methods: set_attributes_to($new_value) returns true/false

// ----------------------
// other functions
// ----------------------
// initialize a Section: $section = get_section($section_id);
// insert a section into database: insert_section($section_seme, $section_slot)
//                                 return true/false
// list all sections on a semester: list_all_sections_on($section_seme)
//                                  return array[section_id]
// * list all courses on a section: list_all_courses_on($section_id)
//                                return array[course_id]

class Section {
    // ----------------------
    // database connection
    // ----------------------
    private $connect_to_db;

    // ----------------------
    // Course attributes
    // ----------------------
    private $section_id;
    private $section_seme;
    private $section_name;

    // ----------------------
    // constructor
    // ----------------------
    function __construct($section_id) {
        // set connection
        $this->connect_to_db = connection();

        // set section id
        $this->section_id = $section_id;

        // fetch section row
        $sql = "SELECT * 
                FROM sections 
                WHERE section_id=$this->section_id;";
        $result = mysqli_query($this->connect_to_db, $sql);
        $row = mysqli_fetch_assoc($result);

        // set attributes
        $this->section_seme = $row['section_seme'];
        $this->section_name = $row['section_name'];
    }

    // ----------------------
    // get functions
    // ----------------------
    public function get_section_id() {
        return $this->section_id;
    }

    public function get_section_seme() {
        return $this->section_seme;
    }

    public function get_section_name() {
        return $this->section_name;
    }

    // ----------------------
    // set functions
    // ----------------------
    public function set_section_name_to($section_name) {
        // update database
        $sql = "UPDATE sections 
                SET section_name='$section_name' 
                WHERE section_id=$this->section_id;";
        $result = mysqli_query($this->connect_to_db, $sql);

        // set new section_name
        if ($result) {
            $this->section_name = $section_name;
            return true;
        }
        return false;
    }
}

function get_section($section_id) {
    $con = connection();
    $sql = "SELECT * 
            FROM sections 
            WHERE section_id=$section_id;";
    $result = mysqli_query($con, $sql);
    if (mysqli_fetch_row($result))
        return new Section($section_id);
    else
        return null;
}

function insert_section($section_seme, $section_name) {
    // insert database
    $con = connection();
    $sql = "INSERT INTO sections (section_seme, section_name)
            VALUES ('$section_seme', '$section_name');";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Insert failed: '.mysqli_error($con));
    }

    // get section id and return
    $section_id = mysqli_insert_id($con);
    echo 'Section with id '.$section_id.' is inserted.';
    return new Section($section_id);
}
?>