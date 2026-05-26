-- db_seed.sql for TutorLink-Lite
CREATE DATABASE IF NOT EXISTS tutorlink_lite CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE tutorlink_lite;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('student','tutor','admin') NOT NULL DEFAULT 'student',
  name VARCHAR(150) NOT NULL,
  city VARCHAR(100),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS tutors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  title VARCHAR(150),
  subjects VARCHAR(255),
  hourly_rate DECIMAL(8,2),
  bio TEXT,
  experience INT,
  video_url VARCHAR(255),
  teaching_mode ENUM('online','in-person','hybrid') DEFAULT 'online',
  rating DECIMAL(2,1) DEFAULT 0,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  tutor_id INT NOT NULL,
  session_date DATETIME,
  status ENUM('booked','completed','cancelled') DEFAULT 'booked',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (student_id) REFERENCES users(id),
  FOREIGN KEY (tutor_id) REFERENCES tutors(id)
);

CREATE TABLE IF NOT EXISTS reviews (
  id INT AUTO_INCREMENT PRIMARY KEY,
  booking_id INT NOT NULL,
  rating INT NOT NULL,
  comment TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE
);

-- Seed users (password is 'Password123' hashed)
INSERT INTO users (email,password_hash,role,name,city) VALUES
('tutor1@example.com', 'REPLACE_WITH_HASH', 'tutor', 'Ahmed Tutor', 'Riyadh'),
('tutor2@example.com', 'REPLACE_WITH_HASH', 'tutor', 'Mona Tutor', 'Jeddah'),
('student1@example.com', 'REPLACE_WITH_HASH', 'student', 'Sara Student', 'Jeddah'),
('student2@example.com', 'REPLACE_WITH_HASH', 'student', 'Faisal Student', 'Riyadh');

-- After importing, please run the following UPDATE to set password hashes for demo accounts.
-- Example PHP to generate a hash: <?php echo password_hash('Password123', PASSWORD_DEFAULT); ?>

-- Sample tutor profiles (you may need to adjust user_id according to inserted ids)
INSERT INTO tutors (user_id,title,subjects,hourly_rate,bio,experience,video_url,teaching_mode,rating) VALUES
(1,'Math Tutor','Math,Calculus,Algebra',80.00,'I explain concepts simply',5,'uploads/videos/sample1.mp4','online',4.5),
(2,'Physics Tutor','Physics,Mechanics',100.00,'Physics with clear examples',6,'uploads/videos/sample2.mp4','in-person',4.7);
