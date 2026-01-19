<?php
include_once __DIR__ . "/../config/DatabaseConnection.php";

$username = $_POST["username"] ?? "";

if ($username === "") {
    echo "";
    exit();
}

$conn = (new DatabaseConnection())->connect();

$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    echo "<span style='color:green;'>Username exists</span>";
} else {
    echo "<span style='color:red;'>Username not found</span>";
}
