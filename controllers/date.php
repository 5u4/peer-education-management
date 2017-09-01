<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php';

class Date {
    private $connect_to_db;
    private $date_id;
    private $semester;
    private $week_number;

    function __construct($date_id) {
        $this->connect_to_db = connection();

        // set course id
        $this->date_id = $date_id;

        // fetch course row
        $sql = "SELECT * 
                FROM dates 
                WHERE date_id=$this->date_id;";
        $result = mysqli_query($this->connect_to_db, $sql);
        $row = mysqli_fetch_assoc($result);

        if (!$result)
            die('Connected failed: '.mysqli_error($this->connect_to_db));

        // set attributes
        $this->semester = $row['semester'];
        $date = $row['date'];

    }

    public function get_semester() {
        return $this->semester;
    }
    public function get_week() {
        return $this->week_number;
    }
}

?>