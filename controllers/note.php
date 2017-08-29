<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php';

// ----------------------
// Note description
// ----------------------
// initialize a Note (should not be used explicitly): new Note($note_id)
// get methods: get_attributes() returns attributes
// set methods: set_attributes_to($new_value) return true/false

// ----------------------
// other functions
// ----------------------
// initialize a note: $note = get_note($note_id);
// insert a note into database: insert_note($manager_id, $peducator_id,
//                              $content, $note_time) returns new Note

class Note {
    // ----------------------
    // database connection
    // ----------------------
    private $connect_to_db;

    // ----------------------
    // Note attributes
    // ----------------------
    private $note_id;
    private $manager_id;
    private $peducator_id;
    private $content;
    private $note_time;

    // ----------------------
    // constructor
    // ----------------------
    function __construct($note_id) {
        // set connection
        $this->connect_to_db = connection();

        // set manager id
        $this->note_id = $note_id;

        // fetch manager row
        $sql = "SELECT * 
                FROM notes 
                WHERE note_id=$this->note_id;";
        $result = mysqli_query($this->connect_to_db, $sql);
        $row = mysqli_fetch_assoc($result);

        // set attributes
        $this->manager_id = $row['manager_id'];
        $this->peducator_id = $row['peducator_id'];
        $this->content = $row['content'];
        $this->note_time = $row['note_time'];
    }

    // ----------------------
    // get functions
    // ----------------------
    public function get_manager_id() {
        return $this->manager_id;
    }

    public function get_peducator_id() {
        return $this->peducator_id;
    }

    public function get_content() {
        return $this->content;
    }

    public function get_note_time() {
        return $this->note_time;
    }

    // ----------------------
    // set functions
    // ----------------------
    public function set_content_to($content) {
        // update database
        $sql = "UPDATE notes 
                SET content='$content' 
                WHERE note_id=$this->note_id;";
        $result = mysqli_query($this->connect_to_db, $sql);

        // set new content
        if ($result) {
            $this->content = $content;
            return true;
        }
        return false;
    }
}

function get_note($note_id) {
    $con = connection();
    $sql = "SELECT * 
            FROM notes
            WHERE note_id=$note_id;";
    $result = mysqli_query($con, $sql);
    if (mysqli_fetch_row($result))
        return new Note($note_id);
    else
        return null;
}


?>
