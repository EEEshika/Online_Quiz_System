<!-- <?php
session_start();

$score  = $_GET["score"] ?? 0;
$quizId = $_GET["quiz_id"] ?? 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quiz Result</title>
    <link rel="stylesheet" href="../Public/css/quiz_result.css">
</head>
<body>

<div class="result-box">
    <h2>Your Score</h2>

    <div class="score">
        <?= htmlspecialchars($score) ?>
    </div>

    <p class="thanks">Thank you for taking the quiz!</p>

    <a href="dashboard.php" class="btn">Go back to Dashboard</a>

    <a href="../../auth/logout.php" class="logout">Logout</a>
</div>

</body>
</html><?php
session_start();

$score  = $_GET["score"] ?? 0;
$quizId = $_GET["quiz_id"] ?? 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quiz Result</title>
    <link rel="stylesheet" href="../Public/css/quiz_result.css">
</head>
<body>

<div class="result-box">
    <h2>Your Score</h2>

    <div class="score">
        <?= htmlspecialchars($score) ?>
    </div>

    <p class="thanks">Thank you for taking the quiz!</p>

    <a href="dashboard.php" class="btn">Go back to Dashboard</a>

    <a href="../../auth/logout.php" class="logout">Logout</a>
</div>

</body>
</html>
 -->
