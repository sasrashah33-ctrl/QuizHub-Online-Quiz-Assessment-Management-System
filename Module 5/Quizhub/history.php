<?php
include "config.php";
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$stmt = $conn->prepare("
    SELECT r.score, r.total_questions, r.attempted_at, q.title
    FROM results r
    JOIN quizzes q ON r.quiz_id = q.id
    WHERE r.user_id = ?
    ORDER BY r.attempted_at DESC
");
$stmt->bind_param("i", $_SESSION["user_id"]);
$stmt->execute();
$history = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My History - QuizHub</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="navbar">
        <strong>QuizHub</strong>
        <div>
            <a href="index.php">Quizzes</a>
            <a href="leaderboard.php">Leaderboard</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>My Quiz History</h1>
        <table>
            <tr><th>Quiz</th><th>Score</th><th>Date</th></tr>
            <?php while ($row = $history->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= $row['score'] ?> / <?= $row['total_questions'] ?></td>
                <td><?= date("d M Y, h:i A", strtotime($row['attempted_at'])) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
