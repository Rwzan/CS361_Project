# TutorLink-Lite (CS361 Project)

TutorLink-Lite is a web-based student-tutor matching platform designed to connect students with trusted tutors. The application allows users to register as either students or tutors, search and filter for profiles by subject, location, or price, compare multiple tutors side-by-side, and manage lesson bookings via a centralized dashboard.

---

## 🚀 Features

* **User Authentication & Roles:** Secure signup and login for **Students**, **Tutors**, and **Admins** with secure client-side form validation.
* **Smart Search & Previews:** Dynamic, asynchronous homepage preview and filtering capabilities to find tutors quickly.
* **Side-by-Side Comparison:** Interactive comparison matrix allowing users to evaluate up to 3 tutors simultaneously, complete with video preview integration.
* **Booking System:** Complete end-to-end scheduling logic linking students directly with their selected tutors.
* **Personalized Dashboards:** Dedicated operational views tailored specifically to a user's role (Student vs. Tutor).

---

## 📂 Project Structure

```text
CS361_Project/
│
├── css/
│   └── style.css            # Main application styling (responsive design)
│
├── js/
│   ├── main.js              # Client-side dynamic homepage previews 
│   ├── compare.js           # Multi-tutor comparison matrix logic
│   └── signup_validation.js # Client-side registration validation
│
├── php/                     # Server-side business logic and pages
│   ├── db.php               # Database connection setup
│   ├── auth.php             # Session management
│   ├── signup.php / login.php
│   ├── search.php           # Core search system and API endpoints
│   ├── book.php             # Handles session scheduling logic
│   ├── dashboard_student.php
│   ├── dashboard_tutor.php
│   └── ... (additional views and mutations)
│
├── uploads/videos/          # Storage directory for tutor video introductions
│   ├── sample1.mp4
│   └── sample2.mp4
│
├── db_seed.sql              # MySQL schema definition and demo seed data
├── index.php                # System homepage / application entry point
└── README.md
🛠️ Installation & Setup
1. Environment Requirements
PHP: version 8.0 or newer recommended.

Database: MySQL / MariaDB server.

An active local server suite such as XAMPP, MAMP, or Laragon.

2. Database Initialization
Open your database administration tool (e.g., phpMyAdmin) or use your MySQL CLI.

Import the db_seed.sql file to create the tutorlink_lite database and populate its structural tables (users, tutors, bookings, reviews).

Note: Make sure to update the REPLACE_WITH_HASH placeholders inside the seeded rows with valid PHP password hashes if you intend to log into the demo accounts.

PHP
// Generate a secure hash using:
echo password_hash('Password123', PASSWORD_DEFAULT);
3. Connection Configuration
Ensure your credentials inside php/db.php reflect your local environment:

PHP
$host = 'localhost';
$db   = 'tutorlink_lite';
$user = 'root'; // Update to your DB username
$pass = '';     // Update to your DB password
4. Running Locally
Clone the project directly into your server's root directory (e.g., htdocs or www):

Bash
git clone [https://github.com/Rwzan/CS361_Project.git](https://github.com/Rwzan/CS361_Project.git)
Open your browser and navigate to http://localhost/CS361_Project/index.php.
