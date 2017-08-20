<?php
include '../configs/config.php';

// ----------------------
// Section description
// ----------------------
// initialize a Section: new Section($section_id)
// get methods: get_attributes() returns attributes

// ----------------------
// other functions
// ----------------------
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
    private $section_slot;

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
        $this->section_slot = $row['section_slot'];
    }

    // ----------------------
    // get functions
    // ----------------------
    public function get_section_seme() {
        return $this->section_seme;
    }

    public function get_section_slot() {
        return $this->section_slot;
    }
}

function insert_section($section_seme, $section_slot) {
    // insert database
    $sql = "INSERT INTO sections (section_seme, section_slot)
            VALUES ('$section_seme', '$section_slot');";
    $result = mysqli_query(connection(), $sql);
    return $result;
}
?>