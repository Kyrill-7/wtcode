<?php
/**
 * View Results Page
 * Displays the semester results for all students.
 */
require 'db.php';

// SQL query to fetch results along with student details
$stmt = $pdo->query("
    SELECT 
        s.name AS student_name, 
        s.roll_number, 
        r.cn_total, r.wt_total, r.sdm_total, r.daa_total, 
        r.overall_percentage 
    FROM results r 
    JOIN students s ON r.student_id = s.id
");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Semester Results</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Roll Number</th>
                <th>CN Total</th>
                <th>WT Total</th>
                <th>SDM Total</th>
                <th>DAA Total</th>
                <th>Overall Percentage</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $result): ?>
            <tr>
                <td><?php echo htmlspecialchars($result['student_name']); ?></td>
                <td><?php echo htmlspecialchars($result['roll_number']); ?></td>
                <td><?php echo number_format($result['cn_total'], 2); ?></td>
                <td><?php echo number_format($result['wt_total'], 2); ?></td>
                <td><?php echo number_format($result['sdm_total'], 2); ?></td>
                <td><?php echo number_format($result['daa_total'], 2); ?></td>
                <td><?php echo number_format($result['overall_percentage'], 2); ?>%</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php">Back to Registration</a>
</body>
</html>
