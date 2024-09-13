<?php

class UserAuthentication {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function login($username, $password) {
        $username = $this->db->escape_string($username);
        $password = $this->db->escape_string($password);

        $sql = sprintf("SELECT name, password_hash FROM users WHERE username = '%s'", $username);
        $result = $this->db->query($sql);

        if ($result === false) {
            die("Error executing query: " . $this->db->connection->error);
        }

        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user["password_hash"])) {
            // Login successful, redirect to dashboard
            header("Location: dashboard.php");
            exit;
        } else {
            return false; // Invalid login
        }
    }
}
?>

