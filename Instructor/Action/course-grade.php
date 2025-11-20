<?php
session_start();
include "../../Database.php";
include "../../Models/Course.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['course_id'], $_POST['student_id'], $_POST['grade'])) {
    $course_id = $_POST['course_id'];
    $student_id = $_POST['student_id'];
    $grade_map = ['A' => 100, 'B' => 75, 'C' => 65, 'F' => 0];
    $mark = isset($grade_map[$_POST['grade']]) ? $grade_map[$_POST['grade']] : 0;

    $db = new Database();
    $conn = $db->connect();
    $course = new Course($conn);

    // This will either create or update based on whether record exists
    $res = $course->createStudentProgress($course_id, $student_id, $mark);
    echo $res ? "Grade saved successfully" : "Error saving grade";
} else {
    echo "Invalid request";
}