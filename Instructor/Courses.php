<?php
session_start();
include "../Utils/Util.php";
if (
  isset($_SESSION['username']) &&
  isset($_SESSION['instructor_id'])
) {

  include "../Controller/Instructor/Course.php";

  $instructor_id = $_SESSION['instructor_id'];
  $row_count = getCountByInstructorId($instructor_id);

  $page = 1;
  $row_num = 5;
  $offset = 0;

  $last_page = ceil($row_count / $row_num);
  if (isset($_GET['page'])) {
    if ($_GET['page'] > $last_page) {
      $page = $last_page;
    } else if ($_GET['page'] <= 0) {
      $page = 1;
    } else
      $page = $_GET['page'];
  }
  if ($page != 1)
    $offset = ($page - 1) * $row_num;
  $courses = getSomeCoursesByInstructorId($offset, $row_num, $instructor_id);
  # Header
  $title = "DreamAcademy - Courses ";
  include "inc/Header.php";
  include "inc/NavBar.php";
  ?>

  <!-- Remove container div -->
  <div class="mt-4">
    <?php if ($courses) { ?>
      <h4>Your Courses (<?= $row_count ?>)</h4>

      <table class="table table-bordered">
        <tr>
          <th>#Id</th>
          <th>Course Title</th>
          <th>Enrolled Students</th>
          <th>Action</th>
        </tr>
        <?php foreach ($courses as $course) {
          $enrolled_count = getEnrolledCount($course["course_id"]);
          ?>
          <tr>
            <td><?= $course["course_id"] ?></td>
            <td><?= $course["title"] ?></td>
            <td>
              <a href="course-students.php?id=<?= $course["course_id"] ?>" class="btn btn-info btn-sm">
                View Students (<?= $enrolled_count ?>)
              </a>
            </td>
            <td class="action_btn">
              <button class=" btn btn-danger" onclick="deleteCourse(this, <?= $course['course_id'] ?>)">
                Delete
              </button>
            </td>
          </tr>
        <?php } ?>
      </table>
      <?php if ($last_page > 1) { ?>
        <div class="d-flex justify-content-center mt-3 border">
          <?php
          $prev = 1;
          $next = 1;
          $next_btn = true;
          $prev_btn = true;
          if ($page <= 1)
            $prev_btn = false;
          if ($last_page == $page)
            $next_btn = false;
          if ($page > 1)
            $prev = $page - 1;
          if ($page < $last_page)
            $next = $page + 1;

          if ($prev_btn) {
            ?>
            <a href="Courses.php?page=<?= $prev ?>" class="btn btn-secondary m-2">Prev</a>
          <?php } else { ?>
            <a href="#" class="btn btn-secondary m-2 disabled">Prev</a>

            <?php
          }
          $push_mid = $page;
          if ($page >= 2)
            $push_mid = $page - 1;
          if ($page > 3)
            $push_mid = $page - 3;

          for ($i = $push_mid; $i < 5 + $page; $i++) {
            if ($i == $page) { ?>
              <a href="Courses.php?page=<?= $i ?>" class="btn btn-success m-2"><?= $i ?></a>
            <?php } else { ?>
              <a href="Courses.php?page=<?= $i ?>" class="btn btn-secondary m-2"><?= $i ?></a>

            <?php }
            if ($last_page <= $i)
              break;

          }
          if ($next_btn) {
            ?>
            <a href="Courses.php?page=<?= $next ?>" class="btn btn-secondary m-2">Next</a>
          <?php } else { ?>
            <a href="#" class="btn btn-secondary m-2 disabled" des>Next</a>
          <?php } ?>
        </div>

      <?php }
    } else { ?>
      <div class="alert alert-info" role="alert">
        0 Course record found in the database
      </div>

    <?php } ?>
  </div> <!-- Close container here -->

  <!-- Footer -->
  <?php include "inc/Footer.php"; ?>
  <script src="../assets/js/jquery-3.5.1.min.js"></script>
  <script type="text/javascript">
    var valu = "";
    var btext = "";
    function deleteCourse(current, cou_id) {
      if (confirm("Are you sure you want to delete this course?")) {
        $.post("Action/delete-course.php",
          { course_id: cou_id },
          function (data, status) {
            if (status === "success") {
              $(current).closest("tr").remove();
            }
          }
        );
      }
    }
  </script>
  <?php
} else {
  $em = "First login ";
  Util::redirect("../login.php", "error", $em);
} ?>