<!-- <?php
include_once __DIR__ . "/../Controller/AdminController.php";
$c = new AdminController();

if (isset($_GET["delete"])) {
    $c->delete($_GET["delete"]);
    header("Location: manage_users.php"); exit();
}

$users = $c->users();
$total = $c->count();
?>
<h3>Manage Users</h3>
<p>Total Users: <?php echo $total; ?></p>

<table border="1" cellpadding="6">
<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Action</th></tr>
<?php while($u = $users->fetch_assoc()) { ?>
<tr>
  <td><?php echo $u["id"]; ?></td>
  <td><?php echo $u["name"]; ?></td>
  <td><?php echo $u["email"]; ?></td>
  <td><?php echo $u["role"]; ?></td>
  <td><a href="?delete=<?php echo $u["id"]; ?>">Delete</a></td>
</tr>
<?php } ?>
</table>

<a href="dashboard.php">Back</a> -->
