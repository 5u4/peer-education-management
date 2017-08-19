<?php
include_once '../configs/config.php';

class Member {
    private $student_id;
    private $prefername;
    private $firstname;
    private $lastname;
    private $section_time;

    public function get_section_time($id) {
        $sql = "SELECT * FROM members WHERE $student_id=$id;";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['section_time']."<br/>";
        }
    }
}
?>