<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<style>
  .sidebar {
    transition: all 0.3s ease;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
  }

  .nav-link {
    transition: all 0.3s ease;
    margin: 4px 0;
    border-radius: 8px;
    padding: 10px 15px;
    color: #fff !important;
    position: relative;
    overflow: hidden;
  }

  .nav-link:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateX(5px);
    color: #fff !important;
  }

  .nav-link.active {
    background: #0d6efd !important;
    color: #fff !important;
    font-weight: 500;
    box-shadow: 0 2px 4px rgba(13, 110, 253, 0.3);
  }

  /* ...existing styles... */

  .category-label {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #6c757d;
    margin: 15px 0 5px 10px;
  }

  .content-wrapper {
    margin-left: 280px;
    width: calc(100% - 280px);
  }

  /* ...existing sidebar styles... */

  .layout-wrapper {
    display: flex;
    min-height: 100vh;
  }

  .sidebar {
    position: fixed;
    left: 0;
    top: 0;
    width: 280px;
    height: 100vh;
    overflow-y: auto;
    z-index: 1000;
  }

  .content-wrapper {
    margin-left: 280px;
    width: calc(100% - 280px);
    min-height: 100vh;
    padding: 20px;
  }

  /* Ensure the notification button stays above content */
  .notification-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1001;
  }
</style>

<div class="layout-wrapper">
  <div class="sidebar d-flex flex-column flex-shrink-0 p-3 bg-dark text-white">
    <!-- Logo Section -->
    <a href="index.php" class="d-flex align-items-center mb-4 me-md-auto text-white text-decoration-none">
      <img src="../assets/img/Logo.png" alt="Online learning system" width="40" height="32" class="me-2">
      <span class="fs-4 fw-semibold">DreamAcademy</span>
    </a>

    <!-- Main Navigation -->
    <span class="category-label">Courses</span>
    <ul class="nav nav-pills flex-column">
      <li class="nav-item">
        <a href="Courses.php" class="nav-link text-white <?php if ($currentPage == 'Courses.php')
          echo 'active'; ?>">
          <i class="fa fa-book me-2"></i>
          Your Courses
        </a>
      </li>
    </ul>

    <span class="category-label">Create</span>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="Courses-add.php" class="nav-link text-white <?php if ($currentPage == 'Courses-add.php')
          echo 'active'; ?>">
          <i class="fa fa-plus me-2"></i>
          Create New Course
        </a>
      </li>
    </ul>

    <hr class="my-3">

    <!-- Profile Section -->
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1"
        data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-user-circle me-2"></i>
        <div>
          <strong>Profile</strong>
        </div>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
        <li><a class="dropdown-item" href="Profile-View.php"><i class="fa fa-user me-2"></i> View Profile</a></li>
        <li><a class="dropdown-item" href="Profile-Edit.php"><i class="fa fa-cog me-2"></i> Edit Profile</a></li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="../Logout.php"><i class="fa fa-sign-out me-2"></i> Logout</a></li>
      </ul>
    </div>

    <!-- Notifications Button -->
    <button class="btn btn-dark notification-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
      <i class="fa fa-bell"></i>
      <span class="notification-badge">2</span>
    </button>
  </div>

  <div class="content-wrapper">
    <!-- Content will be placed here -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Notifications</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <ul class="list-group">
              <li class="list-group-item">New course started</b></li>
              <li class="list-group-item">New course started</b></li>
            </ul>
          </div>
        </div>
      </div>
    </div>