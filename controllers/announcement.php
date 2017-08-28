<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php';

// ----------------------
// Announcement description
// ----------------------
// initialize an Announcement (should not be used explicitly): new Announcement($announcement_id)
// get methods: get_attributes() returns attributes
// set methods: set_attributes_to($new_value) returns true/false

// ----------------------
// other functions
// ----------------------
// initialize an Announcement: $announcement = get_announcement($announcement_id);
// DELETE - insert an announcement into database: insert_announcement($manager_id, $content)
//                                       returns new Announcement

class Announcement {
    // ----------------------
    // database connection
    // ----------------------
    private $connect_to_db;

    // ----------------------
    // Announcement attributes
    // ----------------------
    private $announcement_id;
    private $manager_id;
    private $content;
    private $announcement_time;

    // ----------------------
    // constructor
    // ----------------------
    function __construct($announcement_id) {
        // set connection
        $this->connect_to_db = connection();

        // set announcement id
        $this->announcement_id = $announcement_id;

        // fetch announcement row
        $sql = "SELECT * 
                FROM announcements 
                WHERE announcement_id=$this->announcement_id;";
        $result = mysqli_query($this->connect_to_db, $sql);
        $row = mysqli_fetch_assoc($result);

        // set attributes
        $this->manager_id = $row['manager_id'];
        $this->content = $row['content'];
        $this->announcement_time = $row['announcement_time'];
    }

    // ----------------------
    // get functions
    // ----------------------
    public function get_manager_id() {
        return $this->manager_id;
    }

    public function get_content() {
        return $this->content;
    }

    public function get_announcement_time() {
        return $this->announcement_time;
    }

    // ----------------------
    // set functions
    // ----------------------
    public function set_content_to($content) {
        // update database
        $sql = "UPDATE announcements 
                SET content='$content' 
                WHERE announcement_id=$this->announcement_id;";
        $result = mysqli_query($this->connect_to_db, $sql);

        // set new content
        if ($result) {
            $this->content = $content;
            return true;
        }
        return false;
    }
}

function get_announcement($announcement_id) {
    $con = connection();
    $sql = "SELECT * 
            FROM announcements 
            WHERE announcement_id=$announcement_id;";
    $result = mysqli_query($con, $sql);
    if (mysqli_fetch_row($result))
        return new Announcement($announcement_id);
    else
        return null;
}

function insert_announcement($manager_id, $content) {
    // insert database
    $con = connection();
    $sql = "INSERT INTO announcements (manager_id, content)
            VALUES ('$manager_id', '$content');";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Insert failed: '.mysqli_error($con));
    }

    // get announcement id and return
    $announcement_id = mysqli_insert_id($con);
    echo 'Announcement with id '.$announcement_id.' is inserted.';
    return new Announcement($announcement_id);
}
?>
