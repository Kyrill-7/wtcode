<?php
/**
 * Marks Entry Page
 * Allows students to enter MSE and ESE marks for each subject using PRN.
 * Validates that marks do not exceed 100.
 */
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prn = $_POST['prn'];
    $cn_mse = $_POST['cn_mse'];
    $cn_ese = $_POST['cn_ese'];
    $wt_mse = $_POST['wt_mse'];
    $wt_ese = $_POST['wt_ese'];
    $sdm_mse = $_POST['sdm_mse'];
    $sdm_ese = $_POST['sdm_ese'];
    $daa_mse = $_POST['daa_mse'];
    $daa_ese = $_POST['daa_ese'];

    // Server-side validation: ensure all marks are <= 100
    if (
        $cn_mse > 100 || $cn_ese > 100 || 
        $wt_mse > 100 || $wt_ese > 100 || 
        $sdm_mse > 100 || $sdm_ese > 100 || 
        $daa_mse > 100 || $daa_ese > 100
    ) {
        $error = "Marks must not exceed 100. Please check your inputs.";
    } else {
        // Validate if the PRN exists in the students table
        $stmt = $pdo->prepare("SELECT * FROM students WHERE prn = ?");
        $stmt->execute([$prn]);
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$student) {
            $error = "Invalid PRN! Please ensure the student is registered before entering marks.";
        } else {
            $student_id = $student['id']; // Retrieve student ID from the database for foreign key

            // Calculate total marks for each subject
            $cn_total = ($cn_mse * 0.3) + ($cn_ese * 0.7);
            $wt_total = ($wt_mse * 0.3) + ($wt_ese * 0.7);
            $sdm_total = ($sdm_mse * 0.3) + ($sdm_ese * 0.7);
            $daa_total = ($daa_mse * 0.3) + ($daa_ese * 0.7);

            // Calculate overall percentage
            $overall_percentage = ($cn_total + $wt_total + $sdm_total + $daa_total) / 4;

            // Insert marks into the results table
            $stmt = $pdo->prepare("
                INSERT INTO results 
                (student_id, cn_mse, cn_ese, wt_mse, wt_ese, sdm_mse, sdm_ese, daa_mse, daa_ese, cn_total, wt_total, sdm_total, daa_total, overall_percentage) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ");

            $stmt->execute([
                $student_id, $cn_mse, $cn_ese, $wt_mse, $wt_ese, $sdm_mse, $sdm_ese, $daa_mse, $daa_ese,
                $cn_total, $wt_total, $sdm_total, $daa_total, $overall_percentage
            ]);

            $success = "Marks entered successfully! <a href='view_results.php'>View Results</a>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Enter Marks</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Enter Marks</h1>
    <?php if (isset($success)) echo "<p style='color: green;'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="POST" style="max-width: 600px; margin: 0 auto;">
        <label>PRN:</label>
        <input type="text" name="prn" required><br>
        <label>CN MSE:</label>
        <input type="number" name="cn_mse" required min="0" max="100"><br>
        <label>CN ESE:</label>
        <input type="number" name="cn_ese" required min="0" max="100"><br>
        <label>WT MSE:</label>
        <input type="number" name="wt_mse" required min="0" max="100"><br>
        <label>WT ESE:</label>
        <input type="number" name="wt_ese" required min="0" max="100"><br>
        <label>SDM MSE:</label>
        <input type="number" name="sdm_mse" required min="0" max="100"><br>
        <label>SDM ESE:</label>
        <input type="number" name="sdm_ese" required min="0" max="100"><br>
        <label>DAA MSE:</label>
        <input type="number" name="daa_mse" required min="0" max="100"><br>
        <label>DAA ESE:</label>
        <input type="number" name="daa_ese" required min="0" max="100"><br>
        <button type="submit">Submit Marks</button>
    </form>
</body>
</html>
