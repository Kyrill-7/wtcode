<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

echo "<h1>Welcome, " . htmlspecialchars($_SESSION['user']) . "!</h1>";
if (isset($_COOKIE['last_login'])) {
    echo "<p>Last login: " . htmlspecialchars($_COOKIE['last_login']) . "</p>";
}
?>

<a href="logout.php">Logout</a>
