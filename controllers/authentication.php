<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/manager.php';

// ----------------------
// authentication description
// ----------------------
// When you want to perform actions such as login, sign up, logout,
// you should instantiate this class and call corresponding methods.
// 

// ----------------------
// attributes
// ----------------------
// $current_user : stores current user's id. Was initiated as NULL.
//  

// ----------------------
// methods
// ----------------------
// login(username, password, db_connection)
// signup(first name, last name, username, password, db_connection)
// logout()



class Authentication {

 	// this variable stores current user's id
 	private $current_user = 'null';

 	public function login($myusername, $mypassword, $con) {

        if (!isset($_SESSION)) {
            session_start();
        }

		if($_SERVER["REQUEST_METHOD"] == "POST") {
      			$encripted_pwd = sha1($mypassword);
			$sql = "SELECT manager_id FROM managers WHERE username = '$myusername' AND password = '$encripted_pwd'";
			$result = mysqli_query($con,$sql);
			$row = mysqli_fetch_array($result);
      
			$count = mysqli_num_rows($result);
      

			// If result matched $myusername and $mypassword, table row must be 1 row		
			if($count == 1) {
				$m = get_manager($row['manager_id']);
				$_SESSION['manager_id'] = $m->get_manager_id();
				return 0;

			} else {
				$error = "Your Login Name or Password is invalid";
				return 1;
			}
		}
	}



	public function signup($first_name, $last_name, $username, $password) {
	
		$encripted_pwd = sha1($password);

		insert_manager($username,$encripted_pwd,$first_name,$last_name,1);

		$con = connection();

		$sql = "SELECT manager_id FROM managers WHERE username = '$username' AND password = '$encripted_pwd'";
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result);
    
		$m = get_manager($row['manager_id']);

        if (!isset($_SESSION)) {
            session_start();
        }

		$_SESSION['manager_id'] = $m->get_manager_id();
	
	} 



	public function logout() {

        if (!isset($_SESSION)) {
            session_start();
        }
		session_destroy();

		//header('Location: ../index.php');

	} 



}



?>
