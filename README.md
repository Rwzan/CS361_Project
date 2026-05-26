
# CS361_Project

## TutorLink-Lite

A simple tutor–student matching platform built with **PHP, MySQL, HTML, CSS, and JavaScript**.

---

## 📌 Overview

TutorLink-Lite helps students find tutors easily by searching and filtering based on:

- Subject
- City
- Hourly rate
- Teaching mode (online / in-person)
- Ratings

Students can also compare tutors side-by-side and book sessions.

---

## 🚀 Features

### 👨‍🎓 For Students
- Sign up and log in
- Search for tutors
- Filter by subject, city, and price
- Compare up to 3 tutors
- Book tutoring sessions
- View dashboard

### 👩‍🏫 For Tutors
- Create tutor profile
- Add subjects and hourly rate
- Upload intro video (sample support included)
- Manage bookings via dashboard

### ⚙️ General Features
- Authentication system (session-based)
- Role-based dashboards (student / tutor)
- Client-side validation (signup form)
- Tutor comparison tool
- Responsive UI design

---

## 🛠️ Tech Stack

- **Frontend:** HTML, CSS, JavaScript  
- **Backend:** PHP  
- **Database:** MySQL  
- **Server:** Apache (XAMPP / WAMP recommended)

---

## 🗂️ Project Structure

```

CS361_Project/
│
├── css/                  # Stylesheets
├── js/                   # JavaScript files
├── php/                  # Backend PHP logic
├── uploads/videos/      # Tutor demo videos
│
├── index.php            # Home page
├── db_seed.sql          # Database schema + sample data
└── README.md

````

---

## 🗄️ Database Setup

1. Create a MySQL database:
```sql
CREATE DATABASE tutorlink_lite;
````

2. Import the file:

```
db_seed.sql
```

3. Update `db.php` with your database credentials.

---

## ▶️ How to Run the Project

1. Install **XAMPP / WAMP**
2. Place project inside `htdocs/`
3. Start Apache & MySQL
4. Import database (`db_seed.sql`)
5. Open in browser:

```
http://localhost/CS361_Project/index.php
```

---

## 🔐 Default Accounts (Demo)

You can create accounts via signup page or use seeded users in database.

---

## 📸 Preview

* Home page with search bar
* Tutor comparison tool
* Student & tutor dashboards
* Booking system

---

## 📌 Notes

* This is a student project (CS361)
* Some features are simplified for learning purposes
* Passwords should be hashed using `password_hash()` in PHP

---

## 👩‍💻 Author

Rwzan and CS361 Project Team
