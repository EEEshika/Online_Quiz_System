<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "student") {
    header("Location: ../../auth/login.php");
    exit();
}

require_once __DIR__ . "/../Controller/StudentController.php";
$c = new StudentController();

$quizId = (int)($_GET["quiz_id"] ?? $_POST["quiz_id"] ?? 0);
if ($quizId <= 0) {
    die("Invalid quiz");
}

$timeLimit = $c->quizTimeLimit($quizId);
$questions = $c->quizData($quizId);
$seconds   = $timeLimit * 60;

// ✅ HANDLE SUBMIT
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["ans"])) {
    $c->submitQuiz($quizId, $_POST["ans"]);
    header("Location: results.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Take Quiz</title>
    <link rel="stylesheet" href="../Public/css/take_quiz.css">
</head>
<body>

<div class="quiz-box">

    <h2>Take Quiz</h2>
    <div class="timer">Time Left: <span id="timer"></span></div>

    <form method="post" id="quizForm">
        <input type="hidden" name="quiz_id" value="<?= $quizId ?>">

        <div class="question-area">
        <?php foreach ($questions as $q) { ?>
            <div class="question">
                <b><?= htmlspecialchars($q["question"]) ?></b><br>

                <?php
                $options = [
                    1 => $q["option1"],
                    2 => $q["option2"],
                    3 => $q["option3"],
                    4 => $q["option4"]
                ];
                foreach ($options as $num => $text) {
                ?>
                    <label>
                        <input
                            type="radio"
                            name="ans[<?= $q["id"] ?>]"
                            value="<?= $num ?>"
                            required
                        >
                        <?= htmlspecialchars($text) ?>
                    </label><br>
                <?php } ?>
            </div>
        <?php } ?>
        </div>

        <button type="submit">Submit</button>
    </form>
</div>

<script>
let time = <?= $seconds ?>;

function tick() {
    let m = Math.floor(time / 60);
    let s = time % 60;
    document.getElementById("timer").innerText =
        m + ":" + String(s).padStart(2, "0");

    if (time <= 0) {
        document.getElementById("quizForm").submit();
    }
    time--;
}

tick();
setInterval(tick, 1000);
</script>

</body>
</html>
