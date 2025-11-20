<?php
session_start();
include "../Utils/Util.php";
include "../Utils/Validation.php";
if (
    isset($_SESSION['username']) &&
    isset($_SESSION['instructor_id'])
) {
    include "../Controller/Instructor/Course.php";
    $instructor_id = $_SESSION['instructor_id'];
    $courses = getCoursesByInstructorId($instructor_id);

    # Header
    $title = "DreamAcademy - Create Course ";
    include "inc/Header.php";
    include "inc/NavBar.php";

    $title = $description = "";
    if (isset($_GET["title"])) {
        $title = Validation::clean($_GET["title"]);
    }
    if (isset($_GET["description"])) {
        $description = Validation::clean($_GET["description"]);
    }
    ?>
    <!-- Remove container div -->
    <div class="mt-4" style="max-width: 800px;">
        <form id="courseForm" action="Action/course-add.php" method="POST" enctype="multipart/form-data">
            <?php if (isset($_GET['error'])) { ?>
                <p class="alert alert-warning"><?= Validation::clean($_GET['error']) ?></p>
            <?php } ?>
            <?php
            if (isset($_GET['success'])) { ?>
                <p class="alert alert-success"><?= Validation::clean($_GET['success']) ?></p>
            <?php } ?>
            <h2>Create a New Course</h2>
            <div class="mb-3">
                <label for="courseTitle" class="form-label">Course Title</label>
                <input type="text" class="form-control" id="courseTitle" name="title" placeholder="Enter course title"
                    value="<?= $title ?>" required />
            </div>
            <div class="mb-3">
                <label for="courseDescription" class="form-label">Course Description</label>
                <textarea class="form-control" id="courseDescription" rows="4" name="description"
                    placeholder="Enter course description" required><?= $description ?></textarea>
            </div>
            <div class="mb-3">
                <label for="Cover" class="form-label">Cover Image</label>
                <input type="file" class="form-control" id="Cover" placeholder="Enter course title" name="cover" />
            </div>

            <button type="submit" class="btn btn-primary">Create Course</button>
        </form>


    </div>

    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
        $("#courseSelectTopic").change(function () {
            $courseSelectTopicVal = $("#courseSelectTopic").val();
            $.post("Action/load-chapters.php",
                { 'course_id': $courseSelectTopicVal },
                function (data, status) {
                    if (status == "success") {

                        if (data != 0) {
                            $("#chapterSelect").html(data);
                        } else {
                            alert("First create Capter");
                            $("#chapterSelect").html("");
                        }
                    }
                });
        });
    </script>
    <!-- Footer -->
    <?php include "inc/Footer.php"; ?>



    <?php
} else {
    $em = "First login ";
    Util::redirect("../login.php", "error", $em);
} ?>