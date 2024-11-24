<?php
/**
 * Student Registration Page
 * Allows students to register with a username and password.
 */
require 'db.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username']; // Retrieve the username from the form
    $password = md5($_POST['password']); // Hash the password using MD5 for security

    // SQL query to insert the new student into the users table
    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'student')");

    try {
        $stmt->execute([$username, $password]); // Execute the query with provided values
        $success = "Registration successful! <a href='index.php'>Login here</a>";
    } catch (PDOException $e) {
        $error = "Registration failed: " . $e->getMessage(); // Handle registration errors
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Student Registration</h1>
    <?php if (isset($success)) echo "<p style='color: green;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
