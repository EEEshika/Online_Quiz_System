<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../../auth/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../Public/css/admin.css">
</head>
<body>

<div class="dashboard-box">
    <h2>Admin Dashboard</h2>

    <p class="welcome">
        Welcome, <b><?= htmlspecialchars($_SESSION["name"]) ?></b>
    </p>

    <div class="menu">
        <a href="users.php">Manage Users</a>
        <a href="upload_image.php">Upload Profile Picture</a>
    </div>

    <a class="logout" href="../../auth/logout.php">Logout</a>
</div>

</body>
</html>
