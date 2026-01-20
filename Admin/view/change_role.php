<?php
session_start();
require_once __DIR__ . "/../Controller/AdminController.php";

$c = new AdminController();

$c->updateRole($_POST["id"], $_POST["role"]);

header("Location: users.php");
exit();
