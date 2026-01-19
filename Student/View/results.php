<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "student") {
    header("Location: ../../auth/login.php");
    exit();
}

$score = $_SESSION["latest_result"]["score"] ?? 0;
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
    <div class="score"><?= $score ?></div>


    <a class="btn" href="dashboard.php">Back to Dashboard</a>
    <a class="logout" href="../../auth/logout.php">Logout</a>
</div>

</body>
</html>
