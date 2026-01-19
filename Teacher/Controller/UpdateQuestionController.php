<?php
session_start();
require_once __DIR__ . "/TeacherController.php";

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "teacher") {
    header("Location: ../../auth/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request");
}

$c = new TeacherController();
$ok = $c->updateQuestion($_POST);

if ($ok) {
    header("Location: ../View/view_questions.php?msg=updated");
    exit;
} else {
    die("Update failed! Please check all inputs and try again.");
}
