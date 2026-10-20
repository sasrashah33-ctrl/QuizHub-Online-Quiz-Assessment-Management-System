<?php
include "../config.php";

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "admin") {
    header("Location: ../login.php");
    exit;
}

$totalQuizzes    = $conn->query("SELECT COUNT(*) AS c FROM quizzes")->fetch_assoc()["c"];
$totalQuestions  = $conn->query("SELECT COUNT(*) AS c FROM questions")->fetch_assoc()["c"];
$totalUsers      = $conn->query("SELECT COUNT(*) AS c FROM users WHERE role='student'")->fetch_assoc()["c"];
$totalAttempts   = $conn->query("SELECT COUNT(*) AS c FROM results")->fetch_assoc()["c"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - QuizHub</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="navbar">
        <strong>QuizHub Admin</strong>
        <div>
            <a href="dashboard.php">Dashboard</a>
            <a href="add_quiz.php">Add Quiz</a>
            <a href="manage_quizzes.php">Manage Quizzes</a>
            <a href="add_question.php">Add Question</a>
            <a href="../logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>Welcome, <?= htmlspecialchars($_SESSION["full_name"]) ?></h1>
        <table>
            <tr><th>Total Quizzes</th><td><?= $totalQuizzes ?></td></tr>
            <tr><th>Total Questions</th><td><?= $totalQuestions ?></td></tr>
            <tr><th>Total Students</th><td><?= $totalUsers ?></td></tr>
            <tr><th>Total Quiz Attempts</th><td><?= $totalAttempts ?></td></tr>
        </table>
        <p style="margin-top:20px;">
            <a class="btn" href="add_quiz.php">+ Add New Quiz</a>
            <a class="btn" href="add_question.php">+ Add Question</a>
        </p>
    </div>
</body>
</html>
