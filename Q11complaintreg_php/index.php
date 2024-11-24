<?php
/**
 * Student Login Page
 * Allows students to log in using their registered credentials.
 */
require 'db.php'; // Include the database connection file
session_start(); // Start a session for user authentication

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username']; // Retrieve the username from the form
    $password = md5($_POST['password']); // Hash the password using MD5

    // SQL query to verify student credentials
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ? AND role = 'student'");
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch user details if credentials match

    if ($user) {
        $_SESSION['user_id'] = $user['id']; // Store user ID in the session
        header("Location: student_complaint.php"); // Redirect to the complaint page
        exit();
    } else {
        $error = "Invalid credentials!"; // Handle incorrect login attempts
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Student Login</h1>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
    <p>Not registered? <a href="register.php">Register here</a>.</p>
    <p>Admin? <a href="admin_login.php">Login here</a>.</p>
</body>
</html>
