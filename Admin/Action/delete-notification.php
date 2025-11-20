<?php
session_start();
header('Content-Type: application/json');
require_once "../../Database.php";
require_once "../../Models/Admin.php";

if (isset($_SESSION['admin_id']) && isset($_POST['notification_id'])) {
    $db = new Database();
    $conn = $db->connect();
    $admin = new Admin($conn);
    $success = $admin->deleteNotification($_POST['notification_id']);
    echo json_encode(['status' => $success ? 'success' : 'fail']);
} else {
    echo json_encode(['status' => 'invalid']);
}
?>