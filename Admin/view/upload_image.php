<?php
session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../../auth/login.php");
    exit();
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_FILES["image"]) || $_FILES["image"]["error"] !== 0) {
        $error = "Please select a valid image file.";
    } else {

        $maxSize = 5 * 1024 * 1024; // 5 MB
        $fileSize = $_FILES["image"]["size"];

        if ($fileSize > $maxSize) {
            $error = "Image size must be 5 MB or less.";
        } else {

            // ✅ Correct absolute upload path
            $uploadDir = __DIR__ . "/../../uploads/";

            // Create folder if somehow missing
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = time() . "_" . basename($_FILES["image"]["name"]);
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
                $_SESSION["admin_profile_image"] = $fileName;
                $success = "Profile picture uploaded successfully.";
            } else {
                $error = "Failed to upload image. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Profile Picture</title>
    <link rel="stylesheet" href="../Public/css/upload_image.css">
</head>
<body>

<div class="upload-box">

    <h2>Upload Profile Picture</h2>

    <!-- ✅ Show image in center -->
    <?php if (isset($_SESSION["admin_profile_image"])): ?>
        <img
            src="../../uploads/<?= htmlspecialchars($_SESSION["admin_profile_image"]) ?>"
            class="profile-img"
            alt="Profile Image"
        >
    <?php endif; ?>

    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p class="success"><?= $success ?></p>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Upload</button>
    </form>

    <a href="dashboard.php" class="back">Back to Dashboard</a>

</div>

</body>
</html>
