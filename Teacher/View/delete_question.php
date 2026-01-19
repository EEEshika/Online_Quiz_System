<?php
session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "teacher") {
    header("Location: ../../auth/login.php");
    exit();
}

require_once __DIR__ . "/../Controller/TeacherController.php";
$c = new TeacherController();

$questions = $c->getAllQuestions();

$success = $_SESSION["success"] ?? "";
$error   = $_SESSION["error"] ?? "";
unset($_SESSION["success"], $_SESSION["error"]);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Questions</title>
    <link rel="stylesheet" href="../Public/css/delete_question.css">
</head>
<body>

<div class="form-box">

    <h2>Delete Questions</h2>

    <?php if ($success): ?>
        <p class="success"><?= $success ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Quiz</th>
            <th>Question</th>
            <th>Action</th>
        </tr>

        <?php while ($q = $questions->fetch_assoc()): ?>
        <tr>
            <td><?= $q["id"] ?></td>
            <td><?= $q["quiz_id"] ?></td>
            <td><?= htmlspecialchars($q["question"]) ?></td>
            <td>
                <form method="post"
                      action="delete_question_action.php"
                      onsubmit="return confirm('Delete this question?');">

                    <input type="hidden" name="question_id" value="<?= $q["id"] ?>">
                    <button type="submit" class="btn-delete">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>

    </table>

    <a class="back" href="dashboard.php">Back to Dashboard</a>

</div>

</body>
</html>
