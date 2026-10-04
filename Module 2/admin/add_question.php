<?php
include "../config.php";
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "admin") {
    header("Location: ../login.php");
    exit;
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quiz_id       = $_POST["quiz_id"];
    $question_text = trim($_POST["question_text"]);
    $option_a      = trim($_POST["option_a"]);
    $option_b      = trim($_POST["option_b"]);
    $option_c      = trim($_POST["option_c"]);
    $option_d      = trim($_POST["option_d"]);
    $correct       = $_POST["correct_option"];

    $stmt = $conn->prepare("INSERT INTO questions (quiz_id, question_text, option_a, option_b, option_c, option_d, correct_option)
                             VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $quiz_id, $question_text, $option_a, $option_b, $option_c, $option_d, $correct);
    $stmt->execute();
    $message = "Question added!";
}

$quizzes = $conn->query("SELECT * FROM quizzes ORDER BY title");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Question - QuizHub Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="navbar">
        <strong>QuizHub Admin</strong>
        <div>
            <a href="dashboard.php">Dashboard</a>
            <a href="add_quiz.php">Add Quiz</a>
            <a href="manage_quizzes.php">Manage Quizzes</a>
            <a href="../logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>Add a Question</h1>
        <?php if ($message) echo "<p class='success'>$message</p>"; ?>

        <form method="POST">
            <label>Choose Quiz</label>
            <select name="quiz_id" required>
                <?php while ($q = $quizzes->fetch_assoc()): ?>
                    <option value="<?= $q['id'] ?>"><?= htmlspecialchars($q['title']) ?></option>
                <?php endwhile; ?>
            </select>

            <label>Question</label>
            <textarea name="question_text" rows="2" required></textarea>

            <label>Option A</label>
            <input type="text" name="option_a" required>
            <label>Option B</label>
            <input type="text" name="option_b" required>
            <label>Option C</label>
            <input type="text" name="option_c" required>
            <label>Option D</label>
            <input type="text" name="option_d" required>

            <label>Correct Option</label>
            <select name="correct_option" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>

            <button type="submit">Add Question</button>
        </form>
    </div>
</body>
</html>
