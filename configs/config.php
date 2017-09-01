<?php

function connection() {
    $DB_HOST = 'localhost';
    $DB_NAME = 'peer_education';
    $DB_USER = 'root';
    $DB_PASSWORD = 'qwe123';

    $con = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error());
    return $con;
}


?>
