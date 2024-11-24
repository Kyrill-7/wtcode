<?php
// register.php
include('db_config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $user_type = $_POST['user_type']; // farmer or customer

    // Check if email exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        echo "Email already registered!";
    } else {
        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, user_type) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $email, $password, $user_type]);

        $_SESSION['user_id'] = $pdo->lastInsertId();
        $_SESSION['user_type'] = $user_type;
        header("Location: index.php"); // Redirect to home
    }
}
?>

<!-- Registration Form -->
<form method="POST" action="register.php">
    Username: <input type="text" name="username" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    User Type:
    <select name="user_type">
        <option value="farmer">Farmer</option>
        <option value="customer">Customer</option>
    </select><br>
    <input type="submit" value="Register">
</form>
