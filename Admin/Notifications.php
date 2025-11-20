<?php
session_start();
include "../Utils/Util.php";
require_once "../Database.php";
require_once "../Models/Admin.php";

if (isset($_SESSION['admin_id'])) {
    $db = new Database();
    $conn = $db->connect();
    $admin = new Admin($conn);
    $admin->ensureNotificationsTableExists(); // Ensure table exists
    $allNotifications = $admin->getAllNotifications();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'] ?? '';
        $message = $_POST['message'] ?? '';
        $admin->createNotification($title, $message);
        // Redirect or success message
        Util::redirect("index.php", "success", "Notification sent successfully.");
    }
    // HTML header
    $title = "DreamAcademy - Create Announcements";
    include "inc/Header.php";
    ?>
    <div class="d-flex">
        <?php include "inc/NavBar.php"; ?>

        <div class="main-content flex-grow-1 p-4">
            <div class="row">
                <!-- Create Notification Section -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4 class="mb-0">Create Announcements</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Message</label>
                                    <textarea name="message" class="form-control" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Send Announcement
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Notifications List Section -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Sent Announcements</h4>
                        </div>
                        <div class="card-body p-0">
                            <?php if ($allNotifications) { ?>
                                <div class="notification-list">
                                    <?php foreach ($allNotifications as $note) { ?>
                                        <div class="notification-item border-bottom p-3" data-id="<?php echo $note['id']; ?>">
                                            <div class="d-flex justify-content-between">
                                                <div class="notification-content">
                                                    <h5 class="notification-title"><?php echo $note['title']; ?></h5>
                                                    <div class="notification-meta text-muted small">
                                                        <?php echo date('M j, Y g:i A', strtotime($note['created_at'])); ?>
                                                    </div>
                                                    <div class="notification-message mt-2">
                                                        <?php echo $note['message']; ?>
                                                    </div>
                                                </div>
                                                <button class="btn btn-danger btn-sm delete-btn" title="Delete">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-info m-3">
                                    No notifications found.
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border: 1px solid rgba(0, 0, 0, 0.125);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }

        .notification-list {
            max-height: 600px;
            overflow-y: auto;
        }

        .notification-item {
            transition: background-color 0.2s;
        }

        .notification-item:hover {
            background-color: #f8f9fa;
        }

        .notification-title {
            font-size: 1.1rem;
            margin-bottom: 0.25rem;
        }

        .delete-btn {
            height: fit-content;
        }
    </style>

    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function () {
            // Form validation
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                });
            });

            // Delete notification
            $('.delete-btn').on('click', function () {
                const item = $(this).closest('.notification-item');
                const notificationId = item.data('id');

                if (confirm('Are you sure you want to delete this notification?')) {
                    $.post('Action/delete-notification.php', { notification_id: notificationId }, function (response) {
                        if (response.status === 'success') {
                            item.slideUp(300, function () { $(this).remove(); });
                            if ($('.notification-item').length === 1) {
                                location.reload();
                            }
                        } else {
                            alert('Failed to delete notification.');
                        }
                    }, 'json');
                }
            });
        });
    </script>
    <?php
    // Footer
    include "inc/Footer.php";
} else {
    Util::redirect("../login.php", "error", "Please login first.");
}
?>