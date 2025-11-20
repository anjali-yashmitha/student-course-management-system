<?php
session_start();
include "../Utils/Util.php";
if (
  isset($_SESSION['username']) &&
  isset($_SESSION['admin_id'])
) {
  include "../Controller/Admin/Student.php";
  $row_count = getCount();

  $page = 1;
  $row_num = 8;
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
  $students = getSomeStudent($offset, $row_num);
  # Header
  $title = "DreamAcademy - Students ";
  include "inc/Header.php";

  ?>

  <!-- Update the container structure -->
  <div class="d-flex">
    <!-- NavBar -->
    <?php include "inc/NavBar.php"; ?>

    <!-- Main Content -->
    <div class="main-content flex-grow-1 p-4">
      <div class="list-table">
        <?php if ($students) { ?>
          <h4>All Students (<?= $row_count ?>)</h4>

          <table class="table table-bordered">
            <tr>
              <th>#Id</th>
              <th>Full name</th>
              <th>Status</th>
              <th>Delete</th>
            </tr>
            <?php foreach ($students as $student) { ?>
              <tr data-student-id="<?= $student["student_id"] ?>">
                <td><?= $student["student_id"] ?></td>
                <td><a href="Student.php?student_id=<?= $student["student_id"] ?>"><?= $student["first_name"] ?>
                    <?= $student["last_name"] ?></a></td>
                <td class="status"> <?= $student["status"] ?></td>
                <td>
                  <button onclick="showDeleteModal(<?= $student['student_id'] ?>)" class="btn btn-danger">Delete</button>
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
                <a href="index.php?page=<?= $prev ?>" class="btn btn-secondary m-2">Prev</a>
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
                  <a href="index.php?page=<?= $i ?>" class="btn btn-success m-2"><?= $i ?></a>
                <?php } else { ?>
                  <a href="index.php?page=<?= $i ?>" class="btn btn-secondary m-2"><?= $i ?></a>

                <?php }
                if ($last_page <= $i)
                  break;

              }
              if ($next_btn) {
                ?>
                <a href="index.php?page=<?= $next ?>" class="btn btn-secondary m-2">Next</a>
              <?php } else { ?>
                <a href="#" class="btn btn-secondary m-2 disabled" des>Next</a>
              <?php } ?>
            </div>

          <?php }
        } else { ?>
          <div class="alert alert-info" role="alert">
            0 students record found in the database
          </div>

        <?php } ?>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include "inc/Footer.php"; ?>
  <script src="../assets/js/jquery-3.5.1.min.js"></script>
  <script type="text/javascript">
    let studentToDelete = null;

    function showDeleteModal(studentId) {
      studentToDelete = studentId;
      $('#deleteModal').modal('show');
    }

    $(document).ready(function () {
      // Close modal when clicking No or X button
      $('.close, .btn-secondary[data-dismiss="modal"]').click(function () {
        $('#deleteModal').modal('hide');
      });

      $('#confirmDelete').click(function () {
        if (studentToDelete) {
          $.ajax({
            url: "Action/delete-student.php",
            type: "POST",
            data: { student_id: studentToDelete },
            dataType: "json",
            success: function (response) {
              if (response.status === 'success') {
                $('#deleteModal').modal('hide');
                // Remove the row from table
                $(`tr[data-student-id="${studentToDelete}"]`).remove();
                // Update student count
                let countElement = $('h4:contains("All Students")');
                let currentCount = parseInt(countElement.text().match(/\d+/)[0]);
                countElement.text(`All Students (${currentCount - 1})`);
              } else {
                alert(response.message || 'Failed to delete student. Please try again.');
              }
            },
            error: function (xhr, status, error) {
              console.error("Delete error:", error);
              alert('Network or server error occurred. Please try again.');
            }
          });
        }
      });
    });
  </script>

  <!-- Add this modal before the closing body tag -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this student?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-danger" id="confirmDelete">Yes</button>
        </div>
      </div>
    </div>
  </div>

  <?php
} else {
  $em = "First login ";
  Util::redirect("../login.php", "error", $em);
} ?>