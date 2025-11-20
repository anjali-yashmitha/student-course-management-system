<?php

class Admin
{
   private $table_name;
   private $conn;

   private $admin_id;
   private $full_name;
   private $email;
   private $username;
   private $student_email;
   private $student_full_name;

   function __construct($db_conn)
   {
      $this->conn = $db_conn;
      $this->table_name = "admin";
   }
   function init($admin_id)
   {
      try {
         $sql = 'SELECT * FROM ' . $this->table_name . ' WHERE admin_id=?';
         $stmt = $this->conn->prepare($sql);
         $res = $stmt->execute([$admin_id]);
         if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch();
            $this->username = $user['username'];
            $this->admin_id = $user['admin_id'];
            $this->student_email = $user['student_email'];
            $this->student_full_name = $user['student_full_name'];
            return 1;
         } else
            return 0;
      } catch (PDOException $e) {
         return 0;
      }
   }


   function authenticate($input_username, $input_password)
   {
      try {
         $sql = 'SELECT * FROM ' . $this->table_name . ' WHERE username=?';
         $stmt = $this->conn->prepare($sql);
         $res = $stmt->execute([$input_username]);
         if ($stmt->rowCount() == 1) {
            $admin = $stmt->fetch();
            $_username = $admin["username"];
            $_password = $admin["password"];


            if ($_username === $input_username) {
               if (password_verify($input_password, $_password)) {
                  $this->username = $_username;
                  $this->admin_id = $admin["admin_id"];
                  $this->email = $admin["email"];
                  $this->full_name = $admin["full_name"];
                  return 1;
               } else
                  return 0;
            } else
               return 0;
         } else
            return 0;
      } catch (PDOException $e) {
         return 0;
      }
   }

   function get()
   {
      $data = array(
         'admin_id' => $this->admin_id,
         'username' => $this->username,
         'full_name' => $this->full_name,
         'email' => $this->email
      );
      return $data;
   }

   public function createNotification($title, $message)
   {
      try {
         $sql = "INSERT INTO notifications (title, message) VALUES (?, ?)";
         $stmt = $this->conn->prepare($sql);
         $stmt->execute([$title, $message]);
         return true;
      } catch (PDOException $e) {
         return false;
      }
   }

   public function ensureNotificationsTableExists()
   {
      $sql = "CREATE TABLE IF NOT EXISTS notifications (
         id INT AUTO_INCREMENT PRIMARY KEY,
         title VARCHAR(255) NOT NULL,
         message TEXT NOT NULL,
         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
      )";
      $this->conn->exec($sql);
   }

   public function getAllNotifications()
   {
      $sql = "SELECT * FROM notifications ORDER BY created_at DESC";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

   public function deleteNotification($id)
   {
      try {
         $sql = "DELETE FROM notifications WHERE id=?";
         $stmt = $this->conn->prepare($sql);
         $stmt->execute([$id]);
         return true;
      } catch (PDOException $e) {
         return false;
      }
   }

}