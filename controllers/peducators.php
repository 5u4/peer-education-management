<?php
include_once '../configs/config.php';


class peducators {

	// Attributes
	private $peducator_id;
	private $student_id;
	private $preferred_name;
	private $first_name;
	private $last_name;
	private $section_id;



	function __construct($peducator_id) {
		// connection to db
		$con = connection();

		// send query to database
		$sql = "SELECT * FROM managers WHERE peducator_id=$peducator_id;";
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


}


?>
