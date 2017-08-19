<?php

// https://www.tutorialspoint.com/php/php_mysql_login.htm

include_once '../configs/config.php';

class Authentication {


  function login() {

    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id FROM managers WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      
    // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
        $_SESSION['current_user'] = $myusername;
         
        header("location: index.php");
      } else {
        $error = "Your Login Name or Password is invalid";
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
	echo "YOUR REGISTRATION IS COMPLETED.";
	}
} // end of NewUser()



  function SignUp($con) {

	if(!empty($_POST['username']) && !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['password']) && !empty($_POST['cpassword']))   //checking the 'user' name which is from Sign-Up.html, is it empty or have some text
	{
	  $query = mysqli_query($con, "SELECT * FROM managers WHERE username = '$_POST[username]' AND password = '$_POST[password]'") or die(mysqli_error());

	  if(!$row = mysqli_fetch_array($query) or die(mysqli_error()))
	  {
            $this->NewUser($con);
	  }
	  else
	  {
            echo "User already exists.";
	  }

	}
	else // if the form was not filled properly
	{
          echo "Please fill out the form properly.";
	}


} // end of SignUp()



} // end of Authentication class



?>
