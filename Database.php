<?php

class Database {
    private $connection;

    public function __construct($host, $username, $password, $dbname) {
        $this->connection = new mysqli($host, $username, $password, $dbname);
        if ($this->connection->connect_errno) {
            die("Connection error: " . $this->connection->connect_error);
        }
    }

    public function query($sql) {
        return $this->connection->query($sql);
    }

    public function escape_string($string) {
        return $this->connection->real_escape_string($string);
    }

    public function close() {
        $this->connection->close();
    }
}
?>
