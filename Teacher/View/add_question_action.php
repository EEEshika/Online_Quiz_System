<?php
session_start();

require_once __DIR__ . "/../Controller/TeacherController.php";
$c = new TeacherController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($c->addQuestion($_POST)) {
        $_SESSION["success"] = "Question added successfully";
    } else {
        $_SESSION["error"] = "Failed to add question";
    }

    header("Location: add_question.php");
    exit();
}
