<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php';

class Date {
    private $connect_to_db;
    private $date_id;
    private $semester;
    private $week_number;

    function __construct($date_id) {
        $this->connect_to_db = connection();

        // set date id
        $this->date_id = $date_id;

        // fetch date row
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
        $this->week_number = date("W", $date) - date("W", CURRENT_DATE);
    }

    public function get_semester() {
        return $this->semester;
    }
    public function get_week() {
        return $this->week_number;
    }
}

function get_date($date_id) {
    $con = connection();
    $sql = "SELECT * 
            FROM dates 
            WHERE date_id=$date_id;";
    $result = mysqli_query($con, $sql);

    if (mysqli_fetch_row($result))
        return new Date($date_id);
    else
        return null;
}

function get_last_date_id() {
    $con = connection();
    $sql = "SELECT *
            FROM dates
            ORDER BY date_id DESC;";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['date_id'];
}

function insert_date($date, $semester) {
    $con = connection();
    $sql = "INSERT INTO dates (date, semester)
            VALUES ('$date', '$semester');";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Insert failed: '.mysqli_error($con));
    }
}
?>