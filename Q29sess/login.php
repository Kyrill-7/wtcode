<?php
/**
 * Login Script
 * Manages user login and enforces session limits and expiration.
 */
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Dummy authentication (replace with your actual user validation logic)
    if ($username === 'user' && $password === 'password') {
        $user_id = 1; // Fixed user ID for simplicity (in real systems, fetch from DB)
        $session_id = session_id();

        // Check active sessions for the user
        $stmt = $pdo->prepare("SELECT COUNT(*) AS active_sessions FROM sessions WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $active_sessions = $stmt->fetch(PDO::FETCH_ASSOC)['active_sessions'];

        if ($active_sessions >= 3) {
            $error = "Maximum concurrent sessions reached. Please log out from another device.";
        } else {
            // Add session to database
            $stmt = $pdo->prepare("INSERT INTO sessions (user_id, session_id) VALUES (?, ?)");
            $stmt->execute([$user_id, $session_id]);

            $_SESSION['user_id'] = $user_id;
            $_SESSION['last_activity'] = time(); // Track session start time

            header("Location: dashboard.php");
            exit();
        }
    } else {
        $error = "Invalid credentials!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
