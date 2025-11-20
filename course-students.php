<?php
session_start();
require_once("config.php");

// Check if user is logged in and has appropriate permissions
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'instructor') {
    header("Location: login.php");
    exit();
}

// Get course ID from URL
$course_id = isset($_GET['course_id']) ? intval($_GET['course_id']) : 0;

// Verify course exists and user has access
$stmt = $conn->prepare("SELECT course_name FROM courses WHERE id = :course_id AND instructor_id = :instructor_id");
$stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
$stmt->bindParam(':instructor_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch();

if (!$result) {
    header("Location: dashboard.php");
    exit();
}

$course = $result;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Course Students - <?php echo htmlspecialchars($course['course_name']); ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('includes/header.php'); ?>

    <div class="container">
        <h1>Students Enrolled in <?php echo htmlspecialchars($course['course_name']); ?></h1>

        <div class="search-box"></div>
        <input type="text" id="studentSearch" placeholder="Search students...">
    </div>

    <div class="student-list">
        <?php
        $stmt = $conn->prepare("
                SELECT u.id, u.username, u.email, u.first_name, u.last_name, e.enrollment_date
                FROM users u
                JOIN enrollments e ON u.id = e.user_id
                WHERE e.course_id = :course_id
                ORDER BY u.last_name, u.first_name
            ");
        $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        $stmt->execute();
        $students = $stmt->fetchAll();

        if (count($students) > 0) {
            foreach ($students as $student) {
                echo '<div class="student-card">';
                echo '<h3>' . htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) . '</h3>';
                echo '<p>Email: ' . htmlspecialchars($student['email']) . '</p>';
                echo '<p>Enrolled: ' . date('M d, Y', strtotime($student['enrollment_date'])) . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>No students enrolled in this course yet.</p>';
        }
        ?>
    </div>
    </div>

    <script>
        document.getElementById('studentSearch').addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            const students = document.querySelectorAll('.student-card');

            students.forEach(student => {
                const text = student.textContent.toLowerCase();
                student.style.display = text.includes(searchTerm) ? 'block' : 'none';
            });
        });
    </script>
</body>

</html>