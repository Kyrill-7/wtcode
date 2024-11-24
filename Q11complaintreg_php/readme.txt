----------PROJECT DIRECTORY----------
project/
├── index.php              (Student Login Page)
├── register.php           (Student Registration Page)
├── student_complaint.php  (Complaint Registration Page)
├── admin_login.php        (Admin Login Page)
├── admin_dashboard.php    (Admin Dashboard to List Complaints)
├── db.php                 (Database Connection File)
├── logout.php             (Logout Script)
├── css/
│   └── style.css          (Custom Styling)


----------phpMyAdmin MySQL Database----------

-- Create the database
CREATE DATABASE college_complaints;

USE college_complaints;

-- Create a users table for student and admin credentials
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'admin') NOT NULL
);

-- Create a complaints table to store student complaints
CREATE TABLE complaints (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    complaint TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES users(id)
);

-- Insert fixed admin credentials (username: admin, password: vit123)
INSERT INTO users (username, password, role) VALUES 
('admin', MD5('vit123'), 'admin');



----------STEPS TO RUN CODE----------
Steps to Run the Project
Step 1: Install Required Tools
Download and Install XAMPP or WAMP:
XAMPP: Download XAMPP
WAMP: Download WAMP
Install a Database Client (Optional):
Use phpMyAdmin (comes with XAMPP/WAMP) or tools like MySQL Workbench.

Step 2: Set Up the Database
Open phpMyAdmin (via http://localhost/phpmyadmin).
Execute the provided SQL script to create the database and tables.

Step 3: Configure Files
Save all the provided files in the htdocs/project/ directory (for XAMPP).

Step 4: Run the Application
Start Apache and MySQL from the XAMPP Control Panel.
Access the application in your browser:
Student Registration: http://localhost/project/register.php
Student Login: http://localhost/project/index.php
Admin Login: http://localhost/project/admin_login.php

Step 5: Test Credentials
Use Admin Credentials:
Username: admin
Password: vit123
Register as a student and test login/complaint submission functionality.


