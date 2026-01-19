<?php
session_start();
require_once __DIR__ . "/../Controller/TeacherController.php";

$c = new TeacherController();
$questions = $c->getAllQuestions();
?>
<!DOCTYPE html>
<html>
<head>
    <title>All Questions</title>
    <link rel="stylesheet" href="../Public/css/view_questions.css">
</head>
<body>

<div class="box">
    <h2>All Questions</h2>

    <table>
        <tr>
            <th>Question ID</th>
            <th>Quiz ID</th>
            <th>Question</th>
        </tr>
        <?php while ($q = $questions->fetch_assoc()) { ?>
        <tr>
            <td><?= $q["id"] ?></td>
            <td><?= $q["quiz_id"] ?></td>
            <td><?= htmlspecialchars($q["question"]) ?></td>
        </tr>
        <?php } ?>
    </table>

    <a href="dashboard.php">Back</a>
</div>

</body>
</html>
