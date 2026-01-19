<?php
session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "teacher") {
    header("Location: ../../auth/login.php");
    exit();
}

require_once __DIR__ . "/../Controller/TeacherController.php";
$c = new TeacherController();

$id = (int)($_POST["question_id"] ?? 0);

if ($id > 0 && $c->deleteQuestion($id)) {
    $_SESSION["success"] = "Question deleted successfully";
} else {
    $_SESSION["error"] = "Failed to delete question";
}

header("Location: delete_question.php");
exit();
