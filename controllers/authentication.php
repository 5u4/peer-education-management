<?php

// https://www.tutorialspoint.com/php/php_mysql_login.htm

include_once '../configs/config.php';

class Authentication {

  // this variable stores current user's id
  private $current_user = 'null';

  function login($myusername, $mypassword, $con) {

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


  function NewUser($con) {

	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$username = $_POST['username'];
	$password =  $_POST['password'];
	$query = "INSERT INTO managers (first_name,last_name,username,password) VALUES ('$first_name','$last_name','$username','$password')";
	$data = mysqli_query($con, $query) or die(mysqli_error());
	if($data)
	{
	  return 0;
	} else {
	  echo 'Failed to create new user.';	
	}
} // end of NewUser()



  function SignUp($con) {

	if(!empty($_POST['username']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['password']) && !empty($_POST['cpassword']))   //checking the 'user' name which is from Sign-Up.html, is it empty or have some text
	{

	  // check if confirm password is correct
	  if($_POST['password'] != $_POST['cpassword']) {
	    echo 'Please confirm your password.';
	    return 1;
	  }



	  $query = mysqli_query($con, "SELECT * FROM managers WHERE username = '$_POST[username]' AND password = '$_POST[password]'") or die(mysqli_error());

	  if(!$row = mysqli_fetch_array($query) or die(mysqli_error()))
	  {
            if($this->NewUser($con) == 0) {
		return 0;
	    }
	  }
	  else
	  {
            echo "User already exists.";
	    return 1;
	  }

	}
	else // if the form was not filled properly
	{
          echo "Please fill out the form properly.";
	  return 1;
	}


} // end of SignUp()



} // end of Authentication class



?>
