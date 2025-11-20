<?php
session_start();
header('Content-Type: application/json');

if (isset($_POST['course_id'])) {
    include "../../Database.php";
    include "../../Models/Course.php";

    $db = new Database();
    $db_conn = $db->connect();
    $course = new Course($db_conn);

    $result = $course->deleteCourse($_POST['course_id']);
    if ($result) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete course.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No course id provided.']);
}