<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/configs/config.php';

class Date {
    private $connect_to_db;
    private $date;

    function __construct() {
        $this->connect_to_db = connection();
    }

    public function get_semester() {

    }
    public function get_week() {

    }
}

?>