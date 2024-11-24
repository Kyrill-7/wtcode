<?php
/**
 * Admin Dashboard
 * Displays all complaints submitted by students to the admin.
 */
require 'db.php'; // Include the database connection file
session_start(); // Start session for authentication

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php"); // Redirect to admin login if not authenticated
    exit();
}

// SQL query to fetch all complaints and the associated student usernames
$stmt = $pdo->query("
    SELECT c.id, u.username, c.complaint, c.timestamp 
    FROM complaints c 
    JOIN users u ON c.student_id = u.id
");
$complaints = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all complaints
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <h2>All Complaints</h2>
    <table border="1" style="width: 100%; text-align: left;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student Username</th>
                <th>Complaint</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($complaints as $complaint): ?>
            <tr>
                <td><?php echo $complaint['id']; ?></td>
                <td><?php echo $complaint['username']; ?></td>
                <td><?php echo $complaint['complaint']; ?></td>
                <td><?php echo $complaint['timestamp']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="logout.php">Logout</a>
</body>
</html>
