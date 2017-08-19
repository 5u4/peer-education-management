<?php
include '../configs/config.php';

// ----------------------
// Manager Description
// ----------------------
// initialize a Manager: new Manager(manager_id)
// get methods: get_attributes() returns attributes
// set methods: set_attributes_to(new_value) return true/false;

class Manager {
    // ----------------------
    // database connection
    // ----------------------
    private $connect_to_db;

    // ----------------------
    // Manager attributes
    // ----------------------
    private $manager_id;
    private $user_name;
    private $first_name;
    private $last_name;
    private $section_time;

    function __construct($manager_id) {
        // set connection
        $this->connect_to_db = connection();

        // set manager id
        $this->manager_id = $manager_id;

        // fetch manager row
        $sql = "SELECT * 
                FROM managers 
                WHERE manager_id=$this->manager_id;";
        $result = mysqli_query($this->connect_to_db, $sql);
        $row = mysqli_fetch_assoc($result);

        // set attributes
        $this->user_name = $row['user_name'];
        $this->first_name = $row['first_name'];
        $this->last_name = $row['last_name'];
        $this->section_time = $row['section_time'];
    }

    // ----------------------
    // get functions
    // ----------------------
    public function get_manager_id() {
        return $this->manager_id;
    }

    public function get_user_name() {
        return $this->user_name;
    }

    public function get_first_name() {
        return $this->first_name;
    }

    public function get_last_name() {
        return $this->last_name;
    }

    public function get_section_time() {
        return $this->section_time;
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

    public function set_first_name_to($name) {
        // update database
        $sql = "UPDATE managers 
                SET first_name=$name 
                WHERE manager_id=$this->manager_id;";
        $result = mysqli_query($this->connect_to_db, $sql);

        // set new result to user_name
        if ($result) {
            $this->first_name = $name;
            return true;
        }
        return false;
    }

    public function set_last_name_to($name) {
        // update database
        $sql = "UPDATE managers 
                SET last_name=$name 
                WHERE manager_id=$this->manager_id;";
        $result = mysqli_query($this->connect_to_db, $sql);

        // set new result to user_name
        if ($result) {
            $this->last_name = $name;
            return true;
        }
        return false;
    }

    public function set_section_time_to($time_slot) {
        // update database
        $sql = "UPDATE managers 
                SET section_time=$time_slot 
                WHERE manager_id=$this->manager_id;";
        $result = mysqli_query($this->connect_to_db, $sql);

        // set new result to section_time
        if ($result) {
            $this->section_time = $time_slot;
            return true;
        }
        return false;

        /*// extra checking code for updating
        $select_sql = "SELECT *
           FROM managers
           WHERE manager_id=$this->manager_id;";
        $select_result = mysqli_query($this->connect_to_db, $select_sql);
        $new_section_time = mysqli_fetch_assoc($select_result);
        $this->section_time = $new_section_time['section_time'];*/
    }
}
?>