<?php
session_start();
include "../../Utils/Util.php";
include "../../Database.php";
include "../../Models/Course.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['instructor_id']) && isset($_POST['course_id'])) {
        $course_id = $_POST['course_id'];
        $db = new Database();
        $conn = $db->connect();
        $course = new Course($conn);
        $course->deleteCourse($course_id);
        // You can echo a response or simply end.
    }
}
?>