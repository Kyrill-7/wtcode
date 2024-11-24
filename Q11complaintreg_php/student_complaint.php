<?php
/**
 * Student Complaint Page
 * Allows logged-in students to submit complaints.
 */
require 'db.php'; // Include the database connection file
session_start(); // Start session for authentication

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect to login if not authenticated
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_SESSION['user_id']; // Get the logged-in student's ID from the session
    $complaint = $_POST['complaint']; // Retrieve the complaint text from the form

    // SQL query to insert the complaint into the database
    $stmt = $pdo->prepare("INSERT INTO complaints (student_id, complaint) VALUES (?, ?)");
    $stmt->execute([$student_id, $complaint]); // Execute the query with the provided data

    $success = "Complaint submitted successfully!"; // Display success message
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register Complaint</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Register Complaint</h1>
    <?php if (isset($success)) echo "<p style='color: green;'>$success</p>"; ?>
    <form method="POST">
        <label>Complaint:</label>
        <textarea name="complaint" rows="5" cols="40" placeholder="Write your complaint here..." required></textarea><br>
        <button type="submit">Submit Complaint</button>
    </form>
    <a href="logout.php">Logout</a>
</body>
</html>
