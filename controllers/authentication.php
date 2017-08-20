<?php

// https://www.tutorialspoint.com/php/php_mysql_login.htm

include_once '../configs/config.php';

class Authentication {

  // this variable stores current user's id
  private $current_user = 'null';

  public function login($myusername, $mypassword, $con) {

    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $sql = "SELECT manager_id FROM managers WHERE username = '$myusername' AND password = '$mypassword'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result);
      
      $count = mysqli_num_rows($result);
      
    // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
        $_SESSION['current_username'] = $myusername;
	$current_user = $row['manager_id'];
	$_SESSION['manager_id'] = $current_user;
        return 0;

      } else {
        $error = "Your Login Name or Password is invalid";
	return 1;
      }
    }
  } // end of login()



  public function SignUp($first_name, $last_name, $username, $password, $con) {

	  $query = mysqli_query($con, "SELECT * FROM managers WHERE username = '$username'");

	  if(mysqli_fetch_array($query) == 0)
	  {
            	// Creating new user..
		$query = "INSERT INTO managers (first_name,last_name,username,password) VALUES ('$first_name','$last_name','$username','$password')";
		$data = mysqli_query($con, $query);
		if($data)
		{
	 	  return 0;
		} else {
		  echo 'Failed to create new user.';
		  return 1;
		}
		
	  }
	  else
	  {
	    echo 'User already exists.';
	    return 444;
	  }

} // end of SignUp()


  public function logout() {
	
	session_start();
	session_destroy();

	header('Location: ../index.php');

} // end of logout()



} // end of Authentication class



?>
