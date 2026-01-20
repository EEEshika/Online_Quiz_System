<?php
session_start();
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../../auth/login.php");
    exit();
}

require_once __DIR__ . "/../Controller/AdminController.php";
$c = new AdminController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $c->changeRole($_POST["id"], $_POST["role"]);
}

$users = $c->allUsers();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <link rel="stylesheet" href="../Public/css/users.css">
</head>
<body>

<div class="box">
<h2>All Users</h2>

<table>
<tr>
    <th>Name</th>
    <th>Username</th>
    <th>Email</th>
    <th>Role</th>
    <th>Action</th>
</tr>

<?php while ($u = $users->fetch_assoc()) { ?>
<tr>
<form method="post">
    <td><?= htmlspecialchars($u["name"]) ?></td>
    <td><?= htmlspecialchars($u["username"]) ?></td>
    <td><?= htmlspecialchars($u["email"]) ?></td>
    <td>
        <select name="role">
            <option <?= $u["role"]=="student"?"selected":"" ?>>student</option>
            <option <?= $u["role"]=="teacher"?"selected":"" ?>>teacher</option>
            <option <?= $u["role"]=="admin"?"selected":"" ?>>admin</option>
        </select>
    </td>
    <td>
        <input type="hidden" name="id" value="<?= $u["id"] ?>">
        <button>Update</button>
    </td>
</form>
</tr>
<?php } ?>

</table>

<a href="dashboard.php">Back</a>
</div>

</body>
</html>
