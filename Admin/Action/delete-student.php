<?php
session_start();
require_once "../../Controller/Admin/Student.php";

if (isset($_POST['student_id']) && isset($_SESSION['admin_id'])) {
    $student_id = $_POST['student_id'];

    // Set proper headers
    header('Content-Type: application/json');

    try {
        $res = deleteStudent($student_id);
        if ($res) {
            echo json_encode(['status' => 'success']);
        } else {
            error_log("Failed to delete student ID: " . $student_id);
            echo json_encode(['status' => 'error', 'message' => 'Database delete failed']);
        }
    } catch (Exception $e) {
        error_log("Error deleting student: " . $e->getMessage());
        echo json_encode(['status' => 'error', 'message' => 'Server error']);
    }
    exit();
} else {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    exit();
}
