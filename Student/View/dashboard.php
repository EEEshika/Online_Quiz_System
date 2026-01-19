<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "student") {
    header("Location: ../../auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../Public/css/student_dashboard.css">

    <script>
    function checkBeforeQuiz() {
        const ok = confirm("Are you ready to start the quiz?");
        return ok;
    }
    </script>
</head>
<body>

<div class="dashboard-box">

    <h2>Student Dashboard</h2>

    <p class="welcome-text">
        Welcome, <b><?= htmlspecialchars($_SESSION["name"]) ?></b>
    </p>

    <div class="menu">
        <a href="quizzes.php" onclick="return checkBeforeQuiz();">
            Take Quiz
        </a>

        <a href="results.php">View Results</a>
    </div>

    <a class="logout-btn" href="../../auth/logout.php">Logout</a>

</div>

</body>
</html>
