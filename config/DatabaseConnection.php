<?php
class DatabaseConnection {
    private $conn = null;

    public function connect() {
        if ($this->conn === null) {
            $this->conn = new mysqli("localhost", "root", "", "online_quiz_system");
            if ($this->conn->connect_error) {
                die("Database Connection Failed: " . $this->conn->connect_error);
            }
        }
        return $this->conn;
    }
}
