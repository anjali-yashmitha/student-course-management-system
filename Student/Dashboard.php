<?php
session_start();
include "../Utils/Util.php";
require_once "../Database.php";
require_once "../Models/Admin.php";
require_once "../Models/Course.php";

if (
    isset($_SESSION['username']) &&
    isset($_SESSION['student_id'])
) {
    $title = "DreamAcademy - Dashboard";
    include "inc/Header.php";

    $db = new Database();
    $conn = $db->connect();
    $adminModel = new Admin($conn);
    $notifications = $adminModel->getAllNotifications();
    $courseModel = new Course($conn);
    $student_id = $_SESSION['student_id'];
    $enrolledCourses = $courseModel->getEnrolledCoursesWithGrades($student_id);

    function mapProgressToGrade($progress)
    {
        if ($progress >= 90)
            return "A";
        if ($progress >= 75)
            return "B";
        if ($progress >= 65)
            return "C";
        return "F";
    }
    ?>
    <div class="d-flex">
        <?php include "inc/NavBar.php"; ?>
        <div class="main-content">
            <div class="row">
                <!-- Enrolled Courses Column -->
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0"><i class="fa fa-graduation-cap me-2"></i>My Enrolled Courses</h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                <?php if (!empty($enrolledCourses)) { ?>
                                    <?php foreach ($enrolledCourses as $course) {
                                        $courseGrade = ($course['progress'] >= 0)
                                            ? mapProgressToGrade($course['progress'])
                                            : "No grade yet";
                                        ?>
                                        <div class="list-group-item">
                                            <div class="d-flex w-100 justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-1"><?php echo $course['title']; ?></h6>
                                                    <p class="mb-1 text-muted">Enrolled on: <?php echo $course['created_at']; ?></p>
                                                </div>
                                                <div class="text-end">
                                                    <span class="badge bg-<?php echo ($courseGrade === "No grade yet"
                                                        ? "secondary" : "success"); ?>">
                                                        Grade: <?php echo $courseGrade; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <div class="list-group-item">No enrolled courses found.</div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notifications/Announcements Column -->
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-info text-white">
                            <h5 class="card-title mb-0"><i class="fa fa-bell me-2"></i>Notifications</h5>
                        </div>
                        <div class="card-body">
                            <div class="notification-list">
                                <?php if ($notifications) { ?>
                                    <?php foreach ($notifications as $note) { ?>
                                        <div class="alert alert-info">
                                            <h6 class="alert-heading"><?php echo $note['title']; ?></h6>
                                            <p class="mb-0"><?php echo $note['message']; ?></p>
                                            <small class="text-muted"><?php echo $note['created_at']; ?></small>
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <div class="alert alert-info">No notifications found.</div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS for Dashboard -->
    <style>
        .card {
            margin-bottom: 1rem;
        }
    </style>

    <?php include "inc/Footer.php"; ?>
<?php
} else {
    $em = "First login";
    Util::redirect("../login.php", "error", $em);
}
?>