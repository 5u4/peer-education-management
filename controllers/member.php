<?php
include '../configs/config.php';
?>
<?php
class Member {


    public function get_section_time($id) {
        $sql = "SELECT * FROM managers WHERE $manager_id=$id;";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['section_time']."<br/>";
        }
    }
}
?>