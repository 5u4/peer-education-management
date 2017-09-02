<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/announcement.php';

// ----------------------
// Manager description
// ----------------------
// initialize a Manager (should not be used explicitly): new Manager($manager_id)
// get methods: get_attributes() returns attributes
// set methods: set_attributes_to($new_value) return true/false

// ----------------------
// other functions
// ----------------------
// initialize a Manager: $manager = get_manager($manager_id);
// insert a manager into database: insert_manager($username, $password, $first_name,
//                                 $last_name, $section_id) returns new Manager

// ----------------------
// announcement interaction
// ----------------------
// create an announcement: insert_announcement($content) return new Announcement($announcement_id)
// check if current_user posted the announcement: can_edit($announcement) return true/false

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
    private $section_id;

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
        $this->section_id = $row['section_id'];
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

    public function get_section_id() {
        return $this->section_id;
    }

    public function get_permission() { // testing function | for further application expansion
	// This will be done on next version.
        return 3;
    }

    // ----------------------
    // set functions
    // ----------------------
    public function set_username_to($username) {
        // update database
        $sql = "UPDATE managers 
                SET username='$username' 
                WHERE manager_id=$this->manager_id;";
        $result = mysqli_query($this->connect_to_db, $sql);

        // set new username
        if ($result) {
            $this->username = $username;
            return true;
        }
        return false;
    }

    public function set_first_name_to($first_name) {
        // update database
        $sql = "UPDATE managers 
                SET first_name='$first_name' 
                WHERE manager_id=$this->manager_id;";
        $result = mysqli_query($this->connect_to_db, $sql);

        // set new first_name
        if ($result) {
            $this->first_name = $first_name;
            return true;
        }
        return false;
    }

    public function set_last_name_to($last_name) {
        // update database
        $sql = "UPDATE managers 
                SET last_name='$last_name' 
                WHERE manager_id=$this->manager_id;";
        $result = mysqli_query($this->connect_to_db, $sql);

        // set new last_name
        if ($result) {
            $this->last_name = $last_name;
            return true;
        }
        return false;
    }

    public function set_section_id_to($section_id) {
        // update database
        $sql = "UPDATE managers 
                SET section_id=$section_id 
                WHERE manager_id=$this->manager_id;";
        $result = mysqli_query($this->connect_to_db, $sql);

        // set new section_id
        if ($result) {
            $this->section_id = $section_id;
            return true;
        }
        return false;
    }

    // ----------------------
    // announcement interaction
    // ----------------------
    public function insert_announcement($content) {
        // insert database
        $sql = "INSERT INTO announcements (manager_id, content)
                VALUES ('$this->manager_id', '$content');";
        $result = mysqli_query($this->connect_to_db, $sql);
        if (!$result) {
            die('Insert failed: '.mysqli_error($this->connect_to_db));
        }

        // get announcement id and return
        $announcement_id = mysqli_insert_id($this->connect_to_db);
        echo 'Announcement with id '.$announcement_id.' is inserted.';
        return new Announcement($announcement_id);
    }

    public function can_edit($announcement) {
        if ($this->manager_id == $announcement->get_manager_id())
            return true;
        return false;
    }

    public function edit_announcement($announcement, $content) {
        if (!$this->can_edit($announcement))
            return false;
        $announcement->set_content_to($content);
        return true;
    }


    public function insert_note($peducator_id, $content) {
    // insert database
    $con = connection();
    $sql = "INSERT INTO notes (manager_id, peducator_id, content) 
    VALUES ('$this->manager_id', '$peducator_id', '$content');";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Insert failed: '.mysqli_error($con));
    }

    // get note id and return
    $note_id = mysqli_insert_id($con);
    echo 'Note with id '.$note_id.' is inserted.';
    return new Note($note_id);
    }



}

function get_manager($manager_id) {
    $con = connection();
    $sql = "SELECT * 
            FROM managers 
            WHERE manager_id=$manager_id;";
    $result = mysqli_query($con, $sql);
    if (mysqli_fetch_row($result))
        return new Manager($manager_id);
    else
        return null;
}

function insert_manager($username, $password, $first_name, $last_name, $section_id) {
    // insert database
    $con = connection();
    $sql = "INSERT INTO managers (username, password, first_name, last_name, section_id)
            VALUES ('$username', '$password', '$first_name', '$last_name', '$section_id');";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Insert failed: '.mysqli_error($con));
    }

    // get manager id and return
    $manager_id = mysqli_insert_id($con);
    echo 'Manager with id '.$manager_id.' is inserted.';
    return new Manager($manager_id);
}

function list_all_managers() {
    // select database
    $con = connection();
    $sql = "SELECT manager_id  
            FROM managers;";
    $result = mysqli_query($con, $sql);

    // store into array
    $arr = [];
    while ($row = mysqli_fetch_array($result))
        array_push($arr, get_manager($row['manager_id']));
    return $arr;
}
?>
