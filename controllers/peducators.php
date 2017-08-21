<?php
include_once '../configs/config.php';

// ----------------------
// peducators description
// ----------------------
// This class represents peer educators.
// We should add code to retrieve courses and weekly contributed hours
// from other tables. The setters of these two attributes have not been
// implemented either.
//


class peducators {

	// Attributes
	private $peducator_id;
	private $student_id;
	private $preferred_name;
	private $first_name;
	private $last_name;
	private $section_id;


	// These attributes should be retrieved from tables other than peducators
	private $courses;
	private $weekly_contributed_hours;


    	// ----------------------
    	// constructor
    	// ----------------------
	function __construct($pe_id) {
		// connection to db
		$con = connection();

		// send query to database
		$sql = "SELECT * FROM peducators WHERE peducator_id=$pe_id;";
        	$result = mysqli_query($con, $sql);
        	$row = mysqli_fetch_assoc($result);

		// check if the peducator exists
		if($row == 0) {
			echo 'This peer educator does not exist.';
			return 2;
		}

		// assign values to attributes
		$this->peducator_id = $row['peducator_id'];
        	$this->student_id = $row['student_id'];
        	$this->preferred_name = $row['preferred_name'];
       		$this->first_name = $row['first_name'];
		$this->last_name = $row['last_name'];
		$this->section_id = $row['section_id'];
	} // end of __construct()


	// ----------------------
	// methods
	// ----------------------

	// ----------------------
	// getters methods
	// ----------------------

	public function get_peducator_id() {
		return $this->peducator_id;
	}

	public function get_student_id() {
		return $this->student_id;
	}

	public function get_preferred_name() {
		return $this->preferred_name;
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

	public function get_courses() {
		return $this->courses;
	}

	public function get_weekly_contributed_hours() {
		return $this->weekly_contributed_hours;
	}


	// ----------------------
	// setters methods
	// ----------------------

	public function set_student_id($stu_id) {
		$this->student_id = $stu_id;
	}

	public function set_preferred_name($pname) {
		$this->preferred_name = $pname;
	}

	public function set_first_name($fname) {
		$this->first_name = $fname;
	}

	public function set_last_name($lname) {
		$this->last_name = $lname;
	}

	public function set_section_id($sec_id) {
		$this->section_id = $sec_id;
	}

	public function set_courses() {
		
	}

	public function set_weekly_contributed_hours() {
		
	}

} // end of peducators class


?>
