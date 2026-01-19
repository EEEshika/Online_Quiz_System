<?php
session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "teacher") {
    header("Location: ../../auth/login.php");
    exit();
}

require_once __DIR__ . "/../Controller/TeacherController.php";
$c = new TeacherController();

$quizzes = $c->getAllQuizzes();

$success = $_SESSION["success"] ?? "";
$error   = $_SESSION["error"] ?? "";
unset($_SESSION["success"], $_SESSION["error"]);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Question</title>
    <link rel="stylesheet" href="../Public/css/add_question.css">
</head>
<body>

<div class="form-box">
    <h2>Add Question</h2>

    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p class="success"><?= $success ?></p>
    <?php endif; ?>

    <form method="post" action="add_question_action.php">

        <label>Select Quiz</label>
        <select name="quiz_id" required>
            <option value="">-- Select Quiz --</option>

            <?php while ($q = $quizzes->fetch_assoc()) { ?>
                <option value="<?= $q["id"] ?>">
                    <?= htmlspecialchars($q["subject"]) ?>
                </option>
            <?php } ?>
        </select>

        <label>Question</label>
        <textarea name="question" required></textarea>

        <input type="text" name="option1" placeholder="Option 1" required>
        <input type="text" name="option2" placeholder="Option 2" required>
        <input type="text" name="option3" placeholder="Option 3" required>
        <input type="text" name="option4" placeholder="Option 4" required>

        <label>Correct Option (1–4)</label>
        <input type="number" name="correct_option" min="1" max="4" required>

        <button type="submit">Add Question</button>
    </form>

    <a class="back" href="dashboard.php">Back to Dashboard</a>
</div>

</body>
</html>
