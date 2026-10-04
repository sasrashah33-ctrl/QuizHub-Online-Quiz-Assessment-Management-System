<?php
include "../config.php";
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "admin") {
    header("Location: ../login.php");
    exit;
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["new_category"]) && trim($_POST["new_category"]) != "") {
        $cat = trim($_POST["new_category"]);
        $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->bind_param("s", $cat);
        $stmt->execute();
        $message = "Category added.";
    }

    if (isset($_POST["title"])) {
        $title       = trim($_POST["title"]);
        $category_id = $_POST["category_id"];
        $duration    = intval($_POST["duration"]);

        $stmt = $conn->prepare("INSERT INTO quizzes (title, category_id, duration_minutes) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $title, $category_id, $duration);
        $stmt->execute();
        $message = "Quiz '$title' added successfully!";
    }
}

$categories = $conn->query("SELECT * FROM categories ORDER BY name");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Quiz - QuizHub Admin</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="navbar">
        <strong>QuizHub Admin</strong>
        <div>
            <a href="dashboard.php">Dashboard</a>
            <a href="manage_quizzes.php">Manage Quizzes</a>
            <a href="add_question.php">Add Question</a>
            <a href="../logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>Add a New Quiz</h1>
        <?php if ($message) echo "<p class='success'>$message</p>"; ?>

        <form method="POST">
            <label>Quiz Title</label>
            <input type="text" name="title" required>

            <label>Category</label>
            <select name="category_id" required>
                <?php while ($cat = $categories->fetch_assoc()): ?>
                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                <?php endwhile; ?>
            </select>

            <label>Duration (minutes)</label>
            <input type="number" name="duration" value="5" min="1" required>

            <button type="submit">Add Quiz</button>
        </form>

        <h2>Need a new category?</h2>
        <form method="POST">
            <label>New Category Name</label>
            <input type="text" name="new_category">
            <button type="submit">Add Category</button>
        </form>
    </div>
</body>
</html>
