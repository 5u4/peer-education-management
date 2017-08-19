<?php
<<<<<<< HEAD

define('DB_HOST', 'localhost');
define('DB_NAME', 'peer_education');
define('DB_USER','root');
define('DB_PASSWORD','qwe123');

$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error());
=======
function connection() {
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'peer_education');
    define('DB_USER','root');
    define('DB_PASSWORD','qwe123');

    $con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error());
    return $con;
}
>>>>>>> fb3c7a7fe635745e1e51fa50cb25e9c5cee7732c

?>
