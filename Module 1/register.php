<?php
include "config.php";
$error = "";

// This block runs only when the form is submitted (POST request)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST["full_name"]);
    $email     = trim($_POST["email"]);
    $password  = $_POST["password"];

    // Turn the plain password into a secure hash before saving it.
    // We NEVER store the real password in the database.
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepared statement = safe way to insert data (prevents SQL injection)
    $stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $full_name, $email, $hashed_password);

    if ($stmt->execute()) {
        header("Location: login.php?registered=1");
        exit;
    } else {
        $error = "That email is already registered. Try logging in instead.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register - QuizHub</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="navbar">
        <strong>QuizHub</strong>
        <div><a href="login.php">Login</a></div>
    </div>

    <div class="container">
        <h1>Create an Account</h1>
        <?php if ($error) echo "<p class='error'>$error</p>"; ?>

        <form method="POST">
            <label>Full Name</label>
            <input type="text" name="full_name" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required minlength="6">

            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
