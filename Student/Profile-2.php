<?php
session_start();
include "../Utils/Util.php";
include "../Utils/Validation.php";

if (isset($_SESSION['username']) && isset($_SESSION['student_id'])) {
    include "../Controller/Student/Student.php";

    $_id = $_SESSION['student_id'];
    $student = getById($_id);

    if (empty($student['student_id'])) {
        $em = "Invalid Student id";
        Util::redirect("../logout.php", "error", $em);
    }

    $title = "User Profile";
    include "inc/Header.php";
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            :root {
                --primary-color: #4361ee;
                --secondary-bg: #f8f9fa;
                --sidebar-width: 280px;
            }

            body {
                background-color: #f0f2f5;
                margin: 0;
                padding: 0;
                min-height: 100vh;
                display: flex;
            }

            /* Sidebar/NavBar styling */
            .sidebar-container {
                width: var(--sidebar-width);
                min-width: var(--sidebar-width);
                background: white;
                height: 100vh;
                position: sticky;
                top: 0;
                border-right: 1px solid rgba(0, 0, 0, 0.1);
            }

            .main-content {
                flex: 1;
                padding: 2rem;
                height: 100vh;
                overflow-y: auto;
            }

            /* Rest of your existing styles */
            .profile-card {
                background: white;
                border-radius: 15px;
                padding: 2rem;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            }

            .profile-image {
                width: 150px;
                height: 150px;
                border-radius: 10px;
                object-fit: cover;
                background: #eee;
            }

            .edit-button {
                color: var(--primary-color);
                border: 1px solid var(--primary-color);
                padding: 0.5rem 2rem;
                border-radius: 5px;
                transition: all 0.3s;
            }

            .edit-button:hover {
                background: var(--primary-color);
                color: white;
            }

            .profile-info {
                margin-top: 2rem;
            }

            .info-item {
                margin-bottom: 1rem;
            }

            .info-label {
                color: #666;
                font-size: 0.9rem;
            }

            .info-value {
                color: #333;
                font-weight: 500;
            }

            .upload-section {
                border: 2px dashed #ddd;
                padding: 1rem;
                text-align: center;
                margin-top: 1rem;
                border-radius: 10px;
            }
        </style>
    </head>

    <body>
        <div class="sidebar-container">
            <?php include "inc/NavBar.php"; ?>
        </div>

        <div class="main-content">
            <div class="profile-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="mb-4">Profile</h4>
                        <div class="profile-image-container">
                            <img src="../Upload/profile/<?= $student['profile_img'] ?>" alt="Profile" class="profile-image">
                            <form action="Action/upload-profile.php" method="POST" enctype="multipart/form-data"
                                class="upload-section">
                                <input type="file" class="form-control mb-2" name="profile_picture">
                                <button type="submit" class="btn btn-primary btn-sm">Update Photo</button>
                            </form>
                        </div>
                    </div>
                    <button class="edit-button" onclick="toggleEditMode()">Edit Profile</button>
                </div>

                <div class="profile-info" id="viewMode">
                    <div class="info-item">
                        <div class="info-label">Name:</div>
                        <div class="info-value"><?= $student['username'] ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Email:</div>
                        <div class="info-value"><?= $student['email'] ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Phone Number:</div>
                        <div class="info-value"><?= $student['phone'] ?? '+20-01274318900' ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Address:</div>
                        <div class="info-value"><?= $student['address'] ?? '285 N Broad St, Elizabeth, NJ 07208, USA' ?>
                        </div>
                    </div>
                </div>

                <form id="editMode" style="display: none;" action="Action/upload-profile-details.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" value="<?= $student['first_name'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" value="<?= $student['last_name'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $student['email'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="tel" class="form-control" name="phone" value="<?= $student['phone'] ?? '' ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" name="address"><?= $student['address'] ?? '' ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-secondary" onclick="toggleEditMode()">Cancel</button>
                </form>
            </div>
        </div>

        <script>
            function toggleEditMode() {
                const viewMode = document.getElementById('viewMode');
                const editMode = document.getElementById('editMode');

                if (viewMode.style.display !== 'none') {
                    viewMode.style.display = 'none';
                    editMode.style.display = 'block';
                } else {
                    viewMode.style.display = 'block';
                    editMode.style.display = 'none';
                }
            }
        </script>

    </body>

    </html>

    <?php
} else {
    $em = "First login ";
    Util::redirect("../login.php", "error", $em);
}
?>