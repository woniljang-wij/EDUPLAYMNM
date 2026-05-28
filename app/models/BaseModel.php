<?php

require_once __DIR__ . "/../config/database.php";

class BaseModel
{
    protected $conn;
    protected $table;

    public function __construct()
    {
        $database = new Database();

        $this->conn = $database->connect();
    }
}