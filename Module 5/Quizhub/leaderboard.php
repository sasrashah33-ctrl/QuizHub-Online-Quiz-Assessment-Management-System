<?php
include "config.php";
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Top 10 attempts across everyone, best scores first
$top = $conn->query("
    SELECT u.full_name, q.title, r.score, r.total_questions
    FROM results r
    JOIN users u ON r.user_id = u.id
    JOIN quizzes q ON r.quiz_id = q.id
    ORDER BY (r.score / r.total_questions) DESC, r.attempted_at ASC
    LIMIT 10
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard - QuizHub</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="navbar">
        <strong>QuizHub</strong>
        <div>
            <a href="index.php">Quizzes</a>
            <a href="history.php">My History</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>🏆 Leaderboard - Top 10</h1>
        <table>
            <tr><th>Rank</th><th>Name</th><th>Quiz</th><th>Score</th></tr>
            <?php $rank = 1; while ($row = $top->fetch_assoc()): ?>
            <tr>
                <td><?= $rank++ ?></td>
                <td><?= htmlspecialchars($row['full_name']) ?></td>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= $row['score'] ?> / <?= $row['total_questions'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
