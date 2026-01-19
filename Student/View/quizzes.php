<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "student") {
    header("Location: ../../auth/login.php");
    exit();
}

require_once __DIR__ . "/../Controller/StudentController.php";
$c = new StudentController();
$quizzes = $c->allQuizzes();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Available Quizzes</title>
    <link rel="stylesheet" href="../Public/css/quizzes.css">
</head>
<body>

<div class="quiz-container">
    <h2>Available Quizzes</h2>

    <table>
        <tr>
            <th>Subject</th>
            <th>Type</th>
            <th>Marks</th>
            <th>Time (min)</th>
            <th>Action</th>
        </tr>

        <?php while ($q = $quizzes->fetch_assoc()) { ?>
        <tr>
            <td><?= htmlspecialchars($q["subject"]) ?></td>
            <td><?= htmlspecialchars($q["type"]) ?></td>
            <td><?= $q["marks"] ?></td>
            <td><?= $q["time"] ?></td>
            <td>
                <a class="start-btn" href="take_quiz.php?quiz_id=<?= $q["id"] ?>">
                    Start Quiz
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <a class="back" href="dashboard.php">Back</a>
</div>

</body>
</html>
