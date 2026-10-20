<?php
include "config.php";
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$quizzes = $conn->query("
    SELECT q.id, q.title, q.duration_minutes, c.name AS category, COUNT(qs.id) AS question_count
    FROM quizzes q
    LEFT JOIN categories c ON q.category_id = c.id
    LEFT JOIN questions qs ON qs.quiz_id = q.id
    GROUP BY q.id
    ORDER BY q.id DESC
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>QuizHub - Available Quizzes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="navbar">
        <strong>QuizHub</strong>
        <div>
            <a href="index.php">Quizzes</a>
            <a href="history.php">My History</a>
            <a href="leaderboard.php">Leaderboard</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>Hi, <?= htmlspecialchars($_SESSION["full_name"]) ?>! Pick a quiz</h1>

        <?php while ($q = $quizzes->fetch_assoc()): ?>
            <div class="quiz-card">
                <h2><?= htmlspecialchars($q['title']) ?></h2>
                <p>Category: <?= htmlspecialchars($q['category']) ?> &nbsp;|&nbsp;
                   <?= $q['question_count'] ?> Questions &nbsp;|&nbsp;
                   <?= $q['duration_minutes'] ?> minutes</p>
                <a class="btn" href="quiz.php?id=<?= $q['id'] ?>">Start Quiz</a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
