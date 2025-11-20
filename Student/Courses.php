<?php
session_start();
include "../Utils/Util.php";
if (
  isset($_SESSION['username']) &&
  isset($_SESSION['student_id'])
) {

  include "../Controller/Student/Course.php";
  $row_count = getCount();

  $page = 1;
  $row_num = 6;
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
  $courses = getSomeCourses($offset, $row_num);

  # Header
  $title = "DreamAcademy - Students ";
  include "inc/Header.php";

  ?>
  <div class="d-flex">
    <?php include "inc/NavBar.php"; ?>
    <div class="main-content">
      <!-- Add filter form -->
      <div class="card mb-3">
        <div class="card-body">
          <form method="GET" class="row g-3" id="filterForm">
            <div class="col-md-2">
              <select name="category" class="form-select">
                <option value="">Select Category</option>
                <option value="programming" <?= isset($_GET['category']) && $_GET['category'] == 'programming' ? 'selected' : '' ?>>Programming</option>
                <option value="design" <?= isset($_GET['category']) && $_GET['category'] == 'design' ? 'selected' : '' ?>>
                  Design</option>
                <option value="business" <?= isset($_GET['category']) && $_GET['category'] == 'business' ? 'selected' : '' ?>>Business</option>
              </select>
            </div>
            <div class="col-md-2">
              <select name="credits" class="form-select">
                <option value="">Select Credits</option>
                <option value="1" <?= isset($_GET['credits']) && $_GET['credits'] == '1' ? 'selected' : '' ?>>1 Credit
                </option>
                <option value="2" <?= isset($_GET['credits']) && $_GET['credits'] == '2' ? 'selected' : '' ?>>2 Credits
                </option>
                <option value="3" <?= isset($_GET['credits']) && $_GET['credits'] == '3' ? 'selected' : '' ?>>3 Credits
                </option>
              </select>
            </div>
            <div class="col-md-3">
              <input type="text" name="search" class="form-control" placeholder="Search Course"
                value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            </div>
            <div class="col-md-2">
              <input type="text" name="instructor" class="form-control" placeholder="Instructor Name"
                value="<?= htmlspecialchars($_GET['instructor'] ?? '') ?>">
            </div>
            <div class="col-md-3">
              <button type="submit" class="btn btn-primary">Filter</button>
              <a href="Courses.php" class="btn btn-secondary">Reset</a>
            </div>
          </form>
        </div>
      </div>

      <?php if ($courses && is_array($courses) && count($courses) > 0) { ?>
        <div class="row">
          <div class="col-md-12">
            <h4 class="course-lisro-title">All Courses (<?= $row_count ?>)</h4>
            <div class="course-list row row-cols-1 row-cols-md-3 g-4">
              <?php foreach ($courses as $course) { ?>
                <div class="col">
                  <a class="course-a text-decoration-none" href="Course.php?course_id=<?= $course["course_id"] ?>">
                    <div class="card h-100 course shadow-sm" style="transition: all 0.2s ease-in-out; cursor: pointer;"
                      onmouseover="this.classList.add('shadow-lg')" onmouseout="this.classList.remove('shadow-lg')">
                      <img src="../Upload/thumbnail/<?= $course["cover"] ?? 'default.jpg' ?>" class="card-img-top"
                        alt="course" style="height: 200px; object-fit: cover;">
                      <div class="card-body">
                        <h5 class="card-title" style="font-weight: bold;"><?= htmlspecialchars($course["title"]) ?></h5>
                        <p class="card-text">
                          <?= strlen($course["description"]) > 50 ?
                            htmlspecialchars(substr($course["description"], 0, 100)) . '...' :
                            htmlspecialchars($course["description"]) ?>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                          <span class="badge bg-primary"><?= htmlspecialchars($course["category"]) ?></span>
                          <span class="badge bg-secondary"><?= $course["credits"] ?> Credits</span>
                        </div>
                        <p class="card-text mt-2">
                          <small class="text-body-secondary">
                            <span class="bg-success text-white p-1 px-2 rounded">
                              <?= date("Y-m-d", strtotime($course["created_at"])) ?>
                            </span>
                          </small>
                        </p>
                      </div>
                    </div>
                  </a>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } else { ?>
        <div class="alert alert-info" role="alert">
          No courses found matching your criteria. Try different filter options or <a href="Courses.php">view all
            courses</a>.
        </div>
      <?php } ?>
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

          function getFilterParams()
          {
            $params = [];
            if (!empty($_GET['category']))
              $params[] = "category=" . urlencode($_GET['category']);
            if (!empty($_GET['credits']))
              $params[] = "credits=" . urlencode($_GET['credits']);
            if (!empty($_GET['instructor']))
              $params[] = "instructor=" . urlencode($_GET['instructor']);
            if (!empty($_GET['search']))
              $params[] = "search=" . urlencode($_GET['search']);
            return $params ? '&' . implode('&', $params) : '';
          }

          if ($prev_btn) {
            ?>
            <a href="Courses.php?page=<?= $prev . getFilterParams() ?>" class="btn btn-secondary m-2">Prev</a>
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

              <a href="Courses.php?page=<?= $i . getFilterParams() ?>" class="btn btn-success m-2"><?= $i ?></a>
            <?php } else { ?>


              <a href="Courses.php?page=<?= $i . getFilterParams() ?>" class="btn btn-secondary m-2"><?= $i ?></a>

            <?php }
            if ($last_page <= $i)
              break;
          }
          if ($next_btn) {
            ?>
            <a href="Courses.php?page=<?= $next . getFilterParams() ?>" class="btn btn-secondary m-2">Next</a>
          <?php } else { ?>
            <a href="#" class="btn btn-secondary m-2 disabled" des>Next</a>
          <?php } ?>
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