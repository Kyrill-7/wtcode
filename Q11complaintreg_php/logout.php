<?php
/**
 * Logout Script
 * Logs out the current user (student or admin) by destroying the session.
 */
session_start(); // Start the session
session_destroy(); // Destroy the session to log out the user
header("Location: index.php"); // Redirect to the student login page
exit();
?>
