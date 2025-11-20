<?php
session_start();
include "../Utils/Util.php";
if (
  isset($_SESSION['username']) &&
  isset($_SESSION['student_id'])
) {

  include "../Controller/Student/Course.php";
  include "../Controller/Student/EnrolledStudent.php";

  $student_id = $_SESSION['student_id'];
  $courses = getEnrolledCourses($student_id);
  $row_count = $courses[0]['count'];

  # Header
  $title = "DreamAcademy - Students ";
  include "inc/Header.php";

  ?>
  <div class="d-flex">
    <?php include "inc/NavBar.php"; ?>
    <div class="main-content">
      <?php if ($row_count > 0) { ?>
        <h4 class="course-list-title" style="margin-top: 0px">All Enrolled Courses (<?= $row_count ?>)</h4>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 p-3">
          <?php for ($i = 1; $i <= $row_count; $i++) { ?>
            <div class="col">
              <a href="Course.php?course_id=<?= $courses[$i]["course_id"] ?>" style="text-decoration: none; color: inherit;">
                <div class="card h-100 shadow-sm" style="transition: all 0.2s ease-in-out; cursor: pointer;"
                  onmouseover="this.classList.add('shadow-lg')" onmouseout="this.classList.remove('shadow-lg')">
                  <div class="row g-0">
                    <div class="col-md-12">
                      <img src="../Upload/thumbnail/<?= $courses[$i]["cover"] ?>" class="img-fluid rounded-start" alt="course"
                        style="width: 100%; height: 200px; object-fit: cover;">
                    </div>
                    <div class="col-md-12">
                      <div class="card-body">
                        <h5 class="card-title" style="font-weight: bold;"><?= $courses[$i]["title"] ?></h5>
                        <p class="card-text">
                          <?= strlen($courses[$i]["description"]) > 50 ?
                            substr($courses[$i]["description"], 0, 100) . '...' :
                            $courses[$i]["description"] ?>
                        </p>
                        <p class="card-text">
                          <small class="text-body-secondary">
                            <span class="bg-success text-white p-1 px-2 rounded">
                              <?= date("Y-m-d", strtotime($courses[$i]["created_at"])) ?>
                            </span>
                          </small>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          <?php } ?>
        </div>
      <?php } else { ?>
        <div class="alert alert-info" role="alert">
          0 courses record found in the database
        </div>
      <?php } ?>
    </div>
  </div>
  <!-- Footer -->
  <?php include "inc/Footer.php"; ?>
<?php
} else {
  $em = "First login ";
  Util::redirect("../login.php", "error", $em);
} ?>