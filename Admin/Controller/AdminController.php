<?php
require_once __DIR__ . "/../Model/AdminModel.php";

class AdminController {

    private $model;

    public function __construct() {
        $this->model = new AdminModel();
    }

    public function allUsers() {
        return $this->model->getAllUsers();
    }

    public function changeRole($id, $role) {
        return $this->model->updateRole($id, $role);
    }
}
