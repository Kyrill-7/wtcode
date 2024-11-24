Step 1: Install Required Software
Install XAMPP (or WAMP)

Download XAMPP from Apache Friends.
Install and launch XAMPP.
Ensure Apache and MySQL services are running in the XAMPP Control Panel.
Install a Code Editor

Install Visual Studio Code or any code editor of your choice.
Verify Installation

Open your browser and navigate to http://localhost. You should see the XAMPP welcome page.
Step 2: Set Up the Database
Access phpMyAdmin

Open your browser and go to http://localhost/phpmyadmin.
Create a New Database

Click on the "New" option in phpMyAdmin.
Enter the database name: vit_results.
Click Create.
Run SQL Script

Select the vit_results database from the left sidebar.
Click on the "SQL" tab.
Copy and paste the following SQL script to create the required tables:
sql
Copy code
-- Create students table
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    roll_number VARCHAR(20) NOT NULL UNIQUE,
    prn VARCHAR(20) NOT NULL UNIQUE
);

-- Create results table
CREATE TABLE results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    cn_mse FLOAT NOT NULL,
    cn_ese FLOAT NOT NULL,
    wt_mse FLOAT NOT NULL,
    wt_ese FLOAT NOT NULL,
    sdm_mse FLOAT NOT NULL,
    sdm_ese FLOAT NOT NULL,
    daa_mse FLOAT NOT NULL,
    daa_ese FLOAT NOT NULL,
    cn_total FLOAT NOT NULL,
    wt_total FLOAT NOT NULL,
    sdm_total FLOAT NOT NULL,
    daa_total FLOAT NOT NULL,
    overall_percentage FLOAT NOT NULL,
    prn VARCHAR(20) UNIQUE AFTER roll_number,
    FOREIGN KEY (student_id) REFERENCES students(id)
);
Step 3: Configure the Project Files
Download the Project Files

Create a folder named vit_results in the htdocs directory of XAMPP (C:\xampp\htdocs\).
Save all project files (index.php, marks_entry.php, view_results.php, db.php, and style.css) in the vit_results folder.
Ensure the folder structure looks like this:
makefile
Copy code
C:\xampp\htdocs\vit_results\
├── index.php
├── marks_entry.php
├── view_results.php
├── db.php
├── css/
    └── style.css
Edit Database Connection (db.php)

Open the db.php file and ensure the database credentials match your setup. For most XAMPP installations:
php
Copy code
$host = 'localhost';
$dbname = 'vit_results';
$username = 'root'; // Default username for XAMPP
$password = ''; // Default password for XAMPP
Step 4: Start the Application
Start Apache and MySQL

Open the XAMPP Control Panel.
Click Start for both Apache and MySQL.
Access the Application

Open your browser and go to:
Student Registration: http://localhost/vit_results/index.php
Marks Entry: http://localhost/vit_results/marks_entry.php
View Results: http://localhost/vit_results/view_results.php
Step 5: Application Workflow
Register a Student

Navigate to the Student Registration Page (index.php).
Enter the student's Name, Roll Number, and PRN.
Submit the form. A success message will confirm registration.
Enter Marks

Navigate to the Marks Entry Page (marks_entry.php).
Enter the PRN and marks for all subjects (MSE and ESE).
Ensure marks are between 0 and 100. If marks exceed 100, an error will be displayed.
View Results

Navigate to the View Results Page (view_results.php).
View the results table, which includes:
Student Name
Roll Number
Subject-Wise Totals
Overall Percentage
Troubleshooting
Error: "Access Denied for User 'root'"

Ensure your db.php file has the correct database credentials.
The default username is root, and the password is empty for XAMPP.
Error: "Table Doesn't Exist"

Verify the database and table setup in phpMyAdmin.
Rerun the SQL script if needed.
Blank Page

Check the PHP error log located at C:\xampp\php\logs\php_error_log.





















---------------------phpMyadmin MySQL database--------------------
CREATE DATABASE vit_results;

USE vit_results;

-- Students Table
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    roll_number VARCHAR(20) NOT NULL UNIQUE
);

-- Results Table
CREATE TABLE results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    cn_mse FLOAT NOT NULL,
    cn_ese FLOAT NOT NULL,
    wt_mse FLOAT NOT NULL,
    wt_ese FLOAT NOT NULL,
    sdm_mse FLOAT NOT NULL,
    sdm_ese FLOAT NOT NULL,
    daa_mse FLOAT NOT NULL,
    daa_ese FLOAT NOT NULL,
    cn_total FLOAT NOT NULL,
    wt_total FLOAT NOT NULL,
    sdm_total FLOAT NOT NULL,
    daa_total FLOAT NOT NULL,
    overall_percentage FLOAT NOT NULL,
    prn VARCHAR(20) UNIQUE AFTER roll_number,
    FOREIGN KEY (student_id) REFERENCES students(id)
);
