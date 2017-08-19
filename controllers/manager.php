<?php
include '../configs/config.php';

class Manager {
    public function get_section_time($id) {
        $sql = "SELECT * FROM managers WHERE manager_id=$id;";
        $result = mysqli_query(connection(), $sql);
        $row = mysqli_fetch_assoc($result);
        echo $row['section_time'];
    }
}
?>