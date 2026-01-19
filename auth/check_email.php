<?php
require_once __DIR__ . "/../config/DatabaseConnection.php";

$email = $_POST["email"] ?? "";

if ($email === "") {
    exit();
}

$conn = (new DatabaseConnection())->connect();

$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    echo "<span style='color:red;'>Email already exists</span>";
} else {
    echo "<span style='color:green;'>Email available</span>";
}
