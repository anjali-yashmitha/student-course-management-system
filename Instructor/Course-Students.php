<?php
session_start();
include "../Utils/Util.php";
if (
    isset($_SESSION['username']) &&
    isset($_SESSION['instructor_id']) &&
    isset($_GET['id'])
) {
    // Remove duplicate Database.php include since it's already included in Course.php
    include "../Controller/Instructor/Course.php";

    $course_id = $_GET['id'];
    $enrolled_students = getEnrolledStudents($course_id);
    $enrolled_count = getEnrolledCount($course_id);

    $db = new Database();
    $course = new Course($db->connect());

    // Helper function to convert progress to letter grade
    function getLetterGrade($progress)
    {
        if ($progress >= 90)
            return 'A';
        if ($progress >= 70)
            return 'B';
        if ($progress >= 60)
            return 'C';
        return 'F';
    }

    # Header
    $title = "DreamAcademy - Course Students";
    include "inc/Header.php";
    include "inc/NavBar.php";
    ?>

    <div class="mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="Courses.php">Courses</a></li>
                <li class="breadcrumb-item active">Enrolled Students</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Enrolled Students (<?= $enrolled_count ?>)</h4>
            </div>
            <div class="card-body">
                <?php if ($enrolled_students && count($enrolled_students) > 0) { ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Join Date</th>
                                    <th>Final Grade</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($enrolled_students as $student) {
                                    // Get current progress/grade
                                    $progress = $course->getStudentProgress($course_id, $student['student_id']);
                                    $currentGrade = $progress ? getLetterGrade($progress['progress']) : '';
                                    ?>
                                    <tr>
                                        <td><?= $student['student_id'] ?></td>
                                        <td><?= $student['first_name'] . ' ' . $student['last_name'] ?></td>
                                        <td><?= $student['email'] ?></td>
                                        <td><?= $student['date_of_joined'] ?></td>
                                        <td>
                                            <select class="form-control grade-input"
                                                data-student-id="<?= $student['student_id'] ?>">
                                                <option value="">Select Grade</option>
                                                <option value="A" <?= ($currentGrade == 'A') ? 'selected' : '' ?>>A</option>
                                                <option value="B" <?= ($currentGrade == 'B') ? 'selected' : '' ?>>B</option>
                                                <option value="C" <?= ($currentGrade == 'C') ? 'selected' : '' ?>>C</option>
                                                <option value="F" <?= ($currentGrade == 'F') ? 'selected' : '' ?>>F</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm save-grade"
                                                data-student-id="<?= $student['student_id'] ?>">
                                                Save Grade
                                            </button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-info" role="alert">
                        No students enrolled in this course yet.
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.save-grade').forEach(btn => {
                btn.addEventListener('click', function () {
                    const studentId = this.getAttribute('data-student-id');
                    const gradeSelect = this.closest('tr').querySelector('.grade-input');
                    const grade = gradeSelect.value;
                    if (grade) {
                        fetch('Action/course-grade.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: new URLSearchParams({
                                'course_id': '<?= $course_id ?>',
                                'student_id': studentId,
                                'grade': grade
                            })
                        })
                            .then(res => res.text())
                            .then(alert)
                            .catch(console.error);
                    }
                });
            });
        });
    </script>

    <?php include "inc/Footer.php";
} else {
    $em = "Invalid request or unauthorized access";
    Util::redirect("Courses.php", "error", $em);
} ?>