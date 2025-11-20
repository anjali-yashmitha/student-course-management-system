<?php
session_start();
// ...existing code (if needed)...

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['instructor_id'])) {
        include "../../Database.php";
        include "../../Models/Instructor.php";
        include "../../Models/Course.php";
        $db = new Database();
        $conn = $db->connect();

        $courseModel = new Course($conn);
        $courseModel->deleteByInstructorId($_POST['instructor_id']);

        $model = new Instructor($conn);
        $res = $model->deleteInstructor($_POST['instructor_id']);
        echo $res ? 1 : 0;
    } else {
        echo 0;
    }
}