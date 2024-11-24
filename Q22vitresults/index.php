<?php
/**
 * Student Registration Page
 * Allows students to register their details (name, roll number, and PRN).
 */
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $roll_number = $_POST['roll_number'];
    $prn = $_POST['prn'];

    $stmt = $pdo->prepare("INSERT INTO students (name, roll_number, prn) VALUES (?, ?, ?)");

    try {
        $stmt->execute([$name, $roll_number, $prn]); // Execute the query
        $success = "Registration successful! <a href='marks_entry.php'>Enter Marks</a>";
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
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Roll Number:</label>
        <input type="text" name="roll_number" required><br>
        <label>PRN:</label>
        <input type="text" name="prn" required><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>