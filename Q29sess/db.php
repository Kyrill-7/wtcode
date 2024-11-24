<?php
/**
 * Database Connection Script
 */
$host = 'localhost';
$dbname = 'session_management';
$username = 'root'; // Default username for XAMPP
$password = ''; // Default password for XAMPP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
