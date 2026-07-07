-- PMS database for Placement Management System
CREATE DATABASE IF NOT EXISTS pms;
USE pms;

CREATE TABLE IF NOT EXISTS students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  roll_no VARCHAR(50),
  department VARCHAR(100),
  cgpa FLOAT,
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  resume VARCHAR(255),
  status VARCHAR(50) DEFAULT 'Not Placed',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS applications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT,
  company_id INT,
  status VARCHAR(50) DEFAULT 'Applied',
  applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
  FOREIGN KEY (company_id) REFERENCES companies(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE,
  password VARCHAR(255)
);

INSERT INTO admin (username, password)
VALUES ('admin', MD5('admin123'))
ON DUPLICATE KEY UPDATE username=username;
