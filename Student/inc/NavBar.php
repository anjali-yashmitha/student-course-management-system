<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<style>
  .sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 280px;
    overflow-y: auto;
    transition: all 0.3s ease;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
    z-index: 1000;
  }

  .main-content {
    margin-left: 280px;
    width: calc(100% - 280px);
    min-height: 100vh;
    padding: 20px;
  }

  /* Hide scrollbar for Chrome, Safari and Opera */
  .sidebar::-webkit-scrollbar {
    width: 6px;
  }

  .sidebar::-webkit-scrollbar-thumb {
    background: #555;
    border-radius: 3px;
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

  .nav-link::before {
    content: '';
    position: absolute;
    left: -100%;
    top: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg,
        transparent,
        rgba(255, 255, 255, 0.1),
        transparent);
    transition: 0.5s;
  }

  .nav-link:hover::before {
    left: 100%;
  }

  .nav-pills .nav-link:not(.active):hover {
    background: rgba(255, 255, 255, 0.1) !important;
  }

  .category-label {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #6c757d;
    margin: 15px 0 5px 10px;
  }

  /* Remove notification-badge class since it's no longer needed */
  .notification-badge {
    display: none;
  }

  /* Profile Section Enhancements */
  .dropdown .dropdown-toggle {
    align-items: center;
  }

  .dropdown .rounded-circle {
    margin-right: 10px;
  }

  .dropdown-item {
    transition: background 0.3s ease;
  }

  .dropdown-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
  }
</style>

<div class="sidebar d-flex flex-column flex-shrink-0 p-3 bg-dark text-white">
  <!-- Logo Section -->
  <a href="Courses.php" class="d-flex align-items-center mb-4 me-md-auto text-white text-decoration-none">
    <img src="../assets/img/Logo.png" alt="Online learning system" width="40" height="32" class="me-2">
    <span class="fs-4 fw-semibold">DreamAcademy</span>
  </a>

  <!-- Main Navigation -->
  <span class="category-label">Learning</span>
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="Dashboard.php" class="nav-link text-white <?php if ($currentPage == 'Dashboard.php') {
        echo 'active';
      } ?>">
        <i class="fa fa-home me-2"></i>
        Dashboard
      </a>
    </li>
    <li class="nav-item">
      <a href="Courses.php" class="nav-link text-white <?php if ($currentPage == 'Courses.php') {
        echo 'active';
      } ?>">
        <i class="fa fa-book me-2"></i>
        All Courses
      </a>
    </li>
    <li>
      <a href="Enrolled-Course.php" class="nav-link text-white <?php if ($currentPage == 'Enrolled-Course.php') {
        echo 'active';
      } ?>">
        <i class="fa fa-graduation-cap me-2"></i>
        Current Learning
      </a>
    </li>

  </ul>

  <hr class="my-3">

  <!-- Profile Section -->
  <div class="dropdown">
    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1"
      data-bs-toggle="dropdown" aria-expanded="false">
      <div>
        <strong>Profile</strong>
      </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
      <li><a class="dropdown-item" href="Profile-View.php"><i class="fa fa-user me-2"></i> View Profile</a></li>
      <li><a class="dropdown-item" href="Profile-Edit.php"><i class="fa fa-cog me-2"></i> Settings</a></li>
      <li><a class="dropdown-item" href="Profile-Edit.php#ChangePassword"><i class="fa fa-key me-2"></i> Change
          Password</a></li>
      <li>
        <hr class="dropdown-divider">
      </li>
      <li><a class="dropdown-item" href="../Logout.php"><i class="fa fa-sign-out me-2"></i> Logout</a></li>
    </ul>
  </div>
</div>