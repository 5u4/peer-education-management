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


class Peducator {

	// Attributes
	private $peducator_id;
	private $student_id;
	private $preferred_name;
	private $first_name;
	private $last_name;
	private $section_id;
	private $connect_to_db;


	// These attributes should be retrieved from tables other than peducators
	private $courses;
	private $weekly_contributed_hours;


    	// ----------------------
    	// constructor
    	// ----------------------
	function __construct($pe_id) {
		// connection to db
		$this->connect_to_db = connection();

		// send query to database
		$sql = "SELECT * FROM peducators WHERE peducator_id=$pe_id;";
        	$result = mysqli_query($this->connect_to_db, $sql);
        	$row = mysqli_fetch_assoc($result);

		// check if the peducator exists
		if($row == 0) {
			echo 'This peer educator does not exist.';
			return null;
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
		// update database
		$sql = "UPDATE peducators 
		SET student_id='$stu_id' WHERE peducator_id=$this->peducator_id;";
		$result = mysqli_query($this->connection_to_db, $sql);

		// Update object attributes
		if ($result) {
			$this->student_id = $stu_id;
			return true;
		}
		return false;
	}

	public function set_preferred_name($pname) {
		// update database
		$sql = "UPDATE peducators 
		SET preferred_name='$pname' WHERE peducator_id=$this->peducator_id;";
		$result = mysqli_query($this->connection_to_db, $sql);

		// Update object attributes
		if ($result) {
			$this->preferred_name = $pname;
			return true;
		}
		return false;
	}

	public function set_first_name($fname) {
		// update database
		$sql = "UPDATE peducators 
		SET first_name='$fname' WHERE peducator_id=$this->peducator_id;";
		$result = mysqli_query($this->connection_to_db, $sql);

		// Update object attributes
		if ($result) {
			$this->first_name = $fname;
			return true;
		}
		return false;
	}

	public function set_last_name($lname) {
		// update database
		$sql = "UPDATE peducators 
		SET last_name='$lname' WHERE peducator_id=$this->peducator_id;";
		$result = mysqli_query($this->connection_to_db, $sql);

		// Update object attributes
		if ($result) {
			$this->last_name = $lname;
			return true;
		}
		return false;
	}

	public function set_section_id($sec_id) {
		// update database
		$sql = "UPDATE peducators 
		SET section_id='$sec_id' WHERE peducator_id=$this->peducator_id;";
		$result = mysqli_query($this->connection_to_db, $sql);

		// Update object attributes
		if ($result) {
			$this->section_id = $sec_id;
			return true;
		}
		return false;
	}

	public function set_courses() {
		
	}

	public function set_weekly_contributed_hours() {
		
	}

} // end of peducators class

function get_peducator($peducator_id) {
    $con = connection();
    $sql = "SELECT * 
            FROM peducators 
            WHERE peducator_id=$peducator_id;";
    $result = mysqli_query($con, $sql);
    if (mysqli_fetch_row($result))
        return new Peducator($peducator_id);
    else
        return null;
}

?>
