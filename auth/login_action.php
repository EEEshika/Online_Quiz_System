<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once __DIR__ . "/../config/DatabaseConnection.php";

$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";

if ($username === "" || $password === "") {
    $_SESSION["LoginErr"] = "Username and password required";
    header("Location: login.php");
    exit();
}

$conn = (new DatabaseConnection())->connect();

$stmt = $conn->prepare(
    "SELECT id, name, email, username, role 
     FROM users 
     WHERE username = ? AND password = ?"
);

$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 1) {
    $user = $res->fetch_assoc();

    $_SESSION["isLoggedIn"] = true;
    $_SESSION["user_id"]   = $user["id"];
    $_SESSION["name"]      = $user["name"];
    $_SESSION["email"]     = $user["email"];
    $_SESSION["username"]  = $user["username"];
    $_SESSION["role"]      = $user["role"];

    if ($user["role"] === "student") {
        header("Location: ../Student/View/dashboard.php");
        exit();
    }

    if ($user["role"] === "teacher") {
        header("Location: ../Teacher/View/dashboard.php");
        exit();
    }

    if ($user["role"] === "admin") {
        header("Location: ../Admin/View/dashboard.php");
        exit();
    }
}

$_SESSION["LoginErr"] = "Invalid username or password";
header("Location: login.php");
exit();
