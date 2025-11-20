<?php
session_start();
include "../Utils/Util.php";
include "../Utils/Validation.php";
if (
  isset($_SESSION['username']) &&
  isset($_SESSION['instructor_id'])
) {
  include "../Controller/Instructor/Instructor.php";

  $_id = $_SESSION['instructor_id'];
  $instructor = getById($_id);

  if (empty($instructor['instructor_id'])) {
    $em = "Invalid instructor id";
    Util::redirect("../logout.php", "error", $em);
  }
  # Header
  $title = "DreamAcademy - Instructor ";
  include "inc/Header.php";
  include "inc/NavBar.php";
  ?>
  <!-- Add custom CSS -->
  <style>
    .profile-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
    }

    .info-item {
      transition: all 0.3s ease;
      border-radius: 10px;
      padding: 1rem;
    }

    .info-item:hover {
      background-color: #f8f9fa;
    }

    .info-label {
      color: #6c757d;
      font-size: 0.9rem;
      margin-bottom: 0.3rem;
    }

    .info-value {
      color: #2c3e50;
      font-size: 1.1rem;
      font-weight: 500;
    }

    .info-icon {
      color: #4c6ef5;
      width: 35px;
      height: 35px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #edf2ff;
      border-radius: 8px;
      margin-right: 1rem;
    }
  </style>

  <div class="container py-5">
    <div class="profile-card p-4">
      <div class="d-flex align-items-center mb-4">
        <h4 class="mb-0">Account Information</h4>
        <button class="btn btn-sm btn-outline-primary ms-auto">
          <i class="fa-solid fa-pen-to-square me-2"></i>Edit Profile
        </button>
      </div>

      <div class="row g-4">
        <div class="col-md-6">
          <div class="info-item d-flex align-items-center">
            <div class="info-icon">
              <i class="fa-solid fa-user-circle"></i>
            </div>
            <div>
              <div class="info-label">First Name</div>
              <div class="info-value"><?= $instructor['first_name'] ?></div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="info-item d-flex align-items-center">
            <div class="info-icon">
              <i class="fa-solid fa-user-circle"></i>
            </div>
            <div>
              <div class="info-label">Last Name</div>
              <div class="info-value"><?= $instructor['last_name'] ?></div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="info-item d-flex align-items-center">
            <div class="info-icon">
              <i class="fa-solid fa-envelope"></i>
            </div>
            <div>
              <div class="info-label">Email</div>
              <div class="info-value"><?= $instructor['email'] ?></div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="info-item d-flex align-items-center">
            <div class="info-icon">
              <i class="fa-solid fa-calendar-days"></i>
            </div>
            <div>
              <div class="info-label">Date of Birth</div>
              <div class="info-value"><?= $instructor['date_of_birth'] ?></div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="info-item d-flex align-items-center">
            <div class="info-icon">
              <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
            <div>
              <div class="info-label">Joined at</div>
              <div class="info-value"><?= $instructor['date_of_joined'] ?></div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="info-item d-flex align-items-center">
            <div class="info-icon">
              <i class="fa-solid fa-user-tag"></i>
            </div>
            <div>
              <div class="info-label">Username</div>
              <div class="info-value"><?= $instructor['username'] ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include "inc/Footer.php"; ?>


  <?php
} else {
  $em = "First login ";
  Util::redirect("../login.php", "error", $em);
} ?>