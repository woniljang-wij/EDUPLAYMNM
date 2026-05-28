<?php

require_once "./app/config/database.php";

class UserModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();

        $this->conn = $database->connect();
    }

    // ===== REGISTER =====
    public function createUser($username, $email, $password)
    {
        $query = "
            INSERT INTO users
            (
                username,
                email,
                password
            )
            VALUES
            (
                :username,
                :email,
                :password
            )
        ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":username", $username);

        $stmt->bindParam(":email", $email);

        $stmt->bindParam(":password", $password);

        return $stmt->execute();
    }

    // ===== FIND EMAIL =====
    public function findByEmail($email)
    {
        $query = "
            SELECT *
            FROM users
            WHERE email = :email
            LIMIT 1
        ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":email", $email);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ===== LOGIN =====
    public function login($email, $password)
    {
        $query = "
            SELECT *
            FROM users
            WHERE email = :email
            AND password = :password
            LIMIT 1
        ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":email", $email);

        $stmt->bindParam(":password", $password);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ===== FIND USER =====
    public function findById($id)
    {
        $query = "
            SELECT *
            FROM users
            WHERE id = :id
        ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>