<?php

// https://www.tutorialspoint.com/php/php_mysql_login.htm

class Authentication {
  public function login() {
    echo "<?php include("config.php"); ?>";
    echo "<?php session_start(); ?>"

  if($_SERVER["REQUEST_METHOD"] == "POST") {
      
    $myusername = mysqli_real_escape_string($db,$_POST['username']);
    $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
    $sql = "SELECT id FROM managers WHERE username = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];
      
    $count = mysqli_num_rows($result);
      
    // If result matched $myusername and $mypassword, table row must be 1 row
		
    if($count == 1) {
      session_register("myusername");
      $_SESSION['login_user'] = $myusername;
         
      header("location: index.php");
    }else {
      $error = "Your Login Name or Password is invalid";
    }
    }
}

}

}
?>


}





?>
