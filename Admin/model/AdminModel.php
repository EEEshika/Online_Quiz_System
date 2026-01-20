<?php
require_once __DIR__ . "/../../config/DatabaseConnection.php";

class AdminModel extends DatabaseConnection {

    public function getAllUsers() {
        return $this->connect()->query(
            "SELECT id, name, username, email, role FROM users ORDER BY id ASC"
        );
    }

    public function updateRole($userId, $role) {
        $stmt = $this->connect()->prepare(
            "UPDATE users SET role=? WHERE id=?"
        );
        $stmt->bind_param("si", $role, $userId);
        return $stmt->execute();
    }
}
