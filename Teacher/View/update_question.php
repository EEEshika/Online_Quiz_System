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
    <title>Update Question</title>

    <link rel="stylesheet" href="../Public/css/update_question.css">

    <script>
        function fetchQuestion() {
            const id = document.getElementById("question_id").value.trim();
            if (id === "") return;

            fetch("../Controller/GetQuestionAjaxController.php?id=" + id)
                .then(res => res.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    document.getElementById("quiz_id").value = data.quiz_id;
                    document.getElementById("question").value = data.question;
                    document.getElementById("option1").value = data.option1;
                    document.getElementById("option2").value = data.option2;
                    document.getElementById("option3").value = data.option3;
                    document.getElementById("option4").value = data.option4;
                    document.getElementById("correct_option").value = data.correct_option;
                })
                .catch(() => alert("Failed to load question"));
        }
    </script>
</head>
<body>

<div class="form-box">

    <h2>Update Question</h2>

    <form method="post" action="../Controller/UpdateQuestionController.php">

        <label>Question ID</label>
        <input
            type="number"
            id="question_id"
            name="id"
            onblur="fetchQuestion()"
            required
        >

        <label>Quiz ID</label>
        <input type="number" id="quiz_id" name="quiz_id" required>

        <label>Question</label>
        <textarea id="question" name="question" required></textarea>

        <input type="text" id="option1" name="option1" placeholder="Option 1" required>
        <input type="text" id="option2" name="option2" placeholder="Option 2" required>
        <input type="text" id="option3" name="option3" placeholder="Option 3" required>
        <input type="text" id="option4" name="option4" placeholder="Option 4" required>

        <label>Correct Option (1–4)</label>
        <input
            type="number"
            id="correct_option"
            name="correct_option"
            min="1"
            max="4"
            required
        >

        <button type="submit">Update Question</button>
    </form>

    <a class="back" href="dashboard.php">Back to Dashboard</a>

</div>

</body>
</html>
