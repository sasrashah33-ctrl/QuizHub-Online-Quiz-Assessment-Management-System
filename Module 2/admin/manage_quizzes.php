<?php
include "../config.php";
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "admin") {
    header("Location: ../login.php");
    exit;
}

if (isset($_GET["delete"])) {
    $id = intval($_GET["delete"]);
    $stmt = $conn->prepare("DELETE FROM quizzes WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: manage_quizzes.php");
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
    <title>Manage Quizzes - QuizHub Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="navbar">
        <strong>QuizHub Admin</strong>
        <div>
            <a href="dashboard.php">Dashboard</a>
            <a href="add_quiz.php">Add Quiz</a>
            <a href="add_question.php">Add Question</a>
            <a href="../logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>Manage Quizzes</h1>
        <table>
            <tr><th>Title</th><th>Category</th><th>Duration</th><th>Questions</th><th>Action</th></tr>
            <?php while ($row = $quizzes->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['category']) ?></td>
                <td><?= $row['duration_minutes'] ?> min</td>
                <td><?= $row['question_count'] ?></td>
                <td><a href="manage_quizzes.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this quiz?')">Delete</a></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
