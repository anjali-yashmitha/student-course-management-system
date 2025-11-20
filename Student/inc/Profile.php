<div class="side-by-side">
  <div class="l-side shadow-lg rounded-3 p-4">
    <div class="profile text-center">
      <div class="position-relative profile-image-container mx-auto">
        <img src="../Upload/profile/<?= $student['profile_img'] ?>"
          class="rounded-circle profile-image border border-3 border-white shadow" alt="PROFILE IMG">
        <div class="image-overlay">
          <label for="profile_picture" class="d-flex flex-column align-items-center justify-content-center h-100">
            <div class="small">Change Picture</div>
          </label>
        </div>
      </div>

      <form action="Action/upload-profile.php" class="mt-3" enctype="multipart/form-data" method="POST">
        <input type="file" class="form-control d-none" id="profile_picture" name="profile_picture">
        <input type="submit" value="Save Photo" class="btn btn-primary btn-sm px-4 rounded-pill shadow-sm">
      </form>

      <div class="user-info mt-4">
        <h4 class="mb-1 fw-bold">Student</h4>
      </div>
    </div>

    <div class="navigation-menu mt-4">
      <a href="Profile-Edit.php" class="menu-item">
        <i class="fas fa-user-edit me-2"></i>Edit Profile
      </a>
      <a href="../Logout.php" class="menu-item menu-item-danger">
        <i class="fas fa-sign-out-alt me-2"></i>Logout
      </a>
    </div>
  </div>
</div>

<style>
  .profile-image-container {
    width: 150px;
    height: 150px;
    margin-bottom: 1.5rem;
    position: relative;
  }

  .profile-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.3s ease;
  }

  .image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    opacity: 0;
    transition: all 0.3s ease;
    cursor: pointer;
    border-radius: 50%;
    z-index: 10;
  }

  .image-overlay:hover {
    opacity: 1;
  }

  .navigation-menu {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
  }

  .menu-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
    color: #2c3e50;
    text-decoration: none;
    transition: all 0.2s ease;
    background: #f8f9fa;
  }

  .menu-item:hover {
    background: #e9ecef;
    transform: translateX(5px);
  }

  .menu-item-danger {
    color: #dc3545;
  }

  .menu-item-danger:hover {
    background: #dc3545;
    color: white;
  }

  @media (max-width: 768px) {
    .l-side {
      margin-bottom: 1rem;
    }
  }
</style>