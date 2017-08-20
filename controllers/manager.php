<?php
include '../configs/config.php';

// ----------------------
// Manager description
// ----------------------
// initialize a Manager: new Manager($manager_id)
// get methods: get_attributes() returns attributes
// set methods: set_attributes_to(new_value) return true/false

// ----------------------
// other functions
// ----------------------
// insert a manager into database: insert_manager($username, $password, $first_name,
//                                 $last_name, $section_time) returns new Manager

class Manager {
    // ----------------------
    // database connection
    // ----------------------
    private $connect_to_db;

    // ----------------------
    // Manager attributes
    // ----------------------
    private $manager_id;
    private $username;
    private $first_name;
    private $last_name;
    private $section_time;

    // ----------------------
    // constructor
    // ----------------------
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
        $this->username = $row['username'];
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

    public function get_username() {
        return $this->username;
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
    public function set_username_to($name) {
        // update database
        $sql = "UPDATE managers 
                SET username=$name 
                WHERE manager_id=$this->manager_id;";
        $result = mysqli_query($this->connect_to_db, $sql);

        // set new result to user_name
        if ($result) {
            $this->username = $name;
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
    }
}

function insert_manager($username, $password, $first_name, $last_name, $section_time) {
    // insert database
    $con = connection();
    $sql = "INSERT INTO managers (username, password, first_name, last_name, section_time)
            VALUES ('$username', '$password', '$first_name', '$last_name', '$section_time');";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Insert failed: '.mysqli_error($con));
    }

    // get manager id and return
    $manager_id = mysqli_insert_id($con);
    echo 'Manager with id '.$manager_id.' is inserted.';
    return new Manager($manager_id);
}
?>