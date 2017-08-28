<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php';

// ----------------------
// Course Description
// ----------------------
// initialize a Course (should not be used explicitly): new Course($course_id)
// set methods: set_course_name_to($course_name)
// increase course count: increase_total_times_been_taught_by($number) return true
// get times_been_taught on week: get_times_been_taught_on($week_number) return mins
// set times_been_taught by number on week number: set_times_been_taught_by($number,
//                                                 $week_number) return true

// ----------------------
// other functions
// ----------------------
// initialize a Course: $course = get_course($course_id);
// insert a course: insert_course($course_name) return new Course($course_name)/false

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
    private $total_times_been_taught;

    // ----------------------
    // constructor
    // ----------------------
    function __construct($course_id) {
        // set connection
        $this->connect_to_db = connection();

        // set course id
        $this->course_id = $course_id;

        // fetch course row
        $sql = "SELECT * 
                FROM courses 
                WHERE course_id=$this->course_id;";
        $result = mysqli_query($this->connect_to_db, $sql);
        $row = mysqli_fetch_assoc($result);

        if (!$result)
            die('Connected failed: '.mysqli_error($this->connect_to_db));

        // set attributes
        $this->course_name = $row['course_name'];
        $this->total_times_been_taught = $row['total_times_been_taught'];
    }

    // ----------------------
    // get functions
    // ----------------------
    public function get_course_id() {
        return $this->course_id;
    }

    public function get_course_name() {
        return $this->course_name;
    }

    public function get_total_times_been_taught() {
        return $this->total_times_been_taught;
    }

    // ----------------------
    // set functions
    // ----------------------
    public function set_course_name_to($course_name) {
        // update database
        $sql = "UPDATE courses
                SET course_name='$course_name'
                WHERE course_id=$this->course_id;";
        $result = mysqli_query($this->connect_to_db, $sql);

        if (!$result)
            die('Update failed: '.mysqli_error($this->connect_to_db));

        // set new result to course_name
        $this->course_name = $course_name;
        return true;
    }

    // ----------------------
    // incrementing total_times_been_taught
    // ----------------------
    public function increase_total_times_been_taught_by($number) {
        // update database
        $new_count = $this->total_times_been_taught + $number;
        $sql = "UPDATE courses
                SET total_times_been_taught=$new_count
                WHERE course_id=$this->course_id;";
        $result = mysqli_query($this->connect_to_db, $sql);

        if (!$result)
            die('Update failed: '.mysqli_error($this->connect_to_db));

        // set new result to total_times_been_taught
        $this->total_times_been_taught = $new_count;
        return true;
    }

    // ----------------------
    // refresh total_times_been_taught
    // ----------------------
    public function refresh_total_times_been_taught() {
        // select database
        $sql = "SELECT * 
                FROM course_sections  
                WHERE course_id=$this->course_id;";
        $result = mysqli_query($this->connect_to_db, $sql);

        if (!$result)
            die('Select failed: '.mysqli_error($this->connect_to_db));

        // sum over the time
        $sum = 0;
        while($row = mysqli_fetch_array($result))
            $sum += $row['times_been_taught'];

        // update total times
        $sql = "UPDATE courses
                SET total_times_been_taught=$sum 
                WHERE course_id=$this->course_id;";

        $result = mysqli_query($this->connect_to_db, $sql);

        if (!$result)
            die('Update failed: '.mysqli_error($this->connect_to_db));

        $this->total_times_been_taught = $sum;
        return $sum;
    }

    // ----------------------
    // get times_been_taught on week #
    // ----------------------
    public function get_times_been_taught_on_with_section($week_number, $section_id) {
        // select database
        $sql = "SELECT * 
                FROM course_sections  
                WHERE course_id=$this->course_id 
                AND week_number=$week_number
                AND section_id=$section_id;";
        $result = mysqli_query($this->connect_to_db, $sql);

        if (!$result)
            die('Select failed: '.mysqli_error($this->connect_to_db));

        // sum over the time
        $sum = 0;
        while($row = mysqli_fetch_array($result))
            $sum += $row['times_been_taught'];
        return $sum;
    }

    // ----------------------
    // get times_been_taught on week #
    // ----------------------
    public function get_times_been_taught_on($week_number) {
        // select database
        $sql = "SELECT * 
                FROM course_sections  
                WHERE course_id=$this->course_id 
                AND week_number=$week_number;";
        $result = mysqli_query($this->connect_to_db, $sql);

        if (!$result)
            die('Select failed: '.mysqli_error($this->connect_to_db));

        // sum over the time
        $sum = 0;
        while($row = mysqli_fetch_array($result))
            $sum += $row['times_been_taught'];
        return $sum;
    }

    // ----------------------
    // set times_been_taught by number on week number
    // ----------------------
    public function set_times_been_taught_by($number, $week_number, $section_id) {
        // select database
        $sql = "SELECT *
                FROM course_sections 
                WHERE course_id=$this->course_id 
                AND week_number=$week_number 
                AND section_id=$section_id;";
        $result = mysqli_query($this->connect_to_db, $sql);
        if (!$result) {
            die('Select failed: '.mysqli_error($this->connect_to_db));
        }

        if (mysqli_fetch_row($result)) { // if exist, update
            // update database
            $sql = "UPDATE course_sections
                    SET times_been_taught=$number 
                    WHERE course_id=$this->course_id 
                    AND week_number=$week_number 
                    AND section_id=$section_id;";
            $result = mysqli_query($this->connect_to_db, $sql);
            if (!$result) {
                die('Update failed: '.mysqli_error($this->connect_to_db));
            }

        } else { // if does not exist, insert
            // insert database
            $sql = "INSERT INTO course_sections (course_id, section_id, times_been_taught, week_number)
                    VALUES ('$this->course_id','$section_id','$number','$week_number');";
            $result = mysqli_query($this->connect_to_db, $sql);
            if (!$result) {
                die('Insert failed: '.mysqli_error($this->connect_to_db));
            }
        }
    }
}

function get_course($course_id) {
    $con = connection();
    $sql = "SELECT * 
            FROM courses 
            WHERE course_id=$course_id;";
    $result = mysqli_query($con, $sql);
    if (mysqli_fetch_row($result))
        return new Course($course_id);
    else
        return null;
}

function insert_course($course_name) {
    // insert database
    $con = connection();
    $sql = "INSERT INTO courses (course_name)
            VALUES ('$course_name');";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Insert failed: '.mysqli_error($con));
    }

    // get course id and return
    echo 'course with name '.$course_name.' is inserted.';
    $sql = "SELECT *
            FROM courses 
            WHERE course_name='$course_name';";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    return new Course($row['course_id']);
}

function list_all_courses() {
    // select database
    $con = connection();
    $sql = "SELECT course_id 
            FROM courses
            ORDER BY course_name;";
    $result = mysqli_query($con, $sql);

    // store into array
    $arr = [];
    while ($row = mysqli_fetch_array($result))
        array_push($arr, get_course($row['course_id']));
    return $arr;
}
?>
