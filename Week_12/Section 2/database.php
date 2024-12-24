<?php

class database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "prakwebdb";
    public $conn;

    // Constructor to establish a database connection
    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        // Check for a connection error
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}
