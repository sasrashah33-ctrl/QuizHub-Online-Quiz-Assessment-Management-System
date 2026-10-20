<?php
include "config.php";
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$quiz_id = intval($_GET["id"]);

$stmt = $conn->prepare("SELECT * FROM quizzes WHERE id = ?");
$stmt->bind_param("i", $quiz_id);
$stmt->execute();
$quiz = $stmt->get_result()->fetch_assoc();

if (!$quiz) {
    die("Quiz not found.");
}

$stmt2 = $conn->prepare("SELECT * FROM questions WHERE quiz_id = ?");
$stmt2->bind_param("i", $quiz_id);
$stmt2->execute();
$questions = $stmt2->get_result();

$durationSeconds = $quiz["duration_minutes"] * 60;
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($quiz['title']) ?> - QuizHub</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="navbar">
        <strong>QuizHub</strong>
        <div><a href="index.php">Back to Quizzes</a></div>
    </div>

    <div class="container">
        <h1><?= htmlspecialchars($quiz['title']) ?></h1>
        <div class="timer" id="timerDisplay"></div>

        <form method="POST" action="submit_quiz.php" id="quizForm">
            <input type="hidden" name="quiz_id" value="<?= $quiz_id ?>">

            <?php $num = 1; while ($q = $questions->fetch_assoc()): ?>
                <div class="question-box">
                    <p><strong>Q<?= $num ?>. <?= htmlspecialchars($q['question_text']) ?></strong></p>

                    <label><input type="radio" name="q<?= $q['id'] ?>" value="A" required> <?= htmlspecialchars($q['option_a']) ?></label>
                    <label><input type="radio" name="q<?= $q['id'] ?>" value="B"> <?= htmlspecialchars($q['option_b']) ?></label>
                    <label><input type="radio" name="q<?= $q['id'] ?>" value="C"> <?= htmlspecialchars($q['option_c']) ?></label>
                    <label><input type="radio" name="q<?= $q['id'] ?>" value="D"> <?= htmlspecialchars($q['option_d']) ?></label>
                </div>
                <?php $num++; endwhile; ?>

            <button type="submit">Submit Quiz</button>
        </form>
    </div>

    <script src="js/timer.js"></script>
    <script>
        // Start the countdown as soon as the page loads
        startTimer(<?= $durationSeconds ?>, "timerDisplay", "quizForm");
    </script>
</body>
</html>
