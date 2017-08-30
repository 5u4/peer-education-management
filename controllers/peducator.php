<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/course.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/section.php';

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
	private $connect_to_db;
	private $is_current;


	// These attributes should be retrieved from tables other than peducators
	private $weekly_contributed_hours;


    	// ----------------------
    	// constructor
    	// ----------------------
	function __construct($pe_id) {
		// connection to db
		$this->connect_to_db = connection();

		// send query to database
		$sql = "SELECT * FROM peducators WHERE peducator_id='$pe_id'";
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
		$this->is_current = $row['is_current'];

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

	public function get_is_current() {
		return $this->is_current;
	}
	
	public function get_all_sections() {
		// Get data from database
		$sql = "SELECT section_id FROM peducator_sections 
		WHERE peducator_id='$this->peducator_id'";
		$result = mysqli_query($this->connect_to_db, $sql);

		$arr = [];
		while ($row = mysqli_fetch_array($result)) {
			array_push($arr, get_section($row['section_id']));
		}

		return $arr;	
	}

	public function get_all_courses() {
		// Get data from database
		$sql = "SELECT course_id FROM peducator_courses 
		WHERE peducator_id='$this->peducator_id'";
		$result = mysqli_query($this->connect_to_db, $sql);

		$arr = [];
		while ($row = mysqli_fetch_array($result)) {
			array_push($arr, get_course($row['course_id']));
		}

		return $arr;

	}

    public function get_all_notes() {
        // Get data from database
        $sql = "SELECT note_id FROM notes 
		WHERE peducator_id='$this->peducator_id'";
        $result = mysqli_query($this->connect_to_db, $sql);

        $arr = [];
        while ($row = mysqli_fetch_array($result)) {
            array_push($arr, get_note($row['note_id']));
        }

        return $arr;

    }

	public function get_contributed_mins($section_id, $week_number) {
		// Get data from database
		$sql = "SELECT contributed_mins FROM peducator_sections 
		WHERE peducator_id='$this->peducator_id' AND section_id = '$section_id'
		AND week_number = '$week_number'";
		$result = mysqli_query($this->connect_to_db, $sql);

		$row = mysqli_fetch_array($result);

		return $row['contributed_mins'];
	}


	// ----------------------
	// setters methods
	// ----------------------

	public function set_student_id($stu_id) {
		// update database
		$sql = "UPDATE peducators 
		SET student_id='$stu_id' WHERE peducator_id='$this->peducator_id'";
		$result = mysqli_query($this->connect_to_db, $sql);

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
		SET preferred_name='$pname' WHERE peducator_id='$this->peducator_id'";
		$result = mysqli_query($this->connect_to_db, $sql);

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
		SET first_name='$fname' WHERE peducator_id='$this->peducator_id'";
		$result = mysqli_query($this->connect_to_db, $sql);

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
		SET last_name='$lname' WHERE peducator_id='$this->peducator_id'";
		$result = mysqli_query($this->connect_to_db, $sql);

		// Update object attributes
		if ($result) {
			$this->last_name = $lname;
			return true;
		}
		return false;
	}

	public function set_is_current($bool) {
		if($bool != 0 && $bool != 1) {
			return;
		}

		// update database
		$sql = "UPDATE peducators 
		SET is_current='$bool' WHERE peducator_id='$this->peducator_id'";
		$result = mysqli_query($this->connect_to_db, $sql);

		// Update object attributes
		if ($result) {
			$this->is_current = $bool;
			return true;
		}
		return false;
	}

	public function set_courses($cour_id) {

		$sql = "INSERT INTO peducator_courses (peducator_id, course_id) 
		VALUES ('$this->peducator_id','$cour_id')";

		$result = mysqli_query($this->connect_to_db, $sql);

		// If the result is false, there are two possibilities:
		// (1) The course does not exist. Please check courses table.
		// (2) This PE already has this course on record, please check PE_course table.
		if($result) {
			return true;
		} else {
			return false;
		}
	}

	public function delete_courses($course_id) {
		$sql = "DELETE FROM peducator_courses 
				WHERE course_id=$course_id
				AND peducator_id=$this->peducator_id;";
		$result = mysqli_query($this->connect_to_db, $sql);

		if($result) {
			return true;
		} else {
			return false;
		}
	}

	public function set_contributed_mins($mins, $sec_id, $weeknum) {
		//		
		// Check if the data already exist in database.
		//
		$check_sql = "SELECT * FROM peducator_sections 
		WHERE peducator_id = '$this->peducator_id' 
		AND section_id = '$sec_id' 
		AND week_number = '$weeknum'";

		$check_result = mysqli_query($this->connect_to_db, $check_sql);
		
		if (!$check_result) {
			die(mysqli_error($this->connect_to_db));
		}
			
		//
		// If the data already exist, we update the data.
		// If the data does not exist, we insert new data.
		//

		if(mysqli_num_rows($check_result) != 0) {
			//
			// If the data exist.
			//

			$sql = "UPDATE peducator_sections 
			SET contributed_mins='$mins' 
			WHERE peducator_id='$this->peducator_id' 
			AND section_id = '$sec_id' 
			AND week_number = '$weeknum'";

			$result = mysqli_query($this->connect_to_db, $sql);

			if (!$result) {
				die( mysqli_error($this->connect_to_db));
			}
			if($result) {
				return true;
			} else {
				return false;
			}
		} else {
			//
			// If the data does not exist.
			//

			$sql = "INSERT INTO peducator_sections 
			(peducator_id, section_id, week_number, contributed_mins) 
			VALUES ('$this->peducator_id','$sec_id', '$weeknum', '$mins')";

			$result = mysqli_query($this->connect_to_db, $sql);

			if (!$result) {
				die( mysqli_error($this->connect_to_db));
			}

			if($result) {
				return true;
			} else {
				return false;
			}
		}
	}

	public function delete_peducator() {
        $sql = "DELETE FROM peducators
                WHERE peducator_id=$this->peducator_id;";
        $result = mysqli_query($this->connect_to_db, $sql);
	}

} // end of peducators class

function get_peducator($peducator_id) {
    $con = connection();
    $sql = "SELECT * 
            FROM peducators 
            WHERE peducator_id='$peducator_id'";
    $result = mysqli_query($con, $sql);
    if (mysqli_fetch_row($result))
        return new Peducator($peducator_id);
    else
        return null;
}


function Peducator_add_pe($peducator_id, $student_id, $preferred_name,
		$first_name, $last_name, $is_current) {
	
	if(!empty($peducator_id)) {
		echo 'New PE ID will be created by system. Do not enter for this.';
		return false;
	}

	if(empty($student_id) 
	|| empty($preferred_name) || empty($first_name) 
	|| empty($last_name)) {
		echo 'Please fill out the form properly.';
		return false;
	}

	// -------------------------------------------------------
	// We do not use !empty() here for $is_current because
	// if $is_current is set to 0, !empty() will treat it 
	// as empty and the update will not happen.
	// -------------------------------------------------------
	if($is_current!=0 && $is_current!=1) {
		echo 'Is current only accepts 1 or 0.';
		return false;
	}

	$con = connection();

	$check_sql = "SELECT * FROM peducators 
	WHERE student_id = '$student_id'";
	$check_result = mysqli_query($con, $check_sql);
	
	if(mysqli_num_rows($check_result) != 0) {
		echo 'This peer educator already exists.';
		return false;
	}

	$sql = "INSERT INTO peducators 
		(student_id,preferred_name,first_name,last_name, is_current) 
		VALUES ('$student_id',
		'$preferred_name','$first_name', 
		'$last_name', '$is_current')";

		$result = mysqli_query($con, $sql);

		if($result) {
			echo 'New peer educator has been created.';
			return true;
		} else {
			echo 'Failed.';
			return false;
		}

}


function Peducator_update_pe($peducator_id, $student_id, $preferred_name, 
		$first_name, $last_name, $is_current) {
	
	$con = connection();

	if(empty($peducator_id) && empty($student_id)) {
		echo 'You must provide either a peer educator ID or a student ID to do update.';
		return false;
	}

	if(!empty($peducator_id)) {
		$check_sql = "SELECT * FROM peducators 
		WHERE peducator_id = '$peducator_id'";
		$check_result = mysqli_query($con, $check_sql);
	} else {
		$check_sql = "SELECT * FROM peducators 
		WHERE student_id = '$student_id'";
		$check_result = mysqli_query($con, $check_sql);
	}

	if(mysqli_num_rows($check_result) == 0) {
		echo 'This peer educator does not exist.';
		return false;
	}

	// ------------------------------------
	// Check if PE ID matches Student ID
	// ------------------------------------
	if(!empty($peducator_id) && !empty($student_id)) {	
		$row = mysqli_fetch_array($check_result);
		if($row['peducator_id'] != $peducator_id || $row['student_id'] != $student_id) {
			echo 'The PE ID does not match Student ID.';
			return false;
		}
		
		// Get PE ID for instant object
		$pe_object_id = $row['peducator_id'];
	} else {
		// Get PE ID for instant object
		$row = mysqli_fetch_array($check_result);
		$pe_object_id = $row['peducator_id'];
	}


	// ------------------------------------
	// Start to update PE information
	// ------------------------------------
	$pe = new Peducator($pe_object_id);

	if(!empty($preferred_name)) {
		$result_code = $pe->set_preferred_name($preferred_name);
		if($result_code == false) {
			echo 'Update preferred name failed.';
			return false;
		}
	}

	if(!empty($first_name)) {
		$result_code = $pe->set_first_name($first_name);
		if($result_code == false) {
			echo 'Update first name failed.';
			return false;
		}
	}

	if(!empty($last_name)) {
		$result_code = $pe->set_last_name($last_name);
		if($result_code == false) {
			echo 'Update last name failed.';
			return false;
		}
	}

	// -------------------------------------------------------
	// We do not use !empty() here for $is_current because
	// if $is_current is set to 0, !empty() will treat it 
	// as empty and the update will not happen.
	// -------------------------------------------------------
	if($is_current == 1 || $is_current == 0) {
		$result_code = $pe->set_is_current($is_current);
		if($result_code == false) {
			echo 'Update Is current? failed.';
			return false;
		}
	}
	
	echo 'Update success.';
	return true;

}


function Peducator_delete_pe($peducator_id, $student_id) {
	
	$con = connection();

	if(empty($peducator_id) && empty($student_id)) {
		echo 'You must provide either a peer educator ID or a student ID to do delete.';
		return false;
	}

	$check_sql = "SELECT * FROM peducators 
	WHERE peducator_id = '$peducator_id' OR student_id = '$student_id'";
	$check_result = mysqli_query($con, $check_sql);
	
	if(mysqli_num_rows($check_result) == 0) {
		echo 'This peer educator does not exist.';
		return false;
	}

	// ------------------------------------
	// Check if PE ID matches Student ID
	// ------------------------------------
	if(!empty($peducator_id) && !empty($student_id)) {	
		$row = mysqli_fetch_array($check_result);
		if($row['peducator_id'] != $peducator_id || $row['student_id'] != $student_id) {
			echo 'The PE ID does not match Student ID.';
			return false;
		}
	}

	// ------------------------------------
	// Start to delete PE 
	// ------------------------------------

	$sql = "DELETE FROM peducators WHERE peducator_id='$peducator_id' OR student_id='$student_id'";

	$result = mysqli_query($con, $sql);

	if($result) {
		echo 'The PE has been deleted.';
		return true;
	} else {
		echo 'Delete failed.';
		return false;
	}

}


function list_all_pe() {
	// select database
	$con = connection();
	$sql = "SELECT peducator_id FROM peducators";
	$result = mysqli_query($con, $sql);

	// store into array
	$arr = [];
	while ($row = mysqli_fetch_array($result)) {
		array_push($arr, get_peducator($row['peducator_id']));
	}

	return $arr;
}


function list_all_current_pe() {
	// select database
	$con = connection();
	$sql = "SELECT peducator_id FROM peducators WHERE is_current = '1'";
	$result = mysqli_query($con, $sql);

	// store into array
	$arr = [];
	while ($row = mysqli_fetch_array($result)) {
		array_push($arr, get_peducator($row['peducator_id']));
	}

	return $arr;
}

function list_all_not_current_pe() {
	// select database
	$con = connection();
	$sql = "SELECT peducator_id FROM peducators WHERE is_current = '0'";
	$result = mysqli_query($con, $sql);

	// store into array
	$arr = [];
	while ($row = mysqli_fetch_array($result)) {
		array_push($arr, get_peducator($row['peducator_id']));
	}

	return $arr;
}

function list_all_pe_on($section_id) {
	// select database
	$con = connection();
	$sql = "SELECT peducator_id FROM peducator_sections WHERE section_id = '$section_id'";
	$result = mysqli_query($con, $sql);

	// store into array
	$arr = [];
	while ($row = mysqli_fetch_array($result)) {
		array_push($arr, get_peducator($row['peducator_id']));
	}

	return $arr;
}


?>
