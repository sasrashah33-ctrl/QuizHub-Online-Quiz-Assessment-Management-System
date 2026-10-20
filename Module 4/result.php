<?php
include "config.php";
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$result_id = intval($_GET["id"]);

$stmt = $conn->prepare("
    SELECT r.score, r.total_questions, q.title
    FROM results r
    JOIN quizzes q ON r.quiz_id = q.id
    WHERE r.id = ? AND r.user_id = ?
");
$stmt->bind_param("ii", $result_id, $_SESSION["user_id"]);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

if (!$result) {
    die("Result not found.");
}

$percent = round(($result["score"] / $result["total_questions"]) * 100);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Result - QuizHub</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="navbar">
        <strong>QuizHub</strong>
        <div><a href="index.php">Back to Quizzes</a></div>
    </div>

    <div class="container" style="text-align:center;">
        <h1><?= htmlspecialchars($result['title']) ?> - Result</h1>
        <p style="font-size:40px; color:#4a148c; font-weight:bold;">
            <?= $result['score'] ?> / <?= $result['total_questions'] ?>
        </p>
        <p>You scored <?= $percent ?>%</p>
        <a class="btn" href="index.php">Try Another Quiz</a>
        <a class="btn" href="history.php">View My History</a>
    </div>
</body>
</html>
