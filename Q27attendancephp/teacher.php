<?php
/**
 * Teacher Attendance Page
 * Allows teachers to mark attendance for students using checkboxes.
 */
require 'db.php';

// Fetch all students
$stmt = $pdo->query("SELECT * FROM students");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $attendance_date = $_POST['date'];

    foreach ($students as $student) {
        $student_id = $student['id'];
        $status = isset($_POST['attendance'][$student_id]) ? 'Present' : 'Absent';

        // Insert attendance record into the database
        $stmt = $pdo->prepare("INSERT INTO attendance (student_id, date, status) VALUES (?, ?, ?)");
        $stmt->execute([$student_id, $attendance_date, $status]);
    }

    $success = "Attendance marked successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mark Attendance</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Mark Attendance</h1>
    <?php if (isset($success)) echo "<p style='color: green;'>$success</p>"; ?>
    <form method="POST">
        <label>Date:</label>
        <input type="date" name="date" required><br><br>
        <table border="1">
            <thead>
                <tr>
                    <th>Roll Number</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Present</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student['roll_number']); ?></td>
                    <td><?php echo htmlspecialchars($student['name']); ?></td>
                    <td><?php echo htmlspecialchars($student['class']); ?></td>
                    <td>
                        <input type="checkbox" name="attendance[<?php echo $student['id']; ?>]" value="Present">
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="submit">Submit Attendance</button>
    </form>
</body>
</html>
