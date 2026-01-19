<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once __DIR__ . '/../Model/mydb.php';

/* teacher auth */
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'teacher') {
    header("Location: ../../auth/login.php");
    exit();
}

$db   = new Model();
$conn = $db->OpenConn();

$allQuestions = $db->getAllQuestions($conn, "ASC");

$conn->close();

require_once __DIR__ . '/../View/listquestions.php';
