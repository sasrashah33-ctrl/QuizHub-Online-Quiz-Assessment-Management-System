<?php
include "config.php";
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php");
    exit;
}

$quiz_id = intval($_POST["quiz_id"]);
$user_id = $_SESSION["user_id"];

// Get the correct answer for every question in this quiz
$stmt = $conn->prepare("SELECT id, correct_option FROM questions WHERE quiz_id = ?");
$stmt->bind_param("i", $quiz_id);
$stmt->execute();
$questions = $stmt->get_result();

$total = 0;
$score = 0;

while ($q = $questions->fetch_assoc()) {
    $total++;
    $fieldName = "q" . $q["id"];

    // If the user picked this question's field, and it matches the correct answer, +1 point
    if (isset($_POST[$fieldName]) && $_POST[$fieldName] == $q["correct_option"]) {
        $score++;
    }
}

// Save this attempt into the results table
$stmt2 = $conn->prepare("INSERT INTO results (user_id, quiz_id, score, total_questions) VALUES (?, ?, ?, ?)");
$stmt2->bind_param("iiii", $user_id, $quiz_id, $score, $total);
$stmt2->execute();
$result_id = $stmt2->insert_id;

header("Location: result.php?id=" . $result_id);
exit;
?>
