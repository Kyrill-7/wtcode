<?php
/**
 * Logout Script
 * Ends the user's session and removes it from the database.
 */
session_start();
require 'db.php';

if (isset($_SESSION['user_id'])) {
    // Remove session from database
    $stmt = $pdo->prepare("DELETE FROM sessions WHERE session_id = ?");
    $stmt->execute([session_id()]);
}

session_destroy();
header("Location: login.php");
exit();
?>
