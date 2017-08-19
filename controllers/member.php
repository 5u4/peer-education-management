<?php
include_once '../configs/config.php';

class Member {
    private $student_id;
    private $prefername;
    private $firstname;
    private $lastname;
    private $section_time;

    public function get_section_time($student_id) {
        $sql = "SELECT * FROM  WHERE $student_id=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL statement failed";
        } else {
            mysqli_stmt_bind_param($stmt, "c", $student_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result)) {
                echo $row['user_uid']."<br />";
            }
        }
    }
}