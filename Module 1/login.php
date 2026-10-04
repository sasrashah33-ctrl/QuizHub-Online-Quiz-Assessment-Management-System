<?php
include "config.php";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, full_name, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // password_verify checks the typed password against the saved hash
        if (password_verify($password, $user["password"])) {
            // Save who is logged in, in the session, so other pages know
            $_SESSION["user_id"]   = $user["id"];
            $_SESSION["full_name"] = $user["full_name"];
            $_SESSION["role"]      = $user["role"];

            if ($user["role"] == "admin") {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit;
        } else {
            $error = "Wrong password.";
        }
    } else {
        $error = "No account found with that email.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - QuizHub</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="navbar">
        <strong>QuizHub</strong>
        <div><a href="register.php">Register</a></div>
    </div>

    <div class="container">
        <h1>Login</h1>
        <?php if (isset($_GET["registered"])) echo "<p class='success'>Account created! Please login.</p>"; ?>
        <?php if ($error) echo "<p class='error'>$error</p>"; ?>

        <form method="POST">
            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>
