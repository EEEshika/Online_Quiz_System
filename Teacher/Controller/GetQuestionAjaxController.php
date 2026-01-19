<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Content-Type: application/json");

require_once __DIR__ . "/TeacherController.php";

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "teacher") {
    echo json_encode(["error" => "Unauthorized (session role not teacher). Please login again."]);
    exit;
}

$id = (int)($_GET["id"] ?? 0);
if ($id <= 0) {
    echo json_encode(["error" => "Missing/invalid question id"]);
    exit;
}

$c = new TeacherController();
$q = $c->getQuestionById($id);

if ($q) {
    echo json_encode($q); // flat JSON object
} else {
    echo json_encode(["error" => "Question not found"]);
}
