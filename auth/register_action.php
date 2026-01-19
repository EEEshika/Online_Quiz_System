<?php
session_start();
require_once __DIR__ . "/../config/DatabaseConnection.php";

$name     = trim($_POST["name"] ?? "");
$email    = trim($_POST["email"] ?? "");
$address  = trim($_POST["address"] ?? "");
$gender   = trim($_POST["gender"] ?? "");
$username = trim($_POST["username"] ?? "");
$password = trim($_POST["password"] ?? "");
$role     = trim($_POST["role"] ?? "");

if ($name==="" || $email==="" || $username==="" || $password==="" || $role==="") {
    $_SESSION["regErr"] = "All fields are required";
    header("Location: register.php");
    exit();
}

$conn = (new DatabaseConnection())->connect();

/* check username exists */
$stmt = $conn->prepare("SELECT id FROM users WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();

if ($stmt->get_result()->num_rows > 0) {
    $_SESSION["regErr"] = "Username already used";
    header("Location: register.php");
    exit();
}

/* insert user */
$stmt = $conn->prepare(
    "INSERT INTO users (name,email,address,gender,username,password,role)
     VALUES (?,?,?,?,?,?,?)"
);

$stmt->bind_param(
    "sssssss",
    $name,
    $email,
    $address,
    $gender,
    $username,
    $password,   // plain text as you want
    $role
);

if (!$stmt->execute()) {
    die("DB Error: " . $stmt->error); // IMPORTANT for debugging
}

$_SESSION["SuccessMsg"] = "Registration successful. Please login.";
header("Location: login.php");
exit();
