<?php
/**
 * Database Connection Script
 * This script establishes a connection to the MySQL database using PDO.
 */
$host = 'localhost'; // Database host (default: localhost)
$dbname = 'college_complaints'; // Name of the database
$username = 'root'; // MySQL username (default: root)
$password = ''; // MySQL password (default: empty for XAMPP/WAMP)

try {
    // PDO connection string
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode
} catch (PDOException $e) {
    // Handle connection failure
    die("Database connection failed: " . $e->getMessage());
}
?>
