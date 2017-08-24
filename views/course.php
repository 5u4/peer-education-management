<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <?php include_once '../controllers/course.php' ?>
</head>
<body>
<h1>Courses Record for Week __</h1>
<table>
    <tr>
        <th>Course Name</th>
        <th>times been taught</th>
    </tr>
    <?php
    $courses = list_all_courses();
    foreach ($courses as $course) {
        echo '<tr>';
        echo '<td>'.$course->get_course_name().'</td>';
        echo '<td>'.$course->get_times_been_taught_on(1).'</td>';
        echo '<td>'.'<input type="number" name="set to # of times">'.'</td>';
        echo '<td>'.'<input type="submit" value="submit">'.'</td>';
        echo '</tr>';
    }
    ?>




</table>
</body>
</html>