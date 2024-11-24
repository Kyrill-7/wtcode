<?php
/**
 * Dashboard
 * Validates session and enforces a timeout.
 */
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Enforce session timeout (5 minutes = 300 seconds)
if (time() - $_SESSION['last_activity'] > 30) {
    // Remove session from database
    $stmt = $pdo->prepare("DELETE FROM sessions WHERE session_id = ?");
    $stmt->execute([session_id()]);

    session_destroy();
    header("Location: login.php?timeout=true");
    exit();
}

$_SESSION['last_activity'] = time(); // Reset session timer

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to the Dashboard!</h1>
    <p>Your session is active. It will expire after 5 minutes of inactivity.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
