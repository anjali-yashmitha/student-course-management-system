<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<style>
  .sidebar {
    transition: all 0.3s ease;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
    width: 280px;
    min-height: 100vh;
    position: sticky;
    top: 0;
  }

  .main-content {
    min-height: 100vh;
    background-color: #f8f9fa;
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

  .notification-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    padding: 3px 6px;
    border-radius: 50%;
    background: #dc3545;
    color: white;
    font-size: 0.7rem;
  }

  .dropdown .dropdown-toggle {
    align-items: center;
  }

  .dropdown .rounded {
    border-radius: 50%;
  }
</style>

<div class="sidebar bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="../assets/img/Logo.png" alt="Online learning system" width="50" height="40">
      Admin
    </a>
    <ul class="nav flex-column nav-pills">
      <li class="nav-item position-relative">
        <a class="nav-link <?php echo ($currentPage == 'index.php') ? 'active' : ''; ?>" href="index.php"><i
            class="fa fa-user"></i> Students</a>
      </li>
      <li class="nav-item position-relative">
        <a class="nav-link <?php echo ($currentPage == 'Instructors.php') ? 'active' : ''; ?>" href="Instructors.php"><i
            class="fa fa-user-md"></i> Instructors</a>
      </li>
      <li class="nav-item position-relative">
        <a class="nav-link <?php echo ($currentPage == 'Courses.php') ? 'active' : ''; ?>" href="Courses.php"><i
            class="fa fa-graduation-cap"></i> Courses</a>
      </li>
      <li class="nav-item position-relative">
        <a class="nav-link <?php echo ($currentPage == 'Notifications.php') ? 'active' : ''; ?>"
          href="Notifications.php"><i class="fa fa-bell"></i> Notifications</a>
      </li>
    </ul>
    <ul class="nav flex-column nav-pills mt-auto">
      <li class="nav-item">
        <a class="nav-link" href="../Logout.php"><i class="fa fa-sign-out"></i> Logout</a>
      </li>
    </ul>
  </div>
</div>