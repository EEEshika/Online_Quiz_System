<?php
session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "teacher") {
    header("Location: ../../auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="../Public/css/teacher_dashboard.css">
</head>
<body>

<div class="dashboard-box">

    <h2>Teacher Dashboard</h2>

    <p class="welcome-text">
        Welcome, <b><?= htmlspecialchars($_SESSION["name"]) ?></b>
    </p>

    <div class="menu">
                
        <a href="view_questions.php">View All Questions</a>
        <a href="add_question.php">Add Question</a>
        <a href="delete_question.php">Delete Question</a>
        <a href="update_question.php">Update Question</a>
    </div>

    <a class="logout-btn" href="../../auth/logout.php">Logout</a>

</div>

</body>
</html>
