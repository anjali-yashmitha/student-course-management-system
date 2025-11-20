# DreamAcademy - Student Course Management System

![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=flat&logo=bootstrap&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=flat&logo=tailwind-css&logoColor=white)

## 📚 Overview

**DreamAcademy** is a comprehensive Online Learning Management System built with PHP and MySQL. It provides a complete platform for managing online courses with distinct roles for administrators, instructors, and students. The system features course enrollment, progress tracking, certificate generation, and a modern responsive user interface.

---

## ✨ Features

### 🔐 User Management

- **User Registration & Authentication** - Secure signup and login system
- **Role-Based Access Control** - Three distinct user roles (Admin, Instructor, Student)
- **Profile Management** - Users can view and edit their profiles
- **Password Management** - Change and reset password functionality

### 👨‍💼 Admin Panel

- **Dashboard** - System analysis and overview
- **Course Management** - Full CRUD operations for courses
- **User Management** - Manage students and instructors
- **Activate/Deactivate** - Control course and user status
- **Announcements & Notifications** - System-wide communication
- **Reports** - View system analytics and statistics

### 👨‍🏫 Instructor Features

- **Course Creation** - Add new courses with descriptions and thumbnails
- **Course Content Management** - Add chapters and course materials
- **Course Materials** - Upload PDFs, videos, and other learning resources
- **Student Management** - View enrolled students and their progress
- **Certificate Generation** - Issue certificates to students upon course completion
- **Profile Management** - Edit instructor profile information

### 👨‍🎓 Student Features

- **Course Browse** - Search and discover available courses
- **Course Enrollment** - Enroll in courses of interest
- **Learning Dashboard** - Track enrolled courses and progress
- **Course Materials Access** - View and download course content
- **Certificate Collection** - Receive certificates for completed courses
- **Profile Management** - Update student profile

### 🎨 UI/UX Features

- **Responsive Design** - Works seamlessly on desktop, tablet, and mobile
- **Modern Interface** - Built with Bootstrap and Tailwind CSS
- **Intuitive Navigation** - Easy-to-use interface for all user types
- **Rich Content Display** - Support for images, PDFs, and embedded content

---

## 🛠️ Technology Stack

- **Backend:** PHP (OOP approach with MVC pattern)
- **Database:** MySQL
- **Frontend:** HTML5, CSS3, JavaScript
- **CSS Frameworks:** Bootstrap 5, Tailwind CSS
- **Icons:** Remix Icons
- **Server:** Apache (XAMPP/WAMP/LAMP)

---

## 📋 Prerequisites

Before you begin, ensure you have the following installed:

- **XAMPP/WAMP/LAMP** - For local PHP and MySQL environment
  - PHP 7.4 or higher
  - MySQL 5.7 or higher
  - Apache Web Server
- **Web Browser** - Modern browser (Chrome, Firefox, Edge, Safari)
- **Text Editor** (Optional) - VS Code, Sublime Text, or similar

---

## 🚀 Installation

### Step 1: Clone the Repository

```bash
git clone <repository-url>
cd anjubaba-student-course-management-system-3-main
```

### Step 2: Setup Web Server

1. Copy the project folder to your web server directory:
   - **XAMPP:** `C:\xampp\htdocs\`
   - **WAMP:** `C:\wamp64\www\`
   - **LAMP:** `/var/www/html/`

### Step 3: Database Configuration

1. Start Apache and MySQL from XAMPP/WAMP control panel
2. Open phpMyAdmin: `http://localhost/phpmyadmin`
3. Create a new database named `dreamacademydb`
4. Import the database:
   - Click on the `dreamacademydb` database
   - Go to the "Import" tab
   - Choose file: `dreamacademydb.sql`
   - Click "Go" to import

### Step 4: Configure Database Connection

Open `Database.php` and verify the database credentials:

```php
private $host = "localhost";
private $dbName = "dreamacademydb";
private $uName = "root";
private $pass = "";
```

Update these values if your MySQL configuration is different.

### Step 5: Access the Application

Open your web browser and navigate to:

```
http://localhost/anjubaba-student-course-management-system-3-main/
```

---

## 👤 Default Login Credentials

### Admin Account

- **Username:** `admin`
- **Password:** `Test@pass1`

### Test Instructor/Student Accounts

Check the database tables `instructor` and `student` for additional test accounts, or create new accounts through the signup page.

---

## 📁 Project Structure

```
├── Admin/                  # Admin panel files
│   ├── Action/            # Admin action handlers
│   └── inc/               # Admin includes (header, footer, navbar)
├── Instructor/            # Instructor panel files
│   ├── Action/            # Instructor action handlers
│   └── inc/               # Instructor includes
├── Student/               # Student panel files
│   ├── Action/            # Student action handlers
│   └── inc/               # Student includes
├── Models/                # Data models (Admin, Student, Instructor, Course, etc.)
├── Controller/            # Business logic controllers
├── Assets/                # Static assets
│   ├── css/              # Stylesheets
│   ├── js/               # JavaScript files
│   ├── img/              # Images
│   └── fonts/            # Font files
├── Upload/                # User uploaded files
│   ├── profile/          # Profile pictures
│   ├── thumbnail/        # Course thumbnails
│   └── CoursesMaterials/ # Course materials (PDFs, videos)
├── Database/              # Database related files
│   └── migrations/       # Database migration scripts
├── Utils/                 # Utility classes and helper functions
├── Action/                # Main action handlers
├── Config.php             # Site configuration
├── Database.php           # Database connection class
├── index.php              # Landing page
├── login.php              # Login page
├── signup.php             # Registration page
└── dreamacademydb.sql     # Database dump
```

---

## 🗄️ Database Schema

### Main Tables

- **admin** - Administrator accounts
- **instructor** - Instructor profiles and credentials
- **student** - Student profiles and credentials
- **course** - Course information and details
- **chapter** - Course chapters/modules
- **lesson** - Individual lessons within chapters
- **course_material** - Course materials (files, links)
- **enrolled_student** - Student enrollments
- **certificate** - Generated certificates
- **announcement** - System announcements
- **notification** - User notifications

---

## 🎯 Usage Guide

### For Administrators

1. Login with admin credentials
2. Access admin dashboard
3. Manage courses, instructors, and students
4. Monitor system activity and statistics
5. Create announcements and notifications

### For Instructors

1. Register or login to instructor account
2. Create new courses with descriptions and thumbnails
3. Add chapters and lessons to courses
4. Upload course materials (PDFs, videos)
5. Monitor enrolled students
6. Generate certificates for students

### For Students

1. Register or login to student account
2. Browse available courses
3. Enroll in desired courses
4. Access course materials and lessons
5. Track learning progress
6. Download certificates upon completion

---

## 🔒 Security Features

- Password hashing using PHP's `password_hash()` and `password_verify()`
- SQL injection prevention using PDO prepared statements
- Session management for authentication
- Role-based access control
- Input validation and sanitization

---

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 🙏 Acknowledgments

- Bootstrap team for the amazing CSS framework
- Tailwind CSS for utility-first CSS framework
- Remix Icon for beautiful icons
- All contributors who helped improve this project

---
