<?php
session_start();
include "../Utils/Util.php";
include "../Utils/Validation.php";
if (
  isset($_SESSION['username']) &&
  isset($_SESSION['student_id'])
) {
  include "../Controller/Student/Student.php";

  $_id = $_SESSION['student_id'];
  $student = getById($_id);

  if (empty($student['student_id'])) {
    $em = "Invalid Student id";
    Util::redirect("../logout.php", "error", $em);
  }
  // get Certificates
  $certificates = getCertificate($_id);

  require_once __DIR__ . "/../Database.php";
  require_once __DIR__ . "/../Models/Course.php";

  $db = new Database();
  $course_model = new Course($db->connect());
  $enrolled_courses = $course_model->getEnrolledCoursesWithGrades($_SESSION['student_id']);

  function getLetterGrade($progress)
  {
    if ($progress >= 90)
      return 'A';
    if ($progress >= 80)
      return 'B';
    if ($progress >= 70)
      return 'C';
    if ($progress >= 60)
      return 'D';
    return 'F';
  }

  # Header
  $title = "DreamAcademy - Students ";
  include "inc/Header.php";

  ?>
  <div class="d-flex">
    <?php include "inc/NavBar.php"; ?>
    <div class="main-content">
      <div class="d-flex flex-row gap-4"> <!-- New wrapper div -->
        <!-- Left side - Profile -->
        <div class="flex-shrink-0" style="width: 350px;">
          <?php include "inc/Profile.php"; ?>
        </div>

        <!-- Right side - Account Info -->
        <div class="flex-grow-1">
          <div class="r-side p-4 shadow rounded-3">
            <!-- Profile Header -->
            <div class="profile-header mb-4">
              <h4 class="border-bottom pb-2 mb-4">Account Information</h4>
              <div class="progress mb-3" style="height: 10px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 85%;" aria-valuenow="85"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <small class="text-muted">Profile Completion: 85%</small>
            </div>

            <!-- Personal Information -->
            <div class="row g-3">
              <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                  <div class="card-body">
                    <h6 class="card-subtitle mb-3 text-primary">Personal Details</h6>
                    <div class="info-item mb-2">
                      <label class="text-muted small">Full Name</label>
                      <p class="mb-1 fw-bold"><?= $student['first_name'] . ' ' . $student['last_name'] ?></p>
                    </div>
                    <div class="info-item mb-2">
                      <label class="text-muted small">Email</label>
                      <p class="mb-1"><?= $student['email'] ?></p>
                    </div>
                    <div class="info-item">
                      <label class="text-muted small">Date of Birth</label>
                      <p class="mb-1"><?= date('F j, Y', strtotime($student['date_of_birth'])) ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Account Information -->
              <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                  <div class="card-body">
                    <h6 class="card-subtitle mb-3 text-primary">Account Details</h6>
                    <div class="info-item mb-2">
                      <label class="text-muted small">Username</label>
                      <p class="mb-1 fw-bold"><?= $student['username'] ?></p>
                    </div>
                    <div class="info-item mb-2">
                      <label class="text-muted small">Student ID</label>
                      <p class="mb-1"><span class="badge bg-warning text-dark"><?= $student['student_id'] ?></span></p>
                    </div>
                    <div class="info-item">
                      <label class="text-muted small">Member Since</label>
                      <p class="mb-1"><i
                          class="fas fa-clock me-2 text-secondary"></i><?= date('F j, Y', strtotime($student['date_of_joined'])) ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- My Enrolled Courses -->
            <div class="enrolled-courses mt-4 bg-white shadow-sm rounded-3 p-4">
              <h5 class="fw-bold mb-4">My Enrolled Courses</h5>
              <?php if (!empty($enrolled_courses)) { ?>
                <div class="table-responsive">
                  <table class="table table-hover align-middle">
                    <thead class="table-light">
                      <tr>
                        <th class="fw-semibold">Course</th>
                        <th class="fw-semibold">Progress</th>
                        <th class="fw-semibold">Grade</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($enrolled_courses as $course) { ?>
                        <tr>
                          <td>
                            <a href="Course.php?course_id=<?= $course['course_id'] ?>"
                              class="text-decoration-none text-primary fw-medium">
                              <?= htmlspecialchars($course['title']) ?>
                            </a>
                          </td>
                          <td>
                            <div class="progress" style="height: 10px;">
                              <div class="progress-bar" role="progressbar" style="width: <?= $course['progress'] ?>%;"
                                aria-valuenow="<?= $course['progress'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            <span class="badge bg-success"><?= getLetterGrade($course['progress']) ?></span>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              <?php } else { ?>
                <div class="alert alert-info border-0 rounded-3">
                  <i class="fas fa-info-circle me-2"></i>
                  You haven't enrolled in any courses yet.
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <style>
    .info-item p {
      font-size: 0.95rem;
    }

    .card {
      transition: all 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .progress {
      border-radius: 10px;
    }

    .progress-bar {
      border-radius: 10px;
    }

    @media (max-width: 992px) {
      .d-flex.flex-row {
        flex-direction: column !important;
      }

      .flex-shrink-0 {
        width: 100% !important;
      }
    }

    .enrolled-courses {
      background-color: #fff;
    }

    .enrolled-courses .table {
      margin-bottom: 0;
    }

    .enrolled-courses .table th {
      border-top: none;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .enrolled-courses .table td {
      vertical-align: middle;
      padding: 1rem 0.75rem;
    }

    .enrolled-courses .progress {
      box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.075);
    }

    .enrolled-courses .badge {
      font-weight: 500;
      padding: 0.5em 1em;
    }

    .table-responsive {
      border-radius: 0.5rem;
    }
  </style>

  <!-- Footer -->
  <?php include "inc/Footer.php"; ?>

  <?php
} else {
  $em = "First login ";
  Util::redirect("../login.php", "error", $em);
} ?>