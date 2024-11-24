Step 1: Install Required Software
Install XAMPP (or WAMP)

Download XAMPP from Apache Friends.
Install XAMPP and ensure Apache and MySQL are installed.
Start the XAMPP Control Panel and verify both Apache and MySQL services are running.
Install a Code Editor

Download Visual Studio Code or any other text editor (e.g., Sublime Text, Atom).
Verify Installation

Open your browser and navigate to http://localhost. You should see the XAMPP welcome page.
Step 2: Set Up the Database
Access phpMyAdmin

Open your browser and go to http://localhost/phpmyadmin.
Create a New Database

Click on the "New" option in phpMyAdmin.
Enter the database name: student_management.
Click Create.
Run SQL Script

Select the student_management database from the left sidebar.
Click on the "SQL" tab.
Copy and paste the following SQL script to create the required table:
sql
Copy code
-- Create students table
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    roll_number VARCHAR(20) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL
);
Step 3: Configure the Project Files
Download the Project Files

Create a folder named student_records in the htdocs directory of XAMPP (C:\xampp\htdocs\).
Save the following project files (index.php, db.php, add_student.php, delete_student.php, style.css, and validation.js) in the student_records folder.
Project Folder Structure

makefile
Copy code
C:\xampp\htdocs\student_records\
├── index.php
├── db.php
├── add_student.php
├── delete_student.php
├── css/
│   └── style.css
├── js/
    └── validation.js
Edit Database Connection (db.php)

Open the db.php file and ensure the database credentials match your setup. For most XAMPP installations:
php
Copy code
$host = 'localhost';
$dbname = 'student_management';
$username = 'root'; // Default username for XAMPP
$password = ''; // Default password for XAMPP
Step 4: Run the Application
Start Apache and MySQL

Open the XAMPP Control Panel.
Click Start for both Apache and MySQL.
Access the Application

Open your browser and navigate to:
Main Page: http://localhost/student_records/index.php
Step 5: Application Workflow
Add a Student

On the main page (index.php), enter the student details (Name, Roll Number, Email).
Click Add Student.
JavaScript validation will ensure fields are not empty and email format is valid.
If successful, the student will be added to the database, and the list will update.
Delete a Student

Click the Delete button next to a student record to remove it.
The record will be removed from the database, and the page will refresh.
View All Students

The main page will display all students currently stored in the database.