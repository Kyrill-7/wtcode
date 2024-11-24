<?php
/**
 * Database Connection Script
 * This script establishes a connection to the MySQL database using PDO.
 */
$host = 'localhost'; // Database host
$dbname = 'vit_results'; // Database name
$username = 'root'; // MySQL username
$password = ''; // MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable error handling
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>